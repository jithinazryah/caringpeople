<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\StaffInfo;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Services';
$this->params['breadcrumbs'][] = $this->title;
$designations = \common\models\MasterDesignations::designationlist();
?>
<div class="service-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
					<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

					<?= Html::a('<i class="fa-th-list"></i><span> Create Service</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
					<?=
					GridView::widget([
					    'dataProvider' => $dataProvider,
					    'filterModel' => $searchModel,
					    'columns' => [
						    ['class' => 'yii\grid\SerialColumn'],
						'service_id',
						    [
						    'attribute' => 'patient_id',
						    'value' => 'patient.first_name',
						    'filter' => ArrayHelper::map(common\models\PatientGeneral::find()->where(['status' => '1'])->orderBy(['first_name' => SORT_ASC])->asArray()->all(), 'id', 'first_name'),
						    'filterOptions' => array('id' => "patient_name_search"),
						],
						    [
						    'attribute' => 'service',
						    'value' => 'service0.service_name',
						    'filter' => ArrayHelper::map(common\models\MasterServiceTypes::find()->where(['status' => '1'])->orderBy(['service_name' => SORT_ASC])->asArray()->all(), 'id', 'service_name'),
						],
						    [
						    'attribute' => 'duty_type',
						    'value' => function($model) {
							    if ($model->duty_type == '1') {
								    return 'Day';
							    } else if ($model->duty_type == '2') {
								    return 'Night';
							    } else if ($model->duty_type == '3') {
								    return 'Day & Night';
							    }
						    },
						    'filter' => [1 => 'Day', 2 => 'Night', 3 => 'Day & Night'],
						],
						    [
						    'attribute' => 'day_staff',
						    'header' => 'Staff',
						    'value' => function($model) {
							    if ($model->duty_type == 1) {
								    $staff = StaffInfo::findOne($model->day_staff);
								    return $staff->staff_name;
							    } elseif ($model->duty_type == 2) {
								    $staff = StaffInfo::findOne($model->night_staff);
								    return $staff->staff_name;
							    } elseif ($model->duty_type == 3) {
								    $staff = StaffInfo::findOne($model->day_staff);
								    $staff1 = StaffInfo::findOne($model->night_staff);
								    return 'D-' . $staff->staff_name . ', N-' . $staff1->staff_name;
							    }
						    },
						    'filter' => ArrayHelper::map(common\models\StaffInfo::find()->where(['status' => '1'])->asArray()->all(), 'id', 'staff_name'),
						    'filterOptions' => array('id' => "staff_name_search"),
						],
						    [
						    'attribute' => 'staff_type',
						    'value' => function($model) {
							    $designation = \common\models\MasterDesignations::findOne(['id' => $model->staff_type]);
//
							    return $designation->title;
						    },
						    'filter' => ArrayHelper::map($designations, 'id', 'title'),
						],
						    [
						    'attribute' => 'branch_id',
						    'value' => 'branch.branch_name',
						    'filter' => ArrayHelper::map(common\models\Branch::find()->where(['status' => '1'])->asArray()->all(), 'id', 'branch_name'),
						],
						    [
						    'attribute' => 'status',
						    'value' => function($model, $key, $index, $column) {
							    return $model->status == 0 ? 'Closed' : 'Opened';
						    },
						    'filter' => [1 => 'Opened', 0 => 'Closed'],
						],
						//'staff_id',
						// 'staff_manager',
						// 'from_date',
						// 'to_date',
						// 'estimated_price_per_day',
						// 'estimated_price',
						// 'status',
						// 'CB',
						// 'UB',
						// 'DOC',
						// 'DOU',
						['class' => 'yii\grid\ActionColumn'],
					    ],
					]);
					?>
                                </div>
                        </div>
                </div>
        </div>
</div>
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>/js/select2/select2.css">
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>/js/select2/select2-bootstrap.css">
<script src="<?= Yii::$app->homeUrl; ?>/js/select2/select2.min.js"></script>
<script>
	$(document).ready(function () {
		$('#staff_name_search select').attr('id', 'staff_name');
		$('#patient_name_search select').attr('id', 'patient_name');
		$("#staff_name").select2({
			placeholder: '',
			allowClear: true
		}).on('select2-open', function ()
		{
			// Adding Custom Scrollbar
			$(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
		});
		$("#patient_name").select2({
			placeholder: '',
			allowClear: true
		}).on('select2-open', function ()
		{
			// Adding Custom Scrollbar
			$(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
		});
	});
</script>


