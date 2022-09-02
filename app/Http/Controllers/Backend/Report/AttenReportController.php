<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
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

    /**
     * @access private
     * @routes /reports/attandance/report/get
     * @method GET
     */
    public function getAttendanceReport(Request $request){

        $employee_id = $request->employee_id;
        if($employee_id != ''){
            $where[] = ['employee_id', $employee_id];
        }
        $date = date('Y-m', strtotime($request->date));
        if($date != ''){
            $where[] = ['date', 'like', $date.'%'];
        }

        $single_attendance = EmployeeAttendance::with('employee')->where($where)->first();

        if($single_attendance == true){
            $all_data = EmployeeAttendance::with('employee')->where($where)->get();

            $absents = EmployeeAttendance::with('employee')->where($where)->where('attend_status', 'Absent')->count();
            $leaves = EmployeeAttendance::with('employee')->where($where)->where('attend_status', 'Leave')->count();
            $month = date('m-Y', strtotime($request->date));



        }else {
            $notification = [
                'message' => "Sorry these criteria doesn't match!",
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }

    }
}
