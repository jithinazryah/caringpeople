<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MasterServiceTypesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Master Service Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-service-types-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
					<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

					<?= Html::a('<i class="fa-th-list"></i><span> Create Master Service Types</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
					<?=
					GridView::widget([
					    'dataProvider' => $dataProvider,
					    'filterModel' => $searchModel,
					    'columns' => [
						    ['class' => 'yii\grid\SerialColumn'],
						// 'id',
						'service_name',
						    [
						    'attribute' => 'status',
						    'value' => function($model, $key, $index, $column) {
							    return $model->status == 0 ? 'Disabled' : 'Enabled';
						    },
						    'filter' => [1 => 'Enabled', 0 => 'Disabled'],
						],
						//'CB',
						//'UB',
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


