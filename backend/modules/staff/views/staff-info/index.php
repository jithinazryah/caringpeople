<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Branch;
use yii\helpers\ArrayHelper;
use common\models\StaffInfoUploads;
use kartik\export\ExportMenu;

//AppsAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel common\models\StaffInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Staffs';
$this->params['breadcrumbs'][] = $this->title;
$path = Yii::getAlias(Yii::$app->params['uploadPath']);
$branch = Branch::branch();
$designations = \common\models\MasterDesignations::designationlist();
?>
<div class="staff-info-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">

                                        <?php if (Yii::$app->session->hasFlash('error')): ?>
                                                <div class="alert alert-danger" role="alert">
                                                        <?= Yii::$app->session->getFlash('error') ?>
                                                </div>
                                        <?php endif; ?>
                                        <?php if (Yii::$app->session->hasFlash('success')): ?>
                                                <div class="alert alert-success" role="alert">
                                                        <?= Yii::$app->session->getFlash('success') ?>
                                                </div>
                                        <?php endif; ?>

                                        <a class="advanced-search" style="font-size: 17px;color:#0e62c7;cursor: pointer;">Advanced Search</a>
                                        <hr class="appoint_history" style="margin-top:5px;"/>
                                        <?php echo $this->render('_search', ['model' => $searchModel]); ?>

                                        <?= Html::a('<i class="fa-th-list"></i><span> New Staff</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>


                                        <?php
                                        if (Yii::$app->user->identity->post_id == '1') {
                                                echo ExportMenu::widget([
                                                    'dataProvider' => $dataProvider,
                                                    'columns' => $searchModel->getExportColumns(),
                                                    'filename' => 'Staff-Details-' . date('Y-m-d'),
                                                ]);
                                        }
                                        echo \kartik\grid\GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => $searchModel->getGridColumns(),
                                        ]);
                                        ?>


                                </div>
                        </div>
                </div>
        </div>
</div>


<script>
        $(document).ready(function () {
                $('.staff-info-advance').hide();
                $('.advanced-search').click(function () {
                        $('.staff-info-advance').slideToggle();
                });
        });
</script>


