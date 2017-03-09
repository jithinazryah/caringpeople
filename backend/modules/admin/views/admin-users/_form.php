<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AdminUsers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-users-form form-inline">

    <?php $form = ActiveForm::begin(); ?>

<div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'post_id')->textInput() ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'employee_code')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'status')->textInput() ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'CB')->textInput() ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'UB')->textInput() ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'DOC')->textInput() ?>

</div><div class='col-md-4 col-sm-6 col-xs-12'>    <?= $form->field($model, 'DOU')->textInput() ?>

</div>    <div class="form-group" style="float: right;">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
