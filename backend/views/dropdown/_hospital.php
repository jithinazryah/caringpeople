<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$model = new common\models\Hospital();
$form = ActiveForm::begin(['id' => 'submit-add-form']);
?>



<div class="modal-content">
        <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Hospital</h4>
        </div>

        <div class="modal-body">

                <div class="row">

                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'hospital_name')->textInput(['maxlength' => true]) ?>

                        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_person')->textInput(['maxlength' => true]) ?>

                        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_email')->textInput(['maxlength' => true]) ?>

                        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_number')->textInput(['maxlength' => true]) ?>

                        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'contact_number_2')->textInput(['maxlength' => true]) ?>

                        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'address')->textarea(['rows' => 4]) ?>

                        </div>
                        <input type="hidden" name="type" id="type" value="<?= $type; ?>">
                        <input type="hidden" name="field_id" id="field_id" value="<?= $field_id; ?>">
                </div>





        </div>


        <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
</div>

<?php ActiveForm::end(); ?>
