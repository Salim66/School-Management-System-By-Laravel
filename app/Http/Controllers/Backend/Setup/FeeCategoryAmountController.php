<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class FeeCategoryAmountController extends Controller
{
    /**
     * @access private
     * @routes /view/fee/amount
     * @method GET
     */
    public function viewFeeAmount(){
        $all_data = FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.setup.fee_amount.view_fee_amount', compact('all_data'));
    }

    /**
     * @access private
     * @routes /add/fee/amount
     * @method GET
     */
    public function feeAmountAdd(){
        $categories = FeeCategory::all();
        $classes = StudentClass::all();
        return view('backend.setup.fee_amount.add_fee_amount', compact('categories', 'classes'));
    }

    /**
     * @access private
     * @routes /store/fee/amount
     * @method POST
     */
    public function feeAmountStore(Request $request){
        if($request->isMethod('post')){

            $countClass = count($request->class_id);

            if($countClass !== NULL){
                for ($i=0; $i < $countClass; $i++) {
                    FeeCategoryAmount::create([
                        'fee_category_id' => $request->fee_category_id,
                        'class_id' => $request->class_id[$i],
                        'amount' => $request->amount[$i],
                    ]);
                }
            }

            $notification = [
                'message' => 'Data Added Successfully :)',
                'alert-type' => 'success'
            ];
            return redirect()->route('view.fee.amount')->with($notification);
        }
    }

    /**
     * @access private
     * @routes /edit/fee/amount
     * @method GET
     */
    public function feeAmountEdit($fee_category_id){
        $data = FeeCategoryAmount::where('fee_category_id', $fee_category_id)->orderBy('class_id', 'asc')->get();
        $categories = FeeCategory::all();
        $classes = StudentClass::all();
        return view('backend.setup.fee_amount.edit_fee_amount', compact('data', 'categories', 'classes'));
    }

    /**
     * @access private
     * @routes /update/fee/amount
     * @method POST
     */
    public function feeAmountUpdate(Request $request, $fee_category_id){
        if($request->isMethod('post')){

            if($request->class_id === NULL){
                $notification = [
                    'message' => 'Sorry you do not select any class amount!',
                    'alert-type' => 'warning'
                ];
                return redirect()->route('fee.amount.edit', $fee_category_id)->with($notification);
            }else {

                $countClass = count($request->class_id);
                FeeCategoryAmount::where('fee_category_id', $fee_category_id)->delete();
                for ($i=0; $i < $countClass; $i++) {
                    FeeCategoryAmount::create([
                        'fee_category_id' => $request->fee_category_id,
                        'class_id' => $request->class_id[$i],
                        'amount' => $request->amount[$i],
                    ]);
                }

                $notification = [
                    'message' => 'Data Updated Successfully :)',
                    'alert-type' => 'info'
                ];
                return redirect()->route('view.fee.amount')->with($notification);

            }


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
