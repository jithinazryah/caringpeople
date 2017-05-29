
<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use common\models\Followups;
use common\models\FollowupType;
use common\models\FollowupSubType;
use common\models\StaffInfo;
use kartik\datetime\DateTimePicker;
?>


<input type="hidden" name="type" id="add_type" value="<?= $type; ?>">
<input type="hidden" name="type_id" id="add_type_id" value="<?= $type_id; ?>">

<div class="row">
        <div class="col-md-6">
                <?php $followup_subtype = FollowupSubType::find()->where(['type_id' => $type, 'status' => '1'])->all(); ?>
                <div class="form-group subtype">
                        <div class='subtypediv'><label for='field-1' class='control-label subtypediv'>Sub Type</label>
                                <?= Html::dropDownList('sub_type', null, ArrayHelper::map($followup_subtype, 'id', 'sub_type'), ['class' => 'form-control subtypediv', 'id' => 'field-1', 'prompt' => '--Select--', 'required' => 'required']) ?>
                        </div>
                </div>

        </div>

        <div class="col-md-6">

                <div class="form-group">
                        <label for="field-2" class="control-label ">Followup Date</label>
                        <input type="datetime-local" class="form-control some_class" id="field-2" data-mask="datetime" required="required">
                </div>

        </div>
</div>


<div class="row">
        <div class="col-md-6">
                <?php
                /*
                 * expect staff
                 */
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
                <div class="form-group">
                        <label for="field-1" class="control-label">Assigned To</label>

                        <?= Html::dropDownList('assigned_to', $assigned_too, $data, ['class' => 'form-control', 'id' => 'field-3', 'prompt' => '--Select--', 'required' => 'required']); ?>
                </div>

        </div>

        <div class="col-md-6">
                <?php
                $userid = Yii::$app->user->identity->id;
                $user = common\models\StaffInfo::findOne($userid);
                ?>
                <div class="form-group">
                        <label for="field-2" class="control-label">Assigned From</label>

                        <input type="text" class="form-control" id="field-4" value="<?= $user->staff_name; ?>" readonly="readonly">
                </div>

        </div>
</div>


<div class="row">
        <div class="col-md-12">
                <?php
                $related_staff = Yii::$app->SetValues->Relatedstaffs($type, $type_id);
                ?>
                <div class="form-group no-margin">
                        <label for="field-7" class="control-label">Related Staffs</label>
                        <?= Html::dropDownList('related_staffs', null, $related_staff, ['class' => 'form-control', 'prompt' => '--Select--', 'id' => 'related_staffs_field', 'multiple' => 'multiple']); ?>
                </div>

        </div>
</div>


<div class="row">
        <div class="col-md-12">

                <div class="form-group no-margin">
                        <label for="field-7" class="control-label">Followup Notes</label>

                        <textarea class="form-control autogrow" id="field-5"></textarea>
                </div>

        </div>
</div>
