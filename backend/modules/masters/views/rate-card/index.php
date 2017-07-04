<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\RateCardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rate Cards';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rate-card-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                        <?= Html::a('<i class="fa-th-list"></i><span> Create Rate Card</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                        <?=
                                        GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
                                                // 'id',
                                                //service_id
                                                ['attribute' => 'service_id',
                                                    'value' => 'service.service_name',
                                                    'filter' => yii\helpers\ArrayHelper::map(\common\models\MasterServiceTypes::find()->where(['status' => 1])->asArray()->all(), 'id', 'service_name'),
                                                ],
                                                'rate_card_name',
                                                'rate_per_hour',
                                                'rate_per_visit',
                                                // 'rate_per_day',
                                                // 'rate_per_night',
                                                // 'rate_per_day_night',
                                                // 'period_from',
                                                // 'period_to',
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


