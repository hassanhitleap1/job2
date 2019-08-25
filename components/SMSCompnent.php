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
 
      $account_sid = 'AC242fd0d0bd4691793316d207aba7bfbc';
      $auth_token = '147eb946c4fa8f6db42a31c2d34b41d8';

      $twilio_number = "+12055468423";

        $client = new Client($account_sid, $auth_token);
      $client->messages->create(
            // Where to send a text message (your cell phone?)
            '+962799263494',
            array(
                'from' => $twilio_number,
                'body' => 'مرحبا!'
            )
        );

    
    }

    public function sendsmsusingtwiz($phones){
      if(empty($$phones)){
        return false;
      }
     
      $stringPhones=implode(",",$$phones);
      
      $account_sid = 'AC242fd0d0bd4691793316d207aba7bfbc';
      $auth_token = '147eb946c4fa8f6db42a31c2d34b41d8';

        $twilio_number = "+12055468423";

        $client = new Client($account_sid, $auth_token);
      foreach ($phones as $phone) {
         // $client->messages->create(
       
        //     $stringPhones,
        //     array(
        //         'from' => $twilio_number,
        //         'body' => 'مرحبا!'
        //     )
        // );
      }
       

        // $client->messages->create(
        //     // Where to send a text message (your cell phone?)
        //     '+962799263494',
        //     array(
        //         'from' => $twilio_number,
        //         'body' => 'مرحبا!'
        //     )
        // );
        
        return true;
    }

}    