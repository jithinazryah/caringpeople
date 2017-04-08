<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use common\models\Branch;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\PatientInformation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-information-form form-inline">


        <div class="row">
                <h2 style="color:#148eaf;">Guardian Details</h2>
                <hr class="enquiry-hr"/>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'gender')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'id_card_or_passport_no')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'religion')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'nationality')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'occupatiion')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'permanent_address')->textarea(['rows' => 6]) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'pincode')->textInput() ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'landmark')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_number')->textInput() ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'adhar_card_no')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'passport')->fileInput() ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'driving_license')->fileInput() ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'pan_card')->fileInput() ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'voters_id')->fileInput() ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'guardian_profile_image')->fileInput() ?>


                </div>
                <?php
                if ($model->guardian_profile_image != '') {
                        $paths = Yii::getAlias(Yii::$app->params['uploadPath']);
                        //echo Yii::getAlias(@paths . '/staff/' . $model->id . '/profile_image_type.' . $model->profile_image_type;
                        ?>
                        <img src="<?= Yii::$app->homeUrl . '../uploads/patient/' . $patient_general->id . '/guardian_profile_image.' . $model->guardian_profile_image; ?> " style="width:100px;height: 100px;"/>
                        <span>Guardian Image</span>
                        <?php
                }
                ?>

        </div>
        <h2 style="color:#148eaf;">Patients Details</h2>
        <hr class="enquiry-hr"/>

        <div class="row">



                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($patient_general, 'patient_id')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'first_name')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'last_name')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>     <?= $form->field($model, 'gender')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'age')->textInput() ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'blood_group')->textInput(['maxlength' => true]) ?>

                </div>
                <div class="row>">
                        <input type="checkbox" id="address_id" name="check" checkvalue="1" uncheckValue="0"><label style="color:black;font-weight:bold; margin-left: 5px;"> Guardian address and patient address are same</label>
                </div>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'present_address')->textarea(['rows' => 6]) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'pin_code')->textInput() ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'landmark')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'contact_number')->textInput() ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'email')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($patient_general, 'status')->dropDownList(['' => '--Select--', '1' => 'Active', '2' => 'Closed', '3' => 'Pending', '4' => 'Deseased']) ?>

                </div>
                <?php
                if (Yii::$app->user->identity->branch_id == '0') {
                        $branches = Branch::find()->where(['status' => '1'])->andWhere(['<>', 'id', '0'])->all();
                        ?>
                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($patient_general, 'branch_id')->dropDownList(ArrayHelper::map($branches, 'id', 'branch_name'), ['prompt' => '--Select--']) ?>
                        </div>
                <?php } ?>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($patient_general, 'patient_image')->fileInput() ?>

                </div>
                <?php
                if ($patient_general->patient_image != '') {
                        $paths = Yii::getAlias(Yii::$app->params['uploadPath']);
                        //echo Yii::getAlias(@paths . '/staff/' . $model->id . '/profile_image_type.' . $model->profile_image_type;
                        ?>

                        <div class="col-md-2">
                                <img src="<?= Yii::$app->homeUrl . '../uploads/patient/' . $patient_general->id . '/patient_image.' . $patient_general->patient_image; ?> " style="width:100px;height: 100px;"/>
                                <span>Patient Image</span>
                        </div>

                <?php }
                ?>
                <div style="clear:both"></div>
        </div>
        <?php if ($model->passport != '' || $model->driving_license != '' || $model->pan_card != '' || $model->voters_id != '') { ?>
                <div class="row">
                        <label style="    color: #148eaf;font-size: 19px;margin-left: 14px;">Uploaded Files</label>
                </div>
        <?php } ?>






        <div class="row">

                <?php
                if (!$model->isNewRecord) {

                        $images = array('passport', 'driving_license', 'pan_card', 'voters_id');
                        $i = 0;

                        foreach ($images as $value) {
                                if ($model->$value != '') {
                                        $i++;
                                        if ($i == 1) {

                                                echo '<div class="col-md-2">';
                                        }
                                        ?>
                                        <div class="img_data">
                                                <a href="<?= Yii::$app->homeUrl . '../uploads/patient/' . $patient_general->id . '/' . $value . '.' . $model->$value; ?>" target="_blank"><?= $model->getAttributeLabel($value); ?></a>
                                        </div>
                                        <?php
                                        if ($i == 5) {
                                                echo '</div><div class="col-md-2">';
                                        }
                                }
                        }
                        if ($i > 0)
                                echo '</div>';
                }
                ?>



                <!-----------------View uploaded files--------->






        </div>

</div>

