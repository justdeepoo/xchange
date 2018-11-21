<?php

namespace App\Http\Controllers\Auth;
use App\User;
use App\Models\UserModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\StatusResponse;
use App\Libraries\LogEvent;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Ixudra\Curl\Facades\Curl;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use StatusResponse;
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|string|email|max:155',
            'password'  => 'required|string|min:6',
        ]);

        if ($validator->fails()){
            $data    = $validator->getMessageBag()->toArray();
            $message = $validator->errors()->first();
            return $this->_status('VER', $message, $data);
        }else{
            $d     = $request->all();
            $check = UserModel::where('email', $d['email'])->first();
            if($check == '')
                return $this->_status('ERR', 'Email ID does not exist');

            if($check->email_verified == 0) 
                return $this->_status('ENV','Email ID is not verified.');

            if($check->auth_enabled == 1)
            {
                if(!isset($d['secret']) || is_null($d['secret']))
                    return $this->_status('VER','Please enter OTP.');
                $host = $request->getHttpHost();
                $url  = $host.'/api/verify/2fa';
                $data = ['user_id'=>$check->id,'auth_code'=>$d['secret']];
                $ver  = Curl::to($url)
                    ->withData(json_encode($data))
                    ->withContentType("application/json")
                    ->post();
                $ver = json_decode($ver,true);

                if($ver['statuscode'] != 'SUCC')
                    return $this->_status('ERR','Invalid OTP entered');

            }
             $eventData = [
                'user_id' => $check->id,
                'user_ip' => \Request::ip(),
                'event' => 'User Login',
                'data' => json_encode($d['email'])
            ];
            $addEvt = LogEvent::addEvent($eventData);

            $result = Auth::attempt(['email' => $d['email'], 'password' => $d['password']]);

            if(!$result)
                return $this->_status('ERR', 'Password is Incorrect');
            else{
                $token = str_random(60);
                UserModel::where('email', '=', $d['email'])->update(['token'=>$token]);
                return $this->_status('SUCC', 'User Login Successfully',['token'=>$token]);
            }
        }
    }
}
