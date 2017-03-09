<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AdminPosts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-posts-form form-inline">

    <?php $form = ActiveForm::begin(); ?>

<div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'post_name')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?=$form->field($model, 'enquiry')->dropDownList(['' => '--Select--','1' => 'Yes', '0' => 'No']) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'users')->dropDownList(['' => '--Select--','1' => 'Yes', '0' => 'No']) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'employees')->dropDownList(['' => '--Select--','1' => 'Yes', '0' => 'No']) ?>

</div>   <div class="form-group" style="float: right;">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
