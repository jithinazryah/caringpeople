<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AdminPosts */

$this->title = $model->post_name;
$this->params['breadcrumbs'][] = ['label' => 'Admin Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

            </div>
            <div class="panel-body">
                <?= Html::a('<i class="fa-th-list"></i><span> Manage Admin Posts</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <div class="panel-body"><div class="admin-posts-view">
                        <p>
                            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                            <?=
                            Html::a('Delete', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ])
                            ?>
                        </p>

                        <?=
                        DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                //'id',
                                'post_name',
                                [
                                    'attribute' => 'admin',
                                    'value' => $model->admin == 1 ? 'yes' : 'no',
                                ],
                                [
                                    'attribute' => 'enquiry',
                                    'value' => $model->enquiry == 1 ? 'yes' : 'no',
                                ],
                                [
                                    'attribute' => 'users',
                                    'value' => $model->users == 1 ? 'yes' : 'no',
                                ],
                                [
                                    'attribute' => 'employees',
                                    'value' => $model->employees == 1 ? 'yes' : 'no',
                                ],
                                //'enquiry',
                                //'users',
                                //'employees',
//                                'status',
//                                'CB',
//                                'UB',
//                                'DOC',
//                                'DOU',
                            ],
                        ])
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


