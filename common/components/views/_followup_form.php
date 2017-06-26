<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\FollowupsWidget;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
$followups=new common\models\Followups;

?>

<div class="patient-enquiry-general-first-form form-inline">
            <?= RemarksWidget::widget(['type_id' => $patient_info->id, 'type' => 1, 'model' => $remarks, 'form' => $form]); ?>

</div>
    