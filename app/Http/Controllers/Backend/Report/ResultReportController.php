<?php

namespace App\Http\Controllers\Backend\Report;

use App\Models\ExamType;
use App\Models\StudentMark;
use App\Models\StudentYear;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use Dompdf\Dompdf;

class ResultReportController extends Controller
{
    /**
     * @access private
     * @routes /reports/student/result/view
     * @method GET
     */
    public function viewResultReport(){
        $years = StudentYear::all();
        $classes = StudentClass::all();
        $exam_types = ExamType::all();
        return view('backend.report.student_result.student_result_view', compact('years', 'classes', 'exam_types'));
    }

    /**
     * @access private
     * @routes /reports/student/result/get
     * @method GET
     */
    public function getStudentResult(Request $request){

        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;

        $single_student = StudentMark::where(['year_id'=>$year_id, 'class_id'=>$class_id, 'exam_type_id'=>$exam_type_id])->first();

        if($single_student == true){
            $all_data = StudentMark::select('year_id', 'class_id', 'exam_type_id', 'student_id')->where(['year_id'=>$year_id, 'class_id'=>$class_id, 'exam_type_id'=>$exam_type_id])->groupBy('year_id')->groupBy('class_id')->groupBy('exam_type_id')->groupBy('student_id')->get();


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
                            <strong>Student Result Report</strong><br>
                        </td>
                    </tr>
                    </table>
                    <br><br>
                    <div class="row">
                        <span><strong>Result of: </strong>'.$all_data[0]['exam_type']['name'].'</span>
                    </div>
                    <br>
                    <table id="customers">
                    <tr>
                        <td width="50%"><strong>Year/Session: </strong>'.$all_data[0]['year']['name'].'</td>
                        <td width="50%"><strong>Class: </strong>'.$all_data[0]['class']['name'].'</td>
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

    /**
     * @access private
     * $routes /reports/student/idcard/view
     * @method GET
     */
    public function viewStudentIDCard(){
        $years = StudentYear::all();
        $classes = StudentClass::all();
        return view('backend.report.student_card.student_card_view', compact('years', 'classes'));
    }

    /**
     * @access private
     * @routes /reports/student/idcard/get
     * @method GEt
     */
    public function getStudentIdCard(Request $request){

        $year_id = $request->year_id;
        $class_id = $request->class_id;

        $check_data = AssignStudent::where(['year_id'=>$year_id,'class_id'=>$class_id])->first();

        if($check_data == true){
            $all_data = AssignStudent::where(['year_id'=>$year_id,'class_id'=>$class_id])->get();

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
                        <strong>Student ID Card</strong><br>
                    </td>
                </tr>
                </table> <br><br>';

                foreach($all_data as $data){
            $text .='<table id="customers">
                    <tr>
                        <td>IMAGE</td>
                        <td>Easy School</td>
                        <td>Student ID Card</td>
                    </tr>
                    <tr>
                        <td>Name : '.$data->student->name.'</td>
                        <td>Session: '.$data->student_year->name.'</td>
                        <td>Class: '.$data->student_class->name.'</td>
                    </tr>
                    <tr>
                        <td>Roll : '.$data->roll.'</td>
                        <td>ID No: '.$data->student->id_no.'</td>
                        <td>Mobile: '.$data->student->mobile.'</td>
                    </tr>

                </table>';
                }

            $text .='<br><br>
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
