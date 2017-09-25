<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use common\models\Branch;
use common\models\MasterAttendanceType;
use common\models\StaffInfo;
use common\models\AttendanceEntry;
use kartik\export\ExportMenu;
use yii\helpers\Url;

$this->title = 'Staff Report';
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


                                                <div class="row">
                                                        <div class="col-md-6 col-sm-6 col-xs-12 left_padd counts1" >

                                                                <div class="col-md-6">

                                                                        <p>Staff Id:
                                                                                <span><?php
                                                                                        if (isset($staff) && $staff != '') {
                                                                                                $staff_details = StaffInfo::findOne($staff);
                                                                                                echo $staff_details->staff_id;
                                                                                        }
                                                                                        ?>
                                                                                </span>
                                                                        </p>

                                                                        <p>Staff Name:
                                                                                <span><?php
                                                                                        if (isset($staff) && $staff != '') {
                                                                                                $staff_details = StaffInfo::findOne($staff);
                                                                                                echo $staff_details->staff_name;
                                                                                        }
                                                                                        ?>
                                                                                </span>
                                                                        </p>

                                                                        <br>
                                                                        <p> Total Amount : <span><?= 'Rs. ' . $staff_amount . ' /-' ?></span></p>

                                                                        <label style="font-size:12px;margin-top:15px;color: #000;margin-left: 15px;">( <?= date('d-m-Y', strtotime($from)); ?> to <?= date('d-m-Y', strtotime($to)); ?> )</label>
                                                                </div>
                                                        </div>




                                                </div>


                                                <div class = "table-responsive">

                                                        <?php
                                                        $gridColumns = [
                                                                ['class' => 'yii\grid\SerialColumn'],
                                                                [
                                                                'attribute' => 'date',
                                                                'value' => function($data) {
                                                                        if (isset($data->date))
                                                                                return date('d-m-Y', strtotime($data->date));
                                                                },
                                                                'filter' => '',
                                                            ],
                                                                [
                                                                'attribute' => 'service_id',
                                                                'value' => function($model) {
                                                                        return $model->service->service_id;
                                                                },
                                                                'filter' => '',
                                                            ],
                                                                [
                                                                'attribute' => 'patient_id',
                                                                'value' => function($model) {
                                                                        if (isset($model->patient_id)) {
                                                                                $patient = \common\models\PatientGeneral::findOne($model->patient_id);
                                                                                return $patient->first_name;
                                                                        }
                                                                },
                                                                'filter' => '',
                                                            ],
                                                                [
                                                                'attribute' => 'rate',
                                                                'filter' => '',
                                                            ],
                                                        ];
                                                        if (Yii::$app->user->identity->post_id == '1') {
                                                                echo ExportMenu::widget([
                                                                    'dataProvider' => $dataProvider,
                                                                    'columns' => $gridColumns,
                                                                ]);
                                                        }
                                                        echo \kartik\grid\GridView::widget([
                                                            'dataProvider' => $dataProvider,
                                                            'filterModel' => $searchModel,
                                                            'columns' => $gridColumns,
                                                        ]);
                                                        ?>
                                                </div>





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
        }.no-result{
                text-align: center;
                font-style: italic;
        }
</style>