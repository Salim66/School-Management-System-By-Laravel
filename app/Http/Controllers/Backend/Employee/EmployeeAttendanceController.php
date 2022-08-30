<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeAttendanceController extends Controller
{
    /**
     * @access private
     * @routes /employees/attendance/view
     * @method GET
     */
    public function viewEmployeeAttendance(){
        $all_data = EmployeeAttendance::orderBy('id', 'DESC')->get();
        return view('backend.employee.employee_attendance.employee_attendance_view', compact('all_data'));
    }

    /**
     * @access private
     * @routes /employees/attendance/add
     * @method GET
     */
    public function addEmployeeAttendance(){
        $employees = User::where('user_type', 'Employee')->get();
        return view('backend.employee.employee_attendance.employee_attendance_add', compact('employees'));
    }

    /**
     * @access private
     * @routes /employees/attendance/store
     * @method POST
     */
    public function storeEmployeeAttendance(Request $request){

        if($request->isMethod('post')){
            $countemployee = count($request->employee_id);
            for ($i=0; $i < $countemployee; $i++) {
                $attend_status = 'attend_status'.$i;
                $attend = new EmployeeAttendance();
                $attend->date = $request->date;
                $attend->employee_id = $request->employee_id[$i];
                $attend->attend_status = $request->$attend_status;
                $attend->save();
            }

            $notification = [
                'message' => 'Employee Attendance Data Added Successfully ):',
                'alert-type' => 'success'
            ];

            return redirect()->route('view.employee.attendance')->with($notification);

        }

    }

}
