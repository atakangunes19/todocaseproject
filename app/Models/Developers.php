<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developers extends Model
{
    use HasFactory;

    protected $table = 'developers';

    protected $fillable
        = [
            'id',
            'name',
            'max_working_hours_per_week',
            'difficulty'
        ];
}
