<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use common\models\Branch;

$branch = Branch::branch();

/* @var $this yii\web\View */
/* @var $searchModel common\models\PatientInformationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patient Informations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-information-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                        <a class="patient-advanced-search" style="font-size: 17px;color:#0e62c7;cursor: pointer;">Advanced Search</a>
                                        <hr class="appoint_history" style="margin-top:5px;"/>
                                        <?php echo $this->render('_search', ['model' => $searchModel]); ?>

                                        <?= Html::a('<i class="fa-th-list"></i><span> New Patient </span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                        <?php
                                        $gridColumns = [
                                                ['class' => 'yii\grid\SerialColumn'],
                                            'patient_id',
                                            // 'first_name',
                                            // 'last_name',
                                            [
                                                'header' => 'Name',
                                                'attribute' => 'first_name',
                                                'value' => function($model, $key, $index, $column) {
                                                        return $model->first_name . " " . $model->last_name;
                                                },
                                            ],
                                            // 'contact_name',
                                            // 'contact_gender',
                                            // 'referral_source',
                                            // 'contact_mobile_number_1',
                                            // 'contact_mobile_number_2',
                                            // 'contact_mobile_number_3',
                                            // 'contact_city',
                                            // 'contact_zip_or_pc',
                                            // 'contact_email:email',
                                            // 'contact_perosn_relationship',
                                            // 'patient_name',
                                            // 'patient_gender',
                                            // 'patient_age',
                                            // 'patient_weight',
                                            // 'other_relationships',
                                            // 'veteran_or_spouse',
                                            // 'patient_address',
                                            // 'patient_city',
                                            // 'patient_postal_code',
                                            // 'patient_current_status',
                                            // 'follow_up_date',
                                            // 'notes:ntext',
                                            [
                                                'attribute' => 'status',
                                                'value' => function($model, $key, $index, $column) {
                                                        if ($model->status == '1') {
                                                                return 'Active';
                                                        } elseif ($model->status == '2') {
                                                                return 'Closed';
                                                        } elseif ($model->status == '3') {
                                                                return 'Pending';
                                                        } elseif ($model->status == '4') {
                                                                return 'Deseased';
                                                        }
                                                },
                                                'filter' => [1 => 'Active', 2 => 'Closed', 3 => 'Pending', 4 => 'Deseased'],
                                            ],
                                                [
                                                'attribute' => 'branch_id',
                                                'value' => function($data) {
                                                        return Branch::findOne($data->branch_id)->branch_name;
                                                },
                                                'filter' => ArrayHelper::map($branch, 'id', 'branch_name'),
                                            ],
                                            // 'CB',
                                            // 'UB',
                                            // 'DOC',
                                            // 'DOU',
                                            ['class' => 'yii\grid\ActionColumn',
                                                'template' => '{view}{update}{followup}',
                                                'visibleButtons' => [
                                                    'delete' => function ($model, $key, $index) {
                                                            return Yii::$app->user->identity->post_id != '1' ? false : true;
                                                    }
                                                ],
                                                'buttons' => [
                                                    'followup' => function ($url, $model) {

                                                            $url = Yii::$app->homeUrl . 'followup/followups/followups?type_id=' . $model->id . '&type=2';
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
                $('.patient-advanced-search-form').hide();
                $('.patient-advanced-search').click(function () {
                        $('.patient-advanced-search-form').slideToggle();
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