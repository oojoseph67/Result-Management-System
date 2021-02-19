<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Result;
use App\Models\AcademicResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Subject;

class SuperAdminController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'dob' => ['required', 'date'],
            'role' => ['required'],
            'passport' => ['required', 'max:2048'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $store_user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'dob' => $request['dob'],
            'role' => $request['role'],
            'password' => Hash::make($request['password']),
            'passport_path' => $request['passport']
        ]);

        $store_user->save();

        return redirect()->route('manage-users')->withStatus(__($request['name'] . ' Has Been Added To Our Database With Role As ' . $request['role']));
    }

    public function manageUsers()
    {
        return view('super-admin.manage-users');
    }

    public function manageDataOperator()
    {
        $dataOperator = DB::table('users')->where(
            'role',
            'data-operator'
        )->orderBy('name', 'asc')->get();

        return view('super-admin.manage-data-operator', [
            'dataOperator' => $dataOperator
        ]);
    }

    public function manageTeacher()
    {
        $teacher = DB::table('users')->where(
            'role',
            'teacher'
        )->orderBy('name', 'asc')->get();

        return view('super-admin.manage-teacher', [
            'teacher' => $teacher
        ]);
    }

    public function manageStudent()
    {
        $student = DB::table('users')->where(
            'role',
            'student'
        )->orderBy('name', 'asc')->get();

        return view('super-admin.manage-student', [
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
            'id',
            $request->input('id')
        )->update(
            [
                'name' => $request['name'],
                'email' => $request['email'],
                'dob' => $request['dob'],
            ],
        );
        return back()->withStatus(__($request->input('name') . ' Profile Successfully Updated'));
    }

    public function deleteUser(Request $request)
    {
        $input_password = $request->input('password');
        $user_password = auth()->user()->password;
        $name = $request->input('name');
        $role = $request->input('role');

        if (Hash::check($input_password, $user_password)) {
            DB::table('users')->where(
                'id',
                $request->input('id')
            )->delete();

            if ($role == 'student') {
                return back()->withStatus(__('Student' . $name . ' profile has been deleted successfully'));
            } elseif ($role == 'teacher') {
                return back()->withStatus(__('Teacher ' . $name . ' profile has been deleted successfully'));
            } elseif ($role == 'data-operator') {
                return back()->withStatus(__('Data-Operator ' . $name . ' profile has been deleted successfully'));
            }
        } else {
            return back()->withError(__('Delete failed.... Not Admin[wrong password]'));
        }
    }

    public function generateResults(Request $request)
    {
        $input_password = $request->input('password');
        $user_password = auth()->user()->password;

        if (Hash::check($input_password, $user_password)) {
            $results_data = Result::all();
            if ($results_data->isEmpty()) {
                return back()->withError(__('Result For ' . Auth::user()->session . ' Session Has Already Genrated'));
            } else {
                $result = DB::table('results')->get();

                foreach ($result as $results) {
                    $academic_results = AcademicResult::create([
                        'name' => $results->name,
                        'class' => $results->class,
                        'subject_name' => $results->subject_name,
                        'session' => Auth::user()->session,
                        'term' => Auth::user()->term,
                        'attendance_score' => $results->attendance_score,
                        'first_test' => $results->first_test,
                        'second_test' => $results->second_test,
                        'thrid_test' => $results->thrid_test,
                        'quiz' => $results->quiz,
                        'exam_score' => $results->exam_score,
                        'total' => $results->total,
                    ]);

                    $academic_results->save();
                }

                DB::table('results')->delete();

                return back()->withStatus(__('Generation of result for the ' . Auth::user()->session . ' ' . Auth::user()->term . ' was successfully'));
            }
        } else {
            return back()->withError(__('Generation of result failed.... Not Admin[wrong password]'));
        }
    }

    public function reset()
    {
        $results_data = Result::all();

        return view('super-admin.reset', [
            'results_data' => $results_data
        ]);
    }

    public function ResetCalendar(Request $request)
    {
        $input_password = $request->input('password');
        $user_password = auth()->user()->password;

        if (Hash::check($input_password, $user_password)) {

            DB::table('users')->update(
                [
                    'session' => $request->input('session'),
                    'term' => 'First Term'
                ]
            );

            return back()->withStatus(__('Reset Successfuly. Current Session is ' . Auth::user()->session . ' And Term ' . Auth::user()->term));
        } else {
            return back()->withError(__('Rest failed.... Not Admin[wrong password]'));
        }
    }
}
