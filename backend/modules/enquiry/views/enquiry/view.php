<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\AdminPosts;
use common\models\AdminUsers;
use common\models\OutgoingNumbers;
use common\models\Hospital;

/* @var $this yii\web\View */
/* @var $model common\models\Enquiry */

$this->title = $model->enquiry_id;
$this->params['breadcrumbs'][] = ['label' => 'Enquiries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">
                                <?php echo Html::a('<i class="fa-th-list"></i><span> Manage Enquiry</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>

                                <div class="panel-body"><div class="enquiry-view">


                                                <div id="pdf">


                                                        <style type="text/css">

                                                                @media print {
                                                                        thead {display: table-header-group;}
                                                                        .table th{ background-color: rgba(155, 156, 157, 0.5);}
                                                                }
                                                                @page {
                                                                        size: A4;
                                                                }

                                                                @media screen{
                                                                        .main-tabl{
                                                                                width: 50%;
                                                                        }
                                                                }
                                                                .print{
                                                                        text-align: center;
                                                                        margin-top: 18px;
                                                                }

                                                                tfoot{display: table-footer-group;}
                                                                table { page-break-inside:auto;}
                                                                tr{ page-break-inside:avoid; page-break-after:auto; }

                                                                table.table{
                                                                        border: .1px solid #969696;
                                                                        border-collapse: collapse;
                                                                        margin: auto;
                                                                        color:#000;

                                                                }
                                                                .table th {
                                                                        border: 1px solid #969696;
                                                                        color: #525252;
                                                                        font-weight: bold;
                                                                }
                                                                .table td {
                                                                        border: .1px solid #969696;
                                                                        font-size: 12px;
                                                                        text-align: center;
                                                                        padding: 3px;
                                                                }
                                                                .header{
                                                                        font-size: 12.5px;
                                                                        display: inline-block;
                                                                        width: 100%;
                                                                }
                                                                .main-left{
                                                                        float: left;
                                                                }

                                                                .label_sty{
                                                                        float: left;
                                                                }
                                                                .data_sty{
                                                                        float: left;
                                                                        padding: 0px 18px;
                                                                        border-bottom: 1px solid black;
                                                                        font-weight: bold;
                                                                        margin-left: 10px;
                                                                        text-align: center;
                                                                        min-height: 30px;
                                                                }




                                                        </style>


                                                        <table class="main-tabl table table-responsive" border="0"  style="line-height:30px;">
                                                                <thead>
                                                                        <tr>
                                                                                <th style="width:100%">
                                                                                        <div class="header">
                                                                                                <div class="main-left">
                                                                                                        <img src="<?= Yii::$app->homeUrl ?>/images/logos/logo-collapsed.png" />

                                                                                                </div>
                                                                                                <div class="enqview_heading">
                                                                                                        <p>CARING PEOPLE</p>
                                                                                                        <p>CUSTOMER ENQUIRY CONTACT SHEET</p>
                                                                                                </div>
                                                                                                <br/>
                                                                                        </div>
                                                                                </th>
                                                                        </tr>

                                                                </thead>

                                                                <tbody>
                                                                        <tr>
                                                                                <td>
                                                                                        <div class="content info" style="text-align:right;">
                                                                                                <label><b>NO:<?= $model->enquiry_id; ?></b></label>
                                                                                        </div>
                                                                                        <div class="content">
                                                                                                <div class="label_sty">
                                                                                                        <label>Contacted by:</label>
                                                                                                </div>
                                                                                                <div class="data_sty">
                                                                                                        <span><?php
                                                                                                                if ($model->contacted_source == '0') {
                                                                                                                        echo 'Phone';
                                                                                                                } elseif ($model->contacted_source == '1') {
                                                                                                                        echo 'Email';
                                                                                                                } elseif ($model->contacted_source == '2') {
                                                                                                                        echo 'Other';
                                                                                                                }
                                                                                                                ?></span>
                                                                                                </div>

                                                                                                <div class="label_sty"><label>Date:</label></div><div class="data_sty" style="width: 110px;"><span><?= $date = date('d-m-Y', strtotime($model->contacted_date)); ?></span></div>
                                                                                                <div class="label_sty"><label>Time:</label></div><div class="data_sty"><span><?= $time = date('H:i', strtotime($model->contacted_date)); ?></span></div>
                                                                                                <div class="label_sty"><label><?php
                                                                                                                if ($model->contacted_source == '0') {
                                                                                                                        echo 'Inocming Call Number:';
                                                                                                                } elseif ($model->contacted_source == '1') {
                                                                                                                        echo 'Email:';
                                                                                                                } elseif ($model->contacted_source == '2') {
                                                                                                                        echo 'Contacted Source Others:';
                                                                                                                }
                                                                                                                ?></label></div><div class="data_sty" style="width:126px;"><span><?= $model->incoming_missed; ?></span></div>

                                                                                        </div>

                                                                                        <div style="clear:both"></div>

                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>Outgoing Call from:</label></div>
                                                                                                <div class="data_sty" style="width:200px;"><span>
                                                                                                                <?php
                                                                                                                $outgoing_number = OutgoingNumbers::findOne($model->outgoing_number_from);
                                                                                                                echo $outgoing_number->phone_number;
                                                                                                                ?>
                                                                                                        </span>
                                                                                                </div>
                                                                                                <div class="label_sty"><label>Date:</label></div><div class="data_sty" style="width:135px;"><span><?= date('d-m-Y', strtotime($model->outgoing_call_date)); ?></span></div>
                                                                                                <div class="label_sty"><label>Time:</label></div><div class="data_sty" style="width:144px;"><span><?= date('H:i', strtotime($model->outgoing_call_date)); ?></span></div>
                                                                                        </div>

                                                                                        <div style="clear:both"></div>

                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>Name of caller:</label></div><div class="data_sty" style="width:395px;"><span><?= $model->caller_name; ?></span></div>
                                                                                                <div class="label_sty"><label>Gender:</label></div><div class="data_sty" style="width:131px;"><span><?php
                                                                                                                if ($model->caller_gender == '0') {
                                                                                                                        echo 'Male';
                                                                                                                } elseif ($model->caller_gender == '1') {
                                                                                                                        echo 'Female';
                                                                                                                }
                                                                                                                ?></span></div>

                                                                                        </div>

                                                                                        <div style="clear:both"></div>

                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>Referral source:</label></div><div class="data_sty" style="width:572px;"><span><?= $model->referral_source; ?></span></div>
                                                                                        </div>

                                                                                        <div style="clear:both"></div>

                                                                                        <div class="content">

                                                                                                <div class="label_sty"><label>Mobile:</label></div><div class="data_sty" style="width:165px;"><span><?= $model->mobile_number; ?></span></div>
                                                                                                <div class="label_sty"><label>Mobile 2:</label></div><div class="data_sty" style="width:165px;"><span><?= $model->mobile_number_2; ?></span></div>
                                                                                                <div class="label_sty"><label>Mobile 3:</label></div><div class="data_sty" style="width:174px;"><span><?= $model->mobile_number_3; ?></span></div>
                                                                                        </div>

                                                                                        <div style="clear:both"></div>


                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>Address:</label></div><div class="data_sty" style="width:612px;"><span><?= $model->address; ?></span> </div>

                                                                                        </div>

                                                                                        <div style="clear:both"></div>


                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>City:</label></div><div class="data_sty" style="width:160px;"><span><?= $model->city; ?></span> </div>
                                                                                                <div class="label_sty"><label>Zip/PC:</label></div><div class="data_sty" style="width:150px;"><span><?= $model->zip_pc; ?></span> </div>
                                                                                                <div class="label_sty"><label>Email:</label></div><div class="data_sty" style="width:230px;"><span><?= $model->email; ?></span> </div>

                                                                                        </div>

                                                                                        <div style="clear:both"></div>

                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>Name of person requiring service:</label></div><div class="data_sty" style="width:290px;"><span><?= $model->service_required_for; ?></span></div>
                                                                                                <div class="label_sty"><label>Gender:</label></div><div class="data_sty" ><span><?php
                                                                                                                if ($model->person_gender == '0') {
                                                                                                                        echo 'Male';
                                                                                                                } elseif ($model->person_gender == '1') {
                                                                                                                        echo 'Female';
                                                                                                                }
                                                                                                                ?></span></div>
                                                                                                <div class="label_sty"><label>Age:</label></div><div class="data_sty" ><span><?= $model->age; ?></span></div>

                                                                                        </div>
                                                                                        <div style="clear:both"></div>

                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>Weight:</label></div><div class="data_sty" style="width: 98px;"><span><?= $model->weight; ?></span> </div>
                                                                                                <div class="label_sty"><label>Relationship:</label></div><div class="data_sty" style="width: 280px;"><span><?php
                                                                                                                if ($model->relationship != '3') {
                                                                                                                        if ($model->relationship == '0') {
                                                                                                                                echo 'Spouse';
                                                                                                                        } elseif ($model->relationship == '1') {
                                                                                                                                echo 'Parent';
                                                                                                                        } elseif ($model->relationship == '2') {
                                                                                                                                echo 'Grandparent';
                                                                                                                        } elseif ($model->relationship == '3') {
                                                                                                                                echo 'Other';
                                                                                                                        }
                                                                                                                } else {
                                                                                                                        echo $model->service_required_for_others;
                                                                                                                }
                                                                                                                ?></span> </div>
                                                                                                <div class="label_sty"><label>Veteran or Spouse:</label></div><div class="data_sty"><span><?php
                                                                                                                if ($model->veteran_or_spouse == '1') {
                                                                                                                        echo 'Yes';
                                                                                                                } elseif ($model->veteran_or_spouse == '0') {
                                                                                                                        echo 'No';
                                                                                                                }
                                                                                                                ?></span> </div>

                                                                                        </div>

                                                                                        <div style="clear:both"></div>

                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>Person Address:</label></div><div class="data_sty" style="width:575px;"><span><?= $model->person_address; ?></span> </div>

                                                                                        </div>

                                                                                        <div style="clear:both"></div>

                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>Person City:</label></div><div class="data_sty" style="width:140px;"><span><?= $model->person_city; ?></span> </div>
                                                                                                <div class="label_sty"><label>Person Postal Code:</label></div><div class="data_sty" style="width:100px;"><span><?= $model->person_postal_code; ?></span> </div>
                                                                                                <div class="label_sty"><label>Whatsapp Reply:</label></div><div class="data_sty" style="width:135px;"><span>
                                                                                                                <?php
                                                                                                                if ($model->whatsapp_reply == '0') {
                                                                                                                        echo 'No';
                                                                                                                } elseif ($model->whatsapp_reply == '1') {
                                                                                                                        echo 'Yes' . $model->whatsapp_number;
                                                                                                                }
                                                                                                                ?></span> </div>

                                                                                        </div>

                                                                                        <div style="clear:both"></div>

                                                                                        <?php if ($model->patient_current_status != '') { ?>
                                                                                                <div class="label_sty"><label>Patient Current Status:</label></div><div class="data_sty" style="width:545px;"><span>
                                                                                                                <?php
                                                                                                                if ($model->patient_current_status == '1') {
                                                                                                                        echo 'Independent';
                                                                                                                } elseif ($model->patient_current_status == '2') {
                                                                                                                        echo 'Bedridden';
                                                                                                                } elseif ($model->patient_current_status == '3') {
                                                                                                                        echo 'assistance required 1';
                                                                                                                } elseif ($model->patient_current_status == '4') {
                                                                                                                        echo 'assistance required 2';
                                                                                                                }
                                                                                                                ?></span> </div>
                                                                                        <?php } ?>

                                                                                        <?php if ($model->notes != '') { ?>
                                                                                                <div style="clear:both"></div>
                                                                                                <div class="content">
                                                                                                        <div class="label_sty"><label>Notes:</label><span style="border-bottom:1px solid black;padding:6px;font-weight: bold;"><?= $model->notes; ?></span></div>
                                                                                                </div>
                                                                                        <?php } ?>

                                                                                        <div style="clear:both"></div>

                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>Hospital:</label></div><div class="data_sty" style="width:200px;"><span>
                                                                                                                <?php
                                                                                                                $hospital_name = Hospital::findOne($hospital_info->hospital_name);
                                                                                                                echo $hospital_name->hospital_name;
                                                                                                                ?>
                                                                                                        </span> </div>
                                                                                                <div class="label_sty"><label>Room No:</label></div><div class="data_sty" style="width: 65px;"><span><?= $hospital_info->hospital_room_no; ?></span> </div>
                                                                                                <div class="label_sty"><label>Consultant Doctor:</label></div><div class="data_sty" style="width:180px;"><span><?= $hospital_info->consultant_doctor; ?></span> </div>
                                                                                        </div>

                                                                                        <div style="clear:both"></div>

                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>Department:</label></div><div class="data_sty" style="width: 265px;"><span><?= $hospital_info->department; ?></span> </div>
                                                                                                <div class="label_sty"><label>Hypertension </label></div><div class="data_sty" style="width:100px;"><span><?= $hospital_info->hypertension; ?></span></div>
                                                                                                <div class="label_sty"><label>Feeding Tube:</label></div><div class="data_sty" style="width: 60px;"><span><?= $hospital_info->feeding; ?></span> </div>
                                                                                        </div>

                                                                                        <div style="clear:both"></div>

                                                                                        <div class="content">

                                                                                                <div class="label_sty"><label>Urine Tube:</label></div><div class="data_sty" style="width: 70px;"><span><?= $hospital_info->urine; ?></span> </div>
                                                                                                <div class="label_sty"><label>Oxygen </label></div><div class="data_sty" style="width:70px;"><span><?= $hospital_info->oxygen; ?></span></div>
                                                                                                <div class="label_sty"><label>Tracheostomy </label></div><div class="data_sty" style="width:70px;"><span><?= $hospital_info->tracheostomy; ?></span></div>
                                                                                                <div class="label_sty"><label>IV LINE:</label></div><div class="data_sty" style="width: 70px;"><span><?= $hospital_info->iv_line; ?></span> </div>
                                                                                                <div class="label_sty"><label>Diabetic:</label></div><div class="data_sty" style="width: 70px;"><span>
                                                                                                                <?php
                                                                                                                if ($hospital_info->diabetic == '0') {
                                                                                                                        echo 'No';
                                                                                                                } elseif ($hospital_info->diabetic == '1') {
                                                                                                                        echo 'Yes';
                                                                                                                }
                                                                                                                ?>
                                                                                                        </span> </div>
                                                                                        </div>


                                                                                        <?php if ($hospital_info->diabetic == '1') { ?>
                                                                                                <div style="clear:both"></div>
                                                                                                <div class="content">
                                                                                                        <div class="label_sty"><label>Diabetic Notes:</label></div><div class="data_sty" ><span><?= $hospital_info->diabetic_note; ?></span> </div>
                                                                                                </div>
                                                                                        <?php } ?>

                                                                                        <div style="clear:both"></div>

                                                                                        <div class="content">

                                                                                                <div class="label_sty"><label>Visit type:</label></div><div class="data_sty" style="width: 120px;"><span>
                                                                                                                <?php
                                                                                                                if ($hospital_info->visit_type == '0') {
                                                                                                                        echo 'Home Visit';
                                                                                                                } elseif ($hospital_info->visit_type == '1') {
                                                                                                                        echo 'Hospital Visit';
                                                                                                                }
                                                                                                                ?>
                                                                                                        </span> </div>
                                                                                                <div class="label_sty"><label>Visit Time</label></div><div class="data_sty" style="width:135px"><span><?= $date = date('d-m-Y H:i', strtotime($hospital_info->visit_date)); ?></span></div>
                                                                                                <div class="label_sty"><label>Visit Note</label></div><div class="data_sty" style="width:230px"><span><?= $hospital_info->visit_note; ?></span></div>

                                                                                        </div>

                                                                                        <?php if ($hospital_info->bedridden != '') { ?>
                                                                                                <div style="clear:both"></div>
                                                                                                <div class="content">
                                                                                                        <div class="label_sty"><label>Notes:</label><span style="border-bottom:1px solid black;padding:6px;font-weight: bold;"><?= $hospital_info->bedridden; ?></span> </div>
                                                                                                </div>
                                                                                        <?php } ?>

                                                                                        <div style="clear:both"></div>
                                                                                        <?php if ($other_info->family_support != '') { ?>
                                                                                                <div class="content">
                                                                                                        <div class="label_sty"><label>Nearyby family support:</label></div><div class="data_sty"><span><?php
                                                                                                                        if ($other_info->family_support == '1') {
                                                                                                                                echo 'Close';
                                                                                                                        } elseif ($other_info->family_support == '2') {
                                                                                                                                echo 'Distant';
                                                                                                                        } elseif ($other_info->family_support == '3') {
                                                                                                                                echo 'None';
                                                                                                                        }
                                                                                                                        ?></span> </div>

                                                                                                </div>
                                                                                        <?php } ?>

                                                                                        <div style="clear:both"></div>

                                                                                        <?php if ($other_info->family_support_note != '') { ?>
                                                                                                <div class="content">
                                                                                                        <div class="label_sty" ><label>Nearyby family support Note: </label><span style="border-bottom:1px solid black;padding:6px;font-weight: bold;"><?= $other_info->family_support_note; ?></span></div>
                                                                                                </div>
                                                                                        <?php } ?>

                                                                                        <div style="clear:both"></div>

                                                                                        <?php if ($other_info->care_currently_provided != '4' && $other_info->care_currently_provided != '') { ?>
                                                                                                <div class="content">

                                                                                                        <div class="label_sty"><label>Care currently being provided:</label></div><div class="data_sty"><span><?php
                                                                                                                        if ($other_info->care_currently_provided == '1') {
                                                                                                                                echo 'Family';
                                                                                                                        } elseif ($other_info->care_currently_provided == '2') {
                                                                                                                                echo 'Friends';
                                                                                                                        } elseif ($other_info->care_currently_provided == '3') {
                                                                                                                                echo 'Hospital';
                                                                                                                        } elseif ($other_info->care_currently_provided == '4') {
                                                                                                                                echo 'Others';
                                                                                                                        }
                                                                                                                        ?></span> </div>
                                                                                                        <?php if ($other_info->care_currently_provided == '3') { ?>       <div class="label_sty"><label>Expected Date Of Discharge</label></div><div class="data_sty" style="width:230px"><span><?= $date = date('d-m-Y', strtotime($other_info->date_of_discharge)); ?></span></div><?php } ?>


                                                                                                </div>
                                                                                                <?php
                                                                                        } else {
                                                                                                if ($other_info->care_currently_provided_others != '') {
                                                                                                        ?>
                                                                                                        <div class="content">
                                                                                                                <div class="label_sty"><label>Care currently being provided:</label><span style="border-bottom:1px solid black;padding:6px;font-weight: bold;"> <?= $other_info->care_currently_provided_others; ?></span></div>
                                                                                                        </div>
                                                                                                        <?php
                                                                                                }
                                                                                        }
                                                                                        ?>
                                                                                        <?php if ($other_info->details_of_current_care != '') { ?>
                                                                                                <div class="content">
                                                                                                        <div class="label_sty"><label>Details Of Current Care:</label><span style="border-bottom:1px solid black;padding:6px;font-weight: bold;"> <?= $other_info->details_of_current_care; ?></span></div>
                                                                                                </div>
                                                                                        <?php } ?>



                                                                                        <?php if ($other_info->difficulty_in_movement != '5' && $other_info->difficulty_in_movement != '') { ?>

                                                                                                <div class="content">
                                                                                                        <div class="label_sty"><label>Difficulty in movement:</label></div><div class="data_sty" style="width:120px;"><span>
                                                                                                                        <?php
                                                                                                                        if ($other_info->difficulty_in_movement == '1') {
                                                                                                                                echo 'No difficulty';
                                                                                                                        } elseif ($other_info->difficulty_in_movement == '2') {
                                                                                                                                echo 'Assistance required';
                                                                                                                        } elseif ($other_info->difficulty_in_movement == '3') {
                                                                                                                                echo 'Wheelchair';
                                                                                                                        } elseif ($other_info->difficulty_in_movement == '4') {
                                                                                                                                echo 'Bedridden';
                                                                                                                        } elseif ($other_info->difficulty_in_movement == '5') {
                                                                                                                                echo 'Other';
                                                                                                                        }
                                                                                                                        ?></span> </div>
                                                                                                </div>

                                                                                                <?php
                                                                                        } else {
                                                                                                if ($other_info->difficulty_in_movement_other != '') {
                                                                                                        ?>
                                                                                                        <div class="content">
                                                                                                                <div class="label_sty"><label>Difficulty in movement:</label><span style="border-bottom:1px solid black;padding:6px;font-weight: bold;"> <?= $other_info->difficulty_in_movement_other; ?></span></div>
                                                                                                        </div>
                                                                                                        <?php
                                                                                                }
                                                                                        }
                                                                                        ?>


                                                                                        <div style="clear:both"></div>

                                                                                        <?php if ($other_info->service_required != '5' && $other_info->service_required != '') { ?>
                                                                                                <div class="content">
                                                                                                        <div class="label_sty"><label>Service Required:</label></div><div class="data_sty"><span>
                                                                                                                        <?php
                                                                                                                        if ($other_info->service_required == '1') {
                                                                                                                                echo 'Immediately';
                                                                                                                        } elseif ($other_info->service_required == '2') {
                                                                                                                                echo 'Couple weeks';
                                                                                                                        } elseif ($other_info->service_required == '3') {
                                                                                                                                echo 'Month';
                                                                                                                        } elseif ($other_info->service_required == '4') {
                                                                                                                                echo 'Unsure';
                                                                                                                        } elseif ($other_info->service_required == '5') {
                                                                                                                                echo 'Other';
                                                                                                                        }
                                                                                                                        ?></span> </div>
                                                                                                </div>
                                                                                                <?php
                                                                                        } else {
                                                                                                if ($other_info->service_required_other != '') {
                                                                                                        ?>
                                                                                                        <div class="content">
                                                                                                                <div class="label_sty"><label>Service Required:</label><span style="border-bottom:1px solid black;padding:6px;font-weight: bold"> <?= $other_info->service_required_other; ?></span></div>
                                                                                                        </div>
                                                                                                        <?php
                                                                                                }
                                                                                        }
                                                                                        ?>
                                                                                        </div>
                                                                                        <div style="clear:both"></div>
                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>Expected Date Of Service Needed:</label></div><div class="data_sty" ><span> <?= $date = date('d-m-Y', strtotime($other_info->date_of_discharge)); ?></span></div>
                                                                                                <div class="label_sty"><label>How Long Service Required:</label></div><div class="data_sty" style="width:200px;"><span> <?= $other_info->how_long_service_required; ?></span></div>



                                                                                        </div>

                                                                                        <div style="clear:both"></div>
                                                                                        <div class="content">
                                                                                                <div class="label_sty"><label>Nursing Assessment:</label></div><div class="data_sty" style="width:120px;"><span> <?= $date = date('d-m-Y', strtotime($other_info->nursing_assessment)); ?></span></div>
                                                                                                <div class="label_sty"><label>Doctor Assessment:</label></div><div class="data_sty" style="width:120px;"><span> <?= $date = date('d-m-Y', strtotime($other_info->doctor_assessment)); ?></span></div>
                                                                                                <div class="label_sty"><label>Priority:</label></div><div class="data_sty" style="width:120px;"><span> <?php
                                                                                                                if ($other_info->priority == '1') {
                                                                                                                        echo 'Hot';
                                                                                                                } elseif ($other_info->priority == '2') {
                                                                                                                        echo 'Warm';
                                                                                                                } elseif ($other_info->priority == '3') {
                                                                                                                        echo 'Cold';
                                                                                                                }
                                                                                                                ?></span></div>
                                                                                        </div>

                                                                                        <?php if ($other_info->follow_up_notes != '') { ?>
                                                                                                <div style="clear:both"></div>
                                                                                                <div class="content">
                                                                                                        <div class="label_sty"><label>Followup Notes:</label><span style="border-bottom:1px solid black;padding:6px;font-weight: bold;"><?= $other_info->follow_up_notes; ?></span> </div>
                                                                                                </div>
                                                                                        <?php } ?>

                                                                                        <?php if ($other_info->quotation_details != '') { ?>
                                                                                                <div style="clear:both"></div>
                                                                                                <div class="content">
                                                                                                        <div class="label_sty"><label>Quotation Details:</label><span style="border-bottom:1px solid black;padding:6px;font-weight: bold;"><?= $other_info->quotation_details; ?></span></div>
                                                                                                </div>
                                                                                        <?php } ?>

                                                                                        <div class="content">

                                                                                                <div class="label_sty"><label>Followup date:</label></div><div class="data_sty" style="width:180px;"><span> <?= $date = date('d-m-Y H:i', strtotime($other_info->followup_date)); ?></span></div>


                                                                                        </div>

                                                                                </td>

                                                                        </tr>





                                                                </tbody>


                                                        </table>
                                                </div>
                                                <!--</body>-->


                                                <script>
                                                        function printContent(el) {
                                                                var restorepage = document.body.innerHTML;
                                                                var printcontent = document.getElementById(el).innerHTML;
                                                                document.body.innerHTML = printcontent;
                                                                window.print();
                                                                document.body.innerHTML = restorepage;
                                                        }
                                                </script>

                                                <!--</html>-->
                                                <div class="print">
                                                        <button onclick="printContent('pdf')" style="font-weight: bold !important;">Print</button>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>


