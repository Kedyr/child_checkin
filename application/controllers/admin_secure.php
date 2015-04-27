<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 */
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip'))
    ob_start("ob_gzhandler");
else
    ob_start();

class Admin_secure extends CI_Controller {
    /*
      Controllers that are considered secure extend Secure_page, optionally a $module_id can
      be set to also check if a user can access a particular module in the system.
     */

    function __construct() {
        parent::__construct();

        if (!is_logged_in()) {
            redirect('login');
        }
        date_default_timezone_set('Africa/Kampala');
        
    }

}
