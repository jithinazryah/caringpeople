<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\MasterLeaveType;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\StaffLeave */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-leave-form form-inline">

	<?php $form = ActiveForm::begin(); ?>
	<div class="row">

		<div class='col-md-3 col-sm-6 col-xs-12 '>
			<?= $form->field($model, 'no_of_days')->textInput() ?>

		</div>
		<div class='col-md-3 col-sm-6 col-xs-12 '>
			<?php
			$types = MasterLeaveType::find()->where(['status' => 1])->all();
			?>
			<?=
				$form->field($model, 'leave_type')
				->dropDownList(ArrayHelper::map($types, 'id', 'type'), [
				    'class' => 'form-control',
				    'prompt' => '--select leave type--'
					]
				)
			?>
			<?php // $form->field($model, 'leave_type')->textInput() ?>

		</div>

		<?php // $form->field($model, 'commencing_date')->textInput() ?>
		<div class='col-md-3 col-sm-6 col-xs-12 '>
			<div class="form-group field-commencing-date">
				<label class="control-label" for="commencing-date">Commencing date</label>
				<?php
				if (isset($model->commencing_date)) {
					$model->commencing_date = date('d-m-Y', strtotime($model->commencing_date));
				} else {
					$model->commencing_date = date('d-m-Y');
				}

				echo DatePicker::widget([
				    'name' => 'StaffLeave[commencing_date]',
				    'type' => DatePicker::TYPE_INPUT,
				    'value' => $model->commencing_date,
				    'pluginOptions' => [
					'autoclose' => true,
					'format' => 'dd-mm-yyyy',
				    ]
				]);
				?>


			</div>


		</div>
		<div class='col-md-3 col-sm-6 col-xs-12 '>
			<div class="form-group field-ending-date">
				<label class="control-label" for="ending-date">Ending Date</label>
				<?php
				if (isset($model->ending_date)) {
					$model->ending_date = date('d-m-Y', strtotime($model->ending_date));
				} else {
					$model->ending_date = date('d-m-Y');
				}

				echo DatePicker::widget([
				    'name' => 'StaffLeave[ending_date]',
				    'type' => DatePicker::TYPE_INPUT,
				    'value' => $model->ending_date,
				    'pluginOptions' => [
					'autoclose' => true,
					'format' => 'dd-mm-yyyy',
				    ]
				]);
				?>


			</div>


		</div>

		<div class='col-md-4 col-sm-6 col-xs-12 '>
			<?= $form->field($model, 'purpose')->textarea(['rows' => 6]) ?>

		</div>
	</div>
	<div class="row">
		<div class='col-md-4 col-sm-6 col-xs-12'>
			<div class="form-group" >
				<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
			</div>
		</div>
	</div>

	<?php ActiveForm::end(); ?>

</div>
