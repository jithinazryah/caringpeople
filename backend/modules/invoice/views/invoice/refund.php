<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Invoice */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                        </div>
                        <div class="panel-body">
                                <?= Html::a('<i class="fa-th-list"></i><span> Manage Invoice</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="invoice-create">
                                                <div class="invoice-form form-inline">

                                                        <?php $form = ActiveForm::begin(); ?>

                                                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd' style="display:none">    <?= $form->field($model, 'branch_id')->textInput() ?>

                                                        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' style="display:none">    <?= $form->field($model, 'patient_id')->textInput() ?>

                                                        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' style="display:none">    <?= $form->field($model, 'service_id')->textInput() ?>

                                                        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd' style="display:none">    <?= $form->field($model, 'type')->textInput() ?>

                                                        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'amount')->textInput(['maxlength' => true, 'readonly' => true])->label('Amount Paid') ?>
<?php $model->refund_amount = ''; ?>
                                                        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'refund_amount')->textInput() ?>
                                                                <p id="amount-error" style="color:red">Refund amount should be less than or equal to amount paid</p>
                                                        </div>
                                                        <div class='col-md-4 col-sm-6 col-xs-12' style="float:right;">
                                                                <div class="form-group" style="float: right;">
                                                                        <?= Html::submitButton($model->isNewRecord ? 'Refund' : 'Refund', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                                                                </div>
                                                        </div>

                                                        <?php ActiveForm::end(); ?>

                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>

<script>
        $(document).ready(function () {
                $('#amount-error').hide();
                $('#invoice-refund_amount').keyup(function () {
                        var val = $(this).val();
                        var amount_paid = $('#invoice-amount').val();
                        if (parseInt(val) > parseInt(amount_paid)) {
                                $('#amount-error').show();
                        } else {
                                $('#amount-error').hide();
                        }
                });
        });
</script>