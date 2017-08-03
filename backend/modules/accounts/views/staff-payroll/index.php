<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StaffPayrollSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Staff Payrolls';
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
                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                        <?= Html::a('<i class="fa-th-list"></i><span> Create Staff Payroll</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
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
                                                ],
                                                //   'staff_id',
                                                //'month',
                                                ['attribute' => 'month',
                                                    'filterOptions' => array('id' => "date"),],
                                                // 'year',
                                                'type',
                                                // 'amount',
                                                // 'CB',
                                                // 'UB',
                                                // 'DOC',
                                                // 'DOU',
                                                ['class' => 'yii\grid\ActionColumn'],
                                            ],
                                        ]);
                                        ?>
                                </div>
                        </div>
                </div>
        </div>
</div>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
        $(document).ready(function () {
                $('#date input').attr('id', 'date-picker');
                $('.ui-datepicker-close').attr('id', 'close');
                $('.ui-priority-primary').attr('id', 'close');
//                $('.ui-datepicker-close').click(function () {
//                        alert();
//                });
        });
</script>

<script>
        $(function () {
                $('#date-picker').datepicker({
                        changeMonth: true,
                        changeYear: true,
                        yearRange: "c-0:c+100",
                        showButtonPanel: true,
                        dateFormat: 'mm-yy',
                        onClose: function (dateText, inst) {
                                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                                $(this).datepicker('setDate', new Date(year, month, 1));
                        }
                });


        });
</script>
<style>
        .ui-datepicker-calendar {
                display: none;
        }
</style>