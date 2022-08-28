<?php

namespace App\Http\Controllers\Backend\Student;

use App\Models\StudentYear;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\FeeCategoryAmount;

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
    public function regFeePaySlip(){

    }
}
