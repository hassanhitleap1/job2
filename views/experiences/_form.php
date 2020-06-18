<?php

use app\models\User;
use conquer\select2\Select2Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Experiences */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="experiences-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, "user_id")->widget(
        Select2Widget::className(),
        [
            'items' => ArrayHelper::map(User::find()->where(['type' => User::NORMAL_USER])->all(), 'id', 'name')
        ]
    );
    ?>

    <?= $form->field($model, 'job_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, "date_from")->textInput(['class' => 'date_from form-control']) ?>

    <?= $form->field($model, "date_to")->textInput(['class' => 'date_from form-control']) ?>

    <?= $form->field($model, 'facility_name')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php

$js = '
    $(document).ready(function () {
mobilscrol();
});
function mobilscrol() {
        mobiscroll.settings = {
        lang: \'en\',                
        theme: \'mobiscroll\',              
        themeVariant: \'dark\',
        dateFormat: \'yy-mm-dd\',
    };
    
        $(\'.date_from\').mobiscroll().date({
            display: \'bubble\',     
            touchUi: false         
        });
        
         $(\'.date_to\').mobiscroll().date({
            display: \'bottom\',     
            touchUi: false         
        });
}
   


';

$this->registerJs($js);
?>