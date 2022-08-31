<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    /**
     * @access private
     * @routes /marks/student/getsubject
     * @method GET
     */
    public function getSubjectMarks(Request $request){
        $class_id = $request->class_id;
        $all_data = AssignSubject::with('school_subject')->where('class_id', $class_id)->get();
        return response()->json($all_data);
    }
}
