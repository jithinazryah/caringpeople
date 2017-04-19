<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EnquirySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Enquiries';
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
                                <div class="panel-body">
                                        <?php $form = ActiveForm::begin(); ?>
                                        <div class="tab-content" style="margin-left: 15px;">

                                                <div class="tab-pane active" id="home-3">

                                                        <?=
                                                        $this->render('_form', [
                                                            'model' => $model, //general_info
                                                            'hospital_info' => $hospital_info,
                                                            'other_info' => $other_info,
                                                            'form' => $form,
                                                        ])
                                                        ?>

                                                </div>
                                                <div class="tab-pane" id="profile-3">

                                                        <?=
                                                        $this->render('_hospital_form', [
                                                            'general_info' => $model,
                                                            'model' => $hospital_info,
                                                            'form' => $form,
                                                        ])
                                                        ?>
                                                </div>
                                                <div class="tab-pane" id="messages-3">

                                                        <?=
                                                        $this->render('_other_info_form', [
                                                            'model' => $other_info,
                                                            'form' => $form,
                                                        ])
                                                        ?>
                                                </div>

                                                <div class="tab-pane" id="settings-3">

                                                        <?=
                                                        $this->render('_followup_form', [
                                                            'followup_info' => $followup_info,
                                                            'form' => $form,
                                                            'model' => $model,
                                                            'dataProvider' => $dataProvider,
                                                            'followup_id' => $followup_id,
                                                        ])
                                                        ?>
                                                </div>

                                        </div>
                                        <div class='col-md-12 col-sm-6 col-xs-12' >
                                                <div class="form-group" >
                                                        <?php if ($model->isNewRecord) { ?>
								<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;', 'id' => 'form_button']) ?>
								<?php
							} else {
								?>
								<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;', 'id' => 'form_button', 'name' => update_button]) ?>
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

<script>
        $('#form_button').click(function (e) { // using click function
                // on contact form submit button
                e.preventDefault();  // stop form from submitting right away

                var error = false;

                $(this).find('.required').each(function () {
                        if ($(this).val().length < 1) {
                                error = true;
                        }
                });
                if (error == false) {

                        var Id = $('.tab-pane.active').attr('id');
                        $('#'.Id).removeClass('active');
                        $('#home-3').addClass('active');  // you submit form
                        $("#w0").submit();
                }
                if (!error) {
                        return true;
                }

        });


</script>


