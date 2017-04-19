<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Branch;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StaffEnquirySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Staff Enquiries';
$this->params['breadcrumbs'][] = $this->title;
$branch = Branch::branch();
?>
<div class="staff-enquiry-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                        <?php if (Yii::$app->session->hasFlash('error')): ?>

                                                <div class="alert alert-danger">
                                                        <button type="button" class="close" data-dismiss="alert">
                                                                <span aria-hidden="true">&times;</span>
                                                                <span class="sr-only">Close</span>
                                                        </button>
                                                        <?= Yii::$app->session->getFlash('error') ?>
                                                </div>
                                        <?php endif; ?>
                                        <?php if (Yii::$app->session->hasFlash('success')): ?>
                                                <div class="alert alert-success">
                                                        <button type="button" class="close" data-dismiss="alert">
                                                                <span aria-hidden="true">&times;</span>
                                                                <span class="sr-only">Close</span>
                                                        </button>

                                                        <?= Yii::$app->session->getFlash('success') ?>
                                                </div>
                                        <?php endif; ?>
                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                        <?= Html::a('<i class="fa-th-list"></i><span> New Staff Enquiry</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                        <?=
                                        GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
                                                'enquiry_id',
                                                'name',
                                                'phone_number',
                                                'email:email',
                                                'address',
                                                // 'follow_up_date',
//                                                [
//                                                    'attribute' => 'follow_up_date',
//                                                    'value' => function($model, $key, $index) {
//                                                            return date('d-M-Y H:i:s', strtotime($model->follow_up_date));
//                                                    },
//                                                ],
                                                 [
                                                    'attribute' => 'branch_id',
                                                    'value' => function($data) {
                                                            return Branch::findOne($data->branch_id)->branch_name;
                                                    },
                                                    'filter' => ArrayHelper::map($branch, 'id', 'branch_name'),
                                                ],
                                                // 'notes:ntext',
                                                // 'status',
                                                // 'CB',
                                                // 'UB',
                                                // 'DOC',
                                                // 'DOU',
                                                 ['class' => 'yii\grid\ActionColumn',
                                                    'template' => '{view}{update}{followup}{delete}',
                                                    'visibleButtons' => [
                                                        'delete' => function ($model, $key, $index) {
                                                                return Yii::$app->user->identity->post_id != '1' ? false : true;
                                                        }
                                                    ],
                                                    'buttons' => [
                                                        'followup' => function ($url, $model) {

                                                                $url = Yii::$app->homeUrl . 'followup/followups/followups?type_id=' . $model->id . '&type=3';
                                                                return Html::a(
                                                                                '<span><i class="fa fa-tasks" aria-hidden="true"></i></span>', $url, [
                                                                            'data-pjax' => '0',
                                                                            'id' => $model->id,
                                                                            'title' => 'Add Followups',
                                                                            'target' => '_blank',
                                                                                ]
                                                                );
                                                        },
                                                    ],
                                                ],
                                            ],
                                        ]);
                                        ?>
                                </div>
                        </div>
                </div>
        </div>
</div>


