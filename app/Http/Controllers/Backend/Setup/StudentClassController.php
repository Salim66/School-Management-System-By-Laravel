<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    /**
     * @access private
     * @routes /view/student/class
     * @method GET
     */
    public function viewStudentClass(){
        $all_data = StudentClass::all();
        return view('backend.setup.student_class.view_class', compact('all_data'));
    }

    /**
     * @access private
     * @routes /add/student/class
     * @method GET
     */
    public function studentClassAdd(){
        return view('backend.setup.student_class.add_class');
    }

    /**
     * @access private
     * @routes /store/student/class
     * @method POST
     */
    public function studentClassStore(Request $request){
        if($request->isMethod('post')){
            $this->validate($request, [
                'name' => 'required|unique:student_classes,name'
            ]);

            StudentClass::create([
                'name' => $request->name
            ]);

            $notification = [
                'message' => 'Student Class Added Successfully :)',
                'alert-type' => 'success'
            ];
            return redirect()->route('view.student.class')->with($notification);
        }
    }

    /**
     * @access private
     * @routes /edit/student/class
     * @method GET
     */
    public function studentClassEdit($id){
        $data = StudentClass::find($id);
        return view('backend.setup.student_class.edit_class', compact('data'));
    }

    /**
     * @access private
     * @routes /update/student/class
     * @method POST
     */
    public function studentClassUpdate(Request $request, $id){
        if($request->isMethod('post')){
            $this->validate($request, [
                'name' => 'required|unique:student_classes,name'
            ]);

            StudentClass::find($id)->update([
                'name' => $request->name
            ]);

            $notification = [
                'message' => 'Student Class Updated Successfully :)',
                'alert-type' => 'info'
            ];
            return redirect()->route('view.student.class')->with($notification);
        }
    }

    /**
     * @access private
     * @routes /delete/student/class
     * @method GET
     */
    public function studentClassDelete($id){
        $data = StudentClass::find($id);
        $data->delete();
        $notification = [
            'message' => 'Student Class Deleted Successfully :)',
            'alert-type' => 'info'
        ];
        return redirect()->route('view.student.class')->with($notification);
    }
}
