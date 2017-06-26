<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\RemarksWidget;
use yii\grid\GridView;
use common\models\RemarksCategory;
use yii\helpers\ArrayHelper;
$remarks=new \common\models\Remarks;

?>

<div class="patient-enquiry-general-first-form form-inline">
            <?= RemarksWidget::widget(['type_id' => $patient_info->id, 'type' => 1, 'model' => $remarks, 'form' => $form]); ?>

</div>
    