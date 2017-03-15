<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

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

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd difficulty_other' <?php if ($model->difficulty_in_movement == 5) { ?>
                           style="display:show"
                   <?php } else { ?>
                           style="display:none"
                   <?php } ?>>   <?= $form->field($model, 'difficulty_in_movement_other')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'service_required')->dropDownList(['' => '--Select--', '1' => 'Immediately', '2' => 'Couple Weeks', '3' => 'Month', '4' => 'Unsure', '5' => 'Other']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd service_other'  <?php if ($model->service_required == 5) { ?>
                           style="display:show"
                   <?php } else { ?>
                           style="display:none"
                   <?php } ?>>    <?= $form->field($model, 'service_required_other')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'how_long_service_required')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'nursing_assessment')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'doctor_assessment')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'priority')->dropDownList(['' => '--Select--', '1' => 'Hot', '2' => 'Warm', '3' => 'Cold']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' style='min-height: 115px;'>    <?= $form->field($model, 'follow_up_notes')->textarea(['rows' => 4]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' style='min-height: 115px;'>    <?= $form->field($model, 'quotation_details')->textarea(['rows' => 4]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <div class="form-group field-enquiryotherinfo-followup_date">
                        <label class="control-label" for="enquiryotherinfo-followup_date">Followup Date</label>
                        <?php
                        echo DateTimePicker::widget([
                            'name' => 'EnquiryOtherInfo[followup_date]',
                            'type' => DateTimePicker::TYPE_INPUT,
                            'value' => '01-Mar-2017 10:10',
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-M-yyyy hh:ii'
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
                $('#enquiryotherinfo-difficulty_in_movement').change(function () {
                        if ($(this).val() == '5') {
                                $('.difficulty_other').show();
                        } else {
                                $('.difficulty_other').hide();
                                $('#enquiryotherinfo-difficulty_in_movement_other').val('');

                        }
                });

                $('#enquiryotherinfo-service_required').change(function () {
                        if ($(this).val() == '5') {
                                $('.service_other').show();
                        } else {
                                $('.service_other').hide();
                                $('#enquiryotherinfo-service_required_other').val('');
                        }
                });

        });
</script>