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

    /**
     * @access private
     * @routes /marks/grade/add
     * @method GET
     */
    public function addGrade(){
        return view('backend.marks.grade_marks_add');
    }

    /**
     * @access private
     * @routes /marks/grade/store
     * @method POST
     */
    public function storeGrade(Request $request){

        if($request->isMethod('post')){
            $grade = new MarksGrade();
            $grade->grade_name = $request->grade_name;
            $grade->grade_point = $request->grade_point;
            $grade->start_marks = $request->start_marks;
            $grade->end_marks = $request->end_marks;
            $grade->start_point = $request->start_point;
            $grade->end_point = $request->end_point;
            $grade->remarks = $request->remarks;
            $grade->save();

            $notification = [
                'message' => 'Student Grade Added Successfully ):',
                'alert-type' => 'success'
            ];

            return redirect()->route('view.grade.marks')->with($notification);

        }

    }

    /**
     * @access private
     * @routes /marks/grade/edit/{id}
     * @method GET
     */
    public function editGrade($id){
        $data = MarksGrade::find($id);
        return view('backend.marks.grade_marks_edit', compact('data'));
    }

    /**
     * @access private
     * @routes /marks/grade/update/{id}
     * @method POST
     */
    public function updateGrade(Request $request, $id){

        if($request->isMethod('post')){
            $grade = MarksGrade::find($id);
            $grade->grade_name = $request->grade_name;
            $grade->grade_point = $request->grade_point;
            $grade->start_marks = $request->start_marks;
            $grade->end_marks = $request->end_marks;
            $grade->start_point = $request->start_point;
            $grade->end_point = $request->end_point;
            $grade->remarks = $request->remarks;
            $grade->save();

            $notification = [
                'message' => 'Student Grade Updated Successfully ):',
                'alert-type' => 'info'
            ];

            return redirect()->route('view.grade.marks')->with($notification);

        }

    }


}
