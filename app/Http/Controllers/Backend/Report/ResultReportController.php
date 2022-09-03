<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class ResultReportController extends Controller
{
    /**
     * @access private
     * @routes /reports/student/result/view
     * @method GET
     */
    public function viewResultReport(){
        $years = StudentYear::all();
        $classes = StudentClass::all();
        $exam_types = ExamType::all();
        return view('backend.report.student_result.student_result_view', compact('years', 'classes', 'exam_types'));
    }

    /**
     * @access private
     * @routes /reports/student/result/get
     * @method GET
     */
    public function getStudentResult(Request $request){

    }
}
