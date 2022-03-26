<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskLists extends Model
{
    use HasFactory;

    protected $table = 'task_lists';

    protected $fillable
        = [
            'id',
            'list_name',
            'list_url'
        ];
}
