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
        $all_data = EmployeeAttendance::select('date')->groupBy('date')->orderBy('id', 'DESC')->get();
        // $all_data = EmployeeAttendance::orderBy('id', 'DESC')->get();
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

            // fist delete previous added data in same date wise
            EmployeeAttendance::where('date', date('Y-m-d', strtotime($request->date)))->delete();

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
                'message' => 'Employee Attendance Data Updated Successfully ):',
                'alert-type' => 'success'
            ];

            return redirect()->route('view.employee.attendance')->with($notification);

        }

    }

    /**
     * @access private
     * @routes /employees/attendance/edit/{date}
     * @method GET
     */
    public function editEmployeeAttendance($date){
        $all_data = EmployeeAttendance::where('date', $date)->get();
        return view('backend.employee.employee_attendance.employee_attendance_edit', compact('all_data'));
    }

    /**
     * @access private
     * @routes /employees/attendance/details/{date}
     * @method GET
     */
    public function detailsEmployeeAttendance($date){
        $all_data = EmployeeAttendance::where('date', $date)->get();
        return view('backend.employee.employee_attendance.employee_attendance_details', compact('all_data'));
    }

}
