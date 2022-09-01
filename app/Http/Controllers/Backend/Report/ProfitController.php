<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Models\AccountEmployeeSalary;
use App\Models\AccountOtherCost;
use App\Models\AccountStudentFee;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

class ProfitController extends Controller
{
    /**
     * @access private
     * @routes /reports/monthly/profit/view
     * @method GET
     */
    public function viewMonthlyProfit(){
        return view('backend.report.profit.profit_view');
    }

    /**
     * @access private
     * @routes /reports/monthly/profit/get
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

        $total_cost = $other_cost + $emp_salary;
        $profit = $student_fee - $total_cost;

        // dd($allStudent);
        $html['thsource']  = '<th>Student Fee</th>';
        $html['thsource'] .= '<th>Other Cost</th>';
        $html['thsource'] .= '<th>Employee Salary</th>';
        $html['thsource'] .= '<th>Total Cost</th>';
        $html['thsource'] .= '<th>Porfit</th>';
        $html['thsource'] .= '<th>Action</th>';


        $color = 'success';
        $html['tdsource']  ='<td>'.$student_fee.'$'.'</td>';
        $html['tdsource'] .='<td>'.$other_cost.'$'.'</td>';
        $html['tdsource'] .='<td>'.$emp_salary.'$'.'</td>';
        $html['tdsource'] .='<td>'.$total_cost.'$'.'</td>';
        $html['tdsource'] .='<td>'.$profit.'$'.'</td>';
        $html['tdsource'] .='<td>';
        $html['tdsource'] .='<a class="btn btn-sm btn-'.$color.'" title="PDF" target="_blanks" href="'.route("report.profit.pdf").'?start_date='.$sdate.'&end_date='.$edate.'">PDF</a>';
        $html['tdsource'] .= '</td>';



        return response()->json(@$html);


    }

    /**
     * @access private
     * @routes /reports/report/profit/pdf
     * @method GET
     */
    public function reportProfitPDF(Request $request){

        $start_date = date('Y-m', strtotime($request->start_date));
        $end_date = date('Y-m', strtotime($request->end_date));
        $sdate = date('Y-m-d', strtotime($request->start_date));
        $edate = date('Y-m-d', strtotime($request->end_date));

        $student_fee = AccountStudentFee::whereBetween('date', [$sdate, $edate])->sum('amount');
        $other_cost = AccountOtherCost::whereBetween('date', [$sdate, $edate])->sum('amount');
        $emp_salary = AccountEmployeeSalary::whereBetween('date', [$start_date, $end_date])->sum('amount');

        $total_cost = $other_cost + $emp_salary;
        $profit = $student_fee - $total_cost;

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
                    <strong>Monthly and Yearly Profit</strong><br>
                </td>
            </tr>
            </table>

            <table id="customers">
            <tr>
                <td style="text-align:center;" colspan="2">
                    <h4>Reporting Data: '.date('d M Y', strtotime($sdate)) .' -- '. date('d M Y', strtotime($edate)).'</h4>
                </td>
            </tr>
            <tr>
                <td width="50%">Purpose</td>
                <td width="50%">Amount</td>
            </tr>
            <tr>
                <td>Student Fee</td>
                <td>'.$student_fee.'$'.'</td>
            </tr>
            <tr>
                <td>Other Cost</td>
                <td>'.$other_cost.'$'.'</td>
            </tr>
            <tr>
                <td>Employee Salary</td>
                <td>'.$emp_salary.'$'.'</td>
            </tr>
            <tr>
                <td>Total Cost</td>
                <td>'.$total_cost.'$'.'</td>
            </tr>
            <tr>
                <td>Profit</td>
                <td>'.$profit.'$'.'</td>
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
