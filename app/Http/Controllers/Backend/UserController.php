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
                'user_type' => $request->user_type,
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
