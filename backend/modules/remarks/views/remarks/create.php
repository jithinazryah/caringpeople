<?php

use yii\helpers\Html;
use common\components\ViewlinkssWidget;

/* @var $this yii\web\View */
/* @var $model common\models\Remarks */
if ($model->isNewRecord)
        $this->title = 'Add Remarks -';
else
        $this->title = 'Update Remarks -';
$this->params['breadcrumbs'][] = ['label' => 'Remarks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;




if ($type == '1') {
        $enquiry_id = common\models\PatientGeneral::findOne($type_id);
        $followup_for = $enquiry_id->patient_id;
        $link = 'update-patient/' . $type_id;
        $view_type = '2';
} elseif ($type == '2') {
        $enquiry_id = common\models\StaffInfo::findOne($type_id);
        $followup_for = $enquiry_id->staff_id;
        $link = 'update-staff/' . $type_id;
        $view_type = '4';
} else {
        $heading = 'Follow ups';
        $followup_for = '';
        $link = '#';
}
?>

<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?> <a href="<?= Yii::$app->homeUrl . $link ?>" style="color:#1b44ab"><?= $followup_for ?></a></h3>
                                <?= ViewlinkssWidget::widget(['type_id' => $type_id, 'type' => $view_type]); ?>
                        </div>
                        <div class="panel-body">

                                <div class="panel-body"><div class="remarks-create">
                                                <?=
                                                $this->render('_form', [
                                                    'model' => $model,
                                                    'type_id' => $type_id,
                                                    'type' => $type,
                                                    'searchModel' => $searchModel,
                                                    'dataProvider' => $dataProvider,
                                                ])
                                                ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>

