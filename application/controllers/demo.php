<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 */
require APPPATH . '/controllers/admin_secure.php';

class Demo extends Admin_secure {
    
    
    function resetCheckins(){
        $this->db->update(TBL_CHECKINOUT,array(COL_STATUS=>'OUT'));
    }

}