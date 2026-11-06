<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NptelCourse extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'department',
        'course_type',
        'phase',
        'developers',
        'course_url',
        'status',
    ];
}