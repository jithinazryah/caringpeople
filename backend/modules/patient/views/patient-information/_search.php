<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PatientInformationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-information-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'enquiry_id') ?>

    <?= $form->field($model, 'patient_id') ?>

    <?= $form->field($model, 'branch_id') ?>

    <?= $form->field($model, 'contact_address') ?>

    <?php // echo $form->field($model, 'contact_name') ?>

    <?php // echo $form->field($model, 'contact_gender') ?>

    <?php // echo $form->field($model, 'referral_source') ?>

    <?php // echo $form->field($model, 'contact_mobile_number_1') ?>

    <?php // echo $form->field($model, 'contact_mobile_number_2') ?>

    <?php // echo $form->field($model, 'contact_mobile_number_3') ?>

    <?php // echo $form->field($model, 'contact_city') ?>

    <?php // echo $form->field($model, 'contact_zip_or_pc') ?>

    <?php // echo $form->field($model, 'contact_email') ?>

    <?php // echo $form->field($model, 'contact_perosn_relationship') ?>

    <?php // echo $form->field($model, 'patient_name') ?>

    <?php // echo $form->field($model, 'patient_gender') ?>

    <?php // echo $form->field($model, 'patient_age') ?>

    <?php // echo $form->field($model, 'patient_weight') ?>

    <?php // echo $form->field($model, 'other_relationships') ?>

    <?php // echo $form->field($model, 'veteran_or_spouse') ?>

    <?php // echo $form->field($model, 'patient_address') ?>

    <?php // echo $form->field($model, 'patient_city') ?>

    <?php // echo $form->field($model, 'patient_postal_code') ?>

    <?php // echo $form->field($model, 'patient_current_status') ?>

    <?php // echo $form->field($model, 'follow_up_date') ?>

    <?php // echo $form->field($model, 'notes') ?>

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
