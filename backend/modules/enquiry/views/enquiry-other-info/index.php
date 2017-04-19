<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EnquiryOtherInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Enquiry Other Infos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enquiry-other-info-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                                                                            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                                        
                                        <?=  Html::a('<i class="fa-th-list"></i><span> Create Enquiry Other Info</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                                                                                                                                        <?= GridView::widget([
                                                'dataProvider' => $dataProvider,
                                                'filterModel' => $searchModel,
        'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],

                                                            'id',
            'enquiry_id',
            'family_support',
            'family_support_note',
            'care_currently_provided',
            // 'details_of_current_care',
            // 'difficulty_in_movement',
            // 'difficulty_in_movement_other',
            // 'service_required',
            // 'service_required_other',
            // 'how_long_service_required',
            // 'nursing_assessment',
            // 'doctor_assessment',
            // 'follow_up_notes:ntext',
            // 'quotation_details:ntext',
            // 'priority',
            // 'followup_date',

                                                ['class' => 'yii\grid\ActionColumn'],
                                                ],
                                                ]); ?>
                                                                                                                </div>
                        </div>
                </div>
        </div>
</div>


