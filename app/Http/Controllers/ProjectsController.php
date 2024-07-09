<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProjectCreation;
use App\Models\Project;

class ProjectsController extends Controller
{

    // displays the form to create a new project
    public function create() {
        return view('dashboard.projects.create-project');
    }

    // save records of a project
    public function store(ProjectCreation $request) {

        // return $request->all();

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
}
