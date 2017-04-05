<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PatientEnquiryGeneralSecondSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patient Enquiry General Seconds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-enquiry-general-second-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                                                                            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                                        
                                        <?=  Html::a('<i class="fa-th-list"></i><span> Create Patient Enquiry General Second</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                                                                                                                                        <?= GridView::widget([
                                                'dataProvider' => $dataProvider,
                                                'filterModel' => $searchModel,
        'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],

                                                            'id',
            'enquiry_id',
            'address',
            'city',
            'zip_pc',
            // 'email:email',
            // 'email1:email',
            // 'whatsapp_reply',
            // 'whatsapp_number',
            // 'whatsapp_note:ntext',
            // 'required_service',
            // 'required_service_other',
            // 'service_required',
            // 'service_required_other',
            // 'expected_date_of_service',
            // 'how_long_service_required',
            // 'visit_type',
            // 'quotation_details:ntext',
            // 'notes:ntext',
            // 'priority',

                                                ['class' => 'yii\grid\ActionColumn'],
                                                ],
                                                ]); ?>
                                                                                                                </div>
                        </div>
                </div>
        </div>
</div>


