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
 * <script src="assets/js/jquery.min.js"></script>
 *	<script src="assets/js/browser.min.js"></script>
 *  <script src="assets/js/breakpoints.min.js"></script>
 *	<script src="assets/js/util.js"></script>
 * <script src="assets/js/main.js"></script>
 */
class ThemeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'theme/assets/css/main.css',
    ];
    public $js = [
        'js/main.js',
        // 'theme/assets/js/jquery.min.js',
        // 'theme/assets/js/browser.min.js',
        'theme/assets/js/breakpoints.min.js',
        'theme/assets/js/util.js',
        'theme/assets/js/main.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'airani\bootstrap\BootstrapRtlAsset',
    ];
}
