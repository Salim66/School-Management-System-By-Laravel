<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeSalaryLog;
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

    /**
     * @access private
     * @routes /employees/salary/increment/{id}
     * @method GET
     */
    public function incrementEmployeeSalary($id){
        $data = User::find($id);
        return view('backend.employee.employee_salary.employee_salary_increment', compact('data'));
    }

    /**
     * @access private
     * @routes /employees/salary/increment/update/{id}
     * @method POST
     */
    public function incrementEmployeeSalaryUpdate(Request $request, $id){

        $user = User::find($id);
        $previous_salary = $user->salary;
        $present_salary = (float)$previous_salary + (float)$request->increment_salary;
        $user->salary = $present_salary;
        $user->save();

        $salary_data = new EmployeeSalaryLog();
        $salary_data->employee_id = $id;
        $salary_data->previous_salary = $previous_salary;
        $salary_data->present_salary = $present_salary;
        $salary_data->increment_salary = $request->increment_salary;
        $salary_data->effected_salary = date('Y-m-d', strtotime($request->effected_salary));
        $salary_data->save();

        $notification = [
            'message' => 'Employee Salary Increment Successfully ):',
            'alert-type' => 'info'
        ];

        return redirect()->route('view.employee.salary')->with($notification);

    }
}
