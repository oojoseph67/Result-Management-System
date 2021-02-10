<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Subject;

class AdminPageController extends Controller
{
    public function manageUsers()
    {
        return view('admin.manage-users');
    }

    public function manageDataOperator()
    {
        $dataOperator = DB::table('users')->where(
            'role', 'data-operator'
        )->orderBy('name', 'asc')->get();

        return view('admin.manage-data-operator', [
            'dataOperator' => $dataOperator
        ]);
    }

    public function manageTeacher()
    {
        $teacher = DB::table('users')->where(
            'role', 'teacher'
        )->orderBy('name', 'asc')->get();

        return view('admin.manage-teacher', [
            'teacher' => $teacher
        ]);
    }

    public function manageStudent()
    {
        $student = DB::table('users')->where(
            'role', 'student'
        )->orderBy('name', 'asc')->get();

        return view('admin.manage-student', [
            'student' => $student
        ]);
    }

    public function editUser(Request $request)
    {
        // $request->validate([
        //     'password' => ['string', 'min:8', 'confirmed'],
        // ]);

        // Auth::user()->update(
        //     ['name' => $request->input('name')],
        //     ['email' => $request->input('email')],
        //     ['dob' => $request->input('dob')],
        //     ['password' => $request->input('password')]
        // );

        // return 123;
        //return $request->input('email');
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'dob' => ['required', 'date'],
        ]);


        DB::table('users')->where(
            'id', $request->input('id')
        )->update(
            [
                'name' => $request['name'],
                'email' => $request['email'],
                'dob' => $request['dob'],
            ],
        );
        return back()->withStatus(__($request->input('name') .' Profile Successfully Updated'));
    }

    public function deleteUser(Request $request)
    {
        $input_password = $request->input('password');
        $user_password = auth()->user()->password;
        $name = $request->input('name');
        $role = $request->input('role');

        if (Hash::check($input_password, $user_password)) {
            DB::table('users')->where(
                'id', $request->input('id')
            )->delete();

            if ($role == 'student') {
                return back()->withStatus(__('Student' . $name . ' profile has been deleted successfully'));
            }elseif ($role == 'teacher') {
                return back()->withStatus(__('Teacher ' . $name . ' profile has been deleted successfully'));
            }elseif ($role == 'data-operator') {
                return back()->withStatus(__('Data-Operator ' . $name . ' profile has been deleted successfully'));
            }
            
        } else {
            return back()->withError(__('Delete failed.... Not Admin[wrong password]'));
        }
    }

    public function generateResults(Request $request)
    {
        
    }

}
