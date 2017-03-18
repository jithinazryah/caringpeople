<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\AdminPosts;
use common\models\AdminUsers;

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
                                                <p>
                                                        <?php //echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                                                        <?php
                                                        //echo
                                                        Html::a('Delete', ['delete', 'id' => $model->id], [
                                                            'class' => 'btn btn-danger',
                                                            'data' => [
                                                                'confirm' => 'Are you sure you want to delete this item?',
                                                                'method' => 'post',
                                                            ],
                                                        ])
                                                        ?>
                                                </p>


                                                <style type="text/css">

                                                        @media print {
                                                                thead {display: table-header-group;}

                                                        }
                                                        @page {
                                                                size: A4;
                                                        }

                                                        @media screen{
                                                                .main-tabl{
                                                                        width: 60%;
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
                                                                border: .1px solid #969696;
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



                                                </style>
                                                <!--</head>-->
                                                <!--<body>-->
                                                <div>
                                                        <table class="main-tabl table" border="0" id="pdf" style="line-height:30px;">
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
                                                                                        <div class="content info">
                                                                                                <label>Contacted by:</label><span><?php
                                                                                                        if ($model->contacted_source == '0') {
                                                                                                                echo 'Phone';
                                                                                                        } elseif ($model->contacted_source == '1') {
                                                                                                                echo 'Email';
                                                                                                        } elseif ($model->contacted_source == '2') {
                                                                                                                echo 'Other';
                                                                                                        }
                                                                                                        ?></span>

                                                                                                <label>Date:</label><span><?= $date = date('d-m-Y', strtotime($model->contacted_date)); ?></span>
                                                                                                <label>Time:</label><span><?= $time = date('H:i', strtotime($model->contacted_date)); ?></span>


                                                                                        </div>

                                                                                        <div class="content info">
                                                                                                <label><?php
                                                                                                        if ($model->contacted_source == '0') {
                                                                                                                echo 'Inocming Call Number:';
                                                                                                        } elseif ($model->contacted_source == '1') {
                                                                                                                echo 'Email:';
                                                                                                        } elseif ($model->contacted_source == '2') {
                                                                                                                echo 'Contacted Source Others:';
                                                                                                        }
                                                                                                        ?></label><span><?= $model->incoming_missed; ?></span>
                                                                                        </div>

                                                                                        <div class="content info">
                                                                                                <label>Outgoing Call from:</label><span><?= $model->outgoing_number_from; ?></span>
                                                                                                <label>Date:</label><span><?= date('d-m-Y', strtotime($model->outgoing_call_date)); ?></span>
                                                                                                <label>Time:</label><span><?= date('H:i', strtotime($model->outgoing_call_date)); ?></span>
                                                                                        </div>

                                                                                        <div class="content info">
                                                                                                <label>Name of caller:</label><span><?= $model->caller_name; ?></span>
                                                                                                <label>Referral source:</label><span><?= $model->referral_source; ?></span>
                                                                                        </div>

                                                                                        <div class="content info">
                                                                                                <label>Mobile:</label><span><?= $model->mobile_number; ?></span>
                                                                                                <label>Mobile 2:</label><span><?= $model->mobile_number_2; ?></span>
                                                                                                <label>Mobile 3:</label><span><?= $model->mobile_number_3; ?></span>
                                                                                        </div>

                                                                                        <div class="content info">
                                                                                                <label>Address:</label><span><?= $model->address; ?></span>
                                                                                                <label>City:</label><span><?= $model->city; ?></span>
                                                                                                <label>Zip/PC:</label><span><?= $model->zip_pc; ?></span>
                                                                                        </div>

                                                                                        <div class="content info">
                                                                                                <label>Email:</label><span><?= $model->email; ?></span>
                                                                                        </div>
                                                                                        <div class="content info">
                                                                                                <label>Name of person requiring service:</label><span><?= $model->service_required_for; ?></span>
                                                                                                <label>Age:</label><span><?= $model->age; ?></span>
                                                                                                <label>Weight:</label><span><?= $model->weight; ?></span>
                                                                                        </div>

                                                                                        <div class="content info">
                                                                                                <label>Relationship:</label><span><?php
                                                                                                        if ($model->relationship == '0') {
                                                                                                                echo 'Spouse';
                                                                                                        } elseif ($model->relationship == '1') {
                                                                                                                echo 'Parent';
                                                                                                        } elseif ($model->relationship == '2') {
                                                                                                                echo 'Grandparent';
                                                                                                        } elseif ($model->relationship == '3') {
                                                                                                                echo 'Other';
                                                                                                        }
                                                                                                        ?></span>

                                                                                                <?php if ($model->service_required_for == '3') { ?> <label>Other:</label><span><?= $model->service_required_for_others; ?></span><?php } ?>
                                                                                                <label>Veteran or Spouse:</label><span><?php
                                                                                                        if ($model->veteran_or_spouse == '1') {
                                                                                                                echo 'Yes';
                                                                                                        } elseif ($model->veteran_or_spouse == '0') {
                                                                                                                echo 'No';
                                                                                                        }
                                                                                                        ?></span>
                                                                                        </div>
                                                                                        <div class="content info">
                                                                                                <label>Address:</label><span><?= $model->person_address; ?></span>
                                                                                                <label>City:</label><span><?= $model->person_city; ?></span>
                                                                                                <label>Postal Code:</label><span><?= $model->person_postal_code; ?></span>
                                                                                        </div>
                                                                                </td>

                                                                        </tr>

                                                                        <tr>
                                                                                <td>
                                                                                        <div class="content info">
                                                                                                <label>Hospital:</label><span><?= $hospital_info->hospital_name; ?></span>
                                                                                                <label>Consultant Doctor:</label><span><?= $hospital_info->consultant_doctor; ?></span>
                                                                                                <label>Hospital Room No:</label><span><?= $hospital_info->hospital_room_no; ?></span>
                                                                                        </div>

                                                                                        <div class="content info">
                                                                                                <label>Required Services:</label><span><?php
                                                                                                        if ($hospital_info->required_service == '1') {
                                                                                                                echo 'Doctor Visit';
                                                                                                        } elseif ($hospital_info->required_service == '2') {
                                                                                                                echo 'Nursing Care';
                                                                                                        } elseif ($hospital_info->required_service == '3') {
                                                                                                                echo 'Physiotherapy';
                                                                                                        } elseif ($hospital_info->required_service == '4') {
                                                                                                                echo 'Companion Care';
                                                                                                        } elseif ($hospital_info->required_service == '5') {
                                                                                                                echo 'Bystander Service';
                                                                                                        } elseif ($hospital_info->required_service == '6') {
                                                                                                                echo 'General Information';
                                                                                                        }
                                                                                                        ?></span>
                                                                                                <label>Other Service:</label><span><?= $hospital_info->other_services; ?></span>
                                                                                        </div>

                                                                                        <div class="content info">
                                                                                                <label><b>Current Client Situation</b></label>
                                                                                        </div>


                                                                                        <div class="content info">
                                                                                                <label>Diabetic </label><span><?= $hospital_info->diabetic; ?></span>
                                                                                                <label>Hypertension </label><span><?= $hospital_info->hypertension; ?></span>
                                                                                        </div>

                                                                                        <div class="content info">
                                                                                                <label>Tube's</label><span><?= $hospital_info->tubes; ?></span>
                                                                                                <label>Feeding</label><span><?= $hospital_info->feeding; ?></span>
                                                                                                <label>Urine</label><span><?= $hospital_info->urine; ?></span>
                                                                                                <label>Oxygen</label><span><?= $hospital_info->oxygen; ?></span>
                                                                                        </div>

                                                                                        <div class="content info">
                                                                                                <label>Tracheostomy</label><span><?= $hospital_info->tracheostomy; ?></span>
                                                                                                <label>IV LINE</label><span><?= $hospital_info->iv_line; ?></span>
                                                                                                <label>Dressing</label><span><?= $hospital_info->dressing; ?></span>
                                                                                        </div>

                                                                                        <div class="content info">
                                                                                                <label>Visit Type</label><span><?php
                                                                                                        if ($hospital_info->visit_type == '1') {
                                                                                                                echo 'Hospital Visit';
                                                                                                        } elseif ($hospital_info->visit_type == '0') {
                                                                                                                echo 'Home Visit';
                                                                                                        }
                                                                                                        ?></span>

                                                                                                <label>Date</label><span><?= $date = date('d-m-Y', strtotime($hospital_info->visit_date)); ?></span>
                                                                                                <label>Time</label><span><?= $date = date('H:i', strtotime($hospital_info->visit_date)); ?></span>
                                                                                        </div>
                                                                                        <div class="content info">
                                                                                                <label>Bedridden</label><span><?= $hospital_info->bedridden; ?></span>
                                                                                        </div>
                                                                                </td>
                                                                        </tr>

                                                                        <tr>
                                                                                <td>
                                                                                        <div class="content info">
                                                                                                <p style="page-break-before: always">&nbsp;</p>
                                                                                                <label>Nearyby family support</label><span><?php
                                                                                                        if ($other_info->family_support == '1') {
                                                                                                                echo 'Close';
                                                                                                        } elseif ($other_info->family_support == '2') {
                                                                                                                echo 'Distant';
                                                                                                        } elseif ($other_info->family_support == '3') {
                                                                                                                echo 'None';
                                                                                                        }
                                                                                                        ?></span>
                                                                                                <label>Nearyby family support note</label><span><?= $other_info->family_support_note; ?></span>
                                                                                        </div>

                                                                                        <div class="content info">
                                                                                                <label>Care currently being provided</label><span><?php
                                                                                                        if ($other_info->care_currently_provided == '1') {
                                                                                                                echo 'Family';
                                                                                                        } elseif ($other_info->care_currently_provided == '2') {
                                                                                                                echo 'Friends';
                                                                                                        } elseif ($other_info->care_currently_provided == '3') {
                                                                                                                echo 'provincial HC';
                                                                                                        } elseif ($other_info->care_currently_provided == '4') {
                                                                                                                echo 'Insurance';
                                                                                                        } elseif ($other_info->care_currently_provided == '5') {
                                                                                                                echo 'Private';
                                                                                                        } elseif ($other_info->care_currently_provided == '6') {
                                                                                                                echo 'VAC';
                                                                                                        }
                                                                                                        ?></span>
                                                                                                <label>Details of current care</label><span><?= $other_info->details_of_current_care; ?></span>
                                                                                        </div>

                                                                                        <div class="content info">
                                                                                                <label>Difficulty in movement</label><span><?php
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
                                                                                                        ?></span>
                                                                                                <?php if ($other_info->difficulty_in_movement == '5') { ?> <label>Difficulty in movement other</label><span><?= $other_info->difficulty_in_movement_other; ?></span><?php } ?>
                                                                                        </div>

                                                                                        <div class="content info">
                                                                                                <label>Service required</label><span><?php
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
                                                                                                        ?></span>
                                                                                                <?php if ($other_info->service_required == '5') { ?><label>Service required other</label><span><?= $other_info->service_required_other; ?></span><?php } ?>
                                                                                        </div>

                                                                                        <div class="content info">
                                                                                                <label>How long will service be required  </label><span><?= $other_info->how_long_service_required; ?></span>
                                                                                                <label>Nursing Assessment </label><span><?= $other_info->nursing_assessment; ?></span>
                                                                                                <label>Doctor Assessment </label><span><?= $other_info->doctor_assessment; ?></span>
                                                                                        </div>

                                                                                        <div class="content info">
                                                                                                <label>Follow up notes</label><span><?= $other_info->follow_up_notes; ?></span>
                                                                                        </div>

                                                                                        <div class="content info">
                                                                                                <label>Quotation Details</label><span><?= $other_info->quotation_details; ?></span>
                                                                                        </div>

                                                                                        <div class="content info">
                                                                                                <label>Priority</label><span><?php
                                                                                                        if ($other_info->priority == '1') {
                                                                                                                echo 'Hot';
                                                                                                        } elseif ($other_info->priority == '2') {
                                                                                                                echo 'Warm';
                                                                                                        } elseif ($other_info->priority == '3') {
                                                                                                                echo 'Cold';
                                                                                                        }
                                                                                                        ?></span>
                                                                                                <?php
                                                                                                $call_attended = AdminUsers::findOne($model->CB);
                                                                                                $designation = AdminPosts::findOne($call_attended->post_id);
                                                                                                ?>

                                                                                                <label>Call attended by</label><span><?= $call_attended->name; ?></span>
                                                                                                <label>Designation</label><span><?= $designation->post_name; ?></span>
                                                                                        </div>

                                                                                        <div class="content info">
                                                                                                <label>Followup Date</label><span><?= date('d-m-Y', strtotime($other_info->followup_date)); ?></span>
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


