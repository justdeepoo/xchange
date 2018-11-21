<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Traits\StatusResponse;
use App\Libraries\User;
use App\Libraries\Trade;

use Validator;
//use Session;


class WalletController extends Controller {
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
    }
    
    public function index(Request $request)
	{

        $s = User::checkKYC(['user_id'=>$this->user_id]);
        
        if(!$s)
            return redirect('/profile');

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
					//print_r($r);exit;
					//echo $r->data->message;
					//exit;
                    if($r->statuscode=='SUCC' && $r->data->message!='No addresses are available')
                    {
							$coin_list[$r->data->coin] = [
                            'address'=>$r->data->address,
                            'coin'=>$r->data->coin,
                            'qr_code_url'=>$r->data->qr_code_url,
                            'balance'=>$r->data->balance,
                            'status'=>1,
                            'in_order'=>$r->data->in_order
                        ]  ;
                    }
                }
                else{
                    $coin_list[$k] = (array)$coin;
                }
           }
        }
        
        $data=[
            'active_coin_pair' =>$this->active_coin_pair,
            'coin_list'=>$coin_list
        ];
        return view('xchange/wallet', $data);
    }

    public function post_withdraw(Request $request)
    {
        $destination = $request->input('destination');
        $coin = strtolower($request->input('coin'));
        if($coin=='xrp')
        {
            if($request->input('dt')==NULL)
            {
                $dt = $request->input('dt');
                return $this->_status('CST', 'Parameter is missing.');
            }
            else{
                $destination = $request->input('destination').'?dt='.$dt;
            }
        }

        $d = [
            'token'=>$this->token,
            'coin'=>$coin,
            'amount'=>$request->input('amount'),
            'destination'=>$destination,
        ];

        $url = 'user/wallet/send';
        $resp = json_decode($this->user->curlPostRequest($url, $d));
        if($resp->statuscode=='SUCC')
        {
            
        }
        echo json_encode($resp);
    }
}