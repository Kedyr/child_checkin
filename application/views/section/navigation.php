
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
                      <!-- <li class="<?php print isset($home_active) ? $home_active : ''; ?> bold"><a href="<?php print site_url('generic/home'); ?>">Home</a></li> -->
                        <li class="<?php print isset($checkinReg_active) ? $checkinReg_active : ''; ?> bold"><a href="<?php print site_url('generic/checkin/registered'); ?>">Registered In</a></li>
                        <li class="<?php print isset($checkinNReg_active) ? $checkinNReg_active : ''; ?> bold"><a href="<?php print site_url('generic/checkin/unregistered'); ?>">UnRegistered In</a></li>
                        <li class="<?php print isset($checkout_active) ? $checkout_active : ''; ?> bold"><a href="<?php print site_url('generic/checkout/card'); ?>">Check-Out</a></li>
                       
                        <ul class="nav navbar-nav">
                            <li class="dropdown <?php print isset($reports_active) ? $reports_active : ''; ?> bold">
                                <a  href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Reports<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Attendance (Registered)</a></li>
                                    <li><a href="#">Attendance (UnRegistered)</a></li>
                                     <li><a href="#">Children</a></li>
                                </ul>
                            </li>
                        </ul>
                       
                        <ul class="nav navbar-nav">
                            <li class="dropdown <?php print isset($accounts_active) ? $accounts_active : ''; ?> bold">
                                <a  href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Accounts<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="<?php print site_url('generic/register/child'); ?>">Register Child</a></li>
                                    <li class="divider"></li>
                                    <li><a href="<?php print site_url('logout'); ?>">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </ul>
                </div>
            </nav>