<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Religion;
use common\models\Caste;
use common\models\Nationality;

/* @var $this yii\web\View */
/* @var $model common\models\StaffInfo */

$this->title = $staff_info->staff_name;
$this->params['breadcrumbs'][] = ['label' => 'Staff Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                        </div>
                        <div class="panel-body">
                                <?= Html::a('<i class="fa-th-list"></i><span> Manage Staff</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>

                                <div class="panel-body"><div class="staff-info-view">
                                                <div id="pdf" class="table-responsive">


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
                                                                                width: 42%;
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
                                                                        /* border: .1px solid #969696;*/
                                                                        border-collapse: collapse;
                                                                        margin: auto;
                                                                        color:#000;

                                                                }
                                                                .table th {
                                                                        border: .1px solid #969696;
                                                                        color: #525252;
                                                                        font-weight: bold;
                                                                        background-color: #fff !important;
                                                                }
                                                                .table td {
                                                                        border: 1px solid #969696;
                                                                        font-size: 12px;
                                                                        text-align: center;
                                                                        padding: 3px;
                                                                }
                                                                .table1 td{
                                                                        border: 0px solid #969696;

                                                                }
                                                                .table p{
                                                                        color:#000;
                                                                        font-size: 12px;
                                                                        font-weight: normal;
                                                                }
                                                                .header{
                                                                        font-size: 12.5px;
                                                                        display: inline-block;
                                                                        width: 100%;
                                                                        height: 110px;
                                                                }
                                                                .main-left{
                                                                        float: left;
                                                                        font-size: 13px;
                                                                }
                                                                .heading{
                                                                        font-size: 16px;
                                                                        font-weight: bold;
                                                                }
                                                                .label_sty{
                                                                        float: left;
                                                                        font-size:14px;
                                                                }
                                                                .data_sty{
                                                                        float: left;
                                                                        padding: 0px 18px;
                                                                        border-bottom: 1px dotted black;
                                                                        font-weight: bold;
                                                                        margin-left: 10px;
                                                                        text-align: center;
                                                                        min-height: 30px;
                                                                }
                                                                .education .label_sty{
                                                                        text-align: center;
                                                                }
                                                                .break { page-break-before: always; }






                                                        </style>

                                                        <table class="main-tabl table table-responsive" border="0"  style="line-height:30px;">

                                                                <tr>
                                                                        <td>
                                                                                <table class="table1">
                                                                                        <tr>
                                                                                                <td>
                                                                                                        <div class="main-left">
                                                                                                                <img src="<?= Yii::$app->homeUrl ?>/images/logos/logo-1.png" style="width:250px;"/>
                                                                                                        </div>
                                                                                                </td>

                                                                                                <td>
                                                                                                        <div class="main-left" style="width:225px;margin-left: 25px;text-align: justify;">
                                                                                                                Door No.5 DD Vyapar Bhavan <br>
                                                                                                                K.P Vallon Road, Kavandthra Jn<br>
                                                                                                                <b>Koohi-20 | </b>Tel:0484 4033505<br>

                                                                                                        </div>
                                                                                                </td>

                                                                                                <td>
                                                                                                        <div class="main-left" style="width:230px;text-align: right;">
                                                                                                                Shop No 16, Brindavan Co-op Housing <br>
                                                                                                                Evershine Nagar, Malad West<br>
                                                                                                                <b>Mumbai -40064 |</b> Tel:022 40 111 351<br>

                                                                                                        </div>
                                                                                                </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                                <td></td>
                                                                                                <td colspan="2">
                                                                                                        <div class="main-left" style="margin-left:25px;">
                                                                                                                www.caringpeople.in <b>|</b> Email :info@caringpeople.in <b>|</b> Helpline No: 90 20 599 599
                                                                                                        </div>

                                                                                                </td>
                                                                                        </tr>
                                                                                </table>
                                                                        </td>


                                                                </tr>



                                                                <tbody>

                                                                        <tr>
                                                                                <td style="padding-top:25px;">
                                                                                        <div class="heading">APPLICATION FORM FOR STAFF</div>
                                                                                </td>
                                                                        </tr>



                                                                        <tr>
                                                                                <td>
                                                                                        <table class="table1" style="border:0px sloid #000;">



                                                                                                <tr>
                                                                                                        <td colspan="3">
                                                                                                                <div class="profile_image" style="float:right;">
                                                                                                                        <?php if ($staff_uploads->profile_image_type != '') { ?>
                                                                                                                                <img src="<?= Yii::$app->homeUrl . '../uploads/staff/' . $staff_info->id . '/profile_image_type.' . $staff_uploads->profile_image_type; ?> " style="width:115px;height:115px;"/>
                                                                                                                                <?php
                                                                                                                        } else {
                                                                                                                                if ($staff_info->gender == '0') {
                                                                                                                                        ?>
                                                                                                                                        <img src="<?= Yii::$app->homeUrl ?>images/themes/photo.png" style="width:115px;height:115px;"/>
                                                                                                                                        <?php
                                                                                                                                } elseif ($staff_info->gender == '1') {
                                                                                                                                        ?>
                                                                                                                                        <img src="<?= Yii::$app->homeUrl ?>images/themes/female.png" style="width:115px;height:115px;"/>

                                                                                                                                        <?php
                                                                                                                                }
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                </tr>


                                                                                                <tr>
                                                                                                        <td colspan="3">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty">
                                                                                                                                Name of the applicant :
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:595px;">
                                                                                                                                <?= $staff_info->staff_name; ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty">
                                                                                                                                Gender :
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:170px">
                                                                                                                                <?php
                                                                                                                                if ($staff_info->gender == '0') {
                                                                                                                                        echo 'Male';
                                                                                                                                } elseif ($staff_info->gender == '1') {
                                                                                                                                        echo 'Female';
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                        <?php
                                                                                                        if (isset($staff_info->dob) && $staff_info->dob != '0000-00-00') {
                                                                                                                $datee = date('d-m-Y', strtotime($staff_info->dob));
                                                                                                                $age = date_diff(date_create($datee), date_create('today'))->y;
                                                                                                        }
                                                                                                        ?>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty">
                                                                                                                                DOB :
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:170px">
                                                                                                                                <?= $date = date('d-m-Y', strtotime($staff_info->dob)); ?>
                                                                                                                                <?php
                                                                                                                                if (isset($age)) {
                                                                                                                                        echo '(' . $age . ')';
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty">
                                                                                                                                Blood Group :
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:170px">
                                                                                                                                <?= $date = $staff_info->blood_group; ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty">
                                                                                                                                Religion :
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:170px">
                                                                                                                                <?php
                                                                                                                                if (isset($staff_info->religion)) {
                                                                                                                                        $religion = Religion::findOne($staff_info->religion);
                                                                                                                                        echo $religion->religion;
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty">
                                                                                                                                Caste :
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:170px">
                                                                                                                                <?php
                                                                                                                                if (isset($staff_info->caste)) {
                                                                                                                                        $caste = Caste::findOne($staff_info->caste);
                                                                                                                                        echo $caste->caste;
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty">
                                                                                                                                Nationality :
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:185px">
                                                                                                                                <?php
                                                                                                                                if (isset($staff_info->nationality)) {
                                                                                                                                        $nationality = Nationality::findOne($staff_info->nationality);
                                                                                                                                        echo $nationality->nationality;
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td colspan="3">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty">
                                                                                                                                Pan card/Adhar card No :
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:580px;">
                                                                                                                                <?= $staff_info->pan_or_adhar_no; ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>



                                                                                        </table>
                                                                                </td>
                                                                        </tr>


                                                                        <tr>
                                                                                <td>
                                                                                        <table class="table1">
                                                                                                <tr>
                                                                                                        <td style="padding-top:20px;">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width:325px;font-weight: bold;">
                                                                                                                                Permanent Address (Residence) :
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td style="padding-top:20px;">
                                                                                                                <div class="content" style="width:320px;font-weight: bold;margin-left: 30px;">
                                                                                                                        <div class="label_sty">
                                                                                                                                Present Address :
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="label_sty">
                                                                                                                </div>

                                                                                                                <div class="data_sty" style="width:355px;margin-left: 2px;">
                                                                                                                        <?= $staff_info->permanent_address; ?>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="label_sty">
                                                                                                                </div>

                                                                                                                <div class="data_sty" style="width:350px;margin-left: 30px;">
                                                                                                                        <?= $staff_info->present_address; ?>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="label_sty">
                                                                                                                        Pincode :
                                                                                                                </div>

                                                                                                                <div class="data_sty" style="width:290px">
                                                                                                                        <?= $staff_info->pincode; ?>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="label_sty" style="margin-left: 30px;">
                                                                                                                        Pincode :
                                                                                                                </div>

                                                                                                                <div class="data_sty" style="width:280px">
                                                                                                                        <?= $staff_info->present_pincode; ?>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="label_sty">
                                                                                                                        Contact No :
                                                                                                                </div>

                                                                                                                <div class="data_sty" style="width:270px">
                                                                                                                        <?= $staff_info->contact_no; ?>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="label_sty" style="margin-left: 30px;">
                                                                                                                        Contact No :
                                                                                                                </div>

                                                                                                                <div class="data_sty" style="width:261px">
                                                                                                                        <?= $staff_info->present_contact_no; ?>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="label_sty">
                                                                                                                        Email :
                                                                                                                </div>

                                                                                                                <div class="data_sty" style="width:305px;"><?= $staff_info->email; ?></div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="label_sty" style="margin-left: 30px;">
                                                                                                                        Email :
                                                                                                                </div>

                                                                                                                <div class="data_sty" style="width:295px"><?= $staff_info->present_email; ?></div>
                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="label_sty">
                                                                                                                        Total years of experiences :
                                                                                                                </div>

                                                                                                                <div class="data_sty" style="width:175px;">
                                                                                                                        <?= $staff_info->years_of_experience; ?>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="label_sty">
                                                                                                                        Driving License :
                                                                                                                </div>

                                                                                                                <div class="data_sty" style="width:240px">
                                                                                                                        <?php
                                                                                                                        if ($staff_info->driving_licence == '0') {
                                                                                                                                echo 'No';
                                                                                                                        } elseif ($staff_info->driving_licence == '1') {
                                                                                                                                echo 'Motor Cycle & LMV';
                                                                                                                        } elseif ($staff_info->driving_licence == '2') {
                                                                                                                                echo 'Motor Cycle';
                                                                                                                        } elseif ($staff_info->driving_licence == '3') {
                                                                                                                                echo 'LMV';
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="label_sty" style="margin-left:30px;">
                                                                                                                        License No :
                                                                                                                </div>

                                                                                                                <div class="data_sty" style="width:260px">
                                                                                                                        <?= $staff_info->licence_no; ?>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>
                                                                                        </table>
                                                                                </td>
                                                                        </tr>

                                                                        <tr>
                                                                                <td style="padding-top:25px;">
                                                                                        <table class="table1">
                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="font-weight: bold;width: 100px;">
                                                                                                                                Qualification
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content education" >
                                                                                                                        <div class="label_sty" style="font-weight: bold;width: 220px;">
                                                                                                                                Name of the institution
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty" style="font-size: 12px;font-weight: bold;width: 100px;">
                                                                                                                                Year of passing
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content education" >
                                                                                                                        <div class="label_sty" style="font-weight: bold;width: 200px;">
                                                                                                                                Place
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 100px;">
                                                                                                                                SSSLC
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="data_sty" style="font-weight: bold;width: 220px;">
                                                                                                                                <?= $staff_edu->sslc_institution; ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="data_sty" style="font-weight: bold;width: 100px;">
                                                                                                                                <?= $staff_edu->sslc_year_of_passing; ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="data_sty"  style="font-weight: bold;width: 200px;">
                                                                                                                                <?= $staff_edu->sslc_place; ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 100px;">
                                                                                                                                HSE
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="data_sty" style="font-weight: bold;width: 220px;">
                                                                                                                                <?= $staff_edu->hse_institution; ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="data_sty" style="font-weight: bold;width: 100px;">
                                                                                                                                <?= $staff_edu->hse_year_of_passing; ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="data_sty"  style="font-weight: bold;width: 200px;">
                                                                                                                                <?= $staff_edu->hse_place; ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 100px;">
                                                                                                                                Nursing
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="data_sty" style="font-weight: bold;width: 220px;">
                                                                                                                                <?= $staff_edu->nursing_institution; ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="data_sty" style="font-weight: bold;width: 100px;">
                                                                                                                                <?= $staff_edu->nursing_year_of_passing; ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="data_sty"  style="font-weight: bold;width: 200px;">
                                                                                                                                <?= $staff_edu->nursing_place; ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 150px;">
                                                                                                                                Tiiming
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="data_sty"  style="font-weight: bold;width: 220px;">
                                                                                                                                <?php
                                                                                                                                if ($staff_edu->timing == '0') {
                                                                                                                                        echo 'Part Time';
                                                                                                                                } elseif ($staff_edu->timing == '1') {
                                                                                                                                        echo 'Full Time';
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 150px;">
                                                                                                                                Uniform provided
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="data_sty"  style="font-weight: bold;width: 195px;">
                                                                                                                                <?php
                                                                                                                                if ($staff_edu->uniform == '0') {
                                                                                                                                        echo 'No';
                                                                                                                                } elseif ($staff_edu->uniform == '1') {
                                                                                                                                        echo 'Yes';
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 150px;">
                                                                                                                                Company ID provided
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="data_sty"  style="font-weight: bold;width: 195px;">
                                                                                                                                <?php
                                                                                                                                if ($staff_edu->company_id == '0') {
                                                                                                                                        echo 'No';
                                                                                                                                } elseif ($staff_edu->company_id == '1') {
                                                                                                                                        echo 'Yes';
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 130px;">
                                                                                                                                Emergency Contact Verification
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="data_sty"  style="font-weight: bold;width: 195px;">
                                                                                                                                <?php
                                                                                                                                if ($staff_edu->emergency_conatct_verification == '0') {
                                                                                                                                        echo 'No';
                                                                                                                                } elseif ($staff_edu->emergency_conatct_verification == '1') {
                                                                                                                                        echo 'Yes';
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>

                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width: 130px;">
                                                                                                                                Panchayath Clearnce Verification
                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>

                                                                                                        <td colspan="2">
                                                                                                                <div class="content">
                                                                                                                        <div class="data_sty"  style="font-weight: bold;width: 195px;">
                                                                                                                                <?php
                                                                                                                                if ($staff_edu->panchayath_cleraance_verification == '0') {
                                                                                                                                        echo 'No';
                                                                                                                                } elseif ($staff_edu->panchayath_cleraance_verification == '1') {
                                                                                                                                        echo 'Yes';
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>


                                                                                        </table>
                                                                                </td>
                                                                        </tr>

                                                                        <tr>
                                                                                <td>
                                                                                        <table class="table1">
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="heading" style="text-align:left;">Current Employer (For Part-time employees)</div>
                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Hospital Address:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:630px;">
                                                                                                                                <?= $staff_other_info->hospital_address; ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Designation:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:249px;margin-left: 40px;">
                                                                                                                                <?= $staff_other_info->designation; ?>
                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Length Of Service:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:249px;">
                                                                                                                                <?= $staff_other_info->length_of_service; ?>
                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>
                                                                                                </tr>


                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                From:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:249px;margin-left: 80px;">
                                                                                                                                <?= date('d-M-Y', strtotime($staff_other_info->current_from)); ?>
                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                To:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width: 345px;"><?= date('d-M-Y', strtotime($staff_other_info->current_to)); ?></div>
                                                                                                                </div>

                                                                                                        </td>
                                                                                                </tr>
                                                                                        </table>
                                                                                </td>
                                                                        </tr>


                                                                        <tr>
                                                                                <td>
                                                                                        <table class='table1'>

                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content">
                                                                                                                        <div class="heading" style="text-align:left;">Previous Employer</div>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>
                                                                                                <?php
                                                                                                foreach ($staff_previous_employer as $value) {
                                                                                                        ?>
                                                                                                        <tr>
                                                                                                                <td colspan="2">
                                                                                                                        <div class="content" >
                                                                                                                                <div class="label_sty">
                                                                                                                                        Hospital Address:
                                                                                                                                </div>

                                                                                                                                <div class="data_sty" style="width:630px;">
                                                                                                                                        <?= $value->hospital_address; ?>
                                                                                                                                </div>
                                                                                                                        </div>
                                                                                                                </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                                <td>
                                                                                                                        <div class="content" >
                                                                                                                                <div class="label_sty">
                                                                                                                                        Designation:
                                                                                                                                </div>

                                                                                                                                <div class="data_sty" style="width:249px;margin-left: 40px;">
                                                                                                                                        <?= $value->designation; ?>
                                                                                                                                </div>
                                                                                                                        </div>

                                                                                                                </td>

                                                                                                                <td>
                                                                                                                        <div class="content" >
                                                                                                                                <div class="label_sty">
                                                                                                                                        Length Of Service:
                                                                                                                                </div>

                                                                                                                                <div class="data_sty" style="width:249px;">
                                                                                                                                        <?= $value->length_of_service; ?>
                                                                                                                                </div>
                                                                                                                        </div>

                                                                                                                </td>
                                                                                                        </tr>


                                                                                                        <tr>
                                                                                                                <td>
                                                                                                                        <div class="content" >
                                                                                                                                <div class="label_sty">
                                                                                                                                        From:
                                                                                                                                </div>

                                                                                                                                <div class="data_sty" style="width:249px;margin-left: 80px;">
                                                                                                                                        <?= date('d-M-Y', strtotime($value->service_from)); ?>
                                                                                                                                </div>
                                                                                                                        </div>

                                                                                                                </td>

                                                                                                                <td>
                                                                                                                        <div class="content" >
                                                                                                                                <div class="label_sty">
                                                                                                                                        To:
                                                                                                                                </div>

                                                                                                                                <div class="data_sty" style="width: 345px;">
                                                                                                                                        <?= date('d-M-Y', strtotime($value->service_to)); ?>
                                                                                                                                </div>
                                                                                                                        </div>

                                                                                                                </td>
                                                                                                        </tr>

                                                                                                <?php } ?>




                                                                                        </table>
                                                                                </td>
                                                                        </tr>


                                                                        <tr>
                                                                                <td>
                                                                                        <table class="table1">
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content" style="text-align:center;">
                                                                                                                        <div class="heading">EMERGENCY CONTACT</div>
                                                                                                                </div>
                                                                                                        </td>


                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Emergency contact name:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:570px;;">
                                                                                                                                <?= $staff_other_info->emergency_contact_name; ?>
                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Relationship:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:650px;">
                                                                                                                                <?= $staff_other_info->relationship; ?>
                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Phone:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:300px;">
                                                                                                                                <?= $staff_other_info->phone; ?>
                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Mobile:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:320px;">
                                                                                                                                <?= $staff_other_info->mobile; ?>
                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Alternate Emergency contact name:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:507px;">
                                                                                                                                <?= $staff_other_info->alt_emergency_contact_name; ?>
                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Relationship:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:650px;">
                                                                                                                                <?= $staff_other_info->alt_relationship; ?>
                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Phone:
                                                                                                                        </div>
                                                                                                                        <div class="data_sty" style="width:300px;">
                                                                                                                                <?= $staff_other_info->alt_phone; ?>
                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Mobile:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:320px;">
                                                                                                                                <?= $staff_other_info->alt_mobile; ?>
                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>
                                                                                                </tr>

                                                                                        </table>
                                                                                </td>
                                                                        </tr>


                                                                        <tr>
                                                                                <td>
                                                                                        <table class="table1" style="border:0px sloid #000;">

                                                                                                <tr>
                                                                                                        <td>

                                                                                                                <p class="patient_consent">The information in this section is true and complete. I agree that any deliberate omission falsification
                                                                                                                        or misrepresentation in the application form will be grounds for rejecting this application or subsequent dismissal if employed by the organisation.
                                                                                                                        Where applicable, I consent that the organisation can seek clarification regarding professional registration details. I agree to the above declaration.

                                                                                                                </p>

                                                                                                        </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content" style="width: 50%;float: left">
                                                                                                                        <div class="label_sty" style="width: 100px;">
                                                                                                                                Place:
                                                                                                                        </div>
                                                                                                                        <div class="" style="width: 100px;">

                                                                                                                        </div>
                                                                                                                </div>
                                                                                                                <div class="content" style="width: 50%;float: right">
                                                                                                                        <div class="label_sty" style="width: 100px;">
                                                                                                                                Name:
                                                                                                                        </div>
                                                                                                                        <div class="" style="width: 100px;">

                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>


                                                                                                </tr>
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content" style="width: 50%;float: left">
                                                                                                                        <div class="label_sty" style="width: 100px;">
                                                                                                                                Date:
                                                                                                                        </div>
                                                                                                                        <div class="" style="width: 100px;">

                                                                                                                        </div>
                                                                                                                </div>
                                                                                                                <div class="content" style="width: 50%;float: right">
                                                                                                                        <div class="label_sty" style="width: 100px;">
                                                                                                                                Signature:
                                                                                                                        </div>
                                                                                                                        <div class="" style="width: 100px;">

                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>


                                                                                                </tr>






                                                                                        </table>
                                                                                </td>
                                                                        </tr>





                                                                </tbody>


                                                        </table>

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

                                                </div>





                                                <!-----------------View uploaded files--------->
                                                <hr class="appoint_history" />
                                                <h4 class="sub-heading">Uploaded Files</h4>
                                                <div class="row">
                                                        <?php
                                                        $path = Yii::getAlias(Yii::$app->params['uploadPath']) . '/staff/' . $staff_info->id;
                                                        $k = 0;
                                                        foreach (glob("{$path}/*") as $file) {
                                                                $k++;
                                                                $arry = explode('/', $file);
                                                                $img_nmee = end($arry);
                                                                $img_nmees = explode('.', $img_nmee);
                                                                ?>

                                                                <div class = "col-md-2 img-box" id="<?= $k; ?>">
                                                                        <a href="<?= Yii::$app->homeUrl . '../uploads/staff/' . $staff_info->id . '/' . end($arry) ?>" target="_blank"><?= end($arry); ?></a>
                                                                        <a  title="Delete" class="staff-enq-img-remove" id="<?= $staff_info->id . "-" . $img_nmee . "-" . $k; ?>" style="cursor:pointer"><i class="fa fa-remove" style="position: absolute;left: 165px;top: 3px;"></i></a>
                                                                </div>
                                                        <?php }
                                                        ?>
                                                </div>




                                                <div class="print">
                                                        <button onclick="printContent('pdf')" style="font-weight: bold !important;">Print</button>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>


<style>
        .img_data {
                margin-top: 16px;
        }
        a{
                color: #3c4ba1;
        }
</style>