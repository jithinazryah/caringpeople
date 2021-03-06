<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\daterange\DateRangePicker;
use common\models\BusinessPartner;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SalesInvoiceDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Used Materials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-invoice-details-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-body table-responsive">
                                        <div class="panel-heading">
                                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                                        </div>
                                        <div class="panel-body">
                                                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                                <?= Html::a('<i class="fa-th-list"></i><span> New Invoice</span>', ['add'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                                <button class="btn btn-white" id="search-option" style="float: right;">
                                                        <i class="linecons-search"></i>
                                                        <span>Search</span>
                                                </button>
                                                <?=
                                                GridView::widget([
                                                    'dataProvider' => $dataProvider,
                                                    'filterModel' => $searchModel,
                                                    'columns' => [
                                                            ['class' => 'yii\grid\SerialColumn'],
//                                                            'id',
//            'sales_invoice_master_id',
                                                        [
                                                            'attribute' => 'sales_invoice_number',
                                                            'label' => 'Invoice Number',
                                                            'value' => function($data) {
                                                                    return $data->sales_invoice_number;
                                                            },
                                                            'filter' => ArrayHelper::map(common\models\SalesInvoiceMaster::find()->asArray()->all(), 'sales_invoice_number', 'sales_invoice_number'),
                                                            'filterOptions' => array('id' => "sales_invoice_number_search"),
                                                        ],
//                            'sales_invoice_number',
                                                        [
                                                            'attribute' => 'sales_invoice_date',
                                                            'label' => 'Invoice Date',
                                                            'value' => function ($data) {
                                                                    return date("d-m-Y", strtotime($data->sales_invoice_date));
                                                            },
                                                            'filter' => DateRangePicker::widget(['model' => $searchModel, 'attribute' => 'sales_invoice_date', 'pluginOptions' => ['format' => 'd-m-Y', 'autoUpdateInput' => false]]),
                                                        ],
                                                            [
                                                            'attribute' => 'busines_partner_code',
                                                            'value' => function($data) {
                                                                    if (isset($data->busines_partner_code)) {
                                                                            //   return BusinessPartner::findOne(['id' => $data->busines_partner_code])->name;
                                                                    }
                                                            },
                                                            // 'filter' => ArrayHelper::map(BusinessPartner::find()->asArray()->all(), 'id', 'name'),
                                                            'filterOptions' => array('id' => "sales_partner"),
                                                        ],
                                                        'order_amount',
                                                        'amount_payed',
                                                        'due_amount',
                                                        // 'status',
                                                        // 'CB',
                                                        // 'UB',
                                                        // 'DOC',
                                                        // 'DOU',
//                            ['class' => 'yii\grid\ActionColumn'],
                                                        [
                                                            'class' => 'yii\grid\ActionColumn',
                                                            'contentOptions' => [],
                                                            'header' => 'Actions',
                                                            'template' => '{view}{print}',
                                                            'buttons' => [
                                                                //view button
                                                                'print' => function ($url, $model) {
                                                                        return Html::a('<span class="fa fa-print" style="padding-top: 0px;font-size: 18px;"></span>', $url, [
                                                                                    'title' => Yii::t('app', 'print'),
                                                                                    'class' => 'actions',
                                                                                    'target' => '_blank',
                                                                        ]);
                                                                },
                                                                'view' => function ($url, $model) {
                                                                        return Html::a('<span class="fa fa-eye" style="padding-top: 0px;font-size: 20px;"></span>', $url, [
                                                                                    'title' => Yii::t('app', 'view'),
                                                                                    'class' => 'actions',
                                                                        ]);
                                                                },
                                                            ],
                                                            'urlCreator' => function ($action, $model) {
                                                                    if ($action === 'print') {
                                                                            $url = Url::to(['sales-invoice-details/report', 'id' => $model->id]);
                                                                            return $url;
                                                                    }
                                                                    if ($action === 'view') {
                                                                            $url = Url::to(['sales-invoice-details/view', 'id' => $model->id]);
                                                                            return $url;
                                                                    }
                                                            }
                                                        ],
                                                    ],
                                                ]);
                                                ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>
<script>
        $(document).ready(function () {
                $('#sales_invoice_number_search select').attr('id', 'sales_invoice_number');
                $('#sales_partner select').attr('id', 'sales_bussiness_partner');
                $(".filters").slideToggle();
                $("#search-option").click(function () {
                        $(".filters").slideToggle();
                });
        });
</script>
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>js/select2/select2.css">
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>js/select2/select2-bootstrap.css">
<script src="<?= Yii::$app->homeUrl; ?>js/select2/select2.min.js"></script>
<script type="text/javascript">
        jQuery(document).ready(function ($)
        {
                $("#sales_invoice_number").select2({
                        //placeholder: 'Select your country...',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        // Adding Custom Scrollbar
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });
                $("#sales_bussiness_partner").select2({
                        //placeholder: 'Select your country...',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        // Adding Custom Scrollbar
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });
        });
</script>


