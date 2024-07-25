<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUsedPromoCodeAPIRequest;
use App\Http\Requests\API\UpdateUsedPromoCodeAPIRequest;
use App\Models\UsedPromoCode;
use App\Repositories\UsedPromoCodeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class UsedPromoCodeController
 * @package App\Http\Controllers\API
 */

class UsedPromoCodeAPIController extends AppBaseController
{
    /** @var  UsedPromoCodeRepository */
    private $usedPromoCodeRepository;

    public function __construct(UsedPromoCodeRepository $usedPromoCodeRepo)
    {
        $this->usedPromoCodeRepository = $usedPromoCodeRepo;
    }

    /**
     * Display a listing of the UsedPromoCode.
     * GET|HEAD /used_promo_codes
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $used_promo_codes = $this->usedPromoCodeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($used_promo_codes->toArray(), 'Used Promo Codes retrieved successfully');
    }

    /**
     * Store a newly created UsedPromoCode in storage.
     * POST /used_promo_codes
     *
     * @param CreateUsedPromoCodeAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateUsedPromoCodeAPIRequest $request)
    {
        $input = $request->all();

        $usedPromoCode = $this->usedPromoCodeRepository->create($input);

        return $this->sendResponse($usedPromoCode->toArray(), 'Used Promo Code saved successfully');
    }

    /**
     * Display the specified UsedPromoCode.
     * GET|HEAD /used_promo_codes/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var UsedPromoCode $usedPromoCode */
        $usedPromoCode = $this->usedPromoCodeRepository->find($id);

        if (empty($usedPromoCode)) {
            return $this->sendError('Used Promo Code not found');
        }

        return $this->sendResponse($usedPromoCode->toArray(), 'Used Promo Code retrieved successfully');
    }

    /**
     * Update the specified UsedPromoCode in storage.
     * PUT/PATCH /used_promo_codes/{id}
     *
     * @param int $id
     * @param UpdateUsedPromoCodeAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateUsedPromoCodeAPIRequest $request)
    {
        $input = $request->all();

        /** @var UsedPromoCode $usedPromoCode */
        $usedPromoCode = $this->usedPromoCodeRepository->find($id);

        if (empty($usedPromoCode)) {
            return $this->sendError('Used Promo Code not found');
        }

        $usedPromoCode = $this->usedPromoCodeRepository->update($input, $id);

        return $this->sendResponse($usedPromoCode->toArray(), 'UsedPromoCode updated successfully');
    }

    /**
     * Remove the specified UsedPromoCode from storage.
     * DELETE /used_promo_codes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var UsedPromoCode $usedPromoCode */
        $usedPromoCode = $this->usedPromoCodeRepository->find($id);

        if (empty($usedPromoCode)) {
            return $this->sendError('Used Promo Code not found');
        }

        $usedPromoCode->delete();

        return $this->sendSuccess('Used Promo Code deleted successfully');
    }
}
