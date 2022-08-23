<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    /**
     * View Student class
     */
    public function viewStudentClass(){
        $all_data = StudentClass::all();
        return view('backend.setup.student_class.view_class', compact('all_data'));
    }
}
