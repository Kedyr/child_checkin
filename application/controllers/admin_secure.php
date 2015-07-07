<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 *
 */

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
        $roles = $this->session->userdata('allowed_roles');
        $data['allowed_roles'] = $roles;
        date_default_timezone_set('Africa/Kampala');
        $this->load->vars($data);
    }
    
    function error(){
        $this->load->view('error_page');
    }
    
    
    function resetCheckins(){
        restrictUserFunctionlityBasedOnRole($this->config->item('role_admin'));
        $this->db->update(TBL_CHECKINOUT,array(COL_STATUS=>$this->config->item('checkin_status_force_out') ));
        redirect('generic/home');
    }
   
}
