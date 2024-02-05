<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBodyPartAPIRequest;
use App\Http\Requests\API\UpdateBodyPartAPIRequest;
use App\Models\BodyPart;
use App\Repositories\BodyPartRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class BodyPartController
 * @package App\Http\Controllers\API
 */

class BodyPartAPIController extends AppBaseController
{
    /** @var  BodyPartRepository */
    private $bodyPartRepository;

    public function __construct(BodyPartRepository $bodyPartRepo)
    {
        $this->bodyPartRepository = $bodyPartRepo;
    }

    /**
     * Display a listing of the BodyPart.
     * GET|HEAD /body_parts
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $body_parts = $this->bodyPartRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($body_parts->toArray(), 'Body Parts retrieved successfully');
    }

    /**
     * Store a newly created BodyPart in storage.
     * POST /body_parts
     *
     * @param CreateBodyPartAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateBodyPartAPIRequest $request)
    {
        $input = $request->all();

        $bodyPart = $this->bodyPartRepository->create($input);

        return $this->sendResponse($bodyPart->toArray(), 'Body Part saved successfully');
    }

    /**
     * Display the specified BodyPart.
     * GET|HEAD /body_parts/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var BodyPart $bodyPart */
        $bodyPart = $this->bodyPartRepository->find($id);

        if (empty($bodyPart)) {
            return $this->sendError('Body Part not found');
        }

        return $this->sendResponse($bodyPart->toArray(), 'Body Part retrieved successfully');
    }

    /**
     * Update the specified BodyPart in storage.
     * PUT/PATCH /body_parts/{id}
     *
     * @param int $id
     * @param UpdateBodyPartAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateBodyPartAPIRequest $request)
    {
        $input = $request->all();

        /** @var BodyPart $bodyPart */
        $bodyPart = $this->bodyPartRepository->find($id);

        if (empty($bodyPart)) {
            return $this->sendError('Body Part not found');
        }

        $bodyPart = $this->bodyPartRepository->update($input, $id);

        return $this->sendResponse($bodyPart->toArray(), 'BodyPart updated successfully');
    }

    /**
     * Remove the specified BodyPart from storage.
     * DELETE /body_parts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var BodyPart $bodyPart */
        $bodyPart = $this->bodyPartRepository->find($id);

        if (empty($bodyPart)) {
            return $this->sendError('Body Part not found');
        }

        $bodyPart->delete();

        return $this->sendSuccess('Body Part deleted successfully');
    }
}
