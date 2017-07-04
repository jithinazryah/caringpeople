<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UploadCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="upload-category-form form-inline">

        <?php $form = ActiveForm::begin(); ?>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'category_type')->dropDownList(['' => '--Select--', '1' => 'Profile', '2' => 'Government Issued Identification', '3' => 'Permanent Address', '4' => 'Current Address', '5' => 'Educational Document', '6' => 'IMC Document']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'sub_category')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12'>
                <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px;
                        height: 36px;
                        width:100px;
                               ']) ?>
                </div>
        </div>

        <?php ActiveForm::end(); ?>

</div>