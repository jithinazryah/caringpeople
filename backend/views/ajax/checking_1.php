<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MasterDesignations;
use yii\helpers\ArrayHelper;
use common\models\PatientGeneral;
use common\models\PatientGuardianDetails;
?>


<div class="modal-content " >

        <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h4 class="modal-title" id="largeModalLabel" style="color: #b60d14;">Profile Missing Fields/Files</h4>
        </div>

        <div class="modal-body">
                <div class="row clearfix">


                        <?php
                        $uploaded = array();
                        $not_uploaded = array();
                        if ($type == 1) {
                                $patient_guardian = PatientGuardianDetails::find()->where(['patient_id' => $model->id])->one();
                                $files = array("patient_id-1" => "Patient Id", "first_name-2" => "Guardian Name", "email-1" => "Email", "contact_number-1" => "Contact Number", "police_station_name-2" => "Police Station Name", 'police_station_email-2' => 'Police Station Email', 'panchayath_name-2' => 'Panchayth Name', 'ward_no-2' => 'Ward No', 'contact_person_name-2' => 'Contact Person Name', 'contact_person_mobile_no-2' => 'Contact Person Mobile no');
                                foreach ($files as $x => $x_value) {
                                        if (!empty($x)) {
                                                $values = explode('-', $x);
                                                $field = $values[0];
                                                $table = $values[1];
                                                if ($table == 1) {
                                                        $check = $model;
                                                } else if ($table == 2) {
                                                        $check = $patient_guardian;
                                                }

                                                if (isset($check->$field) && $check->$field != '') {

                                                        $uploaded[] = $x_value;
                                                } else {

                                                        $not_uploaded[] = $x_value;
                                                }
                                        }
                                }

                                $path = Yii::getAlias(Yii::$app->params['uploadPath']) . '/patient/' . $model->id;
                                $patient_uploads = array('Patient Image', 'Guardian Image', 'Diagnosis Report', 'Patient ID Proof', 'Guardian ID Proof');

                                foreach ($patient_uploads as $patient_uploads) {
                                        if (count(glob("{$path}/*")) > 0) {
                                                foreach (glob("{$path}/*") as $file) {
                                                        $arry = explode('/', $file);
                                                        $img_nmee = end($arry);
                                                        $img_nam = explode('.', $img_nmee);
                                                        if ($img_nam[0] != $patient_uploads) {
                                                                $not_uploaded[] = $patient_uploads;
                                                        }
                                                }
                                        } else {
                                                $not_uploaded[] = $patient_uploads;
                                        }
                                }
                        } else if ($type == 2) {
                                $staff_details_first = common\models\StaffEnquiryInterviewFirst::find()->where(['staff_id' => $model->id])->one();
                                $staff_details_second = common\models\StaffEnquiryInterviewThird::find()->where(['staff_id' => $model->id])->one();
                                $staff_other_info = common\models\StaffOtherInfo::find()->where(['staff_id' => $model->id])->one();
                                $staff_family = common\models\StaffEnquiryFamilyDetails::find()->where(['staff_id' => $model->id])->all();
                                $files = array("present_contact_no-1" => "Staff Contact Number", "alternate_number_1-2" => "Staff Alternate Number 1", "alternate_number_2-2" => "Staff Alternate Number 2", "permanent_address-1" => "Permanent Address", "present_address-1" => "Present Address", 'emergency_contact_name-3' => 'Emeregency Contact Name', 'phone-3' => 'Emeregency Contact Phone', 'mobile-3' => 'Emeregency Contact Mobile', 'alt_emergency_contact_name-3' => 'Alternate Emeregency Contact Name', 'alt_phone-3' => 'Alternate Emeregency Contact Phone', 'alt_mobile-3' => 'Alternate Emeregency Contact Mobile', "police_station_name-2" => "Police Station Name", "panchayat-2" => "Panchayat", "bank_ac_no-4" => "Bank A/c Details");

                                foreach ($files as $x => $x_value) {
                                        if (!empty($x)) {
                                                $values = explode('-', $x);
                                                $field = $values[0];
                                                $table = $values[1];
                                                if ($table == 1) {
                                                        $check = $model;
                                                } else if ($table == 2) {
                                                        $check = $staff_details_first;
                                                } else if ($table == 3) {
                                                        $check = $staff_other_info;
                                                } else if ($table == 4) {
                                                        $check = $staff_details_second;
                                                }

                                                if (isset($check->$field) && $check->$field != '') {

                                                        $uploaded[] = $x_value;
                                                } else {

                                                        $not_uploaded[] = $x_value;
                                                }
                                        }
                                }
                                if (count($staff_family) == 0)
                                        $not_uploaded[] = 'Family Details';


                                $path = Yii::getAlias(Yii::$app->params['uploadPath']) . '/staff/' . $model->id;
                                $patient_uploads = array('Profile Image', 'Voter ID', 'Aadhar Card');

                                foreach ($patient_uploads as $patient_uploads) {
                                        if (count(glob("{$path}/*")) > 0) {
                                                foreach (glob("{$path}/*") as $file) {
                                                        $arry = explode('/', $file);
                                                        $img_nmee = end($arry);
                                                        $img_nam = explode('.', $img_nmee);
                                                        if ($img_nam[0] != $patient_uploads) {
                                                                $not_uploaded[] = $patient_uploads;
                                                        }
                                                }
                                        } else {
                                                $not_uploaded[] = $patient_uploads;
                                        }
                                }
                        }
                        ?>

                        <div class="row">
                                <div class="col-md-12">
                                        <?php foreach ($not_uploaded as $value) { ?>
                                                <div class="col-md-6">
                                                        <?= $value ?>
                                                </div>
                                                <div class="col-md-6">
                                                        <spna class="not-uploaded"> x </spna>
                                                </div></br>
                                        <?php } ?>
                                </div>

                        </div>


                </div>
        </div>


</div>



<style>
        .not-uploaded{
                color:red;
        }
</style>

