<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'class',
        'subject_name',
        'attendance_score',
        'first_test',
        'second_test',
        'thrid_test',
        'quiz',
        'exam_score',
        'total',
    ];
}
