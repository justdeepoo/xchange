<?php

namespace App\Libraries;
use GuzzleHttp\Exception;
use App\Models\UserModel;
use App\Models\WalletModel;
use Illuminate\Support\Facades\DB;
use App\Libraries\LogEvent;
use GuzzleHttp;
use Response;

class User
{
    public function __construct(){
    
        $this->endpoint = env('api_end_point');
        $this->node_server_point = env('node_server_point');
        $this->node_curl_port = env('node_curl_port');
	}
    
    public static function confirmEmail($data)
    {

        $c = DB::table($data['table'])->where($data['where'])->select(['id', 'token']);
        
        if($c->count())
        {
            $resp = DB::table($data['table'])->where($data['where'])->update($data['data']);

            // Add log this to event log 
            $eventData = [
                'user_id' => $c->first()->id,
                'user_ip' => \Request::ip(),
                'event' => 'Confirm Email',
                'Data' =>  json_encode($data['data'])
            ];
            $addEvt = LogEvent::addEvent($eventData);
            return 1;
        }
        else
        {
            return 0;
        }

    }
    public function entryBal($data){
        
        $c = DB::table($data['table'])->where($data['where'])->select(['id', 'token']);

        $d = [
            'token'=>$c->first()->token
        ];
        $url = 'set/fiat';
        
        $resp = json_decode($this->curlPostRequest($url, $d));
        
        if($resp->statuscode=='SUCC')
        {
            // Add log this to event log 
            $eventData = [
                'user_id' => $c->first()->id,
                'user_ip' => \Request::ip(),
                'event' => 'FIAT SET',
                'Data' =>  json_encode([])
            ];
            $addEvt = LogEvent::addEvent($eventData);
        }
        else{
            // Add log this to event log 
            $eventData = [
                'user_id' => $c->first()->id,
                'user_ip' => \Request::ip(),
                'event' => 'FIAT NOT SET',
                'Data' =>  json_encode([])
            ];
            $addEvt = LogEvent::addEvent($eventData);
        }
    }
    public static function save($data, $event = 'Profile Updated')
    {

        $r = DB::table($data['table'])->where($data['where'])->select(['id'])->first();

        if(isset($data['where']['id']))
            $user_id = $data['where']['id'];
        else
            $user_id = $data['where']['user_id'];

        if($r==NULL)
        {
            $resp = DB::table($data['table'])->insert($data['data']);
        }
        else{
           $resp = DB::table($data['table'])->where($data['where'])->update($data['data']);
        }

        // Add log this to event log 
        $eventData = [
            'user_id' => $user_id,
            'user_ip' => \Request::ip(),
            'event' => $event,
            'Data' =>  json_encode($data['data'])
        ];
        $addEvt = LogEvent::addEvent($eventData);

    }
    public static function saveUserData($data)
    {
        $c = DB::table($data['table'])->where($data['where'])->select(['id']);
        if($c->count())
        {
            $data['data']['updated_at'] = date('Y-m-d H:i:s');
            $resp = DB::table($data['table'])->where($data['where'])->update($data['data']);
         }
        else{
            $data['data']['created_at'] = date('Y-m-d H:i:s');
            $data['data']['updated_at'] = date('Y-m-d H:i:s');
            $data['data']['user_id'] = $data['where']['user_id'];
            $resp = DB::table($data['table'])->where($data['where'])->insert($data['data']);
        }

        // Add log this to event log 
        $eventData = [
            'user_id' => $data['where']['user_id'],
            'user_ip' => \Request::ip(),
            'event' => 'Profile Updated',
            'Data' =>  json_encode($data['data'])
        ];
        $addEvt = LogEvent::addEvent($eventData);
    }
    public static function saveDepositRequest($data)
    {
        $data['data']['created_at'] = date('Y-m-d H:i:s');
        $resp = DB::table($data['table'])->insert($data['data']);
        
        // Add log this to event log 
        $eventData = [
            'user_id' => $data['data']['user_id'],
            'user_ip' => \Request::ip(),
            'event' => 'INR DEPOSIT REQUEST',
            'Data' =>  json_encode($data['data'])
        ];
        return $addEvt = LogEvent::addEvent($eventData);
    }

