<?php

namespace App\Services;

use Illuminate\Support\Facades\Notification;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use App\Notifications\TaskEndDateNotification;
use Illuminate\Support\Facades\Log;

class TaskReviewService {

    public function check_deadlines() {

        print("checking \n");
        $tasks = Task::with(['owner', 'project'])->get();

        foreach ($tasks as $task) {
    
            $end_date = Carbon::parse($task->end_date);
            $current_date = Carbon::now();
            $days_to_end_date = $current_date->diffInDays($end_date);
    
            if ($task->owner) {
                if ($days_to_end_date < 0) {
                    $message = "You have missed a deadline";
                    $task->owner->notify(new TaskEndDateNotification($task, $message));
                } elseif ($days_to_end_date >= 0 && $days_to_end_date < 2) {
                    $message = "Your deadline is today";
                    $task->owner->notify(new TaskEndDateNotification($task, $message));
                } elseif ($days_to_end_date >= 2 && $days_to_end_date < 3) {
                    $message = "Your deadline is approaching in 2 to 3 days";
                    $task->owner->notify(new TaskEndDateNotification($task, $message));
                } else {
                    $message = "You have more than 3 days until the deadline";
                }
            } else {
                Log::warning("User with ID {$task->owner_id} not found.");
            }
        }
        print("done \n");
    }
}
