<?php

namespace App\Http\Controllers;

use App\DataTables\PromoCodeDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePromoCodeRequest;
use App\Http\Requests\UpdatePromoCodeRequest;
use App\Repositories\PromoCodeRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class PromoCodeController extends AppBaseController
{
    /** @var PromoCodeRepository $promoCodeRepository*/
    private $promoCodeRepository;

    public function __construct(PromoCodeRepository $promoCodeRepo)
    {
        $this->promoCodeRepository = $promoCodeRepo;
    }

    /**
     * Display a listing of the PromoCode.
     *
     * @param PromoCodeDataTable $promoCodeDataTable
     *
     * @return Response
     */
    public function index(PromoCodeDataTable $promoCodeDataTable)
    {
        return $promoCodeDataTable->render('promo_codes.index');
    }

    /**
     * Show the form for creating a new PromoCode.
     *
     * @return Response
     */
    public function create()
    {
        return view('promo_codes.create');
    }

    /**
     * Store a newly created PromoCode in storage.
     *
     * @param CreatePromoCodeRequest $request
     *
     * @return Response
     */
    public function store(CreatePromoCodeRequest $request)
    {
        $input = $request->all();

        $promoCode = $this->promoCodeRepository->create($input);

        Flash::success('Promo Code saved successfully.');

        return redirect(route('promo_codes.index'));
    }

    /**
     * Display the specified PromoCode.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $promoCode = $this->promoCodeRepository->find($id);

        if (empty($promoCode)) {
            Flash::error('Promo Code not found');

            return redirect(route('promo_codes.index'));
        }

        return view('promo_codes.show')->with('promoCode', $promoCode);
    }

    /**
     * Show the form for editing the specified PromoCode.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $promoCode = $this->promoCodeRepository->find($id);

        if (empty($promoCode)) {
            Flash::error('Promo Code not found');

            return redirect(route('promo_codes.index'));
        }

        return view('promo_codes.edit')->with('promoCode', $promoCode);
    }

    /**
     * Update the specified PromoCode in storage.
     *
     * @param int $id
     * @param UpdatePromoCodeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePromoCodeRequest $request)
    {
        $promoCode = $this->promoCodeRepository->find($id);

        if (empty($promoCode)) {
            Flash::error('Promo Code not found');

            return redirect(route('promo_codes.index'));
        }

        $promoCode = $this->promoCodeRepository->update($request->all(), $id);

        Flash::success('Promo Code updated successfully.');

        return redirect(route('promo_codes.index'));
    }

    /**
     * Remove the specified PromoCode from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $promoCode = $this->promoCodeRepository->find($id);

        if (empty($promoCode)) {
            Flash::error('Promo Code not found');

            return redirect(route('promo_codes.index'));
        }

        $this->promoCodeRepository->delete($id);

        Flash::success('Promo Code deleted successfully.');

        return redirect(route('promo_codes.index'));
    }
}
