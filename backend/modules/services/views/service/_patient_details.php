<?php

use yii\helpers\Html;
?>


<div class="panel-group" id="accordion-test-2">
        <div class="panel panel-default collapse-patient-details">
                <div class="panel-heading collapse-patient-heading">
                        <h4 class="panel-title panel-default">
                                <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" class="collapsed">
                                        Patient Details
                                </a>
                        </h4>
                </div>
                <div id="collapseOne-2" class="panel-collapse collapse patient-details-content">
                        <div class="panel-body">
                                <div class="row patient-details-specific">
                                        <div class="col-md-6">
                                                <h4>Patient Details</h4>

                                                <div class="row">
                                                        <div class="col-md-6">
                                                                <label for="patient_name">Patient Name</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <span><?= $model->patient->first_name; ?></span>
                                                        </div>
                                                </div>

                                                <div class="row">
                                                        <div class="col-md-6">
                                                                <label for="patient_name">Gender</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <span><?php
                                                                        if (isset($model->patient->gender)) {
                                                                                if ($model->patient->first_name == 0) {
                                                                                        echo 'Male';
                                                                                } else if ($model->patient->first_name == 1) {
                                                                                        echo 'Female';
                                                                                }
                                                                        }
                                                                        ?></span>
                                                        </div>
                                                </div>

                                                <div class="row">
                                                        <div class="col-md-6">
                                                                <label for="patient_name">Age</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <span><?= $model->patient->age; ?></span>
                                                        </div>
                                                </div>

                                                <div class="row">
                                                        <div class="col-md-6">
                                                                <label for="patient_name">Conatct Number</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <span><?= $model->patient->contact_number; ?></span>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="col-md-6">
                                                <h4>Service Details</h4>
                                                <div class="row">
                                                        <div class="col-md-6">
                                                                <label for="patient_name">Service Required</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <span><?= $model->service0->service_name; ?> </span>
                                                        </div>
                                                </div>

                                                <div class="row">
                                                        <div class="col-md-6">
                                                                <label for="patient_name">Staff Manager</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <span><?= $model->staffManager->staff_name; ?></span>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>


