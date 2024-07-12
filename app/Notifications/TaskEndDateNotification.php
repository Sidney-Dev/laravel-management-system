<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Task;

class TaskEndDateNotification extends Notification
{
    use Queueable;

    public $task;
    public $message;
    /**
     * Create a new notification instance.
     */
    public function __construct(Task $task, $message)
    {
        $this->task = $task;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $task_owner_name = $this->task->owner->name;
        $task_project = $this->task->project->name;
        $project_id = $this->task->project->id;
        $task_id = $this->task->id;

        return (new MailMessage)
                    ->greeting("Hello $task_owner_name ")
                    ->line("This is a reminder of your task on $task_project project")
                    ->line("$this->message")
                    ->action("View task here", route('task.edit', [$project_id, $task_id]))
                    ->line('Be in touch...');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
