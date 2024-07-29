<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMembershipDurationAPIRequest;
use App\Http\Requests\API\UpdateMembershipDurationAPIRequest;
use App\Models\MembershipDuration;
use App\Repositories\MembershipDurationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\MembershipDurationResource;
use App\Models\PromoCode;
use App\Repositories\PromoCodeRepository;
use App\Repositories\UsedPromoCodeRepository;
use Response;

/**
 * Class MembershipDurationController
 * @package App\Http\Controllers\API
 */

class MembershipDurationAPIController extends AppBaseController
{
    /** @var  MembershipDurationRepository */

    public function __construct(
        public MembershipDurationRepository $membershipDurationRepository,
        public PromoCodeRepository $promoCodeRepository,
        public UsedPromoCodeRepository $usedPromoCodeRepository,
    ) {}

    /**
     * Display a listing of the MembershipDuration.
     * GET|HEAD /membership_durations
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $user = $request->user();
        $membership_durations = $this->membershipDurationRepository->getRecords($request)->get();

        $requestPromoCode = $request->get('code');
        $promoCode = null;
        if ($requestPromoCode) {
            $promoCodePrams = ['code' => $requestPromoCode, 'status' => 'active'];
            $promoCode = $this->promoCodeRepository->where($promoCodePrams)->orderBy('created_at', 'desc')->first();
        }

        if ($promoCode) {
            $isPromoCodeUsed = $this->usedPromoCodeRepository->where(['user_id' => $user->id, 'code' => $promoCode->code])->exists();

            if(!$isPromoCodeUsed) {
                $membership_durations->map(function($duration) use ($promoCode) {
                    return $this->membershipDurationRepository->getPriceByPromoCode($promoCode, $duration);
                });
            }
        }

        return $this->sendResponse(MembershipDurationResource::collection($membership_durations), 'Membership Durations retrieved successfully');
    }

    /**
     * Store a newly created MembershipDuration in storage.
     * POST /membership_durations
     *
     * @param CreateMembershipDurationAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateMembershipDurationAPIRequest $request)
    {
        $input = $request->all();

        $membershipDuration = $this->membershipDurationRepository->create($input);

        return $this->sendResponse($membershipDuration->toArray(), 'Membership Duration saved successfully');
    }

    /**
     * Display the specified MembershipDuration.
     * GET|HEAD /membership_durations/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var MembershipDuration $membershipDuration */
        $membershipDuration = $this->membershipDurationRepository->find($id);

        if (empty($membershipDuration)) {
            return $this->sendError('Membership Duration not found');
        }

        return $this->sendResponse($membershipDuration->toArray(), 'Membership Duration retrieved successfully');
    }

    /**
     * Update the specified MembershipDuration in storage.
     * PUT/PATCH /membership_durations/{id}
     *
     * @param int $id
     * @param UpdateMembershipDurationAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateMembershipDurationAPIRequest $request)
    {
        $input = $request->all();

        /** @var MembershipDuration $membershipDuration */
        $membershipDuration = $this->membershipDurationRepository->find($id);

        if (empty($membershipDuration)) {
            return $this->sendError('Membership Duration not found');
        }

        $membershipDuration = $this->membershipDurationRepository->update($input, $id);

        return $this->sendResponse($membershipDuration->toArray(), 'MembershipDuration updated successfully');
    }

    /**
     * Remove the specified MembershipDuration from storage.
     * DELETE /membership_durations/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var MembershipDuration $membershipDuration */
        $membershipDuration = $this->membershipDurationRepository->find($id);

        if (empty($membershipDuration)) {
            return $this->sendError('Membership Duration not found');
        }

        $membershipDuration->delete();

        return $this->sendSuccess('Membership Duration deleted successfully');
    }
}
