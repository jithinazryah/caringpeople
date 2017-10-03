<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ServiceBinSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-bin-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'branch_id') ?>

    <?= $form->field($model, 'service_id') ?>

    <?= $form->field($model, 'patient_id') ?>

    <?= $form->field($model, 'service') ?>

    <?php // echo $form->field($model, 'sub_service') ?>

    <?php // echo $form->field($model, 'gender_preference') ?>

    <?php // echo $form->field($model, 'duty_type') ?>

    <?php // echo $form->field($model, 'day_night_staff') ?>

    <?php // echo $form->field($model, 'frequency') ?>

    <?php // echo $form->field($model, 'hours') ?>

    <?php // echo $form->field($model, 'days') ?>

    <?php // echo $form->field($model, 'staff_manager') ?>

    <?php // echo $form->field($model, 'from_date') ?>

    <?php // echo $form->field($model, 'to_date') ?>

    <?php // echo $form->field($model, 'estimated_price') ?>

    <?php // echo $form->field($model, 'service_staffs') ?>

    <?php // echo $form->field($model, 'co_worker') ?>

    <?php // echo $form->field($model, 'rate_card_value') ?>

    <?php // echo $form->field($model, 'registration_fees') ?>

    <?php // echo $form->field($model, 'registration_fees_amount') ?>

    <?php // echo $form->field($model, 'due_amount') ?>

    <?php // echo $form->field($model, 'client_notes') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'CB') ?>

    <?php // echo $form->field($model, 'UB') ?>

    <?php // echo $form->field($model, 'DOC') ?>

    <?php // echo $form->field($model, 'DOU') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
