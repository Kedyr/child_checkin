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
        $data['child_id'] = $child_id;
        $this->load->view('reports/parents_modal', $data);
    }

    function getChildSiblings($child_id) {
        ajax_only_request();
        $this->load->model('children/Child');
        $handlers = $this->Child->getHandlers($child_id);
        $handler_ids = array();
        foreach ($handlers as $handler) {
            array_push($handler_ids, $handler[COL_HANDLER_ID]);
        }
        $data['child_name'] = $this->Child->getSingleChildColumnValue($child_id, COL_CHILD_NAME);
        $data['siblings'] = (count($handler_ids) > 0 ) ? $this->Child->getSiblings($handler_ids, $child_id) : array();
        $data['child_id'] = $child_id;
        $this->load->view('reports/siblings', $data);
    }

    function getHandlerChildren($handler_id) {
        ajax_only_request();
        $this->load->model('handlers/Handler');
        $data['children'] = $this->Handler->getHandlerChildren($handler_id);
        $data['handler_name'] = $this->Handler->getSingleHandlerColumnAttribute($handler_id, COL_HANDLER_ID, COL_HANDLER_NAME);
        $data['handler_id'] = $handler_id;
        $this->load->view('reports/parent_children', $data);
    }
    
}