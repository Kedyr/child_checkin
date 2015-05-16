<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 */

function print_feedback($success, $message, $previous = false) {
	print return_feedback($success, $message, $previous);
}

function return_feedback($success, $message, $previous = false) {
	if(isset($success) && strlen($message) > 1){
	    if ($success)
	        return "<div class='alert alert-success'><button class='close' data-dismiss='alert' type='button'>×</button>" . $message . "</div>";
	    else
	        return "<div class='alert alert-error alert-danger'><button class='close' data-dismiss='alert' type='button'>×</button>" . $message . "</div>";

	    if ($previous)
	        return "<div style='margin:15px 0px 15px 0px;' ><a onclick='history.back(-1);' class='btn_link' href='#'>Go back to previous page</a></div>";
	}
}


function return_error_message($error_head, $error_message) {
    $ci = &get_instance();
    $ci->session->set_flashdata(array('error_head' => $error_head, 'error_message' => $error_message));
    redirect('admin_secure/error');
}
