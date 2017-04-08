<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use common\models\Hospital;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $patient_hospital common\models\PatientEnquiryHospitalFirst */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-enquiry-hospital-first-form form-inline">



        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital, 'required_person_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital, 'patient_gender')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital, 'patient_age')->textInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital, 'patient_weight')->textInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital, 'relationship')->dropDownList(['' => '--Select--', '0' => 'Spouse', '1' => 'parent', '2' => 'Grandparent', '3' => 'Others']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' id="relationship_others">    <?= $form->field($patient_hospital, 'relationship_others')->textInput(['maxlength' => true]) ?>

        </div><div style="clear:both;">

        </div>
        <div class="row>">
                <input type="checkbox" id="checkbox_id" name="check" checkvalue="1" uncheckValue="0"><label style="color:black;font-weight:bold; margin-left: 5px;"> Caller address and person address are same</label>
        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital, 'person_address')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital, 'person_city')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital, 'person_postal_code')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?php $hospital_name = Hospital::find()->where(['status' => '1'])->all() ?>   <?= $form->field($patient_hospital, 'hospital_name')->dropDownList(ArrayHelper::map($hospital_name, 'id', 'hospital_name'), ['prompt' => '--Select--']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital, 'consultant_doctor')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital, 'department')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital, 'hospital_room_no')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital_second, 'diabetic')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No', '2' => 'Yes,Insulin', '3' => 'Yes, On Tablet', '4' => 'Dont Know']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' id='diabetic_note'>    <?= $form->field($patient_hospital_second, 'diabetic_note')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital_second, 'hypertension')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital_second, 'feeding')->dropDownList(['' => '--Select--', '0' => 'Nasogastric', '1' => 'Nasoduodenal', '2' => 'Nasojejunal Tubes', '3' => 'Gastrostomy', '4' => 'Gastrojejunostomy', '5' => 'Jejunostomyfeeding tube']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital_second, 'urine')->dropDownList(['' => '--Select--', '0' => 'Foleys catheter', '1' => 'Suprapubic', '2' => 'Condom catheter']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital_second, 'oxygen')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No', '2' => 'Ventilator', '3' => 'BiPAP', '4' => 'SOS']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital_second, 'tracheostomy')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital_second, 'iv_line')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital_second, 'family_support')->dropDownList(['' => '--Select--', '1' => 'Close', '2' => 'Distant', '3' => 'None']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital_second, 'family_support_note')->textarea(['rows' => 1]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital_second, 'care_currently_provided')->dropDownList(['' => '--Select--', '1' => 'Family', '2' => 'Friends', '3' => 'Hospital', '5' => 'Home Nursing Agemcy', '4' => 'Others', '6' => 'Not Told']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' id='care_currently_provided_others'>    <?= $form->field($patient_hospital_second, 'care_currently_provided_others')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' id="date_of_discharge">
                <div class="form-group field-patientenquiryhospitalsecond-date_of_discharge">
                        <label class="control-label" for="patientenquiryhospitalsecond-date_of_discharge">Expected Date Of Discharge</label>
                        <?php
                        if (!$patient_hospital_second->isNewRecord) {
                                $patient_hospital_second->date_of_discharge = date('d-m-Y', strtotime($patient_hospital_second->date_of_discharge));
                        } else {
                                $patient_hospital_second->date_of_discharge = date('d-m-Y');
                        }

                        echo DatePicker::widget([
                            'name' => 'PatientEnquiryHospitalSecond[date_of_discharge]',
                            'type' => DatePicker::TYPE_INPUT,
                            'value' => $patient_hospital_second->date_of_discharge,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy',
                            ]
                        ]);
                        ?>


                </div>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital_second, 'details_of_current_care')->textarea(['rows' => 1]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_hospital_second, 'difficulty_in_movement')->dropDownList(['' => '--Select--', '1' => 'No difficulty', '2' => 'Assistance required', '3' => 'Wheelchair', '4' => 'Bedridden', '5' => 'Other']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' id="difficulty_in_movement_other">    <?= $form->field($patient_hospital_second, 'difficulty_in_movement_other')->textarea(['rows' => 1]) ?>

        </div>




</div>
