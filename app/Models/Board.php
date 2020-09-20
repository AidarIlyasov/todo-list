<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
