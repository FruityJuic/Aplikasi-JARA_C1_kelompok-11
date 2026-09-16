<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskList;

class ProgressController extends Controller
{
    public function index(TaskList $taskList)
    {
        abort_unless(
            auth()->id() === $taskList->owner_id,
            403
        );

        $members = $taskList->users()->get();

        $progress = $members->map(function ($user) use ($taskList) {

            $totalTasks = Task::where(
                'task_list_id',
                $taskList->id
            )
            ->where(
                'user_id',
                $user->id
            )
            ->count();

            $completedTasks = Task::where(
                'task_list_id',
                $taskList->id
            )
            ->where(
                'user_id',
                $user->id
            )
            ->where(
                'status',
                'completed'
            )
            ->count();

            $percentage = $totalTasks > 0
                ? round(($completedTasks / $totalTasks) * 100)
                : 0;

            return [
                'user' => $user,
                'total_tasks' => $totalTasks,
                'completed_tasks' => $completedTasks,
                'percentage' => $percentage,
            ];
        });

        return view(
            'lists.progress',
            compact('taskList', 'progress')
        );
    }
}