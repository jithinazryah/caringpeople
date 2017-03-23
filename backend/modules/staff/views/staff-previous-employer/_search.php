<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StaffPerviousEmployerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-pervious-employer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'staff_id') ?>

    <?= $form->field($model, 'hospital_address') ?>

    <?= $form->field($model, 'designation') ?>

    <?= $form->field($model, 'length_of_service') ?>

    <?php // echo $form->field($model, 'service_from') ?>

    <?php // echo $form->field($model, 'service_to') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
