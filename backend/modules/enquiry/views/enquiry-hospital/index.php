<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EnquiryHospitalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Enquiry Hospitals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enquiry-hospital-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                                                                            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                                        
                                        <?=  Html::a('<i class="fa-th-list"></i><span> Create Enquiry Hospital</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                                                                                                                                        <?= GridView::widget([
                                                'dataProvider' => $dataProvider,
                                                'filterModel' => $searchModel,
        'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],

                                                            'id',
            'enquiry_id',
            'hospital_name',
            'consultant_doctor',
            'hospital_room_no',
            // 'required_service',
            // 'other_services',
            // 'diabetic',
            // 'hypertension',
            // 'tubes',
            // 'feeding',
            // 'urine',
            // 'oxygen',
            // 'tracheostomy',
            // 'iv_line',
            // 'dressing',
            // 'home_or_hospital_visit',
            // 'visit_date',
            // 'bedridden:ntext',

                                                ['class' => 'yii\grid\ActionColumn'],
                                                ],
                                                ]); ?>
                                                                                                                </div>
                        </div>
                </div>
        </div>
</div>


