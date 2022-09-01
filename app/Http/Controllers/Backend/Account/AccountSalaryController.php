<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Models\AccountEmployeeSalary;
use Illuminate\Http\Request;

class AccountSalaryController extends Controller
{
    /**
     * @access private
     * @routes /accounts/employee/salary/view
     * @method GET
     */
    public function viewEmployeeSalary(){
        $all_data = AccountEmployeeSalary::all();
        return view('backend.account.employee_salary.employee_salary_view', compact('all_data'));
    }
}
