<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StaffInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Staff Infos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-info-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                                                                            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                                        
                                        <?=  Html::a('<i class="fa-th-list"></i><span> Create Staff Info</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                                                                                                                                        <?= GridView::widget([
                                                'dataProvider' => $dataProvider,
                                                'filterModel' => $searchModel,
        'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],

                                                            'id',
            'staff_name',
            'gender',
            'dob',
            'blood_group',
            // 'religion',
            // 'caste',
            // 'nationality',
            // 'pan_or_adhar_no',
            // 'permanent_address',
            // 'pincode',
            // 'contact_no',
            // 'email:email',
            // 'present_address',
            // 'present_pincode',
            // 'present_contact_no',
            // 'present_email:email',
            // 'years_of_experience',
            // 'driving_licence',
            // 'licence_no',
            // 'sslc_institution',
            // 'sslc_year_of_passing',
            // 'sslc_place',
            // 'hse_institution',
            // 'hse_year_of_passing',
            // 'hse_place',
            // 'nursing_institution',
            // 'nursing_year_of_passing',
            // 'nursing_place',
            // 'timing',
            // 'profile_image_type',
            // 'uniform',
            // 'company_id',
            // 'emergency_conatct_verification',
            // 'panchayath_cleraance_verification',
            // 'biodata',
            // 'branch_id',
            // 'status',
            // 'CB',
            // 'UB',
            // 'DOC',
            // 'DOU',

                                                ['class' => 'yii\grid\ActionColumn'],
                                                ],
                                                ]); ?>
                                                                                                                </div>
                        </div>
                </div>
        </div>
</div>


