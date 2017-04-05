<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\PatientEnquiryHospitalSecond */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-enquiry-hospital-second-form form-inline">



        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'diabetic')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No', '2' => 'Yes,Insulin', '3' => 'Yes, On Tablet', '4' => 'Dont Know']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' id='diabetic_note'>    <?= $form->field($model, 'diabetic_note')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'hypertension')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'feeding')->dropDownList(['' => '--Select--', '0' => 'Nasogastric', '1' => 'Nasoduodenal', '2' => 'Nasojejunal Tubes', '3' => 'Gastrostomy', '4' => 'Gastrojejunostomy', '5' => 'Jejunostomyfeeding tube']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'urine')->dropDownList(['' => '--Select--', '0' => 'Foleys catheter', '1' => 'Suprapubic', '2' => 'Condom catheter']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'oxygen')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No', '2' => 'Ventilator', '3' => 'BiPAP', '4' => 'SOS']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'tracheostomy')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'iv_line')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'family_support')->textInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'family_support_note')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'care_currently_provided')->dropDownList(['' => '--Select--', '1' => 'Family', '2' => 'Friends', '3' => 'Hospital', '5' => 'Home Nursing Agemcy', '4' => 'Others', '6' => 'Not Told']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' id='care_currently_provided_others'>    <?= $form->field($model, 'care_currently_provided_others')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <div class="form-group field-patientenquiryhospitalsecond-date_of_discharge">
                        <label class="control-label" for="patientenquiryhospitalsecond-date_of_discharge">Expected Date Of Discharge</label>
                        <?php
                        if (!$model->isNewRecord) {
                                $model->date_of_discharge = date('d-m-Y', strtotime($model->date_of_discharge));
                        } else {
                                $model->date_of_discharge = date('d-m-Y');
                        }

                        echo DatePicker::widget([
                            'name' => 'PatientEnquiryHospitalSecond[date_of_discharge]',
                            'type' => DatePicker::TYPE_INPUT,
                            'value' => $model->date_of_discharge,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy',
                            ]
                        ]);
                        ?>


                </div>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'details_of_current_care')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'difficulty_in_movement')->dropDownList(['' => '--Select--', '1' => 'No difficulty', '2' => 'Assistance required', '3' => 'Wheelchair', '4' => 'Bedridden', '5' => 'Other']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' id="difficulty_in_movement_other">    <?= $form->field($model, 'difficulty_in_movement_other')->textarea(['rows' => 6]) ?>

        </div>




</div>
