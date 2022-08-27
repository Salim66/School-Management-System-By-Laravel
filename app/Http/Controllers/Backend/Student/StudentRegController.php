<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
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
        $all_data = AssignStudent::all();
        return view('backend.student.student_reg.student_view', compact('all_data'));
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
                    $studentId = $student + 1;

                    if($studentId < 10){
                        $id_no = '000'.$studentId;
                    }else if($studentId < 100){
                        $id_no = '00'.$studentId;
                    }else if($studentId < 1000){
                        $id_no = '0'.$studentId;
                    }

                }

                $final_id_no = $check_year . $id_no;
                $user = new User;
                $code = round(0000, 9999);
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

                if($request->hasFile('profile_photo_path')){
                    $file = $request->file('profile_photo_path');
                    $fileName = date('YmdHi').'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('upload/student_images/'), $fileName);
                    $user->profile_photo_path = $fileName;
                }

                $user->save();

            });
        }
    }
}