    public static function saveWithdrawRequest($data)
    {
        
        $resp = DB::table($data['table'])->insert($data['data']);
        
        // Add log this to event log 
        $eventData = [
            'user_id' => $data['data']['user_id'],
            'user_ip' => \Request::ip(),
            'event' => 'INR WITHDRAW REQUEST',
            'Data' =>  json_encode($data['data'])
        ];
        return $addEvt = LogEvent::addEvent($eventData);
    }
    
    public static function getUserBalance($data){
        
        return $d = DB::table('wallet')->where($data['where'])->select($data['select'])->first();
    }

    public static function checkKYC($data){
        
        $query = "select id from users where id=".$data['user_id']." AND kyc=1";
        $row =DB::select($query);
        if(empty($row))
        {
            return 0;
        }
        else
            return 1;
    }
    
    public static function userData($data){
        
        $user_id = $data['id'];
        
        $d = UserModel::where(['id'=>$data['id']])->select(['first_name', 'last_name', 'email', 'mobile', 'dob', 'mobile_verified', 'kyc', 'is_profile', 'is_kyc', 'is_address', 'is_bank', 'auth_code_url', 'auth_enabled', 'document_attached', 'document_number', 'document_issue_date', 'document_exp_date', 'country'])->first();
        $u = [
            'user'=>$d
        ];

        if(isset($data['is_kyc']))
        {
            $e = [
                'aadhar_no', 'pan_no','aadhar_front', 'aadhar_back','pan_img', 'is_submit'
            ];
            $u['kyc'] = SELF::userKyc($user_id, $e);
            
            // if($v==NULL)
            // {
                
            // }
            //$u['kyc'] = SELF::userKyc($user_id);
        }
        if(isset($data['is_bank']))
        {
            $u['bank_account'] = SELF::userBank($user_id);
        }
        if(isset($data['is_address']))
        {
            $u['address'] = SELF::userAddress($user_id);
        }

        return $u ; 
    }
    public static function userKyc($user_id, $s){
        return $d = DB::table('user_kyc')->where(['user_id'=>$user_id])->select($s)->first();
    }
    public static function userAddress($user_id){
        return $d = DB::table('user_address')->where(['user_id'=>$user_id])->first();
    }
    public static function userBank($user_id){
        return $d = DB::table('user_bank_accounts')->where(['user_id'=>$user_id])->select(['ifsc', 'bank', 'linked_mobile', 'account_no', 'holder_name', 'branch', 'account_type', 'is_submit'])->first();
    }

    public static function get_user_id($token)
    {
        $resp = UserModel::where(['token'=>$token])->select('id')->first();
        if(!$resp)
            return false;
        else
        {
            return $resp->id;
        }
    }
    
    private static function cal_bal_unit($coin,$amount)
    {
        $balance = (double) $amount;
        if($coin == 'eth')
            $balance = $balance/pow(10,18);
        elseif($coin == 'ltc' || $coin == 'btc' || $coin == 'bch')
            $balance = $balance/pow(10,8);
        elseif($coin == 'xrp')
           $balance = $balance/pow(10,6);
        return $balance;
    }
    private static function convert_unit($coin,$amount)
    {
        $balance = (double) $amount;
        if($coin == 'eth')
            $balance = $balance*pow(10,18);
        elseif($coin == 'ltc' || $coin == 'btc' || $coin == 'bch')
            $balance = $balance*pow(10,8);
        elseif($coin == 'xrp')
            $balance = $balance*pow(10,6);
        return (string)((int)$balance);
    }

    public static function balance($coin, $user_id)
    {
        $resp = WalletModel::where(['user_id'=>$user_id, 'coin'=>$coin])->select(['balance','locked_bal'])->first();
        
        if(!$resp)
            return ['status'=>false, 'data'=>[]];
        else
        {
            $bal = $resp->balance;
            if($coin!='inr')
            {
                $bal = User::cal_bal_unit($coin, $bal);
            }
            
            return ['status'=>true, 'data'=>['balance'=>$bal]];
        }
    }
    
