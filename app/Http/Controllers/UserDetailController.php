<?php

namespace App\Http\Controllers;

use App\DataTables\UserDetailDataTable;
use App\Helper\FileHelper;
use Illuminate\Http\Request;
use App\Repositories\UserDetailRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Constant;
use App\Repositories\OptionRepository;
use Response;

class UserDetailController extends AppBaseController
{
    /** @var UserDetailRepository $userDetailRepository*/

    public function __construct(
        private UserDetailRepository $userDetailRepository,
        private OptionRepository $optionRepository
    ) {}

    /**
     * Display a listing of the UserDetail.
     *
     * @param UserDetailDataTable $userDetailDataTable
     *
     * @return Response
     */
    public function index(UserDetailDataTable $userDetailDataTable)
    {
        return $userDetailDataTable->render('user_details.index');
    }

    /**
     * Show the form for creating a new UserDetail.
     *
     * @return Response
     */
    public function create()
    {
        $genders = $this->getSelectOptionData(Constant::CONST_GENDER);
        $languages = $this->getSelectOptionData(Constant::CONST_LANGUAGE);

        return view('user_details.create', compact('genders', 'languages'));
    }

    /**
     * Store a newly created UserDetail in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        if ($request->hasFile('image'))
            $input['image'] = FileHelper::s3Upload($input['image']);

        $userDetail = $this->userDetailRepository->create($input);

        Flash::success('User Detail saved successfully.');

        return redirect(route('user_details.index'));
    }

    /**
     * Display the specified UserDetail.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userDetail = $this->userDetailRepository->find($id);

        if (empty($userDetail)) {
            Flash::error('User Detail not found');

            return redirect(route('user_details.index'));
        }

        $personalStatistics = $this->userDetailRepository->getPersonalStatistics($userDetail);

        return view('user_details.show', compact('userDetail', 'personalStatistics'));
    }

    /**
     * Show the form for editing the specified UserDetail.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userDetail = $this->userDetailRepository->find($id);

        $genders = $this->getSelectOptionData(Constant::CONST_GENDER);
        $languages = $this->getSelectOptionData(Constant::CONST_LANGUAGE);

        if (empty($userDetail)) {
            Flash::error('User Detail not found');

            return redirect(route('user_details.index'));
        }

        return view('user_details.edit', compact('userDetail', 'genders', 'languages'));
    }

    /**
     * Update the specified UserDetail in storage.
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $userDetail = $this->userDetailRepository->find($id);
        $input = $request->all();

        if (empty($userDetail)) {
            Flash::error('User Detail not found');

            return redirect(route('user_details.index'));
        }

        if ($request->hasFile('image'))
            $input['image'] = FileHelper::s3Upload($input['image']);

        $userDetail = $this->userDetailRepository->update($input, $id);

        Flash::success('User Detail updated successfully.');

        return redirect(route('user_details.index'));
    }

    /**
     * Remove the specified UserDetail from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userDetail = $this->userDetailRepository->find($id);

        if (empty($userDetail)) {
            Flash::error('User Detail not found');

            return redirect(route('user_details.index'));
        }

        $this->userDetailRepository->delete($id);

        Flash::success('User Detail deleted successfully.');

        return redirect(route('user_details.index'));
    }

    public function getSelectOptionData($optionFor)
    {
        $optionList = match ($optionFor) {
            Constant::CONST_LANGUAGE => Constant::CONST_LANG_OPTS,
            Constant::CONST_GENDER => Constant::CONST_GENDER_OPTS,
            default => []
        };

        $options = array_reduce($optionList, function($acc, $option){
            $acc = [...$acc, $option => __('options.'.$option, [], 'en')];
            return $acc;
        }, []);

        // $options = array_map(function($option){
        //     return [$option => __('options.'.$option, [], 'en')];
        // }, $optionList);

        return $options;
    }
}
