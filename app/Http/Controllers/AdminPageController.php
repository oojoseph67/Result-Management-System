<?php

namespace App\Http\Controllers;

use App\Models\AssignTeacher;
use App\Models\User;
use App\Models\Result;
use App\Models\AcademicResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Subject;

class AdminPageController extends Controller
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
            'entry_class' => $request['entry_class'],
            'current_class' => $request['entry_class'],
            'role' => $request['role'],
            'password' => Hash::make($request['password']),
            'passport_path' => $request['passport']
        ]);

        $store_user->save();
        
        return redirect()->route('manage-users-admin')->withStatus(__($request['name']. ' Has Been Added To Our Database With Role As '. $request['role']));
    }
    
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

    public function createSubjectPage()
    {
        $class_data = DB::table('school_classes')->get();
        $subject_data = DB::table('subjects')->get();

        return view('admin.create-subject', [
            'class_data' => $class_data,
            'subject_data' => $subject_data
        ]);
    }

    public function createSubjectAction(Request $request)
    {
        $subject_data = DB::table('subjects')->get();

        foreach ($subject_data as $data) {
            if ($request->input('class') == $data->class) {
                if ($request->input('subject_name') == $data->subject_name) {
                    return back()->withError(__($request->input('subject_name') . ' Already Exist For ' . $request->input('class')));
                }
            }
        }

        $subject_create = Subject::create([
            'subject_name' => $request->input('subject_name'),
            'class' => $request->input('class')
        ]);
        $subject_create->save();

        return back()->withStatus(__('Subject Created Successfully'));
    }

    public function updateSubject(Request $request)
    {
        DB::table('subjects')->where(
            'id',
            $request->input('id')
        )->update(
            [
                'subject_name' => $request->input('subject_name'),
                'class' => $request->input('class'),
            ]
        );

        return back()->withStatus(__('The Subject ' . $request->input('subject_name') . ' Has Been Updated Successfully'));
    }

    public function deleteSubject(Request $request)
    {
        DB::table('subjects')->where(
            'id',
            $request->input('id')
        )->delete();

        return back()->withStatus(__('The Subject ' . $request->input('subject_name') . ' Has Been Deleted Successfully'));
    }

    public function assign()
    {
        $assigned = DB::table('assign_teachers')->orderBy(
            'teacher_name', 'asc'
        )->get();

        $teacher = DB::table('users')->where(
            'role',
            'teacher'
        )->orderBy('name', 'asc')->get();

        $class_data = DB::table('school_classes')->get();
        $subject_data = DB::table('subjects')->get();

        return view('admin.assign-view', [
            'teacher' => $teacher,
            'class_data' => $class_data,
            'subject_data' => $subject_data,
            'assigned' => $assigned
        ]);
    }

    public function assignAction(Request $request)
    {
        $assign_data = DB::table('assign_teachers')->get();

        foreach ($assign_data as $data) {
            if ($request->input('class') == $data->class) {
                if ($request->input('subject') == $data->subject_name) {
                    if ($request->input('teacher') == $data->teacher_name) {
                        return back()->withError(__($request->input('teacher') . ' Has Already Been Assigned To ' . $request->input('subject') . ' For ' . $request->input('class') . ' '));
                    }else{
                        return back()->withError(__($request->input('subject') . ' For ' . $request->input('class') . ' Has Already Been Assigned'));
                    }
                }
            }
        }

        $assign_create = AssignTeacher::create([
            'teacher_name' => $request->input('teacher'),
            'subject_name' => $request->input('subject'),
            'class' => $request->input('class'),
        ]);

        $assign_create->save();

        return back()->withStatus(__($request->input('teacher') . ' Assigned To ' . $request->input('subject') . ' For ' . $request->input('class') . ' Successfully'));
    }

    public function deleteAssign(Request $request)
    {
        DB::table('assign_teachers')->where(
            'id',
            $request->input('id'),
        )->delete();

        return back()->withStatus(__($request->input('teacher_name') . ' Has Been Unassigned From ' . $request->input('subject_name') . ' For ' . $request->input('class')));
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
            return back()->withError(__('Delete failed.... Not data-operator[wrong password]'));
        }
    }

    public function profile()
    {
        return view('admin.profile', [

        ]);
    }

    public function editProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        DB::table('users')->where(
            'id',
            $request->input('id')
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
            'id',
            $request->input('id')
        )->update(
            [
                'password' => Hash::make($request['password'])
            ],
        );

        // return 123;

        return back()->withStatus(__('Password Successfully Updated'));
    }
    
}
