<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UploadCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Upload Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="upload-category-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                                <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                <?=
                                                GridView::widget([
                                                    'dataProvider' => $dataProvider,
                                                    'filterModel' => $searchModel,
                                                    'columns' => [
                                                            ['class' => 'yii\grid\SerialColumn'],
                                                        // 'id',
                                                        [
                                                            'attribute' => 'category_type',
                                                            'value' => function($model, $key, $index, $column) {
                                                                    if ($model->category_type == 1) {
                                                                            return 'Profile';
                                                                    } else if ($model->category_type == 2) {
                                                                            return 'Government Issued Identification';
                                                                    } else if ($model->category_type == 3) {
                                                                            return 'Permanent Address';
                                                                    } else if ($model->category_type == 4) {
                                                                            return 'Current Address';
                                                                    } else if ($model->category_type == 5) {
                                                                            return 'Educational Document';
                                                                    } else if ($model->category_type == 6) {
                                                                            return 'IMC Document';
                                                                    }
                                                            },
                                                            'filter' => ['1' => 'Profile', '2' => 'Government Issued Identification', '3' => 'Permanent Address', '4' => 'Current Address', '5' => 'Educational Document', '6' => 'IMC Document'],
                                                        ],
                                                        'sub_category',
                                                            [
                                                            'attribute' => 'status',
                                                            'value' => function($model, $key, $index, $column) {
                                                                    return $model->status == 0 ? 'Disabled' : 'Enabled';
                                                            },
                                                            'filter' => [1 => 'Enabled', 0 => 'Disabled'],
                                                        ],
                                                        // 'UB',
                                                        // 'DOC',
                                                        // 'DOU',
                                                        ['class' => 'yii\grid\ActionColumn',
                                                            'template' => '{update}{delete}'],
                                                    ],
                                                ]);
                                                ?>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 small-forms">
                                                <div class="header-small-forms">
                                                        <?php if ($model->isNewRecord) { ?>
                                                                <h4>Add Upload Category</h4>
                                                        <?php } else { ?>
                                                                <h4>Update Upload Category</h4>
<?php } ?>
                                                </div>

                                                <div class="small-forms-form">
                                                        <?=
                                                        $this->render('_form', [
                                                            'model' => $model,
                                                        ])
                                                        ?>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>


