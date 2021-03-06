<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 */
require APPPATH . '/controllers/admin_secure.php';

class Handlers extends Admin_secure {

    function registerWithChild($childId) {
        $data['accounts_active'] = 'active';
        $this->load->model('children/Child');
        $data['child_id'] = $childId;
        $name = $this->Child->getSingleChildColumnValue($childId, COL_CHILD_NAME);
        if (is_array($name))
            return_error_message("Non existent Child", "Selected child doesn't exist");
        $data['child_name'] = $name;
        $data['action'] = 'create';
        $this->load->view('accounts/handlerRegister', $data);
    }

    function register() {
        $data['accounts_active'] = 'active';
        $data['action'] = 'create';
        $this->load->view('accounts/handlerRegister', $data);
    }

    function edit($handler_id) {
        $this->load->model('handlers/Handler');
        $handler_data = $this->Handler->get($handler_id);
        if (count($handler_data) < 1)
            return_error_message("Non existent Handler", "Selected parent/guardian doesn't exist");
        $data['handler_data'] = $handler_data;
        $data['handler_id'] = $handler_id;
        $data['action'] = 'edit';
        $this->load->view('accounts/handlerRegister', $data);
    }

    function saveHandlerDetails() {
        ajax_only_request();
        $this->load->model('handlers/Handler');
        $child_id = $this->input->post('child_id');
        $data[COL_EMAIL] = $this->input->post('email');
        $name = $this->input->post('name');
        $old_name = $this->input->post('olname');
        $data[COL_HANDLER_NAME] = $name;
        $data[COL_RESIDENCE] = $this->input->post('residence');
        $data[COL_PHONENO] = $this->input->post('phone');
        $data[COL_OTHER_CHURCH] = $this->input->post('church');
        $data[COL_WORK_PLACE] = $this->input->post('work');
        $data[COL_CELL_NO] = $this->input->post('cellno');
        $data[COL_CELL_LEADER_NAME] = $this->input->post('cellleader');
        $data[COL_CELL_LEADER_CONTACT] = $this->input->post('celllader_contact');
        $action = $this->input->post('action');
        $relationship = $this->input->post('relationship');
        $handler_id = $this->input->post('handler_id');

        if ($action == 'edit')
            print $this->editHandlerDetails($data, $handler_id, $name, $old_name);
        else {
            $handler_id = $this->insertHandler($data, $name);
            if ($handler_id):
                if (is_numeric($child_id))
                    print $this->insertHandlerChildRelationship($handler_id, $child_id, $relationship);
                else
                    print json_encode(array('success' => 1, 'message' => "Parent/Handler succesfully registerd. Attach new children from " . anchor(site_url('account/handlers/registerChild/' . $handler_id), 'Attach new children') . ' or  <a onClick="attachChildHandler(' . $handler_id . ');" id="attachChildren" href="#"> Attach existing children</a>'));
            endif;
        }
    }

    private function insertHandler($handler_data, $name) {
        if ($this->Handler->checkExists($name)) {
            print json_encode(array('success' => 0, 'message' => "Parent/handler with a similar name already exists. View this handler's details from " . anchor(site_url('account/handlers/edit/' . $this->getHandlerId($name)), 'here')));
            return;
        }
        return $this->Handler->insert($handler_data);
    }

    private function editHandlerDetails($handler_data, $handler_id, $new_name, $old_name) {
        if (trim($old_name) != trim($new_name)) {
            if ($this->Handler->checkExists(trim($new_name)))
                return json_encode(array('message' => "Parent/handler with a similar name already exists. View this handler's details from " . anchor(site_url('account/handlers/edit/' . $this->getHandlerId($new_name)), 'here'), 'success' => 0));
        }
        $this->Handler->edit($handler_data, $handler_id);
        return json_encode(array('success' => 1, 'message' => "Parent/Handler details succesfully updated. Attach new children from " . anchor(site_url('account/handlers/registerChild/' . $handler_id), 'here') . ' or <a onClick="attachChildHandler(' . $handler_id . ');" id="attachChildren" href="#"> Attach existing children</a>'));
    }

    function insertHandlerChildRelationship($handler_id, $child_id, $relationship) {
        if ($this->Handler->insertHandlerChildRelationship($child_id, $handler_id, $relationship))
            return json_encode(array('success' => 1, 'message' => "Parent/Handler succesfully registerd. " . anchor(site_url('account/handlers/registerChild/' . $handler_id), ' Attach more children') . anchor(site_url('account/handlers/registerWithChild/' . $child_id), ' Add other child handler i.e mother')));
        else
            return json_encode(array('success' => 0, 'message' => "An error occured when saving the parent/Handler"));
    }

    function registerChild($handler_id) {
        $this->load->model('handlers/Handler');
        $data['accounts_active'] = 'active';
        $data['action'] = 'create';
        $data['handler_id'] = $handler_id;
        $data['handler_name'] = $this->Handler->getSingleHandlerColumnAttribute($handler_id, COL_HANDLER_ID, COL_HANDLER_NAME);
        $this->load->view('accounts/handler_child_register', $data);
    }

    function getHandlerId($name) {
        return $this->Handler->getSingleHandlerColumnAttribute($name, COL_HANDLER_NAME, COL_HANDLER_ID);
    }

    function delete() {
        restrictUserFunctionlityBasedOnRole($this->config->item('role_admin'));
        $this->load->model('handlers/Handler');
        $handlerId = $this->input->post('handlerId');
        if ($this->Handler->deleteHandler($handlerId))
            print json_encode(array('success' => 1, 'message' => return_feedback(true, 'Handler succefully deleted. Return to the handler report from ' . anchor(site_url('reports/handlers'), 'here'))));
        else
            print json_encode(array('success' => 0, 'message' => return_feedback(false, 'An error occured when deleting the Child')));
    }

    function handlerSearch() {
        ajax_only_request();
        $search_item = $this->input->post('search');
        $this->load->model('handlers/Handler');
        if (strlen($search_item) < 2)
            print json_encode(array("message" => "Empty search item!", 'success' => 0));
        else {
            $results = $this->Handler->searchHandler($search_item);
            print json_encode($results);
        }
    }
    
     function attachChild($child_id) {
        $this->load->model('children/Child');
        $child_data = $this->Child->getChild($child_id);
        if (count($child_data) < 1)
            return_error_message("Non existent Child", "Selected child doesn't exist");
        $data['child_name'] = $child_data[COL_CHILD_NAME];
        $data['child_id'] = $child_data[COL_CHILD_ID];
        $this->load->view('accounts/attach_parent',$data);
    }

}

