<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 */
require APPPATH . '/controllers/admin_secure.php';

class Child_accounts extends Admin_secure {

    function register() {
        $data['accounts_active'] = 'active';
        $data['action'] = 'create';
        $data['action_title'] = "Register Child";
        $this->load->view('accounts/register', $data);
    }

    function edit($child_id) {
        $this->load->model('children/Child');
        $child_data = $this->Child->getChild($child_id);
        if (count($child_data) < 1)
            return_error_message("Non existent Child", "Selected child doesn't exist");
        $data['child_data'] = $child_data;
        $data['child_id'] = $child_id;
        $data['action'] = 'edit';
        $data['action_title'] = "Edit ".$child_data[COL_CHILD_NAME]."'s bio-data";
        $data['dob'] = getTime($child_data[COL_DOB])->format('d/m/Y');
        $this->load->view('accounts/register', $data);
    }

    function saveChildDetails() {
        ajax_only_request();
        $name = $this->input->post('name');
        $childData[COL_CHILD_NAME] = $name;
        $childData[COL_SEX] = $this->input->post('gender');
        $childData[COL_RESIDENCE] = $this->input->post('residence');
        $childData[COL_CELL_NO] = $this->input->post('cellno');
        $childData[COL_CELL_LEADER_NAME] = $this->input->post('cellleader');
        $childData[COL_CHURCH_MEMBERSHIP] = $this->input->post('churchmembership');
        $childData[COL_SCHOOL] = $this->input->post('school');
        $childData[COL_SCHOOL_CLASS] = $this->input->post('sclass');
        $childData[COL_CHURCH_CLASS] = $this->input->post('cclass');
        $old_name = $this->input->post('olname');
        $dob = $this->input->post('dob');
        $action = $this->input->post('action');
        $child_id = $this->input->post('child_id');
        $handler_id = $this->input->post('handler_id');
        $relationship = $this->input->post('relationship');
        if ($dob > 6) {
            $n_dob = explode("/", $dob); //month/day/year
            $dob = $n_dob[1] . '/' . $n_dob[0] . '/' . $n_dob[2];
            $dateoemat = getTime($dob);
            $childData[COL_DOB] = $dateoemat->format('Y-m-d');
        }
        else
            $childData[COL_DOB] = NULL;
        if ($action == 'edit')
            print $this->editChildDetails($childData, $old_name, $name, $child_id);
        else
            print $this->registerChildDetails($childData, $name, $handler_id, $relationship,$child_id);
    }

    private function registerChildDetails($childData, $name, $handler_id, $relationship,$child_id_sibling=0) {
        $this->load->model('children/Child');
        $this->load->model('handlers/Handler');
        if ($this->Child->checkExists(trim($name)))
            return json_encode(array('message' => "Child with a similar name already exists.  view this child's details from " . anchor(site_url('account/child_accounts/edit/' . $this->getChildId($name)), 'here'), 'success' => 0));
        else {
            $child_id = $this->Child->insert($childData);
            if (is_numeric($handler_id))
                $this->Handler->insertHandlerChildRelationship($child_id, $handler_id, $relationship);
            if(is_numeric($child_id_sibling) AND ($child_id_sibling != 0)){ //attach sibling
                $handlers = $this->Handler->getChildHandlers($child_id_sibling);
                $this->Child->attachSiblings($child_id_sibling,$child_id,$handlers);
            }

            return json_encode(array('success' => 1, 'message' => 'child successfully created.  ' . anchor(site_url('account/handlers/registerWithChild/' . $child_id), 'Add new parents/handlers') . ' or <a onClick="attachHandler(' . $child_id . ');" id="attachChildren" href="#"> Attach existing handlers/parents</a>'));
        }
    }

