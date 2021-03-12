<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'class',
        'subject_name',
        'session',
        'term',
        'attendance_score',
        'first_test',
        'second_test',
        'third_test',
        'quiz',
        'exam_score',
        'total',
    ];
}
