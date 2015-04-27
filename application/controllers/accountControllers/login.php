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
    
    
    function in(){
        $username = trim($this->input->post('email'));
        $password = trim($this->input->post('password'));

        $failed = array('feedback_message'=>'Invalid username or password','feedback_status'=>FALSE);
        if(sha1($username)=='3f58598bebbbd395056010b6be0c107ae0775883')
                if(sha1($password)==='2738e9ef03c717134e896bda3a6e2a4bbad01017'){
                    $this->session_login_data();
                    redirect('generic/home');
                }
                else
                     $this->load->view('accounts/login', $failed);
        else
             $this->load->view('accounts/login', $failed);
    }
    
    function test(){
      //  print sha1("test12Password");
       //print sha1("watoto@watoto.ug");
    }
    

    function session_login_data() {
        $this->session->set_userdata(array(
            ACCOUNT_ACTIVATED => TRUE,
            USER_ID => 1,
            USERNAME => "test",
            ACCOUNT_ROLE => "Admin",
            NAME => "General Account"
        ));
    }
}