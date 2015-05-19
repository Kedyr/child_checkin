<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 */
require APPPATH . '/controllers/admin_secure.php';

class CheckOut extends Admin_secure {

    function card() {
        $data['checkout_active'] = 'active';
        $this->load->model('checkinout/RollCall');
        $cards = $this->RollCall->getCardNumbersForCheckedInChildren();
        $data['cards'] = json_encode($cards);
        $this->load->view('checkin/checkout', $data);
    }

    function getChildFamily() {
        ajax_only_request();
        $this->load->model('checkinout/RollCall');
        $checkin_id = $this->input->post('checkinId');
        $data['siblings'] = $this->RollCall->getCheckedInSiblingsWithCheckinId($checkin_id);
        $data['no_checkedIn_children'] = $this->RollCall->getNoChildrenCheckedIn($checkin_id);
        $checkin_details = $this->RollCall->get($checkin_id);
        $data['sibling_count'] = $checkin_details[COL_SIBLING_COUNT];
        $dateoemat = getTime($checkin_details[COL_TIME_IN]);
        $data['checkinTime'] = $dateoemat->format("m/d H:i");
        $data['cardNo'] = $checkin_details[COL_CHECK_IN_NUMBER];
        $handlers = $this->RollCall->getCheckedInHandlerWithCheckinId($checkin_id);
        if (empty($handlers))
            $data['handler_name'] = $this->RollCall->getUnregisteredCheckedInHandlerWithCheckinId($checkin_id);
        $data['handlers'] = $handlers;
        $data['checkin_id'] = $checkin_id;
        $this->load->view('checkin/checkoutSource', $data);
    }

    function completeCheckout() {
        $checkin_id = $this->input->post('checkin_id');
        $this->load->model('checkinout/RollCall');
        if ($this->RollCall->completeCheckOut($checkin_id))
            print return_feedback(true, 'Successful Checkout of Child/children');
        else
            print return_feedback(false, 'An error occured when cheking out the child');
    }

    function checkoutSibling() {
        ajax_only_request();
        $this->load->model('checkinout/RollCall');
        $childIdentifier = $this->input->post('childId');
        $checkin_id = $this->input->post('checkin_id');
        $arr = explode("_", $childIdentifier); //retrieve id from dom id
        $child_id = $arr[1];

        if ($this->RollCall->chekoutSibling($child_id, $checkin_id))
            print json_encode(array('success' => 1, 'message' => 'Successfully Checkout Child'));
        else
            print json_encode(array('success' => 0, 'message' => 'An error occured when cheking out the child'));
    }

}