<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use common\models\Branch;
use common\models\StaffLeave;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StaffLeaveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Leave Report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-leave-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                        <div class="attendance-form form-inline">
                                                <?php $form = ActiveForm::begin(); ?>
                                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                        <?=
                                                        DatePicker::widget([
                                                            'model' => $model,
                                                            'form' => $form,
                                                            'type' => DatePicker::TYPE_INPUT,
                                                            'attribute' => 'commencing_date',
                                                            'pluginOptions' => [
                                                                'autoclose' => true,
                                                                'format' => 'dd-mm-yyyy',
                                                            ]
                                                        ]);
                                                        ?>
                                                </div>


                                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                                                        <?=
                                                        DatePicker::widget([
                                                            'model' => $model,
                                                            'form' => $form,
                                                            'type' => DatePicker::TYPE_INPUT,
                                                            'attribute' => 'ending_date',
                                                            'pluginOptions' => [
                                                                'autoclose' => true,
                                                                'format' => 'dd-mm-yyyy',
                                                            ]
                                                        ]);
                                                        ?>


                                                </div>


                                                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?php $branch = Branch::branch(); ?>   <?= $form->field($model, 'status')->dropDownList(ArrayHelper::map($branch, 'id', 'branch_name'), ['prompt' => '--Select--']) ?>
                                                </div>
                                                <div class='col-md-3 col-sm-6 col-xs-12' >
                                                        <div class="form-group" >
                                                                <?= Html::submitButton($model->isNewRecord ? 'Search' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                                                        </div>
                                                </div>

                                                <?php ActiveForm::end(); ?>
                                        </div>

                                        <!-------------------------------------------------REPORT----------------------------------------------------------------------------->

                                        <?php if (!empty($staffs) && $staffs != '') { ?>

                                                <div class="table-responsive">
                                                        <table class="table table-striped">


                                                                <?php
                                                                $s = 0;
                                                                foreach ($staffs as $value) {
                                                                        $staff_exists = StaffLeave::find()->where(['employee_id' => $value->id])->andWhere(['>=', 'commencing_date', $from])->andWhere(['<=', 'commencing_date', $to])->exists();
                                                                        if ($staff_exists == 1) {
                                                                                $s++;
                                                                                if ($s == 1) {
                                                                                        ?>
                                                                                        <thead>
                                                                                        <th>NO</th>
                                                                                        <th>EMPLOYEE NAME</th>
                                                                                        <th>NO OF LEAVES </th>
                                                                                        </thead>

                                                                                        <tbody>
                                                                                                <?php
                                                                                        }
                                                                                        ?>
                                                                                        <tr>
                                                                                                <td><?= $s; ?></td>
                                                                                                <td><?= $value->staff_name; ?></td>
                                                                                                <?php $count = StaffLeave::find()->where(['employee_id' => $value->id])->andWhere(['>=', 'commencing_date', $from])->andWhere(['<=', 'commencing_date', $to])->count(); ?>
                                                                                                <td><?= $count; ?></td>
                                                                                        </tr>
                                                                                        <?php
                                                                                }
                                                                        }
                                                                        ?>

                                                                </tbody>
                                                        </table>
                                                </div>


                                        <?php } ?>
                                </div>
                        </div>

                </div>
        </div>

        <style>
                .table th{
                        text-align: center;
                }
        </style>
</div>