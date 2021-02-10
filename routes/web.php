<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\DataOperatorPageController;
use App\Http\Controllers\TeacherPageController;
use FontLib\Table\Type\name;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'auth.register')->name('register');

Route::view('/register-do', 'auth.register-data-operator')->name('register-data-operator');

Route::view('/register-teacher', 'auth.register-teacher')->name('register-teacher');

Route::view('/login', 'auth.login')->name('login');

Route::get('/choose', 'ChoosePageController@index')->name('choose');


Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'ad'], function () {
    Route::view('/', 'admin.home')->name('admin.home');

    Route::get('/manage-users', [AdminPageController::class, 'manageUsers'])->name('manage-users');    
    Route::get('/manage-data-operator', [AdminPageController::class, 'manageDataOperator'])->name('manage-data-operator');    
    Route::get('/manage-teacher', [AdminPageController::class, 'manageTeacher'])->name('manage-teacher');
    Route::get('/manage-student', [AdminPageController::class, 'manageStudent'])->name('manage-student');

    Route::post('/edit-user', [AdminPageController::class, 'editUser'])->name('edit-user');
    Route::post('/delete-user', [AdminPageController::class, 'deleteUser'])->name('delete-user');
});


Route::group(['middleware' => ['auth', 'data-operator'], 'prefix' => 'dop'], function () {
    Route::view('/', 'data-operator.home')->name('data-operator.home');

    Route::view('/add-data-operator', 'data-operator.add-data-operator')->name('add-data-operator');
    Route::view('/add-teacher', 'data-operator.add-teacher')->name('add-teacher');
    Route::view('/add-student', 'data-operator.add')->name('add-student');
    Route::post('/add.data-operator', [DataOperatorPageController::class, 'store'])->name('register-data-operator');
    Route::post('/add.teacher', [DataOperatorPageController::class, 'store'])->name('register-teacher');
    Route::post('/add.student', [DataOperatorPageController::class, 'store'])->name('register-student');

    Route::get('/create-subject', [DataOperatorPageController::class, 'createSubjectPage'])->name('create-subject');
    Route::get('/create-subject-action', [DataOperatorPageController::class, 'createSubjectAction'])->name('create-action');
    Route::post('/update-subject', [DataOperatorPageController::class, 'updateSubject'])->name('update-subject');
    Route::get('/delete-subject', [DataOperatorPageController::class, 'deleteSubject'])->name('delete-subject');

    Route::get('/assign', [DataOperatorPageController::class, 'assign'])->name('assign-teacher');
    Route::post('/assign-action', [DataOperatorPageController::class, 'assignAction'])->name('assign-action');
    // Route::post('/update-assign', [DataOperatorPageController::class, 'updateAssign'])->name('update-assign');
    Route::get('/delete-assign', [DataOperatorPageController::class, 'deleteAssign'])->name('delete-assign');

    Route::get('/manage-users', [DataOperatorPageController::class, 'manageUsers'])->name('manage-users');
    Route::get('/manage-data-operator', [DataOperatorPageController::class, 'manageDataOperator'])->name('manage-data-operator');
    Route::get('/manage-teacher', [DataOperatorPageController::class, 'manageTeacher'])->name('manage-teacher');
    Route::get('/manage-student', [DataOperatorPageController::class, 'manageStudent'])->name('manage-student');

    Route::post('/edit-user', [DataOperatorPageController::class, 'editUser'])->name('edit-user');
    Route::post('/delete-user', [DataOperatorPageController::class, 'deleteUser'])->name('delete-user');

    Route::get('/manage-marks', [DataOperatorPageController::class, 'manageMarks'])->name('manage-marks');
    Route::get('/manage-marks-class', [DataOperatorPageController::class, 'manageMarksClass'])->name('manage-marks-class');
    Route::post('/edit-marks', [DataOperatorPageController::class, 'editMarks'])->name('edit-marks');

    Route::get('/manage-results', [DataOperatorPageController::class, 'manageResults'])->name('manage-results');    
    Route::get('/manage-results-class', [DataOperatorPageController::class, 'manageResults'])->name('manage-results-class');
    Route::get('/single-result/{class}/{name}', [DataOperatorPageController::class, 'singleResult'])->name('single-result');
    Route::get('/print-result', [DataOperatorPageController::class, 'printResult'])->name('print-result');
});


Route::group(['middleware' => ['auth', 'teacher'], 'prefix' => 'tea'], function () {
    Route::view('/', 'teacher.home')->name('teacher.home');

    Route::get('/view-students', [TeacherPageController::class, 'viewStudents'])->name('view-students');
    Route::get('/view-stu-action', [TeacherPageController::class, 'viewStudentAction'])->name('view-student-action');

    Route::get('/manage-marks', [TeacherPageController::class, 'manageMarks'])->name('manage-marks');
    Route::get('/manage-marks-class', [TeacherPageController::class, 'manageMarksClass'])->name('manage-marks-class');
    Route::post('/edit-marks', [TeacherPageController::class, 'editMarks'])->name('edit-marks');
    
    Route::get('/profile', [TeacherPageController::class, 'profile'])->name('profile');    
    Route::post('/edit-profile', [TeacherPageController::class, 'editProfile'])->name('edit-profile');
    Route::post('/change-password', [TeacherPageController::class, 'changePassword'])->name('change-password');
});

Route::group(['middleware' => ['auth', 'student'], 'prefix' => 'stu'], function () {
    Route::view('/', 'student.home')->name('student.home');


    // Route::get('/student', function ($id,$code){
    //     session([

    //     ]);
    // });
});


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
