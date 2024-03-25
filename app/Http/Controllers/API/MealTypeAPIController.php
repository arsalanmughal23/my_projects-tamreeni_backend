<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMealTypeAPIRequest;
use App\Http\Requests\API\UpdateMealTypeAPIRequest;
use App\Http\Resources\MealTypeResource;
use App\Models\MealType;
use App\Repositories\MealTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Config;
/**
 * Class MealTypeController
 * @package App\Http\Controllers\API
 */

class MealTypeAPIController extends AppBaseController
{
    /** @var  MealTypeRepository */
    private $mealTypeRepository;

    public function __construct(MealTypeRepository $mealTypeRepo)
    {
        $this->mealTypeRepository = $mealTypeRepo;
    }

    /**
     * Display a listing of the MealType.
     * GET|HEAD /meal_types
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $perPage      = $request->input('per_page', Config::get('constants.PER_PAGE', 10));
        $meal_types = $this->mealTypeRepository->getMealTypes($request->only('status'));

        // Paginate the results
        if ($request->get('paginate')) {
            $meal_types = $meal_types->orderBy('created_at', 'desc')->paginate($perPage);
        } else {
            $meal_types = $meal_types->get();
        }

        return $this->sendResponse(MealTypeResource::collection($meal_types), 'Meal Types retrieved successfully');
    }

    /**
     * Store a newly created MealType in storage.
     * POST /meal_types
     *
     * @param CreateMealTypeAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateMealTypeAPIRequest $request)
    {
        $input = $request->all();

        $mealType = $this->mealTypeRepository->create($input);

        return $this->sendResponse($mealType->toArray(), 'Meal Type saved successfully');
    }

    /**
     * Display the specified MealType.
     * GET|HEAD /meal_types/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var MealType $mealType */
        $mealType = $this->mealTypeRepository->find($id);

        if (empty($mealType)) {
            return $this->sendError('Meal Type not found');
        }

        return $this->sendResponse($mealType->toArray(), 'Meal Type retrieved successfully');
    }

    /**
     * Update the specified MealType in storage.
     * PUT/PATCH /meal_types/{id}
     *
     * @param int $id
     * @param UpdateMealTypeAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateMealTypeAPIRequest $request)
    {
        $input = $request->all();

        /** @var MealType $mealType */
        $mealType = $this->mealTypeRepository->find($id);

        if (empty($mealType)) {
            return $this->sendError('Meal Type not found');
        }

        $mealType = $this->mealTypeRepository->update($input, $id);

        return $this->sendResponse($mealType->toArray(), 'MealType updated successfully');
    }

    /**
     * Remove the specified MealType from storage.
     * DELETE /meal_types/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var MealType $mealType */
        $mealType = $this->mealTypeRepository->find($id);

        if (empty($mealType)) {
            return $this->sendError('Meal Type not found');
        }

        $mealType->delete();

        return $this->sendSuccess('Meal Type deleted successfully');
    }
}
