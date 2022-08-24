<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\SchoolSubject;
use Illuminate\Http\Request;

class SchoolSubjectController extends Controller
{
    /**
     * @access private
     * @routes /view/school/subject
     * @method GET
     */
    public function viewSchoolSubject(){
        $all_data = SchoolSubject::all();
        return view('backend.setup.school_subject.view_school_subject', compact('all_data'));
    }

    /**
     * @access private
     * @routes /add/school/subject
     * @method GET
     */
    public function schoolSubjectAdd(){
        return view('backend.setup.school_subject.add_school_subject');
    }

    /**
     * @access private
     * @routes /store/school/subject
     * @method POST
     */
    public function schoolSubjectStore(Request $request){
        if($request->isMethod('post')){
            $this->validate($request, [
                'name' => 'required|unique:student_shifts,name'
            ]);

            SchoolSubject::create([
                'name' => $request->name
            ]);

            $notification = [
                'message' => 'School Subject Added Successfully :)',
                'alert-type' => 'success'
            ];
            return redirect()->route('view.school.subject')->with($notification);
        }
    }

    /**
     * @access private
     * @routes /edit/school/subject
     * @method GET
     */
    public function schoolSubjectEdit($id){
        $data = SchoolSubject::find($id);
        return view('backend.setup.school_subject.edit_school_subject', compact('data'));
    }

    /**
     * @access private
     * @routes /update/school/subject
     * @method POST
     */
    public function schoolSubjectUpdate(Request $request, $id){
        if($request->isMethod('post')){


            SchoolSubject::find($id)->update([
                'name' => $request->name
            ]);

            $notification = [
                'message' => 'School Subject Updated Successfully :)',
                'alert-type' => 'info'
            ];
            return redirect()->route('view.school.subject')->with($notification);
        }
    }

    /**
     * @access private
     * @routes /delete/school/subject
     * @method GET
     */
    public function schoolSubjectDelete($id){
        $data = SchoolSubject::find($id);
        $data->delete();
        $notification = [
            'message' => 'School Subject Deleted Successfully :)',
            'alert-type' => 'info'
        ];
        return redirect()->route('view.school.subject')->with($notification);
    }
}
