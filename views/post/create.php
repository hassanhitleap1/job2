<?php

use yii\helpers\Html;
use app\widgets\Alert;
/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = Yii::t('app', 'Create_Post');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  $content= Html::a(Yii:t('Must_Be_Login'), ['site/login']); ?> 

    <?=  Must_Be_Login::widget([
            'options' => [
                'class' => 'alert-info',
            ],
            'body' => $content,
        ]);
    
  

</div>
