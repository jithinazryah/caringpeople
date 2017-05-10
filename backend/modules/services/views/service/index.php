<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\StaffInfo;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Services';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                        <?= Html::a('<i class="fa-th-list"></i><span> Create Service</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                        <?=
                                        GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
                                                // 'id',
                                                [
                                                    'attribute' => 'patient_id',
                                                    'value' => 'patient.first_name'
                                                ],
                                                    [
                                                    'attribute' => 'service',
                                                    'value' => 'service0.service_name'
                                                ],
                                                    [
                                                    'attribute' => 'duty_type',
                                                    'value' => function($model) {
                                                            if ($model->duty_type == '1') {
                                                                    return 'Day';
                                                            } else if ($model->duty_type == '2') {
                                                                    return 'Night';
                                                            } else if ($model->duty_type == '3') {
                                                                    return 'Day & Night';
                                                            }
                                                    },
                                                    'filter' => [1 => 'Day', 2 => 'Night', 3 => 'Day & Night'],
                                                ],
                                                    [
                                                    'attribute' => 'day_staff',
                                                    'header' => 'Staff',
                                                    'value' => function($model) {
                                                            if ($model->duty_type == 1) {
                                                                    $staff = StaffInfo::findOne($model->day_staff);
                                                                    return $staff->staff_name;
                                                            } elseif ($model->duty_type == 2) {
                                                                    $staff = StaffInfo::findOne($model->night_staff);
                                                                    return $staff->staff_name;
                                                            } elseif ($model->duty_type == 3) {
                                                                    $staff = StaffInfo::findOne($model->day_staff);
                                                                    $staff1 = StaffInfo::findOne($model->night_staff);
                                                                    return 'D-' . $staff->staff_name . ', N-' . $staff1->staff_name;
                                                            }
                                                    }
                                                ],
                                                    [
                                                    'attribute' => 'staff_type',
                                                    'value' => function($model) {
                                                            if ($model->staff_type == 1)
                                                                    return "Registered Nurse";
                                                            elseif ($model->staff_type == 2)
                                                                    return "Care Assistant";
                                                            elseif ($model->staff_type == 3)
                                                                    return "Doctor";
                                                            else
                                                                    return "";
                                                    },
                                                ],
                                                //'staff_id',
                                                // 'staff_manager',
                                                // 'from_date',
                                                // 'to_date',
                                                // 'estimated_price_per_day',
                                                // 'estimated_price',
                                                // 'advance_payment',
                                                // 'status',
                                                // 'CB',
                                                // 'UB',
                                                // 'DOC',
                                                // 'DOU',
                                                ['class' => 'yii\grid\ActionColumn'],
                                            ],
                                        ]);
                                        ?>
                                </div>
                        </div>
                </div>
        </div>
</div>


