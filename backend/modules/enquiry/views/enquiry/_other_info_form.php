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

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'care_currently_provided')->dropDownList(['' => '--Select--', '1' => 'Family', '2' => 'Friends', '3' => 'Hospital', '5' => 'Home Nursing Agemcy', '4' => 'Others', '6' => 'Not Told']) ?>

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


        </div>



</div>

