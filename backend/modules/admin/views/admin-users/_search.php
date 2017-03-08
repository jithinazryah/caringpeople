<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AdminUsersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'postid') ?>

    <?= $form->field($model, 'employee_code') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'phoneno') ?>

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
