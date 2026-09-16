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
        'description',
        'priority',
        'due_date',
        'is_completed',
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'is_completed' => 'boolean',
    ];

    /**
     * Task berada di dalam satu list.
     */
    public function taskList(): BelongsTo
    {
        return $this->belongsTo(
            TaskList::class,
            'task_list_id'
        );
    }

    /**
     * Task dimiliki oleh satu user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }
}