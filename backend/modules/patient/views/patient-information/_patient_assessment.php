<?php

use yii\helpers\Html;
use common\models\StaffExperienceList;

/* @var $this yii\web\View */
/* @var $patient_assessment common\models\PatientBystanderDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-bystander-details-form form-inline">

        <h4 style="color:#000;font-style: italic;font-weight: bold;">Patient's Condition</h4>
        <hr class="enquiry-hr"/>

        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($patient_assessment, 'patient_condition')->radio(['template' => '<label class="cbr-replaced cbr-radio">{input}</label>', 'label' => 'Mobile', 'value' => 1, 'uncheck' => null]) ?></div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($patient_assessment, 'patient_condition')->radio(['label' => 'Bedridden', 'value' => 0, 'uncheck' => null]) ?></div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($patient_assessment, 'patient_condition')->radio(['label' => 'Semi Bedridden', 'value' => 2, 'uncheck' => null]) ?></div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($patient_assessment, 'patient_condition')->radio(['label' => 'Conscious', 'value' => 3, 'uncheck' => null]) ?></div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($patient_assessment, 'patient_condition')->radio(['label' => 'UnConscious', 'value' => 3, 'uncheck' => null]) ?></div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'> <?= $form->field($patient_assessment, 'patient_condition')->radio(['label' => 'Semi Conscious', 'value' => 3, 'uncheck' => null]) ?></div>



        <h4 style="color:#000;font-style: italic;font-weight: bold;">Medical Procedures</h4>
        <hr class="enquiry-hr"/>
        <?php
        $skills = StaffExperienceList::find()->all();
        foreach ($skills as $value) {
                $checked = '';
                if (!$patient_assessment->isNewRecord) {
                        $procedures = explode(',', $patient_assessment->patient_medical_procedures);
                        if (in_array($value->id, $procedures))
                                $checked = "checked";
                }
                ?>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                        <input type='checkbox' name='patient_medical_procedures[]'  value='<?= $value->id; ?>' <?= $checked ?>><label class='cbr-inline top'><?= $value->title; ?></label>
                </div>
        <?php }
        ?>






        <div style="clear: both"></div>
        <h4 style="color:#000;font-style: italic;font-weight: bold;">Suggested Home Care Professional</h4>
        <hr>







        <?php
        if (!$patient_assessment->isNewRecord) {
                $procedures = explode(',', $patient_assessment->suggested_professional);
        }
        ?>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'><input type='checkbox' name='suggested_professional[]'  value='1' <?php
                if (isset($procedures)) {
                        if (in_array('1', $procedures)) {
                                echo 'checked';
                        }
                }
                ?>><label class='cbr-inline top'>Registered Nurse Male</label></div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'><input type='checkbox' name='suggested_professional[]'  value='2' <?php
                if (isset($procedures)) {
                        if (in_array('2', $procedures)) {
                                echo 'checked';
                        }
                }
                ?>><label class='cbr-inline top'>Registered Nurse Female</label></div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'><input type='checkbox' name='suggested_professional[]'  value='3' <?php
                if (isset($procedures)) {
                        if (in_array('3', $procedures)) {
                                echo 'checked';
                        }
                }
                ?>><label class='cbr-inline top'>Associate Nurse Male</label></div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'><input type='checkbox' name='suggested_professional[]'  value='4' accept="<?php
                if (isset($procedures)) {
                        if (in_array('4', $procedures)) {
                                echo 'checked';
                        }
                }
                ?>"><label class='cbr-inline top'>Associate Nurse Female</label></div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'><input type='checkbox' name='suggested_professional[]'  value='5' <?php
                if (isset($procedures)) {
                        if (in_array('5', $procedures)) {
                                echo 'checked';
                        }
                }
                ?>><label class='cbr-inline top'>Nurse Attendent Male</label></div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'><input type='checkbox' name='suggested_professional[]'  value='6' <?php
                                                                  if (isset($procedures)) {
                                                                          if (in_array('6', $procedures)) {
                                                                                  echo 'checked';
                                                                          }
                                                                  }
                ?>><label class='cbr-inline top'>Nurse Attendent Female</label></div>


</div>

<div class='col-md-12 col-sm-6 col-xs-12' >
        <div class="form-group" >
<?= Html::submitButton($patient_assessment->isNewRecord ? 'Create' : 'Update', ['class' => $patient_assessment->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;', 'id' => 'form_button']) ?>

        </div>
</div>

