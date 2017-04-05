<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PatientEnquiryGeneralSecondSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-enquiry-general-second-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'enquiry_id') ?>

    <?= $form->field($model, 'address') ?>

    <?= $form->field($model, 'city') ?>

    <?= $form->field($model, 'zip_pc') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'email1') ?>

    <?php // echo $form->field($model, 'whatsapp_reply') ?>

    <?php // echo $form->field($model, 'whatsapp_number') ?>

    <?php // echo $form->field($model, 'whatsapp_note') ?>

    <?php // echo $form->field($model, 'required_service') ?>

    <?php // echo $form->field($model, 'required_service_other') ?>

    <?php // echo $form->field($model, 'service_required') ?>

    <?php // echo $form->field($model, 'service_required_other') ?>

    <?php // echo $form->field($model, 'expected_date_of_service') ?>

    <?php // echo $form->field($model, 'how_long_service_required') ?>

    <?php // echo $form->field($model, 'visit_type') ?>

    <?php // echo $form->field($model, 'quotation_details') ?>

    <?php // echo $form->field($model, 'notes') ?>

    <?php // echo $form->field($model, 'priority') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
