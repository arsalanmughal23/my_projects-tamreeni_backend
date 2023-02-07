<?php

namespace App\Http\Controllers;

use App\DataTables\ProjectDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Repositories\ProjectRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Repositories\EmployeeRepository;

class ProjectController extends AppBaseController
{
    /** @var ProjectRepository $projectRepository*/
    private $projectRepository;

    public function __construct(ProjectRepository $projectRepo, EmployeeRepository $employeeRepo)
    {
        $this->projectRepository = $projectRepo;
        $this->employeeRepository = $employeeRepo;

    }

    /**
     * Display a listing of the Project.
     *
     * @param ProjectDataTable $projectDataTable
     *
     * @return Response
     */
    public function index(ProjectDataTable $projectDataTable)
    {
        return $projectDataTable->render('projects.index');
    }

    /**
     * Show the form for creating a new Project.
     *
     * @return Response
     */
    public function create()
    {
        $data['project_managers'] = $this->employeeRepository->role(1);
        $data['bussiness_analysts'] = $this->employeeRepository->role(2);

        return view('projects.create', $data);
    }

    /**
     * Store a newly created Project in storage.
     *
     * @param CreateProjectRequest $request
     *
     * @return Response
     */
    public function store(CreateProjectRequest $request)
    {
        $input = $request->all();

        $project = $this->projectRepository->create($input);

        Flash::success('Project saved successfully.');

        return redirect(route('projects.index'));
    }

    /**
     * Display the specified Project.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $project = $this->projectRepository->find($id);

        if (empty($project)) {
            Flash::error('Project not found');

            return redirect(route('projects.index'));
        }

        return view('projects.show')->with('project', $project);
    }

    /**
     * Show the form for editing the specified Project.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $project = $this->projectRepository->find($id);
        $project_managers = $this->employeeRepository->role(1);
        $bussiness_analysts = $this->employeeRepository->role(2);

        if (empty($project)) {
            Flash::error('Project not found');

            return redirect(route('projects.index'));
        }

        return view('projects.edit')->with('project', $project)
        ->with('project_managers', $project_managers)
        ->with('bussiness_analysts', $bussiness_analysts);
    }

    /**
     * Update the specified Project in storage.
     *
     * @param int $id
     * @param UpdateProjectRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProjectRequest $request)
    {
        $project = $this->projectRepository->find($id);

        if (empty($project)) {
            Flash::error('Project not found');

            return redirect(route('projects.index'));
        }

        $project = $this->projectRepository->update($request->all(), $id);

        Flash::success('Project updated successfully.');

        return redirect(route('projects.index'));
    }

    /**
     * Remove the specified Project from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $project = $this->projectRepository->find($id);

        if (empty($project)) {
            Flash::error('Project not found');

            return redirect(route('projects.index'));
        }

        $this->projectRepository->delete($id);

        Flash::success('Project deleted successfully.');

        return redirect(route('projects.index'));
    }
}
