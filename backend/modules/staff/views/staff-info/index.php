<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Branch;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StaffInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Staffs';
$this->params['breadcrumbs'][] = $this->title;
$path = Yii::getAlias(Yii::$app->params['uploadPath']);
$branch = Branch::branch();
?>
<div class="staff-info-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">

                                        <?php if (Yii::$app->session->hasFlash('error')): ?>
                                                <div class="alert alert-danger" role="alert">
                                                        <?= Yii::$app->session->getFlash('error') ?>
                                                </div>
                                        <?php endif; ?>
                                        <?php if (Yii::$app->session->hasFlash('success')): ?>
                                                <div class="alert alert-success" role="alert">
                                                        <?= Yii::$app->session->getFlash('success') ?>
                                                </div>
                                        <?php endif; ?>
                                        <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

                                        <?= Html::a('<i class="fa-th-list"></i><span> New Staff</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                        <?=
                                        GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
                                                    [
                                                    'attribute' => 'profile_image_type',
                                                    'format' => 'html',
                                                    'value' => function($data) {
                                                            if ($data->profile_image_type != '') {
                                                                    return Html::img(Yii::$app->homeUrl . '../uploads/staff/' . $data->id . '/profile_image_type.' . $data->profile_image_type, ['width' => '100']);
                                                            } elseif ($data->gender == '0') {
                                                                    return Html::img(Yii::$app->homeUrl . '/images/themes/photo.png', ['width' => '100']);
                                                            } else if ($data->gender == '1') {
                                                                    return Html::img(Yii::$app->homeUrl . '/images/themes/female.png', ['width' => '100']);
                                                            } else {
                                                                    return Html::img(Yii::$app->homeUrl . 'images/themes/no-image.gif', ['width' => '100']);
                                                            }
                                                    },
                                                ],
                                                'staff_id',
                                                'staff_name',
                                                    [
                                                    'attribute' => 'gender',
                                                    'value' => function($model, $key, $index, $column) {
                                                            if ($model->gender == '0') {
                                                                    return 'Male';
                                                            } else if ($model->gender == '1') {
                                                                    return 'Female';
                                                            }
                                                    },
                                                    'filter' => [1 => 'Female', 0 => 'Male'],
                                                ],
                                                'place',
                                                    [
                                                    'attribute' => 'designation',
                                                    'value' => function($model, $key, $index, $column) {
                                                            if ($model->designation == '0') {
                                                                    return 'Registered Nurse';
                                                            } else if ($model->designation == '1') {
                                                                    return 'Care Assistant';
                                                            }
                                                    },
                                                    'filter' => [1 => 'Care Assistant', 0 => 'Registered Nurse'],
                                                ],
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
                                                [
                                                    'attribute' => 'branch_id',
                                                    'value' => function($data) {
                                                            return Branch::findOne($data->branch_id)->branch_name;
                                                    },
                                                    'filter' => ArrayHelper::map($branch, 'id', 'branch_name'),
                                                ],
                                                // 'status',
                                                // 'CB',
                                                // 'UB',
                                                // 'DOC',
                                                // 'DOU',
                                                ['class' => 'yii\grid\ActionColumn'],
                                            ],
                                        ]);
                                        ?>
                                </div>
                        </div>
                </div>
        </div>
</div>


