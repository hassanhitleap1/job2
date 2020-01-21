<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('app','About');
$this->params['breadcrumbs'][] = $this->title;
?>


		<!-- Heading -->
        <div id="heading" >
				<h1><?= Html::encode($this->title) ?></h1>
			</div>

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="inner">
					<div class="content">
						<header>
							<h2><?= Html::encode($this->title) ?></h2>
						</header>
                        <p>
                            <?= $page->text ?>
                        </p>
                    </div>
				</div>
			</section>