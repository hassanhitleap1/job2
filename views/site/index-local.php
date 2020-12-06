<?php

/* @var $this yii\web\View */

use yii\bootstrap\Modal;

use yii\widgets\LinkPager;

use Carbon\Carbon;

$now = Carbon::now("Asia/Amman");
$this->title = 'home';

?>


<div class="container">

	<div class="row">
		<div class="col-md-10">
			<div class="lead">
				<div class="form-group has-feedback has-search">
					<span class="glyphicon glyphicon-search form-control-feedback"></span>
					<input type="text" id="search" class="form-control" name="search" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?> " placeholder="بحث">
				</div>
			</div>
		</div>
		<div class="col-md-2">
			<button class="btn btn-success" id="serach-post">بحث</button>
		</div>

	</div>


	<div class="row">
		<?php foreach ($models as  $key => $model) : ?>
			<a href="/index.php?r=post/view&id=<?= $model->id ?>">
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading"><?= $model->title ?></div>
						<div class="panel-body" style=" word-wrap: break-word;">
							<?php

							$string = strip_tags($model->body);
							$yourText = $model->body;
							if (strlen($string) > 350) {
								$stringCut = substr($model->body, 0, 70);
								$doc = new DOMDocument();
								$doc->loadHTML($stringCut);
								$yourText = $doc->saveHTML();
							}


							print $yourText;


							?>
						</div>
						<div class="panel-footer">
							<span class="float-left">
								<?php
								$date = Carbon::parse($model->created_at);
								$def = $date->diffInDays($now);
								echo  "ايام " . $def;
								?>
								<?php if (!is_null($model->country)) : ?>
									/
									<?= $model['country']['name_ar'] ?>
									/
									<?= $model['region']['name_ar'] ?>
								<?php endif; ?>
							</span>

							<div class="pull-left">
								<?php if ($model->show_number) : ?>

									<a href="tel:<?= $model['user']['phone'] ?>"><?= $model['user']['phone'] ?></a>

								<?php endif; ?>

								<button id="apply" post-id="<?= $model->id; ?>" class="btn btn-sm  <?= ($model->applayCount) ? '' : 'btn-success' ?>">
									<?= Yii::t('app', 'Apply') ?>
								</button>


							</div>


						</div>
					</div>
				</div>
			</a>

		<?php endforeach; ?>

	</div>

	<div class="row">
		<?= LinkPager::widget([
			'pagination' => $pages,
		]); ?>
	</div>
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