<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EnquirySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Enquiries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enquiry-index">

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
                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                        <?php
                                        $this->render('_enquiry_menus', [
                                            'model' => $model,
                                        ])
                                        ?>
                                        <?= Html::a('<i class="fa-th-list"></i><span> Create Enquiry</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>

                                        <?=
                                        GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
                                                //'id',
                                                'enquiry_id',
                                                    [
                                                    'attribute' => 'contacted_source',
                                                    'value' => function($model, $key, $index, $column) {
                                                            if ($model->contacted_source == '0') {
                                                                    return 'Phone';
                                                            } elseif ($model->contacted_source == '1') {
                                                                    return 'Email';
                                                            } elseif ($model->contacted_source == '2') {
                                                                    return 'Others';
                                                            }
                                                    },
                                                    'filter' => [0 => 'Phone', 1 => 'Email', 2 => 'Others'],
                                                ],
                                                'contacted_date',
                                                'incoming_missed',
                                                // 'contacted_source_others',
                                                // 'outgoing_number_from',
                                                // 'outgoing_call_date',
                                                // 'caller_name',
                                                // 'referral_source',
                                                // 'mobile_number',
                                                // 'mobile_number_2',
                                                // 'mobile_number_3',
                                                // 'address',
                                                // 'city',
                                                // 'zip_pc',
                                                // 'email:email',
                                                // 'service_required_for',
                                                // 'service_required_for_others',
                                                // 'age',
                                                // 'weight',
                                                // 'relationship',
                                                // 'veteran_or_spouse',
                                                // 'person_address',
                                                // 'person_city',
                                                // 'person_postal_code',
                                                // 'branch_id',
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
                        </div>
                </div>
        </div>
</div>


