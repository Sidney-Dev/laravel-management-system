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

        $createdProject = Project::create($request->validated());

        return redirect()->withSuccess('Project successfully created')->route('project.index');
    }

    // displays all projects
    public function index() {
        $projects = Project::all();
        
        return $projects;
    }
}
