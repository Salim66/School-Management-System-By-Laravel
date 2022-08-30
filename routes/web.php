<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\Employee\EmployeeAttendanceController;
use App\Http\Controllers\Backend\Employee\EmployeeLeaveController;
use App\Http\Controllers\Backend\Employee\EmployeeRegController;
use App\Http\Controllers\Backend\Employee\EmployeeSalaryController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Setup\AssignSubjectController;
use App\Http\Controllers\Backend\Setup\DesignationController;
use App\Http\Controllers\Backend\Setup\ExamTypeController;
use App\Http\Controllers\Backend\Setup\FeeCategoryAmountController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\SchoolSubjectController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\Student\ExamFeeController;
use App\Http\Controllers\Backend\Student\MonthlyFeeController;
use App\Http\Controllers\Backend\Student\RegistrationFeeController;
use App\Http\Controllers\Backend\Student\StudentRegController;
use App\Http\Controllers\Backend\Student\StudentRollController;
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

Route::group(['middleware' => 'auth'], function(){

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

        // fee category Routes
        Route::get('/view/fee/category', [FeeCategoryController::class, 'viewFeeCategory'])->name('view.fee.category');
        Route::get('/add/fee/category', [FeeCategoryController::class, 'feeCategoryAdd'])->name('fee.category.add');
        Route::post('/store/fee/category', [FeeCategoryController::class, 'feeCategoryStore'])->name('fee.category.store');
        Route::get('/edit/fee/category/{id}', [FeeCategoryController::class, 'feeCategoryEdit'])->name('fee.category.edit');
        Route::post('/update/fee/category/{id}', [FeeCategoryController::class, 'feeCategoryUpdate'])->name('fee.category.update');
        Route::get('/delete/fee/category/{id}', [FeeCategoryController::class, 'feeCategoryDelete'])->name('fee.category.delete');

        // fee category amount Routes
        Route::get('/view/fee/amount', [FeeCategoryAmountController::class, 'viewFeeAmount'])->name('view.fee.amount');
        Route::get('/add/fee/amount', [FeeCategoryAmountController::class, 'feeAmountAdd'])->name('fee.amount.add');
        Route::post('/store/fee/amount', [FeeCategoryAmountController::class, 'feeAmountStore'])->name('fee.amount.store');
        Route::get('/edit/fee/amount/{fee_category_id}', [FeeCategoryAmountController::class, 'feeAmountEdit'])->name('fee.amount.edit');
        Route::post('/update/fee/amount/{fee_category_id}', [FeeCategoryAmountController::class, 'feeAmountUpdate'])->name('fee.amount.update');
        Route::get('/detials/fee/amount/{fee_category_id}', [FeeCategoryAmountController::class, 'feeAmountDetails'])->name('fee.amount.detials');

        // Exam Type Routes
        Route::get('/view/exam/type', [ExamTypeController::class, 'viewExamType'])->name('view.exam.type');
        Route::get('/add/exam/type', [ExamTypeController::class, 'examTypeAdd'])->name('exam.type.add');
        Route::post('/store/exam/type', [ExamTypeController::class, 'examTypeStore'])->name('exam.type.store');
        Route::get('/edit/exam/type/{id}', [ExamTypeController::class, 'examTypeEdit'])->name('exam.type.edit');
        Route::post('/update/exam/type/{id}', [ExamTypeController::class, 'examTypeUpdate'])->name('exam.type.update');
        Route::get('/delete/exam/type/{id}', [ExamTypeController::class, 'examTypeDelete'])->name('exam.type.delete');

        // School Subject Routes
        Route::get('/view/school/subject', [SchoolSubjectController::class, 'viewSchoolSubject'])->name('view.school.subject');
        Route::get('/add/school/subject', [SchoolSubjectController::class, 'schoolSubjectAdd'])->name('school.subject.add');
        Route::post('/store/school/subject', [SchoolSubjectController::class, 'schoolSubjectStore'])->name('school.subject.store');
        Route::get('/edit/school/subject/{id}', [SchoolSubjectController::class, 'schoolSubjectEdit'])->name('school.subject.edit');
        Route::post('/update/school/subject/{id}', [SchoolSubjectController::class, 'schoolSubjectUpdate'])->name('school.subject.update');
        Route::get('/delete/school/subject/{id}', [SchoolSubjectController::class, 'schoolSubjectDelete'])->name('school.subject.delete');

        // Assign Subject Routes
        Route::get('/view/assing/subject', [AssignSubjectController::class, 'viewAssignSubject'])->name('view.assign.subject');
        Route::get('/add/assing/subject', [AssignSubjectController::class, 'assignSubjectAdd'])->name('assign.subject.add');
        Route::post('/store/assing/subject', [AssignSubjectController::class, 'assignSubjectStore'])->name('assign.subject.store');
        Route::get('/edit/assing/subject/{class_id}', [AssignSubjectController::class, 'assignSubjectEdit'])->name('assign.subject.edit');
        Route::post('/update/assing/subject/{class_id}', [AssignSubjectController::class, 'assignSubjectUpdate'])->name('assign.subject.update');
        Route::get('/detials/assing/subject/{class_id}', [AssignSubjectController::class, 'assignSubjectDetails'])->name('assign.subject.detials');

        // Designation Routes
        Route::get('/view/designation', [DesignationController::class, 'viewDesignation'])->name('view.designation');
        Route::get('/add/designation', [DesignationController::class, 'designationAdd'])->name('designation.add');
        Route::post('/store/designation', [DesignationController::class, 'designationStore'])->name('designation.store');
        Route::get('/edit/designation/{id}', [DesignationController::class, 'designationEdit'])->name('designation.edit');
        Route::post('/update/designation/{id}', [DesignationController::class, 'designationUpdate'])->name('designation.update');
        Route::get('/delete/designation/{id}', [DesignationController::class, 'designationDelete'])->name('designation.delete');
    });

    // student management routes
    Route::prefix('students')->group(function(){

        Route::get('/reg/view', [StudentRegController::class, 'viewStudentReg'])->name('view.student.reg');
        Route::get('/reg/add', [StudentRegController::class, 'studentRegAdd'])->name('student.reg.add');
        Route::post('/reg/store', [StudentRegController::class, 'studentRegStore'])->name('student.reg.store');
        Route::get('/year/class/wise', [StudentRegController::class, 'studentYearClassWise'])->name('student.year.class.wise');
        Route::get('/reg/edit/{student_id}', [StudentRegController::class, 'studentRegEdit'])->name('student.reg.edit');
        Route::post('/reg/update/{student_id}', [StudentRegController::class, 'studentRegUpdate'])->name('student.reg.update');
        Route::get('/reg/promotion/{student_id}', [StudentRegController::class, 'studentRegPromotion'])->name('student.reg.promotion');
        Route::post('/reg/promotion/update/{student_id}', [StudentRegController::class, 'studentRegPromotionUpdate'])->name('student.reg.promotion.update');
        Route::get('/reg/details/{student_id}', [StudentRegController::class, 'studentRegDetails'])->name('student.reg.details');

        // Roll Generate
        Route::get('/roll/generate/view', [StudentRollController::class, 'viewRollGenerate'])->name('view.roll.generate');
        Route::get('/reg/registration/getstudents', [StudentRollController::class, 'getStudents'])->name('student.registration.getstudents');
        Route::post('/roll/store', [StudentRollController::class, 'studentRollStore'])->name('student.roll.store');

        // Registration Fee
        Route::get('/registration/fee/view', [RegistrationFeeController::class, 'viewRegistrationFee'])->name('view.registration.fee');
        Route::get('/registration/fee/classwise', [RegistrationFeeController::class, 'regFeeClassData'])->name('student.registration.fee.classwise.get');
        Route::get('/registration/fee/payslip', [RegistrationFeeController::class, 'regFeePaySlip'])->name('student.registration.fee.payslip');

        // Monthly Fee
        Route::get('/monthly/fee/view', [MonthlyFeeController::class, 'viewMonthlyFee'])->name('view.monthly.fee');
        Route::get('/monthly/fee/classwise', [MonthlyFeeController::class, 'monthlyFeeClassData'])->name('student.monthly.fee.classwise.get');
        Route::get('/monthly/fee/payslip', [MonthlyFeeController::class, 'monthlyFeePaySlip'])->name('student.monthly.fee.payslip');

        // Exam Fee
        Route::get('/exam/fee/view', [ExamFeeController::class, 'viewExamFee'])->name('view.exam.fee');
        Route::get('/exam/fee/classwise', [ExamFeeController::class, 'examFeeClassData'])->name('student.exam.fee.classwise.get');
        Route::get('/exam/fee/payslip', [ExamFeeController::class, 'examFeePaySlip'])->name('student.exam.fee.payslip');

    });

    // employee management routes
    Route::prefix('employees')->group(function(){

        // Employee Registration
        Route::get('/reg/view', [EmployeeRegController::class, 'viewEmployeeReg'])->name('view.employee.reg');
        Route::get('/reg/add', [EmployeeRegController::class, 'addEmployeeReg'])->name('employee.reg.add');
        Route::post('/reg/store', [EmployeeRegController::class, 'storeEmployeeReg'])->name('employee.reg.store');
        Route::get('/reg/edit/{id}', [EmployeeRegController::class, 'editEmployeeReg'])->name('employee.reg.edit');
        Route::post('/reg/update/{id}', [EmployeeRegController::class, 'updateEmployeeReg'])->name('employee.reg.update');
        Route::get('/reg/details/{id}', [EmployeeRegController::class, 'detailsEmployeeReg'])->name('employee.reg.details');

        // Employee Salary
        Route::get('/salary/view', [EmployeeSalaryController::class, 'viewEmployeeSalary'])->name('view.employee.salary');
        Route::get('/salary/increment/{id}', [EmployeeSalaryController::class, 'incrementEmployeeSalary'])->name('employee.salary.increment');
        Route::post('/salary/increment/update/{id}', [EmployeeSalaryController::class, 'incrementEmployeeSalaryUpdate'])->name('employee.increment.salary.update');
        Route::get('/salary/details/{id}', [EmployeeSalaryController::class, 'detailsEmployeeSalary'])->name('employee.salary.details');

        // Employee Leave
        Route::get('/leave/view', [EmployeeLeaveController::class, 'viewEmployeeLeave'])->name('view.employee.leave');
        Route::get('/leave/add', [EmployeeLeaveController::class, 'addEmployeeLeave'])->name('employee.leave.add');
        Route::post('/leave/store', [EmployeeLeaveController::class, 'storeEmployeeLeave'])->name('employee.leave.store');
        Route::get('/leave/edit/{id}', [EmployeeLeaveController::class, 'editEmployeeLeave'])->name('employee.leave.edit');
        Route::post('/leave/update/{id}', [EmployeeLeaveController::class, 'updateEmployeeLeave'])->name('employee.leave.update');
        Route::get('/leave/delete/{id}', [EmployeeLeaveController::class, 'deleteEmployeeLeave'])->name('employee.leave.delete');


        // Employee Attendance
        Route::get('/attendance/view', [EmployeeAttendanceController::class, 'viewEmployeeAttendance'])->name('view.employee.attendance');
        Route::get('/attendance/add', [EmployeeAttendanceController::class, 'addEmployeeAttendance'])->name('employee.attendance.add');
        Route::post('/attendance/store', [EmployeeAttendanceController::class, 'storeEmployeeAttendance'])->name('employee.attendance.store');
        Route::get('/attendance/edit/{date}', [EmployeeAttendanceController::class, 'editEmployeeAttendance'])->name('employee.attendance.edit');
        Route::get('/attendance/details/{date}', [EmployeeAttendanceController::class, 'detailsEmployeeAttendance'])->name('employee.attendance.details');

    });


});


