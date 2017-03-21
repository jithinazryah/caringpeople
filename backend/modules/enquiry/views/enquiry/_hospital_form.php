<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\EnquiryHospital */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enquiry-hospital-form form-inline">



        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'hospital_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'consultant_doctor')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'department')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'hospital_room_no')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <?php
                if (!$model->isNewRecord) {

                        $model->required_service = explode(',', $model->required_service);
                }
                ?>
                <?= $form->field($model, 'required_service')->dropDownList(['1' => 'Doctor Visit', '2' => 'Nursing Care', '3' => 'Physiotherapy', '4' => 'Companion Care', '5' => 'Bystander Service', '6' => 'General Information', '7' => 'Other Services'], ['multiple' => 'multiple', 'style' => 'height:58px !important', 'selected' => $required]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' id='required_other_service'>    <?= $form->field($model, 'other_services')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'diabetic')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' id='diabetic_note'>    <?= $form->field($model, 'diabetic_note')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'hypertension')->textInput(['maxlength' => true]) ?>

        </div>
        <!--                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?php //$form->field($model, 'tubes')->textInput(['maxlength' => true])                                                                                                     ?>

                        </div>-->
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'feeding')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'urine')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'oxygen')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'tracheostomy')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'iv_line')->textInput(['maxlength' => true]) ?>

        </div>
        <!--        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?php //$form->field($model, 'dressing')->textInput(['maxlength' => true])                                                                                                   ?>

                </div>-->
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'visit_type')->dropDownList(['' => '--Select--', '1' => 'Hospital Visit', '0' => 'Home Visit']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'visit_note')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <div class="form-group field-enquiryhospital-visit_date">
                        <label class="control-label" for="enquiryhospital-visit_date">Hospital Visit Date</label>
                        <?php
                        if (!$model->isNewRecord) {
                                $model->visit_date = date('d-M-Y h:i', strtotime($model->visit_date));
                        } else {
                                $model->visit_date = date('d-M-Y h:i');
                        }
                        echo DateTimePicker::widget([
                            'name' => 'EnquiryHospital[visit_date]',
                            'type' => DateTimePicker::TYPE_INPUT,
                            'value' => $model->visit_date,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-M-yyyy hh:ii'
                            ]
                        ]);
                        ?>

                </div>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'bedridden')->textarea(['rows' => 4]) ?>

        </div>



</div>


<script>
        $(document).ready(function () {

                $('#diabetic_note').hide();
                $('#required_other_service').hide();


                /* Diabetic note show/hide on diabetic change*/

                $("#enquiryhospital-diabetic").change(function () {
                        if ($(this).val() === '1')
                                $('#diabetic_note').show();
                        else
                                $('#diabetic_note').hide();
                });

                /* Diabetic note on update*/
                if ($('#enquiryhospital-diabetic').val() === '1')
                        $('#diabetic_note').show();
                else
                        $('#diabetic_note').hide();


                /* Other service note show/hide on selecting other service from required service*/
                $("#enquiryhospital-required_service").change(function () {
                        var required_service = $(this).val();
                        if (jQuery.inArray("7", required_service) !== -1)
                                $('#required_other_service').show();
                        else
                                $('#required_other_service').hide();


                });
                /* Other service note show/hide on update */
                var required_service = $("#enquiryhospital-required_service").val();
                if (jQuery.inArray("7", required_service) !== -1)
                        $('#required_other_service').show();
                else
                        $('#required_other_service').hide();

        });
</script>