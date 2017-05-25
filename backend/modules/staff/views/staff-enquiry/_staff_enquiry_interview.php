<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\StaffOtherInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-other-info-form form-inline">








        <h3 style="color:#148eaf;">Family Details</h3>
        <hr class="enquiry-hr"/>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'family_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'relation')->dropDownList(['' => '--Select--', '1' => 'Father', '2' => 'Mother', '3' => 'Spouse', '4' => 'Brother', '5' => 'Sister', '6' => 'Neighbour']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'job')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'mobile_no')->textInput(['maxlength' => true]) ?>

        </div><div style="clear: both">

        </div>


        <h3 style="color:#148eaf;">Bank Details</h3>
        <hr class="enquiry-hr"/>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'bank_ac_no')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($staff_interview_third, 'bank_ac_hodername')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'bank_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'bank_branch')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'bank_ifsc')->textInput(['maxlength' => true]) ?>

        </div><div style="clear: both">

        </div>



        <h3 style="color:#148eaf;">Emergency Contact Verification</h3>
        <hr class="enquiry-hr"/>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'contact_verified_by')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>

                <?php
                if (!$staff_interview_second->isNewRecord) {
                        $staff_interview_second->contact_verified_date = date('d-m-Y', strtotime($staff_interview_second->contact_verified_date));
                }
                ?>
                <?=
                DatePicker::widget([
                    'model' => $staff_interview_second,
                    'form' => $form,
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'contact_verified_date',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]);
                ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'contact_verified_note')->textarea(['rows' => 2]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'alt_contact_verified_by')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <?php
                if (!$staff_interview_second->isNewRecord) {
                        $staff_interview_second->alt_contact_verified_date = date('d-m-Y', strtotime($staff_interview_second->alt_contact_verified_date));
                }
                ?>
                <?=
                DatePicker::widget([
                    'model' => $staff_interview_second,
                    'form' => $form,
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'alt_contact_verified_date',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]);
                ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'alt_contact_verified_note')->textarea(['rows' => 2]) ?>

        </div>



        <h3 style="color:#148eaf;"> Verification Details</h3>
        <hr class="enquiry-hr"/>

        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'verified_name_1')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'verified_designation_1')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'verified_mobile_no_1')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                <?php
                if (!$staff_interview_second->isNewRecord) {
                        $staff_interview_second->verified_date_1 = date('d-m-Y', strtotime($staff_interview_second->verified_date_1));
                }
                ?>
                <?=
                DatePicker::widget([
                    'model' => $staff_interview_second,
                    'form' => $form,
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'verified_date_1',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]);
                ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'verified_name_2')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'verified_designation_2')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'verified_mobile_no_2')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                <?php
                if (!$staff_interview_second->isNewRecord) {
                        $staff_interview_second->verified_date_2 = date('d-m-Y', strtotime($staff_interview_second->verified_date_2));
                }
                ?>
                <?=
                DatePicker::widget([
                    'model' => $staff_interview_second,
                    'form' => $form,
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'verified_date_2',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]);
                ?>


        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'verified_name_3')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'verified_designation_3')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'verified_mobile_no_3')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                <?php
                if (!$staff_interview_second->isNewRecord) {
                        $staff_interview_second->verified_date_3 = date('d-m-Y', strtotime($staff_interview_second->verified_date_3));
                }
                ?>
                <?=
                DatePicker::widget([
                    'model' => $staff_interview_second,
                    'form' => $form,
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'verified_date_3',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]);
                ?>



        </div>



        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'document_required')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'document_received')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'interest_level')->dropDownList(['' => '--Select--', '1' => 'High', '2' => 'No Interest', '3' => 'Medium']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <?php
                if (!$staff_interview_third->isNewRecord) {
                        $staff_interview_third->expected_date_of_joining = date('d-m-Y', strtotime($staff_interview_third->expected_date_of_joining));
                }
                ?>
                <?=
                DatePicker::widget([
                    'model' => $staff_interview_third,
                    'form' => $form,
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'expected_date_of_joining',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]);
                ?>


        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'form_filled', ['template' => "<label class='cbr-inline top'>{input}</label>",])->checkbox(['class' => 'cbr', 'style' => 'margin-top:10px;']) ?>

        </div><div class='col-md-12 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'interview_notes')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'interviewed_by')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <?php
                if (!$staff_interview_third->isNewRecord) {
                        $staff_interview_third->interviewed_date = date('d-m-Y', strtotime($staff_interview_third->interviewed_date));
                }
                ?>
                <?=
                DatePicker::widget([
                    'model' => $staff_interview_third,
                    'form' => $form,
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'interviewed_date',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]);
                ?>


        </div><div style="clear:both"></div>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($staff_interview_first, 'terms_conditions', ['template' => "<label class='cbr-inline top'>{input}<a href='javascript:;' target='_blank' href='#' class='terms' id='3'>I agree to the terms and conditions</a></label>",])->checkbox(['class' => 'cbr', 'style' => 'margin-top:10px;', 'label' => '']) ?>



        </div>
</div>

<style>
        .cbr-inline{ margin-top: 10px; }
        .lang_check{text-align: center;color: #000;}
        .languages .col-md-3{height: 65px;}
        .languages{margin-left: 0px;margin-right: 0px;}
        .lang_check label{font-weight: bold}

</style>
