<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\EnquiryHospital */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Enquiry Hospitals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">
                                <?= Html::a('<i class="fa-th-list"></i><span> Manage Enquiry Hospital</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="enquiry-hospital-view">
                                                <p>
                                                        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                                                        <?=
                                                        Html::a('Delete', ['delete', 'id' => $model->id], [
                                                            'class' => 'btn btn-danger',
                                                            'data' => [
                                                                'confirm' => 'Are you sure you want to delete this item?',
                                                                'method' => 'post',
                                                            ],
                                                        ])
                                                        ?>
                                                </p>

                                                <?=
                                                DetailView::widget([
                                                    'model' => $model,
                                                    'attributes' => [
                                                        'id',
                                                        'enquiry_id',
                                                        'hospital_name',
                                                        'consultant_doctor',
                                                        'hospital_room_no',
                                                        'required_service',
                                                        'other_services',
                                                        'diabetic',
                                                        'hypertension',
                                                        'tubes',
                                                        'feeding',
                                                        'urine',
                                                        'oxygen',
                                                        'tracheostomy',
                                                        'iv_line',
                                                        'dressing',
                                                        'visit_type',
                                                        'visit_date',
                                                        'bedridden:ntext',
                                                    ],
                                                ])
                                                ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>


