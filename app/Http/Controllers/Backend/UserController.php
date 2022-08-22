<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @access private
     * @routes /users/view
     * @method GET
     */
    public function userView(){
        $all_data = User::all();
        return view('backend.user.view_user', compact('all_data'));
    }

    /**
     * @access private
     * $routes /users/add
     * @method GET
     */
    public function userAdd(){
        return view('backend.user.add_user');
    }
}
