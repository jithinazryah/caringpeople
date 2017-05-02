<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StaffLeave */

$this->title = 'Leave Application';
$this->params['breadcrumbs'][] = ['label' => 'Staff Leaves', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                        </div>
                        <div class="panel-body">
                                <div class="panel-body"><div class="staff-leave-create">
						<?php if (Yii::$app->session->hasFlash('error')): ?>

							<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert">
									<span aria-hidden="true">&times;</span>
									<span class="sr-only">Close</span>
								</button>
								<?= Yii::$app->session->getFlash('error') ?>
							</div>
						<?php endif; ?>
						<?php if (Yii::$app->session->hasFlash('success')): ?>
							<div class="alert alert-success">

								<button type="button" class="close" data-dismiss="alert">
									<span aria-hidden="true">&times;</span>
									<span class="sr-only">Close</span>
								</button>

								<?= Yii::$app->session->getFlash('success') ?>


							</div>
						<?php endif; ?>
						<?=
						$this->render('_form', [
						    'model' => $model,
						])
						?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>

