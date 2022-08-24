<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use Illuminate\Http\Request;

class StudentRegController extends Controller
{
    /**
     * @access private
     * @routes /students/reg/view
     * @method GET
     */
    public function viewStudentReg(){
        $all_data = AssignStudent::all();
        return view('backend.student.student_reg.student_view', compact('all_data'));
    }

    /**
     * @access private
     * @routes /students/reg/add
     * @method GET
     */
    public function studentRegAdd(){
        return view('backend.student.student_reg.student_add');
    }
}
