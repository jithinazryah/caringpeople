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
                                    'model' => $patient_info,
                                ])
                                ?>
                                <div class="panel-body panel_body_background">

                                        <div class="tab-content tab_data_margin" id="tabs_1">

                                                <div class="tab-pane active" id="home-3">
                                                        <?php $form = ActiveForm::begin(); ?>
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
                                                            'hospital_details' => $hospital_details,
                                                            'form' => $form,
                                                        ])
                                                        ?>
                                                        <?php ActiveForm::end(); ?>
                                                </div>


                                                <div class="tab-pane" id="profile-4">
                                                        <?php $form_remark = ActiveForm::begin(['id' => 'add-remarks']); ?>
                                                        <?=
                                                        $this->render('remarks', [
                                                            'patient_info' => $patient_info,
                                                            'form_remark' => $form_remark,
                                                            'remarks' => $remarks,
                                                            'searchModel' => $searchModel,
                                                            'dataProvider' => $dataProvider,
                                                        ])
                                                        ?>
                                                        <?php ActiveForm::end(); ?>
                                                </div>

                                                <div class="tab-pane" id="profile-5">
                                                        <?php
                                                        /*
                                                          $this->render('remarks', [
                                                          'patient_info' => $patient_info,
                                                          'form' => $form1,
                                                          ]) */
                                                        ?>


                                                </div>



                                        </div>






                                </div>
                        </div>
                </div>
        </div>
</div>




