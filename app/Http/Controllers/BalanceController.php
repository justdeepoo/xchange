<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Traits\StatusResponse;
use App\Libraries\User;
use App\Libraries\Trade;
use App\Models\WalletModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Validator;
use Session;

class BalanceController extends Controller {
    use StatusResponse;
    public function __construct(Request $request)
	{
        
        $this->middleware('group');
        $this->token = $request->session()->get('token');
        $this->user_id = User::get_user_id($this->token);
		
        
		// start added redirect code by harikesh - dated: 09-06-2018
		/*if(!$this->user_id)
		{
			$request->session()->invalidate();
			return redirect('/');
        }*/
		//end redirect code
		
		$this->avalaible_coin = Trade::getAvailableCoins();
        $this->active_coin_pair = ['inr-xrp'=>0,'inr-btc'=>0,'inr-eth'=>0,'inr-bch'=>0, 'inr-ltc'=>0];
        $this->user = new User();

        $this->minimum_withdrawal_bal = 10;
		
		$this->user = new User();
		
    }
    
    public function index(Request $request)
	{        
		$s = User::checkKYC(['user_id'=>$this->user_id]);        
        if(!$s){
			return redirect('/profile');
			//return redirect()->to('/profile');			
		}
		
		/* Creating crypto addresses and inserting into wallet table (start) */
		$url = 'token/'.$this->token.'/wallet/coins';
        $resp = json_decode($this->user->curlGetRequest($url));
		
		$coin_list = [];
        if($resp->statuscode=='SUCC')
        {
            foreach($resp->data as $k=>$coin)
            {
                if($coin->status==0)
                {
                    // Generate address
                    $d = ['coin'=>$k, 'token'=>$this->token];
                    $url = 'user/set_address';
                    $r = json_decode($this->user->curlPostRequest($url, $d));
                    if($r->statuscode=='SUCC')
                    {
                        /*
						$coin_list[$r->data->coin] = [
                            'address'=>$r->data->address,
                            'coin'=>$r->data->coin,
                            'qr_code_url'=>$r->data->qr_code_url,
                            'balance'=>$r->data->balance,
                            'status'=>1,
                            'in_order'=>$r->data->in_order
                        ]  ;
						*/
                    }
                }
                else{
                    $coin_list[$k] = (array)$coin;
                }
           }
        }
		/* Creating crypto addresses and inserting into wallet table (end) */
		
		
        $v = [
                'where'=>['coin'=>'inr', 'user_id'=>$this->user_id],
                'select'=>['balance','locked_bal', 'coin']
        ];
        $b = User::getUserBalance($v);
		
		$deposit_request = User::getDepositRequests($this->user_id);
		$withdraw_request = User::getWithdrawRequests($this->user_id);
		
        $data=[
            'active_coin_pair' => $this->active_coin_pair,
            'balance'=>$b,
            'deposit_request'=>$deposit_request,
			'withdraw_request'=>$withdraw_request
        ];
        
        return view('xchange/balance', $data);
    }

    
    public function submit_deposit_request(Request $request)
    {
        $validator = Validator::make($request->all(), $this->depositAmtRule(), $this->depositAmtValidationMessages());
        if ($validator->fails()) {
            
            $data = $validator->getMessageBag()->toArray();
            $message = $validator->errors()->first();
            return $this->_status('RPI', NULL, $data);

        } else {
            
            $request_id = 'DEPO'.$this->user_id.time();
			
			$b = $request->input();
            $b['user_id'] = $this->user_id;
            $b['request_id'] = $request_id;
            unset($b['reference_number_confirmation']);
            $b['deposit_date'] = date('Y-m-d', strtotime($request->input('deposit_date')));
			//$b['remarks'] = $request->input('remarks');
            
            $data = [
                
                'table'=>'deposit_request',
                'data'=>$b
            ];
			
			          
            $resp = User::saveDepositRequest($data);
            
			$admin_data = User::getSingleRowData(array('table'=>'admin','where'=>array('id'=>'10'), 'select'=>array('withdraw_email','deposit_email')));			
			$deposit_email = $admin_data->deposit_email;
			
			$emailData = [			
            'request_id'=>$request_id,
            'reference_number'=>$request->input('reference_number'),
			'deposit_date'=>date('d M, Y', strtotime($request->input('deposit_date'))),
			'remarks'=>$request->input('remarks'),
			'amount'=>$request->input('amount')
			];
			
			$firstName = 'Giltxchange Admin';			
			$email =  $deposit_email;
			Mail::send(['html' => 'emails.inrdepositrequestadmin'], $emailData, function ($message) use ($email, $firstName) {
				$message->to($email, $firstName)->subject('INR DEPOSIT REQUEST');
				$message->from('support@giltxchange.com', 'Giltxchange');
			});
			
			return $this->_status('SUCC', NULL);
        }
    }
    public function submit_withdraw_request(Request $request)
    {
       
        $validator = Validator::make($request->all(), $this->withAmtRule(), $this->withAmtValidationMessages());
        if ($validator->fails()) {
            
            $data = $validator->getMessageBag()->toArray();
            $message = $validator->errors()->first();
            return $this->_status('RPI', NULL, $data);
        }
        else {
						
            if (!$request->input('2fa-code') || $request->input('2fa-code')=='')
				return $this->_status('GFC', 'Please enter 2fa code.');
						
			$total_amt = trim($request->input('amount'));
			if($this->minimum_withdrawal_bal <= $total_amt)
			{
				
				$user_data = User::getSingleRowData(array('table'=>'users','where'=>array('id'=>$this->user_id), 'select'=>array('first_name','email')));	
				
				// Get current coin balance
				$s = User::balance('INR', $this->user_id);
				$bal = $s['data']['balance'];
				// Check sufficient balance for bid
				if($s['status'])
				{
					if($bal >= $total_amt)
					{						
						$url = '2fa/verifycode2fa';
						$v = ['token' => $this->token, 'secret' => $request->input('2fa-code')];
						$resp = json_decode($this->user->curlPostRequest($url, $v));
						
						if($resp->statuscode=='SUCC')
						{
							//Deduct balance from main account 
							$s = User::deductCurrencyAmount(['coin'=>'inr', 'balance'=>$total_amt, 'user_id'=>$this->user_id]);
							if($s['status'])
							{
								//Add withdraw request into add withdraw table
								$request_id = 'WITH'.$this->user_id.time();
								$d =[
									'table'=>'withdraw_requests',
									'data'=>[
										'request_id'=>$request_id,
										'user_id'=>$this->user_id,
										'amount'=>$total_amt,
										'reqeusted_at'=>date('Y-m-d H:i:s'),
										'status'=>0,
										'currency'=>'inr'
									]
								];
								User::saveWithdrawRequest($d);
								
								/* Sending withdrawal email to admin (start) */
								$admin_data = User::getSingleRowData(array('table'=>'admin','where'=>array('id'=>'10'), 'select'=>array('withdraw_email','deposit_email')));			
								$withdraw_email = $admin_data->withdraw_email;
								
								$emailData = [			
								'request_id'=>$request_id,								
								'reqeusted_at'=>date('d M, Y',strtotime(date('Y-m-d H:i:s'))),
								'amount'=>$total_amt,
								'first_name'=>$user_data->first_name,
								'email'=>$user_data->email
								];
								
								$firstName = 'Giltxchange Admin';			
								$email =  $withdraw_email;
								Mail::send(['html' => 'emails.inrwithdrawrequestadmin'], $emailData, function ($message) use ($email, $firstName) {
									$message->to($email, $firstName)->subject('INR WITHDRAW REQUEST');
									$message->from('support@giltxchange.com', 'Giltxchange');
								});
								/* Sending withdrawal email to admin (end) */
								
								return $this->_status('SUCC', 'Withdraw request successfully initiated.');
							}
							return $s;		
						}else{
							//echo json_encode($resp);
							return $this->_status('ERR2FA', 'Invalid 2fa code.');
						}
						
					}
					else{
						return $this->_status('CST', 'You don\'t have sufficient balance.');
					}
				}
				else{
					return $this->_status('CST', 'Can\'t get balance for INR ');
				}
			}
			else{
				return $this->_status('CST', 'Minimum withdraw amount should not less than Rs.'.$this->minimum_withdrawal_bal);
			}
			
			
			/*
			
			*/
        }
    }
    
