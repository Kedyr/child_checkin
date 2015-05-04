<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 */
require APPPATH . '/controllers/admin_secure.php';

class Attendance extends Admin_secure {

    function registered() {
        $this->load->model('reports/AttendanceReports');
        $data['registered'] = TRUE;
        $date = date('Y-m-d');
        $morning = $date.' 00:00';
        $night = $date.' 24:00';
        $data['attendace_type'] = "Registered Children";
        $data['children'] = $this->AttendanceReports->getAttendanceBetweenDates($morning, $night);
        $this->load->view('reports/attendance', $data);
    }

    function unregistered() {
        $this->load->model('reports/AttendanceReports');
        $data['registered'] = FALSE;
        $date = date('Y-m-d');
        $morning = $date.' 00:00';
        $night = $date.' 24:00';
        $data['attendace_type'] = "UnRegistered Children";
        $data['children'] = $this->AttendanceReports->getAttendanceUnregisteredChildBetweenDates($morning, $night);
        $this->load->view('reports/attendance', $data);
    }

}