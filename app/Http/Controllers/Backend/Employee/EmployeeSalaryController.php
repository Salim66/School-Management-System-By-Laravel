<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeSalaryController extends Controller
{
    /**
     * @access private
     * @routes /employees/salary/view
     * @method GET
     */
    public function viewEmployeeSalary(){
        $all_data = User::where('user_type', 'Employee')->get();
        return view('backend.employee.employee_salary.employee_salary_view', compact('all_data'));
    }
}
