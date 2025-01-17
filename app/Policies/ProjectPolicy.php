<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{

    public function before(User $user)
    {
        if($user->roles->contains('name', 'admin')) {
            return true;
        }
        return null;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Project $project): bool
    {
        return $user->roles
                ? Response::allow()
                : Response::deny('Unsufficient permissions. Only the management can create a project.');         //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->roles->contains('name', 'manager')
                ? Response::allow()
                : Response::deny('Unsufficient permissions. Only the management can create a project.'); 
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Project $project): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Project $project): Response
    {
        Response::deny('Unsufficient permissions. Only the management can create a project.'); 
    }

}
