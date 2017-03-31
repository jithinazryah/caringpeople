<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use common\models\AdminUsers;

/* @var $this yii\web\View */
/* @var $model common\models\StaffEnquirySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<?php // ++$index;  ?>


<?php
if ($model->status == '0') {
        $color = 'blockquote-info'; //status-open
} else if ($model->status == '1') {
        $color = 'blockquote-success'; //status-closed
} else if ($model->status == '2') {
        $color = 'blockquote-warning'; //status-void
} else if ($model->status == '3') {
        $color = 'blockquote-red'; //status-pending
}

$assigned_to = AdminUsers::findOne($model->assigned_to);
$assigned_to = $assigned_to->name;
$assigned_from = AdminUsers::findOne($model->assigned_from);
$assigned_from = $assigned_from->name;
?>



<div class="col-sm-6 col-md-6">
        <blockquote class="blockquote <?php echo $color; ?>">
                <p>
                        <i class="linecons-note"></i> <strong><?= date('d-M-Y H:i:s', strtotime($model->followup_date)); ?></strong>
                        <span style="float: right;color: #7c38bc;font-size: 12px;">
                                Assigned To: <?= $assigned_to; ?>
                                <a href="<?= Yii::$app->homeUrl . 'update-staff-enquiry/' . $staff_enquiry_id . '?followup=' . $model->id ?>" title="Edit"> <i class="fa-edit" style="color:#000;margin-left: 10px;font-size: 20px;"></i></a>
                        </span>
                </p>
                <span style="float: right;color: #7c38bc;font-size: 12px;">Status: open</span>
                <p>
                        <small><?= $model->followup_notes; ?></small>
                </p>
                <p>
                        <span style="font-size: 12px;">
                                Assigned by: <?= $assigned_from; ?> <br>
                                <?= date('d-M-Y', strtotime($model->DOC)); ?>
                        </span>
                </p>
        </blockquote>
</div>











