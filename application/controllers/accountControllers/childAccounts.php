<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 */
require APPPATH . '/controllers/admin_secure.php';

class ChildAccounts extends Admin_secure {

    function register() {
        $data['accounts_active'] = 'active';
        $data['action'] = 'create';
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
            print $this->registerChildDetails($childData, $name, $handler_id, $relationship);
    }

    private function registerChildDetails($childData, $name, $handler_id, $relationship) {
        $this->load->model('children/Child');
        $this->load->model('handlers/Handler');
        if ($this->Child->checkExists(trim($name)))
            return json_encode(array('message' => "Child with a similar name already exists.  view this child's details from ".anchor(site_url('account/childAccounts/edit/'.$this->getChildId($name)),'here'), 'success' => 0));
        else {
            $child_id = $this->Child->insert($childData);
            if (is_numeric($handler_id))
                $this->Handler->insertHandlerChildRelationship($child_id, $handler_id, $relationship);
            return json_encode(array('success' => 1, 'message' => 'child successfully created. Add parents/handlers from ' . anchor(site_url('account/handlers/registerWithChild/' . $child_id), 'here')));
        }
    }

    private function editChildDetails($childData, $old_name, $new_name, $child_id) {
        $this->load->model('children/Child');
        if (trim($old_name) != trim($new_name)) {
            if ($this->Child->checkExists(trim($new_name)))
                return json_encode(array('message' => "Child with a similar name already exists. view this child's details from ".anchor(site_url('account/childAccounts/edit/'.$this->getChildId($new_name)),'here'), 'success' => 0));
        }
        $this->Child->edit($childData, $child_id);
        return json_encode(array('success' => 1, 'message' => 'child details successfully edited. Add parents/handlers from ' . anchor(site_url('account/handlers/registerWithChild/' . $child_id), 'here')));
    }
    
    function getChildId($name){
        return $this->Child->getSingleVarChildColumnAttribute($name,COL_CHILD_NAME,COL_CHILD_ID);
    }
    
    function delete(){
         $this->load->model('children/Child');
         $child_id = $this->input->post('childId');
         if($this->Child->deleteChild($child_id))
              print json_encode(array('success' => 1, 'message' =>return_feedback(true, 'Child succefully deleted. Return to children report from '.anchor(site_url('reports/children'),'here'))));
         else
              print json_encode(array('success' => 0, 'message' =>return_feedback(false, 'An error occured when deleting the Child')));
    }
}