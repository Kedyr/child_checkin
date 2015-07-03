<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 */
require APPPATH . '/controllers/admin_secure.php';

class Home extends Admin_secure {

    function index() {
        $date_now = date('m/d/Y');
        $sarch_date = $this->input->post('reservation');
         if (strlen($sarch_date) > 8) 
             $sarch_date = getSDate($sarch_date);
         else
             $sarch_date = getSDate($date_now);

        $data = $this->summaries($sarch_date);
        $data['home_active'] = 'active';
        $data['date_now'] = $date_now;
        $this->load->view('home', $data);
    }
    
    function summaries($date){
        $this->load->model('reports/AttendanceReports');
        $morning = $date . ' 00:00';
        $night = $date . ' 24:00';
        //totals
        $data['total_in'] = $this->AttendanceReports->getSummary($morning,$night,$this->config->item('checkin_status_out'));
        $data['total_out'] = $this->AttendanceReports->getSummary($morning,$night,$this->config->item('checkin_status_in'));

        $data['first_total_in'] = $this->AttendanceReports->getSummary($date.$this->config->item('checkin_startime_first_service'),$date.$this->config->item('checkin_endtime_first_service'),$this->config->item('checkin_status_out'));
        $data['first_total_out'] = $this->AttendanceReports->getSummary($date.$this->config->item('checkin_startime_first_service'),$date.$this->config->item('checkin_endtime_first_service'),$this->config->item('checkin_status_in'));

        $data['second_total_in'] = $this->AttendanceReports->getSummary($date.$this->config->item('checkin_startime_second_service'),$date.$this->config->item('checkin_endtime_second_service'),$this->config->item('checkin_status_out'));
        $data['second_total_out'] = $this->AttendanceReports->getSummary($date.$this->config->item('checkin_startime_second_service'),$date.$this->config->item('checkin_endtime_second_service'),$this->config->item('checkin_status_in'));
        
        $data['third_total_in'] = $this->AttendanceReports->getSummary($date.$this->config->item('checkin_startime_third_service'),$date.$this->config->item('checkin_endtime_third_service'),$this->config->item('checkin_status_out'));
        $data['third_total_out'] = $this->AttendanceReports->getSummary($date.$this->config->item('checkin_startime_third_service'),$date.$this->config->item('checkin_endtime_third_service'),$this->config->item('checkin_status_in'));
        return $data;
    }

}