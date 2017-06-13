<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Followups;
use common\models\FollowupType;
use common\models\Hospital;
use common\models\FollowupSubType;
use common\models\StaffInfo;
use kartik\datetime\DateTimePicker;

$cnt = $count + 1;
$rand = rand();
$todays_date = date('d-M-Y h:i');
$followup_subtype = FollowupSubType::find()->where(['type_id' => $type, 'status' => '1'])->all();
$userid = Yii::$app->user->identity->id;
$user = StaffInfo::findOne($userid);
?>



<span>
        <hr style='border-top: 1px solid #979898 !important;'>
        <input type='hidden' name='create[type][]' value=" <?= $type ?>">
        <input type='hidden' name='create[type_id][]' value="<?= $type_id ?>">
        <?php
        if ($type == 'NULL') {
                $followup_type = FollowupType::find()->all();
                ?>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <div class='form-group field-followups-sub_type'>
                                <label class='control-label'> Type</label>
                                <?= Html::dropDownList('create[typed][]', null, ArrayHelper::map($followup_type, 'id', 'type'), ['class' => 'form-control followup_type', 'prompt' => '--Select--', 'id' => $rand, 'required' => "required"]); ?>
                        </div>
                </div>
        <?php } ?>


        <div class = 'col-md-4 col-sm-6 col-xs-12 left_padd'>
                <div class = 'form-group field-followups-sub_type'>
                        <label class = 'control-label'>Sub Type</label>
                        <?= Html::dropDownList('create[sub_type][]', null, ArrayHelper::map($followup_subtype, 'id', 'sub_type'), ['class' => 'form-control followup_subtype', 'id' => 'sub_' . $rand, 'prompt' => '--Select--']); ?>
                </div>
        </div>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <div class='form-group field-followups-followup_date'>
                        <label class='control-label followup_date' for='followups-followup_date'>Followup Date</label>
                        <input type='datetime-local' class='form-control some_class' name='create[followup_date][]' data-mask='datetime'>
                </div>
        </div>

        <?php
        if ($type != 5) {
                $all_users = StaffInfo::find()->where(['<>', 'post_id', '5'])->orderBy(['staff_name' => SORT_ASC])->all();
                $assigned_to = Html::dropDownList('create[assigned_to][]', null, ArrayHelper::map($all_users, 'id', 'namepost'), ['class' => 'form-control create-assignedto', 'prompt' => '--Select--', 'id' => 'create-assignedto_' . $cnt]);
        } else {
                $service = \common\models\Service::find()->where(['id' => $type_id])->one();
                $data = Yii::$app->SetValues->Assigned($service);
                $assigned_to = Html::dropDownList('create[assigned_to][]', null, $data, ['class' => 'form-control create-assignedto', 'prompt' => '--Select--', 'id' => 'create-assignedto_' . $cnt]);
        }
        ?>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <div class='form-group field-followups-assigned_to'>
                        <label class='control-label'>Assigned To</label>
                        <?= $assigned_to ?>
                </div>
        </div>
        <input type='hidden' name='create[assigned_to_type][]' id='assigned_to_type_<?= $cnt ?>' value=''>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <div class='form-group field-followups-assigned_from'>
                        <label class='control-label' for='followups-assigned_from'>Assigned From</label>
                        <input type='text' class='form-control' name='create[assigned_from][]' value='<?= $user->staff_name ?>' readonly='readonly'>
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
                <div class='form-group field-followups-related_staffs'>
                        <label class='control-label'>Related Staffs</label>
                        <?= Html::dropDownList('create[related_staffs][' . $count . '][]', $selected_staff, $related_staff, ['class' => 'form-control ', 'prompt' => '--Select--', 'id' => 'create-related_staffs_' . $count, 'multiple' => 'multiple']); ?>
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
                <div class='form-group field-followups-followup_notes'>
                        <label class='control-label' for='followups-followup_notes'>Attachments</label>
                        <input type = 'file' name = 'create[image][]' />
                </div>
        </div>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                <div class='form-group field-followups-followup_notes'>
                        <label class='control-label' for='followups-followup_notes'>Followup Notes</label>
                        <textarea class='form-control' name='create[followup_notes][]'></textarea>
                </div>
        </div>


        <a id='remFollowup' class='btn btn-icon btn-red remFollowup' title='Delete' style='margin-top: 15px;'><i class='fa-remove'></i></a>
        <div style='clear:both'></div>



</span>



