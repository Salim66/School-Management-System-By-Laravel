<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\User;
use Illuminate\Http\Request;
use Dompdf\Dompdf;


class AttenReportController extends Controller
{
    /**
     * @access private
     * @routes /reports/attandance/report/view
     * @method GET
     */
    public function viewAttendanceReport(){
        $employees = User::where('user_type', 'Employee')->get();
        return view('backend.report.attend_report.attend_report_view', compact('employees'));
    }

    /**
     * @access private
     * @routes /reports/attandance/report/get
     * @method GET
     */
    public function getAttendanceReport(Request $request){

        $employee_id = $request->employee_id;
        if($employee_id != ''){
            $where[] = ['employee_id', $employee_id];
        }
        $date = date('Y-m', strtotime($request->date));
        if($date != ''){
            $where[] = ['date', 'like', $date.'%'];
        }

        $single_attendance = EmployeeAttendance::with('employee')->where($where)->first();

        if($single_attendance == true){
            $all_data = EmployeeAttendance::with('employee')->where($where)->get();

            $absents = EmployeeAttendance::with('employee')->where($where)->where('attend_status', 'Absent')->count();
            $leaves = EmployeeAttendance::with('employee')->where($where)->where('attend_status', 'Leave')->count();
            $month = date('m-Y', strtotime($request->date));

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
                            <strong>Employee Attendance Report</strong><br>
                        </td>
                    </tr>
                    </table>
                    <br><br>
                    <div class="row">
                        <span><strong>Employee Name: </strong>'.$all_data[0]['employee']['name'].' <strong>ID No: </strong>'.$all_data[0]['employee']['id_no'].'  <strong>Month: </strong>'.$month.'</span>
                    </div>
                    <br>
                    <table id="customers">
                    <tr>
                        <td width="50%"><strong>Date</strong></td>
                        <td width="50%"><strong>Attend Status</strong></td>
                    </tr>';

                    foreach($all_data as $data){
              $text .='<tr>
                        <td>'.date('d-m-Y', strtotime($data->date)).'</td>
                        <td>'.$data->attend_status.'</td>
                    </tr>';
                    }


              $text .='

                    <tr>
                        <td><strong>Total Absent: </strong>'.$absents.' <strong>Total Leave: </strong>'.$leaves.'</td>
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


        }else {
            $notification = [
                'message' => "Sorry these criteria doesn't match!",
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }

    }
}
