<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use conquer\select2\Select2Widget;
use yii\helpers\ArrayHelper;
use app\models\Nationality;
use app\models\Governorate;
use app\models\Area;
use kartik\file\FileInput;

?>


<div id="heading" >
	<h1><?= Yii::t('app', 'Create_Requast_Job') ?></h1>
</div>
            

	<!-- Main -->
    <section id="main" class="wrapper">
				<div class="inner">
					<div class="content">

					<!-- Elements -->
						<div class="row">
							<div class="col-12 col-12-medium">

								<!-- Form -->
									<h3><?= Yii::t('app', 'Create_Requast_Job') ?></h3>
                                    <?php $form = ActiveForm::begin(); ?>
										<div class="row gtr-uniform">
											<div class="col-6 col-12-xsmall">
                                                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
											</div>
											<div class="col-6 col-12-xsmall">
                                                <?= $form->field($model, 'phone')->textInput() ?>
											</div>
                                            <!-- Break -->
                                            <div class="col-6 col-12-xsmall">
                                                    <?= $form->field($model, 'agree')->textInput() ?>
											</div>
											<div class="col-6 col-12-xsmall">
                                                <?= $form->field($model, 'governorate')->widget(
                                                    Select2Widget::className(),
                                                    [
                                                        'items' => ArrayHelper::map(Governorate::find()->all(), 'id', 'name_ar')
                                                    ]
                                                ); ?>

											</div>
                                            
											<div class="col-12">
												<select name="category" id="category">
													<option value="">- Select -</option>
													<option value="alpha">Option alpha</option>
													<option value="beta">Option beta</option>
													<option value="gamma">Option gamma</option>
													<option value="delta">Option delta</option>
													<option value="epsilon">Option epsilon</option>
													<option value="zeta">Option zeta</option>
													<option value="eta">Option eta</option>
													<option value="theta">Option theta</option>
												</select>
											</div>
									
											
											<!-- Break -->
											<div class="col-12">
												<textarea name="textarea" id="textarea" placeholder="Alpha beta gamma delta" rows="6"></textarea>
											</div>
											<!-- Break -->
											<div class="col-12">
												<ul class="actions">
												<div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'primary']) ?>
                    </div>
												</ul>
											</div>
										</div>
                                        <?php ActiveForm::end(); ?>


							</div>
						</div>
					</div>
				</div>
			</section>



<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading"><?= Yii::t('app', 'Create_Requast_Job') ?></div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-md-6">

                 
                    
                  
                    <?= $form->field($model, "gender")->dropDownList([1 => "ذكر", 2 => "انثى"], ['prompt' => 'لا يهم']); ?>

               
                    <?= $form->field($model, 'area')->widget(
                        Select2Widget::className(),
                        [
                            'items' => ArrayHelper::map(Area::find()->all(), 'name_ar', 'name_ar')
                        ]
                    ); ?>
                    <?= $form->field($model, 'nationality')->widget(
                        Select2Widget::className(),
                        [
                            'items' => ArrayHelper::map(Nationality::find()->all(), 'id', 'name_ar')
                        ]
                    ); ?>
                    
                        <?= $form->field($model, 'documents')->widget(FileInput::classname(), [
                            'options' => ['accept' => 'image/*'],
                            'pluginOptions' => []
                        ]);
                        ?>
                    
                </div>
                <div class="col-md-6">

                    <?= $form->field($model, 'expected_salary')->textInput() ?>
                    <?= $form->field($model, 'certificates')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'experience')->textarea(['rows' => 6]) ?>

                    <div class="col-md-12">
                        <?= $form->field($model, 'avatar')->widget(FileInput::classname(), [
                            'options' => ['accept' => 'image/*'],
                            'pluginOptions' => []
                        ]);
                        ?>
                    </div>

                </div>
            </div>
            <div class="row">

                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

                    
                </div>


            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

</div>