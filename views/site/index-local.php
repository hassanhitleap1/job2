<?php

/* @var $this yii\web\View */

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'home';

?>


<div class="container">
    <div class="row">
        <iframe class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="existing-iframe-example" width="50%" height="360" src="https://www.youtube.com/embed/etsK0cPajCQ?autoplay=1&enablejsapi=1" allow="accelerometer; autoplay; encrypted-media; 
            gyroscope; picture-in-picture" frameborder="0" style="border: solid 4px #37474F"></iframe>
    </div>
</div>

<div class="container">
    <div class="row">
        <?php foreach ($models as $model) : ?>
            <div class="col-md-3 col-sm-4 ">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?= Yii::t('app', 'School') . ' ' . $model->name ?>
                    </div>
                    <div class="panel-body">
                        <?= Html::img($model->path_logo, ['class' => "img-rounded img-responsive center-block"]); ?>
                    </div>
                    <div class="panel-footer">
                        <?= Html::a(Yii::t('app', 'More_Details'), ['/school/single-page', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm btn-block']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?=
        LinkPager::widget([
            'pagination' => $pages,
        ]);
    ?>
</div>

<?php

if (is_null(Yii::$app->user->identity->email) || empty(Yii::$app->user->identity->email)) {
    $script = <<< JS

$( document ).ready(function() {
    setTimeout(show_model_email, 2000);
});

function show_model_email(){
   url="index.php?r=email-validator/index";
   $('#model').load(url).modal({ show: true });
}

JS;
    $this->registerJs($script);
}


Modal::begin([
    'id' => 'model',
    'size' => 'model-lg',
]);

echo "<div id='modelContent'></div>";

Modal::end();


?>