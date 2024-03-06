<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFavouriteAPIRequest;
use App\Http\Requests\API\UserFavouritesAPIRequest;
use App\Http\Requests\API\UpdateFavouriteAPIRequest;
use App\Models\Favourite;
use App\Models\Meal;
use App\Repositories\FavouriteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\Exercise;
use Response;
use Config;
use DB;

/**
 * Class FavouriteController
 * @package App\Http\Controllers\API
 */

class FavouriteAPIController extends AppBaseController
{
    /** @var  FavouriteRepository */
    private $favouriteRepository;

    public function __construct(FavouriteRepository $favouriteRepo)
    {
        $this->favouriteRepository = $favouriteRepo;
    }

    /**
     * Display a listing of the Favourite.
     * GET|HEAD /favourites
     *
     * @param Request $request
     * @return Response
     */


public function index(UserFavouritesAPIRequest $request)
{
    $perPage = $request->input('per_page', Config::get('constants.PER_PAGE', 10));

    // Get the authenticated user
    $user = auth()->user();
    $type = $request->get('type');
    if ($type == 'meal') {
        $favouritesQuery = $this->favouriteRepository->favMealQuery($user->id);
    } elseif ($type == 'exercise') {
        $favouritesQuery = $this->favouriteRepository->favExerciseQuery($user->id);
    }

    $favourites = $favouritesQuery->paginate($perPage);
    if ($favourites->isEmpty()) {
        return $this->sendError('Favourites not found', 200);
    }

    return $this->sendResponse($favourites->toArray(), 'Favourites retrieved successfully');
}


    /**
     * Store a newly created Favourite in storage.
     * POST /favourites
     *
     * @param CreateFavouriteAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateFavouriteAPIRequest $request)
    {
        $input = $request->all();

        $favourite = $this->favouriteRepository->create($input);

        return $this->sendResponse($favourite->toArray(), 'Favourite saved successfully');
    }

    /**
     * Display the specified Favourite.
     * GET|HEAD /favourites/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var Favourite $favourite */
        $favourite = $this->favouriteRepository->find($id);

        if (empty($favourite)) {
            return $this->sendError('Favourite not found');
        }

        return $this->sendResponse($favourite->toArray(), 'Favourite retrieved successfully');
    }

    /**
     * Update the specified Favourite in storage.
     * PUT/PATCH /favourites/{id}
     *
     * @param int $id
     * @param UpdateFavouriteAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateFavouriteAPIRequest $request)
    {
        $input = $request->all();

        /** @var Favourite $favourite */
        $favourite = $this->favouriteRepository->find($id);

        if (empty($favourite)) {
            return $this->sendError('Favourite not found');
        }

        $favourite = $this->favouriteRepository->update($input, $id);

        return $this->sendResponse($favourite->toArray(), 'Favourite updated successfully');
    }

    /**
     * Remove the specified Favourite from storage.
     * DELETE /favourites/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var Favourite $favourite */
        $favourite = $this->favouriteRepository->find($id);

        if (empty($favourite)) {
            return $this->sendError('Favourite not found');
        }

        $favourite->delete();

        return $this->sendSuccess('Favourite deleted successfully');
    }

    public function markAsFavorite(CreateFavouriteAPIRequest $request)
    {
        $user = auth()->user();
        $favouritableId = $request->input('favouritable_id');
        $favouritableType = $request->input('favouritable_type');

        $favouritableObj = match($favouritableType){
            Favourite::MORPH_TYPE_MEAL => Meal::find($favouritableId),
            Favourite::MORPH_TYPE_EXERCISE => Exercise::find($favouritableId),
        };

        if(!$favouritableObj)
            return $this->sendError('Record not found');

        // Check if the meal is already marked as a favorite
        $existingFavorite = Favourite::where('user_id', $user->id)
            ->where('favouritable_id', $favouritableId)
            ->where('favouritable_type', $favouritableType)
            ->first();

        if ($existingFavorite) {
            // Meal is already marked as favorite, unmark it
            $existingFavorite->delete();
            return $this->sendResponse(new \stdClass(), 'Removed from favorites');
        }

        // Meal is not marked as favorite, mark it
        Favourite::create([
            'user_id' => $user->id,
            'favouritable_id' => $favouritableId,
            'favouritable_type' => $favouritableType,
        ]);

        return $this->sendResponse(new \stdClass(), 'Added to favorites');
    }
}
