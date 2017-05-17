<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FollowupSubTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Followup Sub Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="followup-sub-type-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                        <?= Html::a('<i class="fa-th-list"></i><span> Create Followup Sub Type</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                        <?=
                                        GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
                                                //   'id',
                                                // 'type_id',
                                                [
                                                    'attribute' => 'type_id',
                                                    'value' => function($data) {

                                                            return common\models\FollowupType::findOne($data->type_id)->type;
                                                    },
                                                    'filter' => ArrayHelper::map(common\models\FollowupType::find()->where(['status' => '1'])->asArray()->all(), 'id', 'type'),
                                                ],
                                                'sub_type',
                                                    [
                                                    'attribute' => 'status',
                                                    'value' => function($model, $key, $index, $column) {
                                                            return $model->status == 0 ? 'Disabled' : 'Enabled';
                                                    },
                                                    'filter' => [1 => 'Enabled', 0 => 'Disabled'],
                                                ],
                                                // 'CB',
                                                // 'UB',
                                                // 'DOC',
                                                // 'DOU',
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


