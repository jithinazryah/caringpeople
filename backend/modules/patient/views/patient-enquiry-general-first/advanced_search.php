<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;
use yii\db\Expression;

/* @var $this yii\web\View */
/* @var $model app\models\PostSearch */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="enquiry-form form-inline">
        <?php
        $form = ActiveForm::begin([
                    'action' => ['index'],
                    'method' => 'get',
        ]);
        ?>
        <div class="row hidediv1">
                <div class="col-md-12">

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($model, 'contacted_source')->dropDownList(['' => '--Select Contact Source--', '0' => 'Phone', '1' => 'Email', '2' => 'Others']) ?>
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-enquiry-contacted_date">
                                        <label class="control-label" for="enquiry-contacted_date">Contacted Date From</label>
                                        <?php
                                        echo DateTimePicker::widget([
                                            'name' => 'Enquiry[contactedFrom]',
                                            'type' => DateTimePicker::TYPE_INPUT,
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                                'format' => 'yyyy-mm-dd hh:ii'
                                            ]
                                        ]);
                                        ?>
                                </div>
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-enquiry-contacted_date">
                                        <label class="control-label" for="enquiry-contacted_date">Contacted Date To</label>
                                        <?php
                                        echo DateTimePicker::widget([
                                            'name' => 'Enquiry[contactedTo]',
                                            'type' => DateTimePicker::TYPE_INPUT,
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                                'format' => 'yyyy-mm-dd hh:ii'
                                            ]
                                        ]);
                                        ?>
                                </div>
                        </div>

                        <!--                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?php // $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                                                </div>-->

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-enquiry-contacted_date">
                                        <label class="control-label" for="enquiry-contacted_date">Outgoing Call From</label>
                                        <?php
                                        echo DateTimePicker::widget([
                                            'name' => 'Enquiry[outgoingFrom]',
                                            'type' => DateTimePicker::TYPE_INPUT,
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                                'format' => 'yyyy-mm-dd hh:ii'
                                            ]
                                        ]);
                                        ?>
                                </div>
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-enquiry-contacted_date">
                                        <label class="control-label" for="enquiry-contacted_date">Outgoing Call To</label>
                                        <?php
                                        echo DateTimePicker::widget([
                                            'name' => 'Enquiry[outgoingTo]',
                                            'type' => DateTimePicker::TYPE_INPUT,
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                                'format' => 'yyyy-mm-dd hh:ii'
                                            ]
                                        ]);
                                        ?>
                                </div>
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($model, 'caller_name')->textInput(['maxlength' => true]) ?>

                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group">
                                        <?= Html::submitButton('Search', ['class' => 'btn btn-primary', 'style' => 'margin-top:16px;']) ?>
                                </div>
                        </div>


                </div>

                <?php ActiveForm::end(); ?>

        </div>
