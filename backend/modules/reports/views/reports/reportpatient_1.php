<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use common\models\Branch;
use common\models\StaffInfo;
use common\models\Service;
use common\models\ServiceSchedule;

$this->title = 'Patient Report';
$this->params['breadcrumbs'][] = ['label' => 'Attendances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">

        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                        </div>

                        <div class="panel-body">
                                <div class="panel-body"><div class="attendance-create">


                                                <div class="attendance-form form-inline">
                                                        <?php $form = ActiveForm::begin(); ?>
                                                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                                <?=
                                                                DatePicker::widget([
                                                                    'model' => $model,
                                                                    'form' => $form,
                                                                    'type' => DatePicker::TYPE_INPUT,
                                                                    'attribute' => 'date',
                                                                    'pluginOptions' => [
                                                                        'autoclose' => true,
                                                                        'format' => 'dd-mm-yyyy',
                                                                    ]
                                                                ]);
                                                                ?>
                                                        </div>


                                                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                                <?=
                                                                DatePicker::widget([
                                                                    'model' => $model,
                                                                    'form' => $form,
                                                                    'type' => DatePicker::TYPE_INPUT,
                                                                    'attribute' => 'DOC',
                                                                    'pluginOptions' => [
                                                                        'autoclose' => true,
                                                                        'format' => 'dd-mm-yyyy',
                                                                    //   "endDate" => (string) date('d/m/Y'),
                                                                    ]
                                                                ]);
                                                                ?>


                                                        </div>

                                                        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>
                                                                <?php $branch = Branch::Branch();
                                                                ?>
                                                                <?= $form->field($model, 'rating')->dropDownList(ArrayHelper::map($branch, 'id', 'branch_name'), ['prompt' => '--Select--']); ?>
                                                        </div>


                                                        <div class='col-md-2 col-sm-6 col-xs-12' >
                                                                <div class="form-group" >
                                                                        <?= Html::submitButton($model->isNewRecord ? 'Search' : 'Search', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                                                                </div>
                                                        </div>

                                                        <?php ActiveForm::end(); ?>
                                                </div>

                                                <div style="clear:both"></div>

                                                <!-------------------------------------------------REPORT----------------------------------------------------------------------------->
                                                <?php if (!empty($patients) && $patients != '') { ?>

                                                        
                                                

                                                        <div class="row" style="margin:10px 0px 0px 0px;">

                                                                <?php
                                                                $from = date('Y-m-d', strtotime($model->date));
                                                                $to = date('Y-m-d', strtotime($model->DOC));
                                                                ?>

                                                        </div>


                                                        <div class = "table-responsive">
                                                                <table id="example-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                                        <thead>
                                                                        <th>NO</th>
                                                                        <th>PATIENT</th>
                                                                        <th>AMOUNT</th>
                                                                        <th></th>


                                                                        </thead>

                                                                        <tbody>
                                                                                <?php
                                                                                $k = 0;
                                                                                foreach ($patients as $patients) {
                                                                                    $services= ServiceSchedule::find()->where(['patient_id'=>$patients->id])->andWhere(['>=','date',$from])->andWhere(['<=','date',$to])->groupBy(['service_id'])->all();
                                                                                    $due_amount=0;
                                                                                    foreach ($services as $value) {
                                                                                        $service_detail= Service::findOne($value->service_id);
                                                                                    
                                                                                        $due_amount+=$service_detail->due_amount; 
                                                                                    }  
                                                                                    if($due_amount>0){
                                                                                        $k++;
                                                                                        ?>
                                                                                        <tr>
                                                                                                <td><?= $k; ?></td>
                                                                                                <td><?= $patients->first_name; ?></td>
                                                                                                <td><?php echo Yii::$app->NumToWord->NumberFormat($due_amount)?></td>
                                                                                                <td><button class="btn btn-info"><a target="_blank" href="<?= Yii::$app->homeUrl ?>reports/reports/servicedetails?from=<?= $from ?>&to=<?= $to ?>&patient=<?= $patients->id ?>" style="color: #FFF">View Details</a></button></td>

                                                                                              


                                                                                                
                                                                                        </tr>
                                                                                <?php }} ?>

                                                                        </tbody>
                                                                </table>
                                                        </div>

                                                        <?php
                                                } else {
                                                        if (isset($model->rating) && $model->rating != '') {
                                                                echo '<p class="no-result">No results found !!</p>';
                                                        }
                                                }
                                                ?>


                                        </div>

                                </div>
                        </div>
                </div>
        </div>
</div>


<style>
        .form-control{
                border: none;
        }.table-responsive{
                border: none;
        }
        select[name="example-1_length"]{
                width: 75px !important;
        }
        .dataTables_wrapper .table thead>tr .sorting:before, .dataTables_wrapper .table thead>tr .sorting_asc:before, .dataTables_wrapper .table thead>tr .sorting_desc:before{
                display: none;
        }#example-1_filter{
                display: none;
        }
        .present{
                color: green;
        }
        .absent{
                color: red;
        }.counts p{
                float: right;
                line-height: 25px;
                color: #000;
        }.counts span,.counts1 span{
                font-weight: bold;
                color: #000;
        }.counts1{
                color: #000;
        }.table-responsive{
                margin-top: 15px;
        }.no-result{
                text-align: center;
                font-style: italic;
        }.label-1{
                margin-left: 48px;
        }
</style>
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>js/table/dataTables.bootstrap.css">
<script src="<?= Yii::$app->homeUrl; ?>js/table/jquery.dataTables.min.js"></script>

<script src="<?= Yii::$app->homeUrl; ?>js/table/dataTables.bootstrap.js"></script>
<script src="<?= Yii::$app->homeUrl; ?>js/table/jquery.dataTables.yadcf.js"></script>
<script src="<?= Yii::$app->homeUrl; ?>js/table/dataTables.tableTools.min.js"></script>
<script type="text/javascript">
        $(document).ready(function ($)
        {
                $("#example-1").dataTable({
                        aLengthMenu: [
                                [20, 50, 100, -1], [20, 50, 100, "All"]
                        ]
                });
        });
</script>

<?php

function divadjust($k) {
        if ($k % 3 == 0) {
                echo '</div><div class="row">';
        }
        return;
}
?>