    private function withAmtRule()
    {
        return [
            'amount' => 'required|numeric',
        ];
    }
    private function withAmtValidationMessages()
    {
        return [
            'amount.required' => 'Enter correct withdraw amount',
        ];
    }

    private function depositAmtRule()
    {
        return [
            'amount' => 'required|numeric',
            'deposit_date' => 'required',
            'reference_number' => 'required|confirmed',
            'reference_number_confirmation' => 'required',
        ];
    }
    private function depositAmtValidationMessages()
    {
        return [
            'amount.required' => 'Enter deposited amount',
            'deposit_date.required' => 'Enter deposited date',
            'reference_number.required' => 'Enter reference number',
            'confirm_reference_number.required' => 'Confirm reference number should match with reference number',
        ];
    }
    public function tradeHistory() {
		$data = [];				
		$data['user_id'] = $this->user_id;
		$data['trade_data'] = User::getTradeHistory($this->user_id);						
		return view('xchange/tradehistory', $data);
	}
	public function headerNotification(){
		
		$user_id = $this->user_id;
		$notification_data = User::getHeaderNotification($user_id);
		return $notification_data;
		
	}
	public function submitDelDepositReq(Request $request){
		
		$request_action = $request->input('request_action');
		$deposit_id = $request->input('deposit_id');
		
		if(!empty($deposit_id) && $request_action == 'del_deposit_request')
		{
			$b['status'] = '3';            
			$data = [
				
				'table'=>'deposit_request',
				'data'=>$b,
				'where'=>['user_id'=>$this->user_id, 'id'=>$deposit_id, 'status' => '0']
			];
		  
			$resp = User::updateDepositRequest($data);
			return $this->_status('SUCC', 'Deleted successfully.');	
		}else{
			return $this->_status('RPI', 'Oops! something went wrong.');
		}
		
				
	}
	public function submitDelWithdrawReq(Request $request){
		
		$request_action = $request->input('request_action');
		$withdraw_id = $request->input('withdraw_id');
		
		if(!empty($withdraw_id) && $request_action == 'del_withdraw_request')
		{
			
			
			$d = [				
				'table'=>'withdraw_requests',
				'where'=>['user_id'=>$this->user_id, 'id'=>$withdraw_id, 'status' => '0'],
				'select'=>['amount']				
			];
			
			$wdrlReqData = User::getSingleRowData($d);
			
			$b['status'] = '3';            
			$data = [
				
				'table'=>'withdraw_requests',
				'data'=>$b,
				'where'=>['user_id'=>$this->user_id, 'id'=>$withdraw_id, 'status' => '0']
			];		  
			$resp = User::updateWithdrawRequest($data);
			
			if($resp){
				$amount = $wdrlReqData->amount;
				$resp2 = WalletModel::where(['user_id'=>$this->user_id, 'coin'=>'inr'])->update([
								'balance' => DB::raw('balance + '.$amount)]);	
			}			
			return $this->_status('SUCC', 'Deleted successfully.');	
		}else{
			return $this->_status('RPI', 'Oops! something went wrong.');
		}
		
	}
	
}