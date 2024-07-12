<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TaskReviewService;

class TaskDeadlineReview extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:review';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reviews all tasks and notifies each task assignee concerning deadlines';

    /**
     * Execute the console command.
     */
    public function handle(TaskReviewService $taskReviewService)
    {
        $taskReviewService->check_deadlines();

    }
}
