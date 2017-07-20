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
                <?php
                $staff_set = \common\models\ServiceSchedule::find()->where(['not', ['staff' => null]])->andWhere(['service_id' => $model->id])->count();
                ?>

                <a href="<?= Yii::$app->homeUrl ?>/staff/staff-info/choose?branch=<?= $model->branch_id; ?>&&gender=<?= $model->gender_preference; ?>&&service=<?= $model->id; ?>&&type=1" target="_blank"  class="btn btn-primary btn-single btn-sm xtra-btn" id="<?= $model->id; ?>"><?php
                        if ($staff_set == 0) {
                                echo 'Choose Staff';
                        } else {
                                echo 'Change Staff';
                        }
                        ?></a>
                <a href="javascript:;"  class="btn btn-primary btn-single btn-sm xtra-btn add-schedules" id="<?= $model->id; ?>">Add Schedules</a>

        </div>

        <div class="row">

                <?=
                $this->render('_patient_details', [
                    'model' => $model,
                ])
                ?>

        </div>

        <div class="table-responsive">

                <table id="example-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                                <tr>
                                        <th style="width:10px;">No</th>
                                        <th>Date</th>
                                        <th>Staff on duty</th>
                                        <th>Remarks from manager</th>
                                        <th>Remarks from staff</th>
                                        <th>Remarks from patient</th>

                                        <th>Status</th>
                                        <th>Staff Rating</th>
                                </tr>
                        </thead>


                        <tbody>
                                <?php
                                $p = 0;
                                foreach ($service_schedule as $value) {
                                        $p++;
                                        ?>
                                        <tr id="<?= $value->id; ?>" style="text-align:center">
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
                                                        if (isset($value->status) && $value->status != '') {
                                                                if ($value->status == 2) {
                                                                        $stat = 1;
                                                                } else {
                                                                        $stat = 0;
                                                                }
                                                        } else {
                                                                $stat = 0;
                                                        }
                                                        ?>

                                                        <input type="text" val='<?= $value->staff ?>' value="<?= $staff_on_duty; ?>" name="staff_on_duty" class="form-control staff_duty_<?= $value->service_id; ?>_<?= $stat ?>" id="staff_on_duty_<?= $value->id ?>" readonly="true">
                                                        <?php if ($staff_on_duty != '') { ?>  <a target="_blank"  href="<?= Yii::$app->homeUrl ?>/staff/staff-info/choose?branch=<?= $model->branch_id; ?>&&gender=<?= $model->gender_preference; ?>&&service=<?= $model->id; ?>&&type=2&&schedule=<?= $value->id; ?>" id="<?= $value->id; ?>" type="1" class="staff-allotment">Replace staff</a><?php } else { ?>
                                                                <a target="_blank"  href="<?= Yii::$app->homeUrl ?>/staff/staff-info/choose?branch=<?= $model->branch_id; ?>&&gender=<?= $model->gender_preference; ?>&&service=<?= $model->id; ?>&&type=2&&schedule=<?= $value->id; ?>" id="<?= $value->id; ?>" type="2" class="staff-allotment">Add staff</a>
                                                        <?php } ?>
                                                </td>


                                                <td>
                                                        <textarea class="form-control schedule-update" name="remarks_from_manager" id="remarks_from_manager-<?= $value->id; ?>"><?php
                                                                if (isset($value->remarks_from_manager) && $value->remarks_from_manager != '') {
                                                                        echo $value->remarks_from_manager;
                                                                }
                                                                ?>
                                                        </textarea>
                                                </td>


                                                <td>

                                                        <textarea class="form-control schedule-update" name="remarks_from_staff" id="remarks_from_staff-<?= $value->id; ?>">
                                                                <?php
                                                                if (isset($value->remarks_from_staff) && $value->remarks_from_staff != '') {
                                                                        echo $value->remarks_from_staff;
                                                                }
                                                                ?>
                                                        </textarea>
                                                </td>


                                                <td>

                                                        <textarea class="form-control schedule-update" name="remarks_from_patient" id="remarks_from_patient-<?= $value->id; ?>">
                                                                <?php
                                                                if (isset($value->remarks_from_patient) && $value->remarks_from_patient != '') {
                                                                        echo $value->remarks_from_patient;
                                                                }
                                                                ?>
                                                        </textarea>
                                                </td>



                                                <td>
                                                        <select name="status" id="status_<?= $value->id; ?>" class="form-control schedule-update status-update">

                                                                <option value="1" <?php
                                                                if ($value->status == '1') {
                                                                        echo 'selected';
                                                                }
                                                                ?>>Pending</option>

                                                                <option value="2" <?php
                                                                if ($value->status == '2') {
                                                                        echo 'selected';
                                                                }
                                                                ?>>Completed</option>
                                                                <option value="3" <?php
                                                                if ($value->status == '3') {
                                                                        echo 'selected';
                                                                }
                                                                ?>>Interrupted</option>
                                                                <option value="4" <?php
                                                                if ($value->status == '4') {
                                                                        echo 'selected';
                                                                }
                                                                ?>>Cancelled</option>
                                                        </select>
                                                </td>
                                                <td>
                                                        <select class="form-control schedule-rating" id="<?= $value->id; ?>">
                                                                <option value="">-Select Rating-</option>
                                                                <option value="9" <?php
                                                                if ($value->rating == '9') {
                                                                        echo 'selected';
                                                                }
                                                                ?>>Excellent</option>
                                                                <option value="8" <?php
                                                                if ($value->rating == '8') {
                                                                        echo 'selected';
                                                                }
                                                                ?>>Very Good</option>
                                                                <option value="7" <?php
                                                                if ($value->rating == '7') {
                                                                        echo 'selected';
                                                                }
                                                                ?>>Satisfactory</option>
                                                                <option value="6" <?php
                                                                if ($value->rating == '6') {
                                                                        echo 'selected';
                                                                }
                                                                ?>>Good</option>
                                                                <option value="5" <?php
                                                                if ($value->rating == '5') {
                                                                        echo 'selected';
                                                                }
                                                                ?>>Average</option>
                                                                <option value="4" <?php
                                                                if ($value->rating == '4') {
                                                                        echo 'selected';
                                                                }
                                                                ?>>Unsatisfactory</option>
                                                                <option value="3" <?php
                                                                if ($value->rating == '3') {
                                                                        echo 'selected';
                                                                }
                                                                ?>>Bad</option>
                                                                <option value="2" <?php
                                                                if ($value->rating == '2') {
                                                                        echo 'selected';
                                                                }
                                                                ?>>Very Bad</option>
                                                                <option value="1" <?php
                                                                if ($value->rating == '1') {
                                                                        echo 'selected';
                                                                }
                                                                ?>>Very Poor</option>
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
        table td{
                padding: 0 !important;
        }
        table td .sorting_1{
                text-align: center !important;
        }

</style>