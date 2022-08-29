<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeLeave;
use Illuminate\Http\Request;

class EmployeeLeaveController extends Controller
{
    /**
     * @access private
     * @routes /employees/leave/view
     * @method GET
     */
    public function viewEmployeeLeave(){
        $all_data = EmployeeLeave::all();
        return view('backend.employee.employee_leave.employee_leave_view', compact('all_data'));
    }
}
