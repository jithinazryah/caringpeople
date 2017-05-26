<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\ContactCategoryTypes;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ContactSubcategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contact Subcategories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-subcategory-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                        <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

                                        <?= Html::a('<i class="fa-th-list"></i><span> Create Contact Subcategory</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                        <?=
                                        GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
                                                // 'category_id',
                                                ['attribute' => 'category_id',
                                                    'value' => 'category.category_name',
                                                    'filter' => ArrayHelper::map(ContactCategoryTypes::find()->where(['status' => '1'])->asArray()->all(), 'id', 'category_name'),
                                                ],
                                                'sub_category',
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
                                                    'template' => '{update}{delete}',
                                                    'visibleButtons' => [
                                                        'delete' => function ($model, $key, $index) {
                                                                return Yii::$app->user->identity->post_id != '1' ? false : true;
                                                        }
                                                    ],],
                                            ],
                                        ]);
                                        ?>
                                </div>
                        </div>
                </div>
        </div>
</div>


