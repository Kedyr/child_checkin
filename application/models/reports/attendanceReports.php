<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 */
class AttendanceReport extends CI_Model {

    //todo amplify error reporting
    public function __construct() {
        parent::__construct();
    }
    
    function getAttendanceBetweenDates($start,$end){
        $this->db->select(COL_CHILD_NAME.'.'.COL_CHURCH_CLASS.' , '.TBL_HANDLERS.'.'.COL_HANDLER_NAME.' , '.COL_CHECK_IN_NUMBER.'.'.COL_TIME_IN.' , '.COL_TIME_OUT.' , '.TBL_CHECKINOUT.'.'.COL_HANDLER_NAME)->from(TBL_CHECKINOUT);
        $this->db->join(TBL_CHILDREN,TBL_CHILDREN.'.'.COL_CHILD_ID.' = '.TBL_CHECKINOUT.'.'.COL_CHILD_ID);
        $this->db->join(TBL_HANDLERS,TBL_CHECKINOUT.'.'.COL_HANDLER_ID.' = '.TBL_HANDLERS.'.'.COL_HANDLER_ID);
       // $this->db->where(COL_TIME_IN.' between')
    }
    
}