<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Models\AccountEmployeeSalary;
use App\Models\AccountOtherCost;
use App\Models\AccountStudentFee;
use Illuminate\Http\Request;

class ProfitController extends Controller
{
    /**
     * @access private
     * @routes /accounts/monthly/profit/view
     * @method GET
     */
    public function viewMonthlyProfit(){
        return view('backend.report.profit.profit_view');
    }

    /**
     * @access private
     * @routes /accounts/monthly/profit/get
     * @method GET
     */
    public function getMonthlyProfit(Request $request){

        $start_date = date('Y-m', strtotime($request->start_date));
        $end_date = date('Y-m', strtotime($request->end_date));
        $sdate = date('Y-m-d', strtotime($request->start_date));
        $edate = date('Y-m-d', strtotime($request->end_date));

        $student_fee = AccountStudentFee::whereBetween('date', [$sdate, $edate])->sum('amount');
        $other_cost = AccountOtherCost::whereBetween('date', [$sdate, $edate])->sum('amount');
        $emp_salary = AccountEmployeeSalary::whereBetween('date', [$start_date, $end_date])->sum('amount');

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
}
