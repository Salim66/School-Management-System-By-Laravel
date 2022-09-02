<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class MarkSheetGenerateController extends Controller
{
    /**
     * @access private
     * @routes /reports/marksheet/generate/view
     * @method GET
     */
    public function viewMarkSheetGenerate(){
        $years = StudentYear::all();
        $classes = StudentClass::all();
        $exam_types = ExamType::all();
        return view('backend.report.marksheet.marksheet_view', compact('years', 'classes', 'exam_types'));
    }

    /**
     * @access private
     * @routes /reports/marksheet/get
     * @method POST
     */
    public function markSheetGet(){
        // $years = StudentYear::all();
        // $classes = StudentClass::all();
        // $exam_types = ExamType::all();
        // return view('backend.report.marksheet.marksheet_view', compact('years', 'classes', 'exam_types'));
    }
}
