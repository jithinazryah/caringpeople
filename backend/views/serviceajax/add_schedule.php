<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MasterDesignations;
use yii\helpers\ArrayHelper;
?>


<div class="modal-content add-more-schedules">
        <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="largeModalLabel" style="color: #b60d14;">Add Schedules</h4>
        </div>
        <div class="modal-body">
                <div class="row clearfix">
                        <div class="row" style="margin-left: 0px;">
                                <div class="col-md-6">
                                        <?php
                                        $patient_name = '';
                                        $patient = common\models\PatientGeneral::findOne($service->patient_id);
                                        if (!empty($patient)) {
                                                $patient_name = $patient->first_name;
                                        }
                                        ?>
                                        <label>Patient: </label> <?= $patient_name; ?>
                                </div>
                                <div class="col-md-6">
                                        <?php
                                        $duty_type = '';
                                        if (isset($service->duty_type)) {
                                                if ($service->duty_type == 1) {
                                                        $duty_type = 'Hourly';
                                                } else if ($service->duty_type == 2) {
                                                        $duty_type = 'Visit';
                                                } else if ($service->duty_type == 3) {
                                                        $duty_type = 'Day';
                                                } else if ($service->duty_type == 4) {
                                                        $duty_type = 'Night';
                                                } else if ($service->duty_type == 5) {
                                                        $duty_type = 'Day & Night';
                                                }
                                        }
                                        ?>
                                        <label>Duty Type : </label> <?= $duty_type; ?>
                                </div>


                        </div>


                        <div class="row" style="margin-left: 0px;">
                                <div class="col-md-6">
                                        <?php
                                        $frequency = '';
                                        if (isset($service->frequency)) {
                                                if ($service->frequency == 1) {
                                                        $frequency = 'Daily';
                                                } else if ($service->frequency == 2) {
                                                        $frequency = 'Weekely';
                                                } else if ($service->frequency == 3) {
                                                        $frequency = 'Monthly';
                                                }
                                        }
                                        ?>
                                        <label>Frequency : </label> <?= $frequency; ?>
                                </div>

                                <div class="col-md-6">
                                        <label> No:of days : </label> <?= $service->days; ?>
                                </div>
                        </div>
                        <br>
                        <div class="row" style="margin-left: 0px;">
                                <form id="add-schedules">

                                        <input type="hidden" id="service_id" name="service_id" value="<?= $service->id ?>">
                                        <input type="hidden" id="patient_id" name="patient_id" value="<?= $service->patient_id ?>">
                                        <input type="hidden" id="duty_type" name="duty_type" value="<?= $service->duty_type ?>">
                                        <input type="hidden" id="frequency" name="frequency" value="<?= $service->frequency ?>">
                                        <input type="hidden" id="hours" name="hours" value="<?= $service->hours ?>">
                                        <input type="hidden" id="days" name="days" value="<?= $service->days ?>">

                                        <div class="row" style="margin-left: 0px;">
                                                <div class="col-md-6">
                                                        <label>How many more days you wish to add?     </label>
                                                </div>
                                                <div class="col-md-6">
                                                        <input type="text" name="no_of_days" id="no_of_days" required>
                                                </div>
                                        </div>



                                        <div class="row">
                                                <input type="submit" name="add_schedule" id="add_schedule" value="Add" class="btn btn-primary">
                                        </div>

                                </form>
                        </div>

                </div>
        </div>


</div>


<style>
        .add-more-schedules label{
                color: #000;
                font-weight: bold;
        } #add_schedule{
                float: right;
                margin-right: 55px;
                margin-top: 13px;
                width: 100px;
        }
</style>
