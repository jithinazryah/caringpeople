<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\FollowupsWidget;
use common\components\FollowupsviewWidget;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$heading = 'Follow ups -';

if ($type == '1') {
        $enquiry_id = \common\models\PatientEnquiryGeneralFirst::findOne($type_id);
        $followup_for = $enquiry_id->enquiry_number;
        $link = 'update-patient-enquiry/' . $type_id;
} elseif ($type == '2') {
        $enquiry_id = common\models\PatientGeneral::findOne($type_id);
        $followup_for = $enquiry_id->patient_id;
        $link = 'update-patient/' . $type_id;
} elseif ($type == '3') {
        $enquiry_id = common\models\StaffEnquiry::findOne($type_id);
        $followup_for = $enquiry_id->enquiry_id;
        $link = 'update-staff-enquiry/' . $type_id;
} elseif ($type == '4') {
        $enquiry_id = common\models\StaffInfo::findOne($type_id);
        $followup_for = $enquiry_id->staff_id;
        $link = 'update-staff/' . $type_id;
} elseif ($type == '5') {

        $enquiry_id = common\models\Service::findOne($type_id);
        $followup_for = $enquiry_id->id;
        $link = 'update-service/' . $type_id;
} else {
        $heading = 'Follow ups';
        $followup_for = '';
        $link = '#';
}
?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<div class="row ">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= $heading ?> <a href="<?= Yii::$app->homeUrl . $link ?>" style="color:#1b44ab"><?= $followup_for ?></a></h3>

                        </div>
                        <?php
                        if (isset($service) && $service != 'NULL') {
                                echo $this->render('_menus', [
                                    'type_id' => $type_id,
                                ]);
                        }
                        ?>
                        <a class="add_follow btn btn-blue" style="margin-top:10px;">Add Followups</a>
                        <a href="<?= Yii::$app->homeUrl; ?>followup/followups/closed?type_id=<?= $type_id ?> &type=<?= $type ?>" class="btn btn-secondary" style="margin-top:10px;">Closed Followups</a>


                        <!-------------------------------calling widget for the form----------------------->

                        <?= FollowupsWidget::widget(['type_id' => $type_id, 'type' => $type, 'update_followup' => $update_followup]); ?>

                        <!-------------------------------calling widget for the form----------------------->


                        <!-------------------------------calling widget for viewing previously added followups----------------------->
                        <div class="row">
                                <?php
                                if (!empty($followups)) {
                                        foreach ($followups as $value) {

                                                echo FollowupsviewWidget::widget(['data' => $value]);
                                        }
                                } else {
                                        echo '<p style="text-align:center;"> No followups found !!</p>';
                                }
                                ?>

                        </div>

                        <!-------------------------------calling widget for viewing previously added followups----------------------->
                </div>
        </div>
</div>


<?php ActiveForm::end(); ?>


<style>
        .blockquote.blockquote-red:before{
                background-color: #fff;
        }
</style>

<?php if (!isset($update_followup)) { ?>
        <script>
                $(document).ready(function () {
                        $('.followup_form').hide();

                });
        </script>
<?php } ?>


<script>
        $(document).ready(function () {
                $('.add_follow').click(function () {
                        $('.followup_form').slideToggle();
                });
        });
</script>
