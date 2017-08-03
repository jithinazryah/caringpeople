<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\StaffInfo;

$staffs = StaffInfo::Liststaffs();

$year = \common\models\StaffPayroll::Liststaffs();

/* @var $this yii\web\View */
/* @var $searchModel common\models\StaffPayrollSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payroll Report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-payroll-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">

                                        <?=
                                        GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
                                                //   'id',
                                                [
                                                    'attribute' => 'staff_id',
                                                    'value' => 'staff.staff_name',
                                                    'filter' => ArrayHelper::map($staffs, 'id', 'staff_name'),
                                                    'filterOptions' => array('id' => "staff_name_search"),
                                                ],
                                                    ['attribute' => 'selected_month',
                                                    'value' => function($model) {
                                                            if ($model->selected_month == 7) {
                                                                    return 'July';
                                                            } else if ($model->selected_month == 8) {
                                                                    return 'August';
                                                            }
                                                    },
                                                    'filter' => [1 => 'January', 2 => 'Februaruy', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'],
                                                ],
                                                    [
                                                    'attribute' => 'year',
                                                    'filter' => $year,
                                                    'filterOptions' => array('id' => "year_search"),
                                                ],
                                                    [
                                                    'attribute' => 'type',
                                                    'value' => function($model) {
                                                            if ($model->type == 1) {
                                                                    return 'Advance';
                                                            } else if ($model->type == 2) {
                                                                    return 'Full Payment';
                                                            }
                                                    },
                                                    'filter' => [1 => 'Advanced', 2 => 'Full Payment'],
                                                ],
                                                'amount',
                                            ],
                                        ]);
                                        ?>
                                </div>
                        </div>
                </div>
        </div>
</div>


<script>
        $(document).ready(function () {
                $('#staff_name_search select').attr('id', 'staff_name');
                $('#year_search select').attr('id', 'year');
                $("#staff_name").select2({
                        placeholder: '',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        // Adding Custom Scrollbar
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });

                $("#year").select2({
                        placeholder: '',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        // Adding Custom Scrollbar
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });
        });
</script>

