<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use common\models\Religion;
use common\models\Caste;
use common\models\Nationality;
use yii\helpers\ArrayHelper;
use common\models\Branch;
use common\models\MasterDesignations;

/* @var $this yii\web\View */
/* @var $model common\models\StaffInfo */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $posts = \common\models\AdminPosts::find()->orderBy(['post_name' => SORT_ASC])->all(); ?>

<div class="staff-info-form form-inline">


        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'gender')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'age')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                <?php
                if (!$staff_enquiry->isNewRecord) {
                        $staff_enquiry->dob = date('d-m-Y', strtotime($staff_enquiry->dob));
                }
                ?>
                <?=
                DatePicker::widget([
                    'model' => $staff_enquiry,
                    'form' => $form,
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'dob',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]);
                ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'height')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'weight')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'phone_number')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'email')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'place')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                <?php $designation = MasterDesignations::find()->where(['status' => '1'])->orderBy(['title' => SORT_ASC])->all(); ?>   <?= $form->field($staff_enquiry, 'designation')->dropDownList(ArrayHelper::map($designation, 'id', 'title'), ['prompt' => '--Select--', 'class' => 'form-control']) ?>
                <?php //$form->field($staff_enquiry, 'designation')->dropDownList(['' => '--Select--', '1' => 'Registered Nurse', '2' => 'Care Assistant', '3' => 'Doctor visit at home', '4' => 'OP Clinic', '5' => 'DV + OP', '6' => 'Physio', '7' => 'Psychologist', '8' => 'Dietician', '9' => 'Receptionist', '10' => 'Office Staff', '11' => 'Accountant'])  ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'address')->textarea(['rows' => 1]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'notes')->textarea(['rows' => 1]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd' id="agreement_copy_other">    <?= $form->field($staff_enquiry, 'agreement_copy_other')->textInput(['maxlength' => true]) ?>

        </div>

        <div style="clear: both"></div>

        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'status')->dropDownList(['1' => 'Active', '2' => 'Closed']) ?>

        </div><?php
        if (Yii::$app->user->identity->branch_id == '0') {
                $branches = Branch::find()->where(['status' => '1'])->andWhere(['<>', 'id', '0'])->all();
                ?>
                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($staff_enquiry, 'branch_id')->dropDownList(ArrayHelper::map($branches, 'id', 'branch_name'), ['prompt' => '--Select--']) ?>
                </div>
        <?php } ?>


        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'><?= $form->field($staff_enquiry, 'attachments[]')->fileInput(['multiple' => true]) ?></div>
        <div style="clear:both"></div>

        <?php if (!$staff_enquiry->isNewRecord) { ?>
                <br/>
                <hr class="appoint_history" />
                <h4 class="sub-heading">Uploaded Files</h4>
                <div class="container" style="margin-left: 0">
                        <div class="row">
                                <?php
                                $path = Yii::getAlias(Yii::$app->params['uploadPath']) . '/staff-enquiry/' . $staff_enquiry->id;
                                foreach (glob("{$path}/*") as $file) {
                                        $arry = explode('/', $file);
                                        $img_nmee = end($arry);
                                        $img_nmees = explode('.', $img_nmee);

                                        if ($img_nmees[1] != 'pdf') {
                                                ?>

                                                <div class = "col-md-2 img-box">
                                                        <img src="<?= Yii::$app->homeUrl . '../uploads/staff-enquiry/' . $staff_enquiry->id . '/' . end($arry) ?>" style="position:relative;width:135px;height: 135px;" class="img-responsive" />
                                                        <label><?= end($arry); ?></label>
                                                        <a href="<?= Yii::$app->homeUrl ?>staff/staff-enquiry/remove?id=<?= $staff_enquiry->id ?>&name=<?= end($arry) ?>" title="Delete"><i class="fa fa-remove" style="position: absolute;left: 165px;top: 3px;"></i></a>
                                                </div>

                                        <?php } else { ?>
                                                <div class = "col-md-2 img-box">
                                                        <a href="<?= Yii::$app->homeUrl . '../uploads/staff-enquiry/' . $staff_enquiry->id . '/' . end($arry) ?>" target="_blank"><?= end($arry); ?></a>
                                                        <a href="<?= Yii::$app->homeUrl ?>staff/staff-enquiry/remove?id=<?= $staff_enquiry->id ?>&name=<?= end($arry) ?>" title="Delete"><i class="fa fa-remove" style="position: absolute;left: 165px;top: 3px;"></i></a>
                                                </div>
                                        <?php }
                                        ?>
                                <?php }
                                ?>
                        </div>
                </div>
        <?php } ?>
</div>



<style>
        .img_data {
                margin-top: 16px;
        }
        a{
                color: #3c4ba1;
        }
</style>


