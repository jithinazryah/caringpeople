<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PatientEnquiryHospitalFirstSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patient Enquiry Hospital Firsts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-enquiry-hospital-first-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                                                                            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                                        
                                        <?=  Html::a('<i class="fa-th-list"></i><span> Create Patient Enquiry Hospital First</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                                                                                                                                        <?= GridView::widget([
                                                'dataProvider' => $dataProvider,
                                                'filterModel' => $searchModel,
        'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],

                                                            'id',
            'enquiry_id',
            'required_person_name',
            'patient_gender',
            'patient_age',
            // 'patient_weight',
            // 'relationship',
            // 'relationship_others',
            // 'person_address',
            // 'person_city',
            // 'person_postal_code',
            // 'hospital_name',
            // 'consultant_doctor',
            // 'department',
            // 'hospital_room_no',

                                                ['class' => 'yii\grid\ActionColumn'],
                                                ],
                                                ]); ?>
                                                                                                                </div>
                        </div>
                </div>
        </div>
</div>


