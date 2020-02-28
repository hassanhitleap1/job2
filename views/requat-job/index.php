<?php

use app\models\Area;
use app\models\Governorate;
use app\models\Nationality;
use yii\helpers\Html;

$nationalitys=Nationality::find()->all();
$governorates=Governorate::find()->all();
$areas=Area::find()->all();
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
                                <form>
										<div class="row gtr-uniform">
											<div class="col-4 col-12-xsmall">
                                                <input type="text" name="name" id="name"  placeholder="<?= Yii::t('app','Name')?>" />
											</div>
											<div class="col-4 col-12-xsmall">
                                                <input type="text" name="phone" id="phone"  placeholder="<?= Yii::t('app','Phone')?>" />
											</div>
                                            <div class="col-4 col-12-xsmall">
                                                <div class="row">
                                                    <div class="col-2 col-12-small">
                                                        <label ><?= Yii::t('app','Gender')?> </label>
                                                    </div>
                                                    <div class="col-5 col-12-small">
                                                        <input type="radio" id="radio-alpha" name="radio" value="1"  checked>
                                                        <label for="radio-alpha"><?= Yii::t('app','Male')?> </label>
                                                    </div>
                                                    <div class="col-5 col-12-small">
                                                        <input type="radio" id="radio-beta" name="radio" value="2">
                                                        <label for="radio-alpha"><?= Yii::t('app','FeMale')?> </label>
                                                    </div>
                                                </div>

                                            </div>

                                            <!-- Break -->
                                            <!-- <div class="col-6 col-12-xsmall">
                                                <label for="date_of_birth"><?php // Yii::t('app','Date_Of_Birth')?></label>
                                                <input type="date" name="date_of_birth" id="date_of_birth"  placeholder="<?= Yii::t('app','Date_Of_Birth')?>" />
											</div> -->

                                            <div class="col-4 col-12-xsmall">
                                                <select name="nationality" id="nationality">
                                                    <?php foreach($nationalitys as $nationality):?>
                                                        <option value="<?= $nationality->id?>"> <?= $nationality->name_ar?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>

                                            <div class="col-4 col-12-xsmall">
                                                <select name="nationality" id="nationality">
                                                    <?php foreach($governorates as $governorate):?>
                                                        <option value="<?= $governorate->id?>"> <?= $governorate->name_ar?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                            <div class="col-4 col-12-xsmall">
                                                <select name="nationality" id="nationality">
                                                    <?php foreach($areas as $area):?>
                                                        <option value="<?= $area->id?>"> <?= $area->name_ar?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                            <div class="col-6 col-12-xsmall">
                                                <textarea name="certificates" id="certificates" placeholder="<?=Yii::t('app', 'Certificates')?>"  rows="6"></textarea>
											</div>
								

											<!-- Break -->
											<div class="col-12 col-12-xsmall">
												<ul class="actions">
                                                        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'primary']) ?>
												</ul>
											</div>
										</div>
                                    </form>
							</div>
						</div>
					</div>
				</div>
			</section>

