<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class MarksController extends Controller
{
    /**
     * @access private
     * @routes /marks/student/add
     * @method GET
     */
    public function addStudentMark(){
        $years = StudentYear::all();
        $classes = StudentClass::all();
        $exam_types = ExamType::all();
        return view('backend.marks.marks_add', compact('years', 'classes', 'exam_types'));
    }
}
