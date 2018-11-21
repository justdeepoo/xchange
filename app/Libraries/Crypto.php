<?php


namespace App\Libraries;
use Illuminate\Http\Request;

class Crypto{
	
	public function __construct(){
		
		$this->token = '';	
		$this->endpoint = 'http://34.210.70.255/';
		
		$this->mode = 'test';

	}
	
	public function getCryptoAddress($data)
    {
    	$data['mode'] = $this->mode;
    	$url = $this->endpoint.'api/user/wallet/info';
    	return $this->curlPostRequest($url, $data);
    }
	public function requestWithdraw($data)
    {
    	$data['mode'] = $this->mode;
    	$url = $this->endpoint.'api/wallet/send/tx';
    	return $this->curlPostRequest($url, $data);
    }
    public function getCryptosBalance($data)
    {
    	$url = $this->endpoint.'api/user/wallet/balance';
    	$data['mode'] = $this->mode;
    	return $this->curlPostRequest($url, $data);
    }
    // Curl call for post method
    private function curlPostRequest($url, $data){
		
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => $url,
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
}