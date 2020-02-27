<?php

use yii\helpers\Html;

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
                                            <div class="col-6 col-12-xsmall">
                                                <input type="date" name="phone" id="phone"  placeholder="<?= Yii::t('app','Phone')?>" />

											</div>

                                            <div class="col-6 col-12-xsmall">


                                            </div>
											<div class="col-6 col-12-xsmall">


											</div>

											<!-- Break -->
											<div class="col-12">
												<ul class="actions">
                                                        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'primary']) ?>
												</ul>
											</div>
										</div>
                                      <form/>
							</div>
						</div>
					</div>
				</div>
			</section>

