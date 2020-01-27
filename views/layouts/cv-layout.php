<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\CVAsset;


CVAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="favicon.png" rel=icon>
    <?php $this->registerCsrfMetaTags() ?>
    <title> <?= Yii::$app->name . " - " . Html::encode($this->title) ?> </title>
    <?php $this->head() ?>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar">
<?php $this->beginBody() ?>
    <?= $content ?>        
<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>