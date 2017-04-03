<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PatientInformation */

$this->title = 'Create Patient Information';
$this->params['breadcrumbs'][] = ['label' => 'Patient Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

            </div>

            <?= Html::a('<i class="fa-th-list"></i><span> Manage Enquiry</span>', ['enquiry/index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
            <div class="panel-body">
                <?php //  Html::a('<i class="fa-th-list"></i><span> Manage Patient Information</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone'])  ?>
                <div class="panel-body"><div class="patient-information-create">
                        <?=
                        $this->render('_form', [
                            'model' => $model,
                        ])
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

