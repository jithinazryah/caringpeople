<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\EnquiryOtherInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enquiry-other-info-form form-inline">

        <?php $form = ActiveForm::begin(); ?>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'family_support')->dropDownList(['' => '--Select--', '1' => 'Close', '2' => 'Distant', '3' => 'None']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'family_support_note')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'care_currently_provided')->dropDownList(['' => '--Select--', '1' => 'Family', '2' => 'Friends', '3' => 'Provincial HC', '4' => 'Insurance', '5' => 'Private', '6' => 'VAC']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'details_of_current_care')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'difficulty_in_movement')->dropDownList(['' => '--Select--', '1' => 'No difficulty', '2' => 'Assistance required', '3' => 'Wheelchair', '4' => 'Bedridden', '5' => 'Other']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' id="difficulty_in_movement_other">   <?= $form->field($model, 'difficulty_in_movement_other')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'service_required')->dropDownList(['' => '--Select--', '1' => 'Immediately', '2' => 'Couple Weeks', '3' => 'Month', '4' => 'Unsure', '5' => 'Other']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' id="service_required">    <?= $form->field($model, 'service_required_other')->textInput(['maxlength' => true]) ?>

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
                                $model->followup_date = date('d-m-Y', strtotime($model->followup_date));
                        } else {
                                $model->followup_date = date('d-m-Y');
                        }

                        echo DatePicker::widget([
                            'name' => 'EnquiryOtherInfo[followup_date]',
                            'type' => DatePicker::TYPE_INPUT,
                            'value' => $model->followup_date,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy',
                            ]
                        ]);
                        ?>

                </div>

        </div>	<div class='col-md-4 col-sm-6 col-xs-12'>
                <div class="form-group" style="float: right;">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>
        </div>

        <?php ActiveForm::end(); ?>

</div>


<script>
        $(document).ready(function () {


                $difficulty_in_movement = $("#enquiryotherinfo-difficulty_in_movement").val();
                if ($difficulty_in_movement === '5') {
                        $('#difficulty_in_movement_other').show();
                } else {
                        $('#difficulty_in_movement_other').hide();
                }

                $('#enquiryotherinfo-difficulty_in_movement').change(function () {
                        if ($(this).val() === '5') {
                                $('#difficulty_in_movement_other').show();
                        } else {
                                $('#difficulty_in_movement_other').hide();
                                $('#difficulty_in_movement_other').val('');

                        }
                });

                $service_required = $("#enquiryotherinfo-service_required").val();
                if ($service_required === '5') {
                        $('#service_required').show();
                } else {
                        $('#service_required').hide();
                }

                $('#enquiryotherinfo-service_required').change(function () {
                        if ($(this).val() === '5') {
                                $('#service_required').show();
                        } else {
                                $('#service_required').hide();
                                $('#service_required').val('');
                        }
                });

        });
</script>