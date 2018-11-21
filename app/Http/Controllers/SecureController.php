<?php

namespace App\Http\Controllers;

use App\Libraries\KrakenAPI;
use Illuminate\Http\Request;
use App\Traits\StatusResponse;
//use Illuminate\Http\RedirectResponse;
//use Illuminate\Routing\Redirector;
use App\Libraries\User;
use Illuminate\Support\Facades\Mail;
use Validator;


class SecureController extends Controller {

    use StatusResponse;
    
    public function __construct(Request $request)
	{
        
        $this->user = new User();
    }
    
    public function redirectToDashboard($request)
    {
        $this->token = $request->session()->get('token');
        if($this->token!='' || $this->token!=NULL)
        {
            return redirect('/trade/inr-xrp')->send(); 
        }
    }
    public function login(Request $request)
    {
        $this->redirectToDashboard($request);
        return view('secure/login');
    }

    public function post_login(Request $request)
    {
        if($request->input('email')=='demouser@gmail.com'){
			$resp = $this->_status('ERR', 'Email ID does not exist');
		}else{
			if($request->input('email') && $request->input('password')!='' && !$request->input('secret'))
			{
				//Check user authentication
				$k = User::getSingleRowData(['select'=>['auth_enabled','first_name','last_name','email'], 'where'=>['email'=>$request->input('email')], 'table'=>'users']);
				
				if(!empty($k))
				{
					if($k->auth_enabled)
					{
						$d = [
							'statuscode'=>'2fa',
							'2fa_enabled'=>1,
						];
						return json_encode($d);
					}
				}
			}
			
			$d = $request->input();
			$url = 'user/login';
			$resp = json_decode($this->user->curlPostRequest($url, $d));
			
			
			if($resp->statuscode=='SUCC')
			{
				$token = $resp->data->token;
				$request->session()->put('token', $token);
				$request->session()->put('loggedin', true);
				
				$m = User::getSingleRowData(['select'=>['auth_enabled','first_name','last_name','email'], 'where'=>['token'=>$token], 'table'=>'users']);
				
				if(isset($resp->data->first_name)){
					$first_name = $resp->data->first_name;
					$last_name = $resp->data->last_name;
					$email = $resp->data->email;	
				}else{
					$first_name = $m->first_name;
					$last_name = $m->last_name;
					$email = $m->email;
				}
				
				$request->session()->put('sess_userfname', $first_name);
				$request->session()->put('sess_userlname', $last_name);
				$request->session()->put('sess_useremail', $email);
			}			
		}		
        echo json_encode($resp);
    }

    public function register(Request $request)
    {
        $this->redirectToDashboard($request);
        return view('secure/register');
    }
    public function post_register(Request $request)
    {
        $d = [
            'first_name'=>$request->input('first_name'),
            'last_name'=>$request->input('last_name'),
            'email'=>$request->input('email'),
            'mobile'=>$request->input('mobile'),
            'password'=>$request->input('password'),
            'password_confirmation'=>$request->input('password_confirmation'),
            'terms'=>$request->input('terms')
        ];
        $url = 'user/register';
    	echo $resp = $this->user->curlPostRequest($url, $d);
    }
    
    public function forgot(Request $request)
    {
        $this->redirectToDashboard($request);
        return view('secure/forgot');
    }
    public function post_forgot(Request $request)
    {
        if ($request->input('email')=='') {
           return $this->_status('VER', NULL, ['email'=>'Please enter your email address.']);
        } else {
            $url = 'password/forgot';
    	    echo $resp = $this->user->curlPostRequest($url, $request->input());
        }
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        return redirect('/');
        //return redirect('secure/login');
    }
    
    public function confirm_email(Request $request){
        
        if(isset($_GET['hash']))
        {
            $hash = $_GET['hash'];
            $k = User::confirmEmail(['data'=>['email_verified'=>1], 'where'=>['referal_code'=>$hash, 'email_verified' => '0'], 'table'=>'users']);
            if($k)
            {
                $this->user->entryBal(['where'=>['referal_code'=>$hash], 'table'=>'users']);                
				$request->session()->put('EMAIL_VERIFICATION_SUCC', '1');
				return redirect('/');
            }
            else{
				$request->session()->put('EMAIL_VERIFICATION_ERR', '1');
                return redirect('/');
            }
        }
    }

    public function reset_password(Request $request){

        $uri = explode('/',$request->path('token'));
        $token= $uri[count($uri)-1];
        return view('secure/reset-password', ['token'=>$token]);
       
    }
    public function set_password(Request $request){

        $validator = Validator::make($request->all(), $this->resPwdRule(), $this->resPwdValidationMessages());
        if ($validator->fails()) {
            
            $data = $validator->getMessageBag()->toArray();
            $message = $validator->errors()->first();
            return $this->_status('VER', NULL, $data);

        } else {
            $url = 'password/set';
    	    echo $resp = $this->user->curlPostRequest($url, $request->input());
        }
        
        
       
    }
    function resPwdRule()
    {
        return [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ];
    }

    private function resPwdValidationMessages()
    {
        return [
            'password.required' => 'Kindly enter password',
            'password_confirmation.required' => 'Kindly enter confirm password',
        ];
    }


    public function sendTestEmail()
    {
        $data = [
            'first_name'=>'Deepoo',
            'forgot_link'=>'This is the test link'
        ];
        $firstName = 'Deepoo';
        //$email =  'deepoo@lalaworld.io';
		$email =  'harikesh.svarogt@gmail.com';
        Mail::send(['html' => 'emails.forgot'], $data, function ($message) use ($email, $firstName) {
            $message->to($email, $firstName)->subject('Reset Password');
            $message->from('support@giltxchange.com', 'Giltxchange');
        });
    }

    

}