<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PatientInformationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patient Informations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-information-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                        <?= Html::a('<i class="fa-th-list"></i><span> Create Patient Information</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                        <?=
                                        GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
                                                'id',
                                                'enquiry_id',
                                                'patient_id',
                                                'branch_id',
                                                'contact_address',
                                                // 'contact_name',
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


