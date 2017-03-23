<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\StaffEnquiry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-enquiry-form form-inline">

        <?php $form = ActiveForm::begin(); ?>



        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <div class="form-group field-staffenquiry-follow_up_date">
                        <label class="control-label" for="staffenquiry-follow_up_date">Followup Date</label>

                        <?php
                        if (!$model->isNewRecord) {
                                $model->follow_up_date = date('d-M-Y h:i', strtotime($model->follow_up_date));
                        } else {
                                $model->follow_up_date = date('d-M-Y h:i');
                        }
                        echo DateTimePicker::widget([
                            'name' => 'StaffEnquiry[follow_up_date]',
                            'type' => DateTimePicker::TYPE_INPUT,
                            'value' => $model->follow_up_date,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-M-yyyy hh:ii'
                            ]
                        ]);
                        ?>

                </div>

        </div><div class = 'col-md-4 col-sm-6 col-xs-12 left_padd'> <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>


        </div>
        <div class='col-md-4 col-sm-6 col-xs-12' >
                <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                        <?php
                        if (!$model->isNewRecord) {
                                echo Html::submitButton('Proceed to Staff', ['name' => 'proceed', 'class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:125px;']);
                        }
                        ?>
                </div>
        </div>

        <?php ActiveForm::end(); ?>

</div>
