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


        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'gender')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'age')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
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

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'height')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'weight')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'phone_number')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'email')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'place')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <?php $designation = MasterDesignations::find()->where(['status' => '1'])->orderBy(['title' => SORT_ASC])->all(); ?>   <?= $form->field($staff_enquiry, 'designation')->dropDownList(ArrayHelper::map($designation, 'id', 'title'), ['prompt' => '--Select--', 'class' => 'form-control']) ?>
                <?php //$form->field($staff_enquiry, 'designation')->dropDownList(['' => '--Select--', '1' => 'Registered Nurse', '2' => 'Care Assistant', '3' => 'Doctor visit at home', '4' => 'OP Clinic', '5' => 'DV + OP', '6' => 'Physio', '7' => 'Psychologist', '8' => 'Dietician', '9' => 'Receptionist', '10' => 'Office Staff', '11' => 'Accountant']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'address')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'notes')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'agreement_copy')->dropDownList(['' => '--Select--', '1' => 'Send via mail', '2' => 'No', '3' => 'Given hard copy', '4' => 'Other ']) ?><?php // $form->field($staff_enquiry, 'designation')->dropDownList(['' => '--Select--', '0' => 'Registered Nurse', '1' => 'Care Assistant'])                                   ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' id="agreement_copy_other">    <?= $form->field($staff_enquiry, 'agreement_copy_other')->textInput(['maxlength' => true]) ?>

        </div>

        <div style="clear: both"></div>
        <h2 style="color:#148eaf;">Educational Qualification</h2>
        <hr class="enquiry-hr"/>


        <div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="margin-top: 20px;font-size: 17px;color:#000;"> <span >SSLC </span></div>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'sslc_institution')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'sslc_year_of_passing')->textInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'sslc_place')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="margin-top: 20px;font-size: 17px;color:#000;"> <span >HSE </span></div>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'hse_institution')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'hse_year_of_passing')->textInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'hse_place')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="margin-top: 20px;font-size: 17px;color:#000;"> <span >Nursing </span></div>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'nursing_institution')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'nursing_year_of_passing')->textInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'nursing_place')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_enquiry, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

        </div><?php
        if (Yii::$app->user->identity->branch_id == '0') {
                $branches = Branch::find()->where(['status' => '1'])->andWhere(['<>', 'id', '0'])->all();
                ?>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($staff_enquiry, 'branch_id')->dropDownList(ArrayHelper::map($branches, 'id', 'branch_name'), ['prompt' => '--Select--']) ?>
                </div>
        <?php } ?>
        <?php
        $staff_uploads->file_name = '';
        ?>


        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_uploads, 'authorised_letter')->fileInput() ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_uploads, 'file_name')->textInput() ?>

        </div>
        <div style="clear:both"></div>

        <?php if ($staff_uploads->biodata != '' || $staff_uploads->profile_image_type != '' || $staff_uploads->sslc != '' || $staff_uploads->hse != '' || $staff_uploads->KNC != '' || $staff_uploads->INC != '' || $staff_uploads->marklist != '' || $staff_uploads->experience != '' || $staff_uploads->id_proof != '' || $staff_uploads->PCC != '' || $staff_uploads->authorised_letter != '') { ?>
                <div class="row">
                        <label style="    color: #148eaf;font-size: 19px;margin-left: 14px;">Uploaded Files</label>
                </div>
        <?php } ?>

        <div class="row">

                <?php
                if (!$staff_enquiry->isNewRecord) {


                        // $dirname = "Yii::$app->homeUrl . '../uploads/staff/' . $staff_info->id .'/'";
                        $dirname = Yii::getAlias(Yii::$app->params['uploadPath']) . '/staff-enquiry/' . $staff_enquiry->id . '/';
                        $images = glob($dirname . "*");
                        $i = 0;
                        foreach ($images as $image) {
                                $i++;
                                $arry = explode('/', $image);
                                $img_nmee = end($arry);
                                ?>

                                <div class = "img_data" id="<?= $i; ?>">
                                        <a href = "<?= Yii::$app->homeUrl . '../uploads/staff-enquiry/' . $staff_enquiry->id . '/' . $img_nmee; ?>" target = "_blank"><?= $img_nmee ?></a>
                                        <a title="Delete"><i class="fa fa-remove staff-enq-img-remove" style="position: absolute;left: 170px;cursor: pointer;" id="<?= $staff_enquiry->id . '-' . $img_nmee . '-' . $i ?>"></i></a>
                                </div>
                                <?php
                        }
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


