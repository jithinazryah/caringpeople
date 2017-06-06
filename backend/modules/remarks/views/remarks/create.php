<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Remarks */
if ($model->isNewRecord)
        $this->title = 'Add Remarks';
else
        $this->title = 'Update Remarks';
$this->params['breadcrumbs'][] = ['label' => 'Remarks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

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

