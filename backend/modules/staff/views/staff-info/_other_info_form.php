<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\StaffOtherInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-other-info-form form-inline">

        <h3 style="color:#148eaf;">Current Employer (For Part-time employees)</h3>
        <hr class="enquiry-hr"/>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'hospital_address')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'designation')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'length_of_service')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <div class="form-group field-staffotherinfo-current_from">
                        <label class="control-label" for="staffotherinfo-current_from">From</label>
                        <?php
                        if (!$model->isNewRecord) {
                                $model->current_from = date('d-m-Y', strtotime($model->current_from));
                        } else {
                                $model->current_from = date('d-m-Y');
                        }

                        echo DatePicker::widget([
                            'name' => 'StaffOtherInfo[current_from]',
                            'type' => DatePicker::TYPE_INPUT,
                            'value' => $model->current_from,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy',
                            ]
                        ]);
                        ?>
                </div>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <div class="form-group field-staffotherinfo-current_to">
                        <label class="control-label" for="staffotherinfo-current_to">To</label>
                        <?php
                        if (!$model->isNewRecord) {
                                $model->current_to = date('d-m-Y', strtotime($model->current_to));
                        } else {
                                $model->current_to = date('d-m-Y');
                        }

                        echo DatePicker::widget([
                            'name' => 'StaffOtherInfo[current_to]',
                            'type' => DatePicker::TYPE_INPUT,
                            'value' => $model->current_from,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy',
                            ]
                        ]);
                        ?>
                </div>

        </div>

        <div style="clear:both"></div>

        <h3 style="color:#148eaf;">Previous Employer</h3>
        <hr class="enquiry-hr"/>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_previous_employer, 'hospital_address')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_previous_employer, 'designation')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_previous_employer, 'length_of_service')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>

                <div class="form-group field-staffperviousemployer-service_from">
                        <label class="control-label" for="staffperviousemployer-service_from">From</label>
                        <?php
                        if (!$model->isNewRecord) {
                                $staff_previous_employer->service_from = date('d-m-Y', strtotime($staff_previous_employer->service_from));
                        } else {
                                $staff_previous_employer->service_from = date('d-m-Y');
                        }

                        echo DatePicker::widget([
                            'name' => 'StaffPerviousEmployer[service_from]',
                            'type' => DatePicker::TYPE_INPUT,
                            'value' => $staff_previous_employer->service_from,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy',
                            ]
                        ]);
                        ?>
                </div>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <div class="form-group field-staffperviousemployer-service_to">
                        <label class="control-label" for="staffperviousemployer-service_to">To</label>
                        <?php
                        if (!$model->isNewRecord) {
                                $staff_previous_employer->service_to = date('d-m-Y', strtotime($staff_previous_employer->service_to));
                        } else {
                                $staff_previous_employer->service_to = date('d-m-Y');
                        }

                        echo DatePicker::widget([
                            'name' => 'StaffPerviousEmployer[service_to]',
                            'type' => DatePicker::TYPE_INPUT,
                            'value' => $staff_previous_employer->service_to,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy',
                            ]
                        ]);
                        ?>
                </div>

        </div> <div style="clear:both"></div>

        <h3 style="color:#148eaf;">Emergency Contact</h3>
        <hr class="enquiry-hr"/>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'emergency_contact_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'relationship')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'alt_emergency_contact_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'alt_relationship')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'alt_phone')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'alt_mobile')->textInput(['maxlength' => true]) ?>

        </div>




</div>
