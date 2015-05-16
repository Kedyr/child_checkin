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
        $date_2 = date('m/d/Y');
        $morning = $date . ' 00:00';
        $night = $date . ' 24:00';
        $data['attendace_type'] = "Registered Children";
        $data['date_now'] = $date_2 . ' 00:00' . ' - ' . $date_2 . '  24:00';
        $data['form_action'] = "registered";
        $sarch_date = $this->input->post('reservation');
        if (strlen($sarch_date) > 8) {
            $date_range_split = getStartEndDateFromRange($sarch_date);
            $morning = $date_range_split['start'];
            $night = $date_range_split['end'];
        }
        $data['children'] = $this->AttendanceReports->getAttendanceBetweenDates($morning, $night);
        $this->load->view('reports/attendance', $data);
    }


    function unregistered() {
        $this->load->model('reports/AttendanceReports');
        $data['registered'] = FALSE;
        $date = date('Y-m-d');
        $morning = $date . ' 00:00';
        $night = $date . ' 24:00';
        $data['attendace_type'] = "UnRegistered Children";
        $sarch_date = $this->input->post('reservation');
        if (strlen($sarch_date) > 8) {
            $date_range_split = getStartEndDateFromRange($sarch_date);
            $morning = $date_range_split['start'];
            $night = $date_range_split['end'];
        }
         $data['form_action'] = "unregistered";
        $data['children'] = $this->AttendanceReports->getAttendanceUnregisteredChildBetweenDates($morning, $night);
        $this->load->view('reports/attendance', $data);
    }

}