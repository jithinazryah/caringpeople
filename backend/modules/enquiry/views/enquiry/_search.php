<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EnquirySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enquiry-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'enquiry_id') ?>

    <?= $form->field($model, 'contacted_source') ?>

    <?= $form->field($model, 'contacted_date') ?>

    <?= $form->field($model, 'incoming_missed') ?>

    <?php // echo $form->field($model, 'contacted_source_others') ?>

    <?php // echo $form->field($model, 'outgoing_number_from') ?>

    <?php // echo $form->field($model, 'outgoing_call_date') ?>

    <?php // echo $form->field($model, 'caller_name') ?>

    <?php // echo $form->field($model, 'referral_source') ?>

    <?php // echo $form->field($model, 'mobile_number') ?>

    <?php // echo $form->field($model, 'mobile_number_2') ?>

    <?php // echo $form->field($model, 'mobile_number_3') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'zip_pc') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'service_required_for') ?>

    <?php // echo $form->field($model, 'service_required_for_others') ?>

    <?php // echo $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'relationship') ?>

    <?php // echo $form->field($model, 'veteran_or_spouse') ?>

    <?php // echo $form->field($model, 'person_address') ?>

    <?php // echo $form->field($model, 'person_city') ?>

    <?php // echo $form->field($model, 'person_postal_code') ?>

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
