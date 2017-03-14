<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Enquiry */

$this->title = $model->enquiry_id;
$this->params['breadcrumbs'][] = ['label' => 'Enquiries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


            </div>
            <div class="panel-body">
                <?= Html::a('<i class="fa-th-list"></i><span> Manage Enquiry</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <div class="panel-body"><div class="enquiry-view">
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
                                'contacted_source',
                                'contacted_date',
                                'incoming_missed',
                                'contacted_source_others',
                                'outgoing_number_from',
                                'outgoing_call_date',
                                'caller_name',
                                'referral_source',
                                'mobile_number',
                                'mobile_number_2',
                                'mobile_number_3',
                                'address',
                                'city',
                                'zip_pc',
                                'email:email',
                                'service_required_for',
                                'service_required_for_others',
                                'age',
                                'weight',
                                'relationship',
                                'veteran_or_spouse',
                                'person_address',
                                'person_city',
                                'person_postal_code',
                                'branch_id',
                                'status',
                                'CB',
                                'UB',
                                'DOC',
                                'DOU',
                            ],
                        ])
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


