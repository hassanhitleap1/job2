<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CVAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'resumex/css/font-awesome.min.css',
        'resumex/css/bootstrap.min.css',
        'resumex/css/style.css'
    ];
    public $js = [
        'js/main.js',
        'resumex/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js',
        'resumex/js/bootstrap.min.js',
        'resumex/js/theia-sticky-sidebar.js',
        'resumex/js/scripts.js',
        'https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js',
        'https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js'

   
        //'https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js',
    ];
    public $depends = [
         'yii\web\YiiAsset',
         'yii\bootstrap\BootstrapAsset',
         'airani\bootstrap\BootstrapRtlAsset',
    ];
}
