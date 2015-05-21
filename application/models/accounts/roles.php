<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 */

class Roles extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    function setAllowedRoles($username) {
        $roles_ = $this->getUserRoles($username);
        $roles = array();
        foreach($roles_ as $role){
            array_push($roles, $role);
        }
        $this->session->set_userdata('allowed_roles', $roles);
    }
    

    private function getUserRoles($username) {
        if($username=='watoto@watoto.ug')
            return array($this->config->item('role_facilitator'));
        if($username=='admin@watoto.ug')
            return array($this->config->item('role_admin'));
    }
}