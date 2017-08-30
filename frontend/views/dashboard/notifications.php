<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Employee */

$this->title = 'Notifications ';
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->staff_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">

                                <div class="panel-body">
                                        <div class="employee-create">
                                                <table class="table mail-table">
                                                        <tbody>
                                                                <?php
                                                                $notifications = common\models\Invoice::find()->where(['status' => 2, 'due_date' => date('Y-m-d'), 'patient_id' => Yii::$app->session['patient_id']])->all();
                                                                $services = \common\models\Service::find()->where(['status' => 1, 'patient_id' => Yii::$app->session['patient_id']])->all();
                                                                foreach ($notifications as $notifications) {
                                                                        ?>
                                                                        <tr class="unread">


                                                                                <td class="col-subject ">


                                                                                        <?php // Html::a($notifications->content, ['site/notifications?id=' . $notifications->id], ['class' => '']) ?>

                                                                                        Payment (Rs. <?= $notifications->amount ?>) pending


                                                                                </td>

                                                                                <td class="col-time">

                                                                                        <?= date('d-m-Y', strtotime($notifications->due_date)) ?>

                                                                                </td>
                                                                        </tr>
                                                                        <?php
                                                                }
                                                                foreach ($services as $services) {
                                                                        $followups = \common\models\Followups::find()->where(['status' => 0, 'type_id' => $services->id])->andWhere(['like', 'followup_date', date('Y-m-d')])->all();
                                                                        foreach ($followups as $followup) {
                                                                                ?>
                                                                                <tr class="unread">


                                                                                        <td class="col-subject ">

                                                                                                <?= $followup->followup_notes ?>

                                                                                        </td>

                                                                                        <td class="col-time">

                                                                                                <?= date('d-m-Y', strtotime($followup->followup_date)) ?>

                                                                                        </td>
                                                                                </tr>

                                                                                <?php
                                                                        }
                                                                }
                                                                ?>
                                                        </tbody>
                                                </table>

                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>