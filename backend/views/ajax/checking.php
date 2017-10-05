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
                                $model = PatientGeneral::findOne($id);
                                $patient_guardian = PatientGuardianDetails::find()->where(['patient_id' => $model->id])->one();
                                $files = array("patient_id-1" => "Patient Id", "first_name-2" => "Guardian Name", "email-1" => "Email", "contact_number-1" => "Contact Number", "police_station_name-2" => "Police Station Name", 'police_station_email-2' => 'Police Station Email', 'panchayath_name-2' => 'Panchayth Name', 'ward_no-2' => 'Ward No', 'contact_person_name-2' => 'Contact Person Name', 'contact_person_mobile_no-2' => 'Contact Person Mobile no');
                                $path = Yii::getAlias(Yii::$app->params['uploadPath']) . '/patient/' . $model->id;
                                $patient_uploads = array('Patient Image', 'Guardian Image', 'Diagnosis Report', 'Patient ID Proof', 'Guardian ID Proof');
                        } else if ($type == 2) {
                                $staff = \common\models\StaffInfo::findOne($id);
                                $staff_details_first = common\models\StaffEnquiryInterviewFirst::find()->where(['staff_id' => $staff->id])->one();
                                $staff_details_second = common\models\StaffEnquiryInterviewThird::find()->where(['staff_id' => $staff->id])->one();
                                $staff_other_info = common\models\StaffOtherInfo::find()->where(['staff_id' => $staff->id])->one();
                                $staff_family = common\models\StaffEnquiryFamilyDetails::find()->where(['staff_id' => $staff->id])->all();
                                $files = array("present_contact_no-3" => "Staff Contact Number", "alternate_number_1-4" => "Staff Alternate Number 1", "alternate_number_2-4" => "Staff Alternate Number 2", "permanent_address-3" => "Permanent Address", "present_address-3" => "Present Address", 'emergency_contact_name-5' => 'Emeregency Contact Name', 'phone-5' => 'Emeregency Contact Phone', 'mobile-5' => 'Emeregency Contact Mobile', 'alt_emergency_contact_name-5' => 'Alternate Emeregency Contact Name', 'alt_phone-5' => 'Alternate Emeregency Contact Phone', 'alt_mobile-5' => 'Alternate Emeregency Contact Mobile', "police_station_name-4" => "Police Station Name", "panchayat-4" => "Panchayat", "bank_ac_no-6" => "Bank A/c Details");


                                $path = Yii::getAlias(Yii::$app->params['uploadPath']) . '/staff/' . $staff->id;
                                $patient_uploads = array('Profile Image', 'Voter ID', 'Aadhar Card');
                        }
                        foreach ($files as $x => $x_value) {
                                if (!empty($x)) {
                                        $values = explode('-', $x);
                                        $field = $values[0];
                                        $table = $values[1];
                                        if ($table == 1) {
                                                $check = $model;
                                        } else if ($table == 2) {
                                                $check = $patient_guardian;
                                        } else if ($table == 3) {
                                                $check = $staff;
                                        } else if ($table == 4) {
                                                $check = $staff_details_first;
                                        } else if ($table == 5) {
                                                $check = $staff_other_info;
                                        } else if ($table == 6) {
                                                $check = $staff_details_second;
                                        }

                                        if (isset($check->$field) && $check->$field != '') {

                                                $uploaded[] = $x_value;
                                        } else {

                                                $not_uploaded[] = $x_value;
                                        }
                                }
                        }

                        if ($type == 2) {
                                if (count($staff_family) == 0)
                                        $not_uploaded[] = 'Family Details';
                        }

                        foreach ($patient_uploads as $patient_uploads) {
                                if (count(glob("{$path}/*")) > 0) {
                                        $s = 0;
                                        foreach (glob("{$path}/*") as $file) {
                                                $s++;

                                                $arry = explode('/', $file);
                                                $img_nmee = end($arry);
                                                $img_nam = explode('.', $img_nmee);


                                                if ($img_nam[0] != $patient_uploads) {
                                                        if (!in_array($patient_uploads, $not_uploaded)) {

                                                                $not_uploaded[$patient_uploads] = $patient_uploads;
                                                        }
                                                } else {
                                                        $not_uploaded[$patient_uploads] = 0;
                                                }
                                        }
                                } else {
                                        $not_uploaded[] = $patient_uploads;
                                }
                        }
                        ?>

                        <div class="row">
                                <div class="col-md-12">
                                        <?php
                                        foreach ($not_uploaded as $value) {

                                                if (!empty($value)) {
                                                        ?>
                                                        <div class="col-md-6">
                                                                <?= $value ?>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <spna style='color: red'>x</spna>
                                                        </div></br>
                                                        <?php
                                                }
                                        }
                                        exit;
                                        ?>
                                </div>

                        </div>


                </div>
        </div>


</div>





