<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Force latest IE rendering engine or ChromeFrame if installed -->
        <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <title>Watoto Children's Check-In</title>
        <!-- Common Meta Tags -->
        <meta name="description" content="MOOC." />
        <meta name="copyright" content="Copyright (c) MeridianSoftech 2012" />
        <meta name="language" content="EN-GB" />
        <meta name="author" content="Kedyr">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php print css_asset("bootstrap.min.css"); ?> 
        <?php print css_asset("customK.css"); ?> 

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?php print js_asset('vendor/jquery/jquery.js'); ?>
    <!--    <script data-main="<?php print base_url('assets/js/admin_require'); ?>" src="<?php print base_url('assets/js/vendor'); ?>/require.js"></script> -->
    </head>

    <body>
        <!-- Begin page content -->


        <div id="top_container" class="container">

            <nav id="Navigation" class="navbar navbar-default navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php print site_url('generic/dash'); ?>">Watoto Children's Check-In</a>
                    </div>
                    <ul id="left_nav_menu" class="nav navbar-nav pull-right">
                        <li class="<?php print isset($home_active) ? $home_active : ''; ?> bold"><a href="<?php print site_url('generic/home'); ?>">Home</a></li>
                        <li class="<?php print isset($checkinReg_active) ? $checkinReg_active : ''; ?> bold"><a href="<?php print site_url('generic/checkin/registered'); ?>">Registered In</a></li>
                        <li class="<?php print isset($checkinNReg_active) ? $checkinNReg_active : ''; ?> bold"><a href="<?php print site_url('generic/checkin/unregistered'); ?>">UnRegistered In</a></li>
                        <li class="<?php print isset($checkout_active) ? $checkout_active : ''; ?> bold"><a href="<?php print site_url('generic/checkout/card'); ?>">Check-Out</a></li>
                        <li class="<?php print isset($register_active) ? $register_active : ''; ?> bold"><a href="<?php print site_url('generic/register/child'); ?>">Register Child</a></li>

                    </ul>
                </div>
            </nav>