<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
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

        $date = date('Y-m', strtotime($request->date));
        if ($date !='') {
            $where[] = ['date','like',$date.'%'];
        }

        $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['employee'])->where($where)->get();
        // dd($allStudent);
        $html['thsource']  = '<th>SL</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary This Month</th>';
        $html['thsource'] .= '<th>Action</th>';


        foreach ($data as $key => $v) {
            $totalattend = EmployeeAttendance::with('employee')->where($where)->where('employee_id',$v->employee_id)->get();
            $absentcount = count($totalattend->where('attend_status', 'Absent'));


            $color = 'success';
            $html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['employee']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['employee']['salary'].'</td>';

            $salary = (float)$v['employee']['salary'];
            $salaryparday = (float)$salary/30;
            $totalsalaryminus = (float)$absentcount*(float)$salaryparday;
            $totalsalary = (float)$salary-(float)$totalsalaryminus;

            $html[$key]['tdsource'] .='<td>'.$totalsalary.'$'.'</td>';
            $html[$key]['tdsource'] .='<td>';
            $html[$key]['tdsource'] .='<a class="btn btn-sm btn-'.$color.'" title="PaySlip" target="_blanks" href="'.route("employee.monthly.salary.payslip",$v->employee_id).'">Fee Slip</a>';
            $html[$key]['tdsource'] .= '</td>';

        }

        return response()->json(@$html);

    }

    /**
     * @access private
     * @routes /employee/monthly/salary/payslip
     * @method GET
     */
    public function payslipEmployeeMonthlySalary(Request $request){

    }
}
