<?php

use yii\helpers\Html;

$link = Yii::$app->request->referrer
?>



<!--<ul class="nav nav-tabs nav-tabs-justified" style="margin-top: 10px;">
        <li class="active">
                <a href="<?= Yii::$app->homeUrl; ?>update-service/<?= $type_id; ?>"><span class="visible-xs"><i class="fa-envelope-o"></i></span>
                        <span class="hidden-xs span-font-size">Start A Service</span></a>
        </li>

        <li>
                <a href="<?= Yii::$app->homeUrl; ?>followup/followups/followups?type_id=<?= $type_id; ?>&type=5&service=setvice" ><span class="visible-xs"><i class="fa-hospital-o"></i></span>
                        <span class="hidden-xs span-font-size">Followups</span></a>
        </li>


</ul>-->



<ul class="nav nav-tabs">
        <li class="active">
                <a href="<?= Yii::$app->homeUrl; ?>update-service/<?= $type_id; ?>"><span class="visible-xs"><i class="fa-envelope-o hidden-xs"></i></span>
                        <i class="fa-envelope-o"></i><span class="hidden-xs span-font-size">Start A Service</span></a>
        </li>

        <li>
                <a href="<?= Yii::$app->homeUrl; ?>followup/followups/followups?type_id=<?= $type_id; ?>&type=5&service=setvice"><span class="visible-xs"><i class="fa fa-tasks hidden-xs"></i></span>
                        <i class="fa fa-tasks"></i><span class="hidden-xs span-font-size">Followups</span></a>
        </li>


</ul>