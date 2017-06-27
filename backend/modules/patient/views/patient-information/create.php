<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PatientInformation */

$this->title = 'Create Patient Information';
$this->params['breadcrumbs'][] = ['label' => 'Patient Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                        </div>

                        <?= Html::a('<i class="fa-th-list"></i><span> Manage Patient</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone', 'style' => 'margin-top: 10px;']) ?>

                        <?=
                        $this->render('_menus', [
                            'model' => $patient_general,
                        ]);
                        ?>
                        <div class="panel-body panel_body_background" >

                                <div class="tab-content tab_data_margin" >

                                        <div class="tab-pane active" id="home-3">
                                                <?php
                                                $form = ActiveForm::begin();
                                                ?>
                                                <?=
                                                $this->render('_general_information', [
                                                    'form' => $form,
                                                    'model' => $model,
                                                    'patient_general' => $patient_general,
                                                ])
                                                ?>

                                        </div>
                                        <div class="tab-pane" id="profile-3">

                                                <?=
                                                $this->render('_chronic_information', [
                                                    'form' => $form,
                                                    'model' => $chronic_imformation,
                                                ])
                                                ?>

                                        </div>
                                        <div class="tab-pane" id="medication">

                                                <?=
                                                $this->render('_present_medication', [
                                                    'form' => $form,
                                                    'model' => $model,
                                                    'pationt_medication_details' => $pationt_medication_details,
                                                ])
                                                ?>

                                        </div>
                                        <div class="tab-pane" id="condition">

                                                <?=
                                                $this->render('_present_condition', [
                                                    'form' => $form,
                                                    'model' => $present_condition,
                                                ])
                                                ?>

                                        </div>
                                        <div class="tab-pane" id="bystander">

                                                <?=
                                                $this->render('_bystander_details', [
                                                    'form' => $form,
                                                    'model' => $bystander_details,
                                                ])
                                                ?>
                                                <?php ActiveForm::end(); ?>
                                        </div>


                                        <?php if (!$model->isNewRecord) { ?>
                                                <div class="tab-pane" id="profile-12">
                                                        <?php $form_remark = ActiveForm::begin(['id' => 'add-remarks']); ?>
                                                        <?=
                                                        $this->render('remarks', [
                                                            'patient_info' => $patient_general,
                                                            'form_remark' => $form_remark,
                                                            'remarks' => $remarks,
                                                            'searchModel' => $searchModel,
                                                            'dataProvider' => $dataProvider,
                                                        ])
                                                        ?>
                                                        <?php ActiveForm::end(); ?>
                                                </div>

                                                <div class="tab-pane" id="profile-13">

                                                        <?php
                                                        $form_followup = ActiveForm::begin(['id' => 'add-followup', 'options' => ['enctype' => 'multipart/form-data']]);
                                                        //$form_followup = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'add-followup',]]);
                                                        ?>
                                                        <?=
                                                        $this->render('followups', [
                                                            'patient_info' => $patient_general,
                                                            'form_followup' => $form_followup,
                                                            'followups' => $followups,
                                                            'searchModel' => $searchModel1,
                                                            'dataProvider' => $dataProvider1,
                                                        ])
                                                        ?>
                                                        <?php ActiveForm::end(); ?>

                                                </div>

                                        <?php } ?>


                                </div>









                        </div>
                </div>
        </div>
</div>

