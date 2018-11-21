<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Traits\StatusResponse;
use App\Libraries\User;
use App\Libraries\Trade;
use App\Libraries\LogEvent;
use Validator;


class XchangeController extends Controller {

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
		
        $this->user = new User();
    }

    // Buy coin
    public function buy(Request $request)
    {

        $validator = Validator::make($request->all(), $this->buySellRules(), $this->buySellValidationMessages());
        if ($validator->fails()) {
            
            $data = $validator->getMessageBag()->toArray();
            $message = $validator->errors()->first();
            return $this->_status('RPI', NULL, $data);

        } else {
            
            $this->from_currency = strtolower(trim($request->input('from_coin')));
            $this->to_currency = strtolower(trim($request->input('to_coin')));

            $vol  = trim($request->input('vol')); 
            $rate  = trim($request->input('at')); 


            // Get pair details

            $d = Trade::getRow([
                        'where'=>['parent_coin'=>$this->from_currency, 'pair_coin'=>$this->to_currency],
                        'table'=>'ticker',
                        'select'=>['min_buy_coin', 'buy_commission'],
                        ]
                    );

            // Check requested coin exist or not
            if($d==NULL)
                return $this->_status('INV');
                    
            
            $min_buy_coin = $d->min_buy_coin;
            

            // Check mininum quantity of coin
            if($min_buy_coin > $vol)
                return $this->_status('CST', 'Minimum order of '.$this->to_currency. ' is '.$min_buy_coin);
            
            
            // Get current coin balance
            $s = User::balance($this->from_currency, $this->user_id);
            
            if($s['status'])
            {
                $buy_commission = $d->buy_commission;
                
                $total_amt = ($vol*$rate);
                
                $commission_fee = (($total_amt*$buy_commission)/100);
                // Add commission 
                $total_amt_with_commission = $total_amt+$commission_fee;
                
                $bal = $s['data']['balance'];
                
                // Check sufficient balance for bid
                if($bal >= $total_amt_with_commission)
                {
                    
                    $d = [
                        'total_amt'=>$total_amt,
                        'tradable_amt'=>($total_amt_with_commission),
                        'fee'=>$commission_fee,
                        'rate'=>$rate,
                        'buy_comm'=>$buy_commission,
                        'coin'=>$this->to_currency,
                        'volume'=>$vol,
                        'need_confirm'=>1
                    ];

                    $confirm_buy  = $request->input('confirm_buy'); 
                    if(!$confirm_buy)
                    {
                       return $this->_status('SUCC', 'Go to confirmation form user', $d);
                    }
                    else{

                        $d['balance'] = $bal;   // Add current balance into array too
                        $resp = $this->trade_buy(['type'=>'buy','data'=>$d]);
                        echo json_encode($resp);
                    }
                }
                else{
                    return $this->_status('CST', 'You don\'t have sufficient balance.');
                }
            }
            else{
                return $this->_status('CST', 'Can\'t get balance for coin '.$this->from_currency);
            }
        }
    }
    private function trade_buy($d)
    {
        $data = $d['data'];
        
        if($d['type']=='buy')
        {
            
            $bal = $data['balance']-$data['tradable_amt'];
            
            // Lock buy amount
            $s = User::lockCurrency(['coin'=>$this->from_currency, 'locked_bal'=>$data['tradable_amt'], 'balance'=>$bal, 'user_id'=>$this->user_id]);
            
            if(!$s['status'])
            {
                return $this->_status('CST', $s['message']);
            }
            else{

                //Add into log 
                $eventData = [
                    'user_id' => $this->user_id,
                    'user_ip' => \Request::ip(),
                    'event' => 'BUY '.strtoupper($this->to_currency),
                    'Data' =>  json_encode($d)
                ];
                $addEvt = LogEvent::addEvent($eventData);

                // Check ask into aks table for this bid request 
                $s = Trade::checkAsks(['rate'=>$data['rate'], 'from_coin'=>$this->from_currency, 'to_coin'=>$this->to_currency]);
                
                if($s['status'])
                {
                    $d = [
                        'from_currency'=>$this->from_currency,
                        'to_currency'=>$this->to_currency,
                        'fee'=>$data['buy_comm'],
                        //'comm_fee'=>$data['buy_comm'],
                        'rate'=>$data['rate'],
                        'volume'=>$data['volume'],
                        'user_id'=>$this->user_id
                    ];

                    if(empty($s['data'])) // If bid rate not found in ask table
                    {
                        $s = Trade::bid($d);
                        
                        $this->buyOrder(['from_currency'=>$this->to_currency, 'to_currency'=>$this->from_currency, 'trade'=>0, 'buy'=>1, 'sell'=>0]);
                        
                        if($s['status'])
                        {
                            return $this->_status('SUCC', 'Bid has been placed.');
                        }
                        else{
                            return $this->_status('CST','Some technical issue raised.');
                        }
                    }
                    else{

                        $asks = $s['data'];
                        $vol  = $data['volume'];
                        $rate = $data['rate'];
                        $fee = $data['buy_comm'];
                        
                        $remaining_vol = $vol;
                        foreach($asks as $k=>$ask)
                        {
                            $extra_profit = 0;

                            $mode = '';
                            //Important :- Condition if sell volume less or equal or greater to bid volume
                            
                            if($vol == $ask->volume){
                                $effective_vol = $vol;
                                $mode = 'delete';
                            }
                            else
                            if($vol < $ask->volume){
                                $effective_vol = $vol;
                                $mode = 'minus';
                            }
                            else
                            {
                                $mode = 'delete';
                                $effective_vol = $ask->volume;
                            }

                            $effective_rate = $ask->rate;

                            if($mode=='delete')
                                $s = Trade::deductAskVolume(['id'=>$ask->id, 'volume'=>$effective_vol, 'mode'=>'delete']);
                            else
                                $s = Trade::deductAskVolume(['id'=>$ask->id, 'volume'=>$effective_vol, 'mode'=>'minus']);


                            $extra_profit = ($rate*$effective_vol)-($effective_rate*$effective_vol); 
                            //Maintain Bidder account
                            
                            //Deduct locked amount from akser account 
                            $s = User::deductLockedAmount(['locked_bal'=>$effective_vol, 'user_id'=>$ask->user_id, 'coin'=>$this->to_currency]);
                            
                            if($s['status'])
                            {
                                $f=  $ask->fee;
                                $sell_comm = (($effective_vol*$effective_rate)*$f)/100;
                                $b = ($effective_vol*$effective_rate)-($sell_comm);
                                //Add asks currency to akser account wallet
                                $s = User::AddCurrencyAmount(['balance'=>$b, 'user_id'=>$ask->user_id, 'coin'=>$this->from_currency]);
                            }
                            
                            // End of maintain akser account 
                                
                            //  Maintain Bider account
                                $deduct_locked_amt = $effective_vol*$rate;
                                $buy_comm = (($effective_vol*$rate)*$fee)/100;
                                //Deduct locked amount from bider account 
                                $s = User::deductLockedAmount(['locked_bal'=>($deduct_locked_amt+$buy_comm), 'user_id'=>$this->user_id, 'coin'=>$this->from_currency]);
                                
                                if($s['status'])
                                {
                                    $s = User::AddCurrencyAmount(['balance'=>$effective_vol, 'user_id'=>$this->user_id, 'coin'=>$this->to_currency]);
                                }
                            // End of maintain Bider account
                            
                            $td = [
                                'buyer_id'=>$this->user_id,
                                'seller_id'=>$ask->user_id,
                                'from_currency'=>$this->from_currency,
                                'to_currency'=>$this->to_currency,
                                'trade_type'=>'BUY',
                                'buyer_rate'=>$rate,
                                'seller_rate'=>$ask->rate,
                                'volume'=>$effective_vol,
                                'buy_fee'=>$buy_comm,
                                'sell_fee'=>$sell_comm,
                                'fee_unit'=>$this->from_currency,
                                'trade_at'=>date('Y-m-d H:i:s'),
                                'extra_margin'=>$extra_profit,
                                'extra_coin'=>$this->from_currency,
                                'pair'=>$this->to_currency.'/'.$this->from_currency
                            ];
                            
                            Trade::tradeEvent($td);
							
							// Start Insert Notification Log Created: Harikesh - Dated: 11-06-2018
							$totalDeductAmts = '';
							$totalAddAmts = '';
							// BUY
							$totalDeductAmts = ($rate*$effective_vol) + $buy_comm + $extra_profit;
							$buyOrderSubCN = "Trade Successfully";
							$buyOrderMessCN = strtoupper($this->to_currency)." Trade successful. Buy order for ".$effective_vol." ".strtoupper($this->to_currency)." @ ".$rate." inr completed. A total of ".$totalDeductAmts." has been deducted from your ".strtoupper($this->from_currency)." wallet.";
							
							$tradeNotiBuy = [
							'user_id'=>$this->user_id,
							'subject'=>$buyOrderSubCN,
							'message'=>$buyOrderMessCN,
							'added_date'=>date('Y-m-d H:i:s'),
							'ip_address'=>\Request::ip()
							];
							//print_r($tradeNotiBuy);
							Trade::InsertTradeNotification($tradeNotiBuy);
						
							// SELL
							
							$totalAddAmts = ($ask->rate*$effective_vol) + $sell_comm + $extra_profit;
							$sellOrderSubCN = "Trade Successfully";
							$sellOrderMessCN = strtoupper($this->to_currency)." Trade successful. Sell order for ".$effective_vol." ".strtoupper($this->to_currency)." @ ".$rate." inr completed. A total of ".$totalAddAmts." has been credited into your ".strtoupper($this->from_currency)." wallet.";
							
							$tradeNotiSell = [
							'user_id'=>$ask->user_id,
							'subject'=>$sellOrderSubCN,
							'message'=>$sellOrderMessCN,
							'added_date'=>date('Y-m-d H:i:s'),
							'ip_address'=>\Request::ip()
							];
							//print_r($tradeNotiSell);
							
							Trade::InsertTradeNotification($tradeNotiSell);
							// END Insert Notification
							
                            // // Call Node for broadcost trade
                            $remaining_vol -= $effective_vol;
                            // Insert price into ticker
                            $pair = $this->from_currency.'/'.$this->to_currency;
                                            
                            $t = [
                                'where'=>['pair_coin'=>$this->to_currency, 'parent_coin'=>$this->from_currency],
                                'data'=>['pair_coin'=>$this->to_currency, 'rate'=>$rate, 'update_at'=>date('Y-m-d H:i:s')],
                            ];
                            Trade::updateTiker($t);

                            $vol = $remaining_vol;
                            $this->ticker();

                            $this->buyOrder(['from_currency'=>$this->to_currency, 'to_currency'=>$this->from_currency, 'trade'=>1, 'buy'=>1, 'sell'=>1]);

							
                            if($vol <= 0)
                                break;
                        }

                        if($remaining_vol > 0)
                        {
                            $d = [
                                'from_currency'=>$this->from_currency,
                                'to_currency'=>$this->to_currency,
                                'fee'=>$data['buy_comm'],
                                'rate'=>$data['rate'],
                                'volume'=>$remaining_vol,
                                'user_id'=>$this->user_id
                            ];
                            
                            $s = Trade::bid($d);

                            if($s['status'])
                            {
                                $this->buyOrder(['from_currency'=>$this->to_currency, 'to_currency'=>$this->from_currency, 'trade'=>0, 'buy'=>1, 'sell'=>0]);
                                return $this->_status('SUCC', 'Bid has been placed.');
                            }
                            else{
                                return $this->_status('CST','Some technical issue raised.');
                            }
                        }
						
						if($remaining_vol<= 0)
						{
							Trade::checkZeroVolumeRemove(); // Sell
							Trade::checkZeroVolumeRemoveBuy(); // Buy
						}

                        return $this->_status('SUCC', 'Bid has been placed.');
                    }
                }
                else{
                    return $this->_status('CST', $s['message']);
                }
            }   
        }
    }
    
    //sell coin
    public function sell(Request $request)
    {
        $validator = Validator::make($request->all(), $this->buySellRules(), $this->buySellValidationMessages());
        
        if ($validator->fails()) {
            
            $data = $validator->getMessageBag()->toArray();
            $message = $validator->errors()->first();
            return $this->_status('RPI', NULL, $data);

        } else {
            
            $this->from_currency = strtolower(trim($request->input('from_coin')));
            $this->to_currency = strtolower(trim($request->input('to_coin')));

            //$coin = strtolower(trim($request->input('coin'))); 
            $vol  = trim($request->input('vol')); 
            $rate  = trim($request->input('at')); 

            // Get pair details

            $d = Trade::getRow([
                'where'=>['parent_coin'=>$this->to_currency, 'pair_coin'=>$this->from_currency],
                'table'=>'ticker',
                'select'=>['min_sell_coin', 'sell_commission'],
                ]
            );

            // Check requested coin exist or not
            if($d==NULL)
                return $this->_status('INV');
            
    
            $min_sell_coin = $d->min_sell_coin;


            
            // Check minimum quantity of coin
            if($min_sell_coin > $vol)
                return $this->_status('CST', 'Minimum sell of '.$this->from_currency. ' is '.$min_sell_coin);
            
            
            // Get current coin balance
            $s = User::balance($this->from_currency, $this->user_id);
            
            if($s['status'])
            {
                $sell_commission = $d->sell_commission;

                $total_amt = ($vol*$rate);
                
                $commission_fee = (($total_amt*$sell_commission)/100);
                
				// Add commission // changes by harikesh dated: 22/05/2018
                $total_amt_with_commission = $total_amt+$commission_fee;
				
                $bal = $s['data']['balance'];
                
                // Check sufficient balance for bid
                if($bal >= $vol)
                {
                    $d = [
                        'total_amt'=>$total_amt,
                        'tradable_amt'=>($total_amt_with_commission),
                        'fee'=>$commission_fee,
                        'rate'=>$rate,
                        'sell_comm'=>$sell_commission,
                        'coin'=>$this->from_currency,
                        'volume'=>$vol,
                        'need_confirm'=>1
                    ];

                    $confirm_sell  = $request->input('confirm_sell'); 
                    if(!$confirm_sell)
                    {
                       return $this->_status('SUCC', 'Go to confirmation form user', $d);
                    }
                    else{
                        
                        $d['balance'] = $bal;   // Add current balance into array too
                        $resp = $this->trade_sell(['type'=>'sell','data'=>$d]);
                        echo json_encode($resp);
                    }
                }
                else{
                    return $this->_status('CST', 'You don\'t have sufficient balance.');
                }
            }
            else{
                return $this->_status('CST', 'Can\'t get balance for coin '.$this->from_currency);
            }
        }
    }
    private function trade_sell($d)
    {
        $data = $d['data'];
        if($d['type']=='sell')
        {
           
            // Check ask into aks table for this bid request 
            $s = Trade::checkBids(['rate'=>$data['rate'], 'from_coin'=>$this->from_currency, 'to_coin'=>$this->to_currency]);
            
            

            if($s['status'])
            {
                $bal = $data['balance']-$data['volume'];
                // Lock buy amount
                $da = User::lockCurrency(['coin'=>$this->from_currency, 'locked_bal'=>$data['volume'], 'balance'=>$bal, 'user_id'=>$this->user_id]);
                if(!$da['status'])
                {
                    return $this->_status('CST', $da['message']);
                }
                
                //Add into log 
                $eventData = [
                    'user_id' => $this->user_id,
                    'user_ip' => \Request::ip(),
                    'event' => 'SELL '.strtoupper($data['coin']),
                    'Data' =>  json_encode($d)
                ];
                $addEvt = LogEvent::addEvent($eventData);
                
                $d = [
                    'from_currency'=>$this->from_currency,
                    'to_currency'=>$this->to_currency,
                    'fee'=>$data['sell_comm'],
                    'rate'=>$data['rate'],
                    'volume'=>$data['volume'],
                    'user_id'=>$this->user_id
                ];

                if(empty($s['data'])) // If ask rate not found in bid table
                {
                    
                    $s = Trade::ask($d);
                    $this->buyOrder(['from_currency'=>$this->from_currency, 'to_currency'=>$this->to_currency, 'trade'=>0, 'buy'=>0, 'sell'=>1]);

                    if($s['status'])
                    {
                        return $this->_status('SUCC', 'Ask has been placed.');
                    }
                    else{
                        return $this->_status('CST','Some technical issue raised.');
                    }
                }
                else{   // If ask rate found in bid table
                    
                    $bids = $s['data'];
                    $vol  = $data['volume'];
                    $rate = $data['rate'];
                    $fee = $data['sell_comm'];
                    $remaining_vol = $vol;
                    
                    foreach($bids as $k=>$bid)
                    {
                        $extra_profit = 0;
                        //Important :- Condition if sell volume less or equal or greater to bid volume
                        if($vol == $bid->volume){
                            //Deduct volume from bid table 
                            $effective_vol = $vol;
                            $mode = 'delete';
                        }
                        else
                        if($vol < $bid->volume){
                            //Deduct volume from bid table 
                            $effective_vol = $vol;
                            $mode = 'minus';
                        }
                        else
                        {
                            //Deduct volume from bid table 
                            $effective_vol = $bid->volume;
                            $mode = 'delete';
                        }

                        $effective_rate = $rate;

	                    if($mode=='delete')
                            $s = Trade::deductBidVolume(['id'=>$bid->id, 'volume'=>$effective_vol, 'mode'=>'delete']);
                        else
                            $s = Trade::deductBidVolume(['id'=>$bid->id, 'volume'=>$effective_vol, 'mode'=>'minus']);

                        
                            $extra_profit = ($bid->rate*$effective_vol)-($effective_rate*$effective_vol); 
                        

                        //  Maintain Bidder account
                            $deduct_locked_amt = $effective_vol*$bid->rate;

                            $bid_comm = (($effective_vol*$bid->rate)*$bid->fee)/100;

                            //Deduct locked amount from bider account 
                            $s = User::deductLockedAmount(['locked_bal'=>($bid->rate*$effective_vol)+$bid_comm, 'user_id'=>$bid->user_id, 'coin'=>$this->to_currency]);
                            
                            if($s['status'])
                            {
                                //Add asks currency to bidder account wallet
                                $s = User::AddCurrencyAmount(['balance'=>$effective_vol, 'user_id'=>$bid->user_id, 'coin'=>$this->from_currency]);
                            }
                            


                            
                        // End of maintain bidder account 
                            
                        //  Maintain Seller account
                            $deduct_locked_amt = $effective_vol;
                            //Deduct locked amount from seller account 
                            $s = User::deductLockedAmount(['locked_bal'=>$deduct_locked_amt, 'user_id'=>$this->user_id, 'coin'=>$this->from_currency]);
                            
                            if($s['status'])
                            {

                                $sell_commission = $fee;

                                $balance = ($effective_vol*$rate);
    
                                $commission_fee = (($balance*$sell_commission)/100);
            
                                //Add asks currency to seller account wallet
                                $s = User::AddCurrencyAmount(['balance'=>($balance-$commission_fee), 'user_id'=>$this->user_id, 'coin'=>$this->to_currency]);
                            }
                        // End of maintain Seller account


                        $td = [
                            'buyer_id'=>$bid->user_id,
                            'seller_id'=>$this->user_id,
                            'from_currency'=>$this->from_currency,
                            'to_currency'=>$this->to_currency,
                            'trade_type'=>'SELL',
                            'seller_rate'=>$rate,
                            'buyer_rate'=>$bid->rate,
                            'volume'=>$effective_vol,
                            'sell_fee'=>$commission_fee,
                            'buy_fee'=>$bid_comm,
                            'trade_at'=>date('Y-m-d H:i:s'),
                            'extra_margin'=>$extra_profit,
                            'extra_coin'=>$this->to_currency,
                            'pair'=>$this->from_currency.'/'.$this->to_currency
                        ];
                        Trade::tradeEvent($td);

							// Start Insert Notification Log Created: Harikesh - Dated: 11-06-2018
							$totalDeductAmts = '';
							$totalAddAmts = '';
							// BUY
							$totalDeductAmts = ($bid->rate*$effective_vol) + $bid_comm + $extra_profit;
							$buyOrderSubCN = "Trade Successfully";
							$buyOrderMessCN = strtoupper($this->from_currency)." Trade successful. Buy order for ".$effective_vol." ".strtoupper($this->from_currency)." @ ".$bid->rate." inr completed. A total of ".$totalDeductAmts." has been deducted from your ".strtoupper($this->to_currency)." wallet.";
							
							$tradeNotiBuy = [
							'user_id'=>$bid->user_id,
							'subject'=>$buyOrderSubCN,
							'message'=>$buyOrderMessCN,
							'added_date'=>date('Y-m-d H:i:s'),
							'ip_address'=>\Request::ip()
							];
							//print_r($tradeNotiBuy);
							Trade::InsertTradeNotification($tradeNotiBuy);
						
							// SELL
							
							$totalAddAmts = ($rate*$effective_vol) + $commission_fee + $extra_profit;
							$sellOrderSubCN = "Trade Successfully";
							$sellOrderMessCN = strtoupper($this->from_currency)." Trade successful. Sell order for ".$effective_vol." ".strtoupper($this->from_currency)." @ ".$rate." inr completed. A total of ".$totalAddAmts." has been credited into your ".strtoupper($this->to_currency)." wallet.";
				
							$tradeNotiSell = [
							'user_id'=>$this->user_id,
							'subject'=>$sellOrderSubCN,
							'message'=>$sellOrderMessCN,
							'added_date'=>date('Y-m-d H:i:s'),
							'ip_address'=>\Request::ip()
							];
							//print_r($tradeNotiSell);
							
							Trade::InsertTradeNotification($tradeNotiSell);
							// END Insert Notification						
						
						
                        $remaining_vol -= $effective_vol;


                        // Insert price into ticker
                        $t = [
                            'where'=>['pair_coin'=>$this->from_currency, 'parent_coin'=>$this->to_currency],
                            'data'=>['rate'=>$rate, 'update_at'=>date('Y-m-d H:i:s')],
                        ];
                        Trade::updateTiker($t);
                        $this->ticker();


                        $this->buyOrder(['from_currency'=>$this->from_currency, 'to_currency'=>$this->to_currency, 'trade'=>1, 'buy'=>1, 'sell'=>1]);
                        
                        $vol = $remaining_vol;
                        
                        if($vol <= 0)
                            break;
                    }

                    if($remaining_vol > 0)
                    {
                        $d = [
                            'from_currency'=>$this->from_currency,
                            'to_currency'=>$this->to_currency,
                            'fee'=>$data['fee'],
                            'rate'=>$data['rate'],
                            'volume'=>$remaining_vol,
                            'user_id'=>$this->user_id
                        ];

                        $s = Trade::ask($d);

                        if($s['status'])
                        {
                            $this->buyOrder(['from_currency'=>$this->from_currency, 'to_currency'=>$this->to_currency, 'trade'=>0, 'buy'=>0, 'sell'=>1]);
                            return $this->_status('SUCC', 'Ask has been placed.');
                        }
                        else{
                            return $this->_status('CST','Some technical issue raised.');
                        }
                    }
					
					if($remaining_vol<= 0)
					{
						Trade::checkZeroVolumeRemove(); // Sell
						Trade::checkZeroVolumeRemoveBuy(); // Buy
					}
                    
                    return $this->_status('SUCC', 'Ask has been placed.');

                }
            }
            else{
                return $this->_status('CST', $s['message']);
            }
              
        }
    }

    // Get balance
    public function getCurrentBal(Request $request){
        
        $b=[];
        if(!empty($request->input('c')))
        {
            
            foreach($request->input('c') as $k=>$v)
            {
                $s = User::balance($v, $this->user_id);
                if($s['status'])
                {
                    $b[$v] = $s['data']['balance'];
                }
            }
        }
        return $this->_status('SUCC', '', $b);
    }

    // Get open orders
    public function get_open_orders(Request $request)
    {
        $from_currency =  strtolower($request->input('from_currency'));
        $to_currency =  strtolower($request->input('to_currency'));
        $trade_request = [
            'bid'=> [],
            'ask'=>[]
        ];
        
        $s = User::userBidsNAsks(['from_coin'=>$from_currency, 'to_coin'=>$to_currency, 'user_id'=>$this->user_id], 'bid');

        if($s['status'])
        {
            $trade_request['bid'] = $s['data'];
        }
        
        $s = User::userBidsNAsks(['from_coin'=>$to_currency, 'to_coin'=>$from_currency, 'user_id'=>$this->user_id], 'ask');
        if($s['status'])
        {
            $trade_request['ask'] = $s['data'];
        }

        return $this->_status('SUCC', '', $trade_request);
       
    }   

    public function cancel_trade(Request $request)
    {
        if(($request->input('row_id')==NULL || $request->input('row_id')=='') || ($request->input('trade_type')==NULL || $request->input('trade_type')==''))
            return $this->_status('CST', 'missing parameters');

        $trade_type = $request->input('trade_type');
        $row_id = $request->input('row_id');
        
        if($trade_type=='sell')
            $data['table'] = 'ask';
        else
            $data['table'] = 'bid';

        $data['where'] = ['id'=>$row_id];
        $data['select'] = ['id', 'user_id', 'volume', 'from_currency', 'to_currency', 'fee', 'rate'];
        
        // Unlocked currency 
        $d = Trade::getRow($data);
        

        if($d!=NULL){

            if($d->user_id==$this->user_id)
            {
                $user_id = $d->user_id;
                $locked_amt = $d->volume;
                if($trade_type=='sell')
                    $locked_amt = $d->volume;
                else{
                    $comm = $d->fee;
                    $locked_amt = ($d->volume*$d->rate);
                    $locked_amt = $locked_amt+(($locked_amt*$comm)/100);
                }

                $da=[
                    'user_id'=>$user_id,
                    'locked_bal'=>$locked_amt,
                    'coin'=>$d->from_currency,
                    'balance'=>$locked_amt
                ];
                
                $s = User::unLockCurrency($da);

                // Delete row from table
                if($trade_type=='sell')
                {
                    $resp = Trade::deductAskVolume(['mode'=>'delete', 'id'=>$row_id]);
                    $this->buyOrder(['from_currency'=>$d->from_currency, 'to_currency'=>$d->to_currency, 'trade'=>0, 'buy'=>0, 'sell'=>1]);
                }
                else
                {
                    $resp = Trade::deductBidVolume(['mode'=>'delete', 'id'=>$row_id]);
                    $this->buyOrder(['from_currency'=>$d->to_currency, 'to_currency'=>$d->from_currency, 'trade'=>0, 'buy'=>1, 'sell'=>0]);
                }

                //Add into log 
                $eventData = [
                    'user_id' => $this->user_id,
                    'user_ip' => \Request::ip(),
                    'event' => 'Cancelled '.$trade_type,
                    'Data' =>  json_encode($d)
                ];
                $addEvt = LogEvent::addEvent($eventData);
                return $this->_status('SUCC', 'Trade deleted successfully.');
            }
            else{
                return $this->_status('CST', 'You are not authorized to delete trade.');
            }
        }
        else{
            return $this->_status('CST', 'Not found in our record.');
        }
           
        
        
    }
    protected function buySellRules()
    {
        return [
            'to_coin' => 'required|max:3|min:3',
            'from_coin' => 'required|max:3|min:3',
            'vol' => 'required|numeric',
            'at' => 'required|numeric',
        ];
    }

    protected function buySellValidationMessages()
    {
        return [
            'to_coin.required' => 'To Coin should not be blank',
            'from_coin.required' => 'From Coin should not be blank',
            'vol.required' => 'Enter volume of coin',
            'at.required' => 'Rate should not be blank',
        ];
    }


    public function getTrades(Request $request)
    {
        $data['from_currency'] =  strtolower($request->input('from_currency'));
        $data['to_currency'] =  strtolower($request->input('to_currency'));
        
        $trades = Trade::getTrades($data);
        return $this->_status('SUCC', '', $trades);
    }

    

    public function buySaleOrder(Request $request)
    {
        $from_currency =  strtolower($request->input('from_currency'));
        $to_currency =  strtolower($request->input('to_currency'));
        $trade =  strtolower($request->input('trade'));
        $sell =  strtolower($request->input('sell'));
        $buy =  strtolower($request->input('buy'));

        $data = [
            'from_currency'=>$from_currency,
            'to_currency'=>$to_currency,
            'trade'=>$trade,
            'sell'=>$sell,
            'buy'=>$buy
        ];
        $this->user->callNodeServer($data, 'all');
    }

    public function buyOrder($data)
    {
        $from_currency =  $data['from_currency'];
        $to_currency =  $data['to_currency'];
        $trade =  $data['trade'];
        $sell =  $data['sell'];
        $buy =  $data['buy'];

        $data = [
            'from_currency'=>$from_currency,
            'to_currency'=>$to_currency,
            'trade'=>$trade,
            'sell'=>$sell,
            'buy'=>$buy
        ];
        $this->user->callNodeServer($data, 'all');
    }

    public function ticker()
    {		
        $data = [];
		$this->user->callNodeServer($data, 'ticker');
    }

  public function mytrades(Request $request)
    {		
		$data['from_currency'] =  strtolower($request->input('from_currency'));
        $data['to_currency'] =  strtolower($request->input('to_currency'));
        $data['user_id'] = $this->user_id;
		$user_id = $this->user_id;
		
		$trades = Trade::getTrades($data);
        
		if(sizeof($trades)>0)
		{
			foreach($trades as $k=>$v){
				$volume = $v->volume;
				if($v->seller_id==$user_id){
					$type = 'Sell';
					$rate = $v->seller_rate;
					$fee = $v->sell_fee;
					
				}else if($v->buyer_id==$user_id){
					$type = 'Buy';
					$rate =	$v->buyer_rate;
					$fee = $v->buy_fee;												
				}
				if(empty($fee)){
					$fee = 0;	
				}
				
				$price = $volume * $rate;
				
				if($v->seller_id==$user_id){
					//$total_price = $price - $fee;
				}else if($v->buyer_id==$user_id){
					//$total_price = $price + $fee;
				}
				$total_price = $price;
				
				$v->unit_price = $rate;
				$v->total_price = $total_price;
				$v->type = strtoupper($type);
				
				$v->seller_id = ''; // no need to send seller_id and buyer_id to the js file.
				$v->buyer_id = '';	// no need to send seller_id and buyer_id to the js file.
				
			}
		}		
		return $this->_status('SUCC', '', $trades);
    }	
	
    public function transactoin_history()
    {
        $transactions = Trade::transactoin_history($this->user_id);
        return $this->_status('SUCC', '', $transactions);
    }


    


}