<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 */

/**
 * User data is handled y the main application.
 * All attributes of login(security) in are handled on the front entend. the main app just verifies the password and username
 */

class Logut extends CI_Controller {

    function index() {
       $this->session->set_userdata(array(USER_ID => '', USERNAME => '', ACCOUNT_ACTIVATED => '', NAME => ''));
        $this->session->sess_destroy();
        redirect(site_url('login'));
    }
    
}