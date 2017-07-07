<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EnquirySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Services';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enquiry-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                                </div>

                                <?= Html::a('<i class="fa-th-list"></i><span> Manage Service</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone', 'style' => 'margin-top:10px;']) ?>

                                <?=
                                $this->render('_menus', [
                                    'model' => $model,
                                ])
                                ?>
                                <div class="panel-body panel_body_background" >

                                        <div class="tab-content tab_data_margin" >

                                                <div class="tab-pane active" id="home-3">

                                                        <?=
                                                        $this->render('_form', [
                                                            'model' => $model,
                                                        ])
                                                        ?>

                                                </div>
                                                <?php if (!$model->isNewRecord) { ?>
                                                        <div class="tab-pane" id="home-5">

                                                                <?=
                                                                $this->render('schedules', [
                                                                    'model' => $model,
                                                                    'service_schedule' => $service_schedule
                                                                ])
                                                                ?>

                                                        </div>
                                                <?php } ?>




                                        </div>








                                </div>
                        </div>
                </div>
        </div>
</div>
