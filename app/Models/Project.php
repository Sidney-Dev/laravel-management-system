<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\User;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    // the project belongs to a user
    public function owner(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