    public static function lockCurrency($d)
    {
       if(isset($d['user_id']) && isset($d['locked_bal']) && isset($d['coin']))
        {
            $l_a = $d['locked_bal'];
            $c_a = $d['balance'];

            if(strtolower($d['coin'])!='inr')
            {
                $l_a = User::convert_unit($d['coin'], $d['locked_bal']);
                $c_a = User::convert_unit($d['coin'], $d['balance']);
            }
            
            $s = WalletModel::where(['user_id'=>$d['user_id'], 'coin'=>$d['coin']])->update([
                'locked_bal' => DB::raw('locked_bal + '.$l_a),
                'balance' => $c_a,
                 ]);
            
            if($s)
            {
                // Add log this to event log 
                $eventData = [
                    'user_id' => $d['user_id'],
                    'user_ip' => \Request::ip(),
                    'event' => 'LOCKED '.strtoupper($d['coin']),
                    'Data' =>  json_encode($d)
                ];
                $addEvt = LogEvent::addEvent($eventData);

                return ['status'=>true, 'data'=>[]]; 
            }
            else
                return ['status'=>false, 'message'=>'datebase issue', 'data'=>[]]; 
        }
        else{
            return ['status'=>false, 'message'=>'missing parameters', 'data'=>[]];
        }
    }

    public static function unLockCurrency($d)
    {
        
        if(isset($d['user_id']) && isset($d['locked_bal']) && isset($d['coin']) && isset($d['balance']))
        {
            
            $l_a = $d['locked_bal'];
            $c_a = $d['balance'];

            if($d['coin']!='inr')
            {
                $l_a = User::convert_unit($d['coin'], $d['locked_bal']);
                $c_a = User::convert_unit($d['coin'], $d['balance']);
            }
            $s = WalletModel::where(['user_id'=>$d['user_id'], 'coin'=>$d['coin']])->update([
                'locked_bal' => DB::raw('locked_bal - '.$l_a),
                'balance' => DB::raw('balance + '.$c_a),
                ]);
            
            if($s)
            {
                // Add log this to event log 
                $eventData = [
                    'user_id' => $d['user_id'],
                    'user_ip' => \Request::ip(),
                    'event' => 'UNLOCKED FOR CANCEL TRADE '.strtoupper($d['coin']),
                    'Data' =>  json_encode($d)
                ];
                $addEvt = LogEvent::addEvent($eventData);

                return ['status'=>true, 'data'=>[]]; 
            }
            else
                return ['status'=>false, 'message'=>'datebase issue', 'data'=>[]]; 
        }
        else{
            return ['status'=>false, 'message'=>'missing parameters', 'data'=>[]];
        }
    }

    // Deduct lockecd balance
    public static function deductLockedAmount($d)
    {
        if(isset($d['user_id']) && isset($d['locked_bal']) && isset($d['coin']))
        {
            $l_a = $d['locked_bal'];
            if($d['coin']!='inr')
            {
                $l_a = User::convert_unit($d['coin'], $d['locked_bal']);
            }

            $s = WalletModel::where(['user_id'=>$d['user_id'], 'coin'=>$d['coin']])->update([
                'locked_bal' => DB::raw('locked_bal - '.$l_a)]);

            if($s)
            {

                // Add log this to event log 
                $eventData = [
                    'user_id' => $d['user_id'],
                    'user_ip' => \Request::ip(),
                    'event' => 'UNLOCK '.strtoupper($d['coin']),
                    'Data' =>  json_encode($d)
                ];
                $addEvt = LogEvent::addEvent($eventData);

                return ['status'=>true, 'data'=>[]]; 
            }
            else
                return ['status'=>false, 'message'=>'datebase issue for deducting locked amount', 'data'=>[]]; 
        }
        else{
            return ['status'=>false, 'message'=>'missing parameters for deducting locked amount', 'data'=>[]];
        }
    }
    // Add Currency to user wallet
    public static function AddCurrencyAmount($d)
    {
        if(isset($d['user_id']) && isset($d['balance']) && isset($d['coin']))
        {
            $b_a = $d['balance'];
            if($d['coin']!='inr')
            {
                $b_a = User::convert_unit($d['coin'], $d['balance']);
            }
            
            $s = WalletModel::where(['user_id'=>$d['user_id'], 'coin'=>$d['coin']])->update([
                'balance' => DB::raw('balance + '.$b_a)]);
             
            
            if($s)
            {
                return ['status'=>true, 'data'=>[]]; 
            }
            else
            {
                //die('datebase issue for updating current balance');
                return ['status'=>false, 'message'=>'datebase issue for updating current balance - 1', 'data'=>[]]; 
            }
        }
        else{
            //die('datebase issue for updating current balance');
            return ['status'=>false, 'message'=>'missing parameters for updating current balance - 2', 'data'=>[]];
        }
    }

