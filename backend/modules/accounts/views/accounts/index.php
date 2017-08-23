<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AccountsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Day Book';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounts-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">



                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>





                    <div class="table-responsive" style="border:none;">
                        <?=
                        GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                //  'id',
                                //'branch_id',
                                [
                                    'attribute' => 'branch_id',
                                    'value' => function($model) {
                                        $branch = common\models\Branch::findOne($model->branch_id);
                                        return $branch->branch_name;
                                    },
                                            'filter'=> \yii\helpers\ArrayHelper::map(common\models\Branch::find()->where(['status'=>1])->andWhere(['<>','id',0])->all(), 'id', 'branch_name')
                                ],
                                [
                                    'attribute' => 'reference_type',
                                    'value' => function($model) {
                                        if ($model->reference_type == 1) {
                                            return 'Staff Payroll';
                                        } else if ($model->reference_type == 2) {
                                            return 'Purchase';
                                        } else if ($model->reference_type == 3) {
                                            return 'Patient Bill';
                                        }
                                    },
                                    'filter' => [1 => 'Staff Payroll', 2 => 'Purchase',3=>'Patient Bill'],
                                ],
//                                'debited_to_credited_by',
                                // 'type',
                                [
                                    'attribute' => 'type',
                                    'value' => function($model) {
                                        if ($model->type == 1) {
                                            return 'Debit';
                                        } else if ($model->type == 2) {
                                            return 'Credit';
                                        }
                                    },
                                    'filter' => [1 => 'Debit', 2 => 'Credit'],
                                ],
                                // 'purpose',
                                // 'payment_type',
                                'amount',
                            // 'payment_date',
                            // 'CB',
                            // 'UB',
                            // 'DOC',
                            // 'DOU',
                            //['class' => 'yii\grid\ActionColumn'],
                            ],
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




