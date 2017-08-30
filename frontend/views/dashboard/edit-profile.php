<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\AdminPosts */
Pjax::begin();
$this->title = 'Edit Profile';
$this->params['breadcrumbs'][] = ['label' => 'Admin Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                        </div>

                        <div class="panel-body">
                                <div class="panel-body"><div class="admin-posts-create">
                                                <div class="">
                                                        <label style="color:#000;font-weight: bold;text-transform: uppercase;"><b>Patient Id  :  <?= $model->patient_id ?></b></label>

                                                        <?php if (Yii::$app->session->hasFlash('error')): ?>

                                                                <div class="alert alert-danger">
                                                                        <button type="button" class="close" data-dismiss="alert">
                                                                                <span aria-hidden="true">&times;</span>
                                                                                <span class="sr-only">Close</span>
                                                                        </button>
                                                                        <?= Yii::$app->session->getFlash('error') ?>
                                                                </div>
                                                        <?php endif; ?>
                                                        <?php if (Yii::$app->session->hasFlash('success')): ?>
                                                                <div class="alert alert-success">
                                                                        <button type="button" class="close" data-dismiss="alert">
                                                                                <span aria-hidden="true">&times;</span>
                                                                                <span class="sr-only">Close</span>
                                                                        </button>

                                                                        <?= Yii::$app->session->getFlash('success') ?>
                                                                </div>
                                                        <?php endif; ?>
                                                        <div class="row disp_image">

                                                                <?php
                                                                if ($model->patient_image != '') {
                                                                        ?>
                                                                        <img src="<?= Yii::$app->homeUrl . 'uploads/patient/' . $model->id . '/patient_image.' . $model->patient_image; ?> " style="float: right"/>
                                                                <?php }
                                                                ?>
                                                        </div>

                                                        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

                                                        <div class="row">

                                                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                                        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

                                                                </div>
                                                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                                        <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

                                                                </div>
                                                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                                        <?= $form->field($model, 'gender')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>

                                                                </div>
                                                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                                        <?= $form->field($model, 'age')->textInput(['maxlength' => true]) ?>

                                                                </div>
                                                        </div>

                                                        <div class="row">

                                                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                                        <?php
                                                                        if (!$model->isNewRecord) {
                                                                                $model->dob = date('d-m-Y', strtotime($model->dob));
                                                                        }
                                                                        ?>
                                                                        <?=
                                                                        DatePicker::widget([
                                                                            'model' => $model,
                                                                            'form' => $form,
                                                                            'type' => DatePicker::TYPE_INPUT,
                                                                            'attribute' => 'dob',
                                                                            'pluginOptions' => [
                                                                                'autoclose' => true,
                                                                                'format' => 'dd-mm-yyyy',
                                                                            ]
                                                                        ]);
                                                                        ?>

                                                                </div>
                                                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                                        <?= $form->field($model, 'weight')->textInput() ?>

                                                                </div>
                                                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                                        <?= $form->field($model, 'blood_group')->textInput(['maxlength' => true]) ?>

                                                                </div>

                                                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                                        <?= $form->field($model, 'present_address')->textarea(['rows' => 1]) ?>

                                                                </div>
                                                        </div>

                                                        <div class="row">
                                                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                                        <?= $form->field($model, 'pin_code')->textInput() ?>

                                                                </div>
                                                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                                        <?= $form->field($model, 'landmark')->textInput(['maxlength' => true]) ?>

                                                                </div>
                                                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                                        <?= $form->field($model, 'contact_number')->textInput() ?>

                                                                </div>
                                                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                                                                </div>

                                                        </div>

                                                        <div class="row">

                                                                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                                        <?= $form->field($model, 'patient_image')->fileInput() ?>

                                                                </div>


                                                                <div class='col-md-2 col-sm-6 col-xs-12 left_padd' style="display:none">

                                                                        <?= $form->field($model, 'branch_id')->textInput() ?>

                                                                </div>
                                                        </div>

                                                        <div class="row">
                                                                <div class="col-md-12">
                                                                        <div class="form-group" style="float: left;">
                                                                                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px;margin-left: 20px;']) ?>
                                                                        </div>
                                                                </div>
                                                        </div>

                                                        <?php ActiveForm::end(); ?>

                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>

<?php Pjax::end(); ?>

<style>
        .disp_image img{
                width: 80px;
                height: 80px;
                float: right;
                border-radius: 40px;
        }
</style>