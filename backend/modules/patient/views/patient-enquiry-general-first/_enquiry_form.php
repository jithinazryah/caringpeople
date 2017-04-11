<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EnquirySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patient Enquiries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enquiry-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                                </div>

                                <?= Html::a('<i class="fa-th-list"></i><span> Manage Enquiry</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone', 'style' => 'margin-top:10px']) ?>
                                <?=
                                $this->render('_menus', [
                                    'model' => $model,
                                    'followup_id' => $followup_id,
                                ])
                                ?>
                                <div class="panel-body panel_body_background">
                                        <?php $form = ActiveForm::begin(); ?>
                                        <div class="tab-content tab_data_margin">

                                                <div class="tab-pane active" id="home-3">

                                                        <?=
                                                        $this->render('enquiry_general_form', [
                                                            'patient_info' => $patient_info,
                                                            'patient_info_second' => $patient_info_second,
                                                            'form' => $form,
                                                        ])
                                                        ?>

                                                </div>
                                                <div class="tab-pane" id="profile-3">

                                                        <?=
                                                        $this->render('enquiry_hospital_form', [
                                                            'patient_hospital' => $patient_hospital,
                                                            'patient_hospital_second' => $patient_hospital_second,
                                                            'form' => $form,
                                                        ])
                                                        ?>
                                                </div>


                                                <div class="tab-pane" id="settings-3">

                                                        <?=
                                                        $this->render('_followup_form', [
                                                            'followup_info' => $followup_info,
                                                            'form' => $form,
                                                            'model' => $patient_info,
                                                            'dataProvider' => $dataProvider,
                                                            'followup_id' => $followup_id,
                                                        ])
                                                        ?>
                                                </div>

                                        </div>
                                        <div class='col-md-12 col-sm-6 col-xs-12' >
                                                <div class="form-group" >
                                                        <?php if ($patient_info->isNewRecord) { ?>
                                                                <?= Html::submitButton($patient_info->isNewRecord ? 'Create' : 'Update', ['class' => $patient_info->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;', 'id' => 'form_button']) ?>
                                                                <?php
                                                        } else {
                                                                ?>
                                                                <?= Html::submitButton($patient_info->isNewRecord ? 'Create' : 'Update', ['class' => $patient_info->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;', 'id' => 'form_button', 'name' => update_button]) ?>
                                                                <?= Html::submitButton('Proceed to Patient', ['class' => 'btn btn-primary', 'style' => 'margin-top: 18px;height: 36px; width: auto;', 'name' => 'patinet_info']) ?>
                                                        <?php } ?>
                                                </div>
                                        </div>
                                        <?php ActiveForm::end(); ?>




                                </div>
                        </div>
                </div>
        </div>
</div>




