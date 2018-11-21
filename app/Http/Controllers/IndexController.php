<?php
namespace App\Http\Controllers;
use App\Libraries\KrakenAPI;
use Illuminate\Http\Request;
use App\Libraries\User;
use App\Libraries\Trade;
use App\Traits\StatusResponse;
use Illuminate\Support\Facades\Mail;
use Validator;
use Session;

class IndexController extends Controller {
    use StatusResponse;    
    public function __construct(Request $request)
	{
		$this->token = $request->session()->get('token');				
    }
    
    public function index(Request $request){
        
		if($this->token){
			$this->user_id = User::get_user_id($this->token);
				if($this->user_id){
				return redirect('/trade/inr-xrp')->send(); 	 
			}		  
		}				
		return view('home/index', []);
    }
    public function about(){
        return view('home/about', []);
    }
    public function faq(){
        return view('home/faq', []);
    }
    public function support(){
        return view('home/support', []);
    }
    public function contact()
	{
        return view('home/contact', []);
    }
	
	public function addtoken()
	{
		return view('home/addtoken', []);
	}
	public function news()
	{
		return view('home/news', []);
	}

	public function customersupport()
	{
		return view('home/customersupport', []);
	}	

	
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//============== Add Customer Support Start - Harikesh - Dated: 02-06-2018=====
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	

	private function customersuppRule()
    {
        return [
            'user_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
			'category' => 'required',
			'messages' => 'required',
        ];
    }
	
    private function customersuppValidationMessages()
    {
        return [
            'user_name.required' => 'Name should not be empty',
            'email.required' => 'Email should not be empty',
            'email.email' => 'Please enter valid email address',
			'phone_number.required' => 'Phone Number should not be empty',
			'category.required' => 'Category should not be empty',
            'messages.required' => 'Message should not be empty',
        ];
    }

	
	
	public function customersuppPost(Request $request)
	{
		$validator = Validator::make($request->all(), $this->customersuppRule(), $this->customersuppValidationMessages());
		
		//print_r($validator);exit;
		
		
		if ($validator->fails()) {
			
			$data = $validator->getMessageBag()->toArray();
			$message = $validator->errors()->first();
			return $this->_status('RPI', NULL, $data);

		} 
		else 
		{            
			$d=[
				'user_name'=>trim($request->input('user_name')),
				'email'=>trim($request->input('email')),
				'phone_number'=>trim($request->input('phone_number')),
				'category'=>trim($request->input('category')),
				'messages'=>trim($request->input('messages')),
				'addeddatetime'=>date('Y-m-d H:i:s'),
				'ip_address'=>\Request::ip(),
			];
			
			//print_r($d);exit;
			
			$data = [
				'table'=>'customer_support',
				'data'=>$d
			];		
			
			
			// Added email by harikesh - dated: 02-06-2018
			$email_content=[
				'user_name'=>trim($request->input('user_name')),
				'email'=>trim($request->input('email'))
				];
			
			$this->sendCommonEmail($email_content,'Customer Support', 'customersupport'); // to send the email
			// END MAIL
			
			$resp = User::saveCustomersupport($data);
			return $this->_status('SUCC', NULL);
		}
				
	}	
	public function sendCommonEmail($dataArr=array(), $subject="", $tmpname='')
    {
        $data = [
            'first_name'=>$dataArr['user_name']
        ];
        $firstName = $dataArr['user_name'];
		$email =  $dataArr['email'];
        Mail::send(['html' => 'emails.'.$tmpname], $data, function ($message) use ($email, $firstName, $subject) {
            $message->to($email, $firstName)->subject($subject);
            $message->from('support@giltxchange.com', 'Giltxchange');
        });
    }
	
	
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//============== END - Harikesh - Dated: 02-06-2018======
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	
	
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//============== Add Contact US Start - Harikesh - Dated: 22-05-2018=====
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	

	private function contactusRule()
    {
        return [
            'user_name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
			'messages' => 'required',
        ];
    }
	
    private function contactusValidationMessages()
    {
        return [
            'user_name.required' => 'Name should not be empty',
            'email.required' => 'Email should not be empty',
            'email.email' => 'Please enter valid email address',
			'subject.required' => 'Subject should not be empty',
            'messages.required' => 'Message should not be empty',
        ];
    }

	
	
