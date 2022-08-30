<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use Illuminate\Http\Request;

class EmployeeAttendanceController extends Controller
{
    /**
     * @access private
     * @routes /employees/attendance/view
     * @method GET
     */
    public function viewEmployeeAttendance(){
        $all_data = EmployeeAttendance::orderBy('id', 'DESC')->get();
        return view('backend.employee.employee_attendance.employee_attendance_view', compact('all_data'));
    }

}
