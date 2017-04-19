<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Followups */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Followups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">
                                <?=  Html::a('<i class="fa-th-list"></i><span> Manage Followups</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="followups-view">
                                                <p>
                                                        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                                                        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                                                        'class' => 'btn btn-danger',
                                                        'data' => [
                                                        'confirm' => 'Are you sure you want to delete this item?',
                                                        'method' => 'post',
                                                        ],
                                                        ]) ?>
                                                </p>

                                                <?= DetailView::widget([
                                                'model' => $model,
                                                'attributes' => [
                                                            'id',
            'type',
            'type_id',
            'followup_date',
            'followup_notes:ntext',
            'assigned_to',
            'assigned_from',
            'DOC',
                                                ],
                                                ]) ?>
</div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>


