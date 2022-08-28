<?php

namespace App\Http\Controllers\Backend\Student;

use Dompdf\Dompdf;
use App\Models\StudentYear;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\FeeCategoryAmount;
use App\Http\Controllers\Controller;
use App\Models\ExamType;

class ExamFeeController extends Controller
{
    /**
     * @access private
     * @routes /students/exam/fee/view
     * @method GET
     */
    public function viewExamFee(){
        $years = StudentYear::all();
        $classes = StudentClass::all();
        $exams = ExamType::all();
        return view('backend.student.exam_fee.exam_fee_view', compact('years', 'classes', 'exams'));
    }

    /**
     * @access private
     * @routes /students/exam/fee/data
     * @method GET
     */
    public function examFeeClassData(Request $request){
        $year_id = $request->year_id;
    	 $class_id = $request->class_id;
    	 if ($year_id !='') {
    	 	$where[] = ['year_id','like',$year_id.'%'];
    	 }
    	 if ($class_id !='') {
    	 	$where[] = ['class_id','like',$class_id.'%'];
    	 }
    	 $allStudent = AssignStudent::with(['discount'])->where($where)->get();
    	 // dd($allStudent);
    	 $html['thsource']  = '<th>SL</th>';
    	 $html['thsource'] .= '<th>ID No</th>';
    	 $html['thsource'] .= '<th>Student Name</th>';
    	 $html['thsource'] .= '<th>Roll No</th>';
    	 $html['thsource'] .= '<th>Exam Fee</th>';
    	 $html['thsource'] .= '<th>Discount </th>';
    	 $html['thsource'] .= '<th>Student Fee </th>';
    	 $html['thsource'] .= '<th>Action</th>';


    	 foreach ($allStudent as $key => $v) {
    	 	$examfee = FeeCategoryAmount::where('fee_category_id','3')->where('class_id',$v->class_id)->first();

            if($examfee != ''){
                $amount = $examfee->amount;
            }else {
                $amount = 0;
            }

    	 	$color = 'success';
    	 	$html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
    	 	$html[$key]['tdsource'] .= '<td>'.$v['student']['id_no'].'</td>';
    	 	$html[$key]['tdsource'] .= '<td>'.$v['student']['name'].'</td>';
    	 	$html[$key]['tdsource'] .= '<td>'.$v->roll.'</td>';
    	 	$html[$key]['tdsource'] .= '<td>'.$amount.'</td>';
    	 	$html[$key]['tdsource'] .= '<td>'.$v['discount']['discount'].'%'.'</td>';

    	 	$originalfee = $amount;
    	 	$discount = $v['discount']['discount'];
    	 	$discounttablefee = $discount/100*$originalfee;
    	 	$finalfee = (float)$originalfee-(float)$discounttablefee;

    	 	$html[$key]['tdsource'] .='<td>'.$finalfee.'$'.'</td>';
    	 	$html[$key]['tdsource'] .='<td>';
    	 	$html[$key]['tdsource'] .='<a class="btn btn-sm btn-'.$color.'" title="PaySlip" target="_blanks" href="'.route("student.exam.fee.payslip").'?class_id='.$v->class_id.'&student_id='.$v->student_id.'&exam_type_id='.$request->exam_type_id.'">Fee Slip</a>';
    	 	$html[$key]['tdsource'] .= '</td>';

    	 }

    	return response()->json(@$html);
    }

    /**
     * @access private
     * @routes /student/exam/fee/payslip
     * @method GET
     */
    public function examFeePaySlip(Request $request){
        $student_id = $request->student_id;
        $class_id = $request->class_id;
        $exam = ExamType::where('id', $request->exam_type_id)->first()->name;

        $data = AssignStudent::with(['student', 'discount'])->where(['student_id'=>$student_id,'class_id'=>$class_id])->first();

        $examfee = FeeCategoryAmount::where('fee_category_id','3')->where('class_id',$data->class_id)->first();

        if($examfee != ''){
            $amount = $examfee->amount;
        }else {
            $amount = 0;
        }

        $originalfee = $amount;
        $discount = $data['discount']['discount'];
        $discounttablefee = $discount/100*$originalfee;
        $finalfee = (float)$originalfee-(float)$discounttablefee;

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
                    <strong>Student Exam Fee</strong><br>
                </td>
            </tr>
            </table>

            <table id="customers">
            <tr>
                <th>SL</th>
                <th>Student Details</th>
                <th>Student Data</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Student ID No</td>
                <td>'.$data->student->id_no.'</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Roll No</td>
                <td>'.$data->roll.'</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Student Name</td>
                <td>'.$data->student->name.'</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Father Name</td>
                <td>'.$data->student->fname.'</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Session</td>
                <td>'.$data->student_year->name.'</td>
            </tr>
            <tr>
                <td>6</td>
                <td>Class</td>
                <td>'.$data->student_class->name.'</td>
            </tr>
            <tr>
                <td>7</td>
                <td>Exam Fee</td>
                <td>'.$amount.'$</td>
            </tr>
            <tr>
                <td>8</td>
                <td>Discount Fee</td>
                <td>'.$data->discount->discount.'%</td>
            </tr>
            <tr>
                <td>9</td>
                <td>Fee For This Student of '.$exam.'</td>
                <td>'.$finalfee.'$</td>
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
                    <strong>Student Exam Fee</strong><br>
                </td>
            </tr>
            </table>

            <table id="customers">
            <tr>
                <th>SL</th>
                <th>Student Details</th>
                <th>Student Data</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Student ID No</td>
                <td>'.$data->student->id_no.'</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Roll No</td>
                <td>'.$data->roll.'</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Student Name</td>
                <td>'.$data->student->name.'</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Father Name</td>
                <td>'.$data->student->fname.'</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Session</td>
                <td>'.$data->student_year->name.'</td>
            </tr>
            <tr>
                <td>6</td>
                <td>Class</td>
                <td>'.$data->student_class->name.'</td>
            </tr>
            <tr>
                <td>7</td>
                <td>Exam Fee</td>
                <td>'.$amount.'$</td>
            </tr>
            <tr>
                <td>8</td>
                <td>Discount Fee</td>
                <td>'.$data->discount->discount.'%</td>
            </tr>
            <tr>
                <td>9</td>
                <td>Fee For This Student of '.$exam.'</td>
                <td>'.$finalfee.'$</td>
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
