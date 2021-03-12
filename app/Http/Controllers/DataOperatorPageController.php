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
            return back()->withError(__('No Subject '. $subject_name . ' Exists For '. $class . ' Class. Please Contact The Admin To Create Subject For Required Class'));
        }

        
    }

    public function editMarks(Request $request)
    {
        if (DB::table('results')->where('name', $request->input('student_name'))->where('subject_name', $request->input('subject_name'))->exists()) {

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
                )->where(
                    'subject_name', $request->input('subject_name')    
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
        )->orderBy(
            'name', 'asc'
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
        )->orderBy('subject_name', 'asc')->get();

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

    public function profile()
    {
        return view('data-operator.profile', [
            
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
