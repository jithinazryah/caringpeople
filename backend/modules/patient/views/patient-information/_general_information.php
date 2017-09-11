<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use common\models\Religion;
use common\models\Nationality;
use yii\helpers\ArrayHelper;
use common\models\Branch;

/* @var $this yii\web\View */
/* @var $model common\models\PatientInformation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-information-form form-inline">


        <div class="row">


                <div class="row">
                        <div class="col-md-8">
                                <h4 class="h4-labels">Patient Details</h4>
                                <hr class="enquiry-hr"/>
                        </div>
                        <?php
                        if ($patient_general->patient_image != '') {
                                $paths = Yii::getAlias(Yii::$app->params['uploadPath']);
                                ?>

                                <div class="col-md-4 disp-image" id="patient_image">
                                        <img src="<?= Yii::$app->homeUrl . '../uploads/patient/' . $patient_general->id . '/patient_image.' . $patient_general->patient_image; ?> "/>
                                        <a title="Delete Patient Image"><i class="fa fa-remove img-removes" style="cursor: pointer;float: right" id="<?= $patient_general->id . "-" . 'patient_image.' . $patient_general->patient_image . "-patient_image" ?>"></i></a>
                                </div>


                        <?php }
                        ?>
                </div>






                <div class="row">
   

                      <?php
 $branch= Branch::Branch();
                        //if (Yii::$app->user->identity->branch_id == '0') {
                                $branches = Branch::find()->where(['status' => '1'])->andWhere(['<>', 'id', '0'])->all();
                                ?>
                                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($patient_general, 'branch_id')->dropDownList(ArrayHelper::map($branch, 'id', 'branch_name'), ['prompt' => '--Select--']) ?>
                                </div>
                        <?php //} ?>


                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($patient_general, 'patient_id')->textInput(['maxlength' => true]) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($patient_general, 'patient_old_id')->textInput(['maxlength' => true]) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'first_name')->textInput(['maxlength' => true]) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'last_name')->textInput(['maxlength' => true]) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>     <?= $form->field($patient_general, 'gender')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'age')->textInput(['maxlength' => true]) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?php
                                if (!$patient_general->isNewRecord) {
                                        $patient_general->dob = date('d-m-Y', strtotime($patient_general->dob));
                                }
                                ?>
                                <?=
                                DatePicker::widget([
                                    'model' => $patient_general,
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
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'weight')->textInput() ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'blood_group')->textInput(['maxlength' => true]) ?>

                        </div>

                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'present_address')->textarea(['rows' => 1]) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'pin_code')->textInput() ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'landmark')->textInput(['maxlength' => true]) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'contact_number')->textInput() ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($patient_general, 'email')->textInput(['maxlength' => true]) ?>

                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd' >
                                <?php $managers = \common\models\StaffInfo::find()->where(['post_id' => 6])->orderBy(['staff_name' => SORT_ASC])->all(); ?>
                                <?= $form->field($patient_general, 'staff_manager')->dropDownList(ArrayHelper::map($managers, 'id', 'staff_name'), ['prompt' => '--Select--']) ?>


                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($patient_general, 'status')->dropDownList(['1' => 'Active', '2' => 'Closed', '3' => 'Pending', '4' => 'Deceased']) ?>

                        </div>

                        


                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($patient_general, 'patient_image')->fileInput() ?>

                        </div>




                </div>



                <div style="clear:both"></div>





                <h4 class="h4-labels">Guardian Details</h4>
                <hr class="enquiry-hr"/>

                <div class="row">
                        <input type="checkbox" id="address_id" name="check" checkvalue="1" uncheckValue="0"><label style="color:black;font-weight:bold; margin-left: 5px;"> Guardian address and patient address are same</label>
                </div>

                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'gender')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>

                </div>

                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>

                        <?php $religion = Religion::find()->where(['status' => '1'])->orderBy(['religion' => SORT_ASC])->all(); ?>
                        <?= $form->field($model, 'religion')->dropDownList(ArrayHelper::map($religion, 'id', 'religion'), ['prompt' => '--Select--', 'class' => 'form-control']) ?>

                </div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                        <?php $nationality = Nationality::find()->where(['status' => '1'])->orderBy(['nationality' => SORT_ASC])->all(); ?>
                        <?= $form->field($model, 'nationality')->dropDownList(ArrayHelper::map($nationality, 'id', 'nationality'), ['prompt' => '--Select--', 'class' => 'form-control']) ?>

                </div>

                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'occupatiion')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'permanent_address')->textarea(['rows' => 1]) ?>

                </div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'pincode')->textInput() ?>

                </div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'landmark')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_number')->textInput() ?>

                </div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                </div>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'passport')->fileInput() ?>

                </div>
                <!--		<div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                <?= $form->field($model, 'driving_license')->fileInput() ?>

                </div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                <?= $form->field($model, 'pan_card')->fileInput() ?>

                </div>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                <?= $form->field($model, 'voters_id')->fileInput() ?>

                                </div>-->
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'guardian_profile_image')->fileInput() ?>


                </div>
                <?php if ($model->guardian_profile_image != '') { ?>
                        <div class = "col-md-3" id = "guardian_profile_image">

                                <?php
                                $paths = Yii::getAlias(Yii::$app->params['uploadPath']);
                                //echo Yii::getAlias(@paths . '/staff/' . $model->id . '/profile_image_type.' . $model->profile_image_type;
                                ?>
                                <label>Guardian Image</label>
                                <img src="<?= Yii::$app->homeUrl . '../uploads/patient/' . $patient_general->id . '/guardian_profile_image.' . $model->guardian_profile_image; ?> " style="width:100px;height: 100px;"/>
                                <a title="Delete"><i class="fa fa-remove img-removes" style="position: absolute;left: 220px;top: 5px;cursor: pointer" id="<?= $patient_general->id . "-" . 'guardian_profile_image.' . $model->guardian_profile_image . "-guardian_profile_image" ?>"></i></a>



                        </div>
                <?php } ?>

                <div class="col-md-3" id="passport">
                        <?php
                        if (!$model->isNewRecord) {

                                $images = array('passport');
                                $i = 0;

                                foreach ($images as $value) {
                                        if ($model->$value != '') {
                                                $i++;
                                                ?>
                                                <span style="font-size: 12px;"><?= $model->getAttributeLabel($value); ?></span>
                                                <a href="<?= Yii::$app->homeUrl . '../uploads/patient/' . $patient_general->id . '/' . $value . '.' . $model->$value; ?>" target="_blank"><img src="<?= Yii::$app->homeUrl . '../uploads/patient/' . $patient_general->id . '/' . $value . '.' . $model->$value; ?> " style="width:100px;height: 100px;"/></a>
                                                <a title="Delete"><i class="fa fa-remove img-removes" style="position: absolute;margin-left: 5px;cursor: pointer" id="<?= $patient_general->id . "-" . $value . '.' . $model->$value . "-" . $value ?>"></i></a>
                                                <?php
                                        }
                                }
                        }
                        ?>
                </div>

                <div style="clear:both"></div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($patient_general, 'terms_conditions', ['template' => "<label class='cbr-inline top'>{input}<a href='javascript:;' target='_blank' href='#' class='terms' id='2'>I agree to the terms and conditions</a></label>",])->checkbox(['class' => 'cbr', 'style' => 'margin-top:10px;', 'label' => '']) ?>

                </div>

        </div>



        <?php /* if ($model->passport != '' || $model->driving_license != '' || $model->pan_card != '' || $model->voters_id != '') { ?>
          <!--                <div class="row">
          <label style="    color: #148eaf;font-size: 19px;margin-left: 14px;">Uploaded Files</label>
          </div>-->
          <?php } */ ?>






        <!--        <div class="row">

        <?php
        /* if (!$model->isNewRecord) {

          $images = array('passport');
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
          } */
        ?>



                        ---------------View uploaded files-------






                </div>-->

</div>

<div class='col-md-12 col-sm-6 col-xs-12' >
        <div class="form-group" >
                <?= Html::submitButton($patient_general->isNewRecord ? 'Create' : 'Update', ['class' => $patient_general->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;', 'id' => 'form_button']) ?>

        </div>
</div>


<script>
$(document).ready(function(){
   $('#patientgeneral-branch_id').change(function(){
     var branch=$(this).val();
     $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {branch: branch},
                        url: homeUrl + 'ajax/patientid',
                        success: function (data) {
                            
                              $('#patientgeneral-patient_id').val(data);
                        }
                });
   });
});
</script>