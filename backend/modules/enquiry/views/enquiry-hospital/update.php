<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EnquiryHospital */

$this->title = 'Update Hospital Information: ' . $enquiry->enquiry_id;
$this->params['breadcrumbs'][] = ['label' => 'Enquiry Hospitals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">
                                <?= Html::a('<i class="fa-th-list"></i><span> Manage Enquiry</span>', ['enquiry/index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <?php if (Yii::$app->session->hasFlash('error')): ?>
                                        <div class="alert alert-danger alert-pdng" role="alert">
                                                <?= Yii::$app->session->getFlash('error') ?>
                                        </div>
                                <?php endif; ?>
                                <?php if (Yii::$app->session->hasFlash('success')): ?>
                                        <div class="alert alert-success alert-pdng" role="alert">
                                                <?= Yii::$app->session->getFlash('success') ?>
                                        </div>
                                <?php endif; ?>
                                <?=
                                $this->render('_enquiry_menus', [
                                    'model' => $model,
                                    'enquiry' => $enquiry,
                                    'other_info' => $other_info,
                                ])
                                ?>
                                <?=
                                $this->render('_form', [
                                    'model' => $model,
                                ])
                                ?>
                        </div>
                </div>
        </div>
</div>
