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
        <meta name="description" content="Watoto Children Checkin." />
        <meta name="copyright" content="Copyright (c) Kedyr 2015" />
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
          <?php print js_asset('vendor/bootstrap/bootstrap.js'); ?>
    </head>

    <body>
        <!-- Begin page content -->


        <div id="top_container" class="container">

             <?php $this->load->view('section/navigation'); ?>