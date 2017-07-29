<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use common\models\Branch;
use common\models\MasterAttendanceType;
use common\models\StaffInfo;
use common\models\AttendanceEntry;

$this->title = 'Patient Report';
$this->params['breadcrumbs'][] = ['label' => 'Attendances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                        </div>

                        <div class="panel-body">
                                <div class="panel-body"><div class="attendance-create">


                                                <div class="attendance-form form-inline">
                                                        <?php $form = ActiveForm::begin(); ?>
                                                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                                <?=
                                                                DatePicker::widget([
                                                                    'model' => $model,
                                                                    'form' => $form,
                                                                    'type' => DatePicker::TYPE_INPUT,
                                                                    'attribute' => 'date',
                                                                    'pluginOptions' => [
                                                                        'autoclose' => true,
                                                                        'format' => 'dd-mm-yyyy',
                                                                    ]
                                                                ]);
                                                                ?>
                                                        </div>


                                                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                                <?=
                                                                DatePicker::widget([
                                                                    'model' => $model,
                                                                    'form' => $form,
                                                                    'type' => DatePicker::TYPE_INPUT,
                                                                    'attribute' => 'DOC',
                                                                    'pluginOptions' => [
                                                                        'autoclose' => true,
                                                                        'format' => 'dd-mm-yyyy',
                                                                        "endDate" => (string) date('d/m/Y'),
                                                                    ]
                                                                ]);
                                                                ?>


                                                        </div>

                                                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                                <?php $branch = Branch::Branch();
                                                                ?>
                                                                <?= $form->field($model, 'rating')->dropDownList(ArrayHelper::map($branch, 'id', 'branch_name'), ['prompt' => '--Select--', 'id' => 'report-patient-branch']); ?>
                                                        </div>


                                                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                                <?php
                                                                if (isset($model->rating)) {
                                                                        $patients = \common\models\PatientGeneral::find()->where(['branch_id' => $model->rating, 'status' => 1])->all();
                                                                } else {
                                                                        $patients = [];
                                                                }
                                                                ?>
                                                                <?= $form->field($model, 'patient_id')->dropDownList(ArrayHelper::map($patients, 'id', 'first_name'), ['prompt' => '--Select--', 'id' => 'report-patient']) ?>
                                                        </div>


                                                        <div class='col-md-3 col-sm-6 col-xs-12' >
                                                                <div class="form-group" >
                                                                        <?= Html::submitButton($model->isNewRecord ? 'Search' : 'Search', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                                                                </div>
                                                        </div>

                                                        <?php ActiveForm::end(); ?>
                                                </div>

                                                <div style="clear:both"></div>

                                                <!-------------------------------------------------REPORT----------------------------------------------------------------------------->
                                                <?php if (!empty($report) && $report != '') { ?>

                                                        <div class="row">
                                                                <div class="col-md-6 col-sm-6 col-xs-12 left_padd counts1" >
                                                                        <p>
                                                                                Patient : <span><?php
                                                                                        if (isset($model->patient_id) && $model->patient_id != '') {
                                                                                                $patient_detail = \common\models\PatientGeneral::findOne($model->patient_id);
                                                                                                echo $patient_detail->first_name;
                                                                                        }
                                                                                        ?></span>
                                                                        </p>
                                                                </div>

                                                                <div class="col-md-6 col-sm-6 col-xs-12 left_padd counts">
                                                                        <p>
                                                                                Total Schedules &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   :  &nbsp;<span> <?= count($report); ?><br></span>
                                                                                Completed Schedules :  &nbsp;<span><?= $completed ?> <br></span>
                                                                        </p>
                                                                </div>
                                                        </div>


                                                        <div class = "table-responsive">
                                                                <table id="example-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                                        <thead>
                                                                        <th>NO</th>
                                                                        <th>DATE</th>
                                                                        <th>SERVICE</th>
                                                                        <th>STAFF</th>
                                                                        <th>REMARKS</th>
                                                                        <th>TIME IN</th>
                                                                        <th>TIME OUT</th>
                                                                        <th>RATE</th>
                                                                        <th>STATUS</th>


                                                                        </thead>

                                                                        <tbody>
                                                                                <?php
                                                                                $k = 0;
                                                                                foreach ($report as $value) {
                                                                                        $k++;
                                                                                        ?>
                                                                                        <tr>
                                                                                                <td><?= $k; ?></td>

                                                                                                <td><?= date('d-m-Y', strtotime($value->date)) ?></td>

                                                                                                <?php $service = common\models\Service::findOne($value->service_id) ?>
                                                                                                <td><?= $service->service_id ?></td>

                                                                                                <td><?php
                                                                                                        if (isset($value->staff) && $value->staff != '') {
                                                                                                                $staff = StaffInfo::findOne($value->staff);
                                                                                                                echo $staff->staff_name;
                                                                                                        }
                                                                                                        ?>
                                                                                                </td>

                                                                                                <td>
                                                                                                        <?php
                                                                                                        if (isset($value->remarks_from_manager) && $value->remarks_from_manager != '') {
                                                                                                                echo $value->remarks_from_manager;
                                                                                                        }
                                                                                                        ?>
                                                                                                </td>

                                                                                                <td>
                                                                                                        <?php
                                                                                                        if (isset($value->time_in) && $value->time_in != '') {
                                                                                                                echo $value->time_in;
                                                                                                        }
                                                                                                        ?>
                                                                                                </td>

                                                                                                <td>
                                                                                                        <?php
                                                                                                        if (isset($value->time_out) && $value->time_out != '') {
                                                                                                                echo $value->time_out;
                                                                                                        }
                                                                                                        ?>
                                                                                                </td>

                                                                                                <td>
                                                                                                        <?php
                                                                                                        if (isset($value->rate) && $value->rate != '') {
                                                                                                                echo $value->rate;
                                                                                                        }
                                                                                                        ?>
                                                                                                </td>

                                                                                                <td><?php if ($value->status == 2) { ?>
                                                                                                                <i class="fa fa-check present" aria-hidden="true"></i>
                                                                                                                <?php
                                                                                                        } else {
                                                                                                                if ($value->status == 1) {
                                                                                                                        $status = 'Pending';
                                                                                                                } else if ($value->status == 3) {
                                                                                                                        $status = 'Interrupted';
                                                                                                                } else if ($value->status == 4) {
                                                                                                                        $status = 'Cancelled';
                                                                                                                } else {
                                                                                                                        $status = '';
                                                                                                                }
                                                                                                                ?>
                                                                                                                <a title="<?= $status ?>"><i class="fa fa-times absent" aria-hidden="true"></i></a>
                                                                                                        <?php } ?>
                                                                                                </td>

                                                                                        </tr>
                                                                                <?php } ?>

                                                                        </tbody>
                                                                </table>
                                                        </div>

                                                        <?php
                                                } else {
                                                        if (isset($model->staff) && $model->staff != '') {
                                                                echo '<p class="no-result">No results found !!</p>';
                                                        }
                                                }
                                                ?>


                                        </div>

                                </div>
                        </div>
                </div>
        </div>
</div>


<style>
        .form-control{
                border: none;
        }.table-responsive{
                border: none;
        }
        select[name="example-1_length"]{
                width: 75px !important;
        }
        .dataTables_wrapper .table thead>tr .sorting:before, .dataTables_wrapper .table thead>tr .sorting_asc:before, .dataTables_wrapper .table thead>tr .sorting_desc:before{
                display: none;
        }#example-1_filter{
                display: none;
        }
        .present{
                color: green;
        }
        .absent{
                color: red;
        }.counts p{
                float: right;
                line-height: 25px;
                color: #000;
        }.counts span,.counts1 span{
                font-weight: bold;
                color: #000;
        }.counts1 p{
                margin-left: 20px;
                color: #000;
        }.table-responsive{
                margin-top: 15px;
        }.no-result{
                text-align: center;
                font-style: italic;
        }
</style>
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
                                [20, 50, 100, -1], [20, 50, 100, "All"]
                        ]
                });
        });
</script>