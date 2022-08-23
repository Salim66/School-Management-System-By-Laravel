<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentShift;
use Illuminate\Http\Request;

class StudentShiftController extends Controller
{
    /**
     * @access private
     * @routes /view/student/shift
     * @method GET
     */
    public function viewStudentShift(){
        $all_data = StudentShift::all();
        return view('backend.setup.student_shift.view_shift', compact('all_data'));
    }

    /**
     * @access private
     * @routes /add/student/shift
     * @method GET
     */
    public function studentShiftAdd(){
        return view('backend.setup.student_shift.add_shift');
    }

    /**
     * @access private
     * @routes /store/student/shift
     * @method POST
     */
    public function studentShiftStore(Request $request){
        if($request->isMethod('post')){
            $this->validate($request, [
                'name' => 'required|unique:student_shifts,name'
            ]);

            StudentShift::create([
                'name' => $request->name
            ]);

            $notification = [
                'message' => 'Student Shift Added Successfully :)',
                'alert-type' => 'success'
            ];
            return redirect()->route('view.student.shift')->with($notification);
        }
    }

    /**
     * @access private
     * @routes /edit/student/shift
     * @method GET
     */
    public function studentShiftEdit($id){
        $data = StudentShift::find($id);
        return view('backend.setup.student_Shift.edit_Shift', compact('data'));
    }

    /**
     * @access private
     * @routes /update/student/shift
     * @method POST
     */
    public function studentShiftUpdate(Request $request, $id){
        if($request->isMethod('post')){


            StudentShift::find($id)->update([
                'name' => $request->name
            ]);

            $notification = [
                'message' => 'Student Shift Updated Successfully :)',
                'alert-type' => 'info'
            ];
            return redirect()->route('view.student.shift')->with($notification);
        }
    }

    /**
     * @access private
     * @routes /delete/student/shift
     * @method GET
     */
    public function studentShiftDelete($id){
        $data = StudentShift::find($id);
        $data->delete();
        $notification = [
            'message' => 'Student Shift Deleted Successfully :)',
            'alert-type' => 'info'
        ];
        return redirect()->route('view.student.shift')->with($notification);
    }
}
