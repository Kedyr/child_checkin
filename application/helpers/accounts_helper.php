<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 */

/**
 * Check if user logged in. Also test if user is activated or not.
 *
 * @param	bool
 * @return	bool
 */
function is_logged_in() {
    $ci = & get_instance();
    return $ci->session->userdata(ACCOUNT_ACTIVATED);
}

/**
 *
 * @param <type> $current_url the url which the user attempted to visit
 */
function redirect_to_login_page() {
    $current_url = url_parameter_encode($current_url);
    redirect(site_url('login'));
}

function get_logged_in_user_id() {
    $ci = & get_instance();
    return $ci->session->userdata(USER_ID);
}



function get_account_role() {
    $ci = & get_instance();
    return $ci->session->userdata(ACCOUNT_ROLE);
}

function get_userId() {
    $ci = & get_instance();
    return $ci->session->userdata(USER_ID);
}

function get_username() {
    $ci = & get_instance();
    return $ci->session->userdata(USERNAME);
}

function get_name() {
    $ci = & get_instance();
    return $ci->session->userdata(NAME);
}


function sessionDestroy(){
    $ci = & get_instance();
    $ci->session->set_userdata(array(USER_ID => '', USERNAME => '', ACCOUNT_ACTIVATED => ''));
    $ci->session->sess_destroy();
    redirect_to_login_page();
}


function restrictUserFunctionlityBasedOnRole($role) {
        if (!grant_access_to_role($role)) {
            return_error_message("Access Denied","You don't have the rights to perform specified action");
            return;
        }
 }
 
 /**
 * function determines wether a user has the right to access a particular *function
 */
function grant_access_to_role($role) {
    $ci = & get_instance();
    $roles = $ci->session->userdata('allowed_roles');
    foreach($roles as $role_){
        if ($role_ === $role)
            return TRUE;
    }
    return FALSE;
}
