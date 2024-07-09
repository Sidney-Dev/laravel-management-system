<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TaskRequest;
use App\Notifications\TaskAssigned;

class TaskController extends Controller
{

    public function create(Project $project)
    {
        $employees = User::all();
        return view('dashboard.tasks.create', compact('employees', 'project'));
    }

    public function store(TaskRequest $request, Project $project)
    {
        $task = $project->tasks()->create($request->validated());

        return $task;

        if ($task->owner_id) {
            $owner = User::find($task->owner_id);
            $owner->notify(new TaskAssigned($task));
        }

        return redirect()->route('projects.show', $task->project_id)->withSuccess('Task created successfully.');
    }

    public function show(Project $project, Task $task)
    {
        return view('dashboard.tasks.show', compact('task'));
    }
}
