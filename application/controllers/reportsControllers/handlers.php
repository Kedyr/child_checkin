<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 */
require APPPATH . '/controllers/admin_secure.php';

class Handlers extends Admin_secure {

     function index() {
       $this->load->model('handlers/Handler');
        $data['handlers'] = $this->Handler->getAll();
        $this->load->view('reports/parents', $data);
    }
    
    function editChildRelationship($child_id,$handler_id){
        
    }
}
