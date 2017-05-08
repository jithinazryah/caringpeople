<?php

use yii\helpers\Html;

$link = Yii::$app->request->referrer
?>



<ul class="nav nav-tabs nav-tabs-justified" style="margin-top: 10px;">
        <li class="active">
                <a href="<?= Yii::$app->homeUrl; ?>services/service/create"><span class="visible-xs"><i class="fa-envelope-o"></i></span>
                        <span class="hidden-xs span-font-size">Start A Service</span></a>
        </li>

        <li>
                <a href="<?= Yii::$app->homeUrl; ?>followup/followups/followups?type=5" ><span class="visible-xs"><i class="fa-hospital-o"></i></span>
                        <span class="hidden-xs span-font-size">TASKS</span></a>
        </li>


</ul>



