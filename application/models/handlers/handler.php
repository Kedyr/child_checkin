<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 */
class Handler extends CI_Model {

    //todo amplify error reporting
    public function __construct() {
        parent::__construct();
    }

    function insert($handlerDetails) {
        $this->db->insert(TBL_HANDLERS, $handlerDetails);
        return $this->db->insert_id();
    }

    function checkExists($name) {
        return $this->DbWrapper->minedb_check_if_record_exists(TBL_HANDLERS, array(COL_HANDLER_NAME => $name));
    }

    function checkExistsByEmail($email) {
        return $this->DbWrapper->minedb_check_if_record_exists(TBL_HANDLERS, array(COL_EMAIL => $email));
    }

    function checkExistsByPhone($phone) {
        return $this->DbWrapper->minedb_check_if_record_exists(TBL_HANDLERS, array(COL_PHONENO => $phone));
    }

    function insertHandlerChildRelationship($child_id, $handler_id, $relationship_id) {
        return $this->db->insert(TBL_CHILD_HANDLER_RELATIONSHIP, array(COL_CHILD_ID => $child_id, COL_RELATIONSHIP => $relationship_id, COL_HANDLER_ID => $handler_id));
    }

    function getSingleHandlerColumnAttribute($value, $column, $requested_column) {
        $query = $this->db->get_where(TBL_HANDLERS, array($column => $value));
        return $this->DbWrapper->summarize_get_and_select($query, TRUE, $requested_column);
    }
    
    function relationShipExists($child_id,$handler_id){
         return $this->DbWrapper->minedb_check_if_record_exists(TBL_CHILD_HANDLER_RELATIONSHIP, array(COL_CHILD_ID => $child_id,COL_HANDLER_ID=>$handler_id));
    }

}