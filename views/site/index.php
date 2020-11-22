<?php

/* @var $this yii\web\View */

use Carbon\Carbon;
use yii\helpers\Html;
use yii\widgets\LinkPager;
$now = Carbon::now("Asia/Amman");
$this->title = 'home';
?>
<div class="container" style="margin-top: 10px;">

	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner">
			<div class="item active">
			<?= Html::img('images/1.jpg',['class'=>"center"]);?>
				<div class="carousel-caption">
					<?= Html::a("<h2>" . Yii::t('app', 'Requast_Job') . "</h2>", ['/requat-job/index'], ['class' => 'text-requst']) ?>
				</div>
			</div>

			<div class="item">
				<?= Html::img('images/2.jpg',['class'=>"center"]);?>

				<div class="carousel-caption">
					<?= Html::a("<h2>" . Yii::t('app', 'Requast_Job') . "</h2>", ['/requat-job/index'], ['class' => 'text-requst']) ?>
				</div>
			</div>

			<div class="item">
			<?= Html::img('images/3.jpg',['class'=>"center"]);?>
				<div class="carousel-caption">
					<?= Html::a("<h2>" . Yii::t('app', 'Requast_Job') . "</h2>", ['/requat-job/index'], ['class' => 'text-requst']) ?>
				</div>
			</div>
		</div>

		<!-- Left and right controls -->
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>
<div class="container">

	<div class="row">
		<?php foreach($models as  $key=>$model) :?>
			<a  href="/index.php?r=post/view&id=<?=$model->id?>">
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading"><?=$model->title?></div>
						<div class="panel-body" style=" word-wrap: break-word;">
							<?php

								$string = strip_tags($model->body);
								$yourText = $model->body;
								if (strlen($string) > 350) {
									$stringCut = substr( $model->body, 0, 70);
									$doc = new DOMDocument();
									$doc->loadHTML($stringCut);
									$yourText = $doc->saveHTML();
								}

							
							print $yourText ;
							
							
							?>
						</div>
						<div class="panel-footer">
							<span class="float-left">
							<?php
								$date = Carbon::parse($model->created_at);
								$def=$date->diffInDays($now);  
								echo  "ايام ". $def;
							?>
							</span>
							<?php if($model->show_number): ?>
							<a class="pull-left" href="tel:<?=$model['user']['phone']?>"><?=$model['user']['phone']?></a>
							<?php endif;?>
							
						</div>
					</div>
				</div>
			</a>
		
		<?php endforeach;?>

	</div>


	<div class="row">
		<?= LinkPager::widget([
			'pagination' => $pages,
		]);?>
	</div>
</div>

