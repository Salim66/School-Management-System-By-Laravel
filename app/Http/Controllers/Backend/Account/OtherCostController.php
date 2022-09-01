<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Models\AccountOtherCost;
use Illuminate\Http\Request;

class OtherCostController extends Controller
{
    /**
     * @access private
     * @routes /accounts/other/cost/view
     * @method GET
     */
    public function viewOtherCost(){
        $all_data = AccountOtherCost::orderBy('id', 'DESC')->get();
        return view('backend.account.other_cost.other_cost_view', compact('all_data'));
    }

    /**
     * @access private
     * @routes /accounts/other/cost/add
     * @method GET
     */
    public function addOtherCost(){
        return view('backend.account.other_cost.other_cost_add');
    }

    /**
     * @access private
     * @routes /accounts/other/cost/store
     * @method POST
     */
    public function storeOtherCost(Request $request){

        if($request->isMethod('post')){

            $fileName = '';
            if($request->hasFile('image')){
                $file = $request->file('image');
                $fileName = date('YmdHi').'.'.$file->getClientOriginalExtension();
                $file->move(public_path('upload/other_cost/'), $fileName);
            }

            AccountOtherCost::create([
                'date' => date('Y-m-d', strtotime($request->date)),
                'amount' => $request->amount,
                'description' => $request->description,
                'image' => $fileName,
            ]);

            $notification = [
                'message' => 'Other Cost Inserted Successfully ):',
                'alert-type' => 'success'
            ];

            return redirect()->route('other.cost.view')->with($notification);

        }

    }

    /**
     * @access private
     * @routes /accounts/other/cost/edit/{id}
     * @method GET
     */
    public function editOtherCost($id){
        $data = AccountOtherCost::find($id);
        return view('backend.account.other_cost.other_cost_edit', compact('data'));
    }

    /**
     * @access private
     * @routes /accounts/other/cost/update
     * @method POST
     */
    public function updateOtherCost(Request $request, $id){

        if($request->isMethod('post')){

            $data = AccountOtherCost::find($id);

            $fileName = '';
            if($request->hasFile('image')){
                $file = $request->file('image');
                $fileName = date('YmdHi').'.'.$file->getClientOriginalExtension();
                $file->move(public_path('upload/other_cost/'), $fileName);

                if(file_exists('upload/other_cost/'.$data->image) && !empty($data->image)){
                    unlink('upload/other_cost/'.$data->image);
                }

            }else {
                $fileName = $data->image;
            }

            AccountOtherCost::find($id)->update([
                'date' => date('Y-m-d', strtotime($request->date)),
                'amount' => $request->amount,
                'description' => $request->description,
                'image' => $fileName,
            ]);

            $notification = [
                'message' => 'Other Cost Updated Successfully ):',
                'alert-type' => 'info'
            ];

            return redirect()->route('other.cost.view')->with($notification);

        }

    }


    /**
     * @access private
     * @routes /accounts/other/cost/delete/{id}
     * @method GET
     */
    public function deleteOtherCost($id){
        $data = AccountOtherCost::find($id);

        if(file_exists('upload/other_cost/'.$data->image) && !empty($data->image)){
            unlink('upload/other_cost/'.$data->image);
        }

        $data->delete();

        $notification = [
            'message' => 'Other Cost Deleted Successfully ):',
            'alert-type' => 'info'
        ];

        return redirect()->back()->with($notification);
    }

}
