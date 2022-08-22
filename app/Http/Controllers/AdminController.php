<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * @access private
     * @routes /admin/logout
     * @method GET
     */
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
