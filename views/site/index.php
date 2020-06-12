<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

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
			</div>

			<div class="item">
				<img src="https://www.saintpats.org/school/wp-content/uploads/2017/08/slider-test-teacher.jpg" alt="Chicago">
			</div>

			<div class="item">
				<img src="https://p18cdn4static.sharpschool.com/UserFiles/Servers/Server_591111/Image/Homepage/Hero%20Slider/IMG_9729%20-%20Cleared%20for%20Use%20-%20cropped.jpg" alt="New York">
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