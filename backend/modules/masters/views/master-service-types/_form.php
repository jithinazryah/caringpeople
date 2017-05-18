<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MasterServiceTypes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="master-service-types-form form-inline">

	<?php $form = ActiveForm::begin(); ?>

	<div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
		<?= $form->field($model, 'service_name')->textInput(['maxlength' => true]) ?>

	</div>
	<div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
		<?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

	</div>   
        <div class='col-md-4 col-sm-6 col-xs-12' style="float:right;">
                <div class="form-group" style="float: right;">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>
        </div>

	<?php ActiveForm::end(); ?>

</div>