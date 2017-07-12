<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ServiceDiscounts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-discounts-form form-inline">

        <?php $form = ActiveForm::begin(); ?>
        <?php $model->rate = $service->estimated_price; ?>

        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'rate')->textInput(['maxlength' => true, 'readonly' => TRUE]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'discount_type')->radioList(array('1' => 'Percentage (%)', 2 => 'Fixed (Rs.)')); ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'discount_value')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'total_amount')->textInput(['maxlength' => true]) ?>

        </div>

        <div class='row' >
                <div class="form-group" >
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>
        </div>

        <?php ActiveForm::end(); ?>

</div>
