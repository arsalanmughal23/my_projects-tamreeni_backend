<?php

namespace App\Http\Controllers;

use App\DataTables\StackDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateStackRequest;
use App\Http\Requests\UpdateStackRequest;
use App\Repositories\StackRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class StackController extends AppBaseController
{
    /** @var StackRepository $stackRepository*/
    private $stackRepository;

    public function __construct(StackRepository $stackRepo)
    {
        $this->stackRepository = $stackRepo;
    }

    /**
     * Display a listing of the Stack.
     *
     * @param StackDataTable $stackDataTable
     *
     * @return Response
     */
    public function index(StackDataTable $stackDataTable)
    {
        return $stackDataTable->render('stacks.index');
    }

    /**
     * Show the form for creating a new Stack.
     *
     * @return Response
     */
    public function create()
    {
        return view('stacks.create');
    }

    /**
     * Store a newly created Stack in storage.
     *
     * @param CreateStackRequest $request
     *
     * @return Response
     */
    public function store(CreateStackRequest $request)
    {
        $input = $request->all();

        $stack = $this->stackRepository->create($input);

        Flash::success('Stack saved successfully.');

        return redirect(route('stacks.index'));
    }

    /**
     * Display the specified Stack.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $stack = $this->stackRepository->find($id);

        if (empty($stack)) {
            Flash::error('Stack not found');

            return redirect(route('stacks.index'));
        }

        return view('stacks.show')->with('stack', $stack);
    }

    /**
     * Show the form for editing the specified Stack.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $stack = $this->stackRepository->find($id);

        if (empty($stack)) {
            Flash::error('Stack not found');

            return redirect(route('stacks.index'));
        }

        return view('stacks.edit')->with('stack', $stack);
    }

    /**
     * Update the specified Stack in storage.
     *
     * @param int $id
     * @param UpdateStackRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStackRequest $request)
    {
        $stack = $this->stackRepository->find($id);

        if (empty($stack)) {
            Flash::error('Stack not found');

            return redirect(route('stacks.index'));
        }

        $stack = $this->stackRepository->update($request->all(), $id);

        Flash::success('Stack updated successfully.');

        return redirect(route('stacks.index'));
    }

    /**
     * Remove the specified Stack from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $stack = $this->stackRepository->find($id);

        if (empty($stack)) {
            Flash::error('Stack not found');

            return redirect(route('stacks.index'));
        }

        $this->stackRepository->delete($id);

        Flash::success('Stack deleted successfully.');

        return redirect(route('stacks.index'));
    }
}