    private function editChildDetails($childData, $old_name, $new_name, $child_id) {
        $this->load->model('children/Child');
        if (trim($old_name) != trim($new_name)) {
            if ($this->Child->checkExists(trim($new_name)))
                return json_encode(array('message' => "Child with a similar name already exists. view this child's details from " . anchor(site_url('account/child_accounts/edit/' . $this->getChildId($new_name)), 'here'), 'success' => 0));
        }
        $this->Child->edit($childData, $child_id);
        return json_encode(array('success' => 1, 'message' => 'child details successfully edited.  ' . anchor(site_url('account/handlers/registerWithChild/' . $child_id), 'Add new parents/handlers'). ' or <a onClick="attachHandler(' . $child_id . ');" id="attachChildren" href="#"> Attach existing handlers/parents</a>'));
    }

    function getChildId($name) {
        return $this->Child->getSingleVarChildColumnAttribute($name, COL_CHILD_NAME, COL_CHILD_ID);
    }

    function delete() {
        restrictUserFunctionlityBasedOnRole($this->config->item('role_admin'));
        $this->load->model('children/Child');
        $child_id = $this->input->post('childId');
        if ($this->Child->deleteChild($child_id))
            print json_encode(array('success' => 1, 'message' => return_feedback(true, 'Child succefully deleted. Return to children report from ' . anchor(site_url('reports/children'), 'here'))));
        else
            print json_encode(array('success' => 0, 'message' => return_feedback(false, 'An error occured when deleting the Child')));
    }

    function childSearch() {
        ajax_only_request();
        $search_item = $this->input->post('search');
        $this->load->model('children/Child');
        if (strlen($search_item) < 2)
            print json_encode(array("message" => "Empty search item!", 'success' => 0));
        else {
            $results = $this->Child->searchChild($search_item);
            print json_encode($results);
        }
    }

    function attachHandler($handler_id) {
        $this->load->model('handlers/Handler');
        $handler_data = $this->Handler->get($handler_id);
        if (count($handler_data) < 1)
            return_error_message("Non existent Handler", "Selected parent/guardian doesn't exist");
        $data['handler_name'] = $handler_data[COL_HANDLER_NAME];
        $data['handler_id'] = $handler_data[COL_HANDLER_ID];
        $this->load->view('accounts/attach_children',$data);
    }

    function togglerChildHandlerRelationship() {
        ajax_only_request();
        $this->load->model('handlers/Handler');
        $handler_id = $this->input->post('handler_id');
        $child_id = $this->input->post('child_id');
        $action = $this->input->post('action');
        $relationShip = $this->input->post('relationShip');
        if ($action == 'create') {
            if (!$this->Dbwrapper->minedb_check_if_record_exists(TBL_CHILD_HANDLER_RELATIONSHIP, array(COL_CHILD_ID => $child_id, COL_HANDLER_ID => $handler_id))) {
                if ($this->Handler->insertHandlerChildRelationship($child_id, $handler_id, $relationShip))
                    print json_encode(array('success' => 1, 'message' => "Child-Handler relationship established."));
                else
                    print json_encode(array('success' => 0, 'message' => "An error occured when saving the parent/Handler"));
            }
            else
                print json_encode(array('success' => 0, 'message' => "Child Handler relationship already exists"));
        }
        else {
            if ($this->Handler->deletetHandlerChildRelationship($child_id, $handler_id))
                print json_encode(array('success' => 1, 'message' => "Child Handler relationship removed "));
            else
                print json_encode(array('success' => 0, 'message' => "An error occured when saving the parent/Handler"));
        }
    }

    function addSibling($child_id){
        $data['accounts_active'] = 'active';
        $this->load->model('children/Child');
        $data['child_id'] = $child_id;
        $name = $this->Child->getSingleChildColumnValue($child_id, COL_CHILD_NAME);
        if (is_array($name))
            return_error_message("Non existent Child", "Selected child doesn't exist");
        $data['child_name'] = $name;
        $data['action_title'] = $name."'s Sibling";
        $data['action'] = 'create';
        $data['child_data'] = array(COL_CHILD_ID => $child_id);
        $this->load->view('accounts/register', $data);
    }

}