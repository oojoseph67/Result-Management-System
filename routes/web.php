<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\DataOperatorPageController;
use App\Http\Controllers\StudentPageController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\TeacherPageController;
use App\Http\Middleware\TeacherMiddleware;
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


Route::group(['middleware' => ['auth', 'super-admin'], 'prefix' => 'supad'], function () {
    Route::view('/', 'super-admin.home')->name('super-admin.home');

    Route::view('/add-admin', 'super-admin.add-admin')->name('add-admin');
    Route::post('/add-admin', [SuperAdminController::class, 'store'])->name('register-admin');

    Route::get('/manage-users', [SuperAdminController::class, 'manageUsers'])->name('manage-users');
    Route::get('/manage-admin', [SuperAdminController::class, 'manageAdmin'])->name('manage-admin-superadmin');
    Route::get('/manage-data-operator', [SuperAdminController::class, 'manageDataOperator'])->name('manage-data-operator-superadmin');    
    Route::get('/manage-teacher', [SuperAdminController::class, 'manageTeacher'])->name('manage-teacher-superadmin');
    Route::get('/manage-student', [SuperAdminController::class, 'manageStudent'])->name('manage-student-superadmin');

    Route::post('/edit-user', [SuperAdminController::class, 'editUser'])->name('edit-user');
    Route::post('/delete-user', [SuperAdminController::class, 'deleteUser'])->name('delete-user');

    Route::view('/generate-result', 'super-admin.generate-result')->name('generate-result');
    Route::post('/generate-results', [SuperAdminController::class, 'generateResults'])->name('generate-results');

    Route::get('/change-term', [SuperAdminController::class, 'changeTerm'])->name('change-term');
    Route::post('/change-term-action', [SuperAdminController::class, 'changeTermAction'])->name('term-change');
    Route::get('/reset', [SuperAdminController::class, 'reset'])->name('reset');
    Route::post('/reset-calendar', [SuperAdminController::class, 'resetCalendar'])->name('reset-calendar');
});

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'ad'], function () {
    Route::view('/', 'admin.home')->name('admin.home');

    Route::get('/manage-users', [AdminPageController::class, 'manageUsers'])->name('manage-users-admin');
    Route::get('/manage-data-operator', [AdminPageController::class, 'manageDataOperator'])->name('manage-data-operator');
    Route::get('/manage-teacher', [AdminPageController::class, 'manageTeacher'])->name('manage-teacher');
    Route::get('/manage-student', [AdminPageController::class, 'manageStudent'])->name('manage-student');

    Route::view('/add-users', 'admin.add-users')->name('add-users');
    Route::view('/add-data-operator', 'admin.add-data-operator')->name('add-data-operator');
    Route::view('/add-teacher', 'admin.add-teacher')->name('add-teacher');
    Route::view('/add-student', 'admin.add')->name('add-student');
    Route::post('/add.data-operator', [AdminPageController::class, 'store'])->name('register-data-operator');
    Route::post('/add.teacher', [AdminPageController::class, 'store'])->name('register-teacher');
    Route::post('/add.student', [AdminPageController::class, 'store'])->name('register-student');

    Route::get('/create-subject', [AdminPageController::class, 'createSubjectPage'])->name('create-subject');
    Route::get('/create-subject-action', [AdminPageController::class, 'createSubjectAction'])->name('create-action');
    Route::post('/update-subject', [AdminPageController::class, 'updateSubject'])->name('update-subject');
    Route::get('/delete-subject', [AdminPageController::class, 'deleteSubject'])->name('delete-subject');

    Route::get('/assign', [AdminPageController::class, 'assign'])->name('assign-teacher');
    Route::post('/assign-action', [AdminPageController::class, 'assignAction'])->name('assign-action');
    // Route::post('/update-assign', [AdminPageController::class, 'updateAssign'])->name('update-assign');
    Route::get('/delete-assign', [AdminPageController::class, 'deleteAssign'])->name('delete-assign');

    Route::post('/edit-user', [AdminPageController::class, 'editUser'])->name('edit-user');
    Route::post('/delete-user', [AdminPageController::class, 'deleteUser'])->name('delete-user');

    Route::get('/profile', [AdminPageController::class, 'profile'])->name('profile-ad');
    Route::post('/edit-profile', [AdminPageController::class, 'editProfile'])->name('edit-profile-ad');
    Route::post('/change-password', [AdminPageController::class, 'changePassword'])->name('change-password-ad');
});


