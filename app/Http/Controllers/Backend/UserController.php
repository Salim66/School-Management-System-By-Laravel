<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

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
     * @routes /users/add
     * @method GET
     */
    public function userAdd(){
        return view('backend.user.add_user');
    }

    /**
     * @access private
     * @routes /users/store
     * @method POST
     */
    public function userStore(Request $request){
        if($request->isMethod('post')){

            $this->validate($request, [
                'user_type' => 'required',
                'name' => 'required',
                'email' => 'required|unique:users',
            ]);

            User::create([
                'user_type' => $request->user_type,
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            return redirect()->route('user.view');

        }
    }
}
