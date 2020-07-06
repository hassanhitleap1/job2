<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;

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
				<img src="https://jctechs.co.uk/images/resume.jpg" alt="Los Angeles">
				<div class="carousel-caption">
					<?= Html::a("<h2>" . Yii::t('app', 'Requast_Job') . "</h2>", ['/requat-job/index'], ['class' => 'text-requst']) ?>
				</div>
			</div>

			<div class="item">
				<img src="https://www.saintpats.org/school/wp-content/uploads/2017/08/slider-test-teacher.jpg" alt="Chicago">
				<div class="carousel-caption">
					<?= Html::a("<h2>" . Yii::t('app', 'Requast_Job') . "</h2>", ['/requat-job/index'], ['class' => 'text-requst']) ?>
				</div>
			</div>

			<div class="item">
				<img src="https://p18cdn4static.sharpschool.com/UserFiles/Servers/Server_591111/Image/Homepage/Hero%20Slider/IMG_9729%20-%20Cleared%20for%20Use%20-%20cropped.jpg" alt="New York">
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

		<iframe id="existing-iframe-example"
          width="640" height="360"
		  src="https://www.youtube.com/embed/etsK0cPajCQ?autoplay=1&enablejsapi=1"
		  allow="accelerometer; autoplay; encrypted-media; 
            gyroscope; picture-in-picture"
          frameborder="0"
          style="border: solid 4px #37474F"
          ></iframe>
				
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