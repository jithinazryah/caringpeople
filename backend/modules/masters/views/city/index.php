<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Country;
use common\models\State;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                </div>
                <div class="panel-body">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= Html::a('<i class="fa-th-list"></i><span> Create City</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
//                                                'id',
                            [
                                'attribute' => 'country_id',
                                'value' => function($data) {

                                    return Country::findOne($data->country_id)->country_name;
                                },
                                'filter' => ArrayHelper::map(Country::find()->where(['status' => '1'])->asArray()->all(), 'id', 'country_name'),
                            ],
                            [
                                'attribute' => 'state_id',
                                'value' => function($data) {

                                    return State::findOne($data->state_id)->state_name;
                                },
                                'filter' => ArrayHelper::map(State::find()->where(['status' => '1'])->asArray()->all(), 'id', 'state_name'),
                            ],
                            'city_name',
                            [
                                'attribute' => 'status',
                                'value' => function($model, $key, $index, $column) {
                                    return $model->status == 0 ? 'Disabled' : 'Enabled';
                                },
                                'filter' => [1 => 'Enabled', 0 => 'Disabled'],
                            ],
                            ['class' => 'yii\grid\ActionColumn',
                                'template' => '{update}{delete}'],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

