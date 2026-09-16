<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskList extends Model
{
    use HasFactory;

    protected $table = 'lists';

    protected $fillable = [
        'name',
        'user_id',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'list_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}