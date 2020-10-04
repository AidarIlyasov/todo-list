<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Board extends Model
{
    protected $fillable = [
        'id',
        'title',
        'view',
        'task_id',
        'created_at',
        'updated_at',
        'bg_image'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
