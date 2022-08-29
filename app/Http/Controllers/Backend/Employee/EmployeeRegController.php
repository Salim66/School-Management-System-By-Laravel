<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeRegController extends Controller
{
    /**
     * @access private
     * @routes /employees/reg/view
     * @method GET
     */
    public function viewEmployeeReg(){
        $all_data = User::where('user_type', 'Employee')->get();
        return view('backend.employee.employee_reg.employee_reg_view', compact('all_data'));
    }
}
