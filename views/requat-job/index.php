<?php

use app\models\Area;
use app\models\Governorate;
use app\models\Nationality;
use conquer\select2\Select2Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


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
                                    <?php if(Yii::$app->session->has('message')): ?>
                                        <h1><?php echo Yii::$app->session->get('message');?></h1>
                                        <?php Yii::$app->session->remove('message');?>
                                        <?php else:?>
                                    
                                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
										<div class="row gtr-uniform">
											<div class="col-4 col-12-xsmall">
                                                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
											</div>
											<div class="col-4 col-12-xsmall">
                                                <?= $form->field($model, 'phone')->textInput() ?>
                                            </div>
                                          
                                            <div class="col-4 col-12-xsmall">
                                                <div class="row">
                                                    <div class="col-2 col-12-small">
                                                        <label ><?= Yii::t('app','Gender')?> </label>
                                                    </div>

                                                    <div class="col-4 col-12-small">
                                                        <input type="radio" id="radio-alpha" name="radio" value="1"  checked>
                                                        <label for="radio-alpha"> <?= Yii::t('app','Male')?> </label>
                                                    </div>
                                                    <div class="col-4 col-12-small">
                                                        <input type="radio" id="radio-beta"   value="2" name="radio">
                                                        <label for="radio-beta"><?= Yii::t('app','FeMale')?></label>
                                                    </div>
                                                </div>

                                            </div>

                                            <!-- Break -->
                                            <div class="col-3 col-12-xsmall">
                                                 <?= $form->field($model, 'agree')->textInput() ?>
											</div>

                                            <div class="col-3 col-12-xsmall">
                                                 <?=  $form->field($model, 'nationality')
                                                            ->dropdownList(ArrayHelper::map(Nationality::find()->where(['!=', 'id', 1])->all(), 'id', 'name_ar'),['class'=>'']); ?>
                                         
                                            </div>

                                            <div class="col-3 col-12-xsmall">
                                                 <?=  $form->field($model, 'governorate')
                                                            ->dropdownList(ArrayHelper::map(Governorate::find()->all(), 'id', 'name_ar'),['class'=>'']); ?>
                                         
                                            </div>
                                            <div class="col-3 col-12-xsmall">
                                                 <?=  $form->field($model, 'area')
                                                            ->dropdownList(ArrayHelper::map(Area::find()->where(['!=', 'id', 1])->all(), 'id', 'name_ar'),['class'=>'']); ?>
                                         
                                            </div>
                                        
                                            <div class="col-6 col-12-xsmall">
                                                    <?= $form->field($model, 'certificates')->textarea(['rows' => 6,'class'=>'']) ?>
                                            </div>
                                            <div class="col-6 col-12-xsmall">
                                                    <?= $form->field($model, 'experience')->textarea(['rows' => 6,'class'=>'']) ?>
											</div>
                                            <div class="col-6 col-12-xsmall">
                                                <?= $form->field($model, 'cv')->fileInput() ?>
                                            </div>
                                            <div class="col-6 col-12-xsmall">
                                                <?= $form->field($model, 'avatar')->fileInput() ?>
                                            </div>

											<!-- Break -->
											<div class="col-12 col-12-xsmall">
												<ul class="actions">
                                                        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'primary']) ?>
												</ul>
											</div>
										</div>
                                    <?php ActiveForm::end(); ?>
							</div>
						</div>
					</div>
				</div>
			</section>


            <?php endif;?>