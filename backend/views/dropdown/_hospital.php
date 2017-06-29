<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$model = new common\models\Hospital();
$form = ActiveForm::begin(['id' => 'submit-add-hospital']);
?>


<form action="" id="submit-add-hospital">
        <div class="modal-content">
                <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Add Hospital</h4>
                </div>

                <div class="modal-body">

                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'hospital_name')->textInput(['maxlength' => true]) ?>

                        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_person')->textInput(['maxlength' => true]) ?>

                        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_email')->textInput(['maxlength' => true]) ?>

                        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_number')->textInput(['maxlength' => true]) ?>

                        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_number_2')->textInput(['maxlength' => true]) ?>

                        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'address')->textarea(['rows' => 4]) ?>

                        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

                        </div>
                        <div class='col-md-4 col-sm-6 col-xs-12' >
                                <div class="form-group" >
                                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                                </div>
                        </div>

                </div>

        </div>
</form>