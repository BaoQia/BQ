<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserRoleMap;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use Log;
use Storage;
use Response;
use File;
use Image;

class ProfileController extends Controller
{
        /**
     * Create a new profile controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getSmProfileImage']]);
    }

    /**
     * return profile view
     *
     * @return view
     */
    public function index()
    {
        return view('profile');
    }

  
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:user',
        ]);
    }

    /**
     * Handle a update request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      
       $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'phone_number' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('profile')
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = $request->all();
        $userid = User::find(Auth::user()->id)->id;
        $result = User::where('id',$userid)
                -> update([
                            'name' => $data['name'],
                            'phone_number' => $data['phone_number'],
                  ]);
        if ($result) {
            Log::info('Success Update Profile user id: ' . $userid);
        } else {
            Log::error('Fail to update profile user id: ' . $userid);
            return redirect('profile')->withErrors(['Error Message'=>'Fail to update profile, kindly report to us.']);
        }
        return redirect('profile')->with('success', 'Your profile is updated.');
    }


    /**
     * Handle a update profile photo avatar request
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  file
     * @return \Illuminate\Http\Response
     */
    public function getAvatar()
    {
       return view('changeprofilepicture');
    }


    /**
     * Return 40px x 40px profile image
     *
     * @return \Illuminate\Http\Response
     */
    public function getSmProfileImage() 
    {  
       $profileImagePath = User::find(Auth::user()->id)->profile_image_url;
		
		$pattern = 'https://graph.facebook.com';

		if (stripos($profileImagePath, $pattern) !== FALSE) {
			try {
				$img = Image::make($profileImagePath."?type=small");
				$img->resize(40,40);
				$reponse = $img->response();
			} catch (Exception $e) {
				$defaultAvatar = public_path().'/images/icons/avatar.jpg';
				$img = Image::make($defaultAvatar);
				$img->resize(40,40);
				$reponse = $img->response();
			}
			return $reponse;
       	}
       
       
       if (!Storage::exists($profileImagePath)) {
         $defaultAvatar = public_path().'/images/icons/avatar.jpg';
         $defaultAvatarImg = Image::make($defaultAvatar);
         $defaultAvatarImg->resize(40,40);
         return $defaultAvatarImg->response();
       } 

       $filepath = storage_path().'/app/'.$profileImagePath;
       $image = Image::make($filepath);
       $image->resize(40,40);
       return $image->response();
    }

    /**
     * Return 120px x 120px profile image
     *
     * @return \Illuminate\Http\Response
     */
    public function getProfileImage()
    {  
       $profileImagePath = User::find(Auth::user()->id)->profile_image_url;

       $pattern = 'https://graph.facebook.com';
	   
       	if (stripos($profileImagePath, $pattern) !== FALSE) {
			try {
				$img = Image::make($profileImagePath."?type=large");
				$img->resize(120,120);
				$reponse = $img->response();
			} catch (Exception $e) {
				$defaultAvatar = public_path().'/images/icons/avatar.jpg';
				$img = Image::make($defaultAvatar);
				$img->resize(120,120);
				$reponse = $img->response();
			}
			return $reponse;
       	}
       
       if (!Storage::exists($profileImagePath)) {
         $defaultAvatar = public_path().'/images/icons/avatar.jpg';
         $defaultAvatarImg = Image::make($defaultAvatar);
         $defaultAvatarImg->resize(120,120);
         return $defaultAvatarImg->response();
       } 

       $filepath = storage_path().'/app/'.$profileImagePath;
       $image = Image::make($filepath);
       $image->resize(120,120);
       return $image->response();
    }
    
    /**
     * Handle a update profile photo avatar request
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  file
     * @return \Illuminate\Http\Response
     */
    public function postAvatar(Request $request)
    {

       $input = $request->all();
       
       /*5MB for Image file validation*/
       $rules = array(
           'file' => 'image|max:3000',
       );

       $validation = Validator::make($input, $rules);

       if ($validation->fails())
       {
           return Response::make($validation->errors->first(), 400);
       }

       $userid = Auth::user()->id;
       $file = $request->file('avatar')->getRealPath();
       $filepath = 'avatars/'.$userid.'/'.'avatar.jpg';
       if (Storage::exists($filepath)) {
        Storage::delete($filepath);
       }
       $result = Storage::put(
            $filepath,
            file_get_contents($request->file('avatar')->getRealPath())
       );
       
        $dbResult = User::where('id',$userid)
                -> update([
                            'profile_image_url' => $filepath,
                  ]);
      
       if($result && $dbResult) {
           return redirect('updateavatar')->with('success', 'Your profile picture is updated.');
       } else {
           return redirect('updateavatar')->withErrors(['Error Message'=>'New Password is not match.']);
       }
    }
    
    /**
     * Get Role
     *
     * @return \Illuminate\Http\Response
     */
    public function getRole()
    {
      //select user_id as user from user_role_map where id=1
      $userid = Auth::user()->id;
      $role = UserRoleMap::where('user_id',$userid)->first(['user_role_id as role']);
      return Response::json($role);
    }

}
