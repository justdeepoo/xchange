<?php

namespace App\Libraries;
use GuzzleHttp\Exception;
use GuzzleHttp;
use App\Models\ServiceAlert;
use Aws\Sns\SnsClient;
use Response;

class Notification
{

    

    public static function sendOtpSMS($message, $number) {

        $client = new SnsClient([
            'version'     => 'latest',
            'region'      => 'us-west-2',
            'credentials' => [
                'key'    => env('SES_KEY'),
                'secret' => env('SES_SECRET')
            ],
        ]);
        $options = array(
            'MessageAttributes' => array(
                'AWS.SNS.SMS.SenderID' => array(
                    'DataType' => 'String',
                    'StringValue' =>  'LALA2018'
                ),
                'AWS.SNS.SMS.SMSType' => array(
                    'DataType' => 'String',
                    'StringValue' =>  'Transactional' // Transactional/Promotional
                )
            ),
            'Message' => $message,
            'PhoneNumber' => $number
        );

        $result = $client->publish($options);


        print_r($result);
        exit;


        if ($result)
        {
            return true;
        }else
        {
            return false;
        }
    }

   
    

}