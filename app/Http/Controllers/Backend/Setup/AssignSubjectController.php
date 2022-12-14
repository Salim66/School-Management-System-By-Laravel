<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignSubject;
use App\Models\SchoolSubject;
use App\Http\Controllers\Controller;

class AssignSubjectController extends Controller
{
    /**
     * @access private
     * @routes /view/assing/subject
     * @method GET
     */
    public function viewAssignSubject(){
        // $all_data = AssignSubject::all();
        $all_data = AssignSubject::select('class_id')->groupBy('class_id')->get();
        return view('backend.setup.assign_subject.view_assign_subject', compact('all_data'));
    }

    /**
     * @access private
     * @routes /add/assing/subject
     * @method GET
     */
    public function assignSubjectAdd(){
        $subjects = SchoolSubject::all();
        $classes = StudentClass::all();
        return view('backend.setup.assign_subject.add_assign_subject', compact('subjects', 'classes'));
    }

    /**
     * @access private
     * @routes /store/assing/subject
     * @method POST
     */
    public function assignSubjectStore(Request $request){
        if($request->isMethod('post')){

            $countSubject = count($request->subject_id);

            if($countSubject !== NULL){
                for ($i=0; $i < $countSubject; $i++) {
                    AssignSubject::create([
                        'class_id' => $request->class_id,
                        'subject_id' => $request->subject_id[$i],
                        'full_mark' => $request->full_mark[$i],
                        'pass_mark' => $request->pass_mark[$i],
                        'subjective_mark' => $request->subjective_mark[$i],
                    ]);
                }
            }

            $notification = [
                'message' => 'Data Added Successfully :)',
                'alert-type' => 'success'
            ];
            return redirect()->route('view.assign.subject')->with($notification);
        }
    }

    /**
     * @access private
     * @routes /edit/assing/subject
     * @method GET
     */
    public function assignSubjectEdit($class_id){
        $data = AssignSubject::where('class_id', $class_id)->orderBy('subject_id', 'asc')->get();
        $subjects = SchoolSubject::all();
        $classes = StudentClass::all();
        return view('backend.setup.assign_subject.edit_assign_subject', compact('data', 'subjects', 'classes'));
    }

    /**
     * @access private
     * @routes /update/assing/subject
     * @method POST
     */
    public function assignSubjectUpdate(Request $request, $class_id){
        if($request->isMethod('post')){

            if($request->subject_id === NULL){
                $notification = [
                    'message' => 'Sorry you do not select any subject!',
                    'alert-type' => 'warning'
                ];
                return redirect()->route('assign.subject.edit', $class_id)->with($notification);
            }else {

                $countSubject = count($request->subject_id);
                AssignSubject::where('class_id', $class_id)->delete();
                for ($i=0; $i < $countSubject; $i++) {
                    AssignSubject::create([
                        'class_id' => $request->class_id,
                        'subject_id' => $request->subject_id[$i],
                        'full_mark' => $request->full_mark[$i],
                        'pass_mark' => $request->pass_mark[$i],
                        'subjective_mark' => $request->subjective_mark[$i],
                    ]);
                }

                $notification = [
                    'message' => 'Data Updated Successfully :)',
                    'alert-type' => 'info'
                ];
                return redirect()->route('view.assign.subject')->with($notification);

            }


        }
    }


    /**
     * @access private
     * @routes /details/assing/subject
     * @method GET
     */
    public function assignSubjectDetails($class_id){
        $all_data = AssignSubject::where('class_id', $class_id)->orderBy('subject_id', 'asc')->get();
        return view('backend.setup.assign_subject.details_assign_subject', compact('all_data'));
    }
}
