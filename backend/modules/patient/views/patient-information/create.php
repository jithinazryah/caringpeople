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

                        <?= Html::a('<i class="fa-th-list"></i><span> Manage Enquiry</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone', 'style' => 'margin-top: 10px;']) ?>
                        <?php if (!$patient_general->isNewRecord) { ?>
                                <a href="javascript:;" id="2_<?= $patient_general->id; ?>"  class="btn btn-primary btn-single btn-sm Addfollowup" style="height: 36px;padding: 8px;">Add Followups</a>
                        <?php } ?>
                        <?=
                        $this->render('_menus', [
                            'model' => $model,
                        ])
                        ?>
                        <div class="panel-body panel_body_background" >
                                <?php
                                $form = ActiveForm::begin();
                                ?>
                                <div class="tab-content tab_data_margin" >

                                        <div class="tab-pane active" id="home-3">

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
                                                    // 'model' => $present_medication,
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

                                        </div>





                                </div>
                                <div class='col-md-12 col-sm-6 col-xs-12' >
                                        <div class="form-group" >
                                                <?= Html::submitButton($patient_general->isNewRecord ? 'Create' : 'Update', ['class' => $patient_general->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;', 'id' => 'form_button']) ?>

                                        </div>
                                </div>



                                <?php ActiveForm::end(); ?>




                        </div>
                </div>
        </div>
</div>

