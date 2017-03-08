<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AdminPostsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-posts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'post_name') ?>

    <?= $form->field($model, 'enquiry') ?>

    <?= $form->field($model, 'users') ?>

    <?= $form->field($model, 'employees') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'cb') ?>

    <?php // echo $form->field($model, 'ub') ?>

    <?php // echo $form->field($model, 'doc') ?>

    <?php // echo $form->field($model, 'dou') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
