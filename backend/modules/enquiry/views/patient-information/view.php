<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PatientInformation */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Patient Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">
                                <?=  Html::a('<i class="fa-th-list"></i><span> Manage Patient Information</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="patient-information-view">
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
            'enquiry_id',
            'patient_id',
            'branch_id',
            'contact_address',
            'contact_name',
            'contact_gender',
            'referral_source',
            'contact_mobile_number_1',
            'contact_mobile_number_2',
            'contact_mobile_number_3',
            'contact_city',
            'contact_zip_or_pc',
            'contact_email:email',
            'contact_perosn_relationship',
            'patient_name',
            'patient_gender',
            'patient_age',
            'patient_weight',
            'other_relationships',
            'veteran_or_spouse',
            'patient_address',
            'patient_city',
            'patient_postal_code',
            'patient_current_status',
            'follow_up_date',
            'notes:ntext',
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


