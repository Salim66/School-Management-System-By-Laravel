<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\StudentYear;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\Group;
use Dompdf\Dompdf;

class StudentRegController extends Controller
{
    /**
     * @access private
     * @routes /students/reg/view
     * @method GET
     */
    public function viewStudentReg(){
        $years = StudentYear::all();
        $classes = StudentClass::all();

        // get last id data
        $year_id = StudentYear::orderBy('id', 'DESC')->first()->id;
        $class_id = StudentClass::orderBy('id', 'DESC')->first()->id;
        // dd($class_id);
        $all_data = AssignStudent::where('year_id', $year_id)->where('class_id', $class_id)->get();
        return view('backend.student.student_reg.student_view', compact('all_data', 'years', 'classes', 'year_id', 'class_id'));
    }

    /**
     * @access private
     * @routes /students/year/class/wise
     * @method GET
     */
    public function studentYearClassWise(Request $request){
        $years = StudentYear::all();
        $classes = StudentClass::all();

        // get request data
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        // dd($class_id);
        $all_data = AssignStudent::where('year_id', $year_id)->where('class_id', $class_id)->get();
        return view('backend.student.student_reg.student_view', compact('all_data', 'years', 'classes', 'year_id', 'class_id'));
    }

    /**
     * @access private
     * @routes /students/reg/add
     * @method GET
     */
    public function studentRegAdd(){
        $years = StudentYear::all();
        $classes = StudentClass::all();
        $groups = StudentGroup::all();
        $shifts = StudentShift::all();
        return view('backend.student.student_reg.student_add', compact('years', 'classes', 'groups', 'shifts'));
    }

    /**
     * @access private
     * @routes /students/reg/store
     * @method POST
     */
    public function studentRegStore(Request $request){
        if($request->isMethod('post')){
            // return $request->all(); die;
            DB::transaction(function() use($request){
                $check_year = StudentYear::find($request->year_id)->name;
                $student = User::where('user_type', 'Student')->orderBy('id', 'DESC')->first();

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

                    $student = User::where('user_type', 'Student')->orderBy('id', 'DESC')->first();
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
                $user->user_type = 'Student';
                $user->code = $code;
                $user->name = $request->name;
                $user->fname = $request->fname;
                $user->mname = $request->mname;
                $user->mobile = $request->mobile;
                $user->address = $request->address;
                $user->gender = $request->gender;
                $user->religion = $request->religion;
                $user->dob = date('Y-m-d', strtotime($request->dob));

                $fileName = '';
                if($request->hasFile('profile_photo_path')){
                    $file = $request->file('profile_photo_path');
                    $fileName = date('YmdHi').'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('upload/student_images/'), $fileName);
                }

                $user->profile_photo_path = $fileName;
                $user->save();


                // assign_students table
                $assign_student = new AssignStudent();
                $assign_student->student_id = $user->id;
                $assign_student->year_id = $request->year_id;
                $assign_student->class_id = $request->class_id;
                $assign_student->group_id = $request->group_id;
                $assign_student->shift_id = $request->shift_id;
                $assign_student->save();

                // discount_students table
                $discount_student = new DiscountStudent();
                $discount_student->assign_student_id = $assign_student->id;
                $discount_student->fee_category_id = '1';
                $discount_student->discount = $request->discount;
                $discount_student->save();

            });

            $notification = [
                'message' => 'Student Registration Successfully ):',
                'alert-type' => 'success'
            ];

            return redirect()->route('view.student.reg')->with($notification);

        }
    }

    /**
     * @access private
     * @routes /students/reg/edit
     * @method GET
     */
    public function studentRegEdit($student_id){
        $years = StudentYear::all();
        $classes = StudentClass::all();
        $groups = StudentGroup::all();
        $shifts = StudentShift::all();
        $data = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->first();
        // dd($data);
        return view('backend.student.student_reg.student_edit', compact('years', 'classes', 'groups', 'shifts', 'data'));
    }

    /**
     * @access private
     * @routes /students/reg/update
     * @method POST
     */
    public function studentRegUpdate(Request $request, $student_id){
        if($request->isMethod('post')){
            // return $request->all(); die;
            DB::transaction(function() use($request, $student_id){

                $user = User::find($student_id);
                $user->name = $request->name;
                $user->fname = $request->fname;
                $user->mname = $request->mname;
                $user->mobile = $request->mobile;
                $user->address = $request->address;
                $user->gender = $request->gender;
                $user->religion = $request->religion;
                $user->dob = date('Y-m-d', strtotime($request->dob));

                $fileName = '';
                if($request->hasFile('profile_photo_path')){
                    $file = $request->file('profile_photo_path');
                    $fileName = date('YmdHi').'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('upload/student_images/'), $fileName);

                    if(file_exists('upload/student_images/'.$user->profile_photo_path) && !empty($user->profile_photo_path)){
                        unlink('upload/student_images/'.$user->profile_photo_path);
                    }

                }else {
                    $fileName = $user->profile_photo_path;
                }

                $user->profile_photo_path = $fileName;
                $user->save();


                // assign_students table
                $assign_student = AssignStudent::find($request->id);
                $assign_student->year_id = $request->year_id;
                $assign_student->class_id = $request->class_id;
                $assign_student->group_id = $request->group_id;
                $assign_student->shift_id = $request->shift_id;
                $assign_student->save();

                // discount_students table
                $discount_student = DiscountStudent::where('assign_student_id', $request->id)->first();
                $discount_student->discount = $request->discount;
                $discount_student->save();

            });

            $notification = [
                'message' => 'Student Registration Updated Successfully ):',
                'alert-type' => 'info'
            ];

            return redirect()->route('view.student.reg')->with($notification);

        }
    }

