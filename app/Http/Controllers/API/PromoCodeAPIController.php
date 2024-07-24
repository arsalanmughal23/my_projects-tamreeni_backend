<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePromoCodeAPIRequest;
use App\Http\Requests\API\UpdatePromoCodeAPIRequest;
use App\Models\PromoCode;
use App\Repositories\PromoCodeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PromoCodeController
 * @package App\Http\Controllers\API
 */

class PromoCodeAPIController extends AppBaseController
{
    /** @var  PromoCodeRepository */
    private $promoCodeRepository;

    public function __construct(PromoCodeRepository $promoCodeRepo)
    {
        $this->promoCodeRepository = $promoCodeRepo;
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
