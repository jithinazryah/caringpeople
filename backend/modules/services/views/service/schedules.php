<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Service */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-form form-inline">



        <div class="row">

                <div class="col-md-12">

                        <div class="panel-group" id="accordion-test-2">
                                <div class="panel panel-default collapse-patient-details">
                                        <div class="panel-heading collapse-patient-heading">
                                                <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" class="collapsed">
                                                                Patient Details
                                                        </a>
                                                </h4>
                                        </div>
                                        <div id="collapseOne-2" class="panel-collapse collapse patient-details-content">
                                                <div class="panel-body">
                                                        <div class="row">
                                                                <div class="col-md-6">
                                                                        <h4>Patient Details</h4>

                                                                        <div class="row">
                                                                                <div class="col-md-6">
                                                                                        <label for="patient_name">Patient Name</label>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                        <span>Ammini Menon</span>
                                                                                </div>
                                                                        </div>

                                                                        <div class="row">
                                                                                <div class="col-md-6">
                                                                                        <label for="patient_name">Gender</label>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                        <span>Female</span>
                                                                                </div>
                                                                        </div>

                                                                        <div class="row">
                                                                                <div class="col-md-6">
                                                                                        <label for="patient_name">Age</label>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                        <span>60</span>
                                                                                </div>
                                                                        </div>

                                                                        <div class="row">
                                                                                <div class="col-md-6">
                                                                                        <label for="patient_name">Conatct Number</label>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                        <span>9876543210</span>
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
                                                                                        <span>Nursing Care</span>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>




                        </div>

                </div>







                <table id="example-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                                <tr>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Remarks from manager</th>
                                        <th>Remarks from staff</th>
                                        <th>Remarks from patient</th>
                                        <th>Attendance</th>
                                        <th>Status</th>

                                </tr>
                        </thead>



                        <tbody>
                                <?php
                                $p = 0;
                                foreach ($service_schedule as $value) {


                                        $p++;
                                        ?>
                                        <tr id="<?= $value->id; ?>">
                                                <td><?= $p; ?></td>

                                                <td><?php
                                                        if (isset($value->date) && $value->date != '') {
                                                                $date = date('d-m-Y', strtotime($value->date));
                                                                //$date = date('Y/m/d', strtotime($value->date));
                                                        } else {
                                                                $date = '';
                                                        }
                                                        echo DatePicker::widget([
                                                            'name' => 'date',
                                                            'id' => 'schedule_date-' . $value->id,
                                                            'type' => DatePicker::TYPE_INPUT,
                                                            'value' => $date,
                                                            'pluginOptions' => [
                                                                'autoclose' => true,
                                                                'format' => 'dd-mm-yyyy',
                                                            ],
                                                            'options' => [
                                                                'class' => 'schedule-update-date',
                                                            ]
                                                        ]);
                                                        ?>
                                                </td>


                                                <td>
                                                        <input type="text" class="form-control schedule-update" name="remarks_from_manager" id="remarks_from_manager-<?= $value->id; ?>" value="<?php
                                                        if (isset($value->remarks_from_manager) && $value->remarks_from_manager != '') {
                                                                echo $value->remarks_from_manager;
                                                        }
                                                        ?>">
                                                </td>


                                                <td>
                                                        <input type="text" class="form-control schedule-update" name="remarks_from_staff" id="remarks_from_staff-<?= $value->id; ?>" value="<?php
                                                        if (isset($value->remarks_from_staff) && $value->remarks_from_staff != '') {
                                                                echo $value->remarks_from_staff;
                                                        }
                                                        ?>">
                                                </td>


                                                <td>
                                                        <input type="text" class="form-control schedule-update" name="remarks_from_patient" id="remarks_from_patient-<?= $value->id; ?>" value="<?php
                                                        if (isset($value->remarks_from_patient) && $value->remarks_from_patient != '') {
                                                                echo $value->remarks_from_patient;
                                                        }
                                                        ?>">
                                                </td>


                                                <td>
                                                        <select name="attendance" id="attendance-<?= $value->id ?>" class="form-control schedule-update">
                                                                <option value="1" <?php
                                                                if ($value->attendance == '1') {
                                                                        echo 'selected';
                                                                }
                                                                ?>> Present</option>
                                                                <option value="2" <?php
                                                                if ($value->attendance == '2') {
                                                                        echo 'selected';
                                                                }
                                                                ?>> Half Day</option>
                                                                <option value="3" <?php
                                                                if ($value->attendance == '3') {
                                                                        echo 'selected';
                                                                }
                                                                ?>> Absent</option>
                                                                <option value="4" <?php
                                                                if ($value->attendance == '4') {
                                                                        echo 'selected';
                                                                }
                                                                ?>> Day Off</option>
                                                        </select>
                                                </td>


                                                <td>
                                                        <select name="status" id="status-<?= $value->id; ?>" class="form-control schedule-update">

                                                                <option value="1" <?php
                                                                if ($value->status == '1') {
                                                                        echo 'selected';
                                                                }
                                                                ?>>Pending</option>
                                                                <option value="2" <?php
                                                                if ($value->status == '2') {
                                                                        echo 'selected';
                                                                }
                                                                ?>>Confirmed</option>
                                                                <option value="3" <?php
                                                                if ($value->status == '3') {
                                                                        echo 'selected';
                                                                }
                                                                ?>>Completed</option>
                                                                <option value="4" <?php
                                                                if ($value->status == '4') {
                                                                        echo 'selected';
                                                                }
                                                                ?>>Interrupted</option>
                                                                <option value="5" <?php
                                                                if ($value->status == '5        ') {
                                                                        echo 'selected';
                                                                }
                                                                ?>>Cancelled</option>
                                                        </select>
                                                </td>


                                        </tr>
                                <?php } ?>


                        </tbody>
                </table>

        </div>




</div>
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>js/table/dataTables.bootstrap.css">
<script src="<?= Yii::$app->homeUrl; ?>js/table/jquery.dataTables.min.js"></script>

<script src="<?= Yii::$app->homeUrl; ?>js/table/dataTables.bootstrap.js"></script>
<script src="<?= Yii::$app->homeUrl; ?>js/table/jquery.dataTables.yadcf.js"></script>
<script src="<?= Yii::$app->homeUrl; ?>js/table/dataTables.tableTools.min.js"></script>
<script type="text/javascript">
        $(document).ready(function ($)
        {
                $("#example-1").dataTable({
                        aLengthMenu: [
                                [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]
                        ]
                });
        });
</script>

<style>
        .form-control{
                border: none;
        }
        select[name="example-1_length"]{
                width: 75px !important;
        }
        .collapse-patient-heading{
                background: #6a9ea4 !important;
                padding: 10px !important;
                color: #FFF !important;
        } .collapse-patient-details{
                padding: 9px 30px !important;
        }
        .collapse-patient-heading h4{
                color: #FFF !important;
        }
        .patient-details-content label{
                color: #555;
                font-weight: bold;
        }
</style>