<?php

namespace app\modules\api\controllers;

use yii\web\Controller;

/**
 * Default controller for the `api` module
 */
class BaseController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return [];
    }
}
