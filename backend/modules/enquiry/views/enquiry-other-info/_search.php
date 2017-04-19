<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EnquiryOtherInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enquiry-other-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'enquiry_id') ?>

    <?= $form->field($model, 'family_support') ?>

    <?= $form->field($model, 'family_support_note') ?>

    <?= $form->field($model, 'care_currently_provided') ?>

    <?php // echo $form->field($model, 'details_of_current_care') ?>

    <?php // echo $form->field($model, 'difficulty_in_movement') ?>

    <?php // echo $form->field($model, 'difficulty_in_movement_other') ?>

    <?php // echo $form->field($model, 'service_required') ?>

    <?php // echo $form->field($model, 'service_required_other') ?>

    <?php // echo $form->field($model, 'how_long_service_required') ?>

    <?php // echo $form->field($model, 'nursing_assessment') ?>

    <?php // echo $form->field($model, 'doctor_assessment') ?>

    <?php // echo $form->field($model, 'follow_up_notes') ?>

    <?php // echo $form->field($model, 'quotation_details') ?>

    <?php // echo $form->field($model, 'priority') ?>

    <?php // echo $form->field($model, 'followup_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
