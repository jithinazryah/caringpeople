<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MasterDesignations;
use yii\helpers\ArrayHelper;
?>


<div class="modal-content add-more-schedules">
        <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="largeModalLabel" style="color: #b60d14;">View Schedule</h4>
        </div>
        <div class="modal-body">
                <div class="row clearfix">

                        <div class="row" style="margin-left: 0px;">
                                <div class="col-md-6">
                                        <?php
                                        $service = common\models\Service::findOne($schedule->service_id);
                                        $service_id = '';
                                        if (!empty($service)) {
                                                $service_id = $service->service_id;
                                        }
                                        ?>
                                        <label>Service :</label>  <?= $service_id; ?>
                                </div>
                        </div>


                        <div class="row" style="margin-left: 0px;">
                                <div class="col-md-12">
                                        <label>Remarks from staff : </label>
                                </div>
                        </div>

                        <div class="row" style="margin-left: 0px;">
                                <div class="col-md-12">
                                        <textarea id="ckeditor1"><?= $schedule->remarks_from_staff; ?></textarea>
                                </div>
                        </div>




                        <div class="row" style="margin-left: 0px;">
                                <div class="col-md-12">
                                        <label>Remarks from manager : </label>
                                </div>
                        </div>


                        <div class="row" style="margin-left: 0px;">
                                <div class="col-md-12">
                                        <textarea id="page_body1"><?= $schedule->remarks_from_manager; ?></textarea>
                                </div>
                        </div>



                        <div class="row" style="margin-left: 0px;">
                                <div class="col-md-6">
                                        <label>Time In : </label> <?= $schedule->time_in; ?>
                                </div>

                                <div class="col-md-6">
                                        <label>Time Out : </label> <?= $schedule->time_out; ?>
                                </div>
                        </div>


                        <div class="row" style="margin-left: 0px;">
                                <div class="col-md-6">
                                        <label>Daily Rate Patient : </label> <?php
                                        if (!empty($schedule->patient_rate)) {
                                                echo 'Rs.' . $schedule->patient_rate;
                                        }
                                        ?>
                                </div>

                                <div class="col-md-6">
                                        <label>Daily Rate Staff : </label>
                                        <?php
                                        if (!empty($schedule->rate)) {
                                                echo 'Rs.' . $schedule->rate;
                                        }
                                        ?>
                                </div>
                        </div>



                </div>
        </div>


</div>


<style>
        .add-more-schedules label{
                color: #000;
                font-weight: bold;
        } #add_schedule{
                float: right;
                margin-right: 55px;
                margin-top: 13px;
                width: 100px;
        }

</style>
<script src="<?= Yii::$app->homeUrl; ?>js/ckeditor/ckeditor.js"></script>

<script type="text/javascript">
        CKEDITOR.addCss('h3{font-weight:bold;}');
        CKEDITOR.addCss('h3{text-decoration:underline;}');
        CKEDITOR.replace('ckeditor1',
                {
                        toolbar: 'Basic', /* this does the magic */
                        height: '100px',
                });

        CKEDITOR.replace('page_body1',
                {
                        toolbar: 'Basic', /* this does the magic */
                        height: '100px',
                });</script>
</script>