<?php

namespace App\Http\Controllers;

use App\Models\AssignTeacher;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DataOperatorPageController extends Controller
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
        
        return redirect()->route('manage-users')->withStatus(__($request['name']. ' Has Been Added To Our Database With Role As '. $request['role']));
    }

    public function createSubjectPage()
    {
        $class_data = DB::table('school_classes')->get();
        $subject_data = DB::table('subjects')->get();

        return view('data-operator.create-subject', [
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
            'id', $request->input('id')
        )->update(
            [
                'subject_name' => $request->input('subject_name'),
                'class' => $request->input('class'),
            ]
        );

        return back()->withStatus(__('The Subject '. $request->input('subject_name') . ' Has Been Updated Successfully'));
    }

    public function deleteSubject(Request $request)
    {
        DB::table('subjects')->where(
            'id', $request->input('id')
        )->delete();

        return back()->withStatus(__('The Subject '. $request->input('subject_name') . ' Has Been Deleted Successfully'));
    }

    public function assign()
    {
        $assigned = DB::table('assign_teachers')->orderBy(
            'name', 'asc'
        )->get();

        $teacher = DB::table('users')->where(
            'role', 'teacher'
        )->orderBy('name', 'asc')->get();

        $class_data = DB::table('school_classes')->get();
        $subject_data = DB::table('subjects')->get();

        return view('data-operator.assign-view',[
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
            if ($request->input('teacher') == $data->teacher_name) {
                if ($request->input('subject') == $data->subject_name) {
                    if ($request->input('class') == $data->class) {
                        return back()->withError(__($request->input('teacher') . ' Has Already Been Assigned To ' . $request->input('subject') . ' For ' . $request->input('class') . ' '));
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

        return back()->withStatus(__($request->input('teacher'). ' Assigned To '. $request->input('subject'). ' For '. $request->input('class'). ' Successfully'));
    }

    public function deleteAssign(Request $request) 
    {
        DB::table('assign_teachers')->where(
            'id', $request->input('id'),
        )->delete();

        return back()->withStatus(__($request->input('teacher_name'). ' Has Been Unassigned From '. $request->input('subject_name'). ' For '. $request->input('class')));
    }

    public function manageUsers()
    {
        return view('data-operator.manage-users');
    }

    public function manageDataOperator()
    {
        $dataOperator = DB::table('users')->where(
            'role', 'data-operator'
        )->orderBy('name', 'asc')->get();

        return view('data-operator.manage-data-operator', [
            'dataOperator' => $dataOperator
        ]);
    }

    public function manageTeacher()
    {
        $teacher = DB::table('users')->where(
            'role', 'teacher'
        )->orderBy('name', 'asc')->get();

        return view('data-operator.manage-teacher', [
            'teacher' => $teacher
        ]);
    }

    public function manageStudent()
    {
        $student = DB::table('users')->where(
            'role', 'student'
        )->orderBy('name', 'asc')->get();

        return view('data-operator.manage-student', [
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

    public function manageMarks()
    {
        // $student = DB::table('users')->where(
        //     'role', 'student'
        // )->orderBy('name', 'asc')->get();

        // return view('data-operator.manage-marks', [
        //     'student' => $student
        // ]);
        $class_data = DB::table('school_classes')->get();
        $subject_data = DB::table('subjects')->get();

        return view('data-operator.manage-marks-view',[
            'class_data' => $class_data,
            'subject_data' => $subject_data
        ]);
    }

    public function manageMarksClass(Request $request)
    {
        $class = $request->input('class');
        $subject_name = $request->input('subject_name');
        $subject_data = DB::table('subjects')->get();
        
        if(DB::table('subjects')->where('subject_name', $subject_name)->where('class', $class)->exists()){

            $data = DB::table('users')->where(
                'current_class', $class,
            )->where(
                'role', 'student'
            )->orderBy(
                'name', 'asc'
            )->get();

            $result = DB::table('results')->where(
                'class', $class            
            )->get();

            return view('data-operator.manage-marks', [
                'data' => $data,
                'subject_data' => $subject_data,
                'class' => $class,
                'subject_name' => $subject_name,
                'result' => $result
            ]);
        }else {
            return back()->withError(__('No Subject '. $subject_name . ' Exists For '. $class . ' Class. Please Create Subject For Required Class'));
        }

        
    }

    public function editMarks(Request $request)
    {
        if (DB::table('results')->where('name', $request->input('student_name'))->exists()) {

            $request->validate([
                'attendance_score' => 'required | integer| between: 0, 5',
                'first_test' => 'required | integer| between: 0, 10',
                'second_test' => 'required | integer| between: 0, 10',
                'third_test' => 'required | integer| between: 0, 10',
                'quiz' => 'required | integer| between: 0, 5',
                'exam_score' => 'required | integer| between: 0, 60',
            ]);

            $total_score = $request['attendance_score'] + $request['first_test'] +  $request['second_test'] + $request['third_test'] + $request['quiz'] + $request['exam_score'];

                DB::table('results')->where(
                    'name', $request->input('student_name')
                )->update(
                    [
                        'attendance_score' => $request['attendance_score'],
                        'first_test' => $request['first_test'],
                        'second_test' => $request['second_test'],
                        'third_test' => $request['third_test'],
                        'quiz' => $request['quiz'],
                        'exam_score' => $request['exam_score'],   
                        'total' => $total_score
                    ]
                );

                return back()->withStatus(__($request->input('student_name'). ' Marks For '. $request->input('subject_name'). ' Has Been Updated'));

        }else {
            $request->validate([
                'attendance_score' => 'required | integer| between: 0, 5',
                'first_test' => 'required | integer| between: 0, 10',
                'second_test' => 'required | integer| between: 0, 10',
                'third_test' => 'required | integer| between: 0, 10',
                'quiz' => 'required | integer| between: 0, 5',
                'exam_score' => 'required | integer| between: 0, 60',
            ]);

            $total_score = $request['attendance_score'] + $request['first_test'] +  $request['second_test'] + $request['third_test'] + $request['quiz'] + $request['exam_score'];

             $edit_marks = Result::create([
                'name' => $request->input('student_name'),
                'class' => $request->input('class'),
                'subject_name' => $request->input('subject_name'),
                'attendance_score' => $request['attendance_score'],
                'first_test' => $request['first_test'],
                'second_test' => $request['second_test'],
                'third_test' => $request['third_test'],
                'quiz' => $request['quiz'],
                'exam_score' => $request['exam_score'],
                'total' => $total_score,
                ]);

            $edit_marks->save();

            return back()->withStatus(__($request->input('student_name'). ' Marks For '. $request->input('subject_name'). ' Has Been Created'));
        }
    }
    
    public function manageResults(Request $request)
    {
        $class_data = DB::table('school_classes')->get();
        // $subject_data = DB::table('subjects')->get();
        $user = DB::table('users')->where(
            'current_class', $request->input('class')
        )->where(
            'role', 'student'
        )->get();

        return view('data-operator.manage-results-view',[
            'class_data' => $class_data,
         //  'subject_data' => $subject_data
            'user' => $user,
            'class' => $request->input('class')
        ]);
    }

    public function singleResult($class, $name)
    {
        $result = DB::table('results')->where(
            'name' ,$name
        )->where(
            'class', $class
        )->get();

        $class_avg = DB::table('results')->where(
            'class', $class
        )->avg('total');

        $user_avg  = DB::table('results')->where(
            'class', $class
        )->where(
            'name', $name
        )->avg('total');

        $total_in_class = DB::table('results')->where(
            'class', $class
        )->count('class');
        
        return view('data-operator.manage-single-result', [
            'name' => $name,
            'class' => $class,
            'result' => $result,
            'class_avg' => $class_avg,
            'user_avg' => $user_avg,
            'total_in_class' => $total_in_class,
        ]);
    }

    public function printResult(Request $request)
    {
        $class = $request->input('class');
        $name = $request->input('name');

        $result = DB::table('results')->where(
            'name' ,$name
        )->where(
            'class', $class
        )->get();

        $class_avg = DB::table('results')->where(
            'class', $class
        )->avg('total');

        $user_avg  = DB::table('results')->where(
            'class', $class
        )->where(
            'name', $name
        )->avg('total');

        $total_in_class = DB::table('results')->where(
            'class', $class
        )->count('class');
        
        return view('data-operator.print-result', [
            'name' => $name,
            'class' => $class,
            'result' => $result,
            'class_avg' => $class_avg,
            'user_avg' => $user_avg,
            'total_in_class' => $total_in_class,
        ]);
    }

}
