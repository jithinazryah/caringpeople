<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Branch;
use yii\helpers\ArrayHelper;
use kartik\export\ExportMenu;

$branch = Branch::branch();

/* @var $this yii\web\View */
/* @var $searchModel common\models\PatientEnquiryGeneralFirstSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patient Enquiries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-enquiry-general-first-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                        <?php if (Yii::$app->session->hasFlash('error')): ?>

                                                <div class="alert alert-danger">
                                                        <button type="button" class="close" data-dismiss="alert">
                                                                <span aria-hidden="true">&times;</span>
                                                                <span class="sr-only">Close</span>
                                                        </button>
                                                        <?= Yii::$app->session->getFlash('error') ?>
                                                </div>
                                        <?php endif; ?>
                                        <?php if (Yii::$app->session->hasFlash('success')): ?>
                                                <div class="alert alert-success">
                                                        <button type="button" class="close" data-dismiss="alert">
                                                                <span aria-hidden="true">&times;</span>
                                                                <span class="sr-only">Close</span>
                                                        </button>

                                                        <?= Yii::$app->session->getFlash('success') ?>
                                                </div>
                                        <?php endif; ?>
                                        <?php // $this->render('advanced_search', ['model' => $searchModel])  ?>
                                        <a class="advanced-search" style="font-size: 17px;color:#0e62c7;cursor: pointer;">Advanced Search</a>
                                        <hr class="appoint_history" style="margin-top:5px;"/>



                                        <?= $this->render('advanced_search', ['model' => $searchModel]) ?>

                                        <?= Html::a('<i class="fa-th-list"></i><span> New Enquiry </span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>

                                        <?php
                                        $gridColumns = [
                                                ['class' => 'yii\grid\SerialColumn'],
                                            'enquiry_number',
                                            'caller_name',
                                                [
                                                'attribute' => 'email',
                                                'value' => 'patientGeneralInfo.email'
                                            ],
                                                [
                                                'attribute' => 'patient_name',
                                                'value' => 'patientHospitalInfo.required_person_name'
                                            ],
                                                [
                                                'attribute' => 'required_service',
                                                'value' => function($model, $key, $index, $column) {
                                                        return $model->service($model->id);
                                                },
                                                'filter' => [1 => 'Doctor Visit', 2 => 'Nursing Care', 3 => 'Physiotherapy', 5 => 'Caregiver', 4 => 'Helath Checkup', 6 => 'Lab', 7 => 'Equipment', 8 => 'Other', 9 => 'General Enquiry', 10 => 'Wrong Number '],
                                            ],
                                                [
                                                'attribute' => 'status',
                                                'value' => function($model, $key, $index, $column) {
                                                        if ($model->status == '1') {
                                                                return 'Active';
                                                        } elseif ($model->status == '2') {
                                                                return 'Pending';
                                                        } elseif ($model->status == '3') {
                                                                return 'Close';
                                                        }
                                                },
                                                'filter' => [1 => 'Active', 2 => 'Pending', 3 => 'Close', 4 => 'Home/Hospital Visit'],
                                            ],
                                                [
                                                'attribute' => 'branch_id',
                                                'value' => function($data) {
                                                        return Branch::findOne($data->branch_id)->branch_name;
                                                },
                                                'filter' => ArrayHelper::map($branch, 'id', 'branch_name'),
                                            ],
                                                ['class' => 'yii\grid\ActionColumn',
                                                'template' => '{view}{update}{followup}{delete}',
                                                'visibleButtons' => [
                                                    'delete' => function ($model, $key, $index) {
                                                            return Yii::$app->user->identity->post_id != '1' ? false : true;
                                                    }
                                                ],
                                                'buttons' => [
                                                    'followup' => function ($url, $model) {

                                                            $url = Yii::$app->homeUrl . 'followup/followups/followups?type_id=' . $model->id . '&type=1';
                                                            return Html::a(
                                                                            '<span><i class="fa fa-tasks" aria-hidden="true"></i></span>', $url, [
                                                                        'data-pjax' => '0',
                                                                        'id' => $model->id,
                                                                        'title' => 'Add Followups',
                                                                        'target' => '_blank',
                                                                            ]
                                                            );
                                                    },
                                                ],
                                            ],
                                        ];
                                        echo ExportMenu::widget([
                                            'dataProvider' => $dataProvider,
                                            'columns' => $gridColumns,
                                        ]);
                                        echo \kartik\grid\GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => $gridColumns
                                        ]);
                                        ?>


                                </div>
                        </div>
                </div>
        </div>
</div>


<script>
        $(document).ready(function () {
                $('.hidediv1').hide();
                $('.advanced-search').click(function () {
                        $('.hidediv1').slideToggle();
                });
        });
</script>

<style>
        .modal .modal-dialog .modal-content .modal-body {
                padding: 15px;
        }
        .modal .modal-dialog .modal-content .modal-footer {
                padding: 15px;
        }
        .modal .modal-dialog .modal-content .modal-header {
                padding: 15px;
        }
        .modal .modal-dialog .modal-content {
                padding: 0px;
                webkit-box-shadow: 0 5px 15px rgba(0,0,0,.5);
                box-shadow: 0 5px 15px rgba(0,0,0,.5)
        }
        .btn {
                border-radius: 4px;
                border: 1px solid #ccc;
        }
        .modal-backdrop {
                position: fixed;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                z-index: 1040;
                background-color: #000;
        }
</style>

