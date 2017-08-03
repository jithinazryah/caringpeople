<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use common\models\StaffInfo;

$this->title = 'Schedules';
$this->params['breadcrumbs'][] = $this->title;
/* @var $this yii\web\View */
/* @var $model common\models\Service */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="table-responsive">
        <table id="example-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                        <tr>
                                <th style="width:10px;">No</th>
                                <th>Date</th>
                                <th>Remarks from staff</th>


                        </tr>
                </thead>

                <tbody>
                        <?php
                        $p = 0;
                        foreach ($service_schedule as $value) {
                                $p++;
                                $class = 'completed';
                                $class1 = 'hide-class';
                                ?>
                                <tr  id="<?= $value->id; ?>" style="text-align:center">
                                        <td><?= $p; ?></td>

                                        <td><?php
                                                if (isset($value->date) && $value->date != '') {
                                                        $date = date('d-m-Y', strtotime($value->date));
                                                } else {
                                                        $date = '';
                                                }
                                                echo DatePicker::widget([
                                                    'name' => 'date',
                                                    'id' => 'schedule_date-' . $value->id,
                                                    'type' => DatePicker::TYPE_INPUT,
                                                    'value' => $date,
                                                    'pluginOptions' => [
                                                        'autoclose' => true,
                                                        'format' => 'dd-mm-yyyy',
                                                    ],
                                                    'options' => [
                                                        'class' => 'schedule-update-dates ' . $class . '',
                                                    ]
                                                ]);
                                                ?>
                                        </td>

                                        <td class="sas">

                                                <textarea class="form-control remarks_staff" name="remarks_from_patient" id="<?= $value->id ?>">
                                                        <?php
                                                        if (isset($value->remarks_from_staff) && $value->remarks_from_staff != '') {
                                                                echo $value->remarks_from_staff;
                                                        } else {
                                                                ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <h3 style="font-weight:bold!important">Notes (patient daignosis and findings) </h3>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <br><br>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <h3 style="font-weight:bold!important">Medication Advice </h3>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <br><br>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <h3 style="font-weight:bold!important">Lab test advice  </h3>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <br><br>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <h3 style="font-weight:bold!important">Prescription   </h3>
                                                        <?php } ?>
                                                </textarea>
                                        </td>

                                </tr>
                        <?php } ?>
                </tbody>
        </table>
</div>




<script src="<?= Yii::$app->homeUrl; ?>js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
        CKEDITOR.addCss('h3{font-weight:bold;}');
        CKEDITOR.addCss('h3{text-decoration:underline;}');
        CKEDITOR.replaceClass = 'remarks_staff';



</script>














<style>
        .cke_contents{
                height:100px !important;
        }
        .form-control{
                border: none;
        }
        select[name="example-1_length"]{
                width: 75px !important;
        }

        table td{
                padding: 0 !important;
        }
        table td .sorting_1{
                text-align: center !important;
        }
        #example-1_filter{
                display: none;
        }.dataTables_wrapper .table thead>tr .sorting:before, .dataTables_wrapper .table thead>tr .sorting_asc:before, .dataTables_wrapper .table thead>tr .sorting_desc:before{
                display: none;
        }.sorting_1{
                text-align: center;
        }.completed{
                pointer-events: none;
        }.serv_details{
                float: right;
                margin-top: 10px;
        }

</style>