	public function contactPost(Request $request)
	{
		//print_r($request);
		//echo 'in....';
		//echo $request->post('subscfrmsubmite');
		//exit;
		if($request->input('subscfrmsubmite')=='subscfrmsubmite')
		{
			//echo "insdfsdfkj";
			return $this->subscriberPost($request);
		}
		else
		{
			$validator = Validator::make($request->all(), $this->contactusRule(), $this->contactusValidationMessages());
			if ($validator->fails()) {
				
				$data = $validator->getMessageBag()->toArray();
				$message = $validator->errors()->first();
				return $this->_status('RPI', NULL, $data);

			} 
			else 
			{            
				$d=[
					'user_name'=>trim($request->input('user_name')),
					'email'=>trim($request->input('email')),
					'subject'=>trim($request->input('subject')),
					'messages'=>trim($request->input('messages')),
					'addeddatetime'=>date('Y-m-d H:i:s'),
					'id_address'=>\Request::ip(),
				];
				
				$data = [
					'table'=>'contact_us',
					'data'=>$d
				];		
				
				// Added email by harikesh - dated: 02-06-2018
				$email_content=[
				'user_name'=>trim($request->input('user_name')),
				'email'=>trim($request->input('email'))
				];
				
				$this->sendCommonEmail($email_content,'Contact US', 'contactus'); // to send the email				
				// END EMAIL
				
				$resp = User::saveContactus($data);
				return $this->_status('SUCC', NULL);
			}
		}		
	}	
	
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//============== Add Subscribe Start - Harikesh - Dated: 23-05-2018======
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

	private function subscriberRule()
    {
        return [
            
            'email_address' => 'required|email',
            
        ];
    }
	
    private function subscriberValidationMessages()
    {
        return [
            'email_address.required' => 'Email should not be empty',
            'email_address.email' => 'Please enter valid email address'
        ];
    }	
	
	public function subscriberPost(Request $request)
	{
		$validator = Validator::make($request->all(), $this->subscriberRule(), $this->subscriberValidationMessages());
        if ($validator->fails()) {
            
            $data = $validator->getMessageBag()->toArray();
            $message = $validator->errors()->first();
            return $this->_status('RPI', NULL, $data);

        } 
		else 
		{            
            $d=[
                'email_address'=>trim($request->input('email_address')),
				'addeddatetime'=>date('Y-m-d H:i:s'),
				'ip_address'=>\Request::ip(),
            ];
			
            $data = [
                'table'=>'newsletter_subscribe',
                'data'=>$d
            ];		

			
			// Added email by harikesh - dated: 02-06-2018
			$email_content=[
				'user_name'=>trim($request->input('email_address')),
				'email'=>trim($request->input('email_address'))
				];
			
			//print_r($email_content);exit;
					
			$this->sendCommonEmail($email_content,'Newsletter/Subscriber','subscribe'); // to send the email
			// END EMAIL
			
			$resp = User::saveSubscriberNews($data);
            return $this->_status('SUCC', NULL);
			

			
        }		
	}	

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//============== Add token Start - Harikesh - Dated: 24-05-2018==========
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	

	private function addtokensubRule()
    {
		return [
				'email_address' => 'required|email',
				'coin_name' => 'required',
				'coin_short_name' => 'required',
				'website_name' => 'required',
				'github_source' => 'required',
				'block_explorer' => 'required',
				'bitcoin_talk' => 'required',
				'cryptocurrency_based' => 'required',
				'contract_address' => 'required',
				'price_filling' => 'required',
				'coinmarketcap' => 'required',
				'icon' => 'required',
				'telegram' => 'required',
				];
    }
	
    private function addtokensubValidationMessages()
    {
		return [
			'email_address.required' => 'Please enter your email address',
			'email_address.email' => 'Please enter valid email address',
			'coin_name.required' => 'Please enter coin name',
			'coin_short_name.required' => 'Please enter coin short name',
			'website_name.required' => 'Please enter website name',
			'github_source.required' => 'Please enter github source',
			'block_explorer.required' => 'Please enter block explorer',
			'bitcoin_talk.required' => 'Please enter bitcoin talk',
			'cryptocurrency_based.required' => 'Please select cryptocurrency based',
			'contract_address.required' => 'Please enter contact address',
			'price_filling.required' => 'Please enter price filling',
			'coinmarketcap.required' => 'Please enter coin market cap',
			'icon.required' => 'Please enter ico png',
			'telegram.required' => 'Please enter telegram',
			];
    }	
	
