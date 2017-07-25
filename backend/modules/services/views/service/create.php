<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EnquirySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Services';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="enquiry-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                                </div>

                                <?= Html::a('<i class="fa-th-list"></i><span> Manage Service</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone', 'style' => 'margin-top:10px;']) ?>

                                <?=
                                $this->render('_menus', [
                                    'model' => $model,
                                ])
                                ?>
                                <div class="panel-body panel_body_background" >

                                        <div class="tab-content tab_data_margin" >

                                                <div class="tab-pane active" id="home-3">

                                                        <?php
                                                        echo $this->render('_form', [
                                                            'model' => $model,
                                                        ]);
                                                        ?>

                                                </div>
                                                <?php if (!$model->isNewRecord) { ?>
                                                        <div class="tab-pane" id="home-5">

                                                                <?=
                                                                $this->render('schedules', [
                                                                    'model' => $model,
                                                                    'service_schedule' => $service_schedule,
                                                                ])
                                                                ?>

                                                        </div>

                                                        <div class="tab-pane" id="home-6">

                                                                <?=
                                                                $this->render('_patient_assessment', [
                                                                    'model' => $model,
                                                                    'patient_assessment' => $patient_assessment
                                                                ])
                                                                ?>

                                                        </div>

                                                        <div class="tab-pane" id="home-7">

                                                                <?=
                                                                $this->render('@backend/modules/accounts/views/service-discounts/_form', [
                                                                    'service' => $model,
                                                                    'model' => $discounts
                                                                ])
                                                                ?>

                                                        </div>

                                                        <div class="tab-pane " id="home-12">
                                                                <?=
                                                                $this->render('remarks', [
                                                                    'patient_info' => $model,
                                                                    'type' => 5,
                                                                ])
                                                                ?>
                                                        </div>
                                                        <div class="tab-pane" id="profile-13">
                                                                <?=
                                                                $this->render('followups', [
                                                                    'patient_info' => $model,
                                                                    'type' => 5,
                                                                ])
                                                                ?>
                                                        </div>
                                                <?php } ?>




                                        </div>








                                </div>
                        </div>
                </div>
        </div>
</div>
