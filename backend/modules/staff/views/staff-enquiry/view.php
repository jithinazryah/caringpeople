<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StaffEnquiry */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Staff Enquiries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">
                                <?= Html::a('<i class="fa-th-list"></i><span> Manage Staff Enquiry</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="staff-enquiry-view">
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
                                                        'name',
                                                            [
                                                            'attribute' => 'gender',
                                                            'value' => function($model) {
                                                                    if ($model->gender == '0') {
                                                                            return 'Male';
                                                                    } else if ($model->gender == '1') {
                                                                            return 'Female';
                                                                    }
                                                            }
                                                        ],
                                                            [
                                                            'attribute' => 'dob',
                                                            'value' => function($model) {
//                                                                    return Yii::$app->formatter->asDate($model->dob);
                                                                    if (isset($model->dob) && $model->dob != '0000-00-00') {
                                                                            $datee = date('d-m-Y', strtotime($model->dob));
                                                                            $age = date_diff(date_create($datee), date_create('today'))->y;
                                                                            if (isset($age))
                                                                                    return \Yii::$app->formatter->asDatetime($model->dob, "php:d-m-Y") . ' (' . $age . ')';
                                                                            else
                                                                                    return \Yii::$app->formatter->asDatetime($model->dob, "php:d-m-Y");
                                                                    }
                                                            }
                                                        ],
                                                        'phone_number',
                                                        'email:email',
                                                        'address',
                                                            [
                                                            'attribute' => 'designation',
                                                            'value' => function($model) {
                                                                    if ($model->designation == '0') {
                                                                            return 'Registered Nurse';
                                                                    } else if ($model->designation == '1') {
                                                                            return 'Care Assistant';
                                                                    }
                                                            }
                                                        ],
                                                        // 'follow_up_date',
                                                        'notes:ntext',
                                                            [
                                                            'attribute' => 'status',
                                                            'value' => $model->status == 1 ? 'Enabled' : 'Disabled',
                                                        ],
                                                    ],
                                                ])
                                                ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>


