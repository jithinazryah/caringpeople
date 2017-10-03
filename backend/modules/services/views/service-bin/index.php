<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ServiceBinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Service Bins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-bin-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">



                                                                                            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                                        


                                        <?=  Html::a('<i class="fa-th-list"></i><span> Create Service Bin</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>


                                        <div class="table-responsive" style="border:none;">
                                                                                                                                                        <?= GridView::widget([
                                                        'dataProvider' => $dataProvider,
                                                        'filterModel' => $searchModel,
        'columns' => [
                                                        ['class' => 'yii\grid\SerialColumn'],

                                                                    'id',
            'branch_id',
            'service_id',
            'patient_id',
            'service',
            // 'sub_service',
            // 'gender_preference',
            // 'duty_type',
            // 'day_night_staff',
            // 'frequency',
            // 'hours',
            // 'days',
            // 'staff_manager',
            // 'from_date',
            // 'to_date',
            // 'estimated_price',
            // 'service_staffs',
            // 'co_worker',
            // 'rate_card_value',
            // 'registration_fees',
            // 'registration_fees_amount',
            // 'due_amount',
            // 'client_notes:ntext',
            // 'status',
            // 'CB',
            // 'UB',
            // 'DOC',
            // 'DOU',

                                                        ['class' => 'yii\grid\ActionColumn'],
                                                        ],
                                                        ]); ?>
                                                                                                                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>




