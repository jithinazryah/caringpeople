<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use common\models\Branch;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $staff_enquiry common\models\StaffEnquiry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-enquiry-form form-inline">


        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'gender')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'phone_number')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'email')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'place')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'designation')->dropDownList(['' => '--Select--', '0' => 'Registered Nurse', '1' => 'Care Assistant']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'address')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'notes')->textarea(['rows' => 6]) ?>

        </div><?php
        if (Yii::$app->user->identity->branch_id == '0') {
                $branches = Branch::find()->where(['status' => '1'])->andWhere(['<>', 'id', '0'])->all();
                ?>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($staff_enquiry, 'branch_id')->dropDownList(ArrayHelper::map($branches, 'id', 'branch_name'), ['prompt' => '--Select--']) ?>
                </div>
        <?php } ?><div class = 'col-md-4 col-sm-6 col-xs-12 left_padd'> <?= $form->field($staff_enquiry, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>


        </div>
        <!--        <div class='col-md-4 col-sm-6 col-xs-12' >
                        <div class="form-group">
        <?= Html::submitButton($staff_enquiry->isNewRecord ? 'Create' : 'Update', ['class' => $staff_enquiry->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
        <?php
        if (!$staff_enquiry->isNewRecord && $staff_enquiry->proceed != 1) {
                echo Html::submitButton('Proceed to Staff', ['name' => 'proceed', 'class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:125px;']);
        }
        ?>
                        </div>
                </div>-->



</div>
