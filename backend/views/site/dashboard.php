<?php

use yii\helpers\Html;
use yii\db\Expression;
?>
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/fonts/meteocons/css/meteocons.css">

<script src="<?= Yii::$app->homeUrl; ?>js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= Yii::$app->homeUrl; ?>js/jvectormap/regions/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?= Yii::$app->homeUrl; ?>js/xenon-widgets.js"></script>

<div class="row">

        <div class="col-sm-3">

                <div class="xe-widget xe-counter" >
                        <div class="xe-icon">
                                <i class="fa fa-medkit"></i>
                        </div>
                        <div class="xe-label">
                                <strong class="num"><?= $patients ?></strong>
                                <span>Patients</span>
                        </div>
                </div>

        </div>

        <div class="col-sm-3">

                <div class="xe-widget xe-counter xe-counter-blue" >
                        <div class="xe-icon">
                                <i class="linecons-user"></i>
                        </div>
                        <div class="xe-label">
                                <strong class="num"><?= $staffs ?></strong>
                                <span>Staffs Total</span>
                        </div>
                </div>

        </div>

        <div class="col-sm-3">

                <div class="xe-widget xe-counter xe-counter-info" data-count=".num" data-from="0" data-to="<?= $services ?>" data-duration="4" data-easing="true">
                        <div class="xe-icon">
                                <i class="fa fa-shield"></i>
                        </div>
                        <div class="xe-label">
                                <strong class="num">0</strong>
                                <span>Live Services</span>
                        </div>
                </div>

        </div>

        <div class="col-sm-3">

                <div class="xe-widget xe-counter xe-counter-red"  >
                        <div class="xe-icon">
                                <i class="linecons-lightbulb"></i>
                        </div>
                        <div class="xe-label">
                                <strong class="num"></strong>
                                <span>CaringPeople</span>
                        </div>
                </div>

        </div>


        <div class="col-sm-12">



                <!-- Tweets -->
                <div class="xe-widget xe-status-update" data-auto-switch="5" style="background-color:#99bbd6">
                        <div class="xe-header">
                                <div class="xe-icon">
                                        <i class="fa fa-tasks"></i>
                                </div>
                                <div class="xe-nav">
                                        <a href="#" class="xe-prev">
                                                <i class="fa-angle-left"></i>
                                        </a>
                                        <a href="#" class="xe-next">
                                                <i class="fa-angle-right"></i>
                                        </a>
                                </div>
                        </div>
                        <div class="xe-body">

                                <ul class="list-unstyled">


                                        <?php
                                        $e = 0;
                                        foreach ($tasks as $value) {
                                                $e++;
                                                ?>
                                                <li class="<?= $e == 1 ? 'active' : '' ?>">
                                                        <span class="status-date"><?= date('d F Y H:i:s', strtotime($value->followup_date)) ?></span>
                                                        <p><?= $value->followup_notes; ?></p>
                                                </li>
                                        <?php }
                                        ?>
                                </ul>

                        </div>
                        <div class="xe-footer">
                                <a href="<?= Yii::$app->homeUrl ?>followup/followups/index">
                                        <i class="fa-retweet"></i>
                                        My Tasks
                                </a>
                        </div>
                </div>

        </div>


        <div class="row row-style" style="margin:0">
                <div class="col-sm-12">
                        <?php $services = \common\models\Service::find()->where(['status' => 1])->andWhere(new Expression('FIND_IN_SET(:staffs, service_staffs)'))->addParams([':staffs' => Yii::$app->user->identity->id])->orWhere(['staff_manager' => Yii::$app->user->identity->id])->limit(5)->all();
                        ?>

                        <div class="panel panel-default" style="height: 400px;">
                                <div class="panel-heading">
                                        Services
                                </div>

                                <div style="min-height: 210px;" class="table-responsive">
                                        <table class="table" >
                                                <thead>
                                                        <tr style="text-align: center;">
                                                                <th>#</th>
                                                                <th width="">Service ID</th>
                                                                <th width="">Patient ID</th>
                                                                <th width="">Service</th>
                                                                <th width="">Duty Type</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                        <?php
                                                        if (!empty($services)) {
                                                                $f = 0;
                                                                foreach ($services as $services) {
                                                                        $f++;
                                                                        ?>
                                                                        <tr style="text-align:left;" >
                                                                                <td><?= $f ?></td>
                                                                                <td><?= $services->service_id ?> </td>
                                                                                <td><?= $services->patient->first_name ?></td>
                                                                                <td><?= $services->service0->service_name ?></td>
                                                                                <td><?php
                                                                                        if ($services->duty_type == '1') {
                                                                                                echo 'Hourly';
                                                                                        } else if ($services->duty_type == '2') {
                                                                                                echo 'Visit';
                                                                                        } else if ($services->duty_type == '3') {
                                                                                                echo 'Day';
                                                                                        } else if ($services->duty_type == '4') {
                                                                                                echo 'Night';
                                                                                        } else if ($services->duty_type == '5') {
                                                                                                echo 'Day & Night';
                                                                                        }
                                                                                        ?></td>
                                                                        </tr>
                                                                        <?php
                                                                }
                                                        } else {
                                                                echo '<tr><td colspan="4" style="text-align:center">No Recent Materials Sale</td></tr>';
                                                        }
                                                        ?>
                                                </tbody>
                                        </table>
                                </div>
                                <div>
                                        <?= Html::a('<i class="fa-share"></i><span> View More</span>', ['sales/sales-invoice-details/index'], ['class' => 'btn btn-blue btn-icon btn-icon-standalone btn-icon-standalone-right', 'style' => 'margin-top: 8px;float:right;']) ?>
                                </div>
                        </div>

                </div>

        </div>


</div>