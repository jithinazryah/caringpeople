<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="Caring People Admin Panel" />
		<meta name="author" content="" />
		<title>Caring - People</title>
		<script src="<?= Yii::$app->homeUrl; ?>js/jquery-1.11.1.min.js"></script>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<?= Html::csrfMetaTags() ?>
		<?php $this->head() ?>
	</head>

	<body class="page-body">
		<?php $this->beginBody() ?>

		<div class="page-container">
			<div class="sidebar-menu toggle-others fixed " id="side-menuss">

				<div class="sidebar-menu-inner">

					<header class="logo-env">

						<!-- logo -->
						<div class="logo">
							<a href="dashboard-1.html" class="logo-expanded">
								<?php echo Html::img('@web/images/logos/logo-1.png', $options = ['width' => '200px']) ?>
							</a>

							<a href="dashboard-1.html" class="logo-collapsed">
								<img src="<?= Yii::$app->homeUrl; ?>images/themes/logo-collapsed@2x.png" width="40" alt="" />
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



					</header>



					<ul id="main-menu" class="main-menu">
						<!-- add class "multiple-expanded" to allow multiple submenus to open -->
						<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->







						<li >
							<a href="extra-gallery.html">
								<i class="linecons-cog"></i>
								<span class="title">Administrator</span>
								<span class="label label-purple pull-right hidden-collapsed">New Items</span>
							</a>
							<ul>


								<li>
									<a href="extra-members-list.html">
										<span class="title">Sub Menu 1 </span>
										<span class="label label-warning pull-right">New</span>
									</a>
									<ul>
										<li>
											<a href="extra-members-list.html">
												<span class="title">Child 1</span>
											</a>
										</li>
										<li>
											<a href="extra-members-add.html">
												<span class="title">Child 2</span>
											</a>
										</li>
									</ul>
								</li>
								<li>
									<a href="extra-gallery.html">
										<span class="title">Menu 2</span>
									</a>
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
													This ainâ€™t our first item, it is the best of the rest.
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
													This ainâ€™t our first item, it is the best of the rest.
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
								<span class="badge badge-purple">7</span>
							</a>

							<ul class="dropdown-menu notifications">
								<li class="top">
									<p class="small">
										<a href="#" class="pull-right">Mark all Read</a>
										You have <strong>3</strong> new notifications.
									</p>
								</li>

								<li>
									<ul class="dropdown-menu-list list-unstyled ps-scrollbar">
										<li class="active notification-success">
											<a href="#">
												<i class="fa-user"></i>

												<span class="line">
													<strong>New user registered</strong>
												</span>

												<span class="line small time">
													30 seconds ago
												</span>
											</a>
										</li>

										<li class="active notification-secondary">
											<a href="#">
												<i class="fa-lock"></i>

												<span class="line">
													<strong>Privacy settings have been changed</strong>
												</span>

												<span class="line small time">
													3 hours ago
												</span>
											</a>
										</li>

										<li class="notification-primary">
											<a href="#">
												<i class="fa-thumbs-up"></i>

												<span class="line">
													<strong>Someone special liked this</strong>
												</span>

												<span class="line small time">
													2 minutes ago
												</span>
											</a>
										</li>

										<li class="notification-danger">
											<a href="#">
												<i class="fa-calendar"></i>

												<span class="line">
													John cancelled the event
												</span>

												<span class="line small time">
													9 hours ago
												</span>
											</a>
										</li>

										<li class="notification-info">
											<a href="#">
												<i class="fa-database"></i>

												<span class="line">
													The server is status is stable
												</span>

												<span class="line small time">
													yesterday at 10:30am
												</span>
											</a>
										</li>

										<li class="notification-warning">
											<a href="#">
												<i class="fa-envelope-o"></i>

												<span class="line">
													New comments waiting approval
												</span>

												<span class="line small time">
													last week
												</span>
											</a>
										</li>
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



					</ul>


					<!-- Right links for user info navbar -->
					<ul class="user-info-menu right-links list-inline list-unstyled">


						<li class="dropdown user-profile">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?= Yii::$app->homeUrl; ?>images/themes/user-4.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
								<span>
									John Smith
									<i class="fa-angle-down"></i>
								</span>
							</a>

							<ul class="dropdown-menu user-profile-menu list-unstyled">

								<li>
									<a href="#settings">
										<i class="fa-wrench"></i>
										Settings
									</a>
								</li>
								<li>
									<a href="#profile">
										<i class="fa-user"></i>
										Profile
									</a>
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


		</div>



		<?php $this->endBody() ?>
		<script type="text/javascript">
			jQuery(document).ready(function ($)
			{

				if ($(window).width() < 900) {
					$("#side-menuss").removeClass("collapsed");
				} else {

					$("#side-menuss").addClass('collapsed');
				}
				;

			});
		</script>
	</body>
</html>
<?php $this->endPage() ?>