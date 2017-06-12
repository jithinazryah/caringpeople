<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\components\ViewlinkssWidget;

/* @var $this yii\web\View */
/* @var $searchModel common\models\RemarksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Remarks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="remarks-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
                                        <?= ViewlinkssWidget::widget(['type_id' => $id, 'type' => 2]); ?>


                                </div>
                                <div class="panel-body">
                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                                        <?=
                                        GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
                                                    [
                                                    'attribute' => 'category',
                                                    'value' => 'category0.category',
                                                    'filter' => ArrayHelper::map(\common\models\RemarksCategory::find()->where(['status' => '1'])->asArray()->all(), 'id', 'category'),
                                                ],
                                                'sub_category',
                                                'notes:ntext',
                                            ],
                                        ]);
                                        ?>
                                </div>
                        </div>
                </div>
        </div>
</div>


