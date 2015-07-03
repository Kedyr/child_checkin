<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 */

function numeric_url_parameter_required($param) {
    $ci = &get_instance();

    if (!is_numeric($param)) {
        show_error("You have tampered with one of the parameters in the url that is supposed to be numeric " . $ci->uri->uri_string());
        return;
    }
}

function ajax_only_request() {
    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        print json_encode(array('success' => 0, 'message' => 'access denied to request'));
        exit();
    }
}

function limit_offset_verifier($limit, $offset) {
    if (!is_numeric($limit) || (!is_numeric($offset)))
        show_error('Your Url has some invalid segments The offset or limit should be numeric', 404);
}

function create_file_name($general_name) {
    $general_name = preg_replace("/[^A-Za-z0-9 ]/", '_', $general_name);
    $general_name = str_replace(" ", "_", $general_name);
    return $general_name . '_' . time();
}

/**
 * rearranges an associative array and makes one of the values the key and the corresponding selected attribute the value
 * eg. turn a database record into an array with id=selectedvalue
 * @param type $key_identifier
 * @param type $value_identifier
 * @param type $array
 * @return type
 */
function arraySetKeyEqualsValue($key_identifier,$value_identifier,$array){
    $matched = array();
     foreach($array as $arr){
           $matched[$arr[$key_identifier]] = $arr[$value_identifier];
      }
      return $matched;
}

function setSessionData($key,$data){
    $ci = &get_instance();
    $ci->session->unset_userdata($key);
    $ci->session->set_userdata($key,found);
}

function getNumberName($number){
    switch($number){
        case 1:
            return "One";
        case 2:
            return "Two";
        case 3:
            return "Three";
        case 4:
            return "Four";
        case 5:
            return "Five";
        case 6:
            return "Six";
        case 7:
            return "seven";
        case 8:
            return "Eight";
        case 9:
            return "Nine";
        case 10:
            return "Ten";
        case 11:
            return "Eleven";
        case 12:
            return "Twelve";
        case 13:
            return "Thirteen";
        case 14:
            return "Fourteen";
        case 15:
            return "Fifteen";
        case 16:
            return "Sixteen";
        case 17:
            return "Seventeen";
        case 18:
            return "Eighteen";
        case 19:
            return "Nineteen";
        case 20:
            return "Twenty";
            
    }
}

  
function calculateAge($dob){
    $dateoemat = getTime($dob);
    $year = $dateoemat->format("Y");
    date_default_timezone_set('Africa/Kampala');
    $current_year = date('Y');
    $age = ($current_year - $year);
    if($age == 0){
        $monthsOld =  calculateMonthsAge($dob);
        if($monthsOld == 0)
            return calculateDaysAge($dob);
        else 
            return $monthsOld;
    }
    else
        return $age;
}

function calculateMonthsAge($dob){
    $dateoemat = getTime($dob);
    $month = $dateoemat->format("m");
    $current_month = date('m');
    return ($current_month - $month);
}

function calculateDaysAge($dob){
    $dateoemat = getTime($dob);
    $day = $dateoemat->format("d");
    $current_day = date('d');
    return ($current_day - $day);
}

function getTime($time){
    $date = new DateTime($time, new DateTimeZone('Africa/Kampala'));
     return  $date;
}

function getCurrentTime(){
     date_default_timezone_set('Africa/Kampala');
    return  date('Y-m-d H:i:s');
}


function getStartEndDateFromRange($daterange) {
    date_default_timezone_set('Africa/Nairobi');
    if(strlen($daterange) < 10)
        return array('start'=>NULL,'end'=>NULL);
    $duration = explode('-', $daterange);
    $datest = getTime($duration[0]);
    $dateet = getTime($duration[1]);
    $start_time = $datest->format('Y-m-d');
    $end_date = $dateet->format('Y-m-d');
    return array('start'=>$start_time,'end'=>$end_date);
}

function getSDate($date) {
    date_default_timezone_set('Africa/Nairobi');
    return getTime($date)->format('Y-m-d');
}