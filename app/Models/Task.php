<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'task_list_id',
        'user_id',
        'title',
        'status',
    ];

    public function taskList(): BelongsTo
    {
        return $this->belongsTo(
            TaskList::class,
            'task_list_id'
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }
}