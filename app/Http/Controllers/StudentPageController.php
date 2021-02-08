<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class StudentPageController extends Controller
{
    public function index()
    {
       return view('student.home');
    }
}
