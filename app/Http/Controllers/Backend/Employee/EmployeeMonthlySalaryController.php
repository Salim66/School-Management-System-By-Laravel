<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

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
     * @routes /employee/monthly/salary/payslip/{employee_id}
     * @method GET
     */
    public function payslipEmployeeMonthlySalary(Request $request, $employee_id){


        $data = EmployeeAttendance::where(['employee_id'=>$employee_id])->first();

        $date = date('Y-m', strtotime($data->date));
        if ($date !='') {
            $where[] = ['date','like',$date.'%'];
        }

        $details = EmployeeAttendance::with(['employee'])->where($where)->where('employee_id', $data->employee_id)->get();

        $salary = (float)$details[0]['employee']['salary'];
        $salaryparday = (float)$salary/30;
        $absentcount = count($details->where('attend_status', 'Absent'));
        $totalsalaryminus = (float)$absentcount*(float)$salaryparday;
        $totalsalary = (float)$salary-(float)$totalsalaryminus;

        $text = '<!DOCTYPE html>
            <html>
            <head>
            <style>
            #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            }

            #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
            }

            #customers tr:nth-child(even){background-color: #f2f2f2;}

            #customers tr:hover {background-color: #ddd;}

            #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
            }
            </style>
            </head>
            <body>

            <table id="customers">
            <tr>
                <td>
                    <h2>Easy Learning</h2>
                </td>
                <td>
                    <h2>Easy School ERP</h2>
                    School Address <br>
                    Phone: 01773980593<br>
                    Email: salimhasanriad@gmail.com<br>
                    <strong>Employee Monthly Salary</strong><br>
                </td>
            </tr>
            </table>

            <table id="customers">
            <tr>
                <th>SL</th>
                <th>Employee Details</th>
                <th>Employee Data</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Employee Name</td>
                <td>'.$details[0]['employee']['name'].'</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Basic Salary</td>
                <td>'.$salary.'</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Total Absent For This Month</td>
                <td>'.$absentcount.'</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Month</td>
                <td>'.date('F,Y', strtotime($details[0]['date'])).'</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Salary This Month</td>
                <td>'.$totalsalary.'</td>
            </tr>


            </table>
            <br><br>
            <i>Print Date: '.date('Y-m-d').'</i>
            <br>
            <br>
            <hr style="border: 1px dotted #000000; width: 100%; margin-bottom: 25px;">

            <table id="customers">
            <tr>
                <td>
                    <h2>Easy Learning</h2>
                </td>
                <td>
                    <h2>Easy School ERP</h2>
                    School Address <br>
                    Phone: 01773980593<br>
                    Email: salimhasanriad@gmail.com<br>
                    <strong>Student Registration Fee</strong><br>
                </td>
            </tr>
            </table>

            <table id="customers">
            <tr>
                <td>
                    <h2>Easy Learning</h2>
                </td>
                <td>
                    <h2>Easy School ERP</h2>
                    School Address <br>
                    Phone: 01773980593<br>
                    Email: salimhasanriad@gmail.com<br>
                    <strong>Employee Monthly Salary</strong><br>
                </td>
            </tr>
            </table>

            <table id="customers">
            <tr>
                <th>SL</th>
                <th>Employee Details</th>
                <th>Employee Data</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Employee Name</td>
                <td>'.$details[0]['employee']['name'].'</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Basic Salary</td>
                <td>'.$salary.'</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Total Absent For This Month</td>
                <td>'.$absentcount.'</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Month</td>
                <td>'.date('F,Y', strtotime($details[0]['date'])).'</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Salary This Month</td>
                <td>'.$totalsalary.'</td>
            </tr>


            </table>
            <br><br>
            <i>Print Date: '.date('Y-m-d').'</i>

            </body>
        </html>';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($text);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();

    }
}
