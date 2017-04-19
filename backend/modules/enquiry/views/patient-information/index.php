<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Branch;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PatientInformationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clients';
$this->params['breadcrumbs'][] = $this->title;
$branch = Branch::branch();
?>
<div class="patient-information-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                        <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

                                        <?= Html::a('<i class="fa-th-list"></i><span> New Client</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                        <?=
                                        GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
                                                'patient_id',
                                                'contact_name',
                                                'contact_address',
                                                    [
                                                    'attribute' => 'branch_id',
                                                    'value' => function($data) {
                                                            return Branch::findOne($data->branch_id)->branch_name;
                                                    },
                                                    'filter' => ArrayHelper::map($branch, 'id', 'branch_name'),
                                                ],
                                                // 'contact_gender',
                                                // 'referral_source',
                                                // 'contact_mobile_number_1',
                                                // 'contact_mobile_number_2',
                                                // 'contact_mobile_number_3',
                                                // 'contact_city',
                                                // 'contact_zip_or_pc',
                                                // 'contact_email:email',
                                                // 'contact_perosn_relationship',
                                                // 'patient_name',
                                                // 'patient_gender',
                                                // 'patient_age',
                                                // 'patient_weight',
                                                // 'other_relationships',
                                                // 'veteran_or_spouse',
                                                // 'patient_address',
                                                // 'patient_city',
                                                // 'patient_postal_code',
                                                // 'patient_current_status',
                                                // 'follow_up_date',
                                                // 'notes:ntext',
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


