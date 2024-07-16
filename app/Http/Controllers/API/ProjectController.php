<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectCollection;
use App\Http\Resources\ProjectResource;
use App\Http\Requests\ProjectCreation;
use Illuminate\Http\Request;
use App\Models\Project;

/**
 * Provide consumers the ability to create, view(by id), update, and delete projects
 * 
 * @middleware rules: Only admins and managers can create projects
 */
class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::orderBy('id', 'desc')->get();

        return response()->json([
            'projects' => new ProjectCollection($projects)
        ], 200);
    }

    // save records of a project
    public function store(ProjectCreation $request) {

        $authorised = Gate::denies('create', Project::class);
        if($authorised) return response()->json([
            'success' => false,
            'message' => 'permission denied'
        ], 403);

        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'description' => 'nullable|string',
                'priority' => 'required|in:low,medium,urgent',
            ]);

            if($validator->fails()) return response()->json([
                'error' => $validator->errors(),
                'message' => 'validation error',
            ], 400);

            $validated = $validator->validated();

            $createdProject = Project::create($validated);

            return response()->json([
                'success' => true,
                'project' => new ProjectResource($createdProject),
            ], 201);

        } catch(\Exception $error) {
            return response()->json([
                'success' => false,
                'message' => $error->getMessage(),
            ]);
        }
    }

    /**
     * deletes a single project
     * Only admins can delete projects
     *
     * @param Request $request
     * @param Project $project
     * @return json response
     */
    public function destroy(Request $request, Project $project) {

        $gate = Gate::inspect('delete', $project);
        if(!$gate->allowed()) return response()->json([
            'success' => false,
            'message' => $gate->message(),
        ], 400);
        
        $project->delete();

        return response()->json([
            'success' => true,
            'message' => 'Project deleted'
        ], 200);

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
