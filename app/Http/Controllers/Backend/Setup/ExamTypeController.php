<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    /**
     * @access private
     * @routes /view/exam/type
     * @method GET
     */
    public function viewExamType(){
        $all_data = ExamType::all();
        return view('backend.setup.exam_type.view_exam_type', compact('all_data'));
    }

    /**
     * @access private
     * @routes /add/exam/type
     * @method GET
     */
    public function examTypeAdd(){
        return view('backend.setup.exam_type.add_exam_type');
    }

    /**
     * @access private
     * @routes /store/exam/type
     * @method POST
     */
    public function examTypeStore(Request $request){
        if($request->isMethod('post')){
            $this->validate($request, [
                'name' => 'required|unique:student_shifts,name'
            ]);

            ExamType::create([
                'name' => $request->name
            ]);

            $notification = [
                'message' => 'Exam Type Added Successfully :)',
                'alert-type' => 'success'
            ];
            return redirect()->route('view.exam.type')->with($notification);
        }
    }

    /**
     * @access private
     * @routes /edit/exam/type
     * @method GET
     */
    public function examTypeEdit($id){
        $data = ExamType::find($id);
        return view('backend.setup.exam_type.edit_exam_type', compact('data'));
    }

    /**
     * @access private
     * @routes /update/exam/type
     * @method POST
     */
    public function examTypeUpdate(Request $request, $id){
        if($request->isMethod('post')){


            ExamType::find($id)->update([
                'name' => $request->name
            ]);

            $notification = [
                'message' => 'Exam Type Updated Successfully :)',
                'alert-type' => 'info'
            ];
            return redirect()->route('view.exam.type')->with($notification);
        }
    }

    /**
     * @access private
     * @routes /delete/exam/type
     * @method GET
     */
    public function examTypeDelete($id){
        $data = ExamType::find($id);
        $data->delete();
        $notification = [
            'message' => 'Exam Type Deleted Successfully :)',
            'alert-type' => 'info'
        ];
        return redirect()->route('view.exam.type')->with($notification);
    }
}
