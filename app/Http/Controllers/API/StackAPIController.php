<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStackAPIRequest;
use App\Http\Requests\API\UpdateStackAPIRequest;
use App\Models\Stack;
use App\Repositories\StackRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class StackController
 * @package App\Http\Controllers\API
 */

class StackAPIController extends AppBaseController
{
    /** @var  StackRepository */
    private $stackRepository;

    public function __construct(StackRepository $stackRepo)
    {
        $this->stackRepository = $stackRepo;
    }

    /**
     * Display a listing of the Stack.
     * GET|HEAD /stacks
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $stacks = $this->stackRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($stacks->toArray(), 'Stacks retrieved successfully');
    }

    /**
     * Store a newly created Stack in storage.
     * POST /stacks
     *
     * @param CreateStackAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateStackAPIRequest $request)
    {
        $input = $request->all();

        $stack = $this->stackRepository->create($input);

        return $this->sendResponse($stack->toArray(), 'Stack saved successfully');
    }

    /**
     * Display the specified Stack.
     * GET|HEAD /stacks/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var Stack $stack */
        $stack = $this->stackRepository->find($id);

        if (empty($stack)) {
            return $this->sendError('Stack not found');
        }

        return $this->sendResponse($stack->toArray(), 'Stack retrieved successfully');
    }

    /**
     * Update the specified Stack in storage.
     * PUT/PATCH /stacks/{id}
     *
     * @param int $id
     * @param UpdateStackAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateStackAPIRequest $request)
    {
        $input = $request->all();

        /** @var Stack $stack */
        $stack = $this->stackRepository->find($id);

        if (empty($stack)) {
            return $this->sendError('Stack not found');
        }

        $stack = $this->stackRepository->update($input, $id);

        return $this->sendResponse($stack->toArray(), 'Stack updated successfully');
    }

    /**
     * Remove the specified Stack from storage.
     * DELETE /stacks/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var Stack $stack */
        $stack = $this->stackRepository->find($id);

        if (empty($stack)) {
            return $this->sendError('Stack not found');
        }

        $stack->delete();

        return $this->sendSuccess('Stack deleted successfully');
    }
}
