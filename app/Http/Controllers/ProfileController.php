<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Libraries\User;
use App\Libraries\Trade;
use App\Traits\StatusResponse;
use Validator;
//use Session;

class ProfileController extends Controller {

    use StatusResponse;

    public function __construct(Request $request)
	{
        $this->middleware('group');
       
        $this->token = $request->session()->get('token');
        
        $this->user_id = User::get_user_id($this->token);
		
		// start added redirect code by harikesh - dated: 09-06-2018
		if(!$this->user_id)
		{
			$request->session()->invalidate();
			return redirect('/');
        }
		//end redirect code
		
        //$this->avalaible_coin = Trade::getAvailableCoins();
        //$this->active_coin_pair = ['inr-xrp'=>0,'inr-btc'=>0,'inr-eth'=>0,'inr-bch'=>0, 'inr-ltc'=>0];

        $this->user = new User();
    }
    
    public function index(Request $request)
	{
        $d = [
            'id'=>$this->user_id,
            'is_profile'=>true,
			'is_bank'=>true,
            'is_address'=>true
        ];
        
        $user = User::userData($d);
		
		
        
        if($user['address']==null || $user['address']==''){
            $user['address'] = (object) ['addr'=>'', 'city'=>'', 'zip_code'=>'', 'country'=>'', 'document_issue_date'=>'', 'document_number'=>'', 'document_exp_date'=>'', 'document_attached_file'=>''];
        }
           
        $data=[
            //'active_coin_pair' =>$this->active_coin_pair,
            'user_data'=>$user
        ];
        // echo '<pre>';
        // print_r($data['user_data']);
        // die;
		
        return view('xchange/profile', $data);
    }

    public function submit_profile(Request $request)
    {
        $validator = Validator::make($request->all(), $this->profielRule(), $this->profielValidationMessages());
        if ($validator->fails()) {
            
            $data = $validator->getMessageBag()->toArray();
            $message = $validator->errors()->first();
            return $this->_status('RPI', NULL, $data);

        } else {
            

            $dob = date('Y-m-d', strtotime($request->input('day').'-'.$request->input('month').'-'.$request->input('year')));
            $document_issue_date = date('Y-m-d', strtotime($request->input('doc_issue_day').'-'.$request->input('doc_issue_month').'-'.$request->input('doc_issue_year')));
            $document_exp_date = date('Y-m-d', strtotime($request->input('doc_exp_day').'-'.$request->input('doc_exp_month').'-'.$request->input('doc_exp_year')));
            
            $d=[
                'dob' => $dob,
                'first_name'=>trim($request->input('first_name')),
                'last_name'=>trim($request->input('last_name')),
                'document_issue_date'=>$document_issue_date,
                'document_exp_date'=>$document_exp_date,
                'document_number'=>trim($request->input('document_number')),
                'country'=>trim($request->input('country')),
				'is_iddoc_issue_date'=>$request->input('is_iddoc_issue_date'),
				'is_iddoc_exp_date'=>$request->input('is_iddoc_exp_date'),
                'document_attached'=>$this->s3_image_upload($request->file('document_attached'), 'uploads/documents/'),
                'is_profile'=>1
            ];
            $data = [
                'table'=>'users',
                'data'=>$d,
                'where'=>['id'=>$this->user_id],
            ];
            $resp = User::save($data);
            return $this->_status('SUCC', NULL);
        }
    }

    
    public function submit_address(Request $request)
    {
        $validator = Validator::make($request->all(), $this->addressRule(), $this->addressValidationMessages());
        if ($validator->fails()) {
            
            $data = $validator->getMessageBag()->toArray();
            $message = $validator->errors()->first();
            return $this->_status('RPI', NULL, $data);

        } else {
            

            $dob = date('Y-m-d', strtotime($request->input('day').'-'.$request->input('month').'-'.$request->input('year')));
            $document_issue_date = date('Y-m-d', strtotime($request->input('doc_issue_day').'-'.$request->input('doc_issue_month').'-'.$request->input('doc_issue_year')));
            $document_exp_date = date('Y-m-d', strtotime($request->input('doc_exp_day').'-'.$request->input('doc_exp_month').'-'.$request->input('doc_exp_year')));
            
            $d=[
                'user_id'=>$this->user_id,
                'city'=>trim($request->input('city')),
                'addr'=>trim($request->input('addr')),
                'zip_code'=>trim($request->input('zip_code')),
                'document_issue_date'=>$document_issue_date,
                'document_exp_date'=>$document_exp_date,
                'document_number'=>trim($request->input('document_number')),
                'country'=>trim($request->input('country')),
				'is_addoc_issue_date'=>$request->input('is_addoc_issue_date'),
				'is_addoc_exp_date'=>$request->input('is_addoc_exp_date'),
                'document_attached_file'=>$this->s3_image_upload($request->file('document_attached_file'), 'uploads/documents/'),
                'created_at'=>date('Y-m-d')
            ];
            $data = [
                'table'=>'user_address',
                'data'=>$d,
                'where'=>['user_id'=>$this->user_id],
            ];
            $resp = User::save($data, 'Address Updated');

            $d=[
                'is_address'=>1,
            ];
            $data = [
                'table'=>'users',
                'data'=>$d,
                'where'=>['id'=>$this->user_id],
            ];
            $resp = User::save($data, 'Update Address pending');

            return $this->_status('SUCC', NULL);
        }
    }
    private function s3_image_upload($image, $destinationPath)
    {
        // $s3  = \Storage::disk('s3');

        // $ext = $file->getClientOriginalExtension();

        // $name= $user_id.time().'.'.$ext;

        // $path= '/careers/' . $name;

        // $s3->put($path, file_get_contents($file), 'public');

        // $url = \Storage::disk('s3')->url('careers/'.$name);

        // return $url;

        $custom_file_name = time().'-'.$image->getClientOriginalName();
        //$path = $image->storeAs($destinationPath,$custom_file_name);
        
        
        $resp = $image->move($destinationPath, $custom_file_name);
        return $custom_file_name;
    }


