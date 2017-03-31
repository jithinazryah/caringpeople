<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Followups */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="followups-form form-inline">

        <?php $form = ActiveForm::begin(); ?>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'followup_date')->textInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'assigned_to')->textInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'assigned_from')->textInput() ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>  <?=
                $form->field($model, 'followup_notes')->widget(CKEditor::className(), [
                    'options' => ['rows' => 10],
                    'preset' => 'basic'
                ])
                ?>  <?php // $form->field($model, 'followup_notes')->textarea(['rows' => 6])  ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12' >
                <div class="form-group" >
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>
        </div>

        <?php ActiveForm::end(); ?>

</div>
