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
use Response;
use App\Car;
use Datatable;
use View;
use Log;
use Input;
use App\CarPhoto;

class CarController extends Controller
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
       $table = Datatable::table()
      ->addColumn('Seats', 'Plate Number', 'Manufacturer', 'Model', 'Year','Action')
      ->setUrl(route('getCars'))
      ->noScript();

      return view('car', ['table' => $table]);
    }
    
    /**
     * Display create car page.
     *
     * @return Response
     */
    public function getCreateCarPage()
    {
      return view('createcar',['formType' => 'new']);
    }
    

    /**
     * Display edit car page.
     *
     * @return Response
     */
    public function getEditCarPage($id)
    {
      if (!preg_match('/^\d+$/' ,$id)) {
        return $this->index();
      }
      $userid = Auth::user()->id;
      $car = Car::where('driver_user_id',$userid)->where('id',$id)->first();
      if ($car == null) {
        return $this->index();
      }
      return view('createcar',['formType' => 'edit','data' => $car]);
    }
    
    /**
     * check duplicated car plate number in DB
     *
     * @return Response
     */
    public function checkDuplicateCarPlate(Request $request)
    {
      $input = $request->all();
      if (Car::where('plate_number',$input['plateNumber'])->first()) {
        return Response::json('duplicated',200);
      } else {
        return Response::json('ok',200); 
      }
    }
 
    /**
     * get car info based on id
     *
     * @return Response
     */
    public function getCar(Request $request, $id)
    {
      if (!preg_match('/^\d+$/' ,$id)) {
        return Response::json('error',404);
      }

      $userid = Auth::user()->id;
      $car = Car::where('driver_user_id',$userid)->where('id',$id)->first();
      if ($car) {
        return Response::json($car);
      } else {
        return Response::json('error',404); 
      }
    } 
    
    /**
     * edit car id 
     *
     * @return Response
     */
    public function editCar(Request $request, $id)
    {
       $input = $request->all();
         $rules = array(
           'seats' => 'required|integer|between:1,9',
           'doors' => 'required|integer|between:1,9',
           'plateNumber' => 'required|max:50',
           'manufacturer' => 'required|max:50',
           'model' => 'required|max:50',
           'year' => 'required|integer|between:1995,2015',
           'bookingPrice' => 'required|integer|between:0,100000',
           'timePerBooking' => 'required|integer|between:0,24',
           'otCharge' => 'required|integer|between:0,100000',
           'lateNightCharge' => 'required|integer|between:0,100000',
           'insurance'=>'integer|between:0,100000',
       );

       $validation = Validator::make($input, $rules);

       if ($validation->fails())
       {
           return Response::json('error',404);
       }
      if (!preg_match('/^\d+$/' ,$id)) {
        return Response::json('error',404);
      }

      $userid = Auth::user()->id;
      $car = Car::where('driver_user_id',$userid)->where('id',$id)->first();
      if ($car == null) {
        return Response::json('error',404);
      }
      $car->seats = $input['seats'];
      $car->doors = $input['doors'];
      $plateNumber = str_replace(" ","",$input['plateNumber']);
      $car->plate_number = $plateNumber;
      $car->manufacturer = $input['manufacturer'];
      $car->model = $input['model'];
      $car->year = $input['year'];
      $car->booking_price = $input['bookingPrice'];
      $car->total_booking_hour = $input['timePerBooking'];
      $car->ot_price = $input['otCharge'];
      $car->late_night_charge = $input['lateNightCharge'];
      if ($input['insurance']) {
       $car->insurance_price = $input['insurance'];
      } else {
       $car->insurance_price = 0;
      }
      $car->save();
      if ($car) {
        return Response::json('updated',200);
      } else {
        return Response::json('error',404); 
      }
    } 

    /**
     * creave new car info
     * create car
     *
     * @return Redirect
     */
    public function postCreateCar(Request $request) {
      $userid = Auth::user()->id;
      $input = $request->all();
         $rules = array(
           'seats' => 'required|integer|between:1,9',
           'doors' => 'required|integer|between:1,9',
           'plateNumber' => 'required|max:50',
           'manufacturer' => 'required|max:50',
           'model' => 'required|max:50',
           'year' => 'required|integer|between:1995,2015',
           'bookingPrice' => 'required|integer|between:0,100000',
           'timePerBooking' => 'required|integer|between:0,24',
           'otCharge' => 'required|integer|between:0,100000',
           'lateNightCharge' => 'required|integer|between:0,100000',
           'insurance'=>'integer|between:0,100000',
       );

       $validation = Validator::make($input, $rules);

       if ($validation->fails())
       {
           return redirect('createcar')
                        ->withErrors($validation)
                        ->withInput();
       }

       if (Car::where('plate_number',$input['plateNumber'])->first()) {
         return redirect('createcar')->withErrors(['Error Message'=>'Same car plate number is added.']);
       }

       $car = new Car;
       $car->seats = $input['seats'];
       $car->doors = $input['doors'];
       $plateNumber = str_replace(" ","",$input['plateNumber']);
       $car->plate_number = $plateNumber;
       $car->manufacturer = $input['manufacturer'];
       $car->model = $input['model'];
       $car->year = $input['year'];
       $car->booking_price = $input['bookingPrice'];
       $car->total_booking_hour = $input['timePerBooking'];
       $car->ot_price = $input['otCharge'];
       if ($input['insurance']) {
         $car->insurance_price = $input['insurance'];
       } else {
         $car->insurance_price = 0;
       }
       $car->late_night_charge = $input['lateNightCharge'];
       $car->driver_user_id = $userid;
       $result = $car->save();
      if ($result) {
        return redirect('mycars')->with('success', 'New car is added.');
      } else {
        return redirect('mycars')->withErrors(['Error Message'=>'Fail to add car, kindly report to us.']);
      }
    }

    /**
     * return datatable
     *
     * @return Datatable
     */
    public function getDatatable() 
    {    
      $userid = Auth::user()->id;
     
      return Datatable::collection(Car::where('driver_user_id',$userid)->select('id','seats', 'plate_number', 'manufacturer', 'model', 'year')->get())
      ->showColumns('seats', 'plate_number', 'manufacturer', 'model', 'year')
      ->addColumn('edit', function($model) { return '<a href="/editcar/' . $model->id . ' "><i class="icon-edit"></i></a>';})
      ->searchColumns('seats', 'plate_number', 'manufacturer', 'model', 'year')
      ->orderColumns('seats', 'plate_number', 'manufacturer', 'model', 'year')
      ->make();
    }
    
    /**
     * save Edit Car Page
     *
     * @return Return page with success updated
     */
    public function saveEditCarPage(Request $request, $id)
    {
      $input = $request->all();
         $rules = array(
           'seats' => 'required|integer|between:1,9',
           'doors' => 'required|integer|between:1,9',
           'plateNumber' => 'required|max:50',
           'manufacturer' => 'required|max:50',
           'model' => 'required|max:50',
           'year' => 'required|integer|between:1995,2015',
           'bookingPrice' => 'required|integer|between:0,100000',
           'timePerBooking' => 'required|integer|between:0,24',
           'otCharge' => 'required|integer|between:0,100000',
           'lateNightCharge' => 'required|integer|between:0,100000',
           'insurance'=>'integer|between:0,100000',
       );

       $validation = Validator::make($input, $rules);

       if ($validation->fails())
       {
           return redirect('editcar' . $id)
                        ->withErrors($validation)
                        ->withInput();
       }
      if (!preg_match('/^\d+$/' ,$id)) {
        return redirect('mycars')
                        ->withErrors(['Error Message'=>'Invalid access.']);
      }
      $userid = Auth::user()->id;
      $car = Car::where('driver_user_id',$userid)->where('id',$id)->first();
      if ($car == null) {
        return redirect('mycars')
                        ->withErrors(['Error Message'=>'Invalid access.']);
      }
      $car->seats = $input['seats'];
      $car->doors = $input['doors'];
      $plateNumber = str_replace(" ","",$input['plateNumber']);
      $car->plate_number = $plateNumber;
      $car->manufacturer = $input['manufacturer'];
      $car->model = $input['model'];
      $car->year = $input['year'];
      $car->booking_price = $input['bookingPrice'];
      $car->total_booking_hour = $input['timePerBooking'];
      $car->ot_price = $input['otCharge'];
      $car->late_night_charge = $input['lateNightCharge'];
      if ($input['insurance']) {
       $car->insurance_price = $input['insurance'];
      } else {
       $car->insurance_price = 0;
      }
      $car->save();
      if ($car) {
        return redirect('editcar/' . $id)->with('success', 'Car info is updated');
      } else {
        return redirect('editcar/' . $id)->withErrors(['Error Message'=>'Fail to edit car info, kindly report to us.']);
      }
    
    }
    
    public function uploadCarPhotos(Request $request, $id) {

      $input = $request->all();
      $rules = array(
          'file' => 'image|max:3000',
      );

      $validation = Validator::make($input, $rules);
      if ($validation->fails())
      {
        return Response::json($validation->errors->first(), 400);
      }

      $number = CarPhoto::where('car_id',$id)->count();
      if ($number > 4) {
        return Response::json('Please remove photo in order to upload new photo', 400);
      }

      $userid = Auth::user()->id;
      $file = $request->file('file')->getRealPath();
      $filename = str_random(12);
      $filepath = 'carphotos/'.$userid.'/'.$filename;

      if (Storage::exists($filepath)) {
        Storage::delete($filepath);
       }
       
       $upload_success = Storage::put(
            $filepath,
            file_get_contents($file)
       );

       $carPhoto = new CarPhoto;
       $carPhoto->car_id = $id;
       $carPhoto->car_image_url = $filepath;
       $result = $carPhoto->save();
      if( $upload_success && $result) {
         return Response::json($filename,200);
      } else {
         return Response::json('error', 400);
      }
    }
    

    /**
     * get No of Car photo
     *
     * @return Return json of number of car photo based on car id
     */
    public function getNoOfCarPhoto(Request $request,$id) {
      $number = CarPhoto::where('car_id',$id)->count();
      return response()->json(['noOfCarphoto' => $number]);
    }

    
    /**
     * Remove car photo
     *
     * @return Return json of number of car photo based on car id
     */
    public function postRemoveCarPhoto(Request $request,$filename) {
            Log::info($filename);

      $filename = "%" . $filename;
      $exists = CarPhoto::where('car_image_url', 'like',$filename)->count();
      
      if($exists) {
        $result = CarPhoto::where('car_image_url', 'like',$filename)->delete();

        if($result) {
          return Response::json('success', 200);
        } else {
          return Response::json('error', 400);
        }

      } else {
        return Response::json('error', 400);
      }
      
    }

    /**
     * save Edit Car Page
     *
     * @return Return page with success updated
     */
    public function getPhoto(Request $request, $id) {
      return Response::json('success', 200);
    }
    
}
