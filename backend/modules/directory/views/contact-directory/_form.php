<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ContactCategoryTypes;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\ContactDirectory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-directory-form form-inline padng_left">

	<?php $form = ActiveForm::begin(); ?>
        <div class="row">
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
			<?php
			$categories = ContactCategoryTypes::find()->where(['status' => 1])->all();
			?>
			<?=
				$form->field($model, 'category_type')
				->dropDownList(ArrayHelper::map($categories, 'id', 'category_name'), [
				    'class' => 'form-control',
				    'prompt' => '--select contact type--'
					]
				)
			?>

		</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

		</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'email_1')->textInput(['maxlength' => true]) ?>

		</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'email_2')->textInput(['maxlength' => true]) ?>

		</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'phone_1')->textInput(['maxlength' => true]) ?>

		</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'phone_2')->textInput(['maxlength' => true]) ?>

		</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'designation')->textInput(['maxlength' => true]) ?>

		</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

		</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
			<?= $form->field($model, 'references')->dropDownList(['' => '--Select--', '0' => 'Internet', '1' => 'Care and care', '2' => 'Guardian Angel', '3' => 'Caremark', '4' => 'Cancure', '5' => 'Other']) ?>

		</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>

		</div>        </div>
        <div class='col-md-4 col-sm-6 col-xs-12' style="float:right;">
                <div class="form-group" style="float: right;">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>
        </div>

	<?php ActiveForm::end(); ?>

</div>
