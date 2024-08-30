<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePromoCodeAPIRequest;
use App\Http\Requests\API\UpdatePromoCodeAPIRequest;
use App\Models\PromoCode;
use App\Repositories\PromoCodeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CheckPromoCodeAPIRequest;
use App\Http\Resources\MembershipResource;
use App\Models\Membership;
use App\Models\MembershipDuration;
use App\Repositories\MembershipDurationRepository;
use App\Repositories\MembershipRepository;
use App\Repositories\UsedPromoCodeRepository;
use Error;
use Response;

/**
 * Class PromoCodeController
 * @package App\Http\Controllers\API
 */

class PromoCodeAPIController extends AppBaseController
{
    /** @var  PromoCodeRepository */

    public function __construct(
        private PromoCodeRepository $promoCodeRepository,
        private UsedPromoCodeRepository $usedPromoCodeRepository,
        private MembershipRepository $membershipRepository,
        private MembershipDurationRepository $membershipDurationRepository,
    ) {}

    public function checkPromoCode(CheckPromoCodeAPIRequest $request)
    {
        try {
            $user   = $request->user();
            $promoCode = $this->promoCodeRepository->where('code', $request->code)->orderBy('created_at', 'desc')->first();
            // $membershipDurationId = $request->get('membership_duration_id', null);

            if(!$promoCode)
                throw new Error('Promo code is not found');

            if($promoCode->status != PromoCode::STATUS_ACTIVE)
                throw new Error('Promo code is inactive');

            $usedPromoCode = $this->usedPromoCodeRepository->where(['email' => $user->email, 'code' => $promoCode->code, 'is_used' => 1])->exists();
            if($usedPromoCode)
                throw new Error('You already used this promo code');

            $membership = $this->membershipRepository->with('membershipDurations')->find($request->membership_id);
            if(!$membership)
                throw new Error('Membership is not found');

            if($membership->status != Membership::CONST_STATUS_ACTIVE)
                throw new Error('Membership is inactive');

            $membershipDurations = $membership->membershipDurations;
            $membershipDurations = $membershipDurations->map(function(MembershipDuration $duration) use ($promoCode) {
                return $this->membershipDurationRepository->getPriceByPromoCode($promoCode, $duration);
            });
            $membership->membership_durations = $membershipDurations;

            return $this->sendResponse(new MembershipResource($membership), 'Promo code is valid');

        } catch (\Error $e) {
            return $this->sendError($e->getMessage(), 403);
        }
    }

    /**
     * Display a listing of the PromoCode.
     * GET|HEAD /promo_codes
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $promo_codes = $this->promoCodeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($promo_codes->toArray(), 'Promo Codes retrieved successfully');
    }

    /**
     * Store a newly created PromoCode in storage.
     * POST /promo_codes
     *
     * @param CreatePromoCodeAPIRequest $request
     *
     * @return Response
     */

    public function store(CreatePromoCodeAPIRequest $request)
    {
        $input = $request->all();

        $promoCode = $this->promoCodeRepository->create($input);

        return $this->sendResponse($promoCode->toArray(), 'Promo Code saved successfully');
    }

    /**
     * Display the specified PromoCode.
     * GET|HEAD /promo_codes/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var PromoCode $promoCode */
        $promoCode = $this->promoCodeRepository->find($id);

        if (empty($promoCode)) {
            return $this->sendError('Promo Code not found');
        }

        return $this->sendResponse($promoCode->toArray(), 'Promo Code retrieved successfully');
    }

    /**
     * Update the specified PromoCode in storage.
     * PUT/PATCH /promo_codes/{id}
     *
     * @param int $id
     * @param UpdatePromoCodeAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdatePromoCodeAPIRequest $request)
    {
        $input = $request->all();

        /** @var PromoCode $promoCode */
        $promoCode = $this->promoCodeRepository->find($id);

        if (empty($promoCode)) {
            return $this->sendError('Promo Code not found');
        }

        $promoCode = $this->promoCodeRepository->update($input, $id);

        return $this->sendResponse($promoCode->toArray(), 'PromoCode updated successfully');
    }

    /**
     * Remove the specified PromoCode from storage.
     * DELETE /promo_codes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var PromoCode $promoCode */
        $promoCode = $this->promoCodeRepository->find($id);

        if (empty($promoCode)) {
            return $this->sendError('Promo Code not found');
        }

        $promoCode->delete();

        return $this->sendSuccess('Promo Code deleted successfully');
    }
}
