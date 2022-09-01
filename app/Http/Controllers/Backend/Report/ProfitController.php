<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfitController extends Controller
{
    /**
     * @access private
     * @routes /accounts/monthly/profit/view
     * @method GET
     */
    public function viewMonthlyProfit(){
        return view('backend.report.profit.profit_view');
    }
}
