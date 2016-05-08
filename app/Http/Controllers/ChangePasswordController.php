<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Log;
use Hash;
class ChangePasswordController extends Controller
{
    /**
     * Create a new profile controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('changepassword');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {

        $password = Auth::user()->password;
        $data = $request->all();

        if (!(Hash::check($data['oldPassword'], $password))) {
            return redirect('changepassword')->withErrors(['Error Message'=>'Old Password is not match.']);
        }

        if ($data['newPassword'] == $data['oldPassword']) {
            return redirect('changepassword')->withErrors(['Error Message'=>'New Password cannot same as old password.']);
        }

        if ($data['newPassword'] != $data['confirmNewPassword']) {
            return redirect('changepassword')->withErrors(['Error Message'=>'New Password is not match.']);
        }

        $newPassword = $data['newPassword'];

        $user = User::find(Auth::user()->id);
        $user->password = bcrypt($newPassword);
    
        $user->save();

        return redirect('changepassword')->with('success', 'Your new password is updated.');
        
    }
}
