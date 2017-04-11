<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en-US">

    <!-- Mirrored from wellspring.mikado-themes.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 14 Mar 2017 04:22:00 GMT -->
    <!-- Added by HTTrack -->
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <!-- /Added by HTTrack -->

    <head>
        <meta charset="UTF-8" />
        <!--<link rel="profile" href="http://gmpg.org/xfn/11"/>-->
        <!--<link rel="pingback" href="xmlrpc.php"/>-->
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">

        <title>Caringpeople</title>
        <!--<script type="application/javascript">var mkdfBmiCalculatorAjaxUrl = "http://wellspring.mikado-themes.com/wp-admin/admin-ajax.php"</script><script type="application/javascript">var mkdCoreAjaxUrl = "http://wellspring.mikado-themes.com/wp-admin/admin-ajax.php"</script><script type="application/javascript">var MikadofAjaxUrl = "http://wellspring.mikado-themes.com/wp-admin/admin-ajax.php"</script><link rel="alternate" type="application/rss+xml" title="Wellspring &raquo; Feed" href="feed/index.php" />-->
        <!--<link rel="alternate" type="application/rss+xml" title="Wellspring &raquo; Comments Feed" href="comments/feed/index.php" />-->
        <!--<link rel="alternate" type="text/calendar" title="Wellspring &raquo; iCal Feed" href="events/indexedf3.php?ical=1" />-->
        <!--        <script type="text/javascript">
                        window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/72x72\/", "ext":".png", "source":{"concatemoji":"http:\/\/wellspring.mikado-themes.com\/wp-includes\/js\/wp-emoji-release.min.js"}};
                        !function(a, b, c){function d(a){var c, d, e, f = b.createElement("canvas"), g = f.getContext && f.getContext("2d"), h = String.fromCharCode; return g && g.fillText?(g.textBaseline = "top", g.font = "600 32px Arial", "flag" === a?(g.fillText(h(55356, 56806, 55356, 56826), 0, 0), f.toDataURL().length > 3e3):"diversity" === a?(g.fillText(h(55356, 57221), 0, 0), c = g.getImageData(16, 16, 1, 1).data, g.fillText(h(55356, 57221, 55356, 57343), 0, 0), c = g.getImageData(16, 16, 1, 1).data, e = c[0] + "," + c[1] + "," + c[2] + "," + c[3], d !== e):("simple" === a?g.fillText(h(55357, 56835), 0, 0):g.fillText(h(55356, 57135), 0, 0), 0 !== g.getImageData(16, 16, 1, 1).data[0])):!1}function e(a){var c = b.createElement("script"); c.src = a, c.type = "text/javascript", b.getElementsByTagName("head")[0].appendChild(c)}var f, g; c.supports = {simple:d("simple"), flag:d("flag"), unicode8:d("unicode8"), diversity:d("diversity")}, c.DOMReady = !1, c.readyCallback = function(){c.DOMReady = !0}, c.supports.simple && c.supports.flag && c.supports.unicode8 && c.supports.diversity || (g = function(){c.readyCallback()}, b.addEventListener?(b.addEventListener("DOMContentLoaded", g, !1), a.addEventListener("load", g, !1)):(a.attachEvent("onload", g), b.attachEvent("onreadystatechange", function(){"complete" === b.readyState && c.readyCallback()})), f = c.source || {}, f.concatemoji?e(f.concatemoji):f.wpemoji && f.twemoji && (e(f.twemoji), e(f.wpemoji)))}(window, document, window._wpemojiSettings);
                    </script>-->
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/jquery/jquery.js'></script>
        <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/jquery/jquery-migrate.min.js'></script>
        <style type="text/css">
            img.wp-smiley,
            img.emoji {
                display: inline !important;
                border: none !important;
                box-shadow: none !important;
                height: 1em !important;
                width: 1em !important;
                margin: 0 .07em !important;
                vertical-align: -0.1em !important;
                background: none !important;
                padding: 0 !important;
            }
            a{text-decoration: none;}
        </style>
        <link rel='stylesheet' id='contact-form-7-css' href='<?= Yii::$app->homeUrl; ?>wp-content/plugins/contact-form-7/includes/css/styles.css' type='text/css' media='all' />
        <link rel='stylesheet' id='rs-plugin-settings-css' href='<?= Yii::$app->homeUrl; ?>wp-content/plugins/revslider/public/assets/css/settings.css' type='text/css' media='all' />
        <link rel='stylesheet' id='wellspring_mikado_modules_plugins-css' href='<?= Yii::$app->homeUrl; ?>wp-content/themes/wellspring/assets/css/plugins.min.css' type='text/css' media='all' />
        <link rel='stylesheet' id='mkdf_font_elegant-css' href='<?= Yii::$app->homeUrl; ?>wp-content/themes/wellspring/assets/css/elegant-icons/style.min.css' type='text/css' media='all' />
        <link rel='stylesheet' id='mkdf_linear_icons-css' href='<?= Yii::$app->homeUrl; ?>wp-content/themes/wellspring/assets/css/linear-icons/style.css' type='text/css' media='all' />
        <link rel='stylesheet' id='wellspring_mikado_modules-css' href='<?= Yii::$app->homeUrl; ?>wp-content/themes/wellspring/assets/css/modules.min.css' type='text/css' media='all' />
        <style id='wellspring_mikado_modules-inline-css' type='text/css'>
            @media only screen and (min-width: 1024px) and (max-width: 1550px) {
                .page-id-2608 .vc_hidden-md {
                    display: none !important;
                }
                .page-id-2608 .mkdf-landing-two-cols .vc_col-md-6 {
                    width: 50%;
                }
            }

            @media only screen and (max-width: 1550px) {
                .page-id-2608 .mkdf-landing-two-cols .mkdf-landing-col-padding {
                    padding: 0 0 0 5%;
                }
            }
        </style>
        <link rel='stylesheet' id='wellspring_mikado_style_dynamic-css' href='<?= Yii::$app->homeUrl; ?>wp-content/themes/wellspring/assets/css/style_dynamic.css' type='text/css' media='all' />
        <link rel='stylesheet' id='wellspring_mikado_modules_responsive-css' href='<?= Yii::$app->homeUrl; ?>wp-content/themes/wellspring/assets/css/modules-responsive.min.css' type='text/css' media='all' />
        <link rel='stylesheet' id='js_composer_front-css' href='<?= Yii::$app->homeUrl; ?>wp-content/plugins/js_composer/assets/css/js_composer.min.css' type='text/css' media='all' />
        <style type="text/css">
            /* generated in /www/sites/wellspring.mikado-themes.com/files/html/wp-content/themes/wellspring/functions.php wellspring_mikado_page_padding function */

            .page-id-5 .mkdf-content .mkdf-content-inner > .mkdf-container > .mkdf-container-inner,
            .page-id-5 .mkdf-content .mkdf-content-inner > .mkdf-full-width > .mkdf-full-width-inner {
                padding: 0;
            }
            /* generated in /www/sites/wellspring.mikado-themes.com/files/html/wp-content/themes/wellspring/framework/modules/header/filter-functions.php wellspring_mikado_get_top_bar_styles function */

            .page-id-5 .mkdf-top-bar {
                background-color: #13a8b0;
            }
        </style>
        <meta name="generator" content="Powered by Slider Revolution 5.1.6 - responsive, Mobile-Friendly Slider Plugin for WordPress with comfortable drag and drop interface." />
        <link rel="icon" href="<?= Yii::$app->homeUrl; ?>images/f-logo.png" sizes="40x40" />
        <style type="text/css" data-type="vc_shortcodes-custom-css">
            a{
                text-decoration: none;
            }
            .vc_custom_1453371194200 {
                padding-top: 40px !important;
            }

            .vc_custom_1453372762504 {
                padding-top: 40px !important;
                padding-bottom: 40px !important;
            }

            .vc_custom_1453372912921 {
                border-top-width: 1px !important;
                border-right-width: 0px !important;
                border-bottom-width: 0px !important;
                border-left-width: 0px !important;
                padding-top: 121px !important;
                padding-bottom: 129px !important;
                background-color: #fafafa !important;
                border-left-color: #f2f2f2 !important;
                border-left-style: solid !important;
                border-right-color: #f2f2f2 !important;
                border-right-style: solid !important;
                border-top-color: #f2f2f2 !important;
                border-top-style: solid !important;
                border-bottom-color: #f2f2f2 !important;
                border-bottom-style: solid !important;
            }

            .vc_custom_1453373153343 {
                padding-top: 121px !important;
                padding-bottom: 155px !important;
                background-image: url(wp-content/uploads/2016/01/parallax-1bc58.jpg?id=78) !important;
            }

            .vc_custom_1453373235263 {
                padding-top: 40px !important;
                padding-bottom: 40px !important;
            }

            .vc_custom_1453982497008 {
                border-top-width: 0px !important;
                border-right-width: 0px !important;
                border-bottom-width: 1px !important;
                border-left-width: 0px !important;
                padding-top: 140px !important;
                padding-bottom: 122px !important;
                background-color: #fafafa !important;
                border-left-color: #f2f2f2 !important;
                border-left-style: solid !important;
                border-right-color: #f2f2f2 !important;
                border-right-style: solid !important;
                border-top-color: #f2f2f2 !important;
                border-top-style: solid !important;
                border-bottom-color: #f2f2f2 !important;
                border-bottom-style: solid !important;
            }

            .vc_custom_1454074360719 {
                padding-top: 121px !important;
            }

            .vc_custom_1454074655624 {
                padding-top: 75px !important;
                padding-bottom: 90px !important;
            }

            .vc_custom_1453373935072 {
                padding-top: 123px !important;
                padding-bottom: 147px !important;
            }

            .vc_custom_1454930627059 {
                border-top-width: 1px !important;
                border-right-width: 0px !important;
                border-bottom-width: 0px !important;
                border-left-width: 0px !important;
                padding-top: 130px !important;
                padding-bottom: 110px !important;
                background-color: #fafafa !important;
                border-left-color: #f2f2f2 !important;
                border-left-style: solid !important;
                border-right-color: #f2f2f2 !important;
                border-right-style: solid !important;
                border-top-color: #f2f2f2 !important;
                border-top-style: solid !important;
                border-bottom-color: #f2f2f2 !important;
                border-bottom-style: solid !important;
            }
        </style>
        <noscript>
        <style type="text/css">
            .wpb_animate_when_almost_visible {
                opacity: 1;
            }
        </style>
        </noscript>
        <link rel="stylesheet" href="css/wfmi-style.css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
        <link href="<?= Yii::$app->homeUrl; ?>css/style.css" rel="stylesheet" />
    </head>

    <body class="home page page-id-5 page-template page-template-full-width page-template-full-width-php mkdf-bmi-calculator-1.0 mkd-core-1.0 wellspring-ver-1.0 mkdf-smooth-scroll  mkdf-ajax mkdf-grid-1300 mkdf-blog-installed mkdf-bbpress-installed mkdf-header-standard mkdf-sticky-header-on-scroll-down-up mkdf-default-mobile-header mkdf-sticky-up-mobile-header mkdf-dropdown-default mkdf-top-bar-light mkdf-search-dropdown mkdf-side-menu-slide-with-content mkdf-width-470 wpb-js-composer js-comp-ver-4.10 vc_responsive">

        <!------------------------selector-div----------------------------------->
        <a id="btnright" href="javascript:void(0);" class="btn-close">How Do I Start&nbsp;<i class="fa fa-question"></i>
            <img class="help-box-arrow" src="<?= Yii::$app->homeUrl; ?>images/help-box-arrow.png"/>
        </a>

        <div id="style-selector" class="text-center" style="display: none;right: 0px;">
            <!--<img class="help-box-arrow" src="images/help-box-arrow.png"/>-->


            <div class="help-box">
                <h5 class="title-big">How Do I Start</h5>
                <div class="style-selector-wrapper">
                    <!--<h5 class="title">Choose Layout</h5>-->
                    <!--                                        <a class="btn-gray active" href="index.php">Wide</a> <a class="btn-gray" href="http://codelayers.net/templates/hasta/construction/boxed/index.php">Boxed</a>
                                                            <div class="clearfix"></div>-->
                    <h5 class="title align-left">IT REALLY IS AS SIMPLE AS A B C…</h5>
                    <div class="scrol-box">
                        <ol class="alpha-list bg-pattrens-list">
                            <li><span>A</span><p>Phone us and have a chat about the type of Care and Support you would require. We are happy to give advice and to talkto you through the many options available to you.</p></li>
                            <li><span>B</span>We will visit you so we can get to know you and talk about all the little details that are important to you.</li>
                            <li class="last"><span>C</span>We will set up your care and support plan and will introduce your care workers. We will make sure everyone knows exactly what you want. We will make sure that is exactly what you get by supporting and supervising the people who provide your care.</li>
                        </ol>
                        <div class="row">
                            <h5 class="title-big">CALL US TODAY ON +91 90 20 599 599</h5>
                            <div class="col-md-12">
                                <div role="form" class="wpcf7" id="wpcf7-f140-o2" lang="en-US" dir="ltr">
                                    <div class="screen-reader-response"></div>
                                    <form action="/#wpcf7-f140-o2" method="post" class="wpcf7-form" novalidate="novalidate">
                                        <div style="display: none;">
                                            <input type="hidden" name="_wpcf7" value="140">
                                            <input type="hidden" name="_wpcf7_version" value="4.5.1">
                                            <input type="hidden" name="_wpcf7_locale" value="en_US">
                                            <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f140-o2">
                                            <input type="hidden" name="_wpnonce" value="a1d65a68c0">
                                        </div>
                                        <div class="col-md-6">
                                            <p><span class="wpcf7-form-control-wrap YourLocation"><select name="YourLocation" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required" aria-required="true" aria-invalid="false"><option value="Location">Location</option><option value="Kerala">Kerala</option><option value="Mumbai">Mumbai</option></select></span></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><span class="wpcf7-form-control-wrap your-name"><input type="text" name="your-name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Name"></span> </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><span class="wpcf7-form-control-wrap PhoneNumber"><input type="tel" name="PhoneNumber" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel" aria-required="true" aria-invalid="false" placeholder="Phone"></span></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><span class="wpcf7-form-control-wrap your-email"><input type="email" name="your-email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" placeholder="Email"></span> </p>
                                        </div>
                                        <div class="col-md-12">
                                            <p><span class="wpcf7-form-control-wrap your-message"><textarea name="your-message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false" placeholder="Message"></textarea></span> </p>
                                        </div>
                                        <div class="col-md-12">
                                            <p><input type="submit" value="Send" class="wpcf7-form-control wpcf7-submit"><img class="ajax-loader" src="http://caringpeople.in/wp-content/plugins/contact-form-7/images/ajax-loader.gif" alt="Sending ..." style="visibility: hidden;"></p>
                                        </div>
                                        <div class="wpcf7-response-output wpcf7-display-none"></div></form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!------------------------selector-div-end----------------------------------->


        <section class="mkdf-side-menu right">
            <div class="mkdf-close-side-menu-holder">
                <div class="mkdf-close-side-menu-holder-inner">
                    <a href="#" target="_self" class="mkdf-close-side-menu">
                        <span aria-hidden="true" class="icon_close"></span>
                    </a>
                </div>
            </div>
            <div id="text-11" class="widget mkdf-sidearea widget_text">
                <div class="textwidget">
                    <div data-original-height="25" class="vc_empty_space" style="height: 25px"><span class="vc_empty_space_inner"></span></div>

                    <a href="index.php">
                        <img width="auto" height="100%" src="<?= Yii::$app->homeUrl; ?>images/logo.png" alt="logo" />
                    </a>

                    <h2 style="margin:23px 0">Welcome to Caring People</h2> Living in your own surroundings where you feel loved and comfortable is always the best choice when it comes to difficult moments like being unwell. Home care is the right kind of support what people in need always wish for. Caring People Home care offers the best quality care and support at home. Our aim is to enable our needy clients to continue living in their own households with dignity, individuality and with control over their lives, irrespective of the level of support required. Caring People will always work with you to plan a service package that will aid you or your loved one to live a life to the full at home.

                    <div data-original-height="40" class="vc_empty_space" style="height: 40px"><span class="vc_empty_space_inner"></span></div>

                    <h5 style="color: #808080;">Working Hours</h5>

                    <div data-original-height="15" class="vc_empty_space" style="height: 15px"><span class="vc_empty_space_inner"></span></div>

                    <div class="mkdf-working-hours-holder mkdf-working-hours-dark">
                        <div class="mkdf-wh-holder-inner">

                            <div class="mkdf-wh-item clearfix">
                                <span class="mkdf-wh-day">
                                    <span class="mkdf-wh-icon">
                                        <span class="icon_clock_alt"></span>
                                    </span>
                                    Monday - Saturday </span>
                                <span class="mkdf-wh-dots"><span class="mkdf-wh-dots-inner"></span></span>
                                <span class="mkdf-wh-hours">
                                    <span class="mkdf-wh-from">10:00AM - 17:00PM</span>
                                </span>
                            </div>
                            <div class="mkdf-wh-item clearfix">
                                <span class="mkdf-wh-day">
                                    <span class="mkdf-wh-icon">
                                        <span class="icon_clock_alt"></span>
                                    </span>
                                    Sunday </span>
                                <span class="mkdf-wh-dots"><span class="mkdf-wh-dots-inner"></span></span>
                                <span class="mkdf-wh-hours">
                                    <span class="mkdf-wh-from">CLOSED</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div data-original-height="15" class="vc_empty_space" style="height: 15px"><span class="vc_empty_space_inner"></span></div>

                    <div class="mkdf-separator-holder clearfix  mkdf-separator-center mkdf-separator-full-width">
                        <div class="mkdf-separator" style="border-color: #e5e5e5;border-style: dashed;border-bottom-width: 1px;margin-top: 17px;margin-bottom: 35px"></div>
                    </div>

                    <h5 style="color:#808080;">From Our Gallery</h5>

                    <div data-original-height="10" class="vc_empty_space" style="height: 10px"><span class="vc_empty_space_inner"></span></div>

                    <div class="mkdf-image-gallery">
                        <div class="mkdf-image-gallery-grid mkdf-gallery-columns-4 mkdf-small-space ">
                            <div class="mkdf-gallery-image">
                                <div class="mkdf-overlay-holder">
                                    <div class="mkdf-overlay-inner"></div>
                                    <a href="#" data-rel="prettyPhoto[single_pretty_photo]" title="sidearea-image-1">
                                        <div class="mkdf-overlay-inner"></div>
                                        <img width="110" height="110" src="<?= Yii::$app->homeUrl; ?>wp-content/uploads/2016/01/sidearea-image-1-110x110.jpg" class="attachment-thumbnail size-thumbnail" alt="q" srcset="http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-1-110x110.jpg 110w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-1-300x300.jpg 300w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-1-188x188.jpg 188w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-1-550x550.jpg 550w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-1.jpg 600w" sizes="(max-width: 110px) 100vw, 110px" /> </a>
                                </div>
                            </div>
                            <div class="mkdf-gallery-image">
                                <div class="mkdf-overlay-holder">
                                    <div class="mkdf-overlay-inner"></div>
                                    <a href="#" data-rel="prettyPhoto[single_pretty_photo]" title="sidearea-image-2">
                                        <div class="mkdf-overlay-inner"></div>
                                        <img width="110" height="110" src="<?= Yii::$app->homeUrl; ?>wp-content/uploads/2016/01/sidearea-image-2-110x110.jpg" class="attachment-thumbnail size-thumbnail" alt="q" srcset="http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-2-110x110.jpg 110w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-2-300x300.jpg 300w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-2-188x188.jpg 188w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-2-550x550.jpg 550w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-2.jpg 600w" sizes="(max-width: 110px) 100vw, 110px" /> </a>
                                </div>
                            </div>
                            <div class="mkdf-gallery-image">
                                <div class="mkdf-overlay-holder">
                                    <div class="mkdf-overlay-inner"></div>
                                    <a href="#" data-rel="prettyPhoto[single_pretty_photo]" title="sidearea-image-3">
                                        <div class="mkdf-overlay-inner"></div>
                                        <img width="110" height="110" src="<?= Yii::$app->homeUrl; ?>wp-content/uploads/2016/01/sidearea-image-3-110x110.jpg" class="attachment-thumbnail size-thumbnail" alt="q" srcset="http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-3-110x110.jpg 110w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-3-300x300.jpg 300w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-3-188x188.jpg 188w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-3-550x550.jpg 550w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-3.jpg 600w" sizes="(max-width: 110px) 100vw, 110px" /> </a>
                                </div>
                            </div>
                            <div class="mkdf-gallery-image">
                                <div class="mkdf-overlay-holder">
                                    <div class="mkdf-overlay-inner"></div>
                                    <a href="#" data-rel="prettyPhoto[single_pretty_photo]" title="sidearea-image-4">
                                        <div class="mkdf-overlay-inner"></div>
                                        <img width="110" height="110" src="<?= Yii::$app->homeUrl; ?>wp-content/uploads/2016/01/sidearea-image-4-110x110.jpg" class="attachment-thumbnail size-thumbnail" alt="q" srcset="http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-4-110x110.jpg 110w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-4-300x300.jpg 300w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-4-188x188.jpg 188w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-4-550x550.jpg 550w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-4.jpg 600w" sizes="(max-width: 110px) 100vw, 110px" /> </a>
                                </div>
                            </div>
                            <div class="mkdf-gallery-image">
                                <div class="mkdf-overlay-holder">
                                    <div class="mkdf-overlay-inner"></div>
                                    <a href="#" data-rel="prettyPhoto[single_pretty_photo]" title="sidearea-image-5">
                                        <div class="mkdf-overlay-inner"></div>
                                        <img width="110" height="110" src="<?= Yii::$app->homeUrl; ?>wp-content/uploads/2016/01/sidearea-image-5-110x110.jpg" class="attachment-thumbnail size-thumbnail" alt="q" srcset="http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-5-110x110.jpg 110w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-5-300x300.jpg 300w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-5-188x188.jpg 188w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-5-550x550.jpg 550w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-5.jpg 600w" sizes="(max-width: 110px) 100vw, 110px" /> </a>
                                </div>
                            </div>
                            <div class="mkdf-gallery-image">
                                <div class="mkdf-overlay-holder">
                                    <div class="mkdf-overlay-inner"></div>
                                    <a href="#" data-rel="prettyPhoto[single_pretty_photo]" title="sidearea-image-6">
                                        <div class="mkdf-overlay-inner"></div>
                                        <img width="110" height="110" src="<?= Yii::$app->homeUrl; ?>wp-content/uploads/2016/01/sidearea-image-6-110x110.jpg" class="attachment-thumbnail size-thumbnail" alt="q" srcset="http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-6-110x110.jpg 110w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-6-300x300.jpg 300w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-6-188x188.jpg 188w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-6-550x550.jpg 550w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-6.jpg 600w" sizes="(max-width: 110px) 100vw, 110px" /> </a>
                                </div>
                            </div>
                            <div class="mkdf-gallery-image">
                                <div class="mkdf-overlay-holder">
                                    <div class="mkdf-overlay-inner"></div>
                                    <a href="#" data-rel="prettyPhoto[single_pretty_photo]" title="sidearea-image-7">
                                        <div class="mkdf-overlay-inner"></div>
                                        <img width="110" height="110" src="<?= Yii::$app->homeUrl; ?>wp-content/uploads/2016/01/sidearea-image-7-110x110.jpg" class="attachment-thumbnail size-thumbnail" alt="q" srcset="http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-7-110x110.jpg 110w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-7-300x300.jpg 300w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-7-188x188.jpg 188w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-7-550x550.jpg 550w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-7.jpg 600w" sizes="(max-width: 110px) 100vw, 110px" /> </a>
                                </div>
                            </div>
                            <div class="mkdf-gallery-image">
                                <div class="mkdf-overlay-holder">
                                    <div class="mkdf-overlay-inner"></div>
                                    <a href="#" data-rel="prettyPhoto[single_pretty_photo]" title="sidearea-image-8">
                                        <div class="mkdf-overlay-inner"></div>
                                        <img width="110" height="110" src="<?= Yii::$app->homeUrl; ?>wp-content/uploads/2016/01/sidearea-image-8-110x110.jpg" class="attachment-thumbnail size-thumbnail" alt="q" srcset="http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-8-110x110.jpg 110w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-8-300x300.jpg 300w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-8-188x188.jpg 188w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-8-550x550.jpg 550w, http://wellspring.mikado-themes.com/wp-content/uploads/2016/01/sidearea-image-8.jpg 600w" sizes="(max-width: 110px) 100vw, 110px" /> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="mkdf-wrapper">
            <div class="mkdf-wrapper-inner">

                <div class="mkdf-top-bar">
                    <div class="mkdf-grid">
                        <div class="mkdf-vertical-align-containers mkdf-66-33">
                            <div class="mkdf-position-left mkdf-top-bar-widget-area">
                                <div class="mkdf-position-left-inner mkdf-top-bar-widget-area-inner">
                                    <div id="text-6" class="widget widget_text mkdf-top-bar-widget">
                                        <div class="mkdf-top-bar-widget-inner">
                                            <div class="textwidget">
                                                <div style="margin-bottom: 0px" class="mkdf-icon-list-item mkdf-icon-list-item-default-font-family">
                                                    <div class="mkdf-icon-list-icon-holder">
                                                        <div class="mkdf-icon-list-icon-holder-inner clearfix">
                                                            <i class="mkdf-icon-linear-icon lnr lnr-clock " style="color:#ffffff;font-size:15px"></i> </div>
                                                    </div>
                                                    <p class="mkdf-icon-list-text" style="color:#ffffff;font-size:13px;font-weight: 600"> Mon - Sat 10.00 - 17.00</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="text-7" class="widget widget_text mkdf-top-bar-widget">
                                        <div class="mkdf-top-bar-widget-inner">
                                            <div class="textwidget">
                                                <div style="margin-bottom: 0px" class="mkdf-icon-list-item mkdf-icon-list-item-default-font-family">
                                                    <div class="mkdf-icon-list-icon-holder">
                                                        <div class="mkdf-icon-list-icon-holder-inner clearfix">
                                                            <i class="mkdf-icon-linear-icon lnr " style="color:#ffffff;font-size:15px;margin-top: -4px"><img src="<?= Yii::$app->homeUrl; ?>images/international-phn-icon.png"/></i> </div>
                                                    </div>
                                                    <p class="mkdf-icon-list-text" style="color:#ffffff;font-size:13px;font-weight: 600"> +44 7445 968106 </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="text-7" class="widget widget_text mkdf-top-bar-widget">
                                        <div class="mkdf-top-bar-widget-inner">
                                            <div class="textwidget">
                                                <div style="margin-bottom: 0px" class="mkdf-icon-list-item mkdf-icon-list-item-default-font-family">
                                                    <div class="mkdf-icon-list-icon-holder">
                                                        <div class="mkdf-icon-list-icon-holder-inner clearfix">
                                                            <i class="mkdf-icon-linear-icon lnr lnr-phone-handset  " style="color:#ffffff;font-size:15px"></i> </div>
                                                    </div>
                                                    <p class="mkdf-icon-list-text" style="color:#ffffff;font-size:13px;font-weight: 600;"> +91 90 20 599 599 </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="text-8" class="widget widget_text mkdf-top-bar-widget">
                                        <div class="mkdf-top-bar-widget-inner">
                                            <div class="textwidget">
                                                <div style="margin-bottom: 0px" class="mkdf-icon-list-item mkdf-icon-list-item-default-font-family">
                                                    <div class="mkdf-icon-list-icon-holder">
                                                        <div class="mkdf-icon-list-icon-holder-inner clearfix">
                                                            <i class="mkdf-icon-linear-icon lnr lnr-bubble  " style="color:#ffffff;font-size:15px"></i> </div>
                                                    </div>
                                                    <p class="mkdf-icon-list-text" style="color:#ffffff;font-size:13px;font-weight: 600"> info@caringpeople.in</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mkdf-position-right mkdf-top-bar-widget-area">
                                <div class="mkdf-position-right-inner mkdf-top-bar-widget-area-inner">
                                    <!--                                    <div id="text-9" class="widget widget_text mkdf-top-bar-widget"><div class="mkdf-top-bar-widget-inner">			<div class="textwidget"><div id="icl_lang_sel_widget-3" class="widget widget_icl_lang_sel_widget mkdf-top-bar-widget" style="position: static; padding-right: 0;"><div class="mkdf-top-bar-widget-inner"><div id="lang_sel"><ul><li><a href="#" class="lang_sel_sel icl-en">English</a> <ul><li class="icl-fr"><a href="#">French</a></li><li class="icl-de"><a href="#">German</a></li><li class="icl-it"><a href="#">Italian</a></li></ul></li></ul></div></div></div></div>
                                                                                </div></div>-->
                                    <div id="text-10" class="widget widget_text mkdf-top-bar-widget">
                                        <div class="mkdf-top-bar-widget-inner">
                                            <div class="textwidget">
                                                <span class="mkdf-icon-shortcode normal" style="margin: 7px 7px 0 0" data-color="#ffffff">
                                                    <a href="https://twitter.com/" target="_blank">

                                                        <span aria-hidden="true" class="mkdf-icon-font-elegant social_twitter_circle mkdf-icon-element" style="color: #ffffff;font-size:17px" ></span>
                                                    </a>
                                                </span>

                                                <span class="mkdf-icon-shortcode normal" style="margin: 0 7px 0 0" data-color="#ffffff">
                                                    <a href="https://www.facebook.com/" target="_blank">

                                                        <span aria-hidden="true" class="mkdf-icon-font-elegant social_facebook_circle mkdf-icon-element" style="color: #ffffff;font-size:17px" ></span>
                                                    </a>
                                                </span>

                                                <span class="mkdf-icon-shortcode normal" style="margin: 0 7px 0 0" data-color="#ffffff">
                                                    <a href="https://www.linkedin.com/" target="_blank">

                                                        <span aria-hidden="true" class="mkdf-icon-font-elegant social_linkedin_circle mkdf-icon-element" style="color: #ffffff;font-size:17px" ></span>
                                                    </a>
                                                </span>

                                                <span class="mkdf-icon-shortcode normal" style="margin: 0 0 0 0" data-color="#ffffff">
                                                    <a href="https://vimeo.com/" target="_blank">

                                                        <span aria-hidden="true" class="mkdf-icon-font-elegant social_vimeo_circle mkdf-icon-element" style="color: #ffffff;font-size:17px" ></span>
                                                    </a>
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <header class="mkdf-page-header">
                    <div class="mkdf-menu-area">
                        <div class="mkdf-grid">
                            <div class="mkdf-vertical-align-containers">
                                <div class="mkdf-position-left">
                                    <div class="mkdf-position-left-inner">

                                        <div class="mkdf-logo-wrapper">
                                            <a href="index.php" style="height: 60px;">
                                                <img height="88" width="358" class="mkdf-normal-logo" src="<?= Yii::$app->homeUrl; ?>images/logo.png" alt="logo" />
                                                <img height="88" width="358" class="mkdf-dark-logo" src="<?= Yii::$app->homeUrl; ?>images/logo.png" alt="dark logo" /> <img height="88" width="358" class="mkdf-light-logo" src="images/logo.png" alt="light logo" /> </a>
                                        </div>

                                    </div>
                                </div>
                                <div class="mkdf-position-right">
                                    <div class="mkdf-position-right-inner">

                                        <nav class="mkdf-main-menu mkdf-drop-down mkdf-default-nav">
                                            <ul id="menu-top-menu" class="clearfix">
                                                <li id="nav-menu-item-12" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children has_sub narrow <?= basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'index' ? 'mkdf-active-item' : '' ?>"><a href="<?= Yii::$app->homeUrl ?>site/index" class=" current"><span class="item_outer"><span class="item_inner"><span class="item_text">Home</span></span><span class="plus"></span></span></a>
                                                </li>
                                                <li id="nav-menu-item-13" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub wide <?= basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'about-us' ? 'mkdf-active-item' : '' ?>"><a href="<?= Yii::$app->homeUrl ?>site/about"><span class="item_outer"><span class="item_inner"><span class="item_text">About Us</span></span><span class="plus"></span></span></a>
                                                </li>

                                                <?php
                                                if (basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'doctor-visit' || basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'nursing-care' || basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'caregiver-service' || basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'under-construction' || basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'under-construction' || basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'under-construction' || basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'under-construction' || basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'under-construction' || basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'under-construction' || basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'under-construction') {
                                                    $active = 'mkdf-active-item';
                                                } else {
                                                    $active = '';
                                                }
                                                ?>

                                                <li id="nav-menu-item-15" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub narrow <?= $active; ?>"><a href="#" class=" no_link" onclick="JavaScript: return false;"><span class="item_outer"><span class="item_inner"><span class="item_text">Services</span></span><span class="plus"></span></span></a>
                                                    <div class="second ">
                                                        <div class="inner">
                                                            <ul>
                                                                <li id="nav-menu-item-602" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="<?= Yii::$app->homeUrl; ?>site/services?service=doctor-visit" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">Doctor Visit</span></span><span class="plus"></span></span></a></li>
                                                                <li id="nav-menu-item-601" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="<?= Yii::$app->homeUrl; ?>site/services?service=nursing-care" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">Nursing Care</span></span><span class="plus"></span></span></a></li>
                                                                <li id="nav-menu-item-600" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="<?= Yii::$app->homeUrl; ?>site/services?service=nursing-carecaregiver" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">Caregiver Service</span></span><span class="plus"></span></span></a></li>
                                                                <li id="nav-menu-item-607" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="<?= Yii::$app->homeUrl; ?>site/services?service=laboratory" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">Laboratory</span></span><span class="plus"></span></span></a></li>
                                                                <li id="nav-menu-item-607" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="<?= Yii::$app->homeUrl; ?>site/services?service=pharmacy" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">Pharmacy</span></span><span class="plus"></span></span></a></li>
                                                                <li id="nav-menu-item-607" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="<?= Yii::$app->homeUrl; ?>site/services?service=equipment-hire" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">Equipment Hire or Purchase</span></span><span class="plus"></span></span></a></li>
                                                                <li id="nav-menu-item-613" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children sub"><a href="<?= Yii::$app->homeUrl; ?>site/services?service=health-check-up" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">Health Check-up</span></span><span class="plus"></span><!--<i class="q_menu_arrow fa fa-angle-right"></i>--></span></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li id="nav-menu-item-2597" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub narrow <?= basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'testimonial' ? 'mkdf-active-item' : '' ?>"><a href="<?= Yii::$app->homeUrl; ?>site/testimonial"><span class="item_outer"><span class="item_inner"><span class="item_text">Testimonials</span></span><span class="plus"></span></span></a>
                                                </li>
                                                <li id="nav-menu-item-14" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub narrow <?= basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'feedback' ? 'mkdf-active-item' : '' ?>"><a href="<?= Yii::$app->homeUrl; ?>site/feedback"><span class="item_outer"><span class="item_inner"><span class="item_text">Feedback</span></span><span class="plus"></span></span></a>
                                                </li>
                                                <li id="nav-menu-item-501" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub narrow <?= basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'gallery' ? 'mkdf-active-item' : '' ?>"><a href="<?= Yii::$app->homeUrl; ?>site/gallery"><span class="item_outer"><span class="item_inner"><span class="item_text">Gallery</span></span><span class="plus"></span></span></a>
                                                </li>
                                                <li id="nav-menu-item-16" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub narrow <?= basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'contact' ? 'mkdf-active-item' : '' ?>"><a href="<?= Yii::$app->homeUrl; ?>site/contact"><span class="item_outer"><span class="item_inner"><span class="item_text">Contact</span></span><span class="plus"></span></span></a>
                                                </li>
                                            </ul>
                                        </nav>

                                        <div class="mkdf-main-menu-widget-area">
                                            <div class="mkdf-main-menu-widget-area-inner">
                                                <div id="mkdf_side_area_opener-2" class="widget widget_mkdf_side_area_opener mkdf-right-from-main-menu-widget">
                                                    <div class="mkdf-right-from-main-menu-widget-inner">
                                                        <a href="javascript:void(0)" class=" no_link" onclick="JavaScript: return false;">
                                                            <span aria-hidden="true">LogIn</span> </a>
                                                        <!--                                                        <a class="mkdf-side-menu-button-opener large " href="javascript:void(0)" class=" no_link" onclick="JavaScript: return false;">
                                                                                                                    <span aria-hidden="true">LogIn</span> </a>-->

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mkdf-sticky-header">
                        <div class="mkdf-sticky-holder">
                            <div class="mkdf-grid">
                                <div class=" mkdf-vertical-align-containers">
                                    <div class="mkdf-position-left">
                                        <div class="mkdf-position-left-inner">

                                            <div class="mkdf-logo-wrapper">
                                                <a href="index.php" style="height: 44px;">
                                                    <img height="88" width="358" class="mkdf-normal-logo" src="<?= Yii::$app->homeUrl; ?>images/logo.png" alt="logo" />
                                                    <img height="88" width="358" class="mkdf-dark-logo" src="<?= Yii::$app->homeUrl; ?>images/logo.png" alt="dark logo" /> <img height="88" width="358" class="mkdf-light-logo" src="images/logo.png" alt="light logo" /> </a>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="mkdf-position-right">
                                        <div class="mkdf-position-right-inner">

                                            <nav class="mkdf-main-menu mkdf-drop-down mkdf-sticky-nav">
                                                <ul id="menu-top-menu-1" class="clearfix">
                                                    <li id="sticky-nav-menu-item-12" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children has_sub narrow <?= basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'index' ? 'mkdf-active-item' : '' ?>"><a href="index.php" class=" current"><span class="item_outer"><span class="item_inner"><span class="item_text">Home</span></span><span class="plus"></span></span></a>
                                                    </li>
                                                    <li id="sticky-nav-menu-item-13" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub wide <?= basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'about-us' ? 'mkdf-active-item' : '' ?>"><a href="about-us.php"><span class="item_outer"><span class="item_inner"><span class="item_text">About Us</span></span><span class="plus"></span></span></a>
                                                    </li>

                                                    <?php
                                                    if (basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'doctor-visit' || basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'nursing-care' || basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'caregiver-service' || basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'under-construction' || basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'under-construction' || basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'under-construction' || basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'under-construction' || basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'under-construction' || basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'under-construction' || basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'under-construction') {
                                                        $active = 'mkdf-active-item';
                                                    } else {
                                                        $active = '';
                                                    }
                                                    ?>

                                                    <li id="sticky-nav-menu-item-15" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub narrow <?= $active; ?>"><a href="#" class=" no_link" onclick="JavaScript: return false;"><span class="item_outer"><span class="item_inner"><span class="item_text">Services</span></span><span class="plus"></span></span></a>
                                                        <div class="second ">
                                                            <div class="inner">
                                                                <ul>
                                                                    <li id="nav-menu-item-602" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="doctor-visit.php" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">Doctor Visit</span></span><span class="plus"></span></span></a></li>
                                                                    <li id="nav-menu-item-601" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="nursing-care.php" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">Nursing Care</span></span><span class="plus"></span></span></a></li>
                                                                    <li id="nav-menu-item-600" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="caregiver-service.php" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">Caregiver Service</span></span><span class="plus"></span></span></a></li>
                                                                    <li id="nav-menu-item-607" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="under-construction.php" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">Laboratory</span></span><span class="plus"></span></span></a></li>
                                                                    <li id="nav-menu-item-607" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="under-construction.php" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">Pharmacy</span></span><span class="plus"></span></span></a></li>
                                                                    <li id="nav-menu-item-607" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="under-construction.php" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">Equipment Hire or Purchase</span></span><span class="plus"></span></span></a></li>
                                                                    <li id="nav-menu-item-613" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children sub"><a href="under-construction.php" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">Health Check-up</span></span><span class="plus"></span><!--<i class="q_menu_arrow fa fa-angle-right"></i>--></span></a>
                                                                        <!--                                                                    <ul  >
                                                                                                                                                    <li id="nav-menu-item-614" class="menu-item menu-item-type-custom menu-item-object-custom "><a href="the-benefits-of-detoxification/index.php" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">Standard</span></span><span class="plus"></span></span></a></li>
                                                                                                                                                    <li id="nav-menu-item-617" class="menu-item menu-item-type-custom menu-item-object-custom "><a href="you-dont-need-another-excuse/index.php" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">Gallery</span></span><span class="plus"></span></span></a></li>
                                                                                                                                                    <li id="nav-menu-item-615" class="menu-item menu-item-type-custom menu-item-object-custom "><a href="superfood-secrets-for-a-healthy-life/index.php" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">Audio</span></span><span class="plus"></span></span></a></li>
                                                                                                                                                    <li id="nav-menu-item-619" class="menu-item menu-item-type-custom menu-item-object-custom "><a href="walk-a-little-lose-a-lot/index.php" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">Video</span></span><span class="plus"></span></span></a></li>
                                                                                                                                                    <li id="nav-menu-item-618" class="menu-item menu-item-type-custom menu-item-object-custom "><a href="dalai-lama/index.php" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">Quote</span></span><span class="plus"></span></span></a></li>
                                                                                                                                                    <li id="nav-menu-item-616" class="menu-item menu-item-type-custom menu-item-object-custom "><a href="secrets-to-regular-exercise-motivation/index.php" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">Link</span></span><span class="plus"></span></span></a></li>
                                                                                                                                                </ul>-->
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li id="sticky-nav-menu-item-2597" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub narrow <?= basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'testimonial' ? 'mkdf-active-item' : '' ?>"><a href="testimonial.php"><span class="item_outer"><span class="item_inner"><span class="item_text">Testimonials</span></span><span class="plus"></span></span></a>
                                                    </li>
                                                    <li id="sticky-nav-menu-item-14" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub narrow <?= basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'feedback' ? 'mkdf-active-item' : '' ?>"><a href="feedback.php"><span class="item_outer"><span class="item_inner"><span class="item_text">Feedback</span></span><span class="plus"></span></span></a>
                                                    </li>
                                                    <li id="sticky-nav-menu-item-501" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub narrow <?= basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'gallery' ? 'mkdf-active-item' : '' ?>"><a href="gallery.php"><span class="item_outer"><span class="item_inner"><span class="item_text">Gallery</span></span><span class="plus"></span></span></a>
                                                        <!--                                                    <div class="second " ><div class="inner"><ul  >
                                                                                                                            <li id="nav-menu-item-609" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="shop-home/index.php" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">Shop Home<span class="mkdf-menu-featured-icon icon_star" aria-hidden="true"></span></span></span><span class="plus"></span></span></a></li>
                                                                                                                            <li id="nav-menu-item-567" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="shop/index.php" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">Shop With Sidebar</span></span><span class="plus"></span></span></a></li>
                                                                                                                            <li id="nav-menu-item-571" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="shop-three-columns/index.php" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">Shop Three Columns</span></span><span class="plus"></span></span></a></li>
                                                                                                                            <li id="nav-menu-item-574" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="shop-four-columns/index.php" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">Shop Four Columns</span></span><span class="plus"></span></span></a></li>
                                                                                                                            <li id="nav-menu-item-577" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="shop-full-width/index.php" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">Shop Full Width</span></span><span class="plus"></span></span></a></li>
                                                                                                                            <li id="nav-menu-item-579" class="menu-item menu-item-type-custom menu-item-object-custom "><a href="product/foam-toning-roller/index.php" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">Single Product</span></span><span class="plus"></span></span></a></li>
                                                                                                                        </ul></div></div>-->
                                                    </li>
                                                    <li id="sticky-nav-menu-item-16" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub narrow <?= basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'contact' ? 'mkdf-active-item' : '' ?>"><a href="contact.php"><span class="item_outer"><span class="item_inner"><span class="item_text">Contact</span></span><span class="plus"></span></span></a>
                                                    </li>
                                                    <li id="sticky-nav-menu-item-2022" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub narrow"><a href="#" class=" no_link" onclick="JavaScript: return false;"><span class="item_outer"><span class="item_inner"><span class="item_text">Log In</span></span><span class="plus"></span></span></a>
                                                        <!--                                                        <div class="second " ><div class="inner"><ul  >
                                                                                                                                <li id="sticky-nav-menu-item-2027" class="menu-item menu-item-type-post_type_archive menu-item-object-forum "><a href="forums/index.php" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">All Forums</span></span><span class="plus"></span></span></a></li>
                                                                                                                                <li id="sticky-nav-menu-item-2334" class="menu-item menu-item-type-post_type menu-item-object-forum "><a href="forums/forum/general-fitness/index.php" class=""><span class="item_outer"><span class="item_inner"><span class="item_text">General Fitness</span></span><span class="plus"></span></span></a></li>
                                                                                                                            </ul></div></div>-->
                                                    </li>
                                                </ul>
                                            </nav>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </header>

                <header class="mkdf-mobile-header">
                    <div class="mkdf-mobile-header-inner">
                        <div class="mkdf-mobile-header-holder">
                            <div class="mkdf-grid">
                                <div class="mkdf-vertical-align-containers">
                                    <div class="mkdf-mobile-menu-opener">
                                        <a href="javascript:void(0)">
                                            <span class="mkdf-mobile-opener-icon-holder">
                                                <i class="mkdf-icon-font-awesome fa fa-bars " ></i>                    </span>
                                        </a>
                                    </div>
                                    <div class="mkdf-position-center">
                                        <div class="mkdf-position-center-inner">

                                            <div class="mkdf-mobile-logo-wrapper">
                                                <a href="index.php" style="height: 44px">
                                                    <img height="88" width="358" src="<?= Yii::$app->homeUrl; ?>images/logo.png" alt="mobile-logo" />
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="mkdf-position-right">
                                        <div class="mkdf-position-right-inner">
                                        </div>
                                    </div>
                                </div>
                                <!-- close .mkdf-vertical-align-containers -->
                            </div>
                        </div>

                        <nav class="mkdf-mobile-nav">
                            <div class="mkdf-grid">
                                <ul id="menu-top-menu-2" class="">
                                    <li id="mobile-menu-item-12" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children mkdf-active-item has_sub">
                                        <h4><a href="index.php"><span class="item_outer"><span class="item_inner"><span class="item_text">Home</span></span><span class="mobile_arrow"></span></span></a>
                                    </li>
                                    <li id="mobile-menu-item-13" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub">
                                        <h4><a href="about-us.php"><span class="item_outer"><span class="item_inner"><span class="item_text">About US</span></span><span class="mobile_arrow"></span></span></a>
                                    </li>
                                    <li id="mobile-menu-item-15" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub">
                                        <h4><span>Services</span></h4><span class="mobile_arrow"><i class="mkdf-sub-arrow fa fa-angle-right"></i><i class="fa fa-angle-down"></i></span>
                                        <ul class="sub_menu">
                                            <li id="mobile-menu-item-602" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="#" class=""><span>Doctor Visit</span></a></li>
                                            <li id="mobile-menu-item-601" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="#" class=""><span>Nursing Care at Home</span></a></li>
                                            <li id="mobile-menu-item-600" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="#" class=""><span>Physiotherapy</span></a></li>
                                            <li id="mobile-menu-item-607" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="#" class=""><span>Bystander or Caregiver Service</span></a></li>
                                            <li id="mobile-menu-item-608" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="#" class=""><span>Companion Care</span></a></li>
                                        </ul>
                                    </li>
                                    <li id="mobile-menu-item-2022" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub">
                                        <h4><a href="testimonial.php"><span class="item_outer"><span class="item_inner"><span class="item_text">Testimonials</span></span><span class="mobile_arrow"></span></span></a>
                                    </li>
                                    <li id="mobile-menu-item-2597" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub">
                                        <h4><a href="feedback.php"><span class="item_outer"><span class="item_inner"><span class="item_text">Feedback</span></span><span class="mobile_arrow"></span></span></a>
                                    </li>
                                    <li id="mobile-menu-item-14" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub">
                                        <h4><a href="gallery.php"><span class="item_outer"><span class="item_inner"><span class="item_text">Gallery</span></span><span class="mobile_arrow"></span></span></a>
                                    </li>
                                    <li id="mobile-menu-item-16" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub">
                                        <h4><a href="contact.php"><span class="item_outer"><span class="item_inner"><span class="item_text">Contact</span></span><span class="mobile_arrow"></span></span></a>
                                    </li>
                                </ul>
                            </div>
                        </nav>

                    </div>
                </header>
                <!-- close .mkdf-mobile-header -->

                <a id='mkdf-back-to-top' href='#'>
                    <span class="mkdf-icon-stack">
                        <span aria-hidden="true" class="mkdf-icon-font-elegant arrow_carrot-up " ></span> </span>
                    <span class="mkdf-back-to-top-inner">
                        <span class="mkdf-back-to-top-text">Top</span>
                    </span>
                </a>

                <?php $this->beginBody() ?>


                <?= $content ?>



                <?php $this->endBody() ?>

                <footer class="mkdf-page-footer">
                    <div class="mkdf-footer-inner clearfix">

                        <div class="mkdf-footer-top-holder">
                            <div class="mkdf-footer-top mkdf-footer-top-aligment-left">

                                <div class="mkdf-container">
                                    <div class="mkdf-container-inner">

                                        <div class="mkdf-four-columns clearfix">
                                            <div class="mkdf-four-columns-inner">
                                                <div class="mkdf-column">
                                                    <div class="mkdf-column-inner">
                                                        <div id="text-13" class="widget mkdf-footer-column-1 widget_text">
                                                            <div class="textwidget">
                                                                <div data-original-height="15" class="vc_empty_space" style="height: 15px"><span class="vc_empty_space_inner"></span></div>

                                                                <a href="index.html">
                                                                    <img width="179" height="44" src="<?= Yii::$app->homeUrl; ?>images/logo.png" alt="logo">
                                                                </a>
                                                                <div data-original-height="16" class="vc_empty_space" style="height: 16px"><span class="vc_empty_space_inner"></span></div>

                                                                Caring People is a highly distinct firm specializing as an in-home service provider, which supports the clients by offering comprehensive services so as to lead dignified and independent lifestyles in the comfort and safety of their own homes. We are a professional team designed to provide an outstanding service to our clients.

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mkdf-column">
                                                    <div class="mkdf-column-inner">
                                                        <div class="widget mkdf-latest-posts-widget">
                                                            <h3 class="mkdf-footer-widget-title">Address</h3>
                                                            <h4 style="margin-bottom: 5px; margin-top: 0px;" class="mkdf-footer-widget-title">Cochin</h4>
                                                            <div class="mkdf-blog-list-holder  mkdf-minimal">
                                                                <div style="margin-bottom: 10px" class="mkdf-icon-list-item mkdf-icon-list-item-default-font-family">
                                                                    <div class="mkdf-icon-list-icon-holder">
                                                                        <div class="mkdf-icon-list-icon-holder-inner clearfix">
                                                                            <i class="fa fa-home" aria-hidden="true" style="color:#ffffff;font-size:15px"></i>
                                                                        </div>
                                                                    </div>
                                                                    <p class="mkdf-icon-list-text" style="color:#ffffff;font-size:12px;font-weight: 600"> Caring People
                                                                        <br> Door No. 5 ,DD Vyapar Bhavan
                                                                        <br> K P Vallon Road
                                                                        <br> Kadavnthra
                                                                        <br> Cochin 20</p>
                                                                </div>
                                                                <div style="margin-bottom: 10px" class="mkdf-icon-list-item mkdf-icon-list-item-default-font-family">
                                                                    <div class="mkdf-icon-list-icon-holder">
                                                                        <div class="mkdf-icon-list-icon-holder-inner clearfix">
                                                                            <i class="mkdf-icon-linear-icon lnr lnr-clock " style="color:#ffffff;font-size:15px"></i> </div>
                                                                    </div>
                                                                    <p class="mkdf-icon-list-text" style="color:#ffffff;font-size:12px;font-weight: 600"> Mon - Sat 10.00 - 17.00 Sunday CLOSED</p>
                                                                </div>
                                                                <div style="margin-bottom: 10px" class="mkdf-icon-list-item mkdf-icon-list-item-default-font-family">
                                                                    <div class="mkdf-icon-list-icon-holder">
                                                                        <div class="mkdf-icon-list-icon-holder-inner clearfix">
                                                                            <i class="mkdf-icon-linear-icon lnr lnr-phone-handset " style="color:#ffffff;font-size:15px"></i> </div>
                                                                    </div>
                                                                    <p class="mkdf-icon-list-text" style="color:#ffffff;font-size:12px;font-weight: 600"> 0484 403 3 505 </p>
                                                                </div>
                                                                <div style="margin-bottom: 10px" class="mkdf-icon-list-item mkdf-icon-list-item-default-font-family">
                                                                    <div class="mkdf-icon-list-icon-holder">
                                                                        <div class="mkdf-icon-list-icon-holder-inner clearfix">
                                                                            <i class="mkdf-icon-linear-icon lnr lnr-bubble  " style="color:#ffffff;font-size:15px"></i> </div>
                                                                    </div>
                                                                    <p class="mkdf-icon-list-text" style="color:#ffffff;font-size:12px;font-weight: 600"> info@caringpeople.in
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mkdf-column">
                                                    <div class="mkdf-column-inner">
                                                        <div class="widget mkdf-latest-posts-widget">
                                                            <br/>
                                                            <br/>
                                                            <br/>
                                                            <h4 style="margin-bottom: 5px; margin-top: 0px;" class="mkdf-footer-widget-title">Mumbai</h4>
                                                            <div class="mkdf-blog-list-holder  mkdf-minimal">
                                                                <div style="margin-bottom: 10px" class="mkdf-icon-list-item mkdf-icon-list-item-default-font-family">
                                                                    <div class="mkdf-icon-list-icon-holder">
                                                                        <div class="mkdf-icon-list-icon-holder-inner clearfix">
                                                                            <i class="fa fa-home" aria-hidden="true" style="color:#ffffff;font-size:15px"></i>
                                                                        </div>
                                                                    </div>
                                                                    <p class="mkdf-icon-list-text" style="color:#ffffff;font-size:12px;font-weight: 600"> Caring People
                                                                        <br> Shop No 16,
                                                                        <br> Brindavan Co-operative Housing Society Ltd,
                                                                        <br> Evershine Nagar,
                                                                        Malad West
                                                                        <br> Mumbai-400064</p>
                                                                </div>
                                                                <div style="margin-bottom: 10px" class="mkdf-icon-list-item mkdf-icon-list-item-default-font-family">
                                                                    <div class="mkdf-icon-list-icon-holder">
                                                                        <div class="mkdf-icon-list-icon-holder-inner clearfix">
                                                                            <i class="mkdf-icon-linear-icon lnr lnr-clock " style="color:#ffffff;font-size:15px"></i> </div>
                                                                    </div>
                                                                    <p class="mkdf-icon-list-text" style="color:#ffffff;font-size:12px;font-weight: 600"> Mon - Sat 10.00 - 17.00 Sunday CLOSED</p>
                                                                </div>
                                                                <div style="margin-bottom: 10px" class="mkdf-icon-list-item mkdf-icon-list-item-default-font-family">
                                                                    <div class="mkdf-icon-list-icon-holder">
                                                                        <div class="mkdf-icon-list-icon-holder-inner clearfix">
                                                                            <i class="mkdf-icon-linear-icon lnr lnr-phone-handset " style="color:#ffffff;font-size:15px"></i> </div>
                                                                    </div>
                                                                    <p class="mkdf-icon-list-text" style="color:#ffffff;font-size:12px;font-weight: 600"> 022 40 111 351 </p>
                                                                </div>
                                                                <div style="margin-bottom: 10px" class="mkdf-icon-list-item mkdf-icon-list-item-default-font-family">
                                                                    <div class="mkdf-icon-list-icon-holder">
                                                                        <div class="mkdf-icon-list-icon-holder-inner clearfix">
                                                                            <i class="mkdf-icon-linear-icon lnr lnr-bubble  " style="color:#ffffff;font-size:15px"></i> </div>
                                                                    </div>
                                                                    <p class="mkdf-icon-list-text" style="color:#ffffff;font-size:12px;font-weight: 600"> info@caringpeople.in
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mkdf-column">
                                                    <div class="mkdf-column-inner">
                                                        <div id="text-3" class="widget mkdf-footer-column-4 widget_text">
                                                            <div class="textwidget">
                                                                <h3 style="color: #ffffff;">Contact</h3>
                                                                <div data-original-height="1" class="vc_empty_space" style="height: 1px"><span class="vc_empty_space_inner"></span></div>

                                                                <div role="form" class="wpcf7" id="wpcf7-f219-o1" lang="en-US" dir="ltr">
                                                                    <div class="screen-reader-response"></div>
                                                                    <form action="#" method="post" class="wpcf7-form cf7_custom_style_1" novalidate="novalidate">
                                                                        <div style="display: none;">
                                                                            <input type="hidden" name="_wpcf7" value="219" />
                                                                            <input type="hidden" name="_wpcf7_version" value="4.3.1" />
                                                                            <input type="hidden" name="_wpcf7_locale" value="en_US" />
                                                                            <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f219-o1" />
                                                                            <input type="hidden" name="_wpnonce" value="39df413e57" />
                                                                        </div>
                                                                        <p><span class="wpcf7-form-control-wrap your-name"><input type="text" name="your-name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Name*" /></span></p>
                                                                        <p><span class="wpcf7-form-control-wrap your-email"><input type="email" name="your-email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" placeholder="Email*" /></span></p>
                                                                        <div><span class="wpcf7-form-control-wrap your-message"><textarea name="your-message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Comment*"></textarea></span></div>
                                                                        <div>
                                                                            <input type="submit" value="Submit" class="wpcf7-form-control wpcf7-submit" />
                                                                        </div>
                                                                        <div class="wpcf7-response-output wpcf7-display-none"></div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mkdf-footer-bottom-holder">
                            <div class="mkdf-footer-bottom-holder-inner">
                                <div class="mkdf-container">
                                    <div class="mkdf-container-inner">

                                        <div class="mkdf-two-columns-50-50 clearfix">
                                            <div class="mkdf-two-columns-50-50-inner">
                                                <div class="mkdf-column">
                                                    <div class="mkdf-column-inner">
                                                        <div id="text-4" class="widget mkdf-footer-bottom-left widget_text">
                                                            <div class="textwidget">Copyrights 2017 © <span style="color:#8f8f8f;">Caringpeople</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mkdf-column">
                                                    <div class="mkdf-column-inner">
                                                        <div id="text-5" class="widget mkdf-footer-bottom-left widget_text">
                                                            <div class="textwidget">Follow Us
                                                                <span class="mkdf-icon-shortcode normal" style="margin: 0 7px 0 10px" data-color="#ffffff">
                                                                    <a href="https://twitter.com/" target="_blank">

                                                                        <span aria-hidden="true" class="mkdf-icon-font-elegant social_twitter_circle mkdf-icon-element" style="color: #ffffff;font-size:21px" ></span>
                                                                    </a>
                                                                </span>

                                                                <span class="mkdf-icon-shortcode normal" style="margin: 0 7px 0 0" data-color="#ffffff">
                                                                    <a href="https://www.facebook.com/" target="_blank">

                                                                        <span aria-hidden="true" class="mkdf-icon-font-elegant social_facebook_circle mkdf-icon-element" style="color: #ffffff;font-size:21px" ></span>
                                                                    </a>
                                                                </span>

                                                                <span class="mkdf-icon-shortcode normal" style="margin: 0 7px 0 0" data-color="#ffffff">
                                                                    <a href="https://www.linkedin.com/" target="_blank">

                                                                        <span aria-hidden="true" class="mkdf-icon-font-elegant social_linkedin_circle mkdf-icon-element" style="color: #ffffff;font-size:21px" ></span>
                                                                    </a>
                                                                </span>

                                                                <span class="mkdf-icon-shortcode normal" style="margin: 0 0 0 0" data-color="#ffffff">
                                                                    <a href="https://vimeo.com/" target="_blank">

                                                                        <span aria-hidden="true" class="mkdf-icon-font-elegant social_vimeo_circle mkdf-icon-element" style="color: #ffffff;font-size:21px" ></span>
                                                                    </a>
                                                                </span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </footer>

            </div>
            <!-- close div.mkdf-wrapper-inner  -->
        </div>
        <!-- close div.mkdf-wrapper -->
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/plugins/revslider/public/assets/js/jquery.themepunch.tools.minafe3.js?rev=5.1.6'></script>
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/plugins/revslider/public/assets/js/jquery.themepunch.revolution.minafe3.js?rev=5.1.6'></script>
        <script>
                                                        var htmlDiv = document.getElementById("rs-plugin-settings-inline-css");
                                                        var htmlDivCss = ".tp-caption.Default-Title-1,.Default-Title-1{color:rgba(255,255,255,1.00);font-size:75px;line-height:80px;font-weight:700;font-style:normal;font-family:Josefin Sans;padding:0px 0px 0px 0px;text-decoration:none;text-align:left;background-color:transparent;border-color:transparent;border-style:none;border-width:0px;border-radius:0px 0px 0px 0px}.tp-caption.Button,.Button{color:rgba(255,255,255,1.00);font-size:16px;line-height:16px;font-weight:700;font-style:normal;font-family:Open Sans;padding:17px 46px 17px 46px;text-decoration:none;text-align:left;background-color:rgba(79,191,112,1.00);border-color:rgba(79,191,112,1.00);border-style:solid;border-width:2px;border-radius:30px 30px 30px 30px}.tp-caption.Button:hover,.Button:hover{color:rgba(79,191,112,1.00);text-decoration:none;background-color:rgba(255,255,255,1.00);border-color:rgba(255,255,255,1.00);border-style:solid;border-width:2px;border-radius:30px 30px 30px 30px;cursor:pointer}.tp-caption.Default-Subtitle,.Default-Subtitle{color:rgba(128,128,128,1.00);font-size:17px;line-height:30px;font-weight:400;font-style:normal;font-family:Open Sans;padding:0px 0px 0px 0px;text-decoration:none;text-align:left;background-color:transparent;border-color:transparent;border-style:none;border-width:0px;border-radius:0px 0px 0px 0px}";
                                                        if (htmlDiv) {
                                                            htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
                                                        } else {
                                                            var htmlDiv = document.createElement("div");
                                                            htmlDiv.innerHTML = "<style>" + htmlDivCss + "</style>";
                                                            document.getElementsByTagName("head")[0].appendChild(htmlDiv.childNodes[0]);
                                                        }
        </script>
        <script type="text/javascript">
            /******************************************
             -	PREPARE PLACEHOLDER FOR SLIDER	-
             ******************************************/

            var setREVStartSize = function () {
                try {
                    var e = new Object,
                            i = jQuery(window).width(),
                            t = 9999,
                            r = 0,
                            n = 0,
                            l = 0,
                            f = 0,
                            s = 0,
                            h = 0;
                    e.c = jQuery('#rev_slider_11_1');
                    e.responsiveLevels = [1920, 1440, 778, 480];
                    e.gridwidth = [1400, 1200, 778, 480];
                    e.gridheight = [868, 700, 600, 600];
                    e.sliderLayout = "fullscreen";
                    e.fullScreenAutoWidth = 'off';
                    e.fullScreenAlignForce = 'off';
                    e.fullScreenOffsetContainer = '.mkdf-top-bar, .mkdf-page-header';
                    e.fullScreenOffset = '';
                    e.minHeight = 300;
                    if (e.responsiveLevels && (jQuery.each(e.responsiveLevels, function (e, f) {
                        f > i && (t = r = f, l = e), i > f && f > r && (r = f, n = e)
                    }), t > r && (l = n)), f = e.gridheight[l] || e.gridheight[0] || e.gridheight, s = e.gridwidth[l] || e.gridwidth[0] || e.gridwidth, h = i / s, h = h > 1 ? 1 : h, f = Math.round(h * f), "fullscreen" == e.sliderLayout) {
                        var u = (e.c.width(), jQuery(window).height());
                        if (void 0 != e.fullScreenOffsetContainer) {
                            var c = e.fullScreenOffsetContainer.split(",");
                            if (c)
                                jQuery.each(c, function (e, i) {
                                    u = jQuery(i).length > 0 ? u - jQuery(i).outerHeight(!0) : u
                                }), e.fullScreenOffset.split("%").length > 1 && void 0 != e.fullScreenOffset && e.fullScreenOffset.length > 0 ? u -= jQuery(window).height() * parseInt(e.fullScreenOffset, 0) / 100 : void 0 != e.fullScreenOffset && e.fullScreenOffset.length > 0 && (u -= parseInt(e.fullScreenOffset, 0))
                        }
                        f = u
                    } else
                        void 0 != e.minHeight && f < e.minHeight && (f = e.minHeight);
                    e.c.closest(".rev_slider_wrapper").css({
                        height: f
                    })

                } catch (d) {
                    console.log("Failure at Presize of Slider:" + d)
                }
            };
            setREVStartSize();
            function revslider_showDoubleJqueryError(sliderID) {
                var errorMessage = "Revolution Slider Error: You have some jquery.js library include that comes after the revolution files js include.";
                errorMessage += "<br> This includes make eliminates the revolution slider libraries, and make it not work.";
                errorMessage += "<br><br> To fix it you can:<br>&nbsp;&nbsp;&nbsp; 1. In the Slider Settings -> Troubleshooting set option:  <strong><b>Put JS Includes To Body</b></strong> option to true.";
                errorMessage += "<br>&nbsp;&nbsp;&nbsp; 2. Find the double jquery.js include and remove it.";
                errorMessage = "<span style='font-size:16px;color:#BC0C06;'>" + errorMessage + "</span>";
                jQuery(sliderID).show().html(errorMessage);
            }
            var tpj = jQuery;
            var revapi11;
            tpj(document).ready(function () {
                if (tpj("#rev_slider_11_1").revolution == undefined) {
                    revslider_showDoubleJqueryError("#rev_slider_11_1");
                } else {
                    revapi11 = tpj("#rev_slider_11_1").show().revolution({
                        sliderType: "standard",
                        jsFileLocation: "//wellspring.mikado-themes.com/wp-content/plugins/revslider/public/assets/js/",
                        sliderLayout: "fullscreen",
                        dottedOverlay: "none",
                        delay: 5000,
                        navigation: {
                            keyboardNavigation: "off",
                            keyboard_direction: "horizontal",
                            mouseScrollNavigation: "off",
                            onHoverStop: "off",
                            arrows: {
                                style: "wellspring-light",
                                enable: true,
                                hide_onmobile: true,
                                hide_under: 770,
                                hide_onleave: false,
                                tmp: '',
                                left: {
                                    h_align: "left",
                                    v_align: "center",
                                    h_offset: 20,
                                    v_offset: 0
                                },
                                right: {
                                    h_align: "right",
                                    v_align: "center",
                                    h_offset: 20,
                                    v_offset: 0
                                }
                            }
                        },
                        responsiveLevels: [1920, 1440, 778, 480],
                        visibilityLevels: [1920, 1440, 778, 480],
                        gridwidth: [1400, 1200, 778, 480],
                        gridheight: [868, 700, 600, 600],
                        lazyType: "none",
                        minHeight: 300,
                        parallax: {
                            type: "mouse+scroll",
                            origo: "enterpoint",
                            speed: 4000,
                            levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 51, 55],
                            type: "mouse+scroll",
                        },
                        shadow: 0,
                        spinner: "spinner2",
                        stopLoop: "off",
                        stopAfterLoops: -1,
                        stopAtSlide: -1,
                        shuffle: "off",
                        autoHeight: "off",
                        fullScreenAutoWidth: "off",
                        fullScreenAlignForce: "off",
                        fullScreenOffsetContainer: ".mkdf-top-bar, .mkdf-page-header",
                        fullScreenOffset: "",
                        disableProgressBar: "on",
                        hideThumbsOnMobile: "off",
                        hideSliderAtLimit: 0,
                        hideCaptionAtLimit: 0,
                        hideAllCaptionAtLilmit: 0,
                        debugMode: false,
                        fallbacks: {
                            simplifyAll: "off",
                            nextSlideOnWindowFocus: "on",
                            disableFocusListener: false,
                        }
                    });
                }
            }); /*ready*/
            jQuery.noConflict();
            jQuery(document).ready(function () {
                jQuery(".btn-close").click(function () {

                    // Set the effect type
                    var effect = 'slide';
                    // Set the options for the effect type chosen
                    var options = {direction: 'right'};
                    // Set the duration (default: 400 milliseconds)
                    var duration = 500;
                    jQuery('#style-selector').toggle(effect, options, duration);
                });
            });</script>
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/jquery/ui/core.min.js'></script>
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/jquery/ui/widget.min.js'></script>
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/jquery/ui/mouse.min.js'></script>
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/jquery/ui/resizable.min.js'></script>
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/jquery/ui/draggable.min.js'></script>
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/jquery/ui/button.min.js'></script>
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/jquery/ui/position.min.js'></script>
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/jquery/ui/dialog.min.js'></script>
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/wpdialog.min.js'></script>
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/plugins/bbpress/templates/default/js/editor.js'></script>
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/plugins/contact-form-7/includes/js/jquery.form.min.js'></script>
        <script type='text/javascript'>
            /* <![CDATA[ */
            var _wpcf7 = {
                "loaderUrl": "http:\/\/wellspring.mikado-themes.com\/wp-content\/plugins\/contact-form-7\/images\/ajax-loader.gif",
                "recaptchaEmpty": "Please verify that you are not a robot.",
                "sending": "Sending ..."
            };
            /* ]]> */
        </script>
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/plugins/contact-form-7/includes/js/scripts.js'></script>
        <!--<script type='text/javascript' src='wp-content/plugins/mikado-bmi-calculator/assets/js/bmi-calculator.js'></script>-->
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/jquery/ui/tabs.min.js'></script>
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/plugins/timetable/js/jquery.ba-bbq.min.js'></script>
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/plugins/timetable/js/jquery.carouFredSel-6.2.1-packed.js'></script>
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/plugins/timetable/js/timetable.js'></script>
        <!--<script type='text/javascript' src='wp-content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.min.js'></script>-->
        <script type='text/javascript'>
            /* <![CDATA[ */
            var woocommerce_params = {
                "ajax_url": "\/wp-admin\/admin-ajax.php",
                "wc_ajax_url": "\/?wc-ajax=%%endpoint%%"
            };
            /* ]]> */
        </script>
        <!--<script type='text/javascript' src='wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.min.js'></script>-->
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/plugins/woocommerce/assets/js/jquery-cookie/jquery.cookie.min.js'></script>
        <script type='text/javascript'>
            /* <![CDATA[ */
            var wc_cart_fragments_params = {
                "ajax_url": "\/wp-admin\/admin-ajax.php",
                "wc_ajax_url": "\/?wc-ajax=%%endpoint%%",
                "fragment_name": "wc_fragments"
            };
            /* ]]> */
        </script>
        <!--<script type='text/javascript' src='wp-content/plugins/woocommerce/assets/js/frontend/cart-fragments.min.js'></script>-->
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/jquery/ui/accordion.min.js'></script>
        <script type='text/javascript'>
            /* <![CDATA[ */
            var mejsL10n = {
                "language": "en-US",
                "strings": {
                    "Close": "Close",
                    "Fullscreen": "Fullscreen",
                    "Download File": "Download File",
                    "Download Video": "Download Video",
                    "Play\/Pause": "Play\/Pause",
                    "Mute Toggle": "Mute Toggle",
                    "None": "None",
                    "Turn off Fullscreen": "Turn off Fullscreen",
                    "Go Fullscreen": "Go Fullscreen",
                    "Unmute": "Unmute",
                    "Mute": "Mute",
                    "Captions\/Subtitles": "Captions\/Subtitles"
                }
            };
            var _wpmejsSettings = {
                "pluginPath": "\/wp-includes\/js\/mediaelement\/"
            };
            /* ]]> */
        </script>
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/mediaelement/mediaelement-and-player.min.js'></script>
        <!--<script type='text/javascript' src='wp-includes/js/mediaelement/wp-mediaelement.js'></script>-->
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/themes/wellspring/assets/js/third-party.min.js'></script>
        <!--<script type='text/javascript' src='wp-content/plugins/js_composer/assets/lib/bower/isotope/dist/isotope.pkgd.min.js'></script>-->
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/themes/wellspring/assets/js/smoothPageScroll.js'></script>
        <script type='text/javascript' src='http://maps.googleapis.com/maps/api/js'></script>
        <script type='text/javascript'>
            /* <![CDATA[ */
            var mkdfGlobalVars = {
                "vars": {
                    "mkdfAddForAdminBar": 0,
                    "mkdfElementAppearAmount": -150,
                    "mkdfFinishedMessage": "No more posts",
                    "mkdfMessage": "Loading new posts...",
                    "mkdfTopBarHeight": 40,
                    "mkdfStickyHeaderHeight": 0,
                    "mkdfStickyHeaderTransparencyHeight": 60,
                    "mkdfLogoAreaHeight": 0,
                    "mkdfMenuAreaHeight": 132,
                    "mkdfMobileHeaderHeight": 100
                }
            };
            var mkdfPerPageVars = {
                "vars": {
                    "mkdfStickyScrollAmount": 400,
                    "mkdfStickyScrollAmountFullScreen": true,
                    "mkdfHeaderTransparencyHeight": 0
                }
            };
            /* ]]> */
        </script>
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/themes/wellspring/assets/js/modules.min.js'></script>
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-content/themes/wellspring/assets/js/blog.min.js'></script>
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/comment-reply.min.js'></script>
        <!--<script type='text/javascript' src='wp-content/plugins/js_composer/assets/js/dist/js_composer_front.min.js'></script>-->
        <!--        <script type='text/javascript'>
                        /* <![CDATA[ */
                        var mkdfLike = {"ajaxurl":"http:\/\/wellspring.mikado-themes.com\/wp-admin\/admin-ajax.php", "labels":{"likeLabel":"Like", "likedLabel":"Liked", "likedTitle":"You already liked this"}};
                        /* ]]> */
                    </script>-->
        <!--<script type='text/javascript' src='wp-content/themes/wellspring/assets/js/like.min.js'></script>-->
        <script type='text/javascript' src='<?= Yii::$app->homeUrl; ?>wp-includes/js/wp-embed.min.js'></script>
    </body>

    <!-- Mirrored from wellspring.mikado-themes.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 14 Mar 2017 04:29:19 GMT -->

</html>
