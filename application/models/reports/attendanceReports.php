<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 */
class AttendanceReports extends CI_Model {

    //todo amplify error reporting
    public function __construct() {
        parent::__construct();
    }
    
    function getAttendanceBetweenDates($start,$end){
        $this->db->select( COL_STATUS.' , '.COL_SIBLING_COUNT.' ,'. COL_CHILD_NAME.' , '.COL_CHURCH_CLASS.' , '.TBL_HANDLERS.'.'.COL_HANDLER_NAME.' , '.COL_CHECK_IN_NUMBER.' , '.COL_TIME_IN.' , '.COL_TIME_OUT.' , '.TBL_CHECKINOUT.'.'.COL_HANDLER_NAME.' as handler')->from(TBL_CHECKINOUT);
        $this->db->join(TBL_CHILDREN,TBL_CHILDREN.'.'.COL_CHILD_ID.' = '.TBL_CHECKINOUT.'.'.COL_CHILD_ID,'left outer');
        $this->db->join(TBL_HANDLERS,TBL_CHECKINOUT.'.'.COL_HANDLER_ID.' = '.TBL_HANDLERS.'.'.COL_HANDLER_ID,'left outer');
        $this->db->where(COL_TIME_IN." >= '".$start."' and ".COL_TIME_IN." <= '".$end."' and ".COL_STATUS." <> '".$this->config->item('checkin_status_incomplete')  . "'");
        $query = $this->db->get();
        return $this->Dbwrapper->summarize_get_and_select($query);
    }
    
    function getSummary($date_start,$date_end,$status){
        $this->db->select("COUNT(".COL_CHECKIN_ID.") AS COUNT")->from(TBL_CHECKINOUT);
        $query = $this->db->where(COL_TIME_IN." >= '".$date_start."' and ".COL_TIME_IN." <= '".$date_end."' and ".COL_STATUS." = '".$status."'")->get();
        return $this->Dbwrapper->summarize_get_and_select($query,TRUE,"COUNT");
    }
    
  
}