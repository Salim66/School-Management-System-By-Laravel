<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AttenReportController extends Controller
{
    /**
     * @access private
     * @routes /reports/attandance/report/view
     * @method GET
     */
    public function viewAttendanceReport(){
        $employees = User::where('user_type', 'Employee')->get();
        return view('backend.report.attend_report.attend_report_view', compact('employees'));
    }
}
