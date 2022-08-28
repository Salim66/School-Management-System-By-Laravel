<?php

namespace App\Http\Controllers\Backend\Student;

use App\Models\StudentYear;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
