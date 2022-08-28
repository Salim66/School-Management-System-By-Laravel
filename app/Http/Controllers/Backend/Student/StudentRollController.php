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
}
