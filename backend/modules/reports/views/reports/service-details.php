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
                <div class="panel-body">
                    <div class="attendance-create">

                        <!-------------------------------------------------REPORT----------------------------------------------------------------------------->
                        <?php if (!empty($services) && $services != '') { ?>


                            <div class="counts1" >
                                <p style="font-size:14px;margin:0;text-transform: uppercase">
                                    <span><?php
                                        if (isset($patient_id) && $patient_id != '') {
                                            $patient_details = common\models\PatientGeneral::findOne($patient_id);
                                            echo $patient_details->first_name ;
                                        }
                                        ?></span>
                                    <br>
                                    <label style="font-size:12px;margin-top:5px;">( <?= date('d-m-Y', strtotime($from)); ?> to <?= date('d-m-Y', strtotime($to)); ?> )</label>
                                </p>
                            </div>





                            <div class = "table-responsive">

                                <table class = "table table-striped">
                                    <thead>
                                    <th>NO</th>
                                    <th>SERVICE ID</th>
                                    <th>AMOUNT</th>


                                    </thead>

                                    <tbody>
                                        <?php
                                        $l = 0;
                                        foreach ($services as $values) {
                                            $value= common\models\Service::findOne($values->service_id);
                                            $total_amount += $value->due_amount;
                                            $l++;
                                            ?>
                                            <tr>
                                                <td><?= $l; ?></td>
                                                <td><?= $value->service_id; ?></td>
                                                <td><?php echo Yii::$app->NumToWord->NumberFormat($value->due_amount)?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>

                                            <tr>
                                                <td></td>
                                                <td><b>TOTAL</b></td>
                                            <td ><?php echo Yii::$app->NumToWord->NumberFormat($total_amount)?></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                            <?php
                        } else {
                           // if (isset($model->staff) && $model->staff != '') {
                                echo '<p class="no-result">No results found !!</p>';
                           // }
                        }
                        ?>



                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<style>

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