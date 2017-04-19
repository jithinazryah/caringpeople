<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\FollowupsviewWidget;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FollowupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Followups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="followups-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                        <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

                                        <?php
                                        if (!empty($followups))
                                                foreach ($followups as $value) {

                                                        echo FollowupsviewWidget::widget(['data' => $value]);
                                                }
                                        ?>
                                </div>
                        </div>
                </div>
        </div>
</div>


