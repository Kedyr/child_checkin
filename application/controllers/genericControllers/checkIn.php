<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 */
require APPPATH . '/controllers/admin_secure.php';

class CheckIn extends Admin_secure {
    
    function __construct() {
        parent::__construct();
        $this->forceCheckout();
    }

    function registered() {
        $this->load->model('children/Child');
        $data['checkinReg_active'] = 'active';
        $all_children = $this->Child->getAllForSearch();
        $data['children'] = json_encode($all_children);
        $this->load->view('checkin/checkin', $data);
    }
    
    function forceCheckout(){
           $this->load->model('checkinout/RollCall');
           $this->RollCall->forceCheckout();
    }

    function unregistered() {
        $data['checkinNReg_active'] = 'active';
        $this->load->view('checkin/checkinUnReg', $data);
    }

    function getChildFamily() {
        ajax_only_request();
        $this->load->model('children/Child');
        $this->load->model('checkinout/RollCall');
        $childId = $this->input->post('childId');
        $handlers = $this->Child->getHandlers($childId);
        $data['handlers'] = $handlers;
        $handler_ids = array();
        foreach ($handlers as $handler) {
            array_push($handler_ids, $handler[COL_HANDLER_ID]);
        }
        $data['siblings'] = (count($handler_ids) > 0 ) ? $this->Child->getSiblings($handler_ids, $childId) : array();
        $child_details = $this->Child->getChild($childId);
        $name = $child_details[COL_CHILD_NAME];
        $data['searchName'] = $name;
        $data['searchGender'] = $child_details[COL_SEX];
        $data['searchId'] = $childId;
        $data['searchAge'] = calculateAge($child_details[COL_DOB]) . ' years';


        if ($this->RollCall->checkIfChildCheckedIn($childId))
            print return_feedback(false, 'Child already checked in : ' . $name);
        else {
            $data['checkin_id'] = $this->checkinChild($childId);
            $data['status'] = $this->config->item('checkin_status_in');
            $this->load->view('checkin/registeredChekinSource', $data);
        }
    }

    function checkinChild($child_id, $checkin_id = 0) {
        $this->load->model('checkinout/RollCall');
        $data[COL_CHILD_ID] = $child_id;
        $data[COL_SERVICE_ID] = NULL;
        $data[COL_TIME_IN] = getCurrentTime();
        $data[COL_COMMENTS] = NULL;
        $data[COL_STATUS] = $this->config->item('checkin_status_incomplete') ;
        $data[COL_CHECK_IN_UnderId] = ($checkin_id == 0) ? NULL : $checkin_id;
        return $this->RollCall->checkin($data);
    }

    function completeCheckin() {
        ajax_only_request();
        $this->load->model('checkinout/RollCall');
        $checkin_id = $this->input->post('checkin_id');
        $handler_name = $this->input->post('handler');
        $data[COL_HANDLER_NAME] = $handler_name;
        $card_num = $this->input->post('cardNo');
        $data[COL_CHECK_IN_NUMBER] = $card_num;
        $data[COL_SIBLING_COUNT] = $this->input->post('siblingNo');
        $data[COL_CHECK_IN_UnderId] = $checkin_id;
         $data[COL_STATUS] = $this->config->item('checkin_status_in');

        //get handler id if any//registered independenlty for one of the siblings
        $handler_id = $this->RollCall->getSingleRollCallAttribute($checkin_id, COL_HANDLER_ID);
        if (is_numeric($handler_id))
            $data[COL_HANDLER_ID] = $handler_id;

        if ($this->RollCall->checkIfCheckinNumberGivenOut($card_num)) {
            print json_encode(array('success' => 0, 'message' =>return_feedback(false, 'Selected Card number has already been used!')));
        }else{
            if ($this->RollCall->updateChildrenCheckinWIthHandlerDetails($data, $checkin_id))
                print json_encode(array('success'=>1,'message'=>return_feedback(true, 'Children succefully checked-In ')));
            else
                print json_encode(array('success'=>0,'message'=>return_feedback(false, 'An error occured when completing child check-in')));
        }
    }

    function checkinSibling() {
        ajax_only_request();
        $childIdentifier = $this->input->post('childId');
        $checkin_id = $this->input->post('checkin_id');
        $arr = explode("_", $childIdentifier); //retrieve id from dom id
        $child_id = $arr[1];
        if ($this->checkinChild($child_id, $checkin_id))
            print return_feedback(true, 'Children succefully checked-In ');
        else
            print return_feedback(false, 'An error occured when completing the chek-IN');
    }

    function checkinHandler() {
        ajax_only_request();
        $this->load->model('checkinout/RollCall');
        $handlerIdIdentifier = $this->input->post('handlerId');
        $checkin_id = $this->input->post('checkin_id');
        $arr = explode("_", $handlerIdIdentifier); //retrieve id from dom id
        $data[COL_HANDLER_ID] = $arr[1];
        if ($this->RollCall->updateChildrenCheckinWIthHandlerDetails($data, $checkin_id))
            print return_feedback(true, 'Children succefully checked-In ');
        else
            print return_feedback(false, 'An error occured when completing the chek-IN');
    }

    function checkinUnreg() {
        $this->load->model('checkinout/RollCall');
        $handler_name = $this->input->post('handler');
        $card_num = $this->input->post('cardNum');
        $data[COL_CHECK_IN_NUMBER] = $card_num;
        $data[COL_SIBLING_COUNT] = $this->input->post('siblings');
        $data[COL_HANDLER_NAME] = $handler_name;
        $data[COL_SERVICE_ID] = NULL;
        $data[COL_TIME_IN] = getCurrentTime();
        $data[COL_COMMENTS] = NULL;
        $data[COL_STATUS] = "IN";
        $data[COL_SERVICE_ID] = NULL;

        if ($this->RollCall->checkIfCheckinNumberGivenOut($card_num)) {
            print json_encode(array('success' => 0, 'message' => 'Selected Card number has already been used!'));
            return;
        }

        $checkin_id = $this->RollCall->checkin($data);
        if ($this->RollCall->update(array(COL_CHECK_IN_UnderId => $checkin_id), $checkin_id))
            print json_encode(array('success' => 1, 'message' => 'Successfully checked-In'));
        else
            print json_encode(array('success' => 0, 'message' => 'An error occured when saving details, please try again'));
    }

}