    // Deduct Currency to user wallet
    public static function deductCurrencyAmount($d)
    {
        if(isset($d['user_id']) && isset($d['balance']) && isset($d['coin']))
        {
            $b_a = $d['balance'];
            if(strtolower($d['coin'])!='inr')
            {
                $b_a = User::convert_unit($d['coin'], $d['balance']);
            }
            $s = WalletModel::where(['user_id'=>$d['user_id'], 'coin'=>$d['coin']])->update([
                'balance' => DB::raw('balance - '.$b_a)]);
             
            if($s)
            {
                return ['status'=>true, 'data'=>[]]; 
            }
            else
            {
                //die('datebase issue for updating current balance');
                return ['status'=>false, 'message'=>'datebase issue for updating current balance - 1', 'data'=>[]]; 
            }
        }
        else{
            //die('datebase issue for updating current balance');
            return ['status'=>false, 'message'=>'missing parameters for updating current balance - 2', 'data'=>[]];
        }
    }

    public static function userBidsNAsks($data, $trade_type)
    {
        if(isset($data['from_coin']) && isset($data['to_coin']))
        {
            
            $where = ' from_currency="'.$data['from_coin'].'" and to_currency="'.$data['to_coin'].'"'; 
            
            if($trade_type=='bid')
            {
                $t = 'bid';
                $order_k = 'bid_at';
                $order = 'desc';
            }
            else
            if($trade_type=='ask')
            {
                $t = 'ask';
                $order_k = 'ask_at';
                $order = 'asc';
            }

            if(isset($data['user_id']))
            {
                $where .= ' AND user_id="'.$data['user_id'].'"'; 
                $query= "select id, volume, rate, fee from $t where ".$where." order by $order_k desc";
            }
            else
            {
                $query= "select sum(volume) as volume, rate from $t where ".$where." group by rate order by rate $order limit 0,12";
            }
            $resp = DB::select($query);
            //$resp = DB::table($t)->where($where)->select(['id', 'volume', 'fee', 'rate'])->group_by('rate')->orderBy($order_k,'desc');
            
            if(count($resp))
            {
                return ['status'=>true, 'message'=>'', 'data'=>$resp];
            }
            else{
                return ['status'=>true, 'message'=>'', 'data'=>[]];
            }
        }
        else{
            return ['status'=>false, 'message'=>'missing parameters', 'data'=>[]];
        }
    }


    public static function getData($d)
    {
        return $resp = DB::table($d['table'])->where($d['where'])->select($d['select'])->get();
    }
    public static function getSingleRowData($d)
    {
        return $resp = DB::table($d['table'])->where($d['where'])->select($d['select'])->first();
    }

    // Curl call for post method
    public function curlPostRequest($url, $data){
		
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->endpoint.$url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));
        $response = curl_exec($curl);

        
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
            die;
        } 
        else 
        {
            return $response;
        }
    ///
    }



    // Curl call for get method
    public function curlGetRequest($url){
            
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->endpoint.$url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
            die;
        } 
        else 
        {
            return $response;
        }
    ///
    }



    public function callNodeServer($data, $url)
    {
        // echo $this->node_server_point.'/'.$url;
        // echo json_encode($data);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_PORT => $this->node_curl_port,
            CURLOPT_URL => $this->node_server_point.'/'.$url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
            ),
            ));

        $response = curl_exec($curl);

        print_r( $response);


        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
            $response;
        }
    }
    

}