    public function submit_kyc(Request $request)
    {
        $validator = Validator::make($request->all(), $this->kycRule(), $this->kycValidationMessages());
        if ($validator->fails()) {
            
            $data = $validator->getMessageBag()->toArray();
            $message = $validator->errors()->first();
            return $this->_status('RPI', NULL, $data);

        } else {
           
            $data = [
                'data'=>
                    ['user_id'=>$this->user_id,
                    'aadhar_no'=>$request->input('aadhar_no'),
                    'pan_no'=>$request->input('pan_no'),
                    'aadhar_front'=>$this->s3_image_upload($request->file('aadhar_front'), 'uploads/kyc/'),
                    'aadhar_back'=>$this->s3_image_upload($request->file('aadhar_back'), 'uploads/kyc/'),
                    'pan_img'=>$this->s3_image_upload($request->file('pan_img'), 'uploads/kyc/'),
                ],
                'where'=>['user_id'=>$this->user_id],
                'table'=>'user_kyc',
                
            ];
            
            $resp = User::saveUserData($data);

            $data = [
                'table'=>'users',
                'data'=>['is_kyc'=>1],
                'where'=>['id'=>$this->user_id],
            ];
            $resp = User::save($data);

            return $this->_status('SUCC', NULL);
        }
    }

    private function kycRule()
    {
        return [
            'aadhar_no' => 'required',
            'aadhar_front' => 'required||mimes:jpeg,png,jpg,pdf,html|max:2048',
            'aadhar_back' => 'required||mimes:jpeg,png,jpg,pdf,html|max:2048',
            'pan_no' => 'required',
            'pan_img' => 'required||mimes:jpeg,png,jpg,pdf,html|max:2048',
        ];
    }
    private function kycValidationMessages()
    {
        return [
            'aadhar_no.required' => 'Aadhar number required',
            'aadhar_front.required' => 'Kindly attach Aadhar front picture',
            'aadhar_back.required' => 'Kindly attach Aadhar back picture',
            'pan_no.required' => 'PAN no required',
            'pan_img.required' => 'Kindly attach PAN cart picture',
        ];
    }


    public function submit_bank(Request $request)
    {
	   $validator = Validator::make($request->all(), $this->bankRule(), $this->bankValidationMessages());
        if ($validator->fails()) {
            
            $data = $validator->getMessageBag()->toArray();
            $message = $validator->errors()->first();
            return $this->_status('RPI', NULL, $data);

        } else {
            
            $b = $request->input();
			
            unset($b['account_no_confirmation']);
			
			
            $data = [
                    'table'=>'user_bank_accounts',
					
                    'data'=>['ifsc'=>$request->input('ifsc'),
					'bank'=>$request->input('bank'),
					'ifsc'=>$request->input('ifsc'),
					'linked_mobile'=>$request->input('linked_mobile'),
					'account_no'=>$request->input('account_no'),
					'holder_name'=>$request->input('holder_name'),
					'branch'=>$request->input('branch'),
					'account_type'=>$request->input('account_type'),
					'pan_card_number'=>$request->input('pan_card_number'),	
					'color_scan_cheque'=>$this->s3_image_upload($request->file('color_scan_cheque'), 'uploads/documents/'),
					],
					
                    'where'=>['user_id'=>$this->user_id],
                ];
				
			//	print_r($data);		exit;
			
            $resp = User::saveUserData($data);
            
            $data = [
                'table'=>'users',
                'data'=>['is_bank'=>1],
                'where'=>['id'=>$this->user_id],
            ];
            $resp = User::save($data);

            return $this->_status('SUCC', NULL);
        }
    }
    
