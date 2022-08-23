<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class StudentYearController extends Controller
{
    /**
     * @access private
     * @routes /view/student/year
     * @method GET
     */
    public function viewStudentYear(){
        $all_data = StudentYear::all();
        return view('backend.setup.student_year.view_year', compact('all_data'));
    }

    /**
     * @access private
     * @routes /add/student/year
     * @method GET
     */
    public function studentYearAdd(){
        return view('backend.setup.student_year.add_year');
    }

    /**
     * @access private
     * @routes /store/student/year
     * @method POST
     */
    public function studentYearStore(Request $request){
        if($request->isMethod('post')){
            $this->validate($request, [
                'name' => 'required|unique:student_years,name'
            ]);

            StudentYear::create([
                'name' => $request->name
            ]);

            $notification = [
                'message' => 'Student Year Added Successfully :)',
                'alert-type' => 'success'
            ];
            return redirect()->route('view.student.year')->with($notification);
        }
    }

    /**
     * @access private
     * @routes /edit/student/year
     * @method GET
     */
    public function studentYearEdit($id){
        $data = StudentYear::find($id);
        return view('backend.setup.student_year.edit_year', compact('data'));
    }

    /**
     * @access private
     * @routes /update/student/year
     * @method POST
     */
    public function studentYearUpdate(Request $request, $id){
        if($request->isMethod('post')){
            $this->validate($request, [
                'name' => 'required|unique:student_years,name'
            ]);

            StudentYear::find($id)->update([
                'name' => $request->name
            ]);

            $notification = [
                'message' => 'Student Year Updated Successfully :)',
                'alert-type' => 'info'
            ];
            return redirect()->route('view.student.year')->with($notification);
        }
    }

    /**
     * @access private
     * @routes /delete/student/year
     * @method GET
     */
    public function studentYearDelete($id){
        $data = StudentYear::find($id);
        $data->delete();
        $notification = [
            'message' => 'Student Year Deleted Successfully :)',
            'alert-type' => 'info'
        ];
        return redirect()->route('view.student.year')->with($notification);
    }
}
