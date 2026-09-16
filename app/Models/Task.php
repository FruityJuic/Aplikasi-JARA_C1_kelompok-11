<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'list_id',
        'user_id',
        'title',
        'description',
        'priority',
        'due_date',
        'is_completed',
    ];

    protected $casts = [
        'due_date' => 'date',
        'is_completed' => 'boolean',
    ];

    public function list()
    {
        return $this->belongsTo(TaskList::class, 'list_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}