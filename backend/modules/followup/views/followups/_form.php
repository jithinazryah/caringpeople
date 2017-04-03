<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use common\models\AdminUsers;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Followups */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="followups-form form-inline">

        <?php $form = ActiveForm::begin(); ?>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <div class="form-group field-followups-followup_date">
                        <label class="control-label" for="followups-followup_date">Followup Date</label>

                        <?php
                        if (!$model->isNewRecord && isset($followup_id)) {
                                $model->followup_date = date('d-M-Y h:i', strtotime($model->followup_date));
                        } else {
                                $model->followup_date = date('d-M-Y h:i');
                        }
                        echo DateTimePicker::widget([
                            'name' => 'Followups[followup_date]',
                            'type' => DateTimePicker::TYPE_INPUT,
                            'value' => $model->followup_date,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-M-yyyy hh:ii'
                            ]
                        ]);
                        ?>

                </div>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?php
                if (!$model->isNewRecord)
                        $userid = $model->assigned_from;
                else
                        $userid = Yii::$app->user->identity->id;

                $user = AdminUsers::findOne($userid);
                $model->assigned_from = $user->name;
                ?>

                <?= $form->field($model, 'assigned_from')->textInput(['readonly' => true]) ?>

        </div>
        <?php if (!$followup_info->isNewRecord) {
                ?>

                <div class = 'col-md-4 col-sm-6 col-xs-12 left_padd'> <?= $form->field($model, 'status')->dropDownList(['0' => 'Open', '1' => 'Closed', '2' => 'Void']) ?>
                        <?php if ($model->status == '3') { ?><label style="color: #d5080f;"> * This followup is currently in Pending stage</label><?php } ?>
                </div>


        <?php } ?>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($model, 'followup_notes')->textarea(['rows' => 6]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12' >
                <div class="form-group" >
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>
        </div>

        <?php ActiveForm::end(); ?>

</div>
