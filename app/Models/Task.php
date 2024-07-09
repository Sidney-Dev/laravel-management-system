<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\belongsTo;


class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'start_date', 'end_date', 'status', 'owner_id', 'project_id', 'reporter_id'
    ];

    // the employee that will be assigned the task
    public function owner(): belongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // the person whom the task is reported to
    public function reporter(): belongsTo
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    // the project which the task belongs to
    public function project(): belongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
