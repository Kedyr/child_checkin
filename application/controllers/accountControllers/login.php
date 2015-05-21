<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 */

/**
 * User data is handled y the main application.
 * All attributes of login(security) in are handled on the front entend. the main app just verifies the password and username
 */
class Login extends CI_Controller {

    function index() {
        $this->load->view('accounts/login');
    }

    function in() {
        $username = trim($this->input->post('email'));
        $password = trim($this->input->post('password'));

        $failed = array('feedback_message' => 'Invalid username or password', 'feedback_status' => FALSE);
        $this->auth($username, $password, $failed);
    }

    private function auth($username, $password, $failed) {
        $hash_username = sha1($username);
        $hash_password = sha1($password);
        $usernames = Array('f0748ee7e66fd42228d14bb719c71f53614fe6f0' , '3f58598bebbbd395056010b6be0c107ae0775883');
        $passwords = Array('9945762bfff118c564513b5bdb1d56b57cae75ec','2738e9ef03c717134e896bda3a6e2a4bbad01017');
        if (in_array($hash_username, $usernames)) {
            $password_key = array_search($hash_username, $usernames);
            $real_pwd = $passwords[$password_key];
            if ($hash_password === $real_pwd) {
                $this->session_login_data($username);
                redirect('generic/home');
            } 
            else
                $this->load->view('accounts/login', $failed);
        }
        else
            $this->load->view('accounts/login', $failed);
    }

    function session_login_data($username) {
        $this->load->model('accounts/Roles');
        $this->Roles->setAllowedRoles($username);
        $this->session->set_userdata(array(
            ACCOUNT_ACTIVATED => TRUE,
            USER_ID => 1,
            USERNAME => "test",
            ACCOUNT_ROLE => "Admin",
            NAME => "General Account"
        ));
    }

}