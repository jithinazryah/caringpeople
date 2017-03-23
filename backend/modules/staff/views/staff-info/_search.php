<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StaffInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'staff_name') ?>

    <?= $form->field($model, 'gender') ?>

    <?= $form->field($model, 'dob') ?>

    <?= $form->field($model, 'blood_group') ?>

    <?php // echo $form->field($model, 'religion') ?>

    <?php // echo $form->field($model, 'caste') ?>

    <?php // echo $form->field($model, 'nationality') ?>

    <?php // echo $form->field($model, 'pan_or_adhar_no') ?>

    <?php // echo $form->field($model, 'permanent_address') ?>

    <?php // echo $form->field($model, 'pincode') ?>

    <?php // echo $form->field($model, 'contact_no') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'present_address') ?>

    <?php // echo $form->field($model, 'present_pincode') ?>

    <?php // echo $form->field($model, 'present_contact_no') ?>

    <?php // echo $form->field($model, 'present_email') ?>

    <?php // echo $form->field($model, 'years_of_experience') ?>

    <?php // echo $form->field($model, 'driving_licence') ?>

    <?php // echo $form->field($model, 'licence_no') ?>

    <?php // echo $form->field($model, 'sslc_institution') ?>

    <?php // echo $form->field($model, 'sslc_year_of_passing') ?>

    <?php // echo $form->field($model, 'sslc_place') ?>

    <?php // echo $form->field($model, 'hse_institution') ?>

    <?php // echo $form->field($model, 'hse_year_of_passing') ?>

    <?php // echo $form->field($model, 'hse_place') ?>

    <?php // echo $form->field($model, 'nursing_institution') ?>

    <?php // echo $form->field($model, 'nursing_year_of_passing') ?>

    <?php // echo $form->field($model, 'nursing_place') ?>

    <?php // echo $form->field($model, 'timing') ?>

    <?php // echo $form->field($model, 'profile_image_type') ?>

    <?php // echo $form->field($model, 'uniform') ?>

    <?php // echo $form->field($model, 'company_id') ?>

    <?php // echo $form->field($model, 'emergency_conatct_verification') ?>

    <?php // echo $form->field($model, 'panchayath_cleraance_verification') ?>

    <?php // echo $form->field($model, 'biodata') ?>

    <?php // echo $form->field($model, 'branch_id') ?>

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
