<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateWellnessTipAPIRequest;
use App\Http\Requests\API\UpdateWellnessTipAPIRequest;
use App\Models\WellnessTip;
use App\Repositories\WellnessTipRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\WellnessTipResource;
use Response;
use Config;
use DB;

/**
 * Class WellnessTipController
 * @package App\Http\Controllers\API
 */

class WellnessTipAPIController extends AppBaseController
{
    /** @var  WellnessTipRepository */
    private $wellnessTipRepository;

    public function __construct(WellnessTipRepository $wellnessTipRepo)
    {
        $this->wellnessTipRepository = $wellnessTipRepo;
    }

    /**
     * Display a listing of the WellnessTip.
     * GET|HEAD /wellness_tips
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $wellnessTips = $this->wellnessTipRepository->index($request);
        return $this->sendResponse(WellnessTipResource::collection($wellnessTips), 'Wellness Tips retrieved successfully');
    }

    /**
     * Store a newly created WellnessTip in storage.
     * POST /wellness_tips
     *
     * @param CreateWellnessTipAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateWellnessTipAPIRequest $request)
    {
        $input = $request->all();

        $wellnessTip = $this->wellnessTipRepository->create($input);

        return $this->sendResponse($wellnessTip->toArray(), 'Wellness Tip saved successfully');
    }

    /**
     * Display the specified WellnessTip.
     * GET|HEAD /wellness_tips/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var WellnessTip $wellnessTip */
        $wellnessTip = $this->wellnessTipRepository->find($id);

        if (empty($wellnessTip)) {
            return $this->sendError('Wellness Tip not found');
        }

        return $this->sendResponse(new WellnessTipResource($wellnessTip), 'Wellness Tip retrieved successfully');
    }

    /**
     * Update the specified WellnessTip in storage.
     * PUT/PATCH /wellness_tips/{id}
     *
     * @param int $id
     * @param UpdateWellnessTipAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateWellnessTipAPIRequest $request)
    {
        $input = $request->all();

        /** @var WellnessTip $wellnessTip */
        $wellnessTip = $this->wellnessTipRepository->find($id);

        if (empty($wellnessTip)) {
            return $this->sendError('Wellness Tip not found');
        }

        $wellnessTip = $this->wellnessTipRepository->update($input, $id);

        return $this->sendResponse($wellnessTip->toArray(), 'WellnessTip updated successfully');
    }

    /**
     * Remove the specified WellnessTip from storage.
     * DELETE /wellness_tips/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var WellnessTip $wellnessTip */
        $wellnessTip = $this->wellnessTipRepository->find($id);

        if (empty($wellnessTip)) {
            return $this->sendError('Wellness Tip not found');
        }

        $wellnessTip->delete();

        return $this->sendSuccess('Wellness Tip deleted successfully');
    }
}
