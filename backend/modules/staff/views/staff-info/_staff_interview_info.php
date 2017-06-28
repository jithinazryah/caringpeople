<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use common\models\StaffExperienceList;

/* @var $this yii\web\View */
/* @var $model common\models\StaffOtherInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-other-info-form form-inline">


        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'police_station_name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'verified_name_1')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'muncipality_corporation')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_second, 'verified_name_2')->textInput(['maxlength' => true]) ?>

        </div>
        <?php
        if (!$staff_interview_third->isNewRecord) {

                $staff_interview_third->staff_experience = explode(',', $staff_interview_third->staff_experience);
        }
        ?>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?php $exp = StaffExperienceList::find()->where(['status' => '1'])->orderBy(['title' => SORT_ASC])->all(); ?>  <?= $form->field($staff_interview_third, 'staff_experience')->dropDownList(ArrayHelper::map($exp, 'id', 'title'), ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'skills']) ?>

        </div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'mentioned_per_day_salary')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'smoke_or_drink', ['template' => "<label class='cbr-inline top'>{input}</label>",])->checkbox(['class' => 'cbr', 'style' => 'margin-top:10px;']) ?>

        </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'drink', ['template' => "<label class='cbr-inline top'>{input}</label>",])->checkbox(['class' => 'cbr', 'style' => 'margin-top:10px;']) ?>

        </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'other', ['template' => "<label class='cbr-inline top'>{input}</label>",])->checkbox(['class' => 'cbr', 'style' => 'margin-top:10px;']) ?>

        </div><div style="clear: both">

        </div>


        <h4 style="color:#000;font-style: italic;">Languages Known</h4>
        <hr class="enquiry-hr"/>

        <div class="row languages">
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="width: 2%;    color: #000;">#

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd lang_check'>    <label>Language </label>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' >    <label> Read</label>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' >    <label> Write</label>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' >    <label>  Speak</label>

                </div>
        </div>
        <?php
        if (!$staff_interview_first->isNewRecord) {
                if (isset($staff_interview_first->language_1)) {
                        $language_1 = explode(',', $staff_interview_first->language_1);
                        $staff_interview_first->language_1 = $language_1[0];
                }

                if (isset($staff_interview_first->language_2)) {
                        $language_2 = explode(',', $staff_interview_first->language_2);
                        $staff_interview_first->language_2 = $language_2[0];
                }

                if (isset($staff_interview_first->language_3)) {
                        $language_3 = explode(',', $staff_interview_first->language_3);
                        $staff_interview_first->language_3 = $language_3[0];
                }

                if (isset($staff_interview_first->language_4)) {
                        $language_4 = explode(',', $staff_interview_first->language_4);
                        $staff_interview_first->language_4 = $language_4[0];
                }
        }
        ?>


        <div class="row languages">
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="width: 2%;    color: #000;">1.

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_first, 'language_1')->textInput(['maxlength' => true])->label(false); ?>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' >    <input type="checkbox" name="language_1_1" id="language_1_read" class="cbr" <?php
                        if (isset($language_1[1])) {
                                if ($language_1[1] == '1') {
                                        echo 'checked=checked';
                                }
                        }
                        ?>>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' >    <input type="checkbox" name="language_1_2" id="language_1_write" class="cbr" <?php
                        if (isset($language_1[2])) {
                                if ($language_1[2] == '1') {
                                        echo 'checked=checked';
                                }
                        }
                        ?>>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' >    <input type="checkbox" name="language_1_3" id="language_1_speak" class="cbr" <?php
                        if (isset($language_1[3])) {
                                if ($language_1[3] == '1') {
                                        echo 'checked=checked';
                                }
                        }
                        ?>>

                </div>
        </div>
        <div class="row languages">
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="width: 2%;    color: #000;">2.

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd '>    <?= $form->field($staff_interview_first, 'language_2')->textInput(['maxlength' => true])->label(false); ?>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' style="text-align:center">    <input type="checkbox" name="language_2_1" id="language_2_read" class="cbr"<?php
                        if (isset($language_2[1])) {
                                if ($language_2[1] == '1') {
                                        echo 'checked=checked';
                                }
                        }
                        ?>>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' style="text-align:center">    <input type="checkbox" name="language_2_2" id="language_2_write" class="cbr" <?php
                        if (isset($language_2[2])) {
                                if ($language_2[2] == '1') {
                                        echo 'checked=checked';
                                }
                        }
                        ?>>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' style="text-align:center">    <input type="checkbox" name="language_2_3" id="language_2_speak" class="cbr" <?php
                        if (isset($language_2[3])) {
                                if ($language_2[3] == '1') {
                                        echo 'checked=checked';
                                }
                        }
                        ?>>

                </div>
        </div>
        <div class="row languages">
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="width: 2%;    color: #000;">3.

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd '>    <?= $form->field($staff_interview_first, 'language_3')->textInput(['maxlength' => true])->label(false); ?>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' style="text-align:center">    <input type="checkbox" name="language_3_1" id="language_3_read" class="cbr" <?php
                        if (isset($language_3[1])) {
                                if ($language_3[1] == '1') {
                                        echo 'checked=checked';
                                }
                        }
                        ?>>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' style="text-align:center">    <input type="checkbox" name="language_3_2" id="language_3_write" class="cbr" <?php
                        if (isset($language_3[2])) {
                                if ($language_3[2] == '1') {
                                        echo 'checked=checked';
                                }
                        }
                        ?>>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' style="text-align:center">    <input type="checkbox" name="language_3_3" id="language_3_speak" class="cbr" <?php
                        if (isset($language_3[3])) {
                                if ($language_3[3] == '1') {
                                        echo 'checked=checked';
                                }
                        }
                        ?>>

                </div>
        </div>
        <div class="row languages">
                <div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="width: 2%;    color: #000;">4.

                </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd '>    <?= $form->field($staff_interview_first, 'language_4')->textInput(['maxlength' => true])->label(false); ?>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' style="text-align:center">    <input type="checkbox" name="language_4_1" id="language_4_read" class="cbr" <?php
                        if (isset($language_4[1])) {
                                if ($language_4[1] == '1') {
                                        echo 'checked=checked';
                                }
                        }
                        ?>>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' style="text-align:center">    <input type="checkbox" name="language_4_2" id="language_4_write" class="cbr" <?php
                        if (isset($language_4[2])) {
                                if ($language_4[2] == '1') {
                                        echo 'checked=checked';
                                }
                        }
                        ?>>

                </div><div class='col-md-1 col-sm-6 col-xs-12 left_padd lang_check' style="text-align:center">    <input type="checkbox" name="language_4_3" id="language_4_speak" class="cbr" <?php
                        if (isset($language_4[3])) {
                                if ($language_4[3] == '1') {
                                        echo 'checked=checked';
                                }
                        }
                        ?>>

                </div>
        </div>


        <h4 style="color:#000;font-style: italic;">Family Details</h4>
        <hr class="enquiry-hr"/>

        <div id="staff_family">

                <input type="hidden" id="delete_port_vals_family"  name="delete_port_vals_family" value="">
                <?php
                if (!empty($staff_family)) {
                        foreach ($staff_family as $family) {
                                ?>
                                <span>
                                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-staffenquiryinterviewfirst-family_name">
                                                        <label class="control-label" for="">Name</label>
                                                        <input type="text" class="form-control" name="updatefamily[<?= $family->id; ?>][name][]" value="<?= $family->name; ?>">
                                                </div>
                                        </div>

                                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-staffenquiryinterviewfirst-relation">
                                                        <label class="control-label" for="">Relationship</label>
                                                        <select name="updatefamily[<?= $family->id; ?>][relationship][]" id="family_relationships" class="form-control">
                                                                <option value="">--Select--</option>
                                                                <option value="Father" <?php
                                                                if ($family->relationship == 'Father') {
                                                                        echo 'selected=selected';
                                                                }
                                                                ?>>Father</option>
                                                                <option value="Mother" <?php
                                                                if ($family->relationship == 'Mother') {
                                                                        echo 'selected=selected';
                                                                }
                                                                ?>>Mother</option>
                                                                <option value="Spouse" <?php
                                                                if ($family->relationship == 'Spouse') {
                                                                        echo 'selected=selected';
                                                                }
                                                                ?>>Spouse</option>
                                                                <option value="Brother" <?php
                                                                if ($family->relationship == 'Brother') {
                                                                        echo 'selected=selected';
                                                                }
                                                                ?>>Brother</option>
                                                                <option value="Sister" <?php
                                                                if ($family->relationship == 'Sister') {
                                                                        echo 'selected=selected';
                                                                }
                                                                ?>>Sister</option>
                                                        </select>
                                                </div>
                                        </div>

                                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-staffenquiryinterviewfirst-job">
                                                        <label class="control-label" for="">Job</label>
                                                        <input type="text" class="form-control" name="updatefamily[<?= $family->id; ?>][job][]"  value="<?= $family->job; ?>">
                                                </div>
                                        </div>

                                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                <div class="form-group field-staffenquiryinterviewfirst-mobile_no">
                                                        <label class="control-label" for="">Mobile No</label>
                                                        <input type="text" class="form-control" name="updatefamily[<?= $family->id; ?>][mobile_no][]" value="<?= $family->mobile_no; ?>">
                                                </div>
                                        </div>

                                        <div class="col-md-1 col-sm-6 col-xs-12 left_padd">
                                                <a id="remFamily" val="<?= $family->id; ?>" class="btn btn-icon btn-red remFamily" style="margin-top: 15px;"><i class="fa-remove"></i></a>
                                        </div>
                                </span>
                                <?php
                        }
                }
                ?>



                <span>
                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffenquiryinterviewfirst-family_name">
                                        <label class="control-label" for="">Name</label>
                                        <input type="text" class="form-control" name="createfamily[name][]">
                                </div>
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffenquiryinterviewfirst-relation">
                                        <label class="control-label" for="">Relationship</label>
                                        <select name="createfamily[relationship][]" id="family_relationships" class="form-control">
                                                <option value="">--Select--</option>
                                                <option value="Father">Father</option>
                                                <option value="Mother">Mother</option>
                                                <option value="Spouse">Spouse</option>
                                                <option value="Brother">Brother</option>
                                                <option value="Sister">Sister</option>
                                        </select>
                                </div>
                        </div>

                        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffenquiryinterviewfirst-job">
                                        <label class="control-label" for="">Job</label>
                                        <input type="text" class="form-control" name="createfamily[job][]">
                                </div>
                        </div>

                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <div class="form-group field-staffenquiryinterviewfirst-mobile_no">
                                        <label class="control-label" for="">Mobile No</label>
                                        <input type="text" class="form-control" name="createfamily[mobile_no][]">
                                </div>
                        </div>

                </span>
        </div>

        <div class="row">
                <div class="col-md-6"> <a id="add_Staff_family" class="btn btn-blue btn-icon btn-icon-standalone Staff_family" ><i class="fa-plus"></i><span> Add Family Details</span></a>
                </div>
        </div>


        <h4 style="color:#000;font-style: italic;">Interview Details</h4>
        <hr class="enquiry-hr"/>

        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'document_required')->textarea(['rows' => 1]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'document_received')->textarea(['rows' => 1]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'interest_level')->dropDownList(['' => '--Select--', '1' => 'High', '2' => 'No Interest', '3' => 'Medium']) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                <?php
                if (!$staff_interview_third->isNewRecord) {
                        $staff_interview_third->expected_date_of_joining = date('d-m-Y', strtotime($staff_interview_third->expected_date_of_joining));
                }
                ?>
                <?=
                DatePicker::widget([
                    'model' => $staff_interview_third,
                    'form' => $form,
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'expected_date_of_joining',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]);
                ?>


        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'form_filled', ['template' => "<label class='cbr-inline top'>{input}</label>",])->checkbox(['class' => 'cbr', 'style' => 'margin-top:10px;']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'interview_notes')->textarea(['rows' => 1]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($staff_interview_third, 'interviewed_by')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                <?php
                if (!$staff_interview_third->isNewRecord) {
                        $staff_interview_third->interviewed_date = date('d-m-Y', strtotime($staff_interview_third->interviewed_date));
                }
                ?>
                <?=
                DatePicker::widget([
                    'model' => $staff_interview_third,
                    'form' => $form,
                    'type' => DatePicker::TYPE_INPUT,
                    'attribute' => 'interviewed_date',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]);
                ?>


        </div><div style="clear:both"></div>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($staffinfo, 'terms_conditions', ['template' => "<label class='cbr-inline top'>{input}<a href='javascript:;' target='_blank' href='#' class='terms' id='4' style='color: #3c4ba1;text-decoration: underline;'>I agree to the terms and conditions</a></label>",])->checkbox(['class' => 'cbr', 'style' => 'margin-top:10px;', 'label' => '']) ?>



        </div>

        <div class='col-md-12 col-sm-6 col-xs-12' >
                <div class="form-group" >
                        <?= Html::submitButton($staffinfo->isNewRecord ? 'Create' : 'Update', ['class' => $staffinfo->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:123px;margin-left:12px;', 'id' => 'form_button']) ?>

                </div>
        </div>
</div>

<style>
        .cbr-inline{ margin-top: 10px; }
        .lang_check{text-align: center;color: #000;}
        .languages .col-md-3{height: 65px;}
        .languages{margin-left: 0px;margin-right: 0px;}
        .lang_check label{font-weight: bold}

</style>
