<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ContactCategoryTypes;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\ContactSubcategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-subcategory-form form-inline">

        <?php $form = ActiveForm::begin(); ?>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?php
                $category = ArrayHelper::map(ContactCategoryTypes::find()->where(['status' => 1])->all(), 'id', 'category_name');
                ?> <?= $form->field($model, 'category_id')->dropDownList($category, ['prompt' => '--Select--', 'class' => 'form-control']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'sub_category')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12'>
                <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>
        </div>

        <?php ActiveForm::end(); ?>

</div>
