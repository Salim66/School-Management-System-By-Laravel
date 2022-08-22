<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * @access private
     * @routes /profile/view
     * @method GET
     */
    public function viewProfile(){
        $data = User::find(Auth::user()->id);
        return view('backend.user.view_profile', compact('data'));
    }

    /**
     * @access private
     * @routes /profile/edit
     * @method GET
     */
    public function editProfile(){
        $data = User::find(Auth::user()->id);
        return view('backend.user.edit_profile', compact('data'));
    }

    /**
     * @access private
     * @routes /profile/update
     * @method POST
     */
    public function updateProfile(Request $request){
         if($request->isMethod('post')){
            $data = User::find(Auth::user()->id);

            $fileName = '';
            if($request->hasFile('profile_photo_path')){
                $file = $request->file('profile_photo_path');
                $fileName = date('YmdHi').'.'.$file->getClientOriginalExtension();
                $file->move(public_path('upload/user_images/'), $fileName);
                if(file_exists('upload/user_images/'.$data->profile_photo_path) && !empty($data->profile_photo_path)){
                    unlink('upload/user_images/'.$data->profile_photo_path);
                }
            }else {
                $fileName = $data->profile_photo_path;
            }

            User::find(Auth::user()->id)->update([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'gender' => $request->gender,
                'email' => $request->email,
                'address' => $request->address,
                'profile_photo_path' => $fileName,
            ]);

            $notification = [
                'message' => 'Profile Updated Successfully ):',
                'alert-type' => 'info'
            ];

            return redirect()->route('view.profile')->with($notification);

        }
    }
}
