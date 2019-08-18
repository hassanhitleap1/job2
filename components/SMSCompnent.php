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
       $client = new Nexmo\Client(new Nexmo\Client\Credentials\Basic(self::API_KEY, self::  API_SECRET));
        $client = new Nexmo\Client(
          new Nexmo\Client\Credentials\Basic(self::API_KEY, self:: API_SECRET),
          [
            'base_api_url' => 'https://example.com'
          ]
        );

    try {
      $message = $client->message()->send([
        'to' => TO_NUMBER,
        'from' => 'Acme Inc',
        'text' => 'A text message sent using the Nexmo SMS API'
      ]);
      $response = $message->getResponseData();

      if ($response['messages'][0]['status'] == 0) {
        echo "The message was sent successfully\n";
      } else {
        echo "The message failed with status: " . $response['messages'][0]['status'] . "\n";
      }
    } catch (Exception $e) {
      echo "The message was not sent. Error: " . $e->getMessage() . "\n";
    }

        
 

    }

}    