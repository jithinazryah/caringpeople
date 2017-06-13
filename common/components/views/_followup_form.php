<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;
use common\models\Followups;
use common\models\FollowupType;
use common\models\FollowupSubType;
use common\models\StaffInfo;

if (isset($update_followup->repeated_type) && $update_followup->repeated_type != '') {
        $repeated = 'set';
} else {
        $repeated = 'unset';
}
?>

<div class="panel-body ">

        <div class="panel-body"><div class="followup_form">
                        <div class="branch-form form-inline">


                                <div id="followups">
                                        <input type="hidden" id="delete_port_vals"  name="delete_port_vals" value="">


                                        <!----------------------------------------------------For update a followup----------------------------------------------------------------->
                                        <?php
                                        if (!empty($update_followup)) {

                                                $followup_type = FollowupType::find()->all();
                                                $followup_subtype = FollowupSubType::find()->where(['type_id' => $update_followup->type, 'status' => '1'])->all();
                                                $all_users = StaffInfo::find()->where(['<>', 'post_id', '5'])->orderBy(['staff_name' => SORT_ASC])->all();
                                                $followup_type_Selected[] = $update_followup->type;
                                                $followup_subtype_Selected[] = $update_followup->sub_type;
                                                $assigned_to_selected[] = $update_followup->assigned_to;


                                                $related_staffs = explode(',', $update_followup->related_staffs);
                                                $related_staff_assgnd = [];
                                                foreach ($related_staffs as $value) {
                                                        $related_staff_assgnd[] = $value;
                                                }
                                                $repeated_days = [];
                                                $repeated_Dates = [];
                                                if (isset($update_followup->repeated_type) && $update_followup->repeated_type != '') {
                                                        $repeated_Days = explode(',', $update_followup->repeated_days);
                                                        if ($update_followup->repeated_type == '2') {
                                                                foreach ($repeated_Days as $days) {
                                                                        $repeated_days[] = $days;
                                                                }
                                                        } else {
                                                                foreach ($repeated_Days as $dates) {
                                                                        $repeated_Dates[] = $dates;
                                                                }
                                                        }
                                                }
                                                ?>
                                                <span>

                                                        <?php //if ($update_followup->type != 5) {             ?>
                                                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                                                <div class="form-group field-followups-sub_type">
                                                                        <label class="control-label" for="followups-sub_type">Category</label>
                                                                        <?= Html::dropDownList('updatee[' . $update_followup->id . '][sub_type][]', $followup_subtype_Selected, ArrayHelper::map($followup_subtype, 'id', 'sub_type'), ['class' => 'form-control followup_subtype', 'prompt' => '--Select--']); ?>
                                                                </div>
                                                        </div>
                                                        <?php //}             ?>

                                                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                                                <div class="form-group field-followups-followup_date">
                                                                        <label class="control-label" for="followups-followup_date">Followup Date</label>
                                                                        <input type="datetime-local" data-mask="datetime" class="form-control" name="updatee[<?= $update_followup->id; ?>][followup_date][]" value="<?= strftime('%Y-%m-%dT%H:%M:%S', strtotime($update_followup->followup_date)) ?>">
                                                                </div>
                                                        </div>

                                                        <?php
                                                        $data = ArrayHelper::map($all_users, 'id', 'namepost');

                                                        if ($update_followup->type == '5') {
                                                                $service = common\models\Service::findOne($type_id);
                                                                $data = Yii::$app->SetValues->Assigned($service);
                                                        }
                                                        ?>
                                                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                                                <div class="form-group field-followups-assigned_to">
                                                                        <label class="control-label" for="followups-assigned_to">Assigned To</label>
                                                                        <?= Html::dropDownList('updatee[' . $update_followup->id . '][assigned_to][]', $assigned_to_selected, $data, ['class' => 'form-control', 'prompt' => '--Select--']); ?>
                                                                </div>
                                                        </div>


                                                        <?php
                                                        $userid = Yii::$app->user->identity->id;
                                                        $user = StaffInfo::findOne($update_followup->assigned_from);
                                                        ?>
                                                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                                                <div class="form-group field-followups-assigned_from">
                                                                        <label class="control-label" for="followups-assigned_from">Assigned From</label>
                                                                        <input type="text" class="form-control" name="updatee[<?= $update_followup->id; ?>][assigned_from][]" readonly="readonly" value="<?= $user->staff_name; ?>">
                                                                </div>
                                                        </div>

                                                        <?php
                                                        $related_staff = Yii::$app->SetValues->Relatedstaffs($update_followup->type, $update_followup->type_id);
                                                        ?>

                                                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                                                <div class="form-group field-followups-followup_notes">
                                                                        <label class="control-label" for="followups-followup_notes">Related Staffs</label>
                                                                        <?= Html::dropDownList('updatee[' . $update_followup->id . '][related_staffs][]', $related_staff_assgnd, $related_staff, ['class' => 'form-control', 'prompt' => '--Select--', 'id' => 'update-related_staffs', 'multiple' => 'multiple']); ?>
                                                                </div>
                                                        </div>

                                                        <?php
                                                        if ($update_followup->type == '5') {
                                                                if (isset($update_followup->releated_notification_patient) && $update_followup->releated_notification_patient != '') {
                                                                        $notific_patient = '1';
                                                                } else {
                                                                        $notific_patient = 0;
                                                                }
                                                                ?>

                                                                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                                        <div class="form-group field-followups-related-patient">
                                                                                <label class="control-label" for="followups-related-patient">Send notification to patient</label>
                                                                                <?= Html::dropDownList('updatee[' . $update_followup->id . '][related-patient][]', $notific_patient, ['1' => 'Yes', '0' => 'No'], ['class' => 'form-control']); ?>
                                                                        </div>
                                                                </div>
                                                        <?php } ?>


                                                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                                <div class="form-group field-followups-assigned_from">
                                                                        <label class="control-label" for="followups-assigned_from">Attachments</label>
                                                                        <input type = "file" name = "updatee[image][]" />

                                                                </div>
                                                        </div>


                                                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                                                <div class="form-group field-followups-followup_notes">
                                                                        <label class="control-label" for="followups-followup_notes">Followup Notes</label>
                                                                        <textarea id="followups-followup_notes" class="form-control" name="updatee[<?= $update_followup->id; ?>][followup_notes][]" ><?= $update_followup->followup_notes; ?></textarea>
                                                                </div>
                                                        </div>



                                                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                                                <div class="form-group field-followups-followup_date">
                                                                        <label class="control-label" for="followups-status">Status</label>
                                                                        <select name="updatee[<?= $update_followup->id; ?>][status][]" class="form-control">
                                                                                <option value="0" <?php
                                                                                if ($update_followup->status == '0' || $update_followup->status == '3') {
                                                                                        echo 'selected';
                                                                                }
                                                                                ?>>Open</option>
                                                                                <option value="1" <?php
                                                                                if ($update_followup->status == '1') {
                                                                                        echo 'selected';
                                                                                }
                                                                                ?>>Closed</option>
                                                                                <option value="2" <?php
                                                                                if ($update_followup->status == '2') {
                                                                                        echo 'selected';
                                                                                }
                                                                                ?>>Void</option>
                                                                        </select>
                                                                </div>
                                                        </div>





                                                        <?php if (isset($update_followup->repeated_type) && $update_followup->repeated_type != '') { ?>

                                                                <div class='col-md-2 col-sm-6 col-xs-12 left_padd' id="repeated" >
                                                                        <div class="form-group field-followups-repeated_followups">
                                                                                <label class="control-label" for="followups-assigned_from"></label>
                                                                                <input type="checkbox" name="updatee[<?= $update_followup->id ?>][repeated_followups][]" id="repeated_followups" <?php if (isset($update_followup->repeated_type) && $update_followup->repeated_type != '') { ?> checked="checked"<?php } ?> style="margin-top: 20px;"> <span style="color: #000;font-weight: bold;">Repeated Followups</span>
                                                                        </div>
                                                                </div>

                                                                <div class="col-md-4 col-sm-6 col-xs-12 left_padd" id="repeated-types">
                                                                        <div class="form-group field-followups-assigned_from">
                                                                                <label class="control-label" for="followups-repeated-options">Followup to be set for</label>
                                                                                <select name="updatee[<?= $update_followup->id ?>][repeated_option][]" id="repeated-option-update" class="form-control">
                                                                                        <option value="">--Select--</option>
                                                                                        <option value="4" <?php
                                                                                        if ($update_followup->repeated_type == '4') {
                                                                                                echo 'selected';
                                                                                        }
                                                                                        ?>>Every Day</option>
                                                                                        <option value="1" <?php
                                                                                        if ($update_followup->repeated_type == '1') {
                                                                                                echo 'selected';
                                                                                        }
                                                                                        ?>>Specific Dates</option>
                                                                                        <option value="2" <?php
                                                                                        if ($update_followup->repeated_type == '2') {
                                                                                                echo 'selected';
                                                                                        }
                                                                                        ?>>Specific Days of week</option>
                                                                                        <option value="3" <?php
                                                                                        if ($update_followup->repeated_type == '3') {
                                                                                                echo 'selected';
                                                                                        }
                                                                                        ?>>Specific Days of month</option>
                                                                                </select>
                                                                        </div>
                                                                </div>
                                                        <?php } ?>

                                                        <?php
                                                        $days = Yii::$app->SetValues->Days();
                                                        ?>
                                                        <div class="col-md-4 col-sm-6 col-xs-12 left_padd option2_update" style="display: none">
                                                                <div class="form-group field-followups-assigned_from">
                                                                        <label class="control-label" for="reminder-remind_days">Select Day</label>
                                                                        <?= Html::dropDownList('updatee[' . $update_followup->id . '][specific-days][]', $repeated_days, $days, ['class' => 'form-control', 'id' => 'specific-days-update', 'multiple' => 'multiple']); ?>
                                                                </div>
                                                        </div>





                                                        <!----------------------------Specific days of week------------------------------------->
                                                        <?php
                                                        $dates = Yii::$app->SetValues->Dates();
                                                        ?>
                                                        <div class="col-md-4 option3_update" style="display: none;">
                                                                <div class="form-group field-followups-assigned_from">
                                                                        <label class="control-label" for="reminder-remind_days">Select Date</label>
                                                                        <?= Html::dropDownList('updatee[' . $update_followup->id . '][specific-dates-month][]', $repeated_Dates, $dates, ['class' => 'form-control', 'id' => 'specific-dates-month-update', 'multiple' => 'multiple']); ?>
                                                                </div>
                                                        </div>




                                                        <div class='col-md-1 col-sm-6 col-xs-12 left_padd'>
                                                                <a id="remFollowup_<?= $repeated ?>" val="<?= $update_followup->id; ?>" title='Delete Followup'  class="btn btn-icon btn-red remFollowup" style="margin-top:15px;"><i class="fa-remove"></i></a>
                                                        </div>
                                                </span>

                                                <?php
                                        }
                                        ?>

                                        <div style="clear: both"></div>


                                        <!-------------------------------------------------------For update a followup----------------------------------------------------------------->









                                        <!-------------------------------------------------------------------For create---------------------------------------------------------------->


                                        <?php
                                        if ($repeated == 'unset') {
                                                $followup_type = FollowupType::find()->all();
                                                $followup_subtype = FollowupSubType::find()->where(['type_id' => $type, 'status' => '1'])->all();
                                                $rand = rand();
                                                ?>
                                                <span>
                                                        <input type="hidden" name="create[type][]" value="<?= $type; ?>" id="type">
                                                        <input type="hidden" name="create[type_id][]" value="<?= $type_id; ?>" id="type_id">

                                                        <?php if ($type_id == 'NULL' && $type == 'NULL') { ?>
                                                                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                                                        <div class="form-group field-followups-sub_type">
                                                                                <label class="control-label" for="followups-sub_type">Type</label>
                                                                                <?= Html::dropDownList('create[typed][]', null, ArrayHelper::map($followup_type, 'id', 'type'), ['class' => 'form-control followup_type', 'id' => $rand, 'prompt' => '--Select--']); ?>
                                                                        </div>
                                                                </div>
                                                        <?php }
                                                        ?>


                                                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                                                <div class="form-group field-followups-sub_type">
                                                                        <label class="control-label" for="followups-sub_type">Category</label>
                                                                        <?= Html::dropDownList('create[sub_type][]', null, ArrayHelper::map($followup_subtype, 'id', 'sub_type'), ['class' => 'form-control followup_subtype', 'id' => 'sub_' . $rand, 'prompt' => '--Select--']); ?>
                                                                </div>
                                                        </div>



                                                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                                                <div class="form-group field-followups-followup_date">
                                                                        <label class="control-label" for="followups-followup_date">Followup Date</label>
                                                                        <input type="datetime-local" class="form-control some_class" name="create[followup_date][]" >

                                                                </div>
                                                        </div>


                                                        <?php
                                                        $all_users = StaffInfo::find()->where(['<>', 'post_id', '5'])->orderBy(['staff_name' => SORT_ASC])->all();
                                                        $data = ArrayHelper::map($all_users, 'id', 'namepost');

                                                        if (isset($type) && $type != '' && $type != '5') {
                                                                $assigned_too[] = $type_id;
                                                        } else if ($type == '5') {
                                                                $service = common\models\Service::findOne($type_id);
                                                                $data = Yii::$app->SetValues->Assigned($service);
                                                        } else {
                                                                $assigned_too[] = '';
                                                        }
                                                        ?>
                                                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                                                <div class="form-group field-followups-assigned_to">
                                                                        <label class="control-label" for="followups-assigned_to">Assigned To</label>
                                                                        <?= Html::dropDownList('create[assigned_to][]', $assigned_too, $data, ['class' => 'form-control create-assignedto', 'prompt' => '--Select--', 'id' => 'create-assignedto_4']); ?>
                                                                </div>
                                                        </div>

                                                        <input type="hidden" name="create[assigned_to_type][]" id="assigned_to_type_4" value="">


                                                        <?php
                                                        $userid = Yii::$app->user->identity->id;
                                                        $user = StaffInfo::findOne($userid);
                                                        ?>
                                                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                                                <div class="form-group field-followups-assigned_from">
                                                                        <label class="control-label" for="followups-assigned_from">Assigned From</label>
                                                                        <input type="text" class="form-control" name="create[assigned_from][]" readonly="readonly" value="<?= $user->staff_name; ?>">

                                                                </div>
                                                        </div>

                                                        <?php
                                                        $related_staff = Yii::$app->SetValues->Relatedstaffs($type, $type_id);
                                                        if ($type == 5) {
                                                                $selected_staff = Yii::$app->SetValues->Selectedstaffs($type, $type_id);
                                                        } else {
                                                                $selected_staff = '';
                                                        }
                                                        ?>

                                                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                                                <div class="form-group field-followups-related_staffs">
                                                                        <label class="control-label" for="followups-related_staffs">Related Staffs</label>
                                                                        <?= Html::dropDownList('create[related_staffs][0][]', $selected_staff, $related_staff, ['class' => 'form-control', 'prompt' => '--Select--', 'id' => 'create-related_staffs', 'multiple' => 'multiple']); ?>
                                                                </div>
                                                        </div>

                                                        <?php
                                                        if ($type == 5) {
                                                                ?>

                                                                <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                                        <div class="form-group field-followups-related-patient">
                                                                                <label class="control-label" for="followups-related-patient">Send notification to patient</label>
                                                                                <?= Html::dropDownList('create[related-patient][]', null, ['1' => 'Yes', '0' => 'No'], ['class' => 'form-control']); ?>
                                                                        </div>
                                                                </div>
                                                        <?php } ?>

                                                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                                <div class="form-group field-followups-assigned_from">
                                                                        <label class="control-label" for="followups-assigned_from">Attachments</label>
                                                                        <input type = "file" name = "create[image][]" />

                                                                </div>
                                                        </div>





                                                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                                                <div class="form-group field-followups-followup_notes">
                                                                        <label class="control-label" for="followups-followup_notes">Followup Notes</label>
                                                                        <textarea id="followups-followup_notes" class="form-control" name="create[followup_notes][]"></textarea>
                                                                </div>
                                                        </div>





                                                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd' id="repeated">
                                                                <div class="form-group field-followups-repeated_followups">
                                                                        <label class="control-label" for="followups-assigned_from"></label>
                                                                        <input type="checkbox" name="create[repeated_followups]" id="repeated_followups"> <span style="color: #000;font-weight: bold;">Repeated Followups</span>
                                                                </div>
                                                        </div>


                                                        <div class="col-md-4 col-sm-6 col-xs-12 left_padd" id="repeated-types" style="display:none;">
                                                                <div class="form-group field-followups-assigned_from">
                                                                        <label class="control-label" for="followups-repeated-options">Followup to be set for</label>
                                                                        <select name="create[repeated_option][]" id="repeated-option" class="form-control">
                                                                                <option value="">--Select--</option>
                                                                                <option value="4">Every Day</option>
                                                                                <option value="1">Specific Dates</option>
                                                                                <option value="2">Specific Days of week</option>
                                                                                <option value="3">Specific Days of month</option>
                                                                        </select>
                                                                </div>
                                                        </div>

                                                        <!----------------------------Specific date------------------------------------->
                                                        <div class="col-md-12 option1 col-sm-6 col-xs-12 left_padd" style="display: none;">

                                                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd text-items'>
                                                                        <div class="form-group field-followups-date">
                                                                                <label class="control-label" for="reminder-remind_days">Select Date</label>
                                                                                <input type="datetime-local" id="reminder-remind_days1" class="form-control remind_days1" name="create[remind_days1][0][]">
                                                                        </div>
                                                                </div>

                                                                <div class="col-md-3" style="margin-top: 15px;">
                                                                        <a class="btn btn-blue btn-icon btn-icon-standalone add-items" ><i class="fa-plus"></i><span>Add More Dates</span></a>

                                                                </div>
                                                        </div>

                                                        <!----------------------------Specific days of week------------------------------------->

                                                        <div class="col-md-12 option2 col-sm-6 col-xs-12 left_padd" style="display: none;">
                                                                <?php
                                                                $days = Yii::$app->SetValues->Days();
                                                                ?>
                                                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                                        <div class="form-group field-followups-date">
                                                                                <label class="control-label" for="reminder-remind_days">Select Day</label>
                                                                                <?= Html::dropDownList('create[specific-days][0][]', null, $days, ['class' => 'form-control', 'id' => 'specific-days', 'multiple' => 'multiple']); ?>
                                                                        </div>
                                                                </div>
                                                        </div>

                                                        <!----------------------------Specific days of week------------------------------------->
                                                        <div class="col-md-12 option3" style="display: none;margin-left: -15px;">
                                                                <?php
                                                                $dates = Yii::$app->SetValues->Dates();
                                                                ?>
                                                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                                        <div class="form-group field-followups-date">
                                                                                <label class="control-label" for="reminder-remind_days">Select Date</label>
                                                                                <?= Html::dropDownList('create[specific-dates-month][0][]', null, $dates, ['class' => 'form-control', 'id' => 'specific-dates-month', 'multiple' => 'multiple']); ?>
                                                                        </div>
                                                                </div>
                                                        </div>

                                                        <div style="clear:both"></div>
                                                </span>
                                        </div>

                                        <div class="row">
                                                <div class="col-md-6">
                                                        <a id="addFollowups" class="btn btn-blue btn-icon btn-icon-standalone addFollowups" ><i class="fa-plus"></i><span> Add More Followups</span></a>
                                                </div>
                                        </div>
                                <?php } ?>
                                <!--                                        <hr style="border-top: 1px solid #979898 !important;">-->

                                <div class='row' style="float:right;">
                                        <div class="form-group" style="float: right;">
                                                <?= Html::submitButton($update_followup == '' ? 'Create' : 'Update', ['class' => $update_followup == '' ? 'btn btn-success' : 'btn btn-primary', 'style' => 'height: 36px; width:100px;', 'name' => !isset($update_followup) ? 'creates' : 'update',]) ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>


</div>

<style>
        input[type=checkbox]{
                margin-top: 30px;
        }
</style>
