<?php 
namespace app\components;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;


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

}    