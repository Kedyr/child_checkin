<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 */
require APPPATH . '/controllers/admin_secure.php';

class Home extends Admin_secure {

    function index() {
        $data['home_active'] = 'active';
        $this->load->view('home',$data);
    }
    
}