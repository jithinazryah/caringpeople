<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StaffOtherInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-other-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'staff_id') ?>

    <?= $form->field($model, 'hospital_address') ?>

    <?= $form->field($model, 'designation') ?>

    <?= $form->field($model, 'length_of_service') ?>

    <?php // echo $form->field($model, 'current_from') ?>

    <?php // echo $form->field($model, 'current_to') ?>

    <?php // echo $form->field($model, 'emergency_contact_name') ?>

    <?php // echo $form->field($model, 'relationship') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'mobile') ?>

    <?php // echo $form->field($model, 'alt_emergency_contact_name') ?>

    <?php // echo $form->field($model, 'alt_relationship') ?>

    <?php // echo $form->field($model, 'alt_phone') ?>

    <?php // echo $form->field($model, 'alt_mobile') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
