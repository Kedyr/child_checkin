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

    function edit($handler_details, $handler_id) {
        return $this->db->update(TBL_HANDLERS, $handler_details, array(COL_HANDLER_ID => $handler_id));
    }

    function checkExists($name) {
        return $this->Dbwrapper->minedb_check_if_record_exists(TBL_HANDLERS, array(COL_HANDLER_NAME => $name));
    }

    function checkExistsByEmail($email) {
        return $this->Dbwrapper->minedb_check_if_record_exists(TBL_HANDLERS, array(COL_EMAIL => $email));
    }

    function checkExistsByPhone($phone) {
        return $this->Dbwrapper->minedb_check_if_record_exists(TBL_HANDLERS, array(COL_PHONENO => $phone));
    }

    function insertHandlerChildRelationship($child_id, $handler_id, $relationship_id) {
        return $this->db->insert(TBL_CHILD_HANDLER_RELATIONSHIP, array(COL_CHILD_ID => $child_id, COL_RELATIONSHIP => $relationship_id, COL_HANDLER_ID => $handler_id));
    }

    function getSingleHandlerColumnAttribute($value, $column, $requested_column) {
        $query = $this->db->get_where(TBL_HANDLERS, array($column => $value));
        return $this->Dbwrapper->summarize_get_and_select($query, TRUE, $requested_column);
    }

    function relationShipExists($child_id, $handler_id) {
        return $this->Dbwrapper->minedb_check_if_record_exists(TBL_CHILD_HANDLER_RELATIONSHIP, array(COL_CHILD_ID => $child_id, COL_HANDLER_ID => $handler_id));
    }

    function getChildHandlers($childId) {
        $this->db->select(TBL_HANDLERS . '.* , ' . TBL_CHILD_HANDLER_RELATIONSHIP . '.' . COL_RELATIONSHIP)->from(TBL_HANDLERS)->join(TBL_CHILD_HANDLER_RELATIONSHIP, TBL_CHILD_HANDLER_RELATIONSHIP . '.' . COL_HANDLER_ID . ' = ' . TBL_HANDLERS . '.' . COL_HANDLER_ID);
        $query = $this->db->where(TBL_CHILD_HANDLER_RELATIONSHIP . '.' . COL_CHILD_ID, $childId)->get();
        return $this->Dbwrapper->summarize_get_and_select($query);
    }

    function get($handler_id) {
        $query = $this->db->get_where(TBL_HANDLERS, array(COL_HANDLER_ID => $handler_id));
        return $this->Dbwrapper->summarize_get_and_select($query, TRUE);
    }

    function getAll() {
        $query = $this->db->get(TBL_HANDLERS);
        return $this->Dbwrapper->summarize_get_and_select($query);
    }

    function getHandlerChildren($handler_id) {
        $this->db->select(TBL_CHILDREN . '.*  , ' . TBL_CHILD_HANDLER_RELATIONSHIP . '.' . COL_RELATIONSHIP)->from(TBL_CHILDREN)->join(TBL_CHILD_HANDLER_RELATIONSHIP, TBL_CHILD_HANDLER_RELATIONSHIP . '.' . COL_CHILD_ID . ' = ' . TBL_CHILDREN . '.' . COL_CHILD_ID);
        $this->db->where(TBL_CHILD_HANDLER_RELATIONSHIP . '.' . COL_HANDLER_ID, $handler_id);
        $query = $this->db->get();
        return $this->Dbwrapper->summarize_get_and_select($query);
    }
    
    function deleteHandler($handler_id){
        return $this->db->delete(TBL_HANDLERS,array(COL_HANDLER_ID=>$handler_id));
    }


}