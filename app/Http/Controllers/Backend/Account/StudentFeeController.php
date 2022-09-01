<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Models\AccountStudentFee;
use App\Models\FeeCategory;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;

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
    public function studentFeeGetStudent(){

    }

    /**
     * @access private
     * @routes /accounts/student/fee/store
     * @method POST
     */
    public function storeStudentFee(Request $request){

    }
}
