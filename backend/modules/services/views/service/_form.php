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
use yii\db\Expression;

/* @var $this yii\web\View */
/* @var $model common\models\Service */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-form form-inline">

        <?php
        if ($model->isNewRecord) {
                $form = ActiveForm::begin();
                ?>

                <div class="row">

                        <?php
                        $branches = Branch::Branch();
                        ?>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($model, 'branch_id')->dropDownList(ArrayHelper::map($branches, 'id', 'branch_name'), ['prompt' => '--Select--']) ?>
                        </div>
                        <?php ?>

                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?php
                                if (!$model->isNewRecord) {
                                        $patient = PatientGeneral::find()->where(['status' => 1, 'branch_id' => $model->branch_id])->orderBy(['first_name' => SORT_ASC])->all();
                                } else {
                                        $patient = [];
                                }
                                ?>
                                <?= $form->field($model, 'patient_id')->dropDownList(ArrayHelper::map($patient, 'id', 'first_name'), ['class' => 'form-control', 'prompt' => '--Select--']) ?>
                        </div>



                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?php
                                $sevice_type = MasterServiceTypes::find()->where(['status' => 1])->all();
                                ?>
                                <?= $form->field($model, 'service')->dropDownList(ArrayHelper::map($sevice_type, 'id', 'service_name'), ['class' => 'form-control', 'prompt' => '--Select--']) ?>

                        </div>

                        <?php
                        if (!$model->isNewRecord) {
                                $sub_services = common\models\SubServices::find()->where(['service' => $model->service])->all();
                        } else {
                                $sub_services = [];
                        }
                        ?>
                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'sub_service')->dropDownList(ArrayHelper::map($sub_services, 'id', 'sub_service')) ?>

                        </div>

                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($model, 'gender_preference')->dropDownList(['2' => 'Any', '0' => 'Male Staff', '1' => 'Female Staff']) ?>
                        </div>


                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?php
                                if (!$model->isNewRecord) {
                                        if (isset($model->sub_service) && $model->sub_service != '' && $model->sub_service != 0) {

                                                $rates = \common\models\RateCard::find()->where(['service_id' => $model->service, 'branch_id' => $model->branch_id, 'status' => 1, 'sub_service' => $model->sub_service])->one();
                                        } else {
                                                $rates = \common\models\RateCard::find()->where(['service_id' => $model->service, 'branch_id' => $model->branch_id, 'status' => 1, 'sub_service' => 0])->one();
                                        }
                                        $data = Yii::$app->SetValues->Dutytype($rates);
                                } else {
                                        $data = [];
                                }
                                ?>

                                <?= $form->field($model, 'duty_type')->dropDownList($data) ?>
                                <span class="rate-card-error" style="color:red;position: absolute;top: 80px;display:none">Please add rate card ! <a class="add-rate-card" style="color:#0e62c7;cursor: pointer;text-decoration: underline">Add New</a></span>
                                <span class="rate-card-update-error" style="color:red;position: absolute;top: 75px;display:none">Please update rate card rates! <a class="update-rate-card" style="color:#0e62c7;cursor: pointer;text-decoration: underline">Update Now</a></span>
                        </div>

                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd' id="day_night_staff">
                                <?= $form->field($model, 'day_night_staff')->radioList(array('1' => 'Same Staff', 2 => 'Different Staff')); ?>

                        </div>

                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd service-frequency'>
                                <?= $form->field($model, 'frequency')->dropDownList(['' => '-Select--', '1' => 'Daily', '2' => 'Weekly', '3' => 'Monthly']) ?>
                        </div>

                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd service-hours'>
                                <?= $form->field($model, 'hours')->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd service-days'>
                                <?= $form->field($model, 'days')->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>

                                <?php
                                if (!$model->isNewRecord) {
                                        $model->from_date = date('d-m-Y', strtotime($model->from_date));
                                } else {
                                        $model->from_date = '';
                                }
                                echo DatePicker::widget([
                                    'model' => $model,
                                    'form' => $form,
                                    'type' => DatePicker::TYPE_INPUT,
                                    'attribute' => 'from_date',
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'dd-mm-yyyy',
                                    ]
                                ]);
                                ?>

                                <span class="rate-card-error" style="height: 15px; color:white;display:none">Error! <a  style="color:#fff;cursor: pointer;text-decoration: underline"></a></span>

                        </div>



                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?php
                                if (!$model->isNewRecord) {
                                        $model->to_date = date('d-m-Y', strtotime($model->to_date));
                                } else {
                                        $model->to_date = '';
                                }
                                ?>

                                <?= $form->field($model, 'to_date')->textInput(['maxlength' => true, 'readonly' => true]) ?>

                                <span class="rate-card-error" style="color:white;display:none">Error ! <a style="color:#fff;cursor: pointer;text-decoration: underline"></a></span>

                        </div>




                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?php
                                $staff_managers = StaffInfo::find()->where(['status' => 1, 'post_id' => 6, 'branch_id' => $model->branch_id])->orderBy(['staff_name' => SORT_ASC])->all();
                                ?>
                                <?= $form->field($model, 'staff_manager')->dropDownList(ArrayHelper::map($staff_managers, 'id', 'staff_name'), ['class' => 'form-control', 'prompt' => '--Select--']) ?>
                        </div>



                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($model, 'estimated_price')->textInput(['maxlength' => true]) ?>

                        </div>


                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                <?= $form->field($model, 'status')->dropDownList(['1' => 'Opened', '2' => 'Closed']) ?>

                        </div>
                </div>
                <?php if ($model->isNewRecord) { ?>
                        <div class="row">
                                <div class="form-group">
                                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px; ']) ?>
                                </div>

                        </div>
                <?php } ?>

                <?php
                ActiveForm::end();
        } else {
                $k = 0;
                ?>
                <div id="service-detail-view">
                        <div class="row serv_head">
                                <h4>Service Details</h4>
                        </div>
                        <table class="table table-bordered table-striped">
                                <tr>
                                        <td class="labell">Patient </td><td class="value"> <?= $model->patient->first_name ?></td>
                                        <?php
                                        $k++;
                                        tradjust($k);
                                        ?>


                                        <td class="labell">Service</td><td class="value"><?= $model->service0->service_name ?></td>
                                        <?php
                                        $k++;
                                        tradjust($k);
                                        ?>


                                        <?php if (isset($model->sub_service) && $model->sub_service != 0) { ?>
                                                <td class = "labell">Sub Service </td><td class = "value"><?= $model->subservice->sub_service ?> </td>
                                                <?php
                                                $k++;
                                                tradjust($k);
                                        }
                                        ?>

                                        <?php if (isset($model->gender_preference) && $model->gender_preference != '') { ?>
                                                <td class = "labell">Staff Preference </td><td class = "value"><?php
                                                        if ($model->gender_preference == 0) {
                                                                echo 'Male Staff';
                                                        } else if ($model->gender_preference == 1) {
                                                                echo 'Female Staff';
                                                        } else {
                                                                echo 'Any';
                                                        }
                                                        ?> </td>

                                                <?php
                                                $k++;
                                                tradjust($k);
                                        }
                                        ?>

                                        <?php if (isset($model->duty_type) && $model->duty_type != '') { ?>
                                                <td class = "labell">Duty Type </td><td class = "value"><?php
                                                        if ($model->duty_type == 1) {
                                                                echo 'Hourly';
                                                        } else if ($model->duty_type == 2) {
                                                                echo 'Visit';
                                                        } else if ($model->duty_type == 3) {
                                                                echo 'Day';
                                                        } else if ($model->duty_type == 4) {
                                                                echo 'Night';
                                                        } else if ($model->duty_type == 5) {
                                                                echo 'Day & Night';
                                                        }
                                                        ?> </td>
                                                <?php
                                                $k++;
                                                tradjust($k);
                                        }
                                        ?>

                                        <?php if (isset($model->day_night_staff) && $model->day_night_staff != '') { ?>
                                                <td class = "labell">Staff for day & night </td><td class = "value"><?php
                                                        if ($model->day_night_staff == 1) {
                                                                echo 'Same Staff';
                                                        } else if ($model->day_night_staff == 1) {
                                                                echo 'Different Staff';
                                                        }
                                                        ?> </td>

                                                <?php
                                                $k++;
                                                tradjust($k);
                                        }
                                        ?>

                                        <?php if (isset($model->frequency) && $model->frequency != '') { ?>
                                                <td class = "labell">Frequency </td><td class = "value"><?php
                                                        if ($model->frequency == 1) {
                                                                echo 'Daily';
                                                        } else if ($model->frequency == 2) {
                                                                echo 'Weekly';
                                                        } else if ($model->frequency == 3) {
                                                                echo 'Monthly';
                                                        }
                                                        ?> </td>

                                                <?php
                                                $k++;
                                                tradjust($k);
                                        }
                                        ?>



                                        <?php if (isset($model->hours) && $model->hours != '') { ?>
                                                <td class = "labell">Hours </td><td class = "value"><?= $model->hours ?> </td>
                                                <?php
                                                $k++;
                                                tradjust($k);
                                        }
                                        ?>


                                        <?php if (isset($model->days) && $model->days != '') { ?>
                                                <td class = "labell">Days </td><td class = "value"><?= $model->days ?> </td>
                                                <?php
                                                $k++;
                                                tradjust($k);
                                        }
                                        ?>


                                        <?php if (isset($model->from_date) && $model->from_date != '') { ?>
                                                <td class = "labell">Period From </td><td class = "value"><?= date('d-m-Y', strtotime($model->from_date)) ?> </td>
                                                <?php
                                                $k++;
                                                tradjust($k);
                                        }
                                        ?>


                                        <?php if (isset($model->to_date) && $model->to_date != '') { ?>
                                                <td class = "labell">Period To </td><td class = "value"><?= date('d-m-Y', strtotime($model->to_date)) ?> </td>
                                                <?php
                                                $k++;
                                                tradjust($k);
                                        }
                                        ?>


                                        <?php if (isset($model->staff_manager) && $model->staff_manager != '') { ?>
                                                <td class = "labell">Staff Manager</td><td class = "value"><?= date('d-m-Y', strtotime($model->staffManager->staff_name)) ?> </td>
                                                <?php
                                                $k++;
                                                tradjust($k);
                                        }
                                        ?>

                                        <?php if (isset($model->estimated_price) && $model->estimated_price != '') { ?>
                                                <td class = "labell">Estimated Price</td><td class = "value"><?= $model->estimated_price ?> </td>
                                                <?php
                                                $k++;
                                                tradjust($k);
                                        }
                                        ?>


                                </tr>
                        </table>
                </div>

        <?php } ?>

</div>

<?php

function tradjust($k) {
        if ($k % 3 == 0) {
                echo '</tr><tr>';
        }
        return;
}
?>

<style>

        #service-detail-view table tr{
                height: 50px !important;
        }#service-detail-view table tr td{
                border: none !important;
        }#service-detail-view table{
                border: none !important;
        }.value{
                font-weight: bold;
        }td.labell {
                font-style: italic;
        } .serv_head{
                height: 35px;
                background: #b4bec6 !important;
                color: #b60d14;
                padding: 0px 0px 0px 14px;
                margin-bottom: 15px;
        }

</style>