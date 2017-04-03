<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use common\models\Religion;
use common\models\Caste;
use common\models\Nationality;
use yii\helpers\ArrayHelper;
use common\models\Branch;

/* @var $this yii\web\View */
/* @var $model common\models\StaffInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-info-form form-inline">


        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'staff_id')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'staff_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'gender')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <div class="form-group field-staffinfo-dob">
                        <label class="control-label" for="staffinfo-dob">DOB</label>
                        <?php
                        if (!$model->isNewRecord && $model->dob != '1970-01-01') {
                                $model->dob = date('d-m-Y', strtotime($model->dob));
                        } else {
                                $model->dob = '';
                        }

                        echo DatePicker::widget([
                            'name' => 'StaffInfo[dob]',
                            'type' => DatePicker::TYPE_INPUT,
                            'value' => $model->dob,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy',
                            ]
                        ]);
                        ?>


                </div>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>  <?php $religion = Religion::find()->where(['status' => '1'])->all(); ?>  <?= $form->field($model, 'religion')->dropDownList(ArrayHelper::map($religion, 'id', 'religion'), ['prompt' => '--Select--', 'class' => 'form-control religion-change']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>

                <?php
                if (!$model->isNewRecord) {
                        $caste = Caste::find()->where(['r_id' => $model->religion, 'status' => '1'])->all();
                } else {
                        $caste = [];
                }
                echo $form->field($model, 'caste')->dropDownList(ArrayHelper::map($caste, 'id', 'caste'), ['prompt' => '--Select--', 'class' => 'form-control caste-change']);
                ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'permanent_address')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'pincode')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_no')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>  <?php $nationality = Nationality::find()->where(['status' => '1'])->all(); ?>   <?= $form->field($model, 'nationality')->dropDownList(ArrayHelper::map($nationality, 'id', 'nationality'), ['prompt' => '--Select--', 'class' => 'form-control']) ?>

        </div><div class="row"><input type="checkbox" id="checkbox_id" name="check" checkvalue="1" uncheckValue="0" style="margin-left: 20px;"><label style="color:black;font-weight:bold;margin-left: 5px;">Permanent contact details and Present contact details are same</label>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'present_address')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'present_pincode')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'present_contact_no')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'present_email')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'pan_or_adhar_no')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'blood_group')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'designation')->dropDownList(['' => '--Select--', '0' => 'Registered Nurse', '1' => 'Care Assistant']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'years_of_experience')->textInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'driving_licence')->dropDownList(['' => '--Select--', '0' => 'No', '1' => 'Motor Cycle & LMV', '2' => 'Motor Cycle', '3' => 'LMV']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'licence_no')->textInput(['maxlength' => true]) ?>

        </div>
        <div style="clear: both"></div>
        <h2 style="color:#148eaf;">Educational Qualification</h2>
        <hr class="enquiry-hr"/>


        <div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="margin-top: 20px;font-size: 17px;color:#000;"> <span >SSLC </span></div>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'sslc_institution')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'sslc_year_of_passing')->textInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'sslc_place')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="margin-top: 20px;font-size: 17px;color:#000;"> <span >HSE </span></div>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'hse_institution')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'hse_year_of_passing')->textInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'hse_place')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="margin-top: 20px;font-size: 17px;color:#000;"> <span >Nursing </span></div>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'nursing_institution')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'nursing_year_of_passing')->textInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'nursing_place')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'timing')->dropDownList(['' => '--Select--', '1' => 'Full Time', '0' => 'Part Time']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'uniform')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'company_id')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'emergency_conatct_verification')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'panchayath_cleraance_verification')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

        </div><?php
        if (Yii::$app->user->identity->branch_id == '0') {
                $branches = Branch::find()->where(['status' => '1'])->andWhere(['<>', 'id', '0'])->all();
                ?>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($model, 'branch_id')->dropDownList(ArrayHelper::map($branches, 'id', 'branch_name'), ['prompt' => '--Select--']) ?>
                </div>
        <?php } ?><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'biodata')->fileInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'profile_image_type')->fileInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'sslc')->fileInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'hse')->fileInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'KNC')->fileInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'INC')->fileInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'marklist')->fileInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'experience')->fileInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'id_proof')->fileInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'PCC')->fileInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'authorised_letter')->fileInput() ?>

        </div>
        <div style="clear:both"></div>

        <?php if ($model->biodata != '' || $model->profile_image_type != '' || $model->sslc != '') { ?>
                <div class="row">
                        <label style="    color: #148eaf;font-size: 19px;margin-left: 14px;">Uploaded Files</label>
                </div>
        <?php } ?>

        <div class="row">

                <?php
                if (!$model->isNewRecord) {
                        if ($model->profile_image_type != '') {
                                $paths = Yii::getAlias(Yii::$app->params['uploadPath']);
                                //echo Yii::getAlias(@paths . '/staff/' . $model->id . '/profile_image_type.' . $model->profile_image_type;
                                ?>

                                <div class="col-md-2">
                                        <img src="<?= Yii::$app->homeUrl . '../uploads/staff/' . $model->id . '/profile_image_type.' . $model->profile_image_type; ?> " style="width:175px;height: 175px;"/>
                                </div>

                        <?php } ?>



                        <!-----------------View uploaded files--------->

                        <?php
                        $images = array('biodata', 'sslc', 'hse', 'KNC', 'INC', 'marklist', 'experience', 'id_proof', 'PCC', 'authorised_letter');
                        $i = 0;

                        foreach ($images as $value) {
                                if ($model->$value != '') {
                                        $i++;
                                        if ($i == 1) {

                                                echo '<div class="col-md-2">';
                                        }
                                        ?>
                                        <div class="img_data">
                                                <a href="<?= Yii::$app->homeUrl . '../uploads/staff/' . $model->id . '/' . $value . '.' . $model->$value; ?>" target="_blank"><?= $model->getAttributeLabel($value); ?></a>
                                        </div>
                                        <?php
                                        if ($i == 5) {
                                                echo '</div><div class="col-md-2">';
                                        }
                                }
                        }
                        if ($i > 0)
                                echo '</div>';

                        /*   View uploaded files    */
                }
                ?>




        </div>

</div>


<style>
        .img_data {
                margin-top: 16px;
        }
        a{
                color: #3c4ba1;
        }
</style>

