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
}
