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
}
