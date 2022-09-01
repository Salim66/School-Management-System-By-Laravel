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
}
