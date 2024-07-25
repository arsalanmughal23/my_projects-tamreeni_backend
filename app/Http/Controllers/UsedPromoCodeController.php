<?php

namespace App\Http\Controllers;

use App\DataTables\UsedPromoCodeDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateUsedPromoCodeRequest;
use App\Http\Requests\UpdateUsedPromoCodeRequest;
use App\Repositories\UsedPromoCodeRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class UsedPromoCodeController extends AppBaseController
{
    /** @var UsedPromoCodeRepository $usedPromoCodeRepository*/
    private $usedPromoCodeRepository;

    public function __construct(UsedPromoCodeRepository $usedPromoCodeRepo)
    {
        $this->usedPromoCodeRepository = $usedPromoCodeRepo;
    }

    /**
     * Display a listing of the UsedPromoCode.
     *
     * @param UsedPromoCodeDataTable $usedPromoCodeDataTable
     *
     * @return Response
     */
    public function index(UsedPromoCodeDataTable $usedPromoCodeDataTable)
    {
        return $usedPromoCodeDataTable->render('used_promo_codes.index');
    }

    /**
     * Show the form for creating a new UsedPromoCode.
     *
     * @return Response
     */
    public function create()
    {
        return view('used_promo_codes.create');
    }

    /**
     * Store a newly created UsedPromoCode in storage.
     *
     * @param CreateUsedPromoCodeRequest $request
     *
     * @return Response
     */
    public function store(CreateUsedPromoCodeRequest $request)
    {
        $input = $request->all();

        $usedPromoCode = $this->usedPromoCodeRepository->create($input);

        Flash::success('Used Promo Code saved successfully.');

        return redirect(route('used_promo_codes.index'));
    }

    /**
     * Display the specified UsedPromoCode.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $usedPromoCode = $this->usedPromoCodeRepository->find($id);

        if (empty($usedPromoCode)) {
            Flash::error('Used Promo Code not found');

            return redirect(route('used_promo_codes.index'));
        }

        return view('used_promo_codes.show')->with('usedPromoCode', $usedPromoCode);
    }

    /**
     * Show the form for editing the specified UsedPromoCode.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $usedPromoCode = $this->usedPromoCodeRepository->find($id);

        if (empty($usedPromoCode)) {
            Flash::error('Used Promo Code not found');

            return redirect(route('used_promo_codes.index'));
        }

        return view('used_promo_codes.edit')->with('usedPromoCode', $usedPromoCode);
    }

    /**
     * Update the specified UsedPromoCode in storage.
     *
     * @param int $id
     * @param UpdateUsedPromoCodeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUsedPromoCodeRequest $request)
    {
        $usedPromoCode = $this->usedPromoCodeRepository->find($id);

        if (empty($usedPromoCode)) {
            Flash::error('Used Promo Code not found');

            return redirect(route('used_promo_codes.index'));
        }

        $usedPromoCode = $this->usedPromoCodeRepository->update($request->all(), $id);

        Flash::success('Used Promo Code updated successfully.');

        return redirect(route('used_promo_codes.index'));
    }

    /**
     * Remove the specified UsedPromoCode from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $usedPromoCode = $this->usedPromoCodeRepository->find($id);

        if (empty($usedPromoCode)) {
            Flash::error('Used Promo Code not found');

            return redirect(route('used_promo_codes.index'));
        }

        $this->usedPromoCodeRepository->delete($id);

        Flash::success('Used Promo Code deleted successfully.');

        return redirect(route('used_promo_codes.index'));
    }
}
