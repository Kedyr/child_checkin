<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 */
require APPPATH . '/controllers/admin_secure.php';

class Register extends Admin_secure {

    function child() {
        $data['accounts_active'] = 'active';
        $this->load->view('accounts/register', $data);
    }

    function childRegister() {
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
        $dob = $this->input->post('dob');
        if ($dob > 6) {
            $n_dob = explode("/", $dob);
            $dob = $n_dob[1].'/'.$n_dob[0].'/'.$n_dob[2];
            $dateoemat = getTime($dob);
            $childData[COL_DOB] = $dateoemat->format('Y-m-d');
        }
        else
            $childData[COL_DOB] = NULL;

        $this->load->model('children/Child');
        if ($this->Child->checkExists($name))
            print json_encode(array('message' => 'Child with a similar name already exists', 'success' => 0));
        else {
            $child_id = $this->Child->insert($childData);
            print json_encode(array('success' => 1, 'message' => 'child successfully created. Add parents/handlers from ' . anchor(site_url('generic/register/handlerRegister/' . $child_id), 'here')));
        }
    }

    function handlerRegister($childId) {
        $data['accounts_active'] = 'active';
        if (!is_numeric($childId))
            show_error("Selected Child is wrong");
        $data['child_id'] = $childId;
        $this->load->view('accounts/handlerRegister', $data);
    }

    function saveHandlerDetails() {
        ajax_only_request();
         $this->load->model('handlers/Handler');
        $child_id = $this->input->post('child_id');
        $data[COL_EMAIL] = $this->input->post('email');
        $name = $this->input->post('name');
        $data[COL_HANDLER_NAME] = $name;
        $data[COL_RESIDENCE] = $this->input->post('residence');
        $data[COL_PHONENO] = $this->input->post('phone');
        $data[COL_OTHER_CHURCH] = $this->input->post('church');
        $data[COL_WORK_PLACE] = $this->input->post('work');
        
        if($this->Handler->checkExists($name)){
            print json_encode (array('success'=>0,'message'=>"This parent/handler has alrady been registered. Please contact the administrator if your issue hasn't been fixed"));
            return;
        }
            
        $handler_id = $this->Handler->insert($data);
        $relationship = $this->input->post('relationship');
        
        if($this->Handler->insertHandlerChildRelationship($child_id,$handler_id,$relationship))
                print json_encode (array('success'=>1,'message'=>"Parent/Handler succesfully registerd"));
        else
            print json_encode (array('success'=>0,'message'=>"An error occured when saving the parent/Handler"));
    }

}