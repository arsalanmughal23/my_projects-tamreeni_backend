<?php

namespace App\Http\Controllers\API;

use App\Criteria\AppointmentCriteria;
use App\Http\Controllers\PayTabsController;
use App\Http\Requests\API\CreateAppointmentAPIRequest;
use App\Http\Requests\API\UpdateAppointmentAPIRequest;
use App\Models\Appointment;
use App\Models\Package;
use App\Models\Setting;
use App\Models\Transaction;
use App\Repositories\AppointmentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\AppointmentResource;
use App\Models\Role;
use App\Models\User;
use App\Repositories\PackageRepository;
use App\Repositories\SlotRepository;
use App\Repositories\UsersRepository;
use Error;
use Response;
use Illuminate\Support\Facades\DB;

/**
 * Class AppointmentController
 * @package App\Http\Controllers\API
 */
class AppointmentAPIController extends AppBaseController
{
    public function __construct(
        private PackageRepository $packageRepository,
        private AppointmentRepository $appointmentRepository,
        private SlotRepository $slotRepository,
        private UsersRepository $userRepository,
    ) {
    }

    /**
     * Display a listing of the Appointment.
     * GET|HEAD /appointments
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $params = $request->only('user_id', 'customer_id', 'type', 'profession_type', 'status', 'start_date', 'date', 'order_by', 'order');

        $appointments = $this->appointmentRepository->pushCriteria(new AppointmentCriteria($params))->all();
        return $this->sendResponse(AppointmentResource::collection($appointments), 'Appointments retrieved successfully');
    }

    /**
     * Store a newly created Appointment in storage.
     * POST /appointments
     *
     * @param CreateAppointmentAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateAppointmentAPIRequest $request)
    {
        try {
            DB::beginTransaction();

            $user                = $request->user();
            $input               = $request->validated();
            $input['package_id'] = $input['package_id'] ?? null;

            $type                  = intval($input['type']);
            $profession_type       = intval($input['profession_type']);
            $amountInSAR           = 0;
            $paymentIntentRequired = $input['payment_intent_required'] ?? false;
            $slot = null;
            $slots = [];

            $customerUser = $request->user();
            if(!$customerUser->hasRole(Role::API_USER))
                throw new \Error('Only Application User able to make an appointment');

            // Implement Pre-Requisites checks
            switch ($type) {
                case Appointment::TYPE_SESSION:
                    $slot = $this->slotRepository->find($input['slot_id']);
                    if (!$slot)
                        return $this->sendError('Slot is not Found', 404);

                    $slotUser = $slot->user;

                    if (!$this->checkUserHasProfessionTypeRole($slotUser, $profession_type))
                        throw new \Error('Selected profession type is not associated with the slot user');

                    $appointmentDay = \Carbon\Carbon::parse($input['date'])->format('l');
                    if ($slot->day != $appointmentDay)
                        throw new \Error('Selected slot is only for '.$slot->day);

                    $appointmentExist = $this->appointmentRepository
                                        ->getBookedAppointments($slot, $input['date'], $user->id)
                                        ->exists();

                    if ($appointmentExist)
                        throw new \Error('Appointment is already booked for ' . $input['date'] .' '. $slot->start_time .' to '. $slot->end_time);
                    break;
                case Appointment::TYPE_PACKAGE:
                    $slotsIds = collect($request->appointments)->pluck('slot_id');
                    $slots = $this->slotRepository->whereIn('id', $slotsIds)->get();
                    if (count($slotsIds) > count($slots))
                        throw new Error('Some selected slot is not found');

                    foreach ($input['appointments'] as $key => $appointment) {
                        $eachSlot = $slots->find($appointment['slot_id']);

                        $slotUser = $eachSlot->user;
                        if (!$this->checkUserHasProfessionTypeRole($slotUser, $profession_type))
                            throw new \Error('Selected profession type is not associated with the slot user');

                        $appointmentDay = \Carbon\Carbon::parse($appointment['date'])->format('l');
                        if ($eachSlot->day != $appointmentDay)
                            throw new \Error('Selected slot is only for '.$eachSlot->day);

                        $appointmentExist = $this->appointmentRepository
                                            ->getBookedAppointments($eachSlot, $appointment['date'], $user->id)
                                            ->exists();

                        if ($appointmentExist)
                            throw new \Error('Appointment is already booked for ' . $appointment['date'] .' '. $eachSlot->start_time .' to '. $eachSlot->end_time);
                    }

                    break;
                default :
                    throw new Error('Invalid Type');
                    break;
            }

            if(!$user->stripe_customer_id)
                $user->createStripeCustomer();

            $transactionable       = null;
            $redirect_url          = null;
            $createdAppointmentIds = [];
            switch ($type) {
                case Appointment::TYPE_SESSION:
                    // Create transaction if it's a session appointment
                    $checkUserAppointment = $this->appointmentRepository
                        ->getBookedAppointments($slot, $input['date'], $user->id)
                        ->exists();

                    if ($checkUserAppointment)
                        return $this->sendError('Already book appointment', 422);

                    $description             = "1-1 Session - Appointment Payment";
                    $amountInSAR             = $this->calculateSessionFee($profession_type);
                    $input['customer_id']    = $user->id;
                    $input = array_merge($input, $slot->only('user_id', 'start_time', 'end_time'));
                    $transactionable         = $this->appointmentRepository->create($input);
                    $createdAppointmentIds[] = $transactionable->id;
                    break;

                case Appointment::TYPE_PACKAGE:

                    $package     = $transactionable = $this->packageRepository->findWithoutFail($input['package_id']);
                    $amountInSAR = $package->amount;
                    $description = $package->description . ' ' . ' Package Purchase';

                    // $appointments = $input['appointments'];
                    foreach ($slots as $key => $slot) {
                        $appointment['customer_id']     = $user->id;
                        $appointment['package_id']      = $input['package_id'];
                        $appointment['type']            = $type;
                        $appointment['profession_type'] = $profession_type;
                        $appointment = array_merge($appointment, $slot->only('user_id', 'start_time', 'end_time'));
                        $createdAppointment             = $this->appointmentRepository->create($appointment);
                        $createdAppointmentIds[]        = $createdAppointment->id;
                    }
                    break;

                default:
                    throw new \Error('Type is invalid');
                    break;
            }

            $paymentIntent = null;
            $ephemeralKey  = null;
            $transaction   = null;

            if ($paymentIntentRequired) {
                $paymentIntentResponse = PaymentController::makePaymentIntent($amountInSAR, $description, $user->stripe_customer_id);

                if (!$paymentIntentResponse['status'])
                    throw new \Error('Payment intent is not created');

                $ephemeralKeyResponse = PaymentController::makeEphemeralKey($user->stripe_customer_id);
                if (!$ephemeralKeyResponse['status'])
                    throw new \Error('Ephemeral key is not created');

                $paymentIntent = $paymentIntentResponse['data'];
                $ephemeralKey  = $ephemeralKeyResponse['data'];

                $transaction = $transactionable->transactions()->create([
                    'payment_intent_id' => $paymentIntent['id'],
                    'payment_charge_id' => null,
                    'amount'            => $amountInSAR,
                    'description'       => $description,
                    'user_id'           => $user->id,
                    'currency'          => getCurrencySymbol(),
                    'status'            => Transaction::STATUS_HOLD
                ]);
            } else {
                // $transaction = $this->createTransaction($transactionable, $user, $amountInSAR, $input['payment_method_id'], $description);
                $payTabController = new PayTabsController();
                $payTabsResponse = $payTabController->createTransactionWithPayTab($transactionable, $user, $amountInSAR, $description, $createdAppointmentIds);
                $paymentCharge = $payTabsResponse['paymentCharge'];
                $redirect_url  = $paymentCharge['redirect_url'];
                $transaction   = $payTabsResponse['transaction'];
            }

            $createdAppointments = $this->appointmentRepository->whereIn('id', $createdAppointmentIds);
            $createdAppointments->update(['transaction_id' => $transaction->id]);

            DB::commit();

            $data = [
                'appointments'  => AppointmentResource::collection($createdAppointments->get()),
                'ephemeralKey'  => $ephemeralKey,
                'paymentIntent' => $paymentIntent,
                'transaction'   => $transaction,
                'redirect_url'  => $redirect_url,
            ];
            return $this->sendResponse($data, 'Appointment saved successfully');
        } catch (\Error $e) {
            DB::rollback();
            return $this->sendError($e->getMessage(), 403);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->sendError($e->getMessage(), 422);
        }
    }

    public function checkUserHasProfessionTypeRole(User $user, $profession_type) {
        $appointmentProfessionTypeRole = Appointment::getRoleByProfessionType($profession_type);
        if($user->hasRole($appointmentProfessionTypeRole))
            return true;
        return false;
    }
    /**
     * Display the specified Appointment.
     * GET|HEAD /appointments/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var Appointment $appointment */
        $appointment = $this->appointmentRepository->findWithoutFail($id);

