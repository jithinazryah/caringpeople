<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\RemarksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Remarks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="remarks-index">

        <h1><?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

        <p>
                <?= Html::a('Create Remarks', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                'id',
                'sub_category',
                    [
                    'attribute' => 'status',
                    'value' => function($model, $key, $index, $column) {
                            if ($model->status == '0') {
                                    return 'Closed';
                            } elseif ($model->status == '1') {
                                    return 'Active';
                            }
                    },
                    'filter' => [0 => 'Closed', 1 => 'Active'],
                ],
                // 'notes:ntext',
                // 'remark_type',
                // 'point',
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
