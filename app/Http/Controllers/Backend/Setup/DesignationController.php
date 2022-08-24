<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * @access private
     * @routes /view/designation
     * @method GET
     */
    public function viewDesignation(){
        $all_data = Designation::all();
        return view('backend.setup.designation.view_designation', compact('all_data'));
    }

    /**
     * @access private
     * @routes /add/designation
     * @method GET
     */
    public function designationAdd(){
        return view('backend.setup.designation.add_designation');
    }

    /**
     * @access private
     * @routes /store/designation
     * @method POST
     */
    public function designationStore(Request $request){
        if($request->isMethod('post')){
            $this->validate($request, [
                'name' => 'required|unique:student_shifts,name'
            ]);

            Designation::create([
                'name' => $request->name
            ]);

            $notification = [
                'message' => 'Designation Added Successfully :)',
                'alert-type' => 'success'
            ];
            return redirect()->route('view.designation')->with($notification);
        }
    }

    /**
     * @access private
     * @routes /edit/designation
     * @method GET
     */
    public function designationEdit($id){
        $data = Designation::find($id);
        return view('backend.setup.designation.edit_designation', compact('data'));
    }

    /**
     * @access private
     * @routes /update/designation
     * @method POST
     */
    public function designationUpdate(Request $request, $id){
        if($request->isMethod('post')){


            Designation::find($id)->update([
                'name' => $request->name
            ]);

            $notification = [
                'message' => 'Designation Updated Successfully :)',
                'alert-type' => 'info'
            ];
            return redirect()->route('view.designation')->with($notification);
        }
    }

    /**
     * @access private
     * @routes /delete/designation
     * @method GET
     */
    public function designationDelete($id){
        $data = Designation::find($id);
        $data->delete();
        $notification = [
            'message' => 'Designation Deleted Successfully :)',
            'alert-type' => 'info'
        ];
        return redirect()->route('view.designation')->with($notification);
    }
}