    private function bankRule()
    {
        return [
            'ifsc' => 'required',
            'bank' => 'required',
            'account_no' => 'required|numeric|confirmed',
            'account_no_confirmation' => 'required|numeric',
            'linked_mobile' => 'required|numeric',
            'branch' => 'required',
            'account_type' => 'required|alpha',
			'pan_card_number' => 'required',
			'holder_name' => 'required|string',
			'color_scan_cheque' => 'required|mimes:jpeg,png,jpg,pdf,html|max:2048',
			
            
        ];
		//'color_scan_cheque' => 'required|mimes:jpeg,png,jpg,pdf,html|max:2048',
    }
    private function bankValidationMessages()
    {
        return [
            'ifsc.required' => 'Please enter IFSC',
            'bank.required' => 'Please enter bank name',
            'account_no.required' => 'Please enter your account number.',
            'confirm_acc.required' => 'Confirm account should be match with Account no',
            'linked_mobile.required' => 'Please enter linked mobile Number and valid',
            'branch.required' => 'Please enter branch name',
            'account_type.required' => 'Please enter account type',
			'pan_card_number.required' => 'Please enter pan card number',
			'holder_name.required' => 'Please enter name of account holder',
			
        ];
		
		//'color_scan_cheque.required' => 'Colour scan copy of the cheque counld not be empty',
    }
    private function profielRule()
    {
        return [
            'first_name' => 'required|alpha|max:25',
            'last_name' => 'required|alpha|max:25',
            'mobile' => 'required|numeric',
            'document_number'=>'required|max:30',
            'country' => 'required|max:25',
            'document_attached' => 'required|mimes:jpeg,png,jpg,pdf,html|max:2048',
        ];
    }
    private function profielValidationMessages()
    {
        return [
            'first_name.required' => 'First name could not be empty',
            'last_name.required' => 'Last name could not be empty',
            'mobile.required' => 'Please enter mobile number',
            'document_number.required' => 'Please enter document number',
            'country.required' => 'Please select country',
            'document_attached.required' => 'Kindly attach document',
        ];
    }

    private function addressRule()
    {
        return [
            'city' => 'required|max:25',
            'zip_code' => 'required|numeric',			
            'addr' => 'required|max:50',
            'document_number'=>'required|max:30',
            'country' => 'required|max:50',
            'document_attached_file' => 'required|mimes:jpeg,png,jpg,pdf,html|max:2048',
        ];
    }
    private function addressValidationMessages()
    {
        return [
            'city' => 'Please enter city name',
            'zip_code.required' => 'Please enter zip code',
            'addr.required' => 'Please enter your address',
            'document_number.required' => 'Please enter document number',
            'country.required' => 'Please select country',
            'document_attached_file.required' => 'Kindly attach document',
        ];
    }



    public function set2FA(Request $request)
    {
        if (!$request->input('g2fa') || $request->input('g2fa')=='') {
            return $this->_status('CUST', NULL);
        } else{
            
            $d = [
                'auth_code'=>trim($request->input('g2fa')),
                'token'=>$this->token
            ];

            if($request->input('atcion')==1)
            {
                $url = '2fa/disable';
            }
            else
                $url = '2fa/set';
            

            echo $this->user->curlPostRequest($url, $d);
        }
    }

    public function reset_password(Request $request)
    {
        $validator = Validator::make($request->all(), $this->passwordRule(), $this->passwordValidationMessages());
        if ($validator->fails()) {
            
            $data = $validator->getMessageBag()->toArray();
            $message = $validator->errors()->first();
            return $this->_status('RPI', NULL, $data);

        } else {

            $d = [
                'new_password'=>trim($request->input('password')),
                'token'=>$this->token,
                'old_password'=>trim($request->input('old_password')),
            ];

            if($request->input('secret'))
            {
                $d['secret'] = trim($request->input('secret'));
            }

            $url = 'password/reset';
            echo $this->user->curlPostRequest($url, $d);
        }
        

        
    }

    private function passwordRule()
    {
        return [
            'password' => 'required|confirmed',
            'old_password' => 'required',
            'password_confirmation' => 'required',
        ];
    }
    private function passwordValidationMessages()
    {
        return [
            'old_password.required' => 'Current Password should not be empty',
            'password.required' => 'Password should not be empty',
            'password_confirmation.required' => 'Confirm password should be of password',
            
        ];
    }

    

}