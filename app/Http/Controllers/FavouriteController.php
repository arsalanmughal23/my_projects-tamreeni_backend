<?php

namespace App\Http\Controllers;

use App\DataTables\FavouriteDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateFavouriteRequest;
use App\Http\Requests\UpdateFavouriteRequest;
use App\Repositories\FavouriteRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class FavouriteController extends AppBaseController
{
    /** @var FavouriteRepository $favouriteRepository*/
    private $favouriteRepository;

    public function __construct(FavouriteRepository $favouriteRepo)
    {
        $this->favouriteRepository = $favouriteRepo;
    }

    /**
     * Display a listing of the Favourite.
     *
     * @param FavouriteDataTable $favouriteDataTable
     *
     * @return Response
     */
    public function index(FavouriteDataTable $favouriteDataTable)
    {
        return $favouriteDataTable->render('favourites.index');
    }

    /**
     * Show the form for creating a new Favourite.
     *
     * @return Response
     */
    public function create()
    {
        return view('favourites.create');
    }

    /**
     * Store a newly created Favourite in storage.
     *
     * @param CreateFavouriteRequest $request
     *
     * @return Response
     */
    public function store(CreateFavouriteRequest $request)
    {
        $input = $request->all();

        $favourite = $this->favouriteRepository->create($input);

        Flash::success('Favourite saved successfully.');

        return redirect(route('favourites.index'));
    }

    /**
     * Display the specified Favourite.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $favourite = $this->favouriteRepository->find($id);

        if (empty($favourite)) {
            Flash::error('Favourite not found');

            return redirect(route('favourites.index'));
        }

        return view('favourites.show')->with('favourite', $favourite);
    }

    /**
     * Show the form for editing the specified Favourite.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $favourite = $this->favouriteRepository->find($id);

        if (empty($favourite)) {
            Flash::error('Favourite not found');

            return redirect(route('favourites.index'));
        }

        return view('favourites.edit')->with('favourite', $favourite);
    }

    /**
     * Update the specified Favourite in storage.
     *
     * @param int $id
     * @param UpdateFavouriteRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFavouriteRequest $request)
    {
        $favourite = $this->favouriteRepository->find($id);

        if (empty($favourite)) {
            Flash::error('Favourite not found');

            return redirect(route('favourites.index'));
        }

        $favourite = $this->favouriteRepository->update($request->all(), $id);

        Flash::success('Favourite updated successfully.');

        return redirect(route('favourites.index'));
    }

    /**
     * Remove the specified Favourite from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $favourite = $this->favouriteRepository->find($id);

        if (empty($favourite)) {
            Flash::error('Favourite not found');

            return redirect(route('favourites.index'));
        }

        $this->favouriteRepository->delete($id);

        Flash::success('Favourite deleted successfully.');

        return redirect(route('favourites.index'));
    }
}
