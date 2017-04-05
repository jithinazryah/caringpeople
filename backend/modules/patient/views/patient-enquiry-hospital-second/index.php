<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PatientEnquiryHospitalSecondSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patient Enquiry Hospital Seconds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-enquiry-hospital-second-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                                                                            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                                        
                                        <?=  Html::a('<i class="fa-th-list"></i><span> Create Patient Enquiry Hospital Second</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                                                                                                                                        <?= GridView::widget([
                                                'dataProvider' => $dataProvider,
                                                'filterModel' => $searchModel,
        'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],

                                                            'id',
            'enquiry_id',
            'diabetic',
            'diabetic_note',
            'hypertension',
            // 'feeding',
            // 'urine',
            // 'oxygen',
            // 'tracheostomy',
            // 'iv_line',
            // 'family_support',
            // 'family_support_note:ntext',
            // 'care_currently_provided',
            // 'care_currently_provided_others',
            // 'date_of_discharge',
            // 'details_of_current_care:ntext',
            // 'difficulty_in_movement',
            // 'difficulty_in_movement_other:ntext',

                                                ['class' => 'yii\grid\ActionColumn'],
                                                ],
                                                ]); ?>
                                                                                                                </div>
                        </div>
                </div>
        </div>
</div>


