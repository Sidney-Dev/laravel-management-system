<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectsController extends Controller
{

    // displays the form to create a new project
    public function create() {
        return view('dashboard.projects.create-project');
    }

    public function store() {
        return "";
    }
}
