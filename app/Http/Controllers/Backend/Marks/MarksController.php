<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use App\Models\StudentClass;
use App\Models\StudentMark;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class MarksController extends Controller
{
    /**
     * @access private
     * @routes /marks/entry/add
     * @method GET
     */
    public function addEntryMark(){
        $years = StudentYear::all();
        $classes = StudentClass::all();
        $exam_types = ExamType::all();
        return view('backend.marks.marks_add', compact('years', 'classes', 'exam_types'));
    }

    /**
     * @access private
     * @routes /marks/entry/store
     * @method POST
     */
    public function storeEntryMark(Request $request){

        if($request->isMethod('post')){
            $studentCount = $request->student_id;
            if($studentCount){
                for ($i=0; $i < count($studentCount) ; $i++) {
                    $data = new StudentMark();
                    $data->student_id = $request->student_id[$i];
                    $data->id_no = $request->id_no[$i];
                    $data->year_id = $request->year_id;
                    $data->class_id = $request->class_id;
                    $data->assign_subject_id = $request->assign_subject_id;
                    $data->exam_type_id = $request->exam_type_id;
                    $data->marks = $request->marks[$i];
                    $data->save();
                }

                $notification = [
                    'message' => 'Student Marks Inserted Successfully ):',
                    'alert-type' => 'success'
                ];

                return redirect()->back()->with($notification);

            }
        }

    }
}
