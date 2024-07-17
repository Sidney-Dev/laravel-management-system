<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\UserResource;

class TaskCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->transform(function($task) {
            return [
                'id' => $task->id,
                'name' => $task->name,
                'start_date' => $task->start_date,
                'end_date' => $task->end_date,
                'description' => $task->description,
                'assigneed' => new UserResource($task->owner),
            ];
        })->toArray();
    }
}
