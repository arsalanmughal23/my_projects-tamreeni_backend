<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserMembershipAPIRequest;
use App\Http\Requests\API\UpdateUserMembershipAPIRequest;
use App\Models\UserMembership;
use App\Repositories\UserMembershipRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\PayTabsController;
use App\Http\Requests\API\PurchaseMembershipAPIRequest;
use App\Http\Resources\MembershipResource;
use App\Http\Resources\UserMembershipResource;
use App\Http\Resources\UserResource;
use App\Models\Membership;
use App\Models\PromoCode;
use App\Repositories\MembershipDurationRepository;
use App\Repositories\PromoCodeRepository;
use App\Repositories\UsedPromoCodeRepository;
use Carbon\Carbon;
use Error;
use Illuminate\Support\Facades\DB;
use Response;

/**
 * Class UserMembershipController
 * @package App\Http\Controllers\API
 */

class UserMembershipAPIController extends AppBaseController
{
    /** @var  UserMembershipRepository */

    public function __construct(
        private UserMembershipRepository $userMembershipRepository,
        private MembershipDurationRepository $membershipDurationRepository,
        private PromoCodeRepository $promoCodeRepository,
        private UsedPromoCodeRepository $usedPromoCodeRepository,
    ) {}

    // public function purchaseMembership(CreateAppointmentAPIRequest $request)
    public function purchaseMembership(PurchaseMembershipAPIRequest $request)
    {
        try {
            DB::beginTransaction();

            $user   = $request->user();
            $input  = $request->validated();

            $amountInSAR            = 0;
            $membershipDurationId   = $input['membership_duration_id'];
            $promoCode              = $input['code'] ?? null;
            $membershipDuration     = $this->membershipDurationRepository->find($membershipDurationId);
            $membership = $membershipDuration?->membership ?? null;

            if(!$membership || !$membershipDuration)
                throw new Error('Membership is not available');

            if($membership->status != Membership::CONST_STATUS_ACTIVE)
                throw new Error('Membership is inactive');

            if ($promoCode) {
                $promoCode = $this->promoCodeRepository->where('code', $promoCode)->orderBy('created_at', 'desc')->first();
                if(!$promoCode)
                    throw new Error('Promo code is not found');
                
                if($promoCode->status != PromoCode::STATUS_ACTIVE)
                   throw new Error('Promo code is inactive');
                
                $usedPromoCode = $this->usedPromoCodeRepository->where(['user_id' => $user->id, 'code' => $promoCode])->orderBy('created_at', 'desc')->exists();
                if($usedPromoCode)
                   throw new Error('You already used this promo code');
            }

            if(!$user->stripe_customer_id)
                $user->createStripeCustomer();
        
            $discount = $promoCode ? calcualteDiscountPrice($membershipDuration->price, $promoCode->type ?? null, $promoCode->value ?? null) : 0;
            $amountInSAR = number_format($membershipDuration->price - $discount, 2);

            $titleEn = $membership->getTranslation('title', 'en') . ' | ' . $membershipDuration->getTranslation('title', 'en');
            $titleAr = $membership->getTranslation('title', 'ar') . ' | ' . $membershipDuration->getTranslation('title', 'ar');
            $title = ['en' => $titleEn, 'ar' => $titleAr];
            $description = 'Purchase Membership';

            $transactionable = $user->userMemberships()->create([
                'promo_code_id' => $promoCode?->id ?? null,
                'promo_code'    => $promoCode?->code ?? null,
                'discount'      => $discount,
                'original_price'=> $membershipDuration->price,
                'charge_amount' => $amountInSAR,

                'title' => $title,
                'membership_id' => $membership->id,
                'membership_duration_id' => $membershipDuration->id,
                'duration_in_month' => $membershipDuration->duration_in_month,
                'expire_at' => Carbon::now()->addMonths($membershipDuration->duration_in_month),
                'status' => UserMembership::STATUS_HOLD,
            ]);

            $payTabController = new PayTabsController();
            $payTabsResponse = $payTabController->createTransactionWithPayTab($transactionable, $user, $amountInSAR, $description, $transactionable->id);
            $paymentCharge = $payTabsResponse['paymentCharge'];
            $redirect_url  = $paymentCharge['redirect_url'];
            $transaction   = $payTabsResponse['transaction'];

            $transactionable = $this->userMembershipRepository->with('transactions')->find($transactionable->id);
            DB::commit();

            $data = [
                'user_membership'  => new UserMembershipResource($transactionable),
                'redirect_url'  => $redirect_url,
            ];
            return $this->sendResponse($data, 'Membership request is created');
        } catch (\Error $e) {
            DB::rollback();
            return $this->sendError([$e->getMessage(), $e->getLine()], 403);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->sendError([$e->getMessage(), $e->getLine(), $e->getTrace()], 422);
        }
    }
    
    public function useMembershipTrail(Request $request)
    {
        try {

            $user = $request->user();
            if($user->trail_expire_at)
                throw new Error('You already avail your trail');

            $trailDays = config('constants.trail.days');
            $user->update(['trail_expire_at' => now()->addDays($trailDays)]);

            return $this->sendResponse(new UserResource($user), 'Your trail is started');

        } catch (\Error $e) {
            return $this->sendError($e->getMessage(), 403);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    /**
     * Display a listing of the UserMembership.
     * GET|HEAD /user_memberships
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $user_memberships = $this->userMembershipRepository->all();

        return $this->sendResponse($user_memberships->toArray(), 'User Memberships retrieved successfully');
    }

    /**
     * Store a newly created UserMembership in storage.
     * POST /user_memberships
     *
     * @param CreateUserMembershipAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateUserMembershipAPIRequest $request)
    {
        $input = $request->all();

        $userMembership = $this->userMembershipRepository->create($input);

        return $this->sendResponse($userMembership->toArray(), 'User Membership saved successfully');
    }

    /**
     * Display the specified UserMembership.
     * GET|HEAD /user_memberships/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var UserMembership $userMembership */
        $userMembership = UserMembership::find($id);

        if (!$userMembership)
            return $this->sendError('User Membership not found');

        return $this->sendResponse($userMembership->toArray(), 'User Membership retrieved successfully');
    }

    /**
     * Update the specified UserMembership in storage.
     * PUT/PATCH /user_memberships/{id}
     *
     * @param int $id
     * @param UpdateUserMembershipAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateUserMembershipAPIRequest $request)
    {
        $input = $request->all();

        /** @var UserMembership $userMembership */
        $userMembership = $this->userMembershipRepository->find($id);

        if (empty($userMembership)) {
            return $this->sendError('User Membership not found');
        }

        $userMembership = $this->userMembershipRepository->update($input, $id);

        return $this->sendResponse($userMembership->toArray(), 'UserMembership updated successfully');
    }

    /**
     * Remove the specified UserMembership from storage.
     * DELETE /user_memberships/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var UserMembership $userMembership */
        $userMembership = $this->userMembershipRepository->find($id);

        if (empty($userMembership)) {
            return $this->sendError('User Membership not found');
        }

        $userMembership->delete();

        return $this->sendSuccess('User Membership deleted successfully');
    }
}
