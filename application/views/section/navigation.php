
<nav id="Navigation" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php print image_asset("logo.png",null,array('height'=>'70px','width'=>'350px')); ?>
           <a class="navbar-brand" href="<?php print site_url('generic/home'); ?>">Child Check-In</a>
        </div>
         <div id="navbar" class="navbar-collapse collapse">
        <ul id="left_nav_menu" class="nav navbar-nav pull-right">
             <li class="<?php print isset($home_active) ? $home_active : ''; ?> bold"><a href="<?php print site_url('generic/home'); ?>">Home</a></li>
            <li class="<?php print isset($checkinReg_active) ? $checkinReg_active : ''; ?> bold"><a href="<?php print site_url('generic/checkin/registered'); ?>">Registered</a></li>
            <li class="<?php print isset($checkinNReg_active) ? $checkinNReg_active : ''; ?> bold"><a href="<?php print site_url('generic/checkin/unregistered'); ?>">UnRegistered</a></li>
            <li class="<?php print isset($checkout_active) ? $checkout_active : ''; ?> bold"><a href="<?php print site_url('generic/checkout/card'); ?>">Check-Out</a></li>
           
            <ul class="nav navbar-nav">
                <li class="dropdown <?php print isset($reports_active) ? $reports_active : ''; ?> bold">
                    <a  href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Reports<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php print site_url('reports/attendance/'); ?>">Attendance</a></li>
                         <li><a href="<?php print site_url('reports/children'); ?>">Children</a></li>
                          <li><a href="<?php print site_url('reports/handlers'); ?>">Handlers</a></li>
                    </ul>
                </li>
            </ul>
           
            <ul class="nav navbar-nav">
                <li class="dropdown <?php print isset($accounts_active) ? $accounts_active : ''; ?> bold">
                    <a  href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Accounts<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php print site_url('account/child_accounts/register'); ?>">Register Child</a></li>
                         <li><a href="<?php print site_url('account/handlers/register'); ?>">Register Handler</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php print site_url('logout'); ?>">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </ul>
    </div>
      </div>
</nav>