<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOptionAPIRequest;
use App\Http\Requests\API\UpdateOptionAPIRequest;
use App\Models\Option;
use App\Repositories\OptionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class OptionController
 * @package App\Http\Controllers\API
 */

class OptionAPIController extends AppBaseController
{
    /** @var  OptionRepository */
    private $optionRepository;

    public function __construct(OptionRepository $optionRepo)
    {
        $this->optionRepository = $optionRepo;
    }

    /**
     * Display a listing of the Option.
     * GET|HEAD /options
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $options = $this->optionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($options->toArray(), 'Options retrieved successfully');
    }

    /**
     * Store a newly created Option in storage.
     * POST /options
     *
     * @param CreateOptionAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateOptionAPIRequest $request)
    {
        $input = $request->all();

        $option = $this->optionRepository->create($input);

        return $this->sendResponse($option->toArray(), 'Option saved successfully');
    }

    /**
     * Display the specified Option.
     * GET|HEAD /options/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var Option $option */
        $option = $this->optionRepository->find($id);

        if (empty($option)) {
            return $this->sendError('Option not found');
        }

        return $this->sendResponse($option->toArray(), 'Option retrieved successfully');
    }

    /**
     * Update the specified Option in storage.
     * PUT/PATCH /options/{id}
     *
     * @param int $id
     * @param UpdateOptionAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateOptionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Option $option */
        $option = $this->optionRepository->find($id);

        if (empty($option)) {
            return $this->sendError('Option not found');
        }

        $option = $this->optionRepository->update($input, $id);

        return $this->sendResponse($option->toArray(), 'Option updated successfully');
    }

    /**
     * Remove the specified Option from storage.
     * DELETE /options/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var Option $option */
        $option = $this->optionRepository->find($id);

        if (empty($option)) {
            return $this->sendError('Option not found');
        }

        $option->delete();

        return $this->sendSuccess('Option deleted successfully');
    }
}
