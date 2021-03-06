<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$model = new common\models\ContactSubcategory();
$form = ActiveForm::begin(['id' => 'submit-add-form']);
?>



<div class="modal-content" id="pop-form">
        <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title pop-heading">Add Contact Sub Category</h4>
        </div>

        <div class="modal-body">

                <div class="row">
                        <?php $model->category_id = $category; ?>
                        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'  style="display:none">    <?= $form->field($model, 'category_id')->textInput(['maxlength' => true]) ?>

                        </div>
                        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'  style="margin-left: 20px;">    <?= $form->field($model, 'sub_category')->textInput(['maxlength' => true]) ?>

                        </div>
                        <input type="hidden" name="type" id="type" value="<?= $type; ?>">
                        <input type="hidden" name="field_id" id="field_id" value="<?= $field_id; ?>">

                        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success pop-submit-btn']) ?>

                        </div>
                </div>

        </div>



</div>

<?php ActiveForm::end(); ?>
