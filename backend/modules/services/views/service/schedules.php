<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use common\models\StaffInfo;

/* @var $this yii\web\View */
/* @var $model common\models\Service */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-form form-inline">
        <div class="row">
                <a href="javascript:;"  class="btn btn-primary btn-single btn-sm xtra-btn choose-staff" id="<?= $model->id; ?>">Choose Staff</a>
                <a href="javascript:;"  class="btn btn-primary btn-single btn-sm xtra-btn add-schedules" id="<?= $model->id; ?>">Add Schedules</a>

        </div>

        <div class="row">

                <?=
                $this->render('_patient_details', [
                    'model' => $model,
                ])
                ?>

        </div>

        <table id="example-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                        <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Staff on duty</th>
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
                                                <?php
                                                if (isset($value->staff)) {
                                                        $staff = StaffInfo::findOne($value->staff);
                                                        $staff_on_duty = $staff->staff_name;
                                                } else {
                                                        $staff_on_duty = '';
                                                }
                                                ?>

                                                <input type="text" value="<?= $staff_on_duty; ?>" name="staff_on_duty" class="form-control staff_duty_<?= $value->service_id; ?>" id="staff_on_duty_<?= $value->id ?>" readonly="true">
                                                <?php if ($staff_on_duty != '') { ?>  <a id="<?= $value->id; ?>" type="1" class="staff-allotment replace-staff">Replace staff</a><?php } else { ?>
                                                        <a id="<?= $value->id; ?>" type="2" class="staff-allotment replace-staff">Add staff</a>
                                                <?php } ?>
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
                background: #b4bec6 !important;
                padding: 10px !important;
                color: #FFF !important;
        } .collapse-patient-details{
                padding: 0px 9px !important;
                margin-top: 15px;
        }
        .collapse-patient-heading h4{
                /*                color: #FFF !important;*/
        }
        .patient-details-content label{
                color: #555;
                font-weight: bold;
        }
        .patient-details-specific .row{
                margin-left: 0px !important;;
        }.xtra-btn{
                float: right;
                background: #ff9600 !important;
                border-radius: 5px;
                width: 100px;
                height: 35px;
                padding: 7px;
                float: right;
                margin-right: 8px;
        } .xtra-btn:hover{
                border: none;
        } .staff-allotment{
                float:right;
                color:#0e62c7;
                cursor: pointer;
        }

</style>