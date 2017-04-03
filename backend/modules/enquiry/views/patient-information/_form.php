<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker

/* @var $this yii\web\View */
/* @var $model common\models\PatientInformation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-information-form form-inline">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">


        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'contact_name')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'contact_gender')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'referral_source')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'contact_address')->textarea(['rows' => 6]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'contact_mobile_number_1')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'contact_mobile_number_2')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_mobile_number_3')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_city')->textInput() ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_zip_or_pc')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_email')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'contact_perosn_relationship')->dropDownList(['' => '--Select--', '0' => 'Spouse', '1' => 'parent', '2' => 'Grandparent', '3' => 'Others']) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd' id="other_relationships">
            <?= $form->field($model, 'other_relationships')->textInput(['maxlength' => true]) ?>

        </div>

    </div>
    <h2 style="color:#148eaf;">Patients Details</h2>
    <hr class="enquiry-hr"/>
    <div class="row">
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'patient_name')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'patient_gender')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'patient_age')->textInput() ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'patient_weight')->textInput() ?>

        </div>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'veteran_or_spouse')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No']) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'patient_address')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'patient_city')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'patient_postal_code')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'patient_current_status')->dropDownList(['' => '--Select--', '1' => 'Independent', '2' => 'Bedridden', '3' => 'Assistance Required 1', '4' => 'Assistance Required 2']) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <div class="form-group field-patientinformation-follow_up_date">
                <label class="control-label" for="patientinformation-follow_up_date">Follow Up Date</label>
                <?php
                if (!$model->isNewRecord) {
                    $model->follow_up_date = date('d-M-Y h:i', strtotime($model->follow_up_date));
                }
                else {
                    $model->follow_up_date = date('d-M-Y h:i');
                }
                echo DateTimePicker::widget([
                    'name' => 'PatientInformation[follow_up_date]',
                    'type' => DateTimePicker::TYPE_INPUT,
                    'value' => $model->follow_up_date,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-M-yyyy hh:ii'
                    ]
                ]);
                ?>
            </div>

        </div>
        <?php
        if (Yii::$app->user->identity->branch_id == '0') {
            $branches = Branch::find()->where(['status' => '1'])->andWhere(['<>', 'id', '0'])->all();
            ?>
            <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($model, 'branch_id')->dropDownList(ArrayHelper::map($branches, 'id', 'branch_name'), ['prompt' => '--Select--']) ?>
            </div>
        <?php } ?>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'status')->dropDownList(['' => '--Select--', '1' => 'Active', '2' => 'Pending', '3' => 'Close']) ?>


        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

        </div>
    </div>
    <div class='col-md-4 col-sm-6 col-xs-12' style="float:right;">
        <div class="form-group" style="float: right;">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>

    $("document").ready(function () {
        $('#other_relationships').hide();
        $relationship = $("#patientinformation-contact_perosn_relationship option:selected").val();
        if ($relationship === '3') {
            $('#other_relationships').show();
        } else {
            $('#other_relationships').hide();
        }
        $("#patientinformation-contact_perosn_relationship").change(function () {
            if ($("#patientinformation-contact_perosn_relationship option:selected").val() === '3')
                $('#other_relationships').show();
            else
                $('#other_relationships').hide();
        });

        $('#checkbox_id').on('change', function (e) {
            if (this.checked) {
                var address = $("#enquiry-address").val();
                var city = $("#enquiry-city").val();
                var postal_code = $("#enquiry-zip_pc").val();
                $("#enquiry-person_address").val(address);
                $("#enquiry-person_city").val(city);
                $("#enquiry-person_postal_code").val(postal_code);
            }
            if (!this.checked) {
                $("#enquiry-person_address").val('');
                $("#enquiry-person_city").val('');
                $("#enquiry-person_postal_code").val('');
            }
        });

    });
</script>
