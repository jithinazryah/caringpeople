<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\PatientGeneral;
use common\models\MasterServiceTypes;
use yii\helpers\ArrayHelper;
use common\models\StaffInfo;
use kartik\date\DatePicker;
use common\models\Branch;
use common\models\MasterDesignations;

/* @var $this yii\web\View */
/* @var $model common\models\Service */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-form form-inline">

        <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model); ?>
        <div class="row">

                <?php
                $branches = Branch::Branch();
                ?>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($model, 'branch_id')->dropDownList(ArrayHelper::map($branches, 'id', 'branch_name'), ['prompt' => '--Select--']) ?>
                </div>
                <?php ?>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?php
                        if (!$model->isNewRecord) {
                                $patient = PatientGeneral::find()->where(['status' => 1, 'branch_id' => $model->branch_id])->orderBy(['first_name' => SORT_ASC])->all();
                        } else {
                                $patient = [];
                        }
                        ?>
                        <?= $form->field($model, 'patient_id')->dropDownList(ArrayHelper::map($patient, 'id', 'first_name'), ['class' => 'form-control', 'prompt' => '--Select--']) ?>
                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?php
                        $sevice_type = MasterServiceTypes::find()->where(['status' => 1])->all();
                        ?>
                        <?= $form->field($model, 'service')->dropDownList(ArrayHelper::map($sevice_type, 'id', 'service_name'), ['class' => 'form-control', 'prompt' => '--Select--']) ?>

                </div>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?php $designation = MasterDesignations::find()->where(['status' => '1'])->orderBy(['title' => SORT_ASC])->all(); ?>   <?= $form->field($model, 'staff_type')->dropDownList(ArrayHelper::map($designation, 'id', 'title'), ['prompt' => '--Select--', 'class' => 'form-control']) ?>
                        <?php $form->field($model, 'staff_type')->dropDownList(['1' => 'Registered Nurse', '2' => 'Care Assistant', '3' => 'Doctor'], ['prompt' => '--Select--']) ?>

                </div>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'duty_type')->dropDownList(['1' => 'Day', '2' => 'Night', '3' => 'Day & Night'], ['prompt' => '--Select--']) ?>

                </div>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd' id="day_staff">
                        <?php
                        if (!$model->isNewRecord) {
                                $staffs = StaffInfo::find()->where(['status' => 1, 'designation' => $model->staff_type, 'branch_id' => $model->branch_id])->all();
                        } else {
                                $staffs = [];
                        }
                        ?>
                        <?= $form->field($model, 'day_staff')->dropDownList(ArrayHelper::map($staffs, 'id', 'staff_name'), ['class' => 'form-control staff-change', 'prompt' => '--Select--']) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd' id="night_staff">
                        <?php
                        if (!$model->isNewRecord) {
                                $staffs = StaffInfo::find()->where(['status' => 1, 'designation' => $model->staff_type, 'branch_id' => $model->branch_id])->all();
                        } else {
                                $staffs = [];
                        }
                        ?>
                        <?= $form->field($model, 'night_staff')->dropDownList(ArrayHelper::map($staffs, 'id', 'staff_name'), ['class' => 'form-control staff-change', 'prompt' => '--Select--']) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?php
                        $staff_managers = StaffInfo::find()->where(['status' => 1, 'post_id' => 3])->orderBy(['staff_name' => SORT_ASC])->all();
                        ?>
                        <?= $form->field($model, 'staff_manager')->dropDownList(ArrayHelper::map($staff_managers, 'id', 'staff_name'), ['class' => 'form-control', 'prompt' => '--Select--']) ?>

                </div>



                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <div class="form-group field-service-to_date">
                                <label class="control-label" for="service-from_date">From Date</label>
                                <?php
                                if (!$model->isNewRecord) {
                                        $model->from_date = date('d-m-Y', strtotime($model->from_date));
                                } else {
                                        $model->from_date = date('d-m-Y');
                                }

                                echo DatePicker::widget([
                                    'name' => 'Service[from_date]',
                                    'id' => 'from_date',
                                    'type' => DatePicker::TYPE_INPUT,
                                    'value' => $model->from_date,
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'dd-mm-yyyy',
                                    ]
                                ]);
                                ?>
                        </div>

                </div>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <div class="form-group field-service-to_date">
                                <label class="control-label" for="service-to_date">To Date</label>
                                <?php
                                if (!$model->isNewRecord) {
                                        $model->to_date = date('d-m-Y', strtotime($model->to_date));
                                } else {
                                        $model->to_date = date('d-m-Y');
                                }

                                echo DatePicker::widget([
                                    'name' => 'Service[to_date]',
                                    'id' => 'to_date',
                                    'type' => DatePicker::TYPE_INPUT,
                                    'value' => $model->to_date,
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'dd-mm-yyyy',
                                    ]
                                ]);
                                ?>
                        </div>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'estimated_price_per_day')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'estimated_price')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'staff_advance_payment')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'patient_advance_payment')->textInput(['maxlength' => true]) ?>

                </div>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'status')->dropDownList(['1' => 'Opened', '2' => 'Cloed']) ?>

                </div>
        </div>
        <div class="row">

                <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>

        </div>

        <?php ActiveForm::end(); ?>

