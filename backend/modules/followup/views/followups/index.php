<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

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

                                        <?= Html::a('<i class="fa-th-list"></i><span> Create Followups</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                        <?php
                                        echo ListView::widget([
                                            'dataProvider' => $dataProvider,
                                            'itemView' => '_followups',
                                        ]);
                                        ?>
                                </div>
                        </div>
                </div>
        </div>
</div>


