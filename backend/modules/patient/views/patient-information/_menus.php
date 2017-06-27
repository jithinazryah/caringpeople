<?php

use yii\helpers\Html;
?>


<!--<ul class="nav nav-tabs nav-tabs-justified">
        <li class="active">
                <a href="#home-3" data-toggle="tab"><span class="visible-xs"><i class="fa-envelope-o"></i></span>
                        <span class="hidden-xs span-font-size">Patient Information</span></a>
        </li>

        <li>
                <a href="#profile-3" data-toggle="tab"><span class="visible-xs"><i class="fa-info-circle"></i></span>
                        <span class="hidden-xs span-font-size">Patient Chronic Info</span></a>
        </li>
        <li>
                <a href="#medication" data-toggle="tab"><span class="visible-xs"><i class="fa-info-circle"></i></span>
                        <span class="hidden-xs span-font-size">Present Medication</span></a>
        </li>
        <li>
                <a href="#condition" data-toggle="tab"><span class="visible-xs"><i class="fa-info-circle"></i></span>
                        <span class="hidden-xs span-font-size">Present Condition</span></a>
        </li>
        <li>
                <a href="#bystander" data-toggle="tab"><span class="visible-xs"><i class="fa-info-circle"></i></span>
                        <span class="hidden-xs span-font-size">Bystander Details</span></a>
        </li>

</ul>-->

<ul class="nav nav-tabs">
        <li class="active">
                <a href="#home-3" data-toggle="tab"><span class="visible-xs"><i class="fa-envelope-o hidden-xs"></i></span>
                        <i class="fa-envelope-o"></i><span class="hidden-xs span-font-size">  PATIENT INFORMATION</span></a>
        </li>

        <li>
                <a href="#profile-3" data-toggle="tab"><span class="visible-xs"><i class="fa-info hidden-xs"></i></span>
                        <i class="fa-info"></i> <span class="hidden-xs span-font-size"> PATIENT CHRONIC INFO</span></a>
        </li>

        <li>
                <a href="#medication" data-toggle="tab"><span class="visible-xs"><i class="fa-hospital-o hidden-xs"></i></span>
                        <i class="fa-hospital-o"></i> <span class="hidden-xs span-font-size"> PATIENT MEDICATION</span></a>
        </li>

        <li>
                <a href="#condition" data-toggle="tab"><span class="visible-xs"><i class="fa-info-circle hidden-xs"></i></span>
                        <i class="fa-info-circle"></i> <span class="hidden-xs span-font-size"> PRESENT CONDITION</span></a>
        </li>
        <li>
                <a href="#bystander" data-toggle="tab"><span class="visible-xs"><i class="fa fa-user hidden-xs"></i></span>
                        <i class="fa fa-user"></i> <span class="hidden-xs span-font-size"> BYSTANDER DETAILS</span></a>
        </li>
        <?php if (!$patient_info->isNewRecord) { ?>
                <li>
                        <a href="#profile-12" data-toggle="tab"><span class="visible-xs"><i class="linecons-note"></i></span>
                                <i class="linecons-note"></i> <span class="hidden-xs span-font-size"> REMARKS</span></a>
                </li>

                <li>
                        <a href="#profile-13" data-toggle="tab"><span class="visible-xs"><i class="fa fa-tasks" aria-hidden="true"></i></span>
                                <i class="fa fa-tasks" aria-hidden="true"></i> <span class="hidden-xs span-font-size"> FOLLOWUPS</span></a>
                </li>
        <?php } ?>


</ul>


