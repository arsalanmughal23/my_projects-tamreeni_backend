<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateConstantAPIRequest;
use App\Http\Requests\API\UpdateConstantAPIRequest;
use App\Models\Constant;
use App\Repositories\ConstantRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ConstantController
 * @package App\Http\Controllers\API
 */

class ConstantAPIController extends AppBaseController
{
    /** @var  ConstantRepository */
    private $constantRepository;

    public function __construct(ConstantRepository $constantRepo)
    {
        $this->constantRepository = $constantRepo;
    }

    /**
     * Display a listing of the Constant.
     * GET|HEAD /constants
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $constants = $this->constantRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($constants->toArray(), 'Constants retrieved successfully');
    }

    /**
     * Store a newly created Constant in storage.
     * POST /constants
     *
     * @param CreateConstantAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateConstantAPIRequest $request)
    {
        $input = $request->all();

        $constant = $this->constantRepository->create($input);

        return $this->sendResponse($constant->toArray(), 'Constant saved successfully');
    }

    /**
     * Display the specified Constant.
     * GET|HEAD /constants/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var Constant $constant */
        $constant = $this->constantRepository->find($id);

        if (empty($constant)) {
            return $this->sendError('Constant not found');
        }

        return $this->sendResponse($constant->toArray(), 'Constant retrieved successfully');
    }

    /**
     * Update the specified Constant in storage.
     * PUT/PATCH /constants/{id}
     *
     * @param int $id
     * @param UpdateConstantAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateConstantAPIRequest $request)
    {
        $input = $request->all();

        /** @var Constant $constant */
        $constant = $this->constantRepository->find($id);

        if (empty($constant)) {
            return $this->sendError('Constant not found');
        }

        $constant = $this->constantRepository->update($input, $id);

        return $this->sendResponse($constant->toArray(), 'Constant updated successfully');
    }

    /**
     * Remove the specified Constant from storage.
     * DELETE /constants/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var Constant $constant */
        $constant = $this->constantRepository->find($id);

        if (empty($constant)) {
            return $this->sendError('Constant not found');
        }

        $constant->delete();

        return $this->sendSuccess('Constant deleted successfully');
    }
}
