<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Models\User;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\EmployeeSalaryLog;

class EmployeeRegController extends Controller
{
    /**
     * @access private
     * @routes /employees/reg/view
     * @method GET
     */
    public function viewEmployeeReg(){
        $all_data = User::where('user_type', 'Employee')->get();
        return view('backend.employee.employee_reg.employee_reg_view', compact('all_data'));
    }

    /**
     * @access private
     * @routes /employees/reg/add
     * @method GET
     */
    public function addEmployeeReg(){
        $designations = Designation::all();
        return view('backend.employee.employee_reg.employee_reg_add', compact('designations'));
    }

    /**
     * @access private
     * @routes /employees/reg/store
     * @method POST
     */
    public function storeEmployeeReg(Request $request){

        if($request->isMethod('post')){
            // return $request->all(); die;
            DB::transaction(function() use($request){
                $check_year = date('Ym', strtotime($request->join_date));
                $student = User::where('user_type', 'Employee')->orderBy('id', 'DESC')->first();

                if($student == null){

                    $firstReg = 0;
                    $studentId = $firstReg + 1;

                    if($studentId < 10){
                        $id_no = '000'.$studentId;
                    }else if($studentId < 100){
                        $id_no = '00'.$studentId;
                    }else if($studentId < 1000){
                        $id_no = '0'.$studentId;
                    }

                }else {

                    $student = User::where('user_type', 'Employee')->orderBy('id', 'DESC')->first();
                    $studentId = $student->id + 1;

                    if($studentId < 10){
                        $id_no = '000'.$studentId;
                    }else if($studentId < 100){
                        $id_no = '00'.$studentId;
                    }else if($studentId < 1000){
                        $id_no = '0'.$studentId;
                    }

                }

                // Users Table
                $final_id_no = $check_year . $id_no;
                $user = new User();
                $code = rand(0000, 9999);
                $user->id_no = $final_id_no;
                $user->password = bcrypt($code);
                $user->user_type = 'Employee';
                $user->code = $code;
                $user->name = $request->name;
                $user->fname = $request->fname;
                $user->mname = $request->mname;
                $user->mobile = $request->mobile;
                $user->address = $request->address;
                $user->gender = $request->gender;
                $user->religion = $request->religion;
                $user->designation_id = $request->designation_id;
                $user->salary = $request->salary;
                $user->dob = date('Y-m-d', strtotime($request->dob));
                $user->join_date = date('Y-m-d', strtotime($request->join_date));

                $fileName = '';
                if($request->hasFile('profile_photo_path')){
                    $file = $request->file('profile_photo_path');
                    $fileName = date('YmdHi').'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('upload/employee_images/'), $fileName);
                }

                $user->profile_photo_path = $fileName;
                $user->save();


                // employee salary log table
                $employee_salary = new EmployeeSalaryLog();
                $employee_salary->employee_id = $user->id;
                $employee_salary->previous_salary = $request->salary;
                $employee_salary->present_salary = $request->salary;
                $employee_salary->increment_salary = 0;
                $employee_salary->effected_salary = date('Y-m-d', strtotime($request->join_date));;
                $employee_salary->save();

            });

            $notification = [
                'message' => 'Employee Registration Successfully ):',
                'alert-type' => 'success'
            ];

            return redirect()->route('view.employee.reg')->with($notification);

        }

    }

    /**
     * @access private
     * @routes /employee/reg/edit/{id}
     * @method GET
     */
    public function editEmployeeReg($id){
        $data = User::find($id);
        $designations = Designation::all();
        return view('backend.employee.employee_reg.employee_reg_edit', compact('designations', 'data'));
    }
}
