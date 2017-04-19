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

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'designation')->dropDownList(['' => '--Select--', '1' => 'Registered Nurse', '2' => 'Care Assistant', '3' => 'Doctor visit at home', '4' => 'OP Clinic', '5' => 'DV + OP', '6' => 'Physio', '7' => 'Psychologist', '8' => 'Dietician', '9' => 'Receptionist', '10' => 'Office Staff', '11' => 'Accountant'])  ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'address')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'notes')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'agreement_copy')->dropDownList(['' => '--Select--', '1' => 'Send via mail', '2' => 'No', '3' => 'Given hard copy', '4' => 'Other ']) ?><?php // $form->field($staff_enquiry, 'designation')->dropDownList(['' => '--Select--', '0' => 'Registered Nurse', '1' => 'Care Assistant'])           ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' id="agreement_copy_other">    <?= $form->field($staff_enquiry, 'agreement_copy_other')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'><?= $form->field($staff_enquiry, 'attachments[]')->fileInput(['multiple' => true]) ?></div>
<?php
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

 <div style="clear:both"></div>
<?php  if(!$staff_enquiry->isNewRecord){ ?>
        <br/>
        <hr class="appoint_history" />
        <h4 class="sub-heading">Uploaded Files</h4>
        <div class="container" style="margin-left: 0">
                <div class="row">
                        <?php
  
                        $path = Yii::getAlias(Yii::$app->params['uploadPath']).'/staff-enquiry/' . $staff_enquiry->id;
                        foreach (glob("{$path}/*") as $file) {
                                $arry = explode('/', $file);
                                ?>
                                <div class = "col-md-2 img-box">
                                        <img src="<?= Yii::$app->homeUrl . '../uploads/staff-enquiry/' . $staff_enquiry->id . '/' . end($arry) ?>" style="position:relative;width:135px;height: 135px;" class="img-responsive" />
                                        <label><?= end($arry); ?></label>
                                        <a href="<?= Yii::$app->homeUrl ?>staff/staff-enquiry/remove?id=<?= $staff_enquiry->id ?>&name=<?= end($arry) ?>" title="Delete"><i class="fa fa-remove" style="position: absolute;left: 165px;top: 3px;"></i></a>
                                </div>
                        <?php }
                        ?>
                </div>
        </div>
<?php } ?>
</div>
