<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use common\models\Branch;
use common\models\OutgoingNumbers;

/* @var $this yii\web\View */
/* @var $model common\models\Enquiry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enquiry-form form-inline">


        <?php $form = ActiveForm::begin(); ?>
        <?php // $form->errorSummary($model); ?>

        <!--	<div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
        <?php // $form->field($model, 'enquiry_id')->textInput() ?>

                </div>-->
        <div class="row">
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>

                        <?= $form->field($model, 'contacted_source')->dropDownList(['' => '--Select Contact Source--', '0' => 'Phone', '1' => 'Email', '2' => 'Others']) ?>
                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <div class="form-group field-enquiry-contacted_date">
                                <label class="control-label" for="enquiry-contacted_date">Contacted Date</label>
                                <?php
                                if (!$model->isNewRecord) {
                                        $model->contacted_date = date('d-M-Y h:i', strtotime($model->contacted_date));
                                } else {
                                        $model->contacted_date = date('d-M-Y h:i');
                                }
                                echo DateTimePicker::widget([
                                    'name' => 'Enquiry[contacted_date]',
                                    'type' => DateTimePicker::TYPE_INPUT,
                                    'value' => $model->contacted_date,
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'dd-M-yyyy hh:ii'
                                    ]
                                ]);
                                ?>

                                <?php $form->field($model, 'contacted_date')->textInput() ?>
                        </div>
                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd' id="contact_source">    <?= $form->field($model, 'incoming_missed')->textInput(['maxlength' => true]) ?>

                </div>
                <!--	<div class='col-md-4 col-sm-6 col-xs-12 left_padd' id="contact_others">

                <?php // $form->field($model, 'contacted_source_others')->textInput(['maxlength' => true]) ?>

                        </div>-->
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'> <?php $outgoing_numbers = OutgoingNumbers::find()->where(['status' => '1'])->orderBy('id DESC')->all() ?>   <?= $form->field($model, 'outgoing_number_from')->dropDownList(ArrayHelper::map($outgoing_numbers, 'id', 'phone_number'), ['prompt' => '--Select--']) ?>

                </div>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <div class="form-group field-enquiry-contacted_date">
                                <label class="control-label" for="enquiry-contacted_date">Outgoing Call Date</label>
                                <?php
                                if (!$model->isNewRecord) {
                                        $model->outgoing_call_date = date('d-M-Y h:i', strtotime($model->outgoing_call_date));
                                } else {
                                        $model->outgoing_call_date = date('d-M-Y h:i');
                                }
                                echo DateTimePicker::widget([
                                    'name' => 'Enquiry[outgoing_call_date]',
                                    'type' => DateTimePicker::TYPE_INPUT,
                                    'value' => $model->outgoing_call_date,
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'dd-M-yyyy hh:ii'
                                    ]
                                ]);
                                ?>

                        </div>
                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'caller_name')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'referral_source')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'mobile_number')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'mobile_number_2')->textInput(['maxlength' => true]) ?>

                </div>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd' style="min-height: 150px">

                        <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'mobile_number_3')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'zip_pc')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd '>

                        <?=
                        $form->field($model, 'email', ['template' => '<div class="section">
								<label class="control-label" for="enquiry-email">Email</label>
								{input}
                                                                  <p id="email_check" style="display: none;color:red;margin-top:3px;">This email has already been taken.<a target="_Blanak" href="">Click here to view more</a></p>
								</label>

							</div><div class="help-block"></div>'
                        ])->textInput(['class' => 'form-control',]);
                        ?>

                </div>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'service_required_for')->textInput(['maxlength' => true]) ?>



                </div>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'age')->textInput() ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'weight')->textInput() ?>

                </div>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd' id="service_required_others">

                        <?= $form->field($model, 'service_required_for_others')->textInput(['maxlength' => true]) ?>

                </div>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd' style="min-height: 150px;">
                        <?= $form->field($model, 'person_address')->textarea(['rows' => 6]) ?>


                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'relationship')->dropDownList(['' => '--Select--', '0' => 'Spouse', '1' => 'parent', '2' => 'Grandparent', '3' => 'Others']) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>

                        <?= $form->field($model, 'veteran_or_spouse')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No']) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'person_city')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'person_postal_code')->textInput(['maxlength' => true]) ?>

                </div>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($model, 'whatsapp_reply')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No']) ?>


                </div>
                <?php
                if (Yii::$app->user->identity->branch_id == '0') {
                        $branches = Branch::find()->where(['status' => '1'])->andWhere(['<>', 'id', '0'])->all();
                        ?>
                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($model, 'branch_id')->dropDownList(ArrayHelper::map($branches, 'id', 'branch_name'), ['prompt' => '--Select--']) ?>
                        </div>
                <?php } ?>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($model, 'status')->dropDownList(['' => '--Select--', '1' => 'Active', '2' => 'Pending', '3' => 'Close']) ?>

                </div>
        </div>
        <div class='col-md-4 col-sm-6 col-xs-12' style="float: right;">
                <div class="form-group" style="float: right;">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>
        </div>


        <?php ActiveForm::end(); ?>

</div>
<script>
        $(document).ready(function () {


                $('#service_required_others').hide();
                $("#enquiry-contacted_source").change(function () {
                        var contact_source = $("#enquiry-contacted_source option:selected").val();
                        if (contact_source == 0) {
                                $("label[for = enquiry-incoming_missed]").text("Incoming Number");
                        } else if (contact_source == 1) {
                                $("label[for = enquiry-incoming_missed]").text("Incoming Email Id");
                        } else {
                                $("label[for = enquiry-incoming_missed]").text("Contact Source Others");
                        }
                });

                $relationship = $("#enquiry-relationship option:selected").val();
                if ($relationship === '3') {
                        $('#service_required_others').show();
                } else {
                        $('#service_required_others').hide();
                }
                $("#enquiry-relationship").change(function () {
                        if ($("#enquiry-relationship option:selected").val() === '3')
                                $('#service_required_others').show();
                        else
                                $('#service_required_others').hide();
                });


        });




</script>

