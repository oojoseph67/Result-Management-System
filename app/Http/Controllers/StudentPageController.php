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
        $class = Auth::user()->current_class;
        $name = Auth::user()->name;

        $result = DB::table('results')->where(
            'name', $name
        )->where(
            'class', $class
        )->orderBy('id', 'desc')->get();

       return view('student.home', [
            'result' => $result
       ]);
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

    public function currentResult()
    {
        $class = Auth::user()->current_class;
        $name = Auth::user()->name;

        $result = DB::table('results')->where(
            'name', $name
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

        return view('student.current-result', [
            'name' => $name,
            'class' => $class,
            'result' => $result,
            'class_avg' => $class_avg,
            'user_avg' => $user_avg,
            'total_in_class' => $total_in_class,
        ]);
    }

    public function printResult()
    {
        $class = Auth::user()->current_class;
        $name = Auth::user()->name;

        $result = DB::table('results')->where(
            'name',
            $name
        )->where(
            'class',
            $class
        )->get();

        $class_avg = DB::table('results')->where(
            'class',
            $class
        )->avg('total');

        $user_avg  = DB::table('results')->where(
            'class',
            $class
        )->where(
            'name',
            $name
        )->avg('total');

        $total_in_class = DB::table('results')->where(
            'class',
            $class
        )->count('class');

        return view('student.print-result', [
            'name' => $name,
            'class' => $class,
            'result' => $result,
            'class_avg' => $class_avg,
            'user_avg' => $user_avg,
            'total_in_class' => $total_in_class,
        ]);
    }

    public function previousResults()
    {
        $session = DB::table('academic_results')->select(
            'session'
        )->where(
            'name' , Auth::user()->name
        )->distinct()->get();

        $class = DB::table('academic_results')->select(
            'class'
        )->where(
            'name', Auth::user()->name
        )->distinct()->get();

        // $term = DB::table('academic_results')->select(
        //     'term'
        // )->where(
        //     'name' , Auth::user()->name
        // )->distinct()->get();

        return view('student.previous-result', [
            'session' => $session,
            'class' => $class
            // 'term' => $term
        ]);
    }

    public function previousResultAction(Request $request)
    {
        $name = Auth::user()->name;

        if(DB::table('academic_results')->where('class', $request->input('class'))->where('session', $request->input('session'))->where('term', $request->input('term'))->exists())
        {
            $result = DB::table('academic_results')->where(
                'session', $request->input('session')
            )->where(
                'term', $request->input('term')
            )->where(
                'name', $name
            )->where(
                'class', $request->input('class')
            )->get();

            $class_avg = DB::table('academic_results')->where(
                'class', $request->input('class')
            )->avg('total');

            $user_avg  = DB::table('academic_results')->where(
                'class', $request->input('class')
            )->where(
                'name',  $name
            )->avg('total');

            $total_in_class = DB::table('academic_results')->where(
                'class', $request->input('class')
            )->count('class');


            return view('student.print-result', [
                'name' => $name,
                'class' => $request->input('class'),
                'result' => $result,
                'class_avg' => $class_avg,
                'user_avg' => $user_avg,
                'total_in_class' => $total_in_class,
            ]);
        }
        else{
            return back()->withError(__('No Result For '.$request->input('term'). ' In Session '.$request->input('session')));
        }
    }


}
