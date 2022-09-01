<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Models\AccountStudentFee;
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
        $all_data = AccountStudentFee::all();
        return view('backend.account.student_fee.student_fee_view', compact('all_data'));
    }
}