</div>
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>/js/select2/select2.css">
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>/js/select2/select2-bootstrap.css">
<script src="<?= Yii::$app->homeUrl; ?>/js/select2/select2.min.js"></script>
<script>
        $(document).ready(function () {

                $("#service-patient_id").select2({
                        placeholder: 'Choose Principals',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        // Adding Custom Scrollbar
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });
                $("#service-day_staff").select2({
                        placeholder: 'Choose Principals',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        // Adding Custom Scrollbar
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });
                $("#service-night_staff").select2({
                        placeholder: 'Choose Principals',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        // Adding Custom Scrollbar
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });



                $("#service-staff_type").select2({
                        placeholder: 'Choose Principals',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        // Adding Custom Scrollbar
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });

                $("#day_staff").hide();
                $("#night_staff").hide();

                var staff = $("#service-duty_type").val();
                if (staff == 1) {
                        $("#day_staff").show();
                        $("#night_staff").hide();
                } else if (staff == 2) {
                        $("#night_staff").show();
                        $("#day_staff").hide();
                } else if (staff == 3) {
                        $("#night_staff").show();
                        $("#day_staff").show();
                }
                $("#service-duty_type").change(function () {
                        if (this.value == 1) {
                                $("#day_staff").show();
                                $("#night_staff").hide();
                        } else if (this.value == 2) {
                                $("#night_staff").show();
                                $("#day_staff").hide();
                        } else if (this.value == 3) {
                                $("#night_staff").show();
                                $("#day_staff").show();
                        }

                });
                $("#service-estimated_price_per_day").change(function () {
                        var days = NoOfDays();
                        EstimatedPrice(days);
                });
                $("#from_date").change(function () {
                        var days = NoOfDays();
                        EstimatedPrice(days);
                });
                $("#to_date").change(function () {
                        var days = NoOfDays();
                        EstimatedPrice(days);
                });
                /*
                 * Purpose   :- On change of staff type dropdown
                 * parameter :- staff_type
                 * return   :- The list of staff depends on the staff_type
                 */

                $('#service-staff_type').change(function () {
                        var staff_type = $(this).val();
                        var branch = $('#service-branch_id').val();
                        showLoader();
                        $.ajax({
                                type: 'POST',
                                cache: false,
                                data: {staff_type: staff_type, branch: branch},
                                url: homeUrl + 'ajax/staffs',
                                success: function (data) {
                                        $(".staff-change").html(data);
                                        $("#service-day_staff").select2({
                                                placeholder: 'Choose Principals',
                                                allowClear: true
                                        }).on('select2-open', function ()
                                        {
                                                // Adding Custom Scrollbar
                                                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                                        });
                                        $("#service-night_staff").select2({
                                                placeholder: 'Choose Principals',
                                                allowClear: true
                                        }).on('select2-open', function ()
                                        {
                                                // Adding Custom Scrollbar
                                                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                                        });
                                        hideLoader();
                                }
                        });
                });

                $('#service-branch_id').change(function () {
                        showLoader();

                        $.ajax({
                                type: 'POST',
                                cache: false,
                                data: {branch: $(this).val()},
                                url: homeUrl + 'ajax/patients',
                                success: function (data) {
                                        $("#service-patient_id").html(data);
                                        hideLoader();
                                }
                        });
                });


        });
        function NoOfDays() {
                var date1 = $("#from_date").val();
                var date2 = $("#to_date").val();
// First we split the values to arrays date1[0] is the day, [1] the month and [2] the year
                date1 = date1.split('-');
                date2 = date2.split('-');
// Now we convert the array to a Date object, which has several helpful methods
                date1 = new Date(date1[2], date1[1], date1[0]);
                date2 = new Date(date2[2], date2[1], date2[0]);
// We use the getTime() method and get the unixtime (in milliseconds, but we want seconds, therefore we divide it through 1000)
                date1_unixtime = parseInt(date1.getTime() / 1000);
                date2_unixtime = parseInt(date2.getTime() / 1000);
// This is the calculated difference in seconds
                var timeDifference = date2_unixtime - date1_unixtime;

// in Hours
                var timeDifferenceInHours = timeDifference / 60 / 60;// and finaly, in days :)

                var timeDifferenceInDays = timeDifferenceInHours / 24;

                return timeDifferenceInDays;

        }
        function EstimatedPrice(days) {
                if (days == 0) {
                        $('#service-estimated_price').val($("#service-estimated_price_per_day").val());
                } else {
                        var value = days * $("#service-estimated_price_per_day").val();
                        $('#service-estimated_price').val(value);
                }


        }
</script>
