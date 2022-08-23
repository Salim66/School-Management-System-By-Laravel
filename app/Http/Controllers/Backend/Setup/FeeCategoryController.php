<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use Illuminate\Http\Request;

class FeeCategoryController extends Controller
{
    /**
     * @access private
     * @routes /view/fee/category
     * @method GET
     */
    public function viewFeeCategory(){
        $all_data = FeeCategory::all();
        return view('backend.setup.fee_category.view_fee', compact('all_data'));
    }

    /**
     * @access private
     * @routes /add/fee/category
     * @method GET
     */
    public function feeCategoryAdd(){
        return view('backend.setup.fee_category.add_fee');
    }

    /**
     * @access private
     * @routes /store/fee/category
     * @method POST
     */
    public function feeCategoryStore(Request $request){
        if($request->isMethod('post')){
            $this->validate($request, [
                'name' => 'required|unique:student_shifts,name'
            ]);

            FeeCategory::create([
                'name' => $request->name
            ]);

            $notification = [
                'message' => 'Fee Category Added Successfully :)',
                'alert-type' => 'success'
            ];
            return redirect()->route('view.fee.category')->with($notification);
        }
    }

    /**
     * @access private
     * @routes /edit/fee/category
     * @method GET
     */
    public function feeCategoryEdit($id){
        $data = FeeCategory::find($id);
        return view('backend.setup.fee_category.edit_fee', compact('data'));
    }

    /**
     * @access private
     * @routes /update/fee/category
     * @method POST
     */
    public function feeCategoryUpdate(Request $request, $id){
        if($request->isMethod('post')){


            FeeCategory::find($id)->update([
                'name' => $request->name
            ]);

            $notification = [
                'message' => 'Fee Category Updated Successfully :)',
                'alert-type' => 'info'
            ];
            return redirect()->route('view.fee.category')->with($notification);
        }
    }

    /**
     * @access private
     * @routes /delete/fee/category
     * @method GET
     */
    public function feeCategoryDelete($id){
        $data = FeeCategory::find($id);
        $data->delete();
        $notification = [
            'message' => 'Fee Category Deleted Successfully :)',
            'alert-type' => 'info'
        ];
        return redirect()->route('view.fee.category')->with($notification);
    }
}
