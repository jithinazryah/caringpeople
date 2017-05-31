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


        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'staff_id')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>

                <?= $form->field($model, 'staff_name')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>

                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

        </div>
        <?php if ($model->isNewRecord) { ?>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>
                </div>

        <?php } ?>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>

                <?= $form->field($model, 'post_id')->dropDownList(ArrayHelper::map($posts, 'id', 'post_name'), ['prompt' => '--Select--']) ?>


        </div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'gender')->dropDownList(['' => '--Select--', '0' => 'Male', '1' => 'Female']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'age')->textInput(['maxlength' => true]) ?>

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

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>  <?php $religion = Religion::find()->where(['status' => '1'])->orderBy(['religion' => SORT_ASC])->all(); ?>  <?= $form->field($model, 'religion')->dropDownList(ArrayHelper::map($religion, 'id', 'religion'), ['prompt' => '--Select--', 'class' => 'form-control religion-change']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>

                <?php
                if (!$model->isNewRecord) {
                        $caste = Caste::find()->where(['r_id' => $model->religion, 'status' => '1'])->all();
                } else {
                        $caste = [];
                }
                echo $form->field($model, 'caste')->dropDownList(ArrayHelper::map($caste, 'id', 'caste'), ['prompt' => '--Select--', 'class' => 'form-control caste-change']);
                ?>

        </div>

        <?php if (!$model->isNewRecord) { ?><div style="clear:both"></div><?php } ?>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'permanent_address')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'pincode')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_no')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <?php $nationality = Nationality::find()->where(['status' => '1'])->all(); ?>   <?= $form->field($model, 'nationality')->dropDownList(ArrayHelper::map($nationality, 'id', 'nationality'), ['prompt' => '--Select--', 'class' => 'form-control']) ?>

        </div>

        <?php if (!$model->isNewRecord) { ?><div style="clear:both"></div><?php } ?>

        <div class="row"><input type="checkbox" id="checkbox_id" name="check" checkvalue="1" uncheckValue="0" style="margin-left: 20px;"><label style="color:black;font-weight:bold;margin-left: 5px;">Permanent contact details and Present contact details are same</label>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'present_address')->textarea(['rows' => 6]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'present_pincode')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'present_contact_no')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'present_email')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'pan_or_adhar_no')->textInput(['maxlength' => true]) ?>

        </div>
        <?php
        if (!$model->isNewRecord) {

                $model->designation = explode(',', $model->designation);
        }
        ?>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <?php $designation = MasterDesignations::find()->where(['status' => '1'])->orderBy(['title' => SORT_ASC])->all(); ?>   <?= $form->field($model, 'designation')->dropDownList(ArrayHelper::map($designation, 'id', 'title'), ['class' => 'form-control', 'multiple' => 'multiple', 'style' => 'height:120px']) ?>
                <?php $form->field($model, 'designation')->dropDownList(['' => '--Select--', '1' => 'Registered Nurse', '2' => 'Care Assistant', '3' => 'Doctor visit at home', '4' => 'OP Clinic', '5' => 'DV + OP', '6' => 'Physio', '7' => 'Psychologist', '8' => 'Dietician', '9' => 'Receptionist', '10' => 'Office Staff', '11' => 'Accountant', '12' => 'Nurse Manager']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'blood_group')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'years_of_experience')->textInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'driving_licence')->dropDownList(['' => '--Select--', '0' => 'No', '1' => 'Motor Cycle & LMV', '2' => 'Motor Cycle', '3' => 'LMV']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'licence_no')->textInput(['maxlength' => true]) ?>

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

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'timing')->dropDownList(['' => '--Select--', '1' => 'Full Time', '0' => 'Part Time']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'uniform')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'company_id')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'emergency_conatct_verification')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_edu, 'panchayath_cleraance_verification')->dropDownList(['' => '--Select--', '1' => 'Yes', '0' => 'No']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'status')->dropDownList(['1' => 'Opened', '2' => 'Closed']) ?>

        </div>
        <?php
        if (Yii::$app->user->identity->branch_id == '0') {
                $branches = Branch::find()->where(['status' => '1'])->andWhere(['<>', 'id', '0'])->all();
                ?>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($model, 'branch_id')->dropDownList(ArrayHelper::map($branches, 'id', 'branch_name'), ['prompt' => '--Select--']) ?>
                </div>
        <?php } ?>
        <div style="clear:both"></div>




        <div id="p_attach">
                <input type="hidden" id="delete_port_vals"  name="delete_port_vals" value="">
                <h3 style="color:#148eaf;">Attachments</h3>
                <hr class="enquiry-hr"/>


                <span>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffperviousemployer-hospital_address">
                                        <label class="control-label">Attachment</label>
                                        <input type="file"  name="creates[file][]">

                                </div>
                        </div>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffperviousemployer-designation">
                                        <label class="control-label" for="">Attachment Name</label>
                                        <input type="text" class="form-control" name="creates[file_name][]">
                                </div>
                        </div>


                        <div style="clear:both"></div>
                </span>
                <br/>
        </div>

        <div class="row">
                <div class="col-md-6">
                        <a id="addAttach" class="btn btn-blue btn-icon btn-icon-standalone addAttach" ><i class="fa-plus"></i><span> Add More</span></a>
                </div>
        </div>




        <div style="clear:both"></div>


        <?php if (!$model->isNewRecord) { ?>
                <br/>

                <div class="row">
                        <?php
                        $path = Yii::getAlias(Yii::$app->params['uploadPath']) . '/staff/' . $model->id;

                        if (count(glob("{$path}/*")) > 0) {
                                echo "<hr class='appoint_history'/> <h4 class='sub-heading'>Uploaded Files</h4>";

                                $k = 0;
                                foreach (glob("{$path}/*") as $file) {
                                        $k++;
                                        $arry = explode('/', $file);
                                        $img_nmee = end($arry);
                                        $img_nmees = explode('.', $img_nmee);
                                        ?>

                                        <div class = "col-md-2 img-box" id="<?= $k; ?>">
                                                <a href="<?= Yii::$app->homeUrl . '../uploads/staff/' . $model->id . '/' . end($arry) ?>" target="_blank"><?= end($arry); ?></a>
                                                <a  title="Delete" class="staff-enq-img-remove" id="<?= $model->id . "-" . $img_nmee . "-" . $k; ?>" style="cursor:pointer"><i class="fa fa-remove" style="position: absolute;left: 165px;top: 3px;"></i></a>
                                        </div>


                                        <?php
                                }
                        }
                        ?>
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


