<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeLeave;
use App\Models\LeavePurpose;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeLeaveController extends Controller
{
    /**
     * @access private
     * @routes /employees/leave/view
     * @method GET
     */
    public function viewEmployeeLeave(){
        $all_data = EmployeeLeave::orderBy('id', 'DESC')->get();
        return view('backend.employee.employee_leave.employee_leave_view', compact('all_data'));
    }

    /**
     * @access private
     * @routes /employee/leave/add
     * @method GET
     */
    public function addEmployeeLeave(){
        $employees = User::where('user_type', 'Employee')->get();
        $purposes = LeavePurpose::all();
        return view('backend.employee.employee_leave.employee_leave_add', compact('employees', 'purposes'));
    }

    /**
     * @access private
     * @routes /employee/leave/store
     * @method POST
     */
    public function storeEmployeeLeave(Request $request){


    }
}
