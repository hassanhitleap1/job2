<?php

/* @var $this yii\web\View */

use Carbon\Carbon;
use yii\helpers\Html;
$now = Carbon::now("Asia/Amman");

$this->title = $model->title;
$this->params['breadcrumbs'][] = $model->title;
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1><?= Html::encode($model->title) ?></h1>
				</div>
				<div class="panel-body content" style=" word-wrap: break-word;">
					<?= $model->body ?>
                </div>
                <div class="panel-footer">
                  <div class="row">
                    <div class="col-md-4 pull-right">
                    <?php
								$date = Carbon::parse($model->created_at);
								$def=$date->diffInDays($now);  
								echo  "ايام ". $def;
							?>
                    </div>
                    <div class="col-md-4 text-center">
                        <?=$model['category']['name_ar']?>
                    </div>
                    <div class="col-md-4 float-left">
                    <?php if($model->show_number): ?>
							<a class="pull-left" href="tel:<?=$model['user']['phone']?>"><?=$model['user']['phone']?></a>
							<?php endif;?>
                    </div>
                  </div>			
				</div>
			</div>
		</div>
	</div>
</div>