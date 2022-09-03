<?php

namespace App\Http\Controllers\Backend\Report;

use App\Models\ExamType;
use App\Models\StudentMark;
use App\Models\StudentYear;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;

        $single_student = StudentMark::where(['year_id'=>$year_id, 'class_id'=>$class_id, 'exam_type_id'=>$exam_type_id])->first();

        if($single_student == true){
            $all_data = StudentMark::select('year_id', 'class_id', 'exam_type_id', 'student_id')->where(['year_id'=>$year_id, 'class_id'=>$class_id, 'exam_type_id'=>$exam_type_id])->groupBy('year_id')->groupBy('class_id')->groupBy('exam_type_id')->groupBy('student_id')->get();



        }else {

            $notification = [
                'message' => "Sorry these criteria doesn't match!",
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);

        }
    }
}
