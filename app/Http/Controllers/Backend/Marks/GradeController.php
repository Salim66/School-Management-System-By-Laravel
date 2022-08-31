<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use App\Models\MarksGrade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * @access private
     * @routes /marks/grade/view
     * @method GET
     */
    public function viewGrade(){
        $all_data = MarksGrade::all();
        return view('backend.marks.grade_marks_view', compact('all_data'));
    }
}
