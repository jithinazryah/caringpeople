<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EnquiryHospital */

$this->title = 'Create Hospital Information';
$this->params['breadcrumbs'][] = ['label' => 'Enquiry Hospitals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                        </div>
                        <div class="panel-body">
				<?php if (Yii::$app->session->hasFlash('error')): ?>
					<div class="alert alert-danger" role="alert">
						<?= Yii::$app->session->getFlash('error') ?>
					</div>
				<?php endif; ?>
				<?php if (Yii::$app->session->hasFlash('success')): ?>
					<div class="alert alert-success" role="alert">
						<?= Yii::$app->session->getFlash('success') ?>
					</div>
				<?php endif; ?>
				<?=
				$this->render('_enquiry_menus', [
				    'model' => $model,
				    'enquiry' => $enquiry,
				    'other_info' => $other_info,
				])
				?>

				<?=
				$this->render('_form', [
				    'model' => $model,
				])
				?>

                        </div>
                </div>
        </div>
</div>

