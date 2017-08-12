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
                                        <div id="print">

                                                <style>
                                                        .print{
                                                                text-align: center;
                                                                margin-top: 18px;
                                                        }
                                                        .main-tabl{
                                                                margin: auto;
                                                        }.company_address{
                                                                text-align:center;
                                                                font-size: 10px;
                                                                font-weight: normal;
                                                        }.bill{
                                                                text-align: center;
                                                                font-size: 17px;
                                                        } .bill span{
                                                                background: #e4e4e4;
                                                                padding: 12px 80px 11px 80px;
                                                                border-radius: 5px;
                                                        }

                                                        @media screen {
                                                                .second{
                                                                        width: 50%;
                                                                }                                                        }
                                                        </style>

                                                        <table border ="0"  class="main-tabl" border="0" >
                                                        <thead>
                                                                <tr>
                                                                        <th style="width:100%">
                                                                                <div class="header">
                                                                                        <div class="main-left">
                                                                                                <div>
                                                                                                        <img src="<?= Yii::$app->homeUrl ?>images/logos/logo-1.png" height="100"/>
                                                                                                </div>
                                                                                                <div style="">
                                                                                                        <table style="width:100%">
                                                                                                                <tr><td  class="company_address">Door No.5, DD Vyapar Bhavan, K.P Vallon Road, Kavandthra Jn</td></tr>
                                                                                                                <tr><td class="company_address">Kochi-20 | Tel:0484 4033505</td></tr>
                                                                                                                <tr><td class="company_address">www.caringpeople.in , Email :info@caringpeople.in , Helpline No: 90 20 599 599</td></tr>
                                                                                                        </table>
                                                                                                </div>
                                                                                        </div>

                                                                                        <br/>
                                                                                </div>

                                                                        </th>
                                                                </tr>

                                                                <tr>
                                                                        <td class="bill">
                                                                                <div>
                                                                                        <span>BILL</span>
                                                                                </div>
                                                                        </td>
                                                                </tr>

                                                        </thead>
                                                </table>


                                                <table class="table table-bordered table-striped main-tabl second" style="margin-top: 50px;">
                                                        <tr>
                                                                <td colspan="2"> To,</td>
                                                                <td>Bill No</td>
                                                                <td>CPC 109/17-18</td>
                                                        </tr>

                                                        <tr>
                                                                <td>Patient Name</td>
                                                                <td>P N AjayKumar</td>
                                                                <td>Date</td>
                                                                <td>21/07/2017</td>
                                                        </tr>

                                                        <tr>
                                                                <td>Patient ID</td>
                                                                <td>231</td>
                                                                <td>Ref No</td>
                                                                <td></td>
                                                        </tr>

                                                </table>


                                                <table class="table table-bordered table-striped main-tabl second" style="margin-top: 50px;">

                                                </table>


                                                <script>
                                                        function printContent(el) {
                                                                var restorepage = document.body.innerHTML;
                                                                var printcontent = document.getElementById(el).innerHTML;
                                                                document.body.innerHTML = printcontent;
                                                                window.print();
                                                                document.body.innerHTML = restorepage;
                                                        }
                                                </script>

                                                <!--</html>-->

                                        </div>

                                        <div class="print">
                                                <button onclick="printContent('print')" style="font-weight: bold !important;" class="btn btn-success">Print</button>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>




