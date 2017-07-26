<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use common\models\Followups;
use common\models\AdminUsers;
use yii\helpers\ArrayHelper;
use common\models\NotificationViewStatus;

AppAsset::register($this);

//$notifications = Followups::find()->where(['assigned_to' => Yii::$app->user->identity->id, 'followup_date' => date('Y-m-d')])->all();
$notifications = Followups::find()->where(['assigned_to' => Yii::$app->user->identity->id])->andWhere(['like', 'followup_date', date('Y-m-d')])->all();
$new_notifications = NotificationViewStatus::find()->where(['staff_id_' => Yii::$app->user->identity->id, 'view_status' => 0])->all();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
        <head>
                <meta charset="<?= Yii::$app->charset ?>">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">

                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <meta name="description" content="Caring People Admin Panel" />
                <meta name="author" content="" />
                <title>Caring People</title>
                <script src="<?= Yii::$app->homeUrl; ?>/js/jquery-1.11.1.min.js"></script>
                <script type="text/javascript">
                        var homeUrl = '<?= Yii::$app->homeUrl; ?>';
                        //var basePath = "<?= Yii::$app->basePath; ?>";
                </script>
                <?= Html::csrfMetaTags() ?>
                <?php $this->head() ?>
        </head>
        <body>
                <?php $this->beginBody() ?>

                <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

                        <!-- Add "fixed" class to make the sidebar fixed always to the browser viewport. -->
                        <!-- Adding class "toggle-others" will keep only one menu item open at a time. -->
                        <!-- Adding class "collapsed" collapse sidebar root elements and show only icons. -->
                        <div class="sidebar-menu toggle-others collapsed"  id="side-menuss">

                                <div class="sidebar-menu-inner">

                                        <header class="logo-env">

                                                <!-- logo -->
                                                <div class="logo">
                                                        <a href="<?= Yii::$app->homeUrl; ?>site/index" class="logo-expanded">
                                                                <?php echo Html::img('@web/images/logos/logo-1.png', $options = ['width' => '200px']) ?>
                                                        </a>

                                                        <a href="<?= Yii::$app->homeUrl; ?>site/index" class="logo-collapsed">
                                                                <img src="<?= Yii::$app->homeUrl; ?>images/logos/logo-collapsed.png" width="40" alt="" />
                                                        </a>
                                                </div>

                                                <!-- This will toggle the mobile menu and will be visible only on mobile devices -->
                                                <div class="mobile-menu-toggle visible-xs">
                                                        <a href="#" data-toggle="user-info-menu">
                                                                <i class="fa-bell-o"></i>
                                                                <span class="badge badge-success"><?= count($new_notifications); ?></span>
                                                        </a>

                                                        <a href="#" data-toggle="mobile-menu">
                                                                <i class="fa-bars"></i>
                                                        </a>
                                                </div>



                                        </header>


                                        <?php
                                        if (Yii::$app->session['post']['admin'] == 1) {
                                                ?>
                                                <ul id="main-menu" class="main-menu">
                                                        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                                                        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                                                        <li>
                                                                <a href="dashboard-1.html">
                                                                        <i class="linecons-cog"></i>
                                                                        <span class="title">Administrator</span>
                                                                </a>
                                                                <ul>
                                                                        <li>
                                                                                <?= Html::a('Access Powers', ['/admin/admin-posts/index'], ['class' => 'title']) ?>
                                                                        </li>

                                                                        <li>
                                                                                <?php // Html::a('Admin Users', ['/admin/admin-users/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                </ul>
                                                        </li>

                                                </ul>
                                        <?php } ?>

                                        <?php
                                        if (Yii::$app->session['post']['staffs'] == 1) {
                                                ?>
                                                <ul id="main-menu" class="main-menu">
                                                        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                                                        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                                                        <li>
                                                                <a href="dashboard-1.html">
                                                                        <i class="fa-user"></i>
                                                                        <span class="title">Staffs</span>
                                                                </a>
                                                                <ul>
                                                                        <li>
                                                                                <?= Html::a('Staff Enquiry ', ['/staff/staff-enquiry/index'], ['class' => 'title']) ?>
                                                                        </li>

                                                                        <li>
                                                                                <?= Html::a('Staffs', ['/staff/staff-info/index'], ['class' => 'title']) ?>
                                                                        </li>


                                                                </ul>
                                                        </li>

                                                </ul>
                                        <?php } ?>

                                        <?php
                                        if (Yii::$app->session['post']['enquiry'] == 1) {
                                                ?>
                                                <ul id="main-menu" class="main-menu">
                                                        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                                                        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                                                        <li>
                                                                <a href="dashboard-1.html">
                                                                        <i class="	fa fa-medkit"></i>
                                                                        <span class="title">Client</span>
                                                                </a>
                                                                <ul>
                                                                        <li>
                                                                                <?= Html::a('Patient Enquiry', ['/patient/patient-enquiry-general-first/index'], ['class' => 'title']) ?>
                                                                        </li>

                                                                        <li>
                                                                                <?= Html::a('Patients', ['/patient/patient-information/index'], ['class' => 'title']) ?>
                                                                        </li>


                                                                </ul>
                                                        </li>

                                                </ul>
                                        <?php } ?>

                                        <?php
                                        if (Yii::$app->session['post']['service'] == 1) {
                                                ?>
                                                <ul id="main-menu" class="main-menu">
                                                        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                                                        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                                                        <li>
                                                                <a href="dashboard-1.html">
                                                                        <i class="fa fa-shield"></i>
                                                                        <span class="title">Services</span>
                                                                </a>
                                                                <ul>
                                                                        <li>
                                                                                <?= Html::a('Sub Services', ['/masters/sub-services/index'], ['class' => 'title']) ?>
                                                                        </li>

                                                                        <li>
                                                                                <?= Html::a('Rate Card', ['/masters/rate-card/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Service', ['/services/service/index'], ['class' => 'title']) ?>
                                                                        </li>


                                                                </ul>
                                                        </li>

                                                </ul>
                                        <?php } ?>
                                        <?php
                                        if (Yii::$app->session['post']['attendance'] == 1) {
                                                ?>
                                                <ul id="main-menu" class="main-menu">
                                                        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                                                        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                                                        <li>
                                                                <a href="dashboard-1.html">
                                                                        <i class="fa-check"></i>
                                                                        <span class="title">Attendance</span>
                                                                </a>
                                                                <ul>
                                                                        <li>
                                                                                <?= Html::a('Attendance ', ['/attendance/attendance/index'], ['class' => 'title']) ?>
                                                                        </li>

                                                                        <li>
                                                                                <?= Html::a('Employee Attendance Report ', ['/attendance/attendance/report'], ['class' => 'title']) ?>
                                                                        </li>

                                                                        <li>
                                                                                <?= Html::a('Staff-wise Attendance Report ', ['/attendance/attendance/staffattendance'], ['class' => 'title']) ?>
                                                                        </li>

                                                                </ul>
                                                        </li>

                                                </ul>
                                        <?php } ?>


                                        <?php if (Yii::$app->session['post']['leave_approval'] == 1 || Yii::$app->session['post']['leave_application'] == 1 || Yii::$app->session['post']['admin'] == 1) { ?>
                                                <ul id="main-menu" class="main-menu">
                                                        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                                                        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                                                        <li>
                                                                <a href="dashboard-1.html">
                                                                        <i class="fa fa-external-link"></i>
                                                                        <span class="title">Leave</span>
                                                                </a>

                                                                <ul>
                                                                        <?php
                                                                        if (Yii::$app->session['post']['leave_approval'] == 1) {
                                                                                ?>
                                                                                <li>
                                                                                        <?= Html::a('Staff Leave', ['/leave/staff-leave/index'], ['class' => 'title']) ?>
                                                                                </li>
                                                                        <?php } ?>
                                                                        <?php if (Yii::$app->session['post']['leave_application'] == 1) { ?>
                                                                                <li>
                                                                                        <?= Html::a('Leave Application', ['/leave/staff-leave/leave'], ['class' => 'title']) ?>
                                                                                </li>
                                                                        <?php } ?>
                                                                        <?php
                                                                        if (Yii::$app->session['post']['admin'] == 1) {
                                                                                ?>
                                                                                <li>
                                                                                        <?= Html::a('Leave Report ', ['/leave/staff-leave/leave-report'], ['class' => 'title']) ?>
                                                                                </li>
                                                                        <?php } ?>


                                                                </ul>
                                                        </li>

                                                </ul>
                                        <?php } ?>
                                        <?php
                                        //if (Yii::$app->session['post']['staffs'] == 1) {
                                        ?>
                                        <!--						<ul id="main-menu" class="main-menu">
                                                                                                 add class "multiple-expanded" to allow multiple submenus to open
                                                                                                 class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active"
                                                                                                <li>
                                                                                                        <a href="dashboard-1.html">
                                                                                                                <i class="fa fa-pencil-square-o"></i>
                                                                                                                <span class="title">Edit Profile</span>
                                                                                                        </a>
                                                                                                        <ul>
                                                                                                                <li>
                                        <?php //Html::a('Profile', ['/staff/staff-info/update?id=' . Yii::$app->user->identity->id], ['class' => 'title']) ?>
                                                                                                                </li>

                                                                                                        </ul>
                                                                                                </li>

                                                                                        </ul>-->
                                        <?php //} ?>
                                        <?php //if (Yii::$app->session['post']['leave_application'] == 1) { ?>
                                        <!--						<ul id="main-menu" class="main-menu">
                                                                                                 add class "multiple-expanded" to allow multiple submenus to open
                                                                                                 class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active"
                                                                                                <li>
                                                                                                        <a href="dashboard-1.html">
                                                                                                                <i class="fa fa-external-link"></i>
                                                                                                                <span class="title">Apply Leave</span>
                                                                                                        </a>
                                                                                                        <ul>
                                                                                                                <li>
                                        <?= Html::a('Leave Application', ['/leave/staff-leave/leave'], ['class' => 'title']) ?>
                                                                                                                </li>
                                                                                                                <li>
                                        <?= Html::a('Leave History', ['/leave/staff-leave/leave-history'], ['class' => 'title']) ?>
                                                                                                                </li>
                                                                                                                <li>
                                        <?= Html::a('Leave Report ', ['/leave/staff-leave/leave-report'], ['class' => 'title']) ?>
                                                                                                                </li>

                                                                                                        </ul>
                                                                                                </li>

                                                                                        </ul>-->
                                        <?php //} ?>

                                        <?php
                                        if (Yii::$app->session['post']['contact_directory'] == 1) {
                                                ?>
                                                <ul id="main-menu" class="main-menu">
                                                        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                                                        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                                                        <li>
                                                                <a href="dashboard-1.html">
                                                                        <i class="fa fa-folder-open"></i>
                                                                        <span class="title">Contact Directory</span>
                                                                </a>
                                                                <ul>
                                                                        <li>
                                                                                <?= Html::a('Contact Categories', ['/directory/contact-category-types/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Contact SubCategories', ['/directory/contact-subcategory/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Contact Directories', ['/directory/contact-directory/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                </ul>
                                                        </li>

                                                </ul>
                                        <?php } ?>

                                        <ul id="main-menu" class="main-menu">
                                                <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                                                <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                                                <li>
                                                        <a href="dashboard-1.html">
                                                                <i class="fa fa-inr"></i>
                                                                <span class="title">Expenses</span>
                                                        </a>
                                                        <ul>
                                                                <li>
                                                                        <?= Html::a('Expense Type', ['/expenses/expense-type/index'], ['class' => 'title']) ?>
                                                                </li>
                                                                <li>
                                                                        <?= Html::a('Expenses', ['/expenses/expenses/index'], ['class' => 'title']) ?>
                                                                </li>
                                                        </ul>
                                                </li>

                                        </ul>

                                        <?php
                                        if (Yii::$app->session['post']['id'] == 1) {
                                                ?>
                                                <ul id="main-menu" class="main-menu">
                                                        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                                                        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                                                        <li>
                                                                <a href="dashboard-1.html">
                                                                        <i class="fa fa-comments-o"></i>
                                                                        <span class="title">Comments</span>
                                                                </a>
                                                                <ul>
                                                                        <li>
                                                                                <?= Html::a('Comments', ['/contact/contact-us/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                </ul>
                                                        </li>

                                                </ul>
                                        <?php } ?>

                                        <?php
                                        if (Yii::$app->session['post']['masters'] == 1) {
                                                ?>
                                                <ul id="main-menu" class="main-menu">
                                                        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                                                        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                                                        <li>
                                                                <a href="dashboard-1.html">
                                                                        <i class="fa-database"></i>
                                                                        <span class="title">Masters</span>
                                                                </a>
                                                                <ul>
                                                                        <li>
                                                                                <?= Html::a('Country', ['/masters/country/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('State', ['/masters/state/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('City', ['/masters/city/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Religion', ['/masters/religion/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Caste', ['/masters/caste/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Nationality', ['/masters/nationality/index'], ['class' => 'title']) ?>
                                                                        </li>

                                                                        <li>
                                                                                <?= Html::a('Relationships', ['/masters/master-relationships/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Branches', ['/masters/branch/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Leave Types', ['/masters/master-leave-type/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Designations', ['/masters/master-designations/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Followups Category', ['/masters/followup-sub-type/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Masster Service Types', ['/masters/master-service-types/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Masster Service History Types', ['/masters/master-history-type/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Skills', ['/masters/staff-experience-list/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Remarks Category', ['/remarks/remarks-category/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Uploads Category', ['/masters/upload-category/index'], ['class' => 'title']) ?>
                                                                        </li>

                                                                        <li>
                                                                                <?= Html::a('Terms and Conditions', ['/masters/terms-and-conditions/index'], ['class' => 'title']) ?>
                                                                        </li>

                                                                </ul>
                                                        </li>

                                                </ul>
                                        <?php } ?>





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

                                                <li class="dropdown hover-line">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="fa-envelope-o"></i>
                                                                <span class="badge badge-green">15</span>
                                                        </a>

                                                        <ul class="dropdown-menu messages">
                                                                <li>

                                                                        <ul class="dropdown-menu-list list-unstyled ps-scrollbar">

                                                                                <li class="active"><!-- "active" class means message is unread -->
                                                                                        <a href="#">
                                                                                                <span class="line">
                                                                                                        <strong>Luc Chartier</strong>
                                                                                                        <span class="light small">- yesterday</span>
                                                                                                </span>

                                                                                                <span class="line desc small">
                                                                                                        This ainÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¾ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢t our first item, it is the best of the rest.
                                                                                                </span>
                                                                                        </a>
                                                                                </li>

                                                                                <li class="active">
                                                                                        <a href="#">
                                                                                                <span class="line">
                                                                                                        <strong>Salma Nyberg</strong>
                                                                                                        <span class="light small">- 2 days ago</span>
                                                                                                </span>

                                                                                                <span class="line desc small">
                                                                                                        Oh he decisively impression attachment friendship so if everything.
                                                                                                </span>
                                                                                        </a>
                                                                                </li>

                                                                                <li>
                                                                                        <a href="#">
                                                                                                <span class="line">
                                                                                                        Hayden Cartwright
                                                                                                        <span class="light small">- a week ago</span>
                                                                                                </span>

                                                                                                <span class="line desc small">
                                                                                                        Whose her enjoy chief new young. Felicity if ye required likewise so doubtful.
                                                                                                </span>
                                                                                        </a>
                                                                                </li>

                                                                                <li>
                                                                                        <a href="#">
                                                                                                <span class="line">
                                                                                                        Sandra Eberhardt
                                                                                                        <span class="light small">- 16 days ago</span>
                                                                                                </span>

                                                                                                <span class="line desc small">
                                                                                                        On so attention necessary at by provision otherwise existence direction.
                                                                                                </span>
                                                                                        </a>
                                                                                </li>

                                                                                <!-- Repeated -->

                                                                                <li class="active"><!-- "active" class means message is unread -->
                                                                                        <a href="#">
                                                                                                <span class="line">
                                                                                                        <strong>Luc Chartier</strong>
                                                                                                        <span class="light small">- yesterday</span>
                                                                                                </span>

                                                                                                <span class="line desc small">
                                                                                                        This ainÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¾ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢t our first item, it is the best of the rest.
                                                                                                </span>
                                                                                        </a>
                                                                                </li>

                                                                                <li class="active">
                                                                                        <a href="#">
                                                                                                <span class="line">
                                                                                                        <strong>Salma Nyberg</strong>
                                                                                                        <span class="light small">- 2 days ago</span>
                                                                                                </span>

                                                                                                <span class="line desc small">
                                                                                                        Oh he decisively impression attachment friendship so if everything.
                                                                                                </span>
                                                                                        </a>
                                                                                </li>

                                                                                <li>
                                                                                        <a href="#">
                                                                                                <span class="line">
                                                                                                        Hayden Cartwright
                                                                                                        <span class="light small">- a week ago</span>
                                                                                                </span>

                                                                                                <span class="line desc small">
                                                                                                        Whose her enjoy chief new young. Felicity if ye required likewise so doubtful.
                                                                                                </span>
                                                                                        </a>
                                                                                </li>

                                                                                <li>
                                                                                        <a href="#">
                                                                                                <span class="line">
                                                                                                        Sandra Eberhardt
                                                                                                        <span class="light small">- 16 days ago</span>
                                                                                                </span>

                                                                                                <span class="line desc small">
                                                                                                        On so attention necessary at by provision otherwise existence direction.
                                                                                                </span>
                                                                                        </a>
                                                                                </li>

                                                                        </ul>

                                                                </li>

                                                                <li class="external">
                                                                        <a href="mailbox-main.html">
                                                                                <span>All Messages</span>
                                                                                <i class="fa-link-ext"></i>
                                                                        </a>
                                                                </li>
                                                        </ul>
                                                </li>

                                                <li class="dropdown hover-line">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="fa-bell-o"></i>
                                                                <span class="badge badge-purple"><?= count($new_notifications) ?></span>
                                                        </a>

                                                        <ul class="dropdown-menu notifications">
                                                                <li class="top">
                                                                        <p class="small">
                                                                                <a href="#" class="pull-right">Mark all Read</a>
                                                                                You have <strong><?= count($new_notifications) ?></strong> new notifications.
                                                                        </p>
                                                                </li>

                                                                <li>
                                                                        <ul class="dropdown-menu-list list-unstyled ps-scrollbar">
                                                                                <?php
                                                                                if (!empty($new_notifications)) {
                                                                                        foreach ($new_notifications as $new_notification) {
                                                                                                ?>
                                                                                                <li class="active notification-success">
                                                                                                        <a href="<?php //Yii::$app->homeUrl;                                                                                                                                                      ?>followup/followups/view">
                                                                                                                <i class="fa-envelope"></i>

                                                                                                                <span class="line">
                                                                <!--														<strong>Followup Enquiry</strong>-->
                                                                                                                </span>

                                                                                                                <span class="line small time limit-text">
                                                                                                                        <?php
//															$text = strlen($notification->followup_notes) > 100 ? substr($notification->followup_notes, 0, 100) . '&hellip;' : $notification->followup_notes;
                                                                                                                        echo $new_notification->content;
                                                                                                                        ?>
                                                                                                                </span>
                                                                                                                <span class="line small time "><strong>Date:</strong><?= ' ' . $new_notification->date ?></span>
                                                                                                        </a>
                                                                                                </li>
                                                                                                <?php
                                                                                        }
                                                                                }
                                                                                ?>


                                                                        </ul>
                                                                </li>

                                                                <li class="external">
                                                                        <a href="#">
                                                                                <span>View all notifications</span>
                                                                                <i class="fa-link-ext"></i>
                                                                        </a>
                                                                </li>
                                                        </ul>
                                                </li>

                                                <li class="dropdown hover-line">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="My Tasks">
                                                                <i class="linecons-calendar"></i>
                                                        </a>

                                                        <ul class="dropdown-menu notifications">
                                                                <li style="height: 50px;padding: 11px;">
                                                                        <a href="<?= Yii::$app->homeUrl; ?>followup/followups/index" style="line-height: 3"> My Followups</a>
                                                                </li>

                                                                <li style="height: 50px;padding: 11px;">
                                                                        <a href="<?= Yii::$app->homeUrl; ?>followup/followups/followups" style="line-height: 3"> Add Followups</a>
                                                                </li>

                                                                <li style="height: 50px;padding: 11px;">
                                                                        <a href="<?= Yii::$app->homeUrl; ?>followup/followups/viewrelated" style="line-height: 3">My Related Followups</a>
                                                                </li>

                                                        </ul>
                                                </li>


                                        </ul>


                                        <!-- Right links for user info navbar -->
                                        <ul class="user-info-menu right-links list-inline list-unstyled">


                                                <li class="dropdown user-profile">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <img src="<?= Yii::$app->homeUrl; ?>images/themes/user-4.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
                                                                <span>
                                                                        <?= Yii::$app->user->identity->username ?>
                                                                        <i class="fa-angle-down"></i>
                                                                </span>
                                                        </a>

                                                        <ul class="dropdown-menu user-profile-menu list-unstyled">

                                                                <li>
                                                                        <?= Html::a('<i class="fa-wrench"></i>Change Password', ['/admin/admin-users/change-password?data=' . Yii::$app->EncryptDecrypt->Encrypt('encrypt', Yii::$app->user->identity->id)], ['class' => 'title']) ?>
                                                                        </									li>
                                                                <li>
                                                                        <?= Html::a('<i class="fa-pencil"></i>Edit Profile', ['/staff/staff-info/editprofile?data=' . Yii::$app->EncryptDecrypt->Encrypt('encrypt', Yii::$app->user->identity->id)], ['class' => 'title']) ?>
                                                                </li>

                                                                <?php
                                                                echo '<li class="last">'
                                                                . Html::beginForm(['/site/logout'], 'post') . '<a>'
                                                                . Html::submitButton(
                                                                        '<i class="fa-lock"></i> Logout', ['class' => 'btn logout_btn']
                                                                ) . '</a>'
                                                                . Html::endForm()
                                                                . '</li>';
                                                                ?>


                                                        </ul>
                                                </li>



                                        </ul>

                                </nav>


                                <?= $content; ?>



                                <footer class="main-footer sticky footer-type-1">

                                        <div class="footer-inner">

                                                <!-- Add your copyright text here -->
                                                <div class="footer-text">
                                                        &copy; <?= Html::encode(date('Y')) ?>
                                                        <strong>Caring</strong>
                                                        People <a href="#" target="_blank"></a>
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


                        <div id="chat" class="fixed"><!-- start: Chat Section -->

                                <div class="chat-inner">


                                        <h2 class="chat-header">
                                                <a  href="#" class="chat-close" data-toggle="chat">
                                                        <i class="fa-plus-circle rotate-45deg"></i>
                                                </a>

                                                Chat
                                                <span class="badge badge-success is-hidden">0</span>
                                        </h2>

                                        <script type="text/javascript">
                                                // Here is just a sample how to open chat conversation box
                                                jQuery(document).ready(function ($)
                                                {
                                                        var $chat_conversation = $(".chat-conversation");

                                                        $(".chat-group a").on('click', function (ev)
                                                        {
                                                                ev.preventDefault();

                                                                $chat_conversation.toggleClass('is-open');

                                                                $(".chat-conversation textarea").trigger('autosize.resize').focus();
                                                        });

                                                        $(".conversation-close").on('click', function (ev)
                                                        {
                                                                ev.preventDefault();
                                                                $chat_conversation.removeClass('is-open');
                                                        });
                                                });</script>


                                        <div class="chat-group">
                                                <strong>Favorites</strong>

                                                <a href="#"><span class="user-status is-online"></span> <em>Catherine J. Watkins</em></a>
                                                <a href="#"><span class="user-status is-online"></span> <em>Nicholas R. Walker</em></a>
                                                <a href="#"><span class="user-status is-busy"></span> <em>Susan J. Best</em></a>
                                                <a href="#"><span class="user-status is-idle"></span> <em>Fernando G. Olson</em></a>
                                                <a href="#"><span class="user-status is-offline"></span> <em>Brandon S. Young</em></a>
                                        </div>


                                        <div class="chat-group">
                                                <strong>Work</strong>

                                                <a href="#"><span class="user-status is-busy"></span> <em>Rodrigo E. Lozano</em></a>
                                                <a href="#"><span class="user-status is-offline"></span> <em>Robert J. Garcia</em></a>
                                                <a href="#"><span class="user-status is-offline"></span> <em>Daniel A. Pena</em></a>
                                        </div>


                                        <div class="chat-group">
                                                <strong>Other</strong>

                                                <a href="#"><span class="user-status is-online"></span> <em>Dennis E. Johnson</em></a>
                                                <a href="#"><span class="user-status is-online"></span> <em>Stuart A. Shire</em></a>
                                                <a href="#"><span class="user-status is-online"></span> <em>Janet I. Matas</em></a>
                                                <a href="#"><span class="user-status is-online"></span> <em>Mindy A. Smith</em></a>
                                                <a href="#"><span class="user-status is-busy"></span> <em>Herman S. Foltz</em></a>
                                                <a href="#"><span class="user-status is-busy"></span> <em>Gregory E. Robie</em></a>
                                                <a href="#"><span class="user-status is-busy"></span> <em>Nellie T. Foreman</em></a>
                                                <a href="#"><span class="user-status is-busy"></span> <em>William R. Miller</em></a>
                                                <a href="#"><span class="user-status is-idle"></span> <em>Vivian J. Hall</em></a>
                                                <a href="#"><span class="user-status is-offline"></span> <em>Melinda A. Anderson</em></a>
                                                <a href="#"><span class="user-status is-offline"></span> <em>Gary M. Mooneyham</em></a>
                                                <a href="#"><span class="user-status is-offline"></span> <em>Robert C. Medina</em></a>
                                                <a href="#"><span class="user-status is-offline"></span> <em>Dylan C. Bernal</em></a>
                                                <a href="#"><span class="user-status is-offline"></span> <em>Marc P. Sanborn</em></a>
                                                <a href="#"><span class="user-status is-offline"></span> <em>Kenneth M. Rochester</em></a>
                                                <a href="#"><span class="user-status is-offline"></span> <em>Rachael D. Carpenter</em></a>
                                        </div>

                                </div>

                                <!-- conversation template -->
                                <div class="chat-conversation">

                                        <div class="conversation-header">
                                                <a href="#" class="conversation-close">
                                                        &times;
                                                </a>

                                                <span class="user-status is-online"></span>
                                                <span class="display-name">Arlind Nushi</span>
                                                <small>Online</small>
                                        </div>

                                        <ul class="conversation-body">
                                                <li>
                                                        <span class="user">Arlind Nushi</span>
                                                        <span class="time">09:00</span>
                                                        <p>Are you here?</p>
                                                </li>
                                                <li class="odd">
                                                        <span class="user">Brandon S. Young</span>
                                                        <span class="time">09:25</span>
                                                        <p>This message is pre-queued.</p>
                                                </li>
                                                <li>
                                                        <span class="user">Brandon S. Young</span>
                                                        <span class="time">09:26</span>
                                                        <p>Whohoo!</p>
                                                </li>
                                                <li class="odd">
                                                        <span class="user">Arlind Nushi</span>
                                                        <span class="time">09:27</span>
                                                        <p>Do you like it?</p>
                                                </li>
                                        </ul>

                                        <div class="chat-textarea">
                                                <textarea class="form-control autogrow" placeholder="Type your message"></textarea>
                                        </div>

                                </div>

                                <!-- end: Chat Section -->
                        </div>

                </div>

                <div class="footer-sticked-chat"><!-- Start: Footer Sticked Chat -->

                        <script type="text/javascript">
                                function showLoader() {
                                        $('.page-loading-overlay').removeClass('loaded');
                                }
                                function hideLoader() {
                                        $('.page-loading-overlay').addClass('loaded');
                                }
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

                                        $(".footer-sticked-chat .chat-user, .other-conversations-list a").on('click', function (ev)
                                        {
                                                ev.preventDefault();
                                                toggleSampleChatWindow();
                                        });

                                        $(".mobile-chat-toggle").on('click', function (ev)
                                        {
                                                ev.preventDefault();

                                                $(".footer-sticked-chat").toggleClass('mobile-is-visible');
                                        });
                                });</script>



                        <a href="#" class="mobile-chat-toggle">
                                <i class="linecons-comment"></i>
                                <span class="num">6</span>
                                <span class="badge badge-purple">4</span>
                        </a>

                        <!-- End: Footer Sticked Chat -->
                </div>

                <!-- Page Loading Overlay -->
                <div class="page-loading-overlay loaded">
                        <div class="loader-2"></div>
                </div>

                <?php $this->endBody() ?>
                <script type="text/javascript">
                        jQuery(document).ready(function ($)
                        {
                                if ($(window).width() < 900) {
                                        $("#side-menuss").removeClass("collapsed");
                                } else {

                                        //   $("#side-menuss").addClass('collapsed');
                                }
                                ;

                        });</script>
        </body>

</html>

<!------------------------------------------------------ popup---------------------------------------------------->
<div class="modal fade" id="modal-6">
        <div class="modal-dialog" id="modal-pop-up">

        </div>
</div>
<!---------------------------------staff password reset-------------------------->
<div class="modal" id="modal-reset">
        <div class="modal-dialog">
                <div class="modal-content">
                        <form id="reset_password_form">
                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Reset Password</h4>
                                </div>

                                <div class="modal-body">
                                        <div class="row">
                                                <input type="hidden" id="user_id" value="">
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                                <input type="text" class="form-control some_class" id="new-password" name="new-password" required="required" placeholder="New Password">
                                                        </div>
                                                </div>
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                                <input type="text" class="form-control some_class" id="confirm-password" name="confirm-password" required="required" placeholder="Confirm Password">
                                                                <div class="mismatch_error" style="color: rgba(255, 0, 0, 0.78);"></div>
                                                        </div>

                                                </div>
                                        </div>








                                </div>

                                <div class="modal-footer">
                                        <!--                                        <button type="button" class="btn btn-info" id="addFollowupsubmit">Submit</button>-->
                                        <input  type="submit" class="btn btn-info" value="Submit">
                                </div>
                        </form>
                </div>
        </div>
</div>


<!---------------------------------------------Terms and conditions-------------------------------------------->

<div class="modal fade" id="modal-7">
        <div class="modal-dialog">
                <div class="modal-content" style="background: #eee;">

                        <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" style="font-weight: bold">Terms and Conditions</h4>
                        </div>

                        <div class="modal-body">
                                Loading...
                        </div>

                        <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        </div>
                </div>
        </div>
</div>

<!--------------------------------------------Schedule choose stsff---------------------------------------------->


<div class="modal fade custom-width" id="modal-2">
        <div class="modal-dialog" style="width: 60%;" id="modal-2-pop-up">

        </div>
</div>


<!-------------------------------------------- adds chedule rate (cofirm to close)------------------------------->
<div class="modal fade" id="modal-4" data-backdrop="static">
        <div class="modal-dialog" id="modal-4-pop-up">

        </div>
</div>
<?php $this->endPage() ?>
