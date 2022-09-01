<?php

namespace App\Http\Controllers\Backend\Account;

use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use App\Http\Controllers\Controller;
use App\Models\AccountEmployeeSalary;

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

    /**
     * @access private
     * @routes /accounts/employee/salary/add
     * @method GET
     */
    public function addEmployeeSalary(){
        return view('backend.account.employee_salary.employee_salary_add');
    }

    /**
     * @access private
     * @routes /accounts/employee/salary/getemployee
     * @method GET
     */
    public function employeeSalaryGetEmployee(Request $request){

        $date = date('Y-m', strtotime($request->date));
        if ($date !='') {
            $where[] = ['date','like',$date.'%'];
        }

        $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['employee'])->where($where)->get();
        // dd($allStudent);
        $html['thsource']  = '<th>SL</th>';
        $html['thsource']  = '<th>ID No</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary This Month</th>';
        $html['thsource'] .= '<th>Action</th>';


        foreach ($data as $key => $v) {

            $account_salary = AccountEmployeeSalary::where('employee_id', $v->employee_id)->where('date', $date)->first();

            if($account_salary !=null) {
                $checked = 'checked';
            }else{
                $checked = '';
            }

            $totalattend = EmployeeAttendance::with('employee')->where($where)->where('employee_id',$v->employee_id)->get();
            $absentcount = count($totalattend->where('attend_status', 'Absent'));


            $color = 'success';
            $html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['employee']['id_no'].'<input type="hidden" name="date" value="'.$date.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['employee']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['employee']['salary'].'</td>';

            $salary = (float)$v['employee']['salary'];
            $salaryparday = (float)$salary/30;
            $totalsalaryminus = (float)$absentcount*(float)$salaryparday;
            $totalsalary = (float)$salary-(float)$totalsalaryminus;

            $html[$key]['tdsource'] .='<td>'.$totalsalary.'$ <input type="hidden" name="amount[]" value="'.$totalsalary.'">'.'</td>';

            $html[$key]['tdsource'] .='<td>'.'<input type="hidden" name="employee_id[]" value="'.$v->employee_id.'">'.'<input type="checkbox" name="checkmanage[]" id="'.$key.'" value="'.$key.'" '.$checked.' style="transform: scale(1.5);margin-left: 10px;"> <label for="'.$key.'"> </label> '.'</td>';

        }

        return response()->json(@$html);


    }
}
