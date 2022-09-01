<?php

namespace App\Http\Controllers\Backend\Account;

use App\Models\FeeCategory;
use App\Models\StudentYear;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\AccountStudentFee;
use App\Models\FeeCategoryAmount;
use App\Http\Controllers\Controller;

class StudentFeeController extends Controller
{
    /**
     * @access private
     * @routes /accounts/student/fee/view
     * @method GET
     */
    public function viewStudentFee(){
        $all_data = AccountStudentFee::all();
        return view('backend.account.student_fee.student_fee_view', compact('all_data'));
    }

    /**
     * @access private
     * @routes /accounts/student/fee/add
     * @method GET
     */
    public function addStudentFee(){
        $years = StudentYear::all();
        $classes = StudentClass::all();
        $fee_categories = FeeCategory::all();
        return view('backend.account.student_fee.student_fee_add', compact('years','classes', 'fee_categories'));
    }

    /**
     * @access private
     * @routes /accounts/student/fee/getstudent
     * @method GET
     */
    public function studentFeeGetStudent(Request $request){

        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $fee_category_id = $request->fee_category_id;
        $date = date('Y-m-d',strtotime($request->date));

        $data = AssignStudent::with(['discount'])->where('year_id',$year_id)->where('class_id',$class_id)->get();

        $html['thsource']  = '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Father Name</th>';
        $html['thsource'] .= '<th>Original Fee </th>';
        $html['thsource'] .= '<th>Discount Amount</th>';
        $html['thsource'] .= '<th>Fee (This Student)</th>';
        $html['thsource'] .= '<th>Select</th>';

        foreach ($data as $key => $std) {
            $registrationfee = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->where('class_id',$std->class_id)->first();

            $accountstudentfees = AccountStudentFee::where('student_id',$std->student_id)->where('year_id',$std->year_id)->where('class_id',$std->class_id)->where('fee_category_id',$fee_category_id)->where('date',$date)->first();

            if($registrationfee != ''){
                $amount = $registrationfee->amount;
            }else {
                $amount = 0;
            }

            if($accountstudentfees !=null) {
                $checked = 'checked';
            }else{
                $checked = '';
            }

            $color = 'success';
            $html[$key]['tdsource']  = '<td>'.$std['student']['id_no']. '<input type="hidden" name="fee_category_id" value= " '.$fee_category_id.' " >'.'</td>';

            $html[$key]['tdsource']  .= '<td>'.$std['student']['name']. '<input type="hidden" name="year_id" value= " '.$std->year_id.' " >'.'</td>';

            $html[$key]['tdsource']  .= '<td>'.$std['student']['fname']. '<input type="hidden" name="class_id" value= " '.$std->class_id.' " >'.'</td>';

            $html[$key]['tdsource']  .= '<td>'.$amount.'$'.'<input type="hidden" name="date" value= " '.$date.' " >'.'</td>';

            $html[$key]['tdsource'] .= '<td>'.$std['discount']['discount'].'%'.'</td>';

            $orginalfee = $amount;
            $discount = $std['discount']['discount'];
            $discountablefee = $discount/100*$orginalfee;
            $finalfee = (int)$orginalfee-(int)$discountablefee;

            $html[$key]['tdsource'] .='<td>'. '<input type="text" name="amount[]" value="'.$finalfee.' " class="form-control" readonly'.'</td>';

            $html[$key]['tdsource'] .='<td>'.'<input type="hidden" name="student_id[]" value="'.$std->student_id.'">'.'<input type="checkbox" name="checkmanage[]" id="'.$key.'" value="'.$key.'" '.$checked.' style="transform: scale(1.5);margin-left: 10px;"> <label for="'.$key.'"> </label> '.'</td>';

          }
         return response()->json(@$html);
    }

    /**
     * @access private
     * @routes /accounts/student/fee/store
     * @method POST
     */
    public function storeStudentFee(Request $request){

        $date = date('Y-m-d',strtotime($request->date));

        AccountStudentFee::where(['year_id'=>$request->year_id,'class_id'=>$request->class_id,'fee_category_id'=>$request->fee_category_id,'date'=>$request->date])->delete();

        $checkdata = $request->checkmanage;

        if($checkdata != null){
            for ($i=0; $i < count($checkdata); $i++) {
                $data = new AccountStudentFee();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->date = $date;
                $data->fee_category_id = $request->fee_category_id;
                $data->student_id = $request->student_id[$checkdata[$i]];
                $data->amount = $request->amount[$checkdata[$i]];
                $data->save();
            }
        }

        if(!empty(@$data) || empty($checkdata)){
            $notification = [
                'message' => 'Well Done Data Updated Successfully ):',
                'alert-type' => 'info'
            ];

            return redirect()->route('student.fee.view')->with($notification);
        }else {
            $notification = [
                'message' => 'Sorry Data not saved!',
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }

    }
}
