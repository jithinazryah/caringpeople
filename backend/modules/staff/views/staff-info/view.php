<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StaffInfo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Staff Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">
                                <?=  Html::a('<i class="fa-th-list"></i><span> Manage Staff Info</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="staff-info-view">
                                                <p>
                                                        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                                                        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                                                        'class' => 'btn btn-danger',
                                                        'data' => [
                                                        'confirm' => 'Are you sure you want to delete this item?',
                                                        'method' => 'post',
                                                        ],
                                                        ]) ?>
                                                </p>

                                                <?= DetailView::widget([
                                                'model' => $model,
                                                'attributes' => [
                                                            'id',
            'staff_name',
            'gender',
            'dob',
            'blood_group',
            'religion',
            'caste',
            'nationality',
            'pan_or_adhar_no',
            'permanent_address',
            'pincode',
            'contact_no',
            'email:email',
            'present_address',
            'present_pincode',
            'present_contact_no',
            'present_email:email',
            'years_of_experience',
            'driving_licence',
            'licence_no',
            'sslc_institution',
            'sslc_year_of_passing',
            'sslc_place',
            'hse_institution',
            'hse_year_of_passing',
            'hse_place',
            'nursing_institution',
            'nursing_year_of_passing',
            'nursing_place',
            'timing',
            'profile_image_type',
            'uniform',
            'company_id',
            'emergency_conatct_verification',
            'panchayath_cleraance_verification',
            'biodata',
            'branch_id',
            'status',
            'CB',
            'UB',
            'DOC',
            'DOU',
                                                ],
                                                ]) ?>
</div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>


