<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 */
require APPPATH . '/controllers/admin_secure.php';

class Attendance extends Admin_secure {

    function index() {
        $this->load->model('reports/AttendanceReports');
        $data['registered'] = TRUE;
        $date = date('Y-m-d');
        $date_2 = date('m/d/Y');
        $morning = $date . ' 00:00';
        $night = $date . ' 24:00';
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

}