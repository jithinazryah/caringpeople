<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\EnquiryOtherInfo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Enquiry Other Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">
                                <?=  Html::a('<i class="fa-th-list"></i><span> Manage Enquiry Other Info</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="enquiry-other-info-view">
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
            'family_support',
            'family_support_note',
            'care_currently_provided',
            'details_of_current_care',
            'difficulty_in_movement',
            'difficulty_in_movement_other',
            'service_required',
            'service_required_other',
            'how_long_service_required',
            'nursing_assessment',
            'doctor_assessment',
            'follow_up_notes:ntext',
            'quotation_details:ntext',
            'priority',
            'followup_date',
                                                ],
                                                ]) ?>
</div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>


