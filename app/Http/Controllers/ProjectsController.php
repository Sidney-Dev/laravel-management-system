<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ProjectCreation;
use App\Http\Requests\ProjectUpdate;
use App\Models\Project;

class ProjectsController extends Controller
{

    // displays the form to create a new project
    public function create() {

        $response = Gate::inspect('create', Project::class);
        if(!$response->allowed()) {
            return redirect()->route('dashboard')->with('error', 'You cannot create a Project');
        } 

        return view('dashboard.projects.create-project');
    }

    // save records of a project
    public function store(ProjectCreation $request) {

        $response = Gate::inspect('create', Project::class);
        if(!$response->allowed()) {
            return redirect()->back()->with('error', 'Invalid permission');
        } 

        $createdProject = Project::create($request->validated());
        return redirect()->route('project.index')->withSuccess('Project successfully created');

    }

    // displays all projects
    public function index() {

        $projects = Project::all();
        
        return view('dashboard.projects.index')->with(['projects' => $projects]);
    }

    // deletes a single project
    public function delete(Request $request, Project $project) {

        $project->delete();

        return redirect()->back()->withSuccess("The Project was successfully deleted");

    }

    // displays the view with project update form
    public function edit(Project $project) {

        return view('dashboard.projects.update-project')->with('project', $project);

    }

    // updates a project
    public function update(ProjectUpdate $request, Project $project) {

        $project->name = $request->name;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->description = $request->description;
        $project->priority = $request->priority;

        if($project->isDirty()) {
            $project->save();

            return redirect()->back()->withSuccess('Project data successfully updated.');
        }

        return redirect()->back()->withSuccess('Nothing to update.');

    }
}