Route::group(['middleware' => ['auth', 'data-operator'], 'prefix' => 'dop'], function () {
    Route::view('/', 'data-operator.home')->name('data-operator.home');

    Route::get('/manage-marks', [DataOperatorPageController::class, 'manageMarks'])->name('manage-marks-dop');
    Route::get('/manage-marks-class', [DataOperatorPageController::class, 'manageMarksClass'])->name('manage-marks-class-dop');
    Route::post('/edit-marks', [DataOperatorPageController::class, 'editMarks'])->name('edit-marks-dop');

    Route::get('/manage-results', [DataOperatorPageController::class, 'manageResults'])->name('manage-results-dop');    
    Route::get('/manage-results-class', [DataOperatorPageController::class, 'manageResults'])->name('manage-results-class-dop');
    Route::get('/single-result/{class}/{name}', [DataOperatorPageController::class, 'singleResult'])->name('single-result-dop');
    Route::get('/print-result', [DataOperatorPageController::class, 'printResult'])->name('print-result-dop');

    Route::get('/profile', [DataOperatorPageController::class, 'profile'])->name('profile-dop');
    Route::post('/edit-profile', [DataOperatorPageController::class, 'editProfile'])->name('edit-profile-dop');
    Route::post('/change-password', [DataOperatorPageController::class, 'changePassword'])->name('change-password-dop');
});


Route::group(['middleware' => ['auth', 'teacher'], 'prefix' => 'tea'], function () {
    Route::view('/', 'teacher.home')->name('teacher.home');

    Route::get('/view-students', [TeacherPageController::class, 'viewStudents'])->name('view-students');
    Route::get('/view-stu-action', [TeacherPageController::class, 'viewStudentAction'])->name('view-student-action');

    Route::get('/manage-marks', [TeacherPageController::class, 'manageMarks'])->name('manage-marks');
    Route::get('/manage-marks-class', [TeacherPageController::class, 'manageMarksClass'])->name('manage-marks-class');
    Route::post('/edit-marks', [TeacherPageController::class, 'editMarks'])->name('edit-marks');
    
    Route::get('/view-student-profile/{name}', [TeacherPageController::class, 'viewStudentProfile'])->name('view-student-profile');

    Route::get('/profile', [TeacherPageController::class, 'profile'])->name('profile-tea');    
    Route::post('/edit-profile', [TeacherPageController::class, 'editProfile'])->name('edit-profile-tea');
    Route::post('/change-password', [TeacherPageController::class, 'changePassword'])->name('change-password-tea');
});

Route::group(['middleware' => ['auth', 'student'], 'prefix' => 'stu'], function () {
    Route::get('/', [StudentPageController::class, 'index'])->name('student.home');

    Route::get('/profile', [StudentPageController::class, 'profile'])->name('profile');
    Route::post('/edit-profile', [StudentPageController::class, 'editProfile'])->name('edit-profile');
    Route::post('/change-password', [StudentPageController::class, 'changePassword'])->name('change-password');

    Route::get('/current-result', [StudentPageController::class, 'currentResult'])->name('current-result');
    Route::get('/print-result', [StudentPageController::class, 'printResult'])->name('print-result-stu');
    Route::get('/previous-result', [StudentPageController::class, 'previousResults'])->name('previous-results');
    Route::post('/previous-result-action', [StudentPageController::class, 'previousResultAction'])->name('previous-result-action');

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
