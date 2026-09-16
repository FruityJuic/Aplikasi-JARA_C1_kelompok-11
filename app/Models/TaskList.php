<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskList extends Model
{
    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];

    /**
     * Satu list dimiliki oleh satu user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Satu list memiliki banyak task.
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'list_id');
    }
}