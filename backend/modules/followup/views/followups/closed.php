<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\FollowupsviewWidget;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FollowupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Closed Followups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="followups-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
                                </div>
                                <a href="<?= Yii::$app->homeUrl; ?>followup/followups/followups?type_id=<?= $type_id ?> &type=<?= $type ?>" class="btn btn-warning" style="margin-top:10px;">View Followups</a>
                                <div class="panel-body">
                                        <?php // echo $this->render('_search', ['model' => $searchModel]);        ?>

                                        <?php
                                        if (!empty($followups)) {
                                                foreach ($followups as $value) {

                                                        echo FollowupsviewWidget::widget(['data' => $value]);
                                                }
                                        } else {
                                                echo '<p style="text-align:center;"> No followups found !!</p>';
                                        }
                                        ?>
                                </div>
                        </div>
                </div>
        </div>
</div>

