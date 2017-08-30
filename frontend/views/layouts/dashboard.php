<?php
/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAsset;
use frontend\assets\DashboardAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

DashboardAsset::register($this);
$notifications = common\models\Invoice::find()->where(['status' => 2, 'due_date' => date('Y-m-d'), 'patient_id' => Yii::$app->session['patient_id']])->all();
$services = \common\models\Service::find()->where(['status' => 1, 'patient_id' => Yii::$app->session['patient_id']])->all();
?>
<?php $this->beginPage() ?>
<html lang="en">
        <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">

                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <meta name="description" content="Xenon Boostrap Admin Panel" />
                <meta name="author" content="" />
                <title>Caring People</title>
                <script src="<?= Yii::$app->homeUrl; ?>js/jquery-1.11.1.min.js"></script>

                <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
                <!--[if lt IE 9]>
                        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                <![endif]-->
                <?= Html::csrfMetaTags() ?>
                <script type="text/javascript">
                        var homeUrl = '<?= Yii::$app->homeUrl; ?>';
                </script>
                <?php $this->head() ?>
        </head>
        <body class="page-body">
                <?php $this->beginBody() ?>


                <div class="page-container">
                        <div class="sidebar-menu toggle-others fixed">

                                <div class="sidebar-menu-inner">
                                        <header class="logo-env">
                                                <!-- logo -->
                                                <div class="logo">
                                                        <a href="<?= Yii::$app->homeUrl; ?>dashboard/index" class="logo-expanded">
                                                                <?php echo Html::img('@web/admin/images/logos/logo-1.png', $options = ['width' => '150px']) ?>
                                                        </a>

                                                        <a href="<?= Yii::$app->homeUrl; ?>dashboard/index" class="logo-collapsed">
                                                                <img src="<?= Yii::$app->homeUrl; ?>admin/images/logos/logo-collapsed.png" width="40" alt="" />
                                                        </a>
                                                </div>
                                                <!-- This will toggle the mobile menu and will be visible only on mobile devices -->
                                                <div class="mobile-menu-toggle visible-xs">
                                                        <a href="#" data-toggle="user-info-menu">
                                                                <i class="fa-bell-o"></i>
                                                                <span class="badge badge-success">7</span>
                                                        </a>

                                                        <a href="#" data-toggle="mobile-menu">
                                                                <i class="fa-bars"></i>
                                                        </a>
                                                </div>
                                                <!-- This will open the popup with user profile settings, you can use for any purpose, just be creative -->



                                        </header>

                                        <ul id="main-menu" class="main-menu">

                                                <li>
                                                        <a href="">
                                                                <i class="fa fa-shield"></i>
                                                                <span class="title">Services</span>
                                                        </a>
                                                        <ul>
                                                                <li>
                                                                        <?= Html::a('Services', ['/dashboard/index'], ['class' => 'title']) ?>
                                                                </li>

                                                        </ul>
                                                </li>

                                                <li>
                                                        <a href="">
                                                                <i class="fa fa-inr"></i>
                                                                <span class="title">Invoices</span>
                                                        </a>
                                                        <ul>
                                                                <li>
                                                                        <?= Html::a('Invoices', ['/dashboard/invoices'], ['class' => 'title']) ?>
                                                                </li>

                                                        </ul>
                                                </li>



                                        </ul>

                                </div>

                        </div>

                        <div class="main-content">

                                <nav class="navbar user-info-navbar"  role="navigation"><!-- User Info, Notifications and Menu Bar -->

                                        <!-- Left links for user info navbar -->
                                        <ul class="user-info-menu left-links list-inline list-unstyled">

                                                <li class="hidden-sm hidden-xs">
                                                        <a href="#" data-toggle="sidebar">
                                                                <i class="fa-bars"></i>
                                                        </a>
                                                </li>
                                                <?php ?>
                                                <li class="dropdown hover-line hover-line-notify">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Notifications">
                                                                <i class="fa-bell-o"></i>
                                                                <?php
                                                                $follow_count = 0;
                                                                foreach ($services as $services1) {
                                                                        $followups1 = \common\models\Followups::find()->where(['status' => 0, 'type_id' => $services1->id])->andWhere(['like', 'followup_date', date('Y-m-d')])->all();
                                                                        $follow_count += count($followups1);
                                                                }
                                                                $total_count = count($notifications) + $follow_count;
                                                                ?>
                                                                <span class="badge badge-purple" id="notify-count"><?= $total_count; ?></span>
                                                        </a>
                                                        <ul class="dropdown-menu notifications">
                                                                <li class="top">
                                                                        <p class="small">


                                                                                You have <strong id="notify-counts"><?= $total_count; ?></strong> new notifications.
                                                                        </p>
                                                                </li>

                                                                <li>
                                                                        <ul class="dropdown-menu-list list-unstyled ps-scrollbar ps-container dropdown-menu-list-notify">
                                                                                <?php
                                                                                foreach ($notifications as $value) {
                                                                                        ?>
                                                                                        <li class="active notification-success" id="notify-<?= $value->id ?>">
                                                                                                <?php $id = Yii::$app->EncryptDecrypt->Encrypt('encrypt', $value->id); ?>
                                                                                                <a target="_blank" href="<?= Yii::$app->homeUrl ?>dashboard/invoicebill?id=<?= $id ?>">
                                                                                                        <span class="line notification-line" style="width: 85%;padding-left: 0;cursor: pointer;" id="<?= $value->id ?>">
                                                                                                                <strong style="line-height: 20px;">Payment (Rs. <?= $value->amount ?>) due date is on <?= date('d-m-Y', strtotime($value->due_date)) ?></strong>
                                                                                                        </span>

                                                                                                        <span class="line small time" style="padding-left: 0;">

                                                                                                        </span>
                                                                                                        <!--<input type="checkbox" checked="" class="iswitch iswitch-secondary disable-notification" data-id= "<?= $value->id ?>" style="margin-top: -35px;float: right;" title="Ignore">-->
                                                                                                </a>
                                                                                        </li>
                                                                                        <?php
                                                                                }
                                                                                foreach ($services as $services) {
                                                                                        $followups = \common\models\Followups::find()->where(['status' => 0, 'type_id' => $services->id])->andWhere(['like', 'followup_date', date('Y-m-d')])->all();
                                                                                        foreach ($followups as $followup) {
                                                                                                ?>
                                                                                                <li class="active notification-success" id="notify-<?= $value->id ?>">
                                                                                                        <?php $id = Yii::$app->EncryptDecrypt->Encrypt('encrypt', $followup->id); ?>
                                                                                                        <a>
                                                                                                                <span class="line notification-line" style="width: 85%;padding-left: 0;cursor: pointer;" id="<?= $followup->id ?>">
                                                                                                                        <strong style="line-height: 20px;">Pending Followup</strong>
                                                                                                                </span>

                                                                                                                <span class="line small time" style="padding-left: 0;">
                                                                                                                        <?= $followup->followup_notes ?><br>
                                                                                                                        Date : <?= date('d-m-Y', strtotime($followup->followup_date)); ?>
                                                                                                                </span>
                                                                                                                <!--<input type="checkbox" checked="" class="iswitch iswitch-secondary disable-notification" data-id= "<?= $value->id ?>" style="margin-top: -35px;float: right;" title="Ignore">-->
                                                                                                        </a>
                                                                                                </li>
                                                                                                <?php
                                                                                        }
                                                                                }
                                                                                ?>
                                                                                <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 2px;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div>
                                                                        </ul>
                                                                </li>

                                                                <li class="external">
                                                                        <?= Html::a('<span style="color: #03A9F4;">View all notifications</span> <i class="fa-link-ext"></i>', ['/dashboard/notifications']) ?>
                                                                </li>
                                                        </ul>
                                                </li>

                                                <li class="dropdown hover-line hover-line-task">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="My Tasks">
                                                                <i class="fa-envelope-o"></i>
                                                                <span class="badge badge-green" id="my-task-count"><?= $my_tasks_count ?></span>
                                                        </a>
                                                        <ul class="dropdown-menu my-task" style="width: 370px;">
                                                                <li class="top">
                                                                        <p class="small">
                                                                                <!--                                        <a href="#" class="pull-right">Mark all Read</a>-->
                                                                                You have <strong id="tasks-counts"><?= $my_tasks_count ?></strong> new tasks.
                                                                        </p>
                                                                </li>

                                                                <li>
                                                                        <ul class="dropdown-menu-list list-unstyled ps-scrollbar ps-container dropdown-menu-list-task">
                                                                                <?php /*
                                                                                  foreach ($my_tasks as $value) {
                                                                                  ?>
                                                                                  <li class="active task-success" id="mytasks-<?= $value->id ?>">
                                                                                  <a href="#">
                                                                                  <span class="line" style="width: 85%;padding-left: 0;">
                                                                                  <strong style="line-height: 20px;"><?= $value->follow_up_msg ?></strong>
                                                                                  </span>

                                                                                  <span class="line small time" style="padding-left: 0;">
                                                                                  <?= $value->date ?>
                                                                                  </span>
                                                                                  <input type="checkbox" checked="" class="iswitch iswitch-blue close-task" data-id= "<?= $value->id ?>" style="margin-top: -35px;float: right;" title="Close">
                                                                                  </a>
                                                                                  </li>
                                                                                  <?php
                                                                                  } */
                                                                                ?>
                                                                                <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 2px;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div>
                                                                        </ul>
                                                                </li>

                                                                <li class="external">
                                                                        <?= Html::a('<span style="color: #03A9F4;">View all Tasks</span> <i class="fa-link-ext"></i>', ['/task/task']) ?>
                                                                </li>
                                                        </ul>
                                                </li>
                                                <!-- Added in v1.2 -->
                                        </ul>
                                        <!-- Right links for user info navbar -->
                                        <ul class="user-info-menu right-links list-inline list-unstyled">

                                                <li>
                                                        <a href="<?= Yii::$app->homeUrl; ?>dashboard/index"><i class="fa-home"></i> Home</a>
                                                </li>

                                                <li class="dropdown user-profile">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <?php ?>
                                                                <img src="<?= Yii::$app->homeUrl; ?>images/Men.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />

                                                                <span>
                                                                        <?= Yii::$app->user->identity->username ?>
                                                                        <i class="fa-angle-down"></i>
                                                                </span>
                                                        </a>

                                                        <ul class="dropdown-menu user-profile-menu list-unstyled">

                                                                <li>
                                                                        <?= Html::a('<i class="fa-wrench"></i>Change Password', ['/dashboard/change-password'], ['class' => 'title']) ?>
                                                                </li>

                                                                <li>
                                                                        <?= Html::a('<i class="fa-pencil"></i>Edit Profile', ['/dashboard/edit-profile'], ['class' => 'title']) ?>
                                                                </li>

                                                                <?php
                                                                echo '<li class="last">'
                                                                . Html::beginForm(['/site/logout'], 'post') . '<a>'
                                                                . Html::submitButton(
                                                                        '<i class="fa-lock"></i> Logout', ['class' => 'btn logout_btn', 'style' => 'background-color: rgba(255,255,255,.7);padding-left: 0px !important;']
                                                                ) . '</a>'
                                                                . Html::endForm()
                                                                . '</li>';
                                                                ?>
                                                        </ul>
                                                </li>

                                        </ul>

                                </nav>
                                <div class="row">


                                        <?= $content; ?>


                                </div>
                                <footer class="main-footer sticky footer-type-1">

                                        <div class="footer-inner">

                                                <!-- Add your copyright text here -->
                                                <div class="footer-text">
                                                        &copy; <?= Html::encode(date('Y')) ?>
                                                        <strong>Azryah</strong>
                                                        All rights reserved.
                                                </div>


                                                <!-- Go to Top Link, just add rel="go-top" to any link to add this functionality -->
                                                <div class="go-up">

                                                        <a href="#" rel="go-top">
                                                                <i class="fa-angle-up"></i>
                                                        </a>

                                                </div>

                                        </div>

                                </footer>
                        </div>




                </div>

                <div class="footer-sticked-chat"><!-- Start: Footer Sticked Chat -->

                        <div class="page-loading-overlay loaded">
                                <div class="loader-2"></div>
                        </div>
                        <script type="text/javascript">

                                function showLoader() {
                                        $('.page-loading-overlay').removeClass('loaded');
                                }
                                function hideLoader() {
                                        $('.page-loading-overlay').addClass('loaded');
                                }
                                jQuery(document).ready(function ($)
                                {
                                        if ($("#clicks").click(function () {
                                                if ($("#side-menuss").hasClass("collapsed")) {


                                                        $('#main-menu>li>ul').css('display', '');

                                                        //$('sidebar-menu >main-menu>expanded>ul').style("expanded");
                                                }
                                        }))
                                                if ($(window).width() < 900) {
                                                        alert();
                                                        $("#side-menuss").removeClass("collapsed");
                                                } else {

                                                        //   $("#side-menuss").addClass('collapsed');
                                                }
                                        ;

                                });</script>
                        <script type="text/javascript">
                                function toggleSampleChatWindow()
                                {
                                        var $chat_win = jQuery("#sample-chat-window");

                                        $chat_win.toggleClass('open');

                                        if ($chat_win.hasClass('open'))
                                        {
                                                var $messages = $chat_win.find('.ps-scrollbar');

                                                if ($.isFunction($.fn.perfectScrollbar))
                                                {
                                                        $messages.perfectScrollbar('destroy');

                                                        setTimeout(function () {
                                                                $messages.perfectScrollbar();
                                                                $chat_win.find('.form-control').focus();
                                                        }, 300);
                                                }
                                        }

                                        jQuery("#sample-chat-window form").on('submit', function (ev)
                                        {
                                                ev.preventDefault();
                                        });
                                }

                                jQuery(document).ready(function ($)
                                {


                                        $(".mobile-chat-toggle").on('click', function (ev)
                                        {
                                                ev.preventDefault();

                                                $(".footer-sticked-chat").toggleClass('mobile-is-visible');
                                        });


                                });
                        </script>



                        <a href="#" class="mobile-chat-toggle">
                                <i class="linecons-comment"></i>
                                <span class="num">6</span>
                                <span class="badge badge-purple">4</span>
                        </a>

                        <!-- End: Footer Sticked Chat -->
                </div>






                <!-- Imported styles on this page -->
                <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/fonts/meteocons/css/meteocons.css">

                <!-- Bottom Scripts -->



                <!-- JavaScripts initializations and stuff -->
                <script src="<?= Yii::$app->homeUrl; ?>js/xenon-custom.js"></script>
                <?php $this->endBody() ?>
        </body>
        <div class="modal fade" id="modal-4" data-backdrop="static">
                <div class="modal-dialog" id="modal-4-pop-up">


                </div>
        </div>
</html>
<?php $this->endPage() ?>



<style>
        #yii-debug-toolbar{
                display: none !important;
        }
</style>