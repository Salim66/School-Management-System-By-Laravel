<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use App\Models\MarksGrade;
use App\Models\StudentClass;
use App\Models\StudentMark;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class MarkSheetGenerateController extends Controller
{
    /**
     * @access private
     * @routes /reports/marksheet/generate/view
     * @method GET
     */
    public function viewMarkSheetGenerate(){
        $years = StudentYear::all();
        $classes = StudentClass::all();
        $exam_types = ExamType::all();
        return view('backend.report.marksheet.marksheet_view', compact('years', 'classes', 'exam_types'));
    }

    /**
     * @access private
     * @routes /reports/marksheet/get
     * @method GET
     */
    public function markSheetGet(Request $request){

        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;
        $id_no = $request->id_no;

        $count_fail = StudentMark::where(['year_id'=>$year_id, 'class_id'=>$class_id, 'exam_type_id'=>$exam_type_id, 'id_no'=>$id_no])->where('marks', '<', '33')->get()->count();
        $single_student = StudentMark::where(['year_id'=>$year_id, 'class_id'=>$class_id, 'exam_type_id'=>$exam_type_id, 'id_no'=>$id_no])->first();

        if($single_student == true){
            $all_marks = StudentMark::with(['assign_subject', 'year'])->where(['year_id'=>$year_id, 'class_id'=>$class_id, 'exam_type_id'=>$exam_type_id, 'id_no'=>$id_no])->get();

            $all_grades = MarksGrade::all();

            return view('backend.report.marksheet.marksheet_pdf', compact('count_fail', 'all_marks', 'all_grades'));
        }else {

            $notification = [
                'message' => "Sorry these criteria doesn't match!",
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);

        }

    }
}
