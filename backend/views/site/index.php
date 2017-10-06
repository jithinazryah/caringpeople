<?php

use yii\helpers\Html;
?>
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/fonts/meteocons/css/meteocons.css">

<script src="<?= Yii::$app->homeUrl; ?>js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= Yii::$app->homeUrl; ?>js/jvectormap/regions/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?= Yii::$app->homeUrl; ?>js/xenon-widgets.js"></script>


<?php
$sales_masters = \common\models\SalesInvoiceMaster::find()->where(['status' => 1])->orderBy(['id' => SORT_DESC])->limit(5)->all();
$purchase_masters = \common\models\PurchaseInvoiceMaster::find()->where(['status' => 1])->orderBy(['id' => SORT_DESC])->limit(5)->all();
$sale_max = \common\models\SalesInvoiceMaster::find()->orderBy(['sales_invoice_date' => SORT_DESC])->one();
if (!empty($sale_max)) {
        $sale_date = date("Y-m-d", strtotime($sale_max->sales_invoice_date));
        $sale_amounts = (new \yii\db\Query())
                ->select(['SUM(CASE WHEN status = 1 THEN order_amount ELSE 0 END) as sale_order_amount,SUM(CASE WHEN status = 1 THEN amount_payed ELSE 0 END) as sale_amount_payed,SUM(CASE WHEN status = 1 THEN due_amount ELSE 0 END) as sale_due_amount'])
                ->from('sales_invoice_master')
                ->where(['date(sales_invoice_date)' => $sale_date])
                ->all();
} else {
        $sale_amounts[0] = array('sale_order_amount' => 0, 'sale_amount_payed' => 0, 'sale_due_amount' => 0);
        $sale_date = date("Y-m-d");
}
$purchase_max = \common\models\PurchaseInvoiceMaster::find()->orderBy(['sales_invoice_date' => SORT_DESC])->one();
if (!empty($purchase_max)) {
        $purchase_date = date("Y-m-d", strtotime($purchase_max->sales_invoice_date));
        $purchase_amounts = (new \yii\db\Query())
                ->select(['SUM(CASE WHEN status = 1 THEN order_amount ELSE 0 END) as purchase_order_amount,SUM(CASE WHEN status = 1 THEN amount_payed ELSE 0 END) as purchase_amount_payed,SUM(CASE WHEN status = 1 THEN due_amount ELSE 0 END) as purchase_due_amount'])
                ->from('purchase_invoice_master')
                ->where(['date(sales_invoice_date)' => $purchase_date])
                ->all();
} else {
        $purchase_amounts[0] = array('purchase_order_amount' => 0, 'purchase_amount_payed' => 0, 'purchase_due_amount' => 0);
        $purchase_date = date("Y-m-d");
}
$invoices = \common\models\Invoice::find()->where(['DOC' => date('Y-m-d'), 'status' => 1])->sum('amount');
$invoice_date = date('d-m-Y');
if (empty($invoices)) {
        $date_range_from = date('Y-m-01');
        $date_range_to = date('Y-m-31');
        $invoices = \common\models\Invoice::find()->where(['status' => 1])->andWhere(['>=', 'DOC', $date_range_from])->andWhere(['<=', 'DOC', $date_range_to])->sum('amount');
        $invoice_date = 'On ' . date("F");
}

$staff_payroll_paid = common\models\StaffPayroll::find()->where(['payment_date' => date('Y-m-d')])->sum('amount');
if (empty($staff_payroll_paid)) {
        $date_range_from = date('Y-m-01');
        $date_range_to = date('Y-m-31');
        $invoices = \common\models\StaffPayroll::find()->where(['>=', 'payment_date', $date_range_from])->andWhere(['<=', 'payment_date', $date_range_to])->sum('amount');
        $invoice_date = 'On ' . date("F");
}
?>


