<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class StudentRollController extends Controller
{
    /**
     * @access private
     * @routes /students/roll/generate/view
     * @method GET
     */
    public function viewRollGenerate(){
        $years = StudentYear::all();
        $classes = StudentClass::all();
        return view('backend.student.roll_generate.roll_generate_view', compact('years', 'classes'));
    }

    /**
     * @access private
     * @#routes /students/reg/registration/getstudents
     * @method GET
     */
    public function getStudents(Request $request){
        $all_data = AssignStudent::with('student')->where(['year_id' => $request->year_id, 'class_id' => $request->class_id])->get();
        return response()->json($all_data);
    }

    /**
     * @access private
     * @#routes /students/roll/store
     * @method POST
     */
    public function studentRollStore(Request $request){

        $year_id = $request->year_id;
        $class_id = $request->class_id;
        if($request->student_id !== NULL){
            for ($i=0; $i < count($request->student_id); $i++) {
                AssignStudent::where(['year_id' => $year_id, 'class_id' => $class_id, 'student_id' => $request->student_id[$i]])->update(['roll' => $request->roll[$i]]);
            }
        }else {
            $notification = [
                'message' => 'There are no student found!',
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }

        $notification = [
            'message' => 'Well Done Studnet Roll Generate Successfully ):',
            'alert-type' => 'success'
        ];

        return redirect()->route('view.roll.generate')->with($notification);

    }
}
