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

    // display the tasks that belong to the project parsed
    public function index(Project $project)
    {
        $tasks = $project->tasks()->get();
        return view('dashboard.tasks.index', compact('project', 'tasks'));
    }

    public function create(Project $project)
    {
        $employees = User::all();
        return view('dashboard.tasks.create', compact('employees', 'project'));
    }

    public function store(TaskRequest $request, Project $project)
    {
        $task = $project->tasks()->create($request->validated());

        if ($task->owner_id) {
            $owner = User::find($task->owner_id);
            $owner->notify(new TaskAssigned($task));
        }

        return redirect()->route('task.index', $task->project_id)->withSuccess('Task created successfully.');
    }

    // displays information of a single task
    public function show(Project $project, Task $task)
    {
        
    }

    public function edit(Project $project, Task $task)
    {
        $users = User::all();
        return view('dashboard.tasks.update', compact('task', 'users'));
    }

    // delete a project task
    public function delete(Request $request, Project $project, Task $task)
    {
        $task->delete();
        
        return redirect()->back()->withSuccess("task deleted");
    }

    // updated the task
    public function update(Request $request, Project $project, Task $task)
    {

        $validated_task = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:pending,in progress,in review,done,needs assistance',
            'assignee' => 'nullable'
        ]);

        $email_new_assignee = false;

        $task->name = $validated_task['name'];
        $task->description = $validated_task['description'];
        $task->start_date = $validated_task['start_date'];
        $task->end_date = $validated_task['end_date'];
        $task->status = $validated_task['status'];
        $task->owner_id = $validated_task['assignee'];

        if($task->isDirty('owner_id') && !empty($validated_task['assignee'])) {
            $email_new_assignee = true;
        }

        if($task->isDirty()) {
            $task->save();
        }


        if($email_new_assignee){
            /**
             * @todo send notification to the assignee concerning the task assigned to him
             */    
        }
        
        return redirect()->back()->withSuccess('Task updated successfully.');
    }
}