<div class="row">

        <div class="col-sm-3">

                <div class="xe-widget xe-counter" >
                        <div class="xe-icon">
                                <i class="fa fa-medkit"></i>
                        </div>
                        <div class="xe-label">
                                <strong class="num"><?= $patients ?></strong>
                                <span>Patients</span>
                        </div>
                </div>

        </div>

        <div class="col-sm-3">

                <div class="xe-widget xe-counter xe-counter-blue" >
                        <div class="xe-icon">
                                <i class="linecons-user"></i>
                        </div>
                        <div class="xe-label">
                                <strong class="num"><?= $staffs ?></strong>
                                <span>Staffs Total</span>
                        </div>
                </div>

        </div>

        <div class="col-sm-3">

                <div class="xe-widget xe-counter xe-counter-info" data-count=".num" data-from="0" data-to="<?= $services ?>" data-duration="4" data-easing="true">
                        <div class="xe-icon">
                                <i class="fa fa-shield"></i>
                        </div>
                        <div class="xe-label">
                                <strong class="num">0</strong>
                                <span>Live Services</span>
                        </div>
                </div>

        </div>

        <div class="col-sm-3">
                <a href="<?= Yii::$app->homeUrl ?>services/service/index">
                        <div class="xe-widget xe-counter xe-counter-red"  >
                                <div class="xe-icon">
                                        <i class="linecons-lightbulb"></i>
                                </div>
                                <div class="xe-label">
                                        <strong class="num"></strong>
                                        <span>Today Schedules</span>
                                </div>
                        </div>
                </a>

        </div>

        <div class="col-sm-3">

                <div class="xe-widget xe-counter-block">
                        <div class="xe-upper">

                                <div class="xe-icon">
                                        <i class="fa fa-shopping-cart"></i>
                                </div>
                                <div class="xe-label">
                                        <strong class="num"><?= sprintf('%0.2f', $sale_amounts['sale_order_amount']) ?></strong>
                                        <span>Total Materials Amount</span>
                                </div>

                        </div>
                        <div class="xe-lower">
                                <div class="border"></div>

                                <span></span>
                                <strong><?= date("d-M-Y", strtotime($sale_date)) ?></strong>
                        </div>
                </div>

        </div>

        <div class="col-sm-3">

                <div class="xe-widget xe-counter-block xe-counter-block-purple">
                        <div class="xe-upper">

                                <div class="xe-icon">
                                        <i class="fa fa-briefcase"></i>
                                </div>
                                <div class="xe-label">
                                        <strong class="num"><?= sprintf('%0.2f', $purchase_amounts['purchase_order_amount']) ?></strong>
                                        <span>Total Purchase Amount</span>
                                </div>

                        </div>
                        <div class="xe-lower">
                                <div class="border"></div>
                                <strong><?= date("d-M-Y", strtotime($purchase_date)) ?></strong>
                        </div>
                </div>

        </div>

        <div class="col-sm-3">

                <div class="xe-widget xe-counter-block xe-counter-block-blue"  >
                        <div class="xe-upper">

                                <div class="xe-icon">
                                        <i class="fa fa-money"></i>
                                </div>
                                <div class="xe-label">
                                        <strong class="num"><?= $invoices ?></strong>
                                        <span>Total Invoice Amount</span>
                                </div>

                        </div>
                        <div class="xe-lower">
                                <div class="border"></div>

                                <span></span>
                                <strong><?= $invoice_date ?></strong>
                        </div>
                </div>

        </div>

        <div class="col-sm-3">
                <a href="<?= Yii::$app->homeUrl ?>services/service/index">
                        <div class="xe-widget xe-counter-block xe-counter-block-orange">
                                <div class="xe-upper">

                                        <div class="xe-icon">
                                                <i class="fa-life-ring"></i>
                                        </div>
                                        <div class="xe-label">
                                                <strong class="num"><?= sprintf('%0.2f', $staff_payroll_paid) ?></strong>
                                                <span> Staff Paid Salary</span>
                                        </div>

                                </div>
                                <div class="xe-lower">
                                        <div class="border"></div>

                                        <span></span>
                                        <a href="<?= Yii::$app->homeUrl ?>services/service/index"><strong>View</strong></a>
                                </div>
                        </div>
                </a>

        </div>



        <div class="col-sm-6">



                <!-- Tweets -->
                <div class="xe-widget xe-status-update" data-auto-switch="5">
                        <div class="xe-header">
                                <div class="xe-icon">
                                        <i class="fa fa-tasks"></i>
                                </div>
                                <div class="xe-nav">
                                        <a href="#" class="xe-prev">
                                                <i class="fa-angle-left"></i>
                                        </a>
                                        <a href="#" class="xe-next">
                                                <i class="fa-angle-right"></i>
                                        </a>
                                </div>
                        </div>
                        <div class="xe-body">

                                <ul class="list-unstyled">


                                        <?php
                                        $e = 0;
                                        if (!empty($tasks)) {
                                                foreach ($tasks as $value) {
                                                        $e++;
                                                        ?>
                                                        <li class="<?= $e == 1 ? 'active' : '' ?>">
                                                                <span class="status-date"><?= date('d F Y H:i:s', strtotime($value->followup_date)) ?></span>
                                                                <p><?= substr($value->followup_notes, 0, 100); ?></p>
                                                        </li>
                                                        <?php
                                                }
                                        } else {
                                                echo '<li>No tasks Assigned</li>';
                                        }
                                        ?>
                                </ul>

                        </div>
                        <div class="xe-footer">
                                <a href="<?= Yii::$app->homeUrl ?>followup/followups/index">
                                        <i class="fa-retweet"></i>
                                        My Tasks
                                </a>
                        </div>
                </div>

        </div>



        <div class="col-sm-6">

                <div class="xe-widget xe-status-update xe-status-update-google-plus" data-auto-switch="0">
                        <div class="xe-header">
                                <div class="xe-icon">
                                        <i class="fa-google-plus"></i>
                                </div>
                                <div class="xe-nav">
                                        <a href="#" class="xe-prev">
                                                <i class="fa-angle-left"></i>
                                        </a>
                                        <a href="#" class="xe-next">
                                                <i class="fa-angle-right"></i>
                                        </a>
                                </div>
                        </div>
                        <div class="xe-body">

                                <ul class="list-unstyled">
                                        <li class="active">
                                                <span class="status-date">21 May</span>
                                                <p>Build your own Fake Twitter Post now! Check it out @ simitator.com #laborator #envato</p>
                                        </li>
                                        <li>
                                                <span class="status-date">18 April</span>
                                                <p> Micro-finance clean water sustainable future Oxfam protect. Enabler meaningful work change-makers.</p>
                                        </li>
                                        <li>
                                                <span class="status-date">08 March</span>
                                                <p>Fight against malnutrition Aga Khan Bloomberg, economic independence inspire breakthroughs benefit civil.</p>
                                        </li>
                                </ul>

                        </div>
                        <div class="xe-footer">
                                <a href="#">
                                        <i class="linecons-thumbs-up"></i>
                                        +1 this post
                                </a>
                        </div>
                </div>

        </div>



        <div class="row row-style" style="margin:0">
                <div class="col-sm-6">

                        <div class="panel panel-default" style="height: 400px;">
                                <div class="panel-heading">
                                        Recent Materials Invoice
                                </div>
                                <div>
                                        <?= Html::a('<i class="fa-th-list"></i><span> Add Materials</span>', ['sales/sales-invoice-details/add'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone', 'style' => 'margin-top: 8px;']) ?>
                                </div>
                                <div style="min-height: 210px;" class="table-responsive">
                                        <table class="table" >
                                                <thead>
                                                        <tr style="text-align: center;">
                                                                <th width="">Invoice Number</th>
                                                                <th width="">Date</th>
                                                                <th width="">Customer</th>
                                                                <th width="">Amount</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                        <?php
                                                        if (!empty($sales_masters)) {
                                                                foreach ($sales_masters as $sales_master) {
                                                                        ?>
                                                                        <tr style="text-align:left;" class='sales-clickable-row' id="clickable-row-<?= $sales_master->id ?>">
                                                                                <td><?= $sales_master->sales_invoice_number ?> </td>
                                                                                <td><?= $sales_master->sales_invoice_date ?></td>
                                                                                <td>
                                                                                        <?php
                                                                                        if (isset($sales_master->busines_partner_code)) {
                                                                                                echo BusinessPartner::findOne(['id' => $sales_master->busines_partner_code])->name;
                                                                                        }
                                                                                        ?>
                                                                                </td>
                                                                                <td><?= $sales_master->order_amount ?></td>
                                                                        </tr>
                                                                        <?php
                                                                }
                                                        } else {
                                                                echo '<tr><td colspan="4" style="text-align:center">No Recent Materials Sale</td></tr>';
                                                        }
                                                        ?>
                                                </tbody>
                                        </table>
                                </div>
                                <div>
                                        <?= Html::a('<i class="fa-share"></i><span> View More</span>', ['sales/sales-invoice-details/index'], ['class' => 'btn btn-blue btn-icon btn-icon-standalone btn-icon-standalone-right', 'style' => 'margin-top: 8px;float:right;']) ?>
                                </div>
                        </div>

                </div>
                <div class="col-sm-6">

                        <div class="panel panel-default" style="height: 400px;">
                                <div class="panel-heading">
                                        Recent Purchase Invoice
                                </div>
                                <div>
                                        <?= Html::a('<i class="fa-th-list"></i><span> New Purchase</span>', ['sales/purchase-invoice-details/add'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone', 'style' => 'margin-top: 8px;']) ?>
                                </div>
                                <div  style="min-height: 210px;" class="table-responsive">
                                        <table class="table">
                                                <thead>
                                                        <tr style="text-align: center;">
                                                                <th width="">Invoice Number</th>
                                                                <th width="">Date</th>
                                                                <th width="">Customer</th>
                                                                <th width="">Amount</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                        <?php
                                                        if (!empty($purchase_masters)) {
                                                                foreach ($purchase_masters as $purchase_master) {
                                                                        ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <!--<a href="<?= Yii::$app->homeUrl; ?>sales/purchase-invoice-details/view?id=<?= $purchase_master->id ?>">-->
                                                                        <tr style="text-align:left;" class='purchase-clickable-row' id="clickable-row-<?= $purchase_master->id ?>">
                                                                                <td><?= $purchase_master->sales_invoice_number ?> </td>
                                                                                <td><?= $purchase_master->sales_invoice_date ?></td>
                                                                                <td>
                                                                                        <?php
                                                                                        if (isset($purchase_master->busines_partner_code)) {
                                                                                                echo BusinessPartner::findOne(['id' => $purchase_master->busines_partner_code])->name;
                                                                                        }
                                                                                        ?>
                                                                                </td>
                                                                                <td><?= $purchase_master->order_amount ?></td>
                                                                        </tr>
                                                                        <!--</a>-->
                                                                        <?php
                                                                }
                                                        } else {
                                                                echo '<tr><td colspan="4" style="text-align:center">No Recent Purchase</td></tr>';
                                                        }
                                                        ?>
                                                </tbody>
                                        </table>
                                </div>
                                <div>
                                        <?= Html::a('<i class="fa-share"></i><span> View More</span>', ['sales/purchase-invoice-details/index'], ['class' => 'btn btn-blue btn-icon btn-icon-standalone btn-icon-standalone-right', 'style' => 'margin-top: 8px;float:right;']) ?>
                                </div>
                        </div>

                </div>
        </div>





</div>