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

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'diabetic')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No', '2' => 'Yes,Insulin', '3' => 'Yes, On Tablet', '4' => 'Dont Know']) ?>
        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' id='diabetic_note'>    <?= $form->field($model, 'diabetic_note')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'hypertension')->textInput(['maxlength' => true]) ?>

        </div>
        <!--                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?php //$form->field($model, 'tubes')->textInput(['maxlength' => true])                                                                                                     ?>

                        </div>-->
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'feeding')->dropDownList(['' => '--Select--', '0' => 'Nasogastric', '1' => 'Nasoduodenal', '2' => 'Nasojejunal Tubes', '3' => 'Gastrostomy', '4' => 'Gastrojejunostomy', '5' => 'Jejunostomyfeeding tube']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'urine')->dropDownList(['' => '--Select--', '0' => 'Foleys catheter', '1' => 'Suprapubic', '2' => 'Condom catheter']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'oxygen')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No', '2' => 'Ventilator', '3' => 'BiPAP', '4' => 'SOS']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'tracheostomy')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'iv_line')->textInput(['maxlength' => true]) ?>

        </div>
        <!--        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?php //$form->field($model, 'dressing')->textInput(['maxlength' => true])                                                                                                   ?>

                </div>-->
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'visit_type')->dropDownList(['' => '--Select--', '1' => 'Hospital Visit', '0' => 'Home Visit', '2' => 'No need']) ?>

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

