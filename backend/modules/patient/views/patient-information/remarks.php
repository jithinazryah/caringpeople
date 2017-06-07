<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

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
                                        <div class="col-md-3" style="float:right">
                                                <ul class="nav navbar-nav views">
                                                        <li class="dropdown">
                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding: 4px 19px 23px 20px;height: 10px;">View <b class="caret"></b></a>
                                                                <ul class="dropdown-menu menu-views">
                                                                        <li>
                                                                                <a href="<?= Yii::$app->homeUrl; ?>patient/patient-information/view?id=<?= $id; ?>">View Profile</a>
                                                                        </li>
                                                                        <li>
                                                                                <a href="<?= Yii::$app->homeUrl; ?>patient/patient-information/followups?id=<?= $id; ?>">View All Followups</a>
                                                                        </li>

                                                                        <li>
                                                                                <a href="<?= Yii::$app->homeUrl; ?>patient/patient-information/remarks?id=<?= $id; ?>">View All Remarks</a>
                                                                        </li>

                                                                </ul>
                                                        </li>
                                                </ul>
                                        </div>

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


