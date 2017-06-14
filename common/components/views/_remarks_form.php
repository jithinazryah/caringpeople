<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\RemarksCategory;

$remarks_category = ArrayHelper::map(RemarksCategory::find()->where(['type' => $type, 'status' => 1])->all(), 'id', 'category');
?>



<div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'category')->dropDownList($remarks_category, ['prompt' => '--Select--', 'class' => 'form-control']) ?>

</div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'sub_category')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="display: none">  <?php echo $form->field($model, 'type')->hiddenInput(['value' => $type])->label(false); ?>

</div><div class='col-md-1 col-sm-6 col-xs-12 left_padd' style="display: none">  <?php echo $form->field($model, 'type_id')->hiddenInput(['value' => $type_id])->label(false); ?>

</div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'remark_type')->dropDownList(['' => '--Select--', '1' => 'Good', '0' => 'Bad']) ?>

</div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'> <?php
        $points = [];
        $points[] = '--Select--';
        for ($i = 1; $i <= 10; $i++) {
                $points[$i] = $i;
        }
        echo $form->field($model, 'point')->dropDownList($points, ['prompt' => '--Select--', 'class' => 'form-control'])
        ?>   

</div><div class='col-md-12 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

</div>


<script>
        $(document).ready(function () {
                $("#remarks-point").find("option").eq(0).remove();
        });

</script>