<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\EnquiryOtherInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enquiry-other-info-form form-inline">



        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'family_support')->dropDownList(['' => '--Select--', '1' => 'Close', '2' => 'Distant', '3' => 'None']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'family_support_note')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?php // $form->field($model, 'care_currently_provided')->dropDownList(['' => '--Select--', '1' => 'Family', '2' => 'Friends', '3' => 'Provincial HC', '4' => 'Insurance', '5' => 'Private', '6' => 'VAC'])                                               ?>

                <?= $form->field($model, 'care_currently_provided')->dropDownList(['' => '--Select--', '1' => 'Family', '2' => 'Friends', '3' => 'Hospital', '4' => 'Others']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' id='care_currently_provided_others'>    <?= $form->field($model, 'care_currently_provided_others')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' id='date_of_discharge'>
                <div class="form-group field-enquiryotherinfo-date_of_discharge">
                        <label class="control-label" for="enquiryotherinfo-date_of_discharge">Expected Date Of Discharge</label>
                        <?php
                        if (!$model->isNewRecord) {
                                $model->date_of_discharge = date('d-m-Y', strtotime($model->date_of_discharge));
                        } else {
                                $model->date_of_discharge = date('d-m-Y');
                        }

                        echo DatePicker::widget([
                            'name' => 'EnquiryOtherInfo[date_of_discharge]',
                            'type' => DatePicker::TYPE_INPUT,
                            'value' => $model->date_of_discharge,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy',
                            ]
                        ]);
                        ?>


                </div>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'details_of_current_care')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'difficulty_in_movement')->dropDownList(['' => '--Select--', '1' => 'No difficulty', '2' => 'Assistance required', '3' => 'Wheelchair', '4' => 'Bedridden', '5' => 'Other']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' id="difficulty_in_movement_other">   <?= $form->field($model, 'difficulty_in_movement_other')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'service_required')->dropDownList(['' => '--Select--', '1' => 'Immediately', '2' => 'Couple Weeks', '3' => 'Month', '4' => 'Unsure', '5' => 'Other']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' id="service_required">    <?= $form->field($model, 'service_required_other')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <div class="form-group field-enquiryotherinfo-expected_date_of_service">
                        <label class="control-label" for="enquiryotherinfo-expected_date_of_service">Expected Date Of Service Needed</label>
                        <?php
                        if (!$model->isNewRecord) {
                                $model->expected_date_of_service = date('d-m-Y', strtotime($model->expected_date_of_service));
                        } else {
                                $model->expected_date_of_service = date('d-m-Y');
                        }

                        echo DatePicker::widget([
                            'name' => 'EnquiryOtherInfo[expected_date_of_service]',
                            'type' => DatePicker::TYPE_INPUT,
                            'value' => $model->expected_date_of_service,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy',
                            ]
                        ]);
                        ?>


                </div>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'how_long_service_required')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <div class="form-group field-enquiryotherinfo-nursing_assessment">
                        <label class="control-label" for="enquiryotherinfo-nursing_assessment">Nursing Assessment</label>
                        <?php
                        if (!$model->isNewRecord) {
                                $model->nursing_assessment = date('d-m-Y', strtotime($model->nursing_assessment));
                        } else {
                                $model->nursing_assessment = date('d-m-Y');
                        }

                        echo DatePicker::widget([
                            'name' => 'EnquiryOtherInfo[nursing_assessment]',
                            'type' => DatePicker::TYPE_INPUT,
                            'value' => $model->nursing_assessment,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy',
                            ]
                        ]);
                        ?>


                </div>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <div class="form-group field-enquiryotherinfo-doctor_assessment">
                        <label class="control-label" for="enquiryotherinfo-doctor_assessment">Doctor Assessment</label>
                        <?php
                        if (!$model->isNewRecord) {
                                $model->doctor_assessment = date('d-m-Y', strtotime($model->doctor_assessment));
                        } else {
                                $model->doctor_assessment = date('d-m-Y');
                        }

                        echo DatePicker::widget([
                            'name' => 'EnquiryOtherInfo[doctor_assessment]',
                            'type' => DatePicker::TYPE_INPUT,
                            'value' => $model->doctor_assessment,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy',
                            ]
                        ]);
                        ?>

                </div>


        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'priority')->dropDownList(['' => '--Select--', '1' => 'Hot', '2' => 'Warm', '3' => 'Cold']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' style='min-height: 115px;'>    <?= $form->field($model, 'follow_up_notes')->textarea(['rows' => 4]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' style='min-height: 115px;'>    <?= $form->field($model, 'quotation_details')->textarea(['rows' => 4]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <div class="form-group field-enquiryotherinfo-followup_date">
                        <label class="control-label" for="enquiryotherinfo-followup_date">Followup Date</label>

                        <?php
                        if (!$model->isNewRecord) {
                                $model->followup_date = date('d-M-Y h:i', strtotime($model->followup_date));
                        } else {
                                $model->followup_date = date('d-M-Y h:i');
                        }
                        echo DateTimePicker::widget([
                            'name' => 'EnquiryOtherInfo[followup_date]',
                            'type' => DateTimePicker::TYPE_INPUT,
                            'value' => $model->followup_date,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-M-yyyy hh:ii'
                            ]
                        ]);
                        ?>

                </div>

        </div>



</div>


<script>
        $(document).ready(function () {

                /* difficulty in movement others field show/hide on update*/
                $difficulty_in_movement = $("#enquiryotherinfo-difficulty_in_movement").val();
                if ($difficulty_in_movement === '5') {
                        $('#difficulty_in_movement_other').show();
                } else {
                        $('#difficulty_in_movement_other').hide();
                }

                /* difficulty in movement others field show/hide on create*/
                $('#enquiryotherinfo-difficulty_in_movement').change(function () {
                        if ($(this).val() === '5') {
                                $('#difficulty_in_movement_other').show();
                        } else {
                                $('#difficulty_in_movement_other').hide();

                        }
                });
                /* service required other others field show/hide on update*/
                $service_required = $("#enquiryotherinfo-service_required").val();
                if ($service_required === '5') {
                        $('#service_required').show();
                } else {
                        $('#service_required').hide();
                }
                /* service required other others field show/hide on create*/
                $('#enquiryotherinfo-service_required').change(function () {
                        if ($(this).val() === '5') {
                                $('#service_required').show();
                        } else {
                                $('#service_required').hide();
                        }
                });
                /*care currently provided service required other others field show/hide on update*/
                if ($('#enquiryotherinfo-care_currently_provided').val() === '4')
                        $('#care_currently_provided_others').show();
                else
                        $('#care_currently_provided_others').hide();


                /*care currently provided other others field show/hide on cretae*/
                $('#enquiryotherinfo-care_currently_provided').change(function () {
                        if ($(this).val() === '4') {
                                $('#care_currently_provided_others').show();
                        } else {
                                $('#care_currently_provided_others').hide();
                        }
                });

                /*care currently provided service required expected datre of dischargede on update*/
                if ($('#enquiryotherinfo-care_currently_provided').val() === '3')
                        $('#date_of_discharge').show();
                else
                        $('#date_of_discharge').hide();


                /*care currently provided service required expected datre of dischargede on create*/
                $('#enquiryotherinfo-care_currently_provided').change(function () {
                        if ($(this).val() === '3') {
                                $('#date_of_discharge').show();
                        } else {
                                $('#date_of_discharge').hide();

                        }
                });

        });
</script>