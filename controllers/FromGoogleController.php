<?php

namespace app\controllers;

use yii\filters\VerbFilter;


/**
 * RequastJobController implements the CRUD actions for RequastJob model.
 */
class FromGoogleController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all RequastJob models.
     * @return mixed
     */
    public function actionIndex()
    {

        $client = $this->getClient();
        $service = new Google_Service_Sheets($client);

// Prints the names and majors of students in a sample spreadsheet:
// https://docs.google.com/spreadsheets/d/1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms/edit
        $spreadsheetId = '1eOHxqu0RCB-wDCkWyxkPMHKpMs338VDuxoACzy-8TJM';
        $range = 'Class Data!A2:E';
        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();

        if (empty($values)) {
            print "No data found.\n";
        } else {
            print "Name, Major:\n";
            foreach ($values as $row) {
                // Print columns A and E, which correspond to indices 0 and 4.
                printf("%s, %s\n", $row[0], $row[4]);
            }
        }

    }


    private  function getClient()
    {

        //  client_id =1094087368258-7ntmbfphdhbumo1gniqvvkjuih0ok05h.apps.googleusercontent.com
        // Client Secret=  paMU74ttKFBufsK6TEluhWfP
        $client = new \Google_Client();
        $client->setApplicationName('Google Sheets API PHP Quickstart');

        $client->setScopes(\Google_Service_Sheets::SPREADSHEETS_READONLY);


        $client->setAuthConfig('credentials.json');

        $client->setAccessType('offline');

        $client->setPrompt('select_account consent');

        $tokenPath = 'credentials.json';
        // api key :  AIzaSyCVmlPERGq4sTpXdJMD2_bp4K-nJncj6_0

        if (file_exists($tokenPath)) {

            $accessToken = json_decode(file_get_contents($tokenPath), true);

            $client->setAccessToken($accessToken);
            print_r($accessToken);
            exit;
        }

        exit;

        // If there is no previous token or it's expired.
        if ($client->isAccessTokenExpired()) {
            // Refresh the token if possible, else fetch a new one.
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                // Request authorization from the user.
                $authUrl = $client->createAuthUrl();
                printf("Open the following link in your browser:\n%s\n", $authUrl);
                print 'Enter verification code: ';
                $authCode = trim(fgets(STDIN));

                // Exchange authorization code for an access token.
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                $client->setAccessToken($accessToken);

                // Check to see if there was an error.
                if (array_key_exists('error', $accessToken)) {
                    throw new Exception(join(', ', $accessToken));
                }
            }
            // Save the token to a file.
            if (!file_exists(dirname($tokenPath))) {
                mkdir(dirname($tokenPath), 0700, true);
            }
            file_put_contents($tokenPath, json_encode($client->getAccessToken()));
        }
        return $client;
    }

}
