<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;
use common\models\FollowupType;
use common\models\FollowupSubType;
use common\models\AdminUsers;

if ($data->status == '0') {
        $color = 'blockquote-info'; //status-open
        $status = 'Open';
} else if ($data->status == '1') {
        $color = 'blockquote-success'; //status-closed
        $status = 'Closed';
} else if ($data->status == '2') {
        $color = 'blockquote-warning'; //status-void
        $status = 'Void';
} else if ($data->status == '3') {
        $color = 'blockquote-red'; //status-pending
        $status = 'Pending';
}

$assigned_to = AdminUsers::findOne($data->assigned_to);
$assigned_to = $assigned_to->name;
$assigned_from = AdminUsers::findOne($data->assigned_from);
$assigned_from = $assigned_from->name;
$encrypt_followup_id = Yii::$app->EncryptDecrypt->Encrypt('encrypt', $data->id);
?>


<div class="col-sm-6 col-md-6 <?= $data->id ?>">
        <blockquote class="blockquote <?= $color; ?>">
                <p>
                        <i class="linecons-note"></i> <strong><?= $data->followup_date ?></strong>
                        <span style="float: right;color: #7c38bc;font-size: 12px;">
                                Assigned To: <?= $assigned_to; ?>
                                <?php if ($data->status != 1) { ?>      <a href="<?= Yii::$app->homeUrl . 'followup/followups/followups?type_id=' . $data->type_id . '&type=' . $data->type . '&id=' . $data->id; ?>" title="Edit"> <i class="fa-edit" style="color:#000;margin-left: 10px;font-size: 20px;"></i></a><?php } ?>
                        </span>
                </p>

                <p style="text-align:right;font-size: 12px;margin-top: 3px;">
                        <span>Status: <?= $status; ?></span>
                </p>

                <p>
                        <small><?= $data->followup_notes; ?></small>
                </p>

                <p>
                        <span style="font-size: 12px;">
                                Assigned by: <?= $assigned_from; ?> <br>
                                <?= date('d-m-Y', strtotime($data->DOC)); ?>
                        </span>
                        <span>
                                <?php if ($data->status != 1) { ?>        <input type="checkbox" value="<?= $data->id ?>" class="iswitch iswitch-secondary followup_closed " title="Mrak it if this task is closed" style="float:right;"> <?php } ?>
                        </span>
                </p>
        </blockquote>
</div>


