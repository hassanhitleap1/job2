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
    <?php $content= Html::a(Yii::t('app','Must_Be_Login'), ['site/login']); ?> 
   
    
    <div class="alert alert-info">
            <strong>Info!</strong> <?php echo $content?>
    </div>
  

</div>
