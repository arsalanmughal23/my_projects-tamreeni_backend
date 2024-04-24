<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAppointmentAPIRequest;
use App\Http\Requests\API\UpdateAppointmentAPIRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Models\Package;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\UserSubscription;
use App\Repositories\AppointmentRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\UserSubscriptionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Repositories\PackageRepository;
use Response;
use Config;

/**
 * Class AppointmentController
 * @package App\Http\Controllers\API
 */
class AppointmentAPIController extends AppBaseController
{
    public function __construct(
        private PackageRepository $packageRepository, 
        private AppointmentRepository $appointmentRepository, 
        private TransactionRepository $transactionRepository, 
        private UserSubscriptionRepository $userSubscriptionRepository
    ){}

    /**
     * Display a listing of the Appointment.
     * GET|HEAD /appointments
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $perPage      = $request->input('per_page', Config::get('constants.PER_PAGE', 10));
        $appointments = $this->appointmentRepository->getAppointment($request->only('all_day_appointment', 'date', 'status'));

        // Paginate the results
        if ($request->get('paginate')) {
            $appointments = $appointments->orderBy('created_at', 'desc')->paginate($perPage);
        } else {
            $appointments = $appointments->get();
        }

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
        $input           = $request->all();
        $user            = $request->user();
        $type            = intval($input['type']);
        $profession_type = intval($input['profession_type']);
        $currency        = "SAR";
        $appointment = null;
        // Create transaction if it's a session appointment
        if ($type === Appointment::TYPE_SESSION) {

            $checkUserAppointment = $this->appointmentRepository
                ->checkUserAppointment($request->user()->id, $input['user_id'], $input['date']);

            if ($checkUserAppointment) {
                return $this->sendError('Already book appointment');
            }

            $input['amount'] = $this->calculateSessionFee($profession_type);
            $description     = "1-1 Session - Appointment Payment";

            $this->createTransaction($input['amount'], $user, $currency, $description, null, $input['payment_method_id']);
            $input['customer_id'] = $request->user()->id;
            $appointment          = $this->appointmentRepository->create($input);

        }

        // Create transaction if it's a package appointment
        if ($type === Appointment::TYPE_PACKAGE) {
            $currentPackage = $this->userSubscriptionRepository
                ->checkUserCurrentPackage($user->id, $input['package_id']);
            if ($currentPackage) {
                $input['package_id'] = $currentPackage->package_id;
                $this->updateUserSubscription($user->id, $input['package_id']);
            } else {
                $package         = Package::find($input['package_id'])->first();
                $input['amount'] = $package->amount;
                $description     = $package->description . ' ' . ' Package Purchase';

                $transactionId = $this->createTransaction($input['amount'], $user, $currency, $description, $input['package_id'], $input['payment_method_id']);
                $this->addUserSubscription($user->id, $input['package_id'], $transactionId, $package->sessions, 0);

                $appointments = $input['appointments'];
                foreach ($appointments as $key => $appointment) {

                    $this->updateUserSubscription($user->id, $input['package_id']);

                    $appointment['user_id']         = $input['user_id'];
                    $appointment['customer_id']     = $user->id;
                    $appointment['package_id']      = $input['package_id'];
                    $appointment['transaction_id']  = $transactionId;
                    $appointment['type']            = $type;
                    $appointment['profession_type'] = $profession_type;
                    $appointment['amount']          = $input['amount'];
                    $appointment = $this->appointmentRepository->create($appointment);
                }
            }
        }

        return $this->sendResponse(new AppointmentResource($appointment), 'Appointment saved successfully');
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
        $appointment = $this->appointmentRepository->find($id);

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

        return $this->sendResponse(new AppointmentResource($appointment), 'Appointment updated successfully');
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

    private function addUserSubscription($user_id, $package_id, $transaction_id, $sessions, $take_session)
    {
        $userSubscription = [
            'user_id'           => $user_id,
            'package_id'        => $package_id,
            'transaction_id'    => $transaction_id,
            'sessions'          => $sessions,
            'complete_sessions' => $take_session,
            'status'            => UserSubscription::ACTIVE
        ];

        $this->userSubscriptionRepository->create($userSubscription);
    }

    private function updateUserSubscription($user_id, $package_id)
    {
        $userSubscription = $this->userSubscriptionRepository->checkUserCurrentPackage($user_id, $package_id);
        if ($userSubscription) {
            $userSubscription->complete_sessions += 1;
            if ($userSubscription->complete_sessions >= $userSubscription->sessions) {
                $userSubscription->status = 0;
            }
            $userSubscription->save();
        }
    }


}
