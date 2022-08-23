<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentGroup;
use Illuminate\Http\Request;

class StudentGroupController extends Controller
{
    /**
     * @access private
     * @routes /view/student/group
     * @method GET
     */
    public function viewStudentGroup(){
        $all_data = StudentGroup::all();
        return view('backend.setup.student_group.view_group', compact('all_data'));
    }

    /**
     * @access private
     * @routes /add/student/group
     * @method GET
     */
    public function studentGroupAdd(){
        return view('backend.setup.student_group.add_group');
    }

    /**
     * @access private
     * @routes /store/student/group
     * @method POST
     */
    public function studentGroupStore(Request $request){
        if($request->isMethod('post')){
            $this->validate($request, [
                'name' => 'required|unique:student_groups,name'
            ]);

            StudentGroup::create([
                'name' => $request->name
            ]);

            $notification = [
                'message' => 'Student Group Added Successfully :)',
                'alert-type' => 'success'
            ];
            return redirect()->route('view.student.group')->with($notification);
        }
    }

    /**
     * @access private
     * @routes /edit/student/group
     * @method GET
     */
    public function studentGroupEdit($id){
        $data = StudentGroup::find($id);
        return view('backend.setup.student_group.edit_group', compact('data'));
    }

    /**
     * @access private
     * @routes /update/student/group
     * @method POST
     */
    public function studentGroupUpdate(Request $request, $id){
        if($request->isMethod('post')){


            StudentGroup::find($id)->update([
                'name' => $request->name
            ]);

            $notification = [
                'message' => 'Student Group Updated Successfully :)',
                'alert-type' => 'info'
            ];
            return redirect()->route('view.student.group')->with($notification);
        }
    }

    /**
     * @access private
     * @routes /delete/student/group
     * @method GET
     */
    public function studentGroupDelete($id){
        $data = StudentGroup::find($id);
        $data->delete();
        $notification = [
            'message' => 'Student Group Deleted Successfully :)',
            'alert-type' => 'info'
        ];
        return redirect()->route('view.student.group')->with($notification);
    }
}
