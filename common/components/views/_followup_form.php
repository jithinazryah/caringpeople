<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\FollowupsWidget;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;
use common\models\FollowupSubType;
use common\models\StaffInfo;

$followup_subtype = ArrayHelper::map(FollowupSubType::find()->where(['type_id' => $type, 'status' => 1])->all(), 'id', 'sub_type');
?>


<div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="display: none">  <?php echo $form_followup->field($model, 'type')->hiddenInput(['value' => $type])->label(false); ?>

</div><div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="display: none">  <?php echo $form_followup->field($model, 'type_id')->hiddenInput(['value' => $type_id])->label(false); ?>

</div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form_followup->field($model, 'sub_type')->dropDownList($followup_subtype, ['prompt' => '--Select--', 'class' => 'form-control']) ?>

</div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
        <div class="form-group field-followups-followupdate">
                <label class="control-label" for="followups-followupdate">Followup Date</label>
                <?php
                echo DateTimePicker::widget([
                    'name' => 'Followups[followup_date]',
                    'type' => DateTimePicker::TYPE_INPUT,
                    'value' => date('d-M-Y h:i'),
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-M-yyyy hh:ii'
                    ]
                ]);
                ?>



        </div>

</div>
<?php
$all_users = StaffInfo::find()->where(['<>', 'post_id', '5'])->orderBy(['staff_name' => SORT_ASC])->all();
$data = ArrayHelper::map($all_users, 'id', 'namepost');
if ($type == '5') {
        $service = common\models\Service::findOne($type_id);
        $data = Yii::$app->Followups->Assigned($service);
}
?>

<div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form_followup->field($model, 'assigned_to')->dropDownList($data, ['prompt' => '--Select--', 'class' => 'form-control', 'id' => 'create-assigned_to']) ?>

</div>
<?php
$user = StaffInfo::findOne(Yii::$app->user->identity->id);
$model->assigned_from = $user->staff_name;
?>
<div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form_followup->field($model, 'assigned_from')->textInput(['maxlength' => true]) ?>

</div>

<?php
$related_staff = Yii::$app->Followups->Relatedstaffs($type, $type_id);
if ($type == 5) {
        $model->related_staffs = Yii::$app->Followups->Selectedstaffs($type, $type_id);
} else if ($type == 1) {
        $all_users = StaffInfo::find()->where(['<>', 'post_id', '5'])->orderBy(['staff_name' => SORT_ASC])->all();
        $related_staff = ArrayHelper::map($all_users, 'id', 'namepost');
}
?>
<div class='col-md-2 col-sm-6 col-xs-12 left_padd'>          <?= $form_followup->field($model, 'related_staffs')->dropDownList($related_staff, ['prompt' => '--Select--', 'class' => 'form-control', 'id' => 'create-related_staffs', 'multiple' => 'multiple']) ?>

</div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form_followup->field($model, 'attachments')->fileInput(['maxlength' => true]) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form_followup->field($model, 'followup_notes')->textArea(['rows' => 1]) ?>

</div><div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form_followup->field($model, 'repeated')->checkBox(['id' => 'repeated_followups']); ?>

</div><div class='col-md-2 col-sm-6 col-xs-12 left_padd' id="repeated-types">    <?= $form_followup->field($model, 'repeated_type')->dropDownList(['' => '--Select--', '4' => 'Every Day', '1' => 'Specific Dates', '2' => 'Specific Days of week', '3' => 'Specific Days of month'], ['id' => 'repeated-option']) ?>

</div>



<!----------------------------Specific date------------------------------------->
<div class="col-md-12 option1 col-sm-6 col-xs-12 left_padd" style="display: none;">

        <div class='col-md-3 col-sm-6 col-xs-12 left_padd text-items'>
                <div class="form-group field-followups-date">
                        <label class="control-label" for="reminder-remind_days">Select Date</label>
                        <input type="datetime-local" id="reminder-remind_days1" class="form-control remind_days1" name="date[remind_days1][]">
                </div>
        </div>

        <div class="col-md-3" style="margin-top: 15px;">
                <a class="btn btn-blue btn-icon btn-icon-standalone add-items" ><i class="fa-plus"></i><span>Add More Dates</span></a>

        </div>
</div>

<!----------------------------Specific days of week------------------------------------->

<?php
$days = Yii::$app->Followups->Days();
?>
<div class='col-md-3 col-sm-6 col-xs-12 left_padd option2' style="display: none;">
        <div class="form-group field-followups-date">
                <label class="control-label" for="reminder-remind_days">Select Day</label>
                <?= Html::dropDownList('create[specific-days]', null, $days, ['class' => 'form-control', 'id' => 'specific-days', 'multiple' => 'multiple']); ?>
        </div>
</div>


<!----------------------------Specific days of week------------------------------------->

<?php
$dates = Yii::$app->Followups->Dates();
?>
<div class='col-md-3 col-sm-6 col-xs-12 left_padd option3' style="display: none;">
        <div class="form-group field-followups-date">
                <label class="control-label" for="reminder-remind_days">Select Date</label>
                <?= Html::dropDownList('create[specific-dates-month]', null, $dates, ['class' => 'form-control', 'id' => 'specific-dates-month', 'multiple' => 'multiple']); ?>
        </div>
</div>




<div class='col-md-12 col-sm-6 col-xs-12' >
        <div class="form-group" >
                <?= Html::submitButton($patient_info->isNewRecord ? 'Create' : 'Create', ['class' => $patient_info->isNewRecord ? 'btn btn-success' : 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>

        </div>
</div>




















