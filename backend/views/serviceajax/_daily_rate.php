<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MasterDesignations;
use yii\helpers\ArrayHelper;
?>


<div class="modal-content " >

        <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="largeModalLabel" style="color: #b60d14;">Add Daily Rate</h4>
        </div>

        <div class="modal-body">
                <div class="row clearfix">
                        <form id="schedule-daily-rate" >

                                <input type="hidden" name="scheduleid" id="scheduleid" value="<?= $schedule_id ?>">
                                <input type="hidden" name="status" id="status" value="<?= $status ?>">
                                <?php
                                $service_schedule = common\models\ServiceSchedule::findOne($schedule_id);
                                $service = common\models\Service::findOne($service_schedule->service_id);
                                ?>
                                <div class="row">
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                                <div class="col-md-4">
                                                        <label>Remarks from Staff :</label>
                                                </div>

                                        </div>
                                </div>

                                <div class="row">
                                        <div class="col-md-12 col-sm-6 col-xs-12">

                                                <textarea id="ckeditor" class="remarks_staff" name="remarks_staff">
                                                        <?php
                                                        if (Yii::$app->user->identity->post_id == '1' && !empty($schedule->remarks_from_staff)) {
                                                                echo $schedule->remarks_from_staff;
                                                        } else {
                                                                ?>
                                                                        <h3 style="font-weight:bold!important">Notes (patient daignosis and findings) </h3>
                                                                        <br><br>
                                                                        <h3 style="font-weight:bold!important">Medication Advice </h3>
                                                                        <br><br>
                                                                        <h3 style="font-weight:bold!important">Lab test advice  </h3>
                                                                        <br><br>
                                                                        <h3 style="font-weight:bold!important">Prescription   </h3>
                                                        <?php } ?>
                                                </textarea>
                                        </div>
                                </div>

                                <div class="row">
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                                <div class="col-md-4">
                                                        <label>Remarks from Manager :</label>
                                                </div>

                                        </div>
                                </div>
                                <div class="row">
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                                <textarea  class="fields" name="remarks_manager" id="page_body"><?php
                                                        if (Yii::$app->user->identity->post_id == '1') {
                                                                echo $schedule->remarks_from_manager;
                                                        }
                                                        ?></textarea>
                                        </div>
                                </div>

                                <div class="row">
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                                <div class="col-md-3">
                                                        <label>Time In :</label>
                                                </div>

                                                <div class="col-md-3">
                                                        <input type="text" id="time_in" name="time_in"  class="fields" <?php if (Yii::$app->user->identity->post_id == '1') { ?>value="<?= $schedule->time_in ?>" <?php } ?>>
                                                </div>


                                                <div class="col-md-3">
                                                        <label>Time Out :</label>
                                                </div>

                                                <div class="col-md-3">
                                                        <input type="text" id="time_out" name="time_out"  class="fields" <?php if (Yii::$app->user->identity->post_id == '1') { ?>value="<?= $schedule->time_out ?>" <?php } ?>>
                                                </div>
                                        </div>
                                </div>

                                <div class="row">
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                                <div class="col-md-3">
                                                        <label>Daily Rate Patient:</label>
                                                </div>

                                                <div class="col-md-3">
                                                        <input type="text" id="rate_patient" name="rate_patient"  class="fields" <?php if (Yii::$app->user->identity->post_id == '1') { ?>value="<?= $schedule->patient_rate ?>" <?php } ?>>
                                                </div>


                                                <div class="col-md-3">
                                                        <label>Daily Rate Staff:</label>
                                                </div>

                                                <div class="col-md-3">
                                                        <input type="text" id="rate" name="rate"  class="fields"  <?php if (Yii::$app->user->identity->post_id == '1') { ?>value="<?= $schedule->rate ?>" <?php } ?>>
                                                </div>
                                        </div>
                                </div>

                                <?php if ($service->co_worker == '1') { ?>
                                        <div class="row">
                                                <div class="col-md-12 col-sm-6 col-xs-12">
                                                        <div class="col-md-4">
                                                                <label>Co-worker:</label>
                                                        </div>
                                                        <?php
                                                        $co_worker = common\models\StaffInfo::find()->where(['<>', 'post_id', '5'])->andWhere(['<>', 'post_id', '1'])->andWhere(['status' => 1, 'branch_id' => $service->branch_id])->all();
                                                        ?>
                                                        <div class="col-md-8">
                                                                <?= Html::dropDownList('co_worker', null, ArrayHelper::map($co_worker, 'id', 'staff_name'), ['prompt' => '--Select--', 'class' => 'form-control', 'id' => 'oc_worker', 'style' => 'border: 1px solid #a9a9a9;']); ?>
                                                        </div>
                                                </div>
                                        </div>
                                <?php } ?>
                                
                                <?php if($status!=2){ ?>
                                
                                <div class="row" style="margin: 0;">
                                                
                                                <div class="col-md-6">
                                                        <input type="checkbox" name="change_price" id="chnage_price">  Change in estimated price
                                                </div>
                                        </div>
                                <?php } ?>


                                <input type="submit" name="submitf" id="submitf" class="btn btn-primary" style="float: right;margin-top: 10px;">

                                <!--<button type="button" class="btn btn-info" data-dismiss="modal" style="float: right;margin-top: 20px;">Continue</button>-->
                        </form>
                </div>
        </div>


</div>


<style>
        .fields{
                width:100%;
        }
        .row{
                margin-bottom: 10px;
        }

</style>




<script src="<?= Yii::$app->homeUrl; ?>js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
        CKEDITOR.addCss('h3{font-weight:bold;}');
        CKEDITOR.addCss('h3{text-decoration:underline;}');
        CKEDITOR.replace('ckeditor',
                {
                        toolbar: 'Basic', /* this does the magic */
                        height: '100px',

                });
        CKEDITOR.replace('page_body',
                {
                        toolbar: 'Basic', /* this does the magic */
                        height: '100px',
                });</script>

