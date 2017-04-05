<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PatientEnquiryHospitalFirstSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-enquiry-hospital-first-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'enquiry_id') ?>

    <?= $form->field($model, 'required_person_name') ?>

    <?= $form->field($model, 'patient_gender') ?>

    <?= $form->field($model, 'patient_age') ?>

    <?php // echo $form->field($model, 'patient_weight') ?>

    <?php // echo $form->field($model, 'relationship') ?>

    <?php // echo $form->field($model, 'relationship_others') ?>

    <?php // echo $form->field($model, 'person_address') ?>

    <?php // echo $form->field($model, 'person_city') ?>

    <?php // echo $form->field($model, 'person_postal_code') ?>

    <?php // echo $form->field($model, 'hospital_name') ?>

    <?php // echo $form->field($model, 'consultant_doctor') ?>

    <?php // echo $form->field($model, 'department') ?>

    <?php // echo $form->field($model, 'hospital_room_no') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
