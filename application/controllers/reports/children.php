<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 */
require APPPATH . '/controllers/admin_secure.php';

class Children extends Admin_secure {

    function index() {
        $this->load->model('children/Child');
        $data['children'] = $this->Child->getAll();
        $this->load->view('reports/children', $data);
    }

    function getChildHandlers($child_id) {
        ajax_only_request();
        $this->load->model('handlers/Handler');
        $this->load->model('children/Child');
        $data['handlers'] = $this->Handler->getChildHandlers($child_id);
        $data['child_name'] = $this->Child->getSingleChildColumnValue($child_id, COL_CHILD_NAME);
        $this->load->view('reports/parents', $data);
    }

}