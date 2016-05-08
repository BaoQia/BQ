<?php namespace App\Http\Controllers\Auth;

use Validator;
use Mail;
use Auth;
use Socialite;
use Debugbar;
use Crypt;
use DB;
use App\User;
use App\UserRoleMap;
use App\EmailVerifications;
use App\FBAccess;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;
	
	protected $redirectTo = '/';
	
	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest', ['except' => ['getLogout', 'getWaitingActivation', 'postVerify' , 'getVerify']]);
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
			'password' => 'required|confirmed|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		$user = DB::transaction(function ($data) use ($data) {
				 $tempUser = User::create([
					'name' => $data['name'],
					'email' => $data['email'],
					'password' => array_key_exists('password', $data) ? bcrypt($data['password']) : null,
					'phone_number' => $data['phone_number'],
					'user_status_id' => array_key_exists('user_status_id', $data) ? $data['user_status_id'] : '1',
			        'profile_image_url' => array_key_exists('profile_image_url', $data) ? $data['profile_image_url'] : '/images/icons/avatar.jpg',
				]); // TODO: change user status id into ENUM/Constants
				debugbar()->info(array_key_exists('user_role_id', $data));
				 UserRoleMap::create([
				 	'user_id' => $tempUser->id,
				 	'user_role_id' => array_key_exists('user_role_id', $data) ? $data['user_role_id'] : '3',
				 ]);
				 
				 return $tempUser;
			});
		 debugbar()->info($user);
		 return $user;
	}
	
	/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postLogin(Request $request)
	{
		$this->validate($request, [
				'email' => 'required|email', 'password' => 'required',
		]);
	
		$credentials = $this->getCredentials($request);
	
		if (Auth::attempt($credentials, $request->has('remember'))) {
			if (Auth::user()->userStatus->id == 1) {
				return redirect('auth/waiting-activation');
			}

			return redirect()->intended($this->redirectPath());
		}
	
		return redirect($this->loginPath())
		->withInput($request->only('email', 'remember'))
		->withErrors([
				'email' => $this->getFailedLoginMessage(),
		]);
	}
	
	public function getWaitingActivation() {
		return view('auth.waiting-activation');
	}
	
	
	/**
	 * Get the failed login message.
	 *
	 * @return string
	 */
	protected function getFailedLoginMessage()
	{
		return trans('messages.loginFailed');
	}
	
	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postRegister(Request $request)
	{
		$validator = $this->validator($request->all());
	
		if ($validator->fails()) {
			$this->throwValidationException(
					$request, $validator
			);
		}

		$user = $this->create($request->all());		

		if ($user == null) {
			return redirect('auth/login')->with('fail', trans('messages.somethingWrong'));
		}
		
		$emailVerification = $this->createEmailVerification($user->id);
			
		Mail::send('emails.email-verification', 
			['id' => $emailVerification->user_id, 'token' => $emailVerification->token], 
			function($message) use ($user) {
				$message->to("yeong_chuin@yahoo.com", $user->name) // TODO: change email to $user->email
				->subject( trans('messages.activateYourBaoQiaAccount'));
		}); 
		
		// TODO: Negative case
		return redirect('auth/login')->with('success', trans('messages.signUpSuccess'));
}
	
	/**
	 * Create a new token for the email verification.
	 *
	 * @return string
	 */
	public function createNewToken()
	{
		return hash_hmac('sha256', str_random(40), 'ba0Q1a@sab');
	}
	
	
	/**
	 * Create an email verification.
	 *
	 * @return EmailVerifications
	 */
	public function createEmailVerification($userId)
	{
		return EmailVerifications::updateOrCreate([
			'user_id' => $userId,
			'token' => 	$this->createNewToken(),
		]);
	}
	
	/**
	 * Create an email verification.
	 *
	 * @return EmailVerifications
	 */
	public function createFBAccess(array $data)
	{
		return FBAccess::create([
			'user_id' => $data['user_id'],
			'fb_user_id' => $data['fb_user_id'],
			'token' => 	$data['token'],
		]);
	}
	
	public function postVerify() {
		$user = Auth::user();
		
		$emailVerification = EmailVerifications::where('user_id', $user->id)->first();

		Mail::send('emails.email-verification',
			['id' => $emailVerification->user_id, 'token' => $emailVerification->token],
			function($message) use ($user) {
				$message->to("baoqia88@gmail.com", $user->name) // TODO: change email to $user->email
				->subject(trans('messages.activateYourBaoQiaAccount'));
			});
		
		return redirect('auth/waiting-activation')->with('success', trans('messages.activationLinkSent'));
	}
	
	/**
	 * Verify user account
	 *
	 * @param Request $request, $userid, $token
	 * @return Response
	 */
	public function getVerify(Request $request, $userid, $token) {
		
		$verification = EmailVerifications::where('user_id', $userid)
							->where('token', $token)->first();
		if ($verification != null){
			User::where('id',$userid)
			-> update([
					'user_status_id' => '2',
			]);
			
			$verification->delete();
			return redirect('auth/login')->with('success', trans('messages.accountActivated'));
		} else {
			return redirect('auth/login')->with('fail', trans('messages.invalidToken'));
		}

		
	}
	
	/**
	 * Redirect the user to the Facebook authentication page.
	 *
	 * @return Response
	 */
	public function redirectToFBLogin()
	{
		return Socialite::driver('facebook')->redirect();
	}
	
	/**
	 * Obtain the user information from Facebook.
	 *
	 * @return Response
	 */
	public function handleFBLoginCallback()
	{
		$user = Socialite::driver('facebook')->user();
	
		$registeredUser = User::with('FBAccess')->where('email', $user->email)->first();

		if ($user != null) {
			$avatarParameterPos = stripos($user->avatar, '?');
			if ($avatarParameterPos) {
				$avatar = substr($user->avatar, 0, $avatarParameterPos);
			} else {
				$avatar = $user->avatar;
			}
			
			// Login if registered before
			if ($registeredUser != null) {
				if (count($registeredUser->FBAccess) == 0) {
					if ($registeredUser->userStatus->id == 1) {
						$registeredUser->user_status_id = 2;
						$registeredUser->save();
							
					}
					
					$FBData = array('user_id' => $registeredUser->id,
							    'fb_user_id' => $user->id,  
							    'token' => Crypt::encrypt($user->token),
							  );
					$fb = $this->createFBAccess($FBData);
				}
			} else {
				debugBar()->info($user);
				$userData = array('name' => $user->name,
						 		  'email' => $user->email,
							      'profile_image_url' => $avatar,
								  'user_status_id' => '2', 	
								  'phone_number' => null,
				 			);
				$registeredUser = $this->create($userData);
	
			}
			
			Auth::login($registeredUser, true);
			return redirect()->intended($this->redirectPath());
		} else {
			return redirect()->back()->with('fail', trans('messages.invalidToken'));
		}
		
	}
}
	