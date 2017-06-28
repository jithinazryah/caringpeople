<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EnquirySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Staff Enquiries';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="enquiry-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                                </div>

                                <?= Html::a('<i class="fa-th-list"></i><span> Manage Staff Enquiry</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone', 'style' => 'margin-top:10px;']) ?>


                                <?=
                                $this->render('_menus', [
                                    'staff_enquiry' => $staff_enquiry,
                                ])
                                ?>

                                <div class="panel-body panel_body_background" >

                                        <div class="tab-content tab_data_margin" >

                                                <div class="tab-pane active" id="home-3">
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
                                                        <?php $form = ActiveForm::begin(); ?>
                                                        <?=
                                                        $this->render('_form', [
                                                            //   'model' => $model,
                                                            'staff_edu' => $staff_edu,
                                                            'staff_enquiry' => $staff_enquiry,
                                                            'staff_interview_first' => $staff_interview_first,
                                                            'form' => $form,
                                                        ])
                                                        ?>

                                                </div>




                                                <div class="tab-pane" id="profile-3">

                                                        <?=
                                                        $this->render('_other_info_form', [
                                                            'model' => $other_info,
                                                            'staff_previous_employer' => $staff_previous_employer,
                                                            'staff_previous_employer' => $staff_previous_employer,
                                                            'staff_interview_first' => $staff_interview_first,
                                                            'staff_interview_second' => $staff_interview_second,
                                                            'staff_interview_third' => $staff_interview_third,
                                                            'form' => $form,
                                                            'staff_enquiry' => $staff_enquiry,
                                                        ])
                                                        ?>
                                                </div>
                                                <div class="tab-pane" id="profile-4">

                                                        <?=
                                                        $this->render('_staff_enquiry_interview', [
                                                            'model' => $other_info,
                                                            'staff_previous_employer' => $staff_previous_employer,
                                                            'staff_interview_first' => $staff_interview_first,
                                                            'staff_interview_second' => $staff_interview_second,
                                                            'staff_interview_third' => $staff_interview_third,
                                                            'staff_family' => $staff_family,
                                                            'form' => $form,
                                                            'staff_enquiry' => $staff_enquiry,
                                                        ])
                                                        ?>
                                                        <?php ActiveForm::end(); ?>
                                                </div>

                                                <?php if (!$patient_info->isNewRecord) { ?>
                                                        <div class="tab-pane" id="profile-12">
                                                                <?=
                                                                $this->render('remarks', [
                                                                    'patient_info' => $staff_enquiry,
                                                                    'type' => 3,
                                                                ])
                                                                ?>
                                                        </div>

                                                        <div class="tab-pane" id="profile-13">

                                                                <?=
                                                                $this->render('followups', [
                                                                    'patient_info' => $staff_enquiry,
                                                                    'type' => 3,
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