    /**
     * @access private
     * @routes /students/reg/promotion
     * @method GET
     */
    public function studentRegPromotion($student_id){
        $years = StudentYear::all();
        $classes = StudentClass::all();
        $groups = StudentGroup::all();
        $shifts = StudentShift::all();
        $data = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->first();

        return view('backend.student.student_reg.student_promotion', compact('years', 'classes', 'groups', 'shifts', 'data'));
    }

    /**
     * @access private
     * @routes /students/reg/promotion/update
     * @method POST
     */
    public function studentRegPromotionUpdate(Request $request, $student_id){
        if($request->isMethod('post')){
            // return $request->all(); die;
            DB::transaction(function() use($request, $student_id){

                $user = User::find($student_id);
                $user->name = $request->name;
                $user->fname = $request->fname;
                $user->mname = $request->mname;
                $user->mobile = $request->mobile;
                $user->address = $request->address;
                $user->gender = $request->gender;
                $user->religion = $request->religion;
                $user->dob = date('Y-m-d', strtotime($request->dob));

                $fileName = '';
                if($request->hasFile('profile_photo_path')){
                    $file = $request->file('profile_photo_path');
                    $fileName = date('YmdHi').'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('upload/student_images/'), $fileName);

                    if(file_exists('upload/student_images/'.$user->profile_photo_path) && !empty($user->profile_photo_path)){
                        unlink('upload/student_images/'.$user->profile_photo_path);
                    }

                }else {
                    $fileName = $user->profile_photo_path;
                }

                $user->profile_photo_path = $fileName;
                $user->save();


                // assign_students table
                $assign_student = new AssignStudent();
                $assign_student->student_id = $user->id;
                $assign_student->year_id = $request->year_id;
                $assign_student->class_id = $request->class_id;
                $assign_student->group_id = $request->group_id;
                $assign_student->shift_id = $request->shift_id;
                $assign_student->save();

                // discount_students table
                $discount_student = new DiscountStudent();
                $discount_student->assign_student_id = $assign_student->id;
                $discount_student->fee_category_id = '1';
                $discount_student->discount = $request->discount;
                $discount_student->save();

            });

            $notification = [
                'message' => 'Student Promotion Updated Successfully ):',
                'alert-type' => 'info'
            ];

            return redirect()->route('view.student.reg')->with($notification);

        }
    }

    /**
     * @access private
     * @routes /students/reg/details
     * @method GET
     */
    public function studentRegDetails($student_id){
        $data = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->first();

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
                </td>
            </tr>
            </table>

            <table id="customers">
            <tr>
                <th>SL</th>
                <th>Student Details</th>
                <th>Student Data</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Student Name</td>
                <td>'.$data->student->name.'</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Student ID No</td>
                <td>'.$data->student->id_no.'</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Student Roll</td>
                <td>'.$data->roll.'</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Father Name</td>
                <td>'.$data->student->fname.'</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Mother Name</td>
                <td>'.$data->student->mname.'</td>
            </tr>
            <tr>
                <td>6</td>
                <td>Mobile Number</td>
                <td>'.$data->student->mobile.'</td>
            </tr>
            <tr>
                <td>7</td>
                <td>Address</td>
                <td>'.$data->student->address.'</td>
            </tr>
            <tr>
                <td>8</td>
                <td>Gender</td>
                <td>'.$data->student->gender.'</td>
            </tr>
            <tr>
                <td>9</td>
                <td>Religion</td>
                <td>'.$data->student->religion.'</td>
            </tr>
            <tr>
                <td>10</td>
                <td>Date of birth</td>
                <td>'.$data->student->dob.'</td>
            </tr>
            <tr>
                <td>11</td>
                <td>Discount</td>
                <td>'.$data->discount->discount.'</td>
            </tr>
            <tr>
                <td>12</td>
                <td>Year</td>
                <td>'.$data->student_year->name.'</td>
            </tr>
            <tr>
                <td>13</td>
                <td>Class</td>
                <td>'.$data->student_class->name.'</td>
            </tr>
            <tr>
                <td>14</td>
                <td>Group</td>
                <td>'.$data->student_group->name.'</td>
            </tr>
            <tr>
                <td>15</td>
                <td>Shift</td>
                <td>'.$data->student_shift->name.'</td>
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
