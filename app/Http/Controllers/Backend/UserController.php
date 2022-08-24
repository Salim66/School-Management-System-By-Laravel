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
        $all_data = User::where('user_type', 'Admin')->get();
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
                'role' => 'required',
                'name' => 'required',
                'email' => 'required|unique:users',
            ]);

            $code = rand(0000, 9999);

            User::create([
                'user_type' => 'Admin',
                'role' => $request->role,
                'name' => $request->name,
                'email' => $request->email,
                'code' => $code,
                'password' => bcrypt($code),
            ]);

            $notification = [
                'message' => 'User Added Successfully ):',
                'alert-type' => 'success'
            ];

            return redirect()->route('user.view')->with($notification);

        }
    }

    /**
     * @access private
     * @routes /users/edit
     * @method GET
     */
    public function userEdit($id){
        $data = User::find($id);
        return view('backend.user.edit_user', compact('data'));
    }

    /**
     * @access private
     * @routes /users/update
     * @method POST
     */
    public function userUpdate(Request $request, $id){
        if($request->isMethod('post')){

            User::find($id)->update([
                'role' => $request->role,
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $notification = [
                'message' => 'User Updated Successfully ):',
                'alert-type' => 'info'
            ];

            return redirect()->route('user.view')->with($notification);

        }
    }

    /**
     * @access private
     * @routes /users/delete
     * @method GET
     */
    public function userDelete($id){
        $data = User::find($id);
        $data->delete();

        $notification = [
            'message' => 'User Deleted Successfully ):',
            'alert-type' => 'info'
        ];

        return redirect()->route('user.view')->with($notification);
    }
}
