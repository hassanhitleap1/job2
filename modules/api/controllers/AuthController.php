<?php

namespace app\modules\api\controllers;

use app\modules\api\models\LoginFormRest;
use Yii;
use sizeg\jwt\Jwt;
use sizeg\jwt\JwtHttpBearerAuth;

class AuthController extends \yii\rest\Controller
{

      /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
            'optional' => [
                'login',
            ],
        ];

        return $behaviors;
    }



    public function actionLogin()
    {

        $model= new LoginFormRest();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            return $model;
        } else {
            return $model->validate();
        }
        /** @var Jwt $jwt */
        $jwt = Yii::$app->jwt;
        $signer = $jwt->getSigner('HS256');
        $key = $jwt->getKey();
        $time = time();

        // Previous implementation
        /*
        $token = $jwt->getBuilder()
            ->setIssuer('http://example.com')// Configures the issuer (iss claim)
            ->setAudience('http://example.org')// Configures the audience (aud claim)
            ->setId('4f1g23a12aa', true)// Configures the id (jti claim), replicating as a header item
            ->setIssuedAt(time())// Configures the time that the token was issue (iat claim)
            ->setExpiration(time() + 3600)// Configures the expiration time of the token (exp claim)
            ->set('uid', 100)// Configures a new claim, called "uid"
            ->sign($signer, $jwt->key)// creates a signature using [[Jwt::$key]]
            ->getToken(); // Retrieves the generated token
        */

        // Adoption for lcobucci/jwt ^4.0 version
        $token = $jwt->getBuilder()
            ->issuedBy('http://localhost:8080')// Configures the issuer (iss claim)
            ->permittedFor('http://localhost:8080')// Configures the audience (aud claim)
            ->identifiedBy('4f1g23a12aa', true)// Configures the id (jti claim), replicating as a header item
            ->issuedAt($time)// Configures the time that the token was issue (iat claim)
            ->expiresAt($time + 3600)// Configures the expiration time of the token (exp claim)
            ->withClaim('uid', 100)// Configures a new claim, called "uid"
            ->getToken($signer, $key); // Retrieves the generated token

        return $this->asJson([
            'token' => (string)$token,
        ]);
    }

    /**
     * @return \yii\web\Response
     */
    public function actionData()
    {
        return $this->asJson([
            'success' => true,
        ]);
    }


}