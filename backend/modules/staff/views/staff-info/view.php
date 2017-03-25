<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Religion;
use common\models\Caste;
use common\models\Nationality;

/* @var $this yii\web\View */
/* @var $model common\models\StaffInfo */

$this->title = $model->staff_name;
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
                                                                }
                                                                .heading{
                                                                        font-size: 14px;
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
                                                                        <th style="width:100%">
                                                                                <div class="header">

                                                                                        <div class="main-left">
                                                                                                <img src="<?= Yii::$app->homeUrl ?>/images/logos/logo-1.png" style="width:250px;"/>
                                                                                        </div>

                                                                                        <br/>
                                                                                </div>
                                                                        </th>
                                                                </tr>



                                                                <tbody>

                                                                        <tr>
                                                                                <td>
                                                                                        <div class="heading">APPLICATION FORM FOR STAFF</div>
                                                                                </td>
                                                                        </tr>



                                                                        <tr>
                                                                                <td>
                                                                                        <table class="table1" style="border:0px sloid #000;">
                                                                                                <tr>
                                                                                                        <td colspan="3">
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty">
                                                                                                                                Name of the applicant :
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:530px;">
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

                                                                                                                        <div class="data_sty" style="width:150px">
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
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty">
                                                                                                                                DOB :
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:150px">
                                                                                                                                <?= $date = date('d-m-Y', strtotime($staff_info->dob)); ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty">
                                                                                                                                Blood Group :
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:150px">
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

                                                                                                                        <div class="data_sty" style="width:150px">
                                                                                                                                <?php
                                                                                                                                $religion = Religion::findOne($staff_info->religion);
                                                                                                                                echo $religion->religion;
                                                                                                                                ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty">
                                                                                                                                Caste :
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:150px">
                                                                                                                                <?php
                                                                                                                                $caste = Caste::findOne($staff_info->caste);
                                                                                                                                echo $caste->caste;
                                                                                                                                ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty">
                                                                                                                                Nationality :
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:160px">
                                                                                                                                <?php
                                                                                                                                $nationality = Nationality::findOne($staff_info->nationality);
                                                                                                                                echo $nationality->nationality;
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

                                                                                                                        <div class="data_sty" style="width:511px;">
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
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="width:325px;font-weight: bold;">
                                                                                                                                Permanent Address (Residence) :
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content" style="width:320px;font-weight: bold;">
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

                                                                                                                <div class="data_sty" style="width:325px">
                                                                                                                        <?= $staff_info->permanent_address; ?>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="label_sty">
                                                                                                                </div>

                                                                                                                <div class="data_sty" style="width:320px">
                                                                                                                        <?= $staff_info->present_address; ?>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="label_sty">
                                                                                                                        Pincode :
                                                                                                                </div>

                                                                                                                <div class="data_sty" style="width:270px">
                                                                                                                        <?= $staff_info->pincode; ?>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="label_sty">
                                                                                                                        Pincode :
                                                                                                                </div>

                                                                                                                <div class="data_sty" style="width:270px">
                                                                                                                        <?= $staff_info->present_pincode; ?>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="label_sty">
                                                                                                                        Contact No :
                                                                                                                </div>

                                                                                                                <div class="data_sty" style="width:253px">
                                                                                                                        <?= $staff_info->contact_no; ?>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="label_sty">
                                                                                                                        Contact No :
                                                                                                                </div>

                                                                                                                <div class="data_sty" style="width:253px">
                                                                                                                        <?= $staff_info->present_contact_no; ?>
                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="label_sty">
                                                                                                                        Email :
                                                                                                                </div>

                                                                                                                <div class="data_sty" style="width:285px">
                                                                                                                        <?= $staff_info->email; ?>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="label_sty">
                                                                                                                        Email :
                                                                                                                </div>

                                                                                                                <div class="data_sty" style="width:285px">
                                                                                                                        <?= $staff_info->present_email; ?>
                                                                                                                </div>
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

                                                                                                                <div class="data_sty" style="width:230px">
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
                                                                                                                <div class="label_sty">
                                                                                                                        License No :
                                                                                                                </div>

                                                                                                                <div class="data_sty" style="width:255px">
                                                                                                                        <?= $staff_info->licence_no; ?>
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
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="font-size: 12px;font-weight: bold;width: 150px;">
                                                                                                                                Educational Qualification
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
                                                                                                                        <div class="label_sty" style="font-weight: bold;width: 150px;">
                                                                                                                                SSSLC
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="data_sty" style="font-weight: bold;width: 220px;">
                                                                                                                                <?= $staff_info->sslc_institution; ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="data_sty" style="font-weight: bold;width: 100px;">
                                                                                                                                <?= $staff_info->sslc_year_of_passing; ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="data_sty"  style="font-weight: bold;width: 200px;">
                                                                                                                                <?= $staff_info->sslc_place; ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="font-weight: bold;width: 150px;">
                                                                                                                                HSE
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="data_sty" style="font-weight: bold;width: 220px;">
                                                                                                                                <?= $staff_info->hse_institution; ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="data_sty" style="font-weight: bold;width: 100px;">
                                                                                                                                <?= $staff_info->hse_year_of_passing; ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="data_sty"  style="font-weight: bold;width: 200px;">
                                                                                                                                <?= $staff_info->hse_place; ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="font-weight: bold;width: 150px;">
                                                                                                                                Nursing
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="data_sty" style="font-weight: bold;width: 220px;">
                                                                                                                                <?= $staff_info->nursing_institution; ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="data_sty" style="font-weight: bold;width: 100px;">
                                                                                                                                <?= $staff_info->nursing_year_of_passing; ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="data_sty"  style="font-weight: bold;width: 200px;">
                                                                                                                                <?= $staff_info->nursing_place; ?>
                                                                                                                        </div>

                                                                                                                </div>
                                                                                                        </td>
                                                                                                </tr>

                                                                                                <tr>
                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="label_sty" style="font-weight: bold;width: 150px;">
                                                                                                                                Tiiming
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content">
                                                                                                                        <div class="data_sty"  style="font-weight: bold;width: 220px;">
                                                                                                                                <?php
                                                                                                                                if ($staff_info->timing == '0') {
                                                                                                                                        echo 'Part Time';
                                                                                                                                } elseif ($staff_info->timing == '1') {
                                                                                                                                        echo 'Full Time';
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

                                                                                                                        <div class="data_sty" style="width:590px;">
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

                                                                                                                        <div class="data_sty" style="width:220px;margin-left: 40px;">
                                                                                                                                <?= $staff_other_info->designation; ?>
                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Length Of Service:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:235px;">
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

                                                                                                                        <div class="data_sty" style="width:220px;margin-left: 80px;">
                                                                                                                                <?= date('d-m-Y', strtotime($staff_other_info->current_from)); ?>
                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                To:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width: 330px;">
                                                                                                                                <?= date('d-m-Y', strtotime($staff_other_info->current_to)); ?>
                                                                                                                        </div>
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
                                                                                                <tr>
                                                                                                        <td colspan="2">
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Hospital Address:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:590px;">

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

                                                                                                                        <div class="data_sty" style="width:220px;margin-left: 40px;">

                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Length Of Service:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:235px;">

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

                                                                                                                        <div class="data_sty" style="width:220px;margin-left: 80px;">

                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                To:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width: 330px;">

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

                                                                                                                        <div class="data_sty" style="width:530px;;">

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

                                                                                                                        <div class="data_sty" style="width:610px;">

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

                                                                                                                        <div class="data_sty" style="width:280px;">

                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Mobile:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:300px;">

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

                                                                                                                        <div class="data_sty" style="width:465px;">

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

                                                                                                                        <div class="data_sty" style="width:610px;">

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

                                                                                                                        <div class="data_sty" style="width:280px;">

                                                                                                                        </div>
                                                                                                                </div>

                                                                                                        </td>

                                                                                                        <td>
                                                                                                                <div class="content" >
                                                                                                                        <div class="label_sty">
                                                                                                                                Mobile:
                                                                                                                        </div>

                                                                                                                        <div class="data_sty" style="width:300px;">

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
                                                <div class="print">
                                                        <button onclick="printContent('pdf')" style="font-weight: bold !important;">Print</button>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>


