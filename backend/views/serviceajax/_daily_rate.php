<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MasterDesignations;
use yii\helpers\ArrayHelper;
?>


<div class="modal-content ">

        <div class="modal-header bg-blue">

                <h4 class="modal-title" id="largeModalLabel" style="color: #b60d14;">Add Daily Rate</h4>
        </div>

        <div class="modal-body">
                <div class="row clearfix">
                        <form id="schedule-daily-rate" >

                                <input type="hidden" name="scheduleid" id="scheduleid" value="<?= $schedule_id ?>">

                                <div class="row">
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                                <div class="col-md-4">
                                                        <label>Remarks from Staff :</label>
                                                </div>

                                                <div class="col-md-8">
                                                        <textarea id="" class="fields" name="remarks_staff"></textarea>
                                                </div>
                                        </div>
                                </div>

                                <div class="row">
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                                <div class="col-md-4">
                                                        <label>Remarks from Manager :</label>
                                                </div>

                                                <div class="col-md-8">
                                                        <textarea id="" class="fields" name="remarks_manager"></textarea>
                                                </div>
                                        </div>
                                </div>

                                <div class="row">
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                                <div class="col-md-4">
                                                        <label>Time In :</label>
                                                </div>

                                                <div class="col-md-8">
                                                        <input type="text" id="time_in" name="time_in" required="" class="fields">
                                                </div>
                                        </div>
                                </div>

                                <div class="row">
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                                <div class="col-md-4">
                                                        <label>Time Out :</label>
                                                </div>

                                                <div class="col-md-8">
                                                        <input type="text" id="time_out" name="time_out" required="" class="fields">
                                                </div>
                                        </div>
                                </div>

                                <div class="row">
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                                <div class="col-md-4">
                                                        <label>Daily Rate :</label>
                                                </div>

                                                <div class="col-md-8">
                                                        <input type="text" id="rate" name="rate" required="" class="fields">
                                                </div>
                                        </div>
                                </div>

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
