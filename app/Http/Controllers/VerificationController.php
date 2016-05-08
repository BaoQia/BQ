<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\DriverVerification;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use Storage;
use File;
use Image;
use Log;
use Input;
use Response;

class VerificationController extends Controller
{
    /**
     * Create a new profile controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:2');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('verification');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getStatus()
    {
      $driverVerification = DriverVerification::where('driver_user_id',Auth::user()->id)->first();
      if ($driverVerification != null) {
        return Response::json($driverVerification);
      } else {
        return Response::json('error',404);
      }
    }
    
     /**
     * Handle a verification file upload
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  file
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request, $type)
    {

      $input = $request->all();

      /*300kB for Image file validation*/
       $rules = array(
           'file' => 'image|max:300',
       );

       $validation = Validator::make($input, $rules);
       if ($validation->fails())
       {
           return Response::make($validation->errors->first(), 400);
       }

       $userid = Auth::user()->id; 
       if (Input::file('frontCover') && Input::file('backCover')) {
        // $type = id or dl
        // dl = driver license
        // id = identification card
        $frontCoverFilePath = 'avatars/'.$userid.'/'. $type . 'FrontCover.jpg';
        $backCoverFilePath = 'avatars/'.$userid.'/'. $type . 'BackCover.jpg';
        if (Storage::exists($frontCoverFilePath)) {
          Storage::delete($frontCoverFilePath);
        }
        if (Storage::exists($backCoverFilePath)) {
          Storage::delete($backCoverFilePath);
        }
        Storage::put(
                  $frontCoverFilePath,
                  file_get_contents($request->file('frontCover')->getRealPath())
        );
        Storage::put(
                  $backCoverFilePath,
                  file_get_contents($request->file('backCover')->getRealPath())
        );
       } else {
         Log::error('Upload front and back cover file is not exists');     
         return Response::json('error',404);         
       }
       
       $driverVerification = DriverVerification::where('driver_user_id',Auth::user()->id)->first();
       if ($driverVerification == null) {
         $driverVerification = new DriverVerification;
         //N=No verification status
         //A=Awaiting verification
         //C=Confirmed verification
         //F=Fail verification
         $icStatus = 'N';
         $driverLicenseStatus = 'N';
         if ($type == 'id') {
           $icStatus = 'A';
         } else {
           $driverLicenseStatus = 'A';
         }
         $driverVerification->ic_status = $icStatus;
         $driverVerification->driver_license_status = $driverLicenseStatus;
         $driverVerification->driver_user_id = Auth::user()->id;
         $result = $driverVerification->save();
       } else {
         //N=No verification status
         //A=Awaiting verification
         //C=Confirmed verification
         //F=Fail verification
         $icStatus = $driverVerification->ic_status;
         $driverLicenseStatus = $driverVerification->driver_license_status;
         if ($type == 'id') {
           $icStatus = 'A';
         } else {
           $driverLicenseStatus = 'A';
         }
         $driverVerification->ic_status = $icStatus;
         $driverVerification->driver_license_status = $driverLicenseStatus;
         $result = $driverVerification->save();
       }
       if(!$result) {
        return Response::json('error',404);
       }
      return Response::json('success',200);
    }
}
