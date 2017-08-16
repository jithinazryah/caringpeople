<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\InvoiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Invoices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">



                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                        <?= Html::a('<i class="fa-th-list"></i><span> New Invoice</span>', ['invoice'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>

                                        <div class="table-responsive" style="border:none;">
                                                <?=
                                                GridView::widget([
                                                    'dataProvider' => $dataProvider,
                                                    'filterModel' => $searchModel,
                                                    'columns' => [
                                                            ['class' => 'yii\grid\SerialColumn'],
                                                        // 'patient_id',
                                                        [
                                                            'attribute' => 'patient_id',
                                                            'value' => function($model) {
                                                                    if (!empty($model->patient_id)) {
                                                                            $patient = \common\models\PatientGeneral::findOne($model->patient_id);
                                                                            return $patient->first_name;
                                                                    }
                                                            },
                                                        ],
                                                            [
                                                            'attribute' => 'service_id',
                                                            'value' => function($model) {
                                                                    if (!empty($model->service_id)) {
                                                                            $service_id = \common\models\Service::findOne($model->service_id);
                                                                            return $service_id->service_id;
                                                                    }
                                                            },
                                                        ],
                                                        // 'amount',
                                                        // 'CB',
                                                        // 'DOC',
                                                        ['class' => 'yii\grid\ActionColumn',
                                                            'template' => '{print}',
                                                            'buttons' => [
                                                                //view button
                                                                'print' => function ($url, $model) {
                                                                        return Html::a('<span class="fa fa-print" style="padding-top: 0px;font-size: 18px;"></span>', $url, [
                                                                                    'title' => Yii::t('app', 'print'),
                                                                                    'class' => 'actions',
                                                                                    'target' => '_blank',
                                                                        ]);
                                                                },
                                                            ],
                                                            'urlCreator' => function ($action, $model) {
                                                                    if ($action === 'print') {
                                                                            $url = Url::to(['invoice/invoicebill', 'id' => $model->id]);
                                                                            return $url;
                                                                    }
                                                            }
                                                        ],
                                                    ],
                                                ]);
                                                ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>




