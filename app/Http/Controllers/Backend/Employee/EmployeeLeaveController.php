<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeLeave;
use App\Models\LeavePurpose;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeLeaveController extends Controller
{
    /**
     * @access private
     * @routes /employees/leave/view
     * @method GET
     */
    public function viewEmployeeLeave(){
        $all_data = EmployeeLeave::orderBy('id', 'DESC')->get();
        return view('backend.employee.employee_leave.employee_leave_view', compact('all_data'));
    }

    /**
     * @access private
     * @routes /employee/leave/add
     * @method GET
     */
    public function addEmployeeLeave(){
        $employees = User::where('user_type', 'Employee')->get();
        $purposes = LeavePurpose::all();
        return view('backend.employee.employee_leave.employee_leave_add', compact('employees', 'purposes'));
    }

    /**
     * @access private
     * @routes /employee/leave/store
     * @method POST
     */
    public function storeEmployeeLeave(Request $request){

        if($request->isMethod('post')){

            if($request->leave_purpose_id == '0'){
                $leave_purpose = new LeavePurpose();
                $leave_purpose->name = $request->name;
                $leave_purpose->save();
                $leave_purpose_id = $leave_purpose->id;
            }else {
                $leave_purpose_id = $request->leave_purpose_id;
            }

            $data = new EmployeeLeave();
            $data->employee_id = $request->employee_id;
            $data->leave_purpose_id = $leave_purpose_id;
            $data->start_date = date('Y-m-d', strtotime($request->start_date));
            $data->end_date = date('Y-m-d', strtotime($request->end_date));
            $data->save();

            $notification = [
                'message' => 'Employee Leave Date Inserted Successfully ):',
                'alert-type' => 'success'
            ];

            return redirect()->route('view.employee.leave')->with($notification);

        }

    }
}
