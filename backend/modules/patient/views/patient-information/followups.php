<?php

use yii\helpers\Html;
use common\components\FollowupsWidget;
use yii\grid\GridView;
?>

<div class="patient-enquiry-general-first-form form-inline">
        <?= FollowupsWidget::widget(['type_id' => $patient_info->id, 'type' => 2, 'model' => $followups, 'form_followup' => $form_followup, 'searchModel' => $searchModel, 'dataProvider' => $dataProvider]); ?>
</div>