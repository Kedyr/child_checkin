<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Watoto Children's Check-In</title>


        <?php print css_asset("bootstrap.min.css"); ?>
        <?php print css_asset("custom.css"); ?>
        <?php print css_asset("font-awesome.min.css"); ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Please Sign In</h3>
                        </div>
                        <div class="panel-body">
                            <?php print form_open(site_url('account/login/in'),array('role'=>'form')); ?>
                             <?php print_feedback(isset($feedback_status)?$feedback_status:'',isset($feedback_message)?$feedback_message:'');?>
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" required placeholder="E-mail" name="email" type="email" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" required placeholder="Password" name="password" type="password" value="">
                                    </div>
                                    <?php print form_submit('submit', 'Login', "id='submi_btn' class='btn btn-lg btn-success btn-block'");?>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>
