<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});

Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// users routes
Route::prefix('users')->group(function(){
    Route::get('/view', [UserController::class, 'userView'])->name('user.view');
    Route::get('/add', [UserController::class, 'userAdd'])->name('user.add');
    Route::post('/store', [UserController::class, 'userStore'])->name('user.store');
    Route::get('/edit/{id}', [UserController::class, 'userEdit'])->name('user.edit');
    Route::post('/update/{id}', [UserController::class, 'userUpdate'])->name('user.update');
    Route::get('/delete/{id}', [UserController::class, 'userDelete'])->name('user.delete');
});

// user profile routes
Route::prefix('profile')->group(function(){
    Route::get('/view', [ProfileController::class, 'viewProfile'])->name('view.profile');
    Route::get('/edit', [ProfileController::class, 'editProfile'])->name('edit.profile');
    Route::post('/update', [ProfileController::class, 'updateProfile'])->name('update.profile');
    Route::get('/view/password', [ProfileController::class, 'viewPassword'])->name('view.password');
    Route::post('/update/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});

// setups management routes
Route::prefix('setups')->group(function(){

    // Student Class Routes
    Route::get('/view/student/class', [StudentClassController::class, 'viewStudentClass'])->name('view.student.class');
    Route::get('/add/student/class', [StudentClassController::class, 'studentClassAdd'])->name('student.class.add');
    Route::post('/store/student/class', [StudentClassController::class, 'studentClassStore'])->name('student.class.store');
    Route::get('/edit/student/class/{id}', [StudentClassController::class, 'studentClassEdit'])->name('student.class.edit');
    Route::post('/update/student/class/{id}', [StudentClassController::class, 'studentClassUpdate'])->name('student.class.update');
    Route::get('/delete/student/class/{id}', [StudentClassController::class, 'studentClassDelete'])->name('student.class.delete');

    // Student Year Routes
    Route::get('/view/student/year', [StudentYearController::class, 'viewStudentYear'])->name('view.student.year');
    Route::get('/add/student/year', [StudentYearController::class, 'studentYearAdd'])->name('student.year.add');
    Route::post('/store/student/year', [StudentYearController::class, 'studentYearStore'])->name('student.year.store');
    Route::get('/edit/student/year/{id}', [StudentYearController::class, 'studentYearEdit'])->name('student.year.edit');
    Route::post('/update/student/year/{id}', [StudentYearController::class, 'studentYearUpdate'])->name('student.year.update');
    Route::get('/delete/student/year/{id}', [StudentYearController::class, 'studentYearDelete'])->name('student.year.delete');

    // Student Group Routes
    Route::get('/view/student/group', [StudentGroupController::class, 'viewStudentGroup'])->name('view.student.group');
    Route::get('/add/student/group', [StudentGroupController::class, 'studentGroupAdd'])->name('student.group.add');
    Route::post('/store/student/group', [StudentGroupController::class, 'studentGroupStore'])->name('student.group.store');
    Route::get('/edit/student/group/{id}', [StudentGroupController::class, 'studentGroupEdit'])->name('student.group.edit');
    Route::post('/update/student/group/{id}', [StudentGroupController::class, 'studentGroupUpdate'])->name('student.group.update');
    Route::get('/delete/student/group/{id}', [StudentGroupController::class, 'studentGroupDelete'])->name('student.group.delete');

    // Student Shift Routes
    Route::get('/view/student/shift', [StudentShiftController::class, 'viewStudentShift'])->name('view.student.shift');
    Route::get('/add/student/shift', [StudentShiftController::class, 'studentShiftAdd'])->name('student.shift.add');
    Route::post('/store/student/shift', [StudentShiftController::class, 'studentShiftStore'])->name('student.shift.store');
    Route::get('/edit/student/shift/{id}', [StudentShiftController::class, 'studentShiftEdit'])->name('student.shift.edit');
    Route::post('/update/student/shift/{id}', [StudentShiftController::class, 'studentShiftUpdate'])->name('student.shift.update');
    Route::get('/delete/student/shift/{id}', [StudentShiftController::class, 'studentShiftDelete'])->name('student.shift.delete');
});
