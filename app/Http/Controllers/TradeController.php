<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Libraries\User;
use App\Libraries\Trade;
use Validator;
use Session;

class TradeController extends Controller {
 
    public function __construct(Request $request)
	{
		//echo 'request='.$request; 
		//exit;
		
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

        $this->avalaible_coin = Trade::getAvailableCoins();
        
        
        $this->coins_support = ['btc'=>'BTC', 'eth'=>'ETH', 'inr'=>'INR', 'gix'=>'GIX'];

		if($this->user_id){
			$this->user_data = User::getSingleRowData(array('table'=>'users','where'=>array('id'=>$this->user_id), 'select'=>array('first_name')));		
		}
        

    }
    public function index($coin)
	{

        $s = User::checkKYC(['user_id'=>$this->user_id]);
        
        if(!$s)
            return redirect('/profile');
        $f = 1;
        if($coin!='')
        {
            
            $c = explode('-', $coin);
            if(isset($c[1]))
            {
                if((in_array($c[1], $this->avalaible_coin) && in_array($c[0], $this->avalaible_coin)) && $c[0]!=$c[1])
                {

                    $this->pair_list = Trade::getPairCoinCoins();
                    
                    
                    foreach($this->pair_list[$c[0]] as $pair)
                    {
                        if($pair->pair_coin==$c[1])
                        {
                            $buy_commission = $pair->buy_commission;
                            $sell_commission = $pair->sell_commission;
                            /* 6th June 2018 start */
							$from_coin_decimals = $pair->from_coin_decimals;
							$to_coin_decimals = $pair->to_coin_decimals;
							/* 6th June 2018 end */
							break;
                        }
                    }
                    
                    $this->active_coin_pair[$coin] = 1;

                    if(env('MODE')=='TEST')
                    {
                        $node_server_point = env('node_server_point').':'.env('node_curl_port');
                    }
                    else{
                        $node_server_point = env('node_server_point');
                    }

                    $data=[
                        'from_currency' => $c[0],
                        'to_currency' => $c[1],
                        'active_coin_pair' =>$this->active_coin_pair,
                        'can_trade'=>$s,
                        'coins_support'=>$this->coins_support,
                        'pair_list'=>$this->pair_list,
                        'buy_commission'=>$buy_commission,
                        'sell_commission'=>$sell_commission,
						'user_data'=>$this->user_data,
                        'parent_coin'=>$c[0],
                        'node_server_point'=>$node_server_point,
						'from_coin_decimals'=>$from_coin_decimals,
						'to_coin_decimals'=>$to_coin_decimals
                    ];
                    return view('xchange/trade', $data);
                }
                else
                    $f = 0;
            }
            else
                $f = 0;
        }
        else
            $f = 0;
        
        if($f==0)
        {
            echo 'Invalid parameters';
            die;
        }
    }

    
}