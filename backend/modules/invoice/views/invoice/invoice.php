<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Branch;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\ServiceScheduleHistory;
use common\models\ServiceSchedule;
use common\models\ServiceDiscounts;
use common\models\SalesInvoiceMaster;

/* @var $this yii\web\View */
/* @var $searchModel common\models\InvoiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Invoice';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">

                                        <?php $form = ActiveForm::begin(); ?>
                                        <div class="invoice-form form-inline">
                                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                        <?php $branch = Branch::Branch();
                                                        ?>
                                                        <?= $form->field($model, 'branch_id')->dropDownList(ArrayHelper::map($branch, 'id', 'branch_name'), ['prompt' => '--Select--', 'id' => 'report-patient-branch']); ?>
                                                </div>

                                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                        <?php
                                                        if (isset($model->branch_id)) {
                                                                $patients = \common\models\PatientGeneral::find()->where(['branch_id' => $model->branch_id, 'status' => 1])->orderBy(['first_name' => SORT_ASC])->all();
                                                        } else {
                                                                $patients = [];
                                                        }
                                                        ?>
                                                        <?= $form->field($model, 'patient_id')->dropDownList(ArrayHelper::map($patients, 'id', 'first_name'), ['prompt' => '--Select--', 'id' => 'report-patient']) ?>
                                                </div>

                                                <div class='col-md-3 col-sm-6 col-xs-12' >
                                                        <div class="form-group" >
                                                                <?= Html::submitButton($model->isNewRecord ? 'Submit' : 'Search', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                                                        </div>
                                                </div>
                                        </div>
                                        <?php ActiveForm::end(); ?>



                                        <div style="clear:both"></div>



                                        <?php if (!empty($services) && $services != '') { ?>

                                                <div class="row">
                                                        <?php $patient = \common\models\PatientGeneral::findOne($model->patient_id); ?>
                                                        <p class="patient">PATIENT NAME : <?= $patient->first_name; ?></p>
                                                </div>

                                                <?php $form1 = ActiveForm::begin(['action' => ['payment']]); ?>
                                                <div class="row table-responsive" style="border:none">
                                                        <div class="col-md-12">



                                                                <table class="table table-bordered table-striped">
                                                                        <thead>
                                                                                <tr class="heading">
                                                                                        <td style="width:10px;">#</td>
                                                                                        <td colspan="2">Service</td>
                                                                                        <td style="width:10%">Total Amount</td>
                                                                                        <td style="width:10%">Amount Paid</td>
                                                                                        <td style="width:10%">Due Amount</td>
                                                                                        <td style="width:10%">Amount Pay</td>
                                                                                </tr>
                                                                        </thead>
                                                                        <?php
                                                                        $n = 0;

                                                                        foreach ($services as $value) {
                                                                                $n++;
                                                                                $service_name = common\models\MasterServiceTypes::findOne($value->service);
                                                                                $added_schedules = ServiceScheduleHistory::find()->where(['service_id' => $value->id])->all();


                                                                                $added_schedules_count = 0;
                                                                                $added_schedules_amount = 0;
                                                                                foreach ($added_schedules as $added_schedules) {
                                                                                        $added_schedules_count++;
                                                                                        $added_schedules_amount += $added_schedules->price;
                                                                                }

                                                                                $materials_used_amount = 0;
                                                                                $materials_used = SalesInvoiceMaster::find()->where(['busines_partner_code' => $value->id])->all();
                                                                                foreach ($materials_used as $materials_used) {
                                                                                        $materials_used_amount += $materials_used->due_amount;
                                                                                }

                                                                                $discount_amount = 0;
                                                                                $dicounts = ServiceDiscounts::find()->where(['service_id' => $value->id])->all();
                                                                                foreach ($dicounts as $dicounts) {
                                                                                        $discount_amount += $dicounts->discount_value;
                                                                                }

                                                                                $count = 1;
                                                                                if ($added_schedules_count > 0) {
                                                                                        $count += 1;
                                                                                }if ($materials_used_amount > 0) {
                                                                                        $count += 1;
                                                                                }if ($discount_amount > 0) {
                                                                                        $count += 1;
                                                                                }
                                                                                $total_amount = $value->estimated_price + $added_schedules_amount + $materials_used_amount + $discount_amount;
                                                                                $amount_paid = common\models\Invoice::find()->where(['service_id' => $value->id])->sum('amount');
                                                                                if (empty($amount_paid))
                                                                                        $amount_paid = 0;
                                                                                $due_amount = $total_amount - $amount_paid;
                                                                                ?>

                                                                                <tr>
                                                                                        <td colspan="7"><h5 class="service_name" ><?= $value->service_id; ?></h5> <?= $service_name->service_name ?> service</td>

                                                                                </tr>



                                                                                <!-----------------------------------Service details--------------------------------------------->
                                                                                <tr>
                                                                                        <td rowspan="<?= $count ?>"><?= $n; ?></td>
                                                                                        <td><b>SERVICE FEE</b></td>
                                                                                        <td><b><?= 'Rs. ' . $value->estimated_price; ?></b></td>
                                                                                        <td rowspan="<?= $count ?>"><?= 'Rs ' . $total_amount . ' /-' ?></td>
                                                                                        <td rowspan="<?= $count ?>"><?= 'Rs ' . $amount_paid . ' /-' ?></td>
                                                                                        <td rowspan="<?= $count ?>"><?= 'Rs ' . $due_amount . ' /-' ?></td>
                                                                                        <td rowspan="<?= $count ?>"><input type="text" name="amount_paid_<?= $value->id ?>" id="amount_paid" class="amount_paid" placeholder="    ENTER AMOUNT"></td>
                                                                                </tr>



                                                                                <!-----------------------------------more schedules------------------------------------->
                                                                                <?php
                                                                                if ($added_schedules_count > 0 && $added_schedules_amount > 0) {
                                                                                        $count = '';
                                                                                        if (isset($value->frequency)) {
                                                                                                if ($value->frequency == 1) {
                                                                                                        $count = 'DAYS';
                                                                                                } else if ($value->frequency == 2) {
                                                                                                        $count = 'WEEKS';
                                                                                                } else if ($value->frequency == 3) {
                                                                                                        $count = 'MONTHS';
                                                                                                }
                                                                                        }
                                                                                        ?>
                                                                                        <tr >
                                                                                                <td class="sub">ADDED <?= $added_schedules_count . ' ' . $count ?> <span style="color:red">( Extra Schedules )</span></td>
                                                                                                <td><?= 'Rs. ' . $added_schedules_amount ?> </td>
                                                                                        </tr>
                                                                                <?php } ?>


                                                                                <!------------------------------Materials used------------------------------------->

                                                                                <?php
                                                                                if ($materials_used_amount > 0) {
                                                                                        ?>
                                                                                        <tr >
                                                                                                <td class="sub">MATERIALS USED</td>
                                                                                                <td><?= 'Rs. ' . $materials_used_amount ?></td>
                                                                                        </tr>
                                                                                <?php } ?>




                                                                                <!----------------------------Discounts------------------------------------------>

                                                                                <?php
                                                                                if ($discount_amount > 0) {
                                                                                        ?>
                                                                                        <tr>
                                                                                                <td class="sub">DISCOUNTS</td>
                                                                                                <td><?= 'Rs ' . $discount_amount; ?></td>
                                                                                        </tr>
                                                                                <?php } ?>


                                                                        <?php } ?>
                                                                </table>

                                                                <div class="row submit_btn">
                                                                        <input type="hidden" name="patient" value="<?= $model->patient_id; ?>">
                                                                        <?= Html::submitButton('Pay', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;margin-right: 15px;']) ?>

                                                                </div>


                                                        </div>
                                                </div>
                                                <?php ActiveForm::end(); ?>
                                                <?php
                                        } else {
                                                if (isset($model->patient_id) && $model->patient_id != '') {
                                                        echo '<p class="no-result">No results found !!</p>';
                                                }
                                        }
                                        ?>



                                </div>
                        </div>
                </div>
        </div>
</div>




<style>
        table{
                margin-top:10px;
        }
        table .heading{
                font-weight: bold;
        }
        .service_name{
                font-weight: bold;
                color: #008cbd;
                text-align: left;
                text-transform: uppercase;
        }.amount_paid{
                border: 1px solid #e4e4e4;
                height: 25px;
        }
        ::-webkit-input-placeholder { /* Chrome/Opera/Safari */
                color: #e4e4e4;
        }
        ::-moz-placeholder { /* Firefox 19+ */
                color: #e4e4e4;
        }
        :-ms-input-placeholder { /* IE 10+ */
                color: #e4e4e4;
        }
        :-moz-placeholder { /* Firefox 18- */
                color: #e4e4e4;
        }.no-result{
                text-align: center;
                font-style: italic;
        }.sub{
                font-size: 10px !important;
        }.patient{
                margin-bottom: 5px;
                color:#000;
                text-transform: uppercase;
                margin-left: 15px;
                font-weight: bold;
        }.submit_btn{
                float: right;
        }

</style>