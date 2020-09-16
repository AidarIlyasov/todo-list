<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'id',
        'title',
        'description',
        'task_list',
        'created_at',
        'updated_at',
        'update_user',
        'completed'
    ];
}
