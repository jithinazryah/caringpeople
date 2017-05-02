<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\PatientGeneral;
use common\models\MasterServiceTypes;
use yii\helpers\ArrayHelper;
use common\models\StaffInfo;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Service */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-form form-inline">

	<?php $form = ActiveForm::begin(); ?>
        <div class="row">
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
			<?php
			$patient = PatientGeneral::find()->where(['status' => 1])->all();
			?>
			<?= $form->field($model, 'patient_id')->dropDownList(ArrayHelper::map($patient, 'id', 'first_name'), ['class' => 'form-control', 'prompt' => '--select patient--']) ?>
		</div>
		<div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
			<?php
			$sevice_type = MasterServiceTypes::find()->where(['status' => 1])->all();
			?>
			<?= $form->field($model, 'service')->dropDownList(ArrayHelper::map($sevice_type, 'id', 'service_name'), ['class' => 'form-control', 'prompt' => '--select service--']) ?>

		</div>
		<div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
			<?= $form->field($model, 'staff_type')->dropDownList(['1' => 'Registered Nurse', '2' => 'Care Assistant', '3' => 'Doctor'], ['prompt' => '--select staff type--']) ?>

		</div>
		<div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
			<?= $form->field($model, 'duty_type')->dropDownList(['1' => 'Day', '2' => 'Night', '3' => 'Day & Night'], ['prompt' => '--select duty type--']) ?>

		</div>
		<div class='col-md-4 col-sm-6 col-xs-12 left_padd' id="day_staff">
			<?php
			$staffs = StaffInfo::find()->where(['status' => 1, 'post_id' => 5])->all();
			?>
			<?= $form->field($model, 'day_staff')->dropDownList(ArrayHelper::map($staffs, 'id', 'staff_name'), ['class' => 'form-control', 'prompt' => '--select staff--']) ?>

		</div>
		<div class='col-md-4 col-sm-6 col-xs-12 left_padd' id="night_staff">
			<?php
			$staffs_ = StaffInfo::find()->where(['status' => 1, 'post_id' => 5])->all();
			?>
			<?= $form->field($model, 'night_staff')->dropDownList(ArrayHelper::map($staffs_, 'id', 'staff_name'), ['class' => 'form-control', 'prompt' => '--select staff--']) ?>

		</div>
		<div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
			<?php
			$staff_managers_ = StaffInfo::find()->where(['status' => 1, 'post_id' => 3])->all();
			?>
			<?= $form->field($model, 'staff_manager')->dropDownList(ArrayHelper::map($staffs_, 'id', 'staff_name'), ['class' => 'form-control', 'prompt' => '--select staff manager--']) ?>

		</div>

		<div class='col-md-4 col-sm-6 col-xs-12'>
			<div class="form-group field-service-from_date">
				<label class="control-label" for="service-from_date">From Date</label>
				<?php
				if (isset($model->from_date)) {
					$model->from_date = date('d-m-Y', strtotime($model->from_date));
				} else {
					$model->from_date = date('d-m-Y');
				}

				echo DatePicker::widget([
				    'name' => 'Service[from_date]',
				    'type' => DatePicker::TYPE_INPUT,
				    'value' => $model->from_date,
				    'pluginOptions' => [
					'autoclose' => true,
					'format' => 'dd-mm-yyyy',
				    ]
				]);
				?>
			</div>


		</div>

		<div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
			<div class="form-group field-service-to_date">
				<label class="control-label" for="service-to_date">To Date</label>
				<?php
				if (isset($model->to_date)) {
					$model->to_date = date('d-m-Y', strtotime($model->to_date));
				} else {
					$model->to_date = date('d-m-Y');
				}

				echo DatePicker::widget([
				    'name' => 'Service[to_date]',
				    'type' => DatePicker::TYPE_INPUT,
				    'value' => $model->to_date,
				    'pluginOptions' => [
					'autoclose' => true,
					'format' => 'dd-mm-yyyy',
				    ]
				]);
				?>
			</div>

		</div>
		<div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
			<?= $form->field($model, 'estimated_price_per_day')->textInput(['maxlength' => true]) ?>

		</div>
		<div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
			<?= $form->field($model, 'estimated_price')->textInput(['maxlength' => true]) ?>

		</div>
		<div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
			<?= $form->field($model, 'advance_payment')->textInput(['maxlength' => true]) ?>

		</div>
		<div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
			<?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

		</div>
	</div>
	<div class="row">

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
		</div>

	</div>

	<?php ActiveForm::end(); ?>

</div>
<script>
	$(document).ready(function () {
		$("#day_staff").hide();
		$("#night_staff").hide();
		$("#service-duty_type").change(function () {
			if (this.value == 1) {
				$("#day_staff").show();
			} else if (this.value == 2) {
				$("#night_staff").show();
				$("#day_staff").hide();
			} else if (this.value == 3) {
				$("#night_staff").show();
				$("#day_staff").show();
			}

		});
	});
</script>
