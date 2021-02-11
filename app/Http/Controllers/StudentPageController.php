<?php

namespace App\Http\Controllers;

use App\Models\AssignTeacher;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentPageController extends Controller
{
    public function index()
    {
       return view('student.home');
    }

    public function profile()
   {
       return view('student.profile',[
            
       ]);
   }

   public function editProfile(Request $request)
   {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        DB::table('users')->where(
            'id', $request->input('id')
        )->update(
            [
                'name' => $request['name'],
                'email' => $request['email'],
            ],
        );

        return back()->withStatus(__('Profile Successfully Updated'));
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:5', 'confirmed']
        ]);

        DB::table('users')->where(
            'id', $request->input('id')
        )->update(
            [
                'password' => Hash::make($request['password'])
            ],
        );

       // return 123;

        return back()->withStatus(__('Password Successfully Updated'));
    }


}
