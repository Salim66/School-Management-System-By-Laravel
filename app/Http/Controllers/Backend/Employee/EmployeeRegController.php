<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Models\User;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\EmployeeSalaryLog;
use Dompdf\Dompdf;

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

    /**
     * @access private
     * @routes /employee/reg/update/{id}
     * @method POST
     */
    public function updateEmployeeReg(Request $request, $id){
        if($request->isMethod('post')){

                $user = User::find($id);
                $user->name = $request->name;
                $user->fname = $request->fname;
                $user->mname = $request->mname;
                $user->mobile = $request->mobile;
                $user->address = $request->address;
                $user->gender = $request->gender;
                $user->religion = $request->religion;
                $user->designation_id = $request->designation_id;
                $user->dob = date('Y-m-d', strtotime($request->dob));

                $fileName = '';
                if($request->hasFile('profile_photo_path')){
                    $file = $request->file('profile_photo_path');
                    $fileName = date('YmdHi').'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('upload/employee_images/'), $fileName);

                    if(file_exists('upload/employee_images/'.$user->profile_photo_path) && !empty($user->profile_photo_path)){
                        unlink('upload/employee_images/'.$user->profile_photo_path);
                    }

                }else {
                    $fileName = $user->profile_photo_path;
                }


                $user->profile_photo_path = $fileName;
                $user->save();

            $notification = [
                'message' => 'Employee Registration Updated Successfully ):',
                'alert-type' => 'info'
            ];

            return redirect()->route('view.employee.reg')->with($notification);

        }

    }

    /**
     * @access private
     * @routes /employee/reg/details/{id}
     * @method GET
     */
    public function detailsEmployeeReg($id){
        $data = User::with('designation')->where('id', $id)->first();

        $text = '<!DOCTYPE html>
            <html>
            <head>
            <style>
            #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            }

            #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
            }

            #customers tr:nth-child(even){background-color: #f2f2f2;}

            #customers tr:hover {background-color: #ddd;}

            #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
            }
            </style>
            </head>
            <body>

            <table id="customers">
            <tr>
                <td>
                    <h2>Easy Learning</h2>
                </td>
                <td>
                    <h2>Easy School ERP</h2>
                    School Address <br>
                    Phone: 01773980593<br>
                    Email: salimhasanriad@gmail.com<br>
                    <strong>Employee Registration Page</strong><br>
                </td>
            </tr>
            </table>

            <table id="customers">
            <tr>
                <th>SL</th>
                <th>Employee Details</th>
                <th>Employee Data</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Employee Name</td>
                <td>'.$data->name.'</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Employee ID No</td>
                <td>'.$data->id_no.'</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Father Name</td>
                <td>'.$data->fname.'</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Mother Name</td>
                <td>'.$data->mname.'</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Mobile Number</td>
                <td>'.$data->mobile.'</td>
            </tr>
            <tr>
                <td>6</td>
                <td>Address</td>
                <td>'.$data->address.'</td>
            </tr>
            <tr>
                <td>7</td>
                <td>Gender</td>
                <td>'.$data->gender.'</td>
            </tr>
            <tr>
                <td>8</td>
                <td>Religion</td>
                <td>'.$data->religion.'</td>
            </tr>
            <tr>
                <td>9</td>
                <td>Date of birth</td>
                <td>'.date('d-m-Y', strtotime($data->dob)).'</td>
            </tr>
            <tr>
                <td>10</td>
                <td>Employee Designation</td>
                <td>'.$data->designation->name.'</td>
            </tr>
            <tr>
                <td>11</td>
                <td>Join Date</td>
                <td>'.date('d-m-Y', strtotime($data->join_date)).'</td>
            </tr>
            <tr>
                <td>12</td>
                <td>Employee Salary</td>
                <td>'.$data->salary.'</td>
            </tr>
            </table>
            <br><br>
            <i>Print Date: '.date('Y-m-d').'</i>

            </body>
        </html>';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($text);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }

}
