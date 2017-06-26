<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use common\models\Branch;
use common\models\OutgoingNumbers;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $patient_info common\models\PatientEnquiryGeneralFirst */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-enquiry-general-first-form form-inline">

        <h4 style="color:#000;font-style: italic;">Enquiry Details</h4>
        <hr class="enquiry-hr"/>

        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info, 'contacted_source')->dropDownList(['' => '--Select Contact Source--', '0' => 'Phone', '1' => 'Email', '2' => 'Others']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                <div class="form-group field-patientenquirygeneralfirst-contacted_date">
                        <label class="control-label" for="patientenquirygeneralfirst-contacted_date">Contacted Date</label>
                        <?php
                        if (!$patient_info->isNewRecord) {
                                $patient_info->contacted_date = date('d-M-Y h:i', strtotime($patient_info->contacted_date));
                        } else {
                                $patient_info->contacted_date = date('d-M-Y h:i');
                        }
                        echo DateTimePicker::widget([
                            'name' => 'PatientEnquiryGeneralFirst[contacted_date]',
                            'type' => DateTimePicker::TYPE_INPUT,
                            'value' => $patient_info->contacted_date,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-M-yyyy hh:ii'
                            ]
                        ]);
                        ?>



                </div>
        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd' id="contact_source">    <?php $outgoing_numbers = OutgoingNumbers::find()->where(['status' => '1'])->orderBy('id DESC')->all() ?>   <?= $form->field($patient_info, 'incoming_missed')->dropDownList(ArrayHelper::map($outgoing_numbers, 'phone_number', 'phone_number'), ['prompt' => '--Select--']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd' id='incoming_missed_other'>    <?= $form->field($patient_info, 'incoming_missed_other')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?php $outgoing_numbers = OutgoingNumbers::find()->where(['status' => '1'])->orderBy('id DESC')->all() ?>   <?= $form->field($patient_info, 'outgoing_number_from')->dropDownList(ArrayHelper::map($outgoing_numbers, 'id', 'phone_number'), ['prompt' => '--Select--']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd' id='outgoing_number_from_other'>    <?= $form->field($patient_info, 'outgoing_number_from_other')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                <div class="form-group field-patientenquirygeneralfirst-outgoing_call_date">
                        <label class="control-label" for="patientenquirygeneralfirst-outgoing_call_date">Outgoing Call Date</label>
                        <?php
                        if (!$patient_info->isNewRecord) {
                                $patient_info->outgoing_call_date = date('d-M-Y h:i', strtotime($patient_info->outgoing_call_date));
                        } else {
                                $patient_info->outgoing_call_date = date('d-M-Y h:i');
                        }
                        echo DateTimePicker::widget([
                            'name' => 'PatientEnquiryGeneralFirst[outgoing_call_date]',
                            'type' => DateTimePicker::TYPE_INPUT,
                            'value' => $patient_info->outgoing_call_date,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-M-yyyy hh:ii'
                            ]
                        ]);
                        ?>

                </div>


        </div><div style="clear:both"></div>

        <h4 style="color:#000;font-style: italic;">Enquirer Details</h4>
        <hr class="enquiry-hr"/>

        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info, 'caller_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info, 'caller_gender')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info, 'mobile_number')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info, 'mobile_number_2')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info, 'mobile_number_3')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info, 'referral_source')->dropDownList(['' => '--Select--', '0' => 'Internet', '1' => 'Care and care', '2' => 'Guardian Angel', '3' => 'Caremark', '4' => 'Cancure', '6' => 'Dont Know', '5' => 'Other']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd' id="referral_source_others">    <?= $form->field($patient_info, 'referral_source_others')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'address')->textarea(['rows' => 1]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'city')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'zip_pc')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'email')->textInput(['class' => 'form-control',]); ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'email1')->textInput(['maxlength' => true]) ?>

        </div><div style="clear:both"></div>

        <h4 style="color:#000;font-style: italic;">Service Details</h4>
        <hr class="enquiry-hr"/>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <?php
                if (!$patient_info_second->isNewRecord && $patient_info_second->required_service != '') {

                        $patient_info_second->required_service = explode(',', $patient_info_second->required_service);
                }
                ?>
                <?= $form->field($patient_info_second, 'required_service')->dropDownList(['1' => 'Doctor Visit', '2' => 'Nursing Care', '3' => 'Physiotherapy', '4' => 'Helath Checkup', '5' => 'Caregiver', '6' => 'Lab', '7' => 'Equipment', '8' => 'Other', '9' => 'General Enquiry', '10' => 'Wrong Number '], ['multiple' => 'multiple']) ?>
        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd' id='required_other_service'>    <?= $form->field($patient_info_second, 'required_service_other')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'service_required')->dropDownList(['' => '--Select--', '1' => 'Immediately', '2' => 'Couple Weeks', '3' => 'Month', '4' => 'Unsure', '5' => 'Other']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd' id="service_required">    <?= $form->field($patient_info_second, 'service_required_other')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                <?php
                if (!$patient_info_second->isNewRecord) {
                        $patient_info_second->expected_date_of_service = date('d-m-Y', strtotime($patient_info_second->expected_date_of_service));
                } else {
                        $patient_info_second->expected_date_of_service = date('d-m-Y');
                }
                echo DatePicker::widget([
                    'model' => $patient_info_second,
                    'form' => $form,
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'expected_date_of_service',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]);
                ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'how_long_service_required')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'whatsapp_reply')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd' id='whatsapp_number'>    <?= $form->field($patient_info_second, 'whatsapp_number')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd' id='whatsapp_note'>    <?= $form->field($patient_info_second, 'whatsapp_note')->textarea(['rows' => 1]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'priority')->dropDownList(['' => '--Select--', '1' => 'Hot', '2' => 'Warm', '3' => 'Cold']) ?>

        </div>
        <?php
        if (Yii::$app->user->identity->branch_id == '0') {
                $branches = Branch::find()->where(['status' => '1'])->andWhere(['<>', 'id', '0'])->all();
                ?>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($patient_info, 'branch_id')->dropDownList(ArrayHelper::map($branches, 'id', 'branch_name'), ['prompt' => '--Select--']) ?>
                </div>
        <?php } ?>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($patient_info, 'status')->dropDownList(['' => '--Select--', '1' => 'Active', '2' => 'Pending', '3' => 'Close', '4' => 'Home/Hospital Visit']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'quotation_details')->textarea(['rows' => 2]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_info_second, 'notes')->textarea(['rows' => 2]) ?>

        </div>

</div>


<style>
        .form-inline .control-label{
                min-height: 35px;
        }
</style>


