<?php 
namespace app\components;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use Twilio\Rest\Client;


class SMSCompnent extends Component
{
   
    const API_KEY="";
    const API_SECRET="";
    public function welcome()
    {
      echo "Welcome to MyComponent";
    }

    public function sendsms(){

      $basic  = new \Nexmo\Client\Credentials\Basic('cf4a8d89', 'qX9SFGqhhGhf7p1e');
      $client = new \Nexmo\Client($basic);

      $message = $client->message()->send([
      'to' => '962799263494',
      'from' => 'Nexmo',
      'text' => 'Hello from Nexmo'
      ]);
    }

    public function sendsmsusingtwiz(){
      $account_sid = 'AC242fd0d0bd4691793316d207aba7bfbc';
      $auth_token = '147eb946c4fa8f6db42a31c2d34b41d8';

        $twilio_number = "+12055468423";

        $client = new Client($account_sid, $auth_token);
        // $client->messages->create(
        //     // Where to send a text message (your cell phone?)
        //     '+962799263494',
        //     array(
        //         'from' => $twilio_number,
        //         'body' => 'مرحبا!'
        //     )
        // );
    }

}    