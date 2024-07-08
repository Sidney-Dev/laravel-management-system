<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectsController extends Controller
{

    // displays the form to create a new project
    public function create() {
        return view('dashboard.projects.create-project');
    }

    // save records of a project
    public function store(Request $request) {

        $validated_project = $request->validate([
            'name' => 'required|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'priority' => 'required'
        ]);

        $createdProject = Project::create($validated_project);

        return $createdProject;
    }
}
