<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\StaffInfo;
use yii\helpers\ArrayHelper;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Services';
$this->params['breadcrumbs'][] = $this->title;
$designations = \common\models\MasterDesignations::designationlist();
?>
<div class="service-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">



                                        <?php if (Yii::$app->session->hasFlash('error')): ?>
                                                <div class="alert alert-danger" role="alert">
                                                        <?= Yii::$app->session->getFlash('error') ?>
                                                </div>
                                        <?php endif; ?>
                                        <?php if (Yii::$app->session->hasFlash('success')): ?>
                                                <div class="alert alert-success" role="alert">
                                                        <?= Yii::$app->session->getFlash('success') ?>
                                                </div>
                                        <?php endif; ?>
                                        <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

                                        <?= Html::a('<i class="fa-th-list"></i><span> Create Service</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                        <?= Html::a("<i class='fa fa-book'></i><span> Today's Schedules</span>", ['todayschedules'], ['target' => '_blank', 'class' => 'btn btn-info  btn-icon btn-icon-standalone', 'style' => 'float:right', 'id' => 'today_schedule']) ?>
                                        <?php
                                        $gridColumns = [
                                                ['class' => 'yii\grid\SerialColumn'],
                                            'service_id',
                                                [
                                                'attribute' => 'patient_id',
                                                'value' => 'patient.first_name',
                                                'filter' => ArrayHelper::map(common\models\PatientGeneral::find()->where(['status' => '1'])->orderBy(['first_name' => SORT_ASC])->asArray()->all(), 'id', 'first_name'),
                                                'filterOptions' => array('id' => "patient_name_search"),
                                            ],
                                                [
                                                'attribute' => 'service',
                                                'value' => 'service0.service_name',
                                                'filter' => ArrayHelper::map(common\models\MasterServiceTypes::find()->where(['status' => '1'])->orderBy(['service_name' => SORT_ASC])->asArray()->all(), 'id', 'service_name'),
                                            ],
                                                [
                                                'attribute' => 'duty_type',
                                                'value' => function($model) {
                                                        if ($model->duty_type == '1') {
                                                                return 'Hourly';
                                                        } else if ($model->duty_type == '2') {
                                                                return 'Visit';
                                                        } else if ($model->duty_type == '3') {
                                                                return 'Day';
                                                        } else if ($model->duty_type == '4') {
                                                                return 'Night';
                                                        } else if ($model->duty_type == '5') {
                                                                return 'Day & Night';
                                                        }
                                                },
                                                'filter' => [1 => 'Hourly', 2 => 'Visit', 3 => 'Day', 4 => 'Night', 5 => 'Day & Night'],
                                            ],
                                                [
                                                'attribute' => 'branch_id',
                                                'value' => 'branch.branch_name',
                                                'filter' => ArrayHelper::map(common\models\Branch::find()->where(['status' => '1'])->asArray()->all(), 'id', 'branch_name'),
                                            ],
                                                [
                                                'attribute' => 'status',
                                                'value' => function($model, $key, $index, $column) {
                                                        if ($model->status == 1) {
                                                                return 'Opened';
                                                        } else if ($model->status == 2) {
                                                                return 'Closed';
                                                        } else if ($model->status == 3) {
                                                                return 'Advanced';
                                                        }
                                                },
                                                'filter' => [1 => 'Opened', 2 => 'Closed', 3 => 'Advanced'],
                                            ],
                                                [
                                                'attribute' => 'pending_schedules',
                                                'label' => Yii::t('app', 'Pending Schedules'),
                                                'format' => 'raw',
                                                'value' => function ($model) {
                                                        return $model->PendingSchedules($model->id);
                                                }
                                            ],
                                            //'staff_id',
                                            // 'staff_manager',
                                            // 'from_date',
                                            // 'to_date',
                                            // 'estimated_price_per_day',
                                            // 'estimated_price',
                                            // 'status',
                                            // 'CB',
                                            // 'UB',
                                            // 'DOC',
                                            // 'DOU',
                                            ['class' => 'yii\grid\ActionColumn',
                                                'template' => '{update}{delete}',
                                                'visibleButtons' => [
                                                    'delete' => function ($model, $key, $index) {
                                                            return Yii::$app->user->identity->post_id != '1' ? false : true;
                                                    },
                                                ],
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
                                            'rowOptions' => function($model) {
                                                    if ($model->due_amount <= 0) {
                                                            return ['class' => 'amount_paid'];
                                                    }
                                            },
                                        ]);
                                        ?>


                                </div>
                        </div>
                </div>
        </div>
</div>

<script>
        $(document).ready(function () {
                $('#staff_name_search select').attr('id', 'staff_name');
                $('#patient_name_search select').attr('id', 'patient_name');
                $("#staff_name").select2({
                        placeholder: '',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        // Adding Custom Scrollbar
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });
                $("#patient_name").select2({
                        placeholder: '',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        // Adding Custom Scrollbar
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });
        });
</script>

<style>
        #patient_name_search{
                width: 17%;
        }.amount_paid{
                background-color: #ddefdd !important;
        }
</style>



