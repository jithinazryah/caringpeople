<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Religion;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ReligionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Religions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="religion-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                        <?= Html::a('<i class="fa-th-list"></i><span> Create Religion</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                        <?=
                                        GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
                                                'religion',
                                                    [
                                                    'attribute' => 'religion',
                                                    'value' => 'r.religion',
                                                    'filter' => ArrayHelper::map(Religion::find()->where(['status' => '1'])->asArray()->all(), 'id', 'religion'),
                                                ],
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


