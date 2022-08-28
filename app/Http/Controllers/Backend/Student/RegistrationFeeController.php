<?php

namespace App\Http\Controllers\Backend\Student;

use App\Models\StudentYear;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\FeeCategoryAmount;
use Dompdf\Dompdf;

class RegistrationFeeController extends Controller
{
    /**
     * @access private
     * @routes /students/registration/fee/view
     * @method GET
     */
    public function viewRegistrationFee(){
        $years = StudentYear::all();
        $classes = StudentClass::all();
        return view('backend.student.registration_fee.registration_fee_view', compact('years', 'classes'));
    }

    /**
     * @access private
     * @routes /students/registration/fee/data
     * @method GET
     */
    public function regFeeClassData(Request $request){
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
    	 $html['thsource'] .= '<th>Reg Fee</th>';
    	 $html['thsource'] .= '<th>Discount </th>';
    	 $html['thsource'] .= '<th>Student Fee </th>';
    	 $html['thsource'] .= '<th>Action</th>';


    	 foreach ($allStudent as $key => $v) {
    	 	$registrationfee = FeeCategoryAmount::where('fee_category_id','1')->where('class_id',$v->class_id)->first();

            if($registrationfee != ''){
                $amount = $registrationfee->amount;
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
    	 	$html[$key]['tdsource'] .='<a class="btn btn-sm btn-'.$color.'" title="PaySlip" target="_blanks" href="'.route("student.registration.fee.payslip").'?class_id='.$v->class_id.'&student_id='.$v->student_id.'">Fee Slip</a>';
    	 	$html[$key]['tdsource'] .= '</td>';

    	 }
    	return response()->json(@$html);
    }

    /**
     * @access private
     * @routes /student/registration/fee/payslip
     * @method GET
     */
    public function regFeePaySlip(Request $request){
        $student_id = $request->student_id;
        $class_id = $request->class_id;

        $data = AssignStudent::with(['student', 'discount'])->where(['student_id'=>$student_id,'class_id'=>$class_id])->first();

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
                <td>Student Name</td>
                <td>'.$data->student->name.'</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Student ID No</td>
                <td>'.$data->student->id_no.'</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Student Roll</td>
                <td>'.$data->roll.'</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Father Name</td>
                <td>'.$data->student->fname.'</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Mother Name</td>
                <td>'.$data->student->mname.'</td>
            </tr>
            <tr>
                <td>6</td>
                <td>Mobile Number</td>
                <td>'.$data->student->mobile.'</td>
            </tr>
            <tr>
                <td>7</td>
                <td>Address</td>
                <td>'.$data->student->address.'</td>
            </tr>
            <tr>
                <td>8</td>
                <td>Gender</td>
                <td>'.$data->student->gender.'</td>
            </tr>
            <tr>
                <td>9</td>
                <td>Religion</td>
                <td>'.$data->student->religion.'</td>
            </tr>
            <tr>
                <td>10</td>
                <td>Date of birth</td>
                <td>'.$data->student->dob.'</td>
            </tr>
            <tr>
                <td>11</td>
                <td>Discount</td>
                <td>'.$data->discount->discount.'</td>
            </tr>
            <tr>
                <td>12</td>
                <td>Year</td>
                <td>'.$data->student_year->name.'</td>
            </tr>
            <tr>
                <td>13</td>
                <td>Class</td>
                <td>'.$data->student_class->name.'</td>
            </tr>
            <tr>
                <td>14</td>
                <td>Group</td>
                <td>'.$data->student_group->name.'</td>
            </tr>
            <tr>
                <td>15</td>
                <td>Shift</td>
                <td>'.$data->student_shift->name.'</td>
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
