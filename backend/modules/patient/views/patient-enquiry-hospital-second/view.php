<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PatientEnquiryHospitalSecond */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Patient Enquiry Hospital Seconds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">
                                <?=  Html::a('<i class="fa-th-list"></i><span> Manage Patient Enquiry Hospital Second</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="patient-enquiry-hospital-second-view">
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
            'diabetic',
            'diabetic_note',
            'hypertension',
            'feeding',
            'urine',
            'oxygen',
            'tracheostomy',
            'iv_line',
            'family_support',
            'family_support_note:ntext',
            'care_currently_provided',
            'care_currently_provided_others',
            'date_of_discharge',
            'details_of_current_care:ntext',
            'difficulty_in_movement',
            'difficulty_in_movement_other:ntext',
                                                ],
                                                ]) ?>
</div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>


