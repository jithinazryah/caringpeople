<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EnquiryHospitalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enquiry-hospital-search">

        <?php
        $form = ActiveForm::begin([
                    'action' => ['index'],
                    'method' => 'get',
        ]);
        ?>

        <?= $form->field($model, 'id') ?>

        <?= $form->field($model, 'enquiry_id') ?>

        <?= $form->field($model, 'hospital_name') ?>

        <?= $form->field($model, 'consultant_doctor') ?>

        <?= $form->field($model, 'hospital_room_no') ?>

        <?php // echo $form->field($model, 'required_service') ?>

        <?php // echo $form->field($model, 'other_services') ?>

        <?php // echo $form->field($model, 'diabetic') ?>

        <?php // echo $form->field($model, 'hypertension') ?>

        <?php // echo $form->field($model, 'tubes') ?>

        <?php // echo $form->field($model, 'feeding') ?>

        <?php // echo $form->field($model, 'urine') ?>

        <?php // echo $form->field($model, 'oxygen') ?>

        <?php // echo $form->field($model, 'tracheostomy') ?>

        <?php // echo $form->field($model, 'iv_line') ?>

        <?php // echo $form->field($model, 'dressing') ?>

        <?php // echo $form->field($model, 'visit_type') ?>

        <?php // echo $form->field($model, 'visit_date') ?>

                <?php // echo $form->field($model, 'bedridden')  ?>

        <div class="form-group">
<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
        </div>

<?php ActiveForm::end(); ?>

</div>
