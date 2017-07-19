<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$model = new common\models\ContactCategoryTypes();
$form = ActiveForm::begin(['id' => 'submit-add-form']);
?>



<div class="modal-content">
        <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Contact Category</h4>
        </div>

        <div class="modal-body">

                <div class="row">

                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'  style="margin-left: 20px;">    <?= $form->field($model, 'category_name')->textInput(['maxlength' => true]) ?>

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