	public function addtokencryptoPost(Request $request)
	{
		$validator = Validator::make($request->all(), $this->addtokensubRule(), $this->addtokensubValidationMessages());
        if ($validator->fails()) {
            
            $data = $validator->getMessageBag()->toArray();
            $message = $validator->errors()->first();
            return $this->_status('RPI', NULL, $data);

        } 
		else 
		{            
            $d=[
                'email_address'=>trim($request->input('email_address')),
				'coin_name'=>trim($request->input('coin_name')),
				'coin_short_name'=>trim($request->input('coin_short_name')),
				'website_name'=>trim($request->input('website_name')),
				'github_source'=>trim($request->input('github_source')),
				'block_explorer'=>trim($request->input('block_explorer')),
				'bitcoin_talk'=>trim($request->input('bitcoin_talk')),
				'cryptocurrency_based'=>trim($request->input('cryptocurrency_based')),
				'contract_address'=>trim($request->input('contract_address')),
				'price_filling'=>trim($request->input('price_filling')),
				'coinmarketcap'=>trim($request->input('coinmarketcap')),
				'icon'=>trim($request->input('icon')),
				'trading_pairs_btc_coin'=>trim($request->input('trading_pairs_btc_coin')),
				'trading_pairs_coin_usd'=>trim($request->input('trading_pairs_coin_usd')),
				'trading_pairs_other'=>trim($request->input('trading_pairs_other')),
				'telegram'=>trim($request->input('telegram')),
				'added_datetime'=>date('Y-m-d H:i:s'),
				'ip_address'=>\Request::ip(),
            ];
			
            $data = [
                'table'=>'addtoken_cryptocurrency',
                'data'=>$d
            ];		

			// Added email by harikesh - dated: 02-06-2018
			$email_content=[
				'user_name'=>trim($request->input('email_address')),
				'email'=>trim($request->input('email_address'))
				];
			$this->sendCommonEmail($email_content,'Add Token/Cryptocurrency','addtoken'); // to send the email
			// END MAIL
			
			$resp = User::saveAddtokenSubs($data);
            return $this->_status('SUCC', NULL);
			

			
        }		
	}	
//============== END token Start==========	
	
    public function aml(){
        return view('home/aml', []);
    }
    public function fee(){
        return view('home/fee', []);
    }
    public function terms(){
        return view('home/terms', []);
    }
    public function privacy(){
        return view('home/privacy', []);
    }
    public function disclaimer(){
        return view('home/disclaimer', []);
    }

    public function upload_file(){
        return view('home/file', []);
    }
    public function submit_kycTest(Request $request)
    {
        $this->s3_image_upload($request->file('aadhar_front'), 'uploads/kyc/',1);
        $this->s3_image_upload($request->file('aadhar_front1'), 'uploads/kyc/',2);
        $this->s3_image_upload($request->file('aadhar_front2'), 'uploads/kyc/',3);
        $this->s3_image_upload($request->file('aadhar_front3'), 'uploads/kyc/',4);
        //$this->s3_image_upload($request->file('aadhar_front4'), 'uploads/kyc/',5);
        echo json_encode(['adsf']);
    }
    private function s3_image_upload($image, $destinationPath, $c)
    {
        // $s3  = \Storage::disk('s3');

        // $ext = $file->getClientOriginalExtension();

        // $name= $user_id.time().'.'.$ext;

        // $path= '/careers/' . $name;

        // $s3->put($path, file_get_contents($file), 'public');

        // $url = \Storage::disk('s3')->url('careers/'.$name);

        // return $url;

        $custom_file_name = $c.'-'.time().'-'.$image->getClientOriginalName();
        //$path = $image->storeAs($destinationPath,$custom_file_name);
        
        
        $resp = $image->move($destinationPath, $custom_file_name);
        return $custom_file_name;
        

    }
    
    
    
    
}