<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentYear;
use Illuminate\Http\Request;
use PHPUnit\TextUI\XmlConfiguration\Group;

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
        $years = StudentYear::all();
        $classes = StudentClass::all();
        $groups = StudentGroup::all();
        return view('backend.student.student_reg.student_add', compact('years', 'classes', 'groups'));
    }
}
