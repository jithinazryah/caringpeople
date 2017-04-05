<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\PatientEnquiryGeneralSecond */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-enquiry-general-second-form form-inline">

        <?php $form = ActiveForm::begin(); ?>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'zip_pc')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'email', ['template' => '<div class="section">
                                                        <label class="control-label" for="enquiry-email">Email</label>
                                                        {input}
                                                          <p id="email_check" style="display: none;color:red;margin-top:3px;">This email has already been taken.<a target="_Blanak" href="">Click here to view more</a></p>
                                                        </label>

                                                </div><div class="help-block"></div>'])->textInput(['class' => 'form-control',]); ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'whatsapp_reply')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' id='whatsapp_number'>    <?= $form->field($model, 'whatsapp_number')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' id='whatsapp_note'>    <?= $form->field($model, 'whatsapp_note')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <?php
                if (!$model->isNewRecord) {

                        $model->required_service = explode(',', $model->required_service);
                }
                ?>
                <?= $form->field($model, 'required_service')->dropDownList(['1' => 'Doctor Visit', '2' => 'Nursing Care', '3' => 'Physiotherapy', '4' => 'Companion Care', '5' => 'Bystander Service', '6' => 'General Information', '7' => 'Other Services'], ['multiple' => 'multiple', 'style' => 'height:58px !important', 'selected' => $required]) ?>


        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' id='required_other_service'>    <?= $form->field($model, 'required_service_other')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'service_required')->dropDownList(['' => '--Select--', '1' => 'Immediately', '2' => 'Couple Weeks', '3' => 'Month', '4' => 'Unsure', '5' => 'Other']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' id="service_required">    <?= $form->field($model, 'service_required_other')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <div class="form-group field-patientenquirygeneralsecond-expected_date_of_service">
                        <label class="control-label" for="patientenquirygeneralsecond-expected_date_of_service">Expected Date Of Service Needed</label>
                        <?php
                        if (!$model->isNewRecord) {
                                $model->expected_date_of_service = date('d-m-Y', strtotime($model->expected_date_of_service));
                        } else {
                                $model->expected_date_of_service = date('d-m-Y');
                        }

                        echo DatePicker::widget([
                            'name' => 'PatientEnquiryGeneralSecond[expected_date_of_service]',
                            'type' => DatePicker::TYPE_INPUT,
                            'value' => $model->expected_date_of_service,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy',
                            ]
                        ]);
                        ?>


                </div>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'how_long_service_required')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'visit_type')->dropDownList(['' => '--Select--', '1' => 'Hospital Visit', '0' => 'Home Visit', '2' => 'No need']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'quotation_details')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'priority')->dropDownList(['' => '--Select--', '1' => 'Hot', '2' => 'Warm', '3' => 'Cold']) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12' >
                <div class="form-group" >
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>
        </div>

        <?php ActiveForm::end(); ?>

</div>
