<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeMonthlySalaryController extends Controller
{
    /**
     * @access private
     * @routes /employees/monthly/salary/view
     * @method GET
     */
    public function viewEmployeeMonthlySalary(){
        return view('backend.employee.monthly_salary.monthly_salary_view');
    }

    /**
     * @access private
     * @routes /employees/monthly/salary/get
     * @method GET
     */
    public function getEmployeeMonthlySalary(Request $request){



    }
}