        if (empty($appointment)) {
            return $this->sendError('Appointment not found');
        }

        return $this->sendResponse(new AppointmentResource($appointment), 'Appointment retrieved successfully');
    }

    /**
     * Update the specified Appointment in storage.
     * PUT/PATCH /appointments/{id}
     *
     * @param int $id
     * @param UpdateAppointmentAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateAppointmentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Appointment $appointment */
        $appointment = $this->appointmentRepository->find($id);

        if (empty($appointment)) {
            return $this->sendError('Appointment not found');
        }

        $appointment = $this->appointmentRepository->update($input, $id);

        return $this->sendResponse($appointment->toArray(), 'Appointment updated successfully');
    }

    /**
     * Remove the specified Appointment from storage.
     * DELETE /appointments/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var Appointment $appointment */
        $appointment = $this->appointmentRepository->find($id);

        if (empty($appointment)) {
            return $this->sendError('Appointment not found');
        }

        $appointment->delete();

        return $this->sendSuccess('Appointment deleted successfully');
    }

    // Function to calculate session fee based on profession type
    private function calculateSessionFee($profession_type)
    {
        $setting        = Setting::first();
        $service_fee    = $setting->service_fee;
        $profession_fee = 0;
        if ($profession_type == Appointment::PROFESSION_TYPE_COACH) {
            $profession_fee = $setting->coach_fee;
        }
        if ($profession_type == Appointment::PROFESSION_TYPE_DIETITIAN) {
            $profession_fee = $setting->dietitian_fee;
        }
        if ($profession_type == Appointment::PROFESSION_TYPE_THERAPIST) {
            $profession_fee = $setting->therapist_fee;
        }
        return $profession_fee + $service_fee;
    }

    // Function to create transaction
    private function createTransaction(Package | Appointment $transactionable, $user, $amountInSAR, $payment_method_id, $description)
    {
        $paymentIntentResponse = PaymentController::makePaymentIntent($amountInSAR, $description, $user->stripe_customer_id);
        if (!$paymentIntentResponse['status'])
            throw new \Error('Payment intent is not created');
        $paymentIntentId = $paymentIntentResponse['data']['id'];

        $chargePaymentResponse = PaymentController::charge($paymentIntentId, $payment_method_id);
        if (!$chargePaymentResponse['status'])
            throw new \Error('Payment is not charged!');
        $chargedPaymentId = $chargePaymentResponse['data']['id'];

        $transaction = $transactionable->transactions()->create([
            'payment_intent_id' => $paymentIntentId,
            'payment_charge_id' => $chargedPaymentId,
            'amount'            => $amountInSAR,
            'description'       => $description,
            'user_id'           => $user->id,
            'currency'          => getCurrencySymbol(),
            'status'            => Transaction::STATUS_COMPLETE,
        ]);
        return $transaction;
    }

    private function createTransactionWithPayTab(Appointment | Package $transactionable, $user, $amountInSAR, $description, $card_id)
    {
        $payTabs       = new PayTabsController();
        $currencySymbol= getCurrencySymbol();
        $paymentCharge = $payTabs->createTransaction([
            'tran_class'  => "ecom",
            'cart_id'     => json_encode($card_id),
            'description' => $description,
            'currency'    => $currencySymbol,
            'amount'      => $amountInSAR,
            'tokenize'    => time(),
        ]);

        $transaction = $transactionable->transactions()->create([
            'payment_charge_id' => $paymentCharge['tran_ref'],
            'amount'            => $amountInSAR,
            'description'       => $description,
            'user_id'           => $user->id,
            'currency'          => $currencySymbol,
            'status'            => Transaction::STATUS_HOLD,
        ]);
        return ['paymentCharge' => $paymentCharge, 'transaction' => $transaction];
    }
}
