<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Service */

$this->title = $model->patient->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">
				<?= Html::a('<i class="fa-th-list"></i><span> Manage Service</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="service-view">
                                                <p>
							<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
							<?=
							Html::a('Delete', ['delete', 'id' => $model->id], [
							    'class' => 'btn btn-danger',
							    'data' => [
								'confirm' => 'Are you sure you want to delete this item?',
								'method' => 'post',
							    ],
							])
							?>
                                                </p>

						<?=
						DetailView::widget([
						    'model' => $model,
						    'attributes' => [
							//'id',
							    [
							    'attribute' => 'patient_id',
							    'value' => $model->patient->first_name,
							],
							    [
							    'attribute' => 'service',
							    'value' => $model->service0->service_name,
							],
							    [
							    'attribute' => 'staff_type',
							    'value' => function($model) {
								    if ($model->staff_type == 1)
									    return "Registered Nurse";
								    elseif ($model->staff_type == 2)
									    return "Care Assistant";
								    elseif ($model->staff_type == 3)
									    return "Doctor";
								    else
									    return "";
							    },
							],
							    [
							    'attribute' => 'staff_id',
							    'value' => $model->staff->staff_name,
							],
							'staff_manager',
							'from_date',
							'to_date',
							'estimated_price_per_day',
							'estimated_price',
							'advance_payment',
							    [
							    'attribute' => 'status',
							    'value' => function($model) {
								    if ($model->status == 1)
									    return "Enabled";
								    elseif ($model->status == 0)
									    return "Disabled";
								    else
									    return "";
							    },
							],
						    ],
						])
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


