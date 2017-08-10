<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Branch;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\InvoiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Invoices';
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
                                        <div class="row table-responsive" style="border:none">
                                                <div class="col-md-12">



                                                        <table class="table table-bordered table-striped">
                                                                <thead>
                                                                        <tr class="heading">
                                                                                <td style="width:10px;">#</td>
                                                                                <td colspan="2">SERVICE</td>
                                                                                <td style="width:10%">TOTAL</td>
                                                                                <td style="width:10%">AMOUNT PAID</td>
                                                                        </tr>
                                                                </thead>

                                                                <tr>
                                                                        <td colspan="5"><h5 class="service_name" >CPCSR-OTR-090817-1008</h5></td>

                                                                </tr>

                                                                <tr>
                                                                        <td rowspan="4">1</td>
                                                                        <td>SERVICE FEE</td>
                                                                        <td>Rs.20000</td>
                                                                        <td rowspan="4">Rs.30000/-</td>
                                                                        <td rowspan="4"><input type="text" name="amount_paid" id="amount_paid" class="amount_paid" placeholder="    ENTER AMOUNT"></td>
                                                                </tr>

                                                                <tr>
                                                                        <td>EXTRA 2 SCHEDULES</td>
                                                                        <td>Rs.1000/-</td>
                                                                </tr>
                                                                <tr>
                                                                        <td>MATERIALS</td>
                                                                        <td>Rs.1000/-</td>
                                                                </tr>

                                                                <tr>
                                                                        <td>DISCOUNTS</td>
                                                                        <td>Rs.1000/-</td>
                                                                </tr>

                                                                <tr>
                                                                        <td colspan="5"><h5 class="service_name" >CPCSR-OTR-090817-1008</h5></td>

                                                                </tr>

                                                                <tr>
                                                                        <td rowspan="4">1</td>
                                                                        <td>SERVICE FEE</td>
                                                                        <td>Rs.20000</td>
                                                                        <td rowspan="4">Rs.30000/-</td>
                                                                        <td rowspan="4"></td>
                                                                </tr>

                                                                <tr>
                                                                        <td>EXTRA 2 SCHEDULES</td>
                                                                        <td>Rs.1000/-</td>
                                                                </tr>
                                                                <tr>
                                                                        <td>MATERIALS</td>
                                                                        <td>Rs.1000/-</td>
                                                                </tr>

                                                                <tr>
                                                                        <td>DISCOUNTS</td>
                                                                        <td>Rs.1000/-</td>
                                                                </tr>
                                                        </table>


                                                </div>
                                        </div>



                                </div>
                        </div>
                </div>
        </div>
</div>




<style>
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
        }

</style>