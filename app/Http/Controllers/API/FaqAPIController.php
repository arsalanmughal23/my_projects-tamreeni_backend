<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFaqAPIRequest;
use App\Http\Requests\API\UpdateFaqAPIRequest;
use App\Models\Faq;
use App\Repositories\FaqRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\FaqResource;
use Response;
use Config;
use DB;

/**
 * Class FaqController
 * @package App\Http\Controllers\API
 */

class FaqAPIController extends AppBaseController
{
    public $faqNotFound = 'FAQ not found';
    /** @var  FaqRepository */
    private $faqRepository;

    public function __construct(FaqRepository $faqRepo)
    {
        $this->faqRepository = $faqRepo;
    }

    /**
     * Display a listing of the Faq.
     * GET|HEAD /faqs
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {

        $perPage = $request->input('per_page', Config::get('constants.PER_PAGE', 10));
        $faqsQuery = $this->faqRepository->faqsQuery()->where('status', 1);

        // Paginate the results
        $perPage = $request->get('per_page', config('constants.PER_PAGE'));
        if ($request->get('is_paginate')) {
            $faqsQuery = $faqsQuery->paginate($perPage);
        } else {
            $faqsQuery = $faqsQuery->get();
        }

        return $this->sendResponse(FaqResource::collection($faqsQuery), 'FAQs retrieved successfully');

    }

    /**
     * Store a newly created Faq in storage.
     * POST /faqs
     *
     * @param CreateFaqAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateFaqAPIRequest $request)
    {
        try {
        DB::beginTransaction();
        $input = $request->all();

        $faq = $this->faqRepository->create($input);

        DB::commit();
        return $this->sendResponse(new FaqResource($faq), 'Faq saved successfully');
    } catch (\Exception $e) {
        DB::rollback();
        return $this->sendError($e->getMessage(), 422);
    }
    }

    /**
     * Display the specified Faq.
     * GET|HEAD /faqs/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var Faq $faq */
        $faq = $this->faqRepository->find($id);

        if (empty($faq)) {
            return $this->sendError($this->faqNotFound, 200);
        }

        return $this->sendResponse(new FaqResource($faq), 'Faq retrieved successfully');
    }

    /**
     * Update the specified Faq in storage.
     * PUT/PATCH /faqs/{id}
     *
     * @param int $id
     * @param UpdateFaqAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateFaqAPIRequest $request)
    {
        try {
            DB::beginTransaction();
        $input = $request->all();

        /** @var Faq $faq */
        $faq = $this->faqRepository->find($id);

        if (empty($faq)) {
            return $this->sendError($this->faqNotFound, 200);
        }

        $faq = $this->faqRepository->update($input, $id);

        DB::commit();
        return $this->sendResponse(new FaqResource($faq), 'Faq updated successfully');
    } catch (\Exception $e) {
        DB::rollback();
        return $this->sendError($e->getMessage(), 422);
    }
    }

    /**
     * Remove the specified Faq from storage.
     * DELETE /faqs/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
        /** @var Faq $faq */
        $faq = $this->faqRepository->find($id);

        if (empty($faq)) {
            return $this->sendError($this->faqNotFound, 200);
        }

        $faq->delete();

        DB::commit();
        return $this->sendResponse(new \stdClass(), 'Faq deleted successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->sendError($e->getMessage(), 422);
        }
    }
}
