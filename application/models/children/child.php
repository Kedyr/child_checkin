<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 */
class Child extends CI_Model {

    //todo amplify error reporting
    public function __construct() {
        parent::__construct();
    }

    function insert($childDetails) {
        $this->db->insert(TBL_CHILDREN, $childDetails);
        return $this->db->insert_id();
    }

    function edit($childData, $child_id) {
        return $this->db->update(TBL_CHILDREN, $childData, array(COL_CHILD_ID => $child_id));
    }

    function checkExists($name) {
        return $this->Dbwrapper->minedb_check_if_record_exists(TBL_CHILDREN, array(COL_CHILD_NAME => $name));
    }

    function getAllForSearch() {
        $query = $this->db->select(COL_CHILD_NAME . ' , ' . COL_CHILD_ID)->from(TBL_CHILDREN)->get();
        $results = $this->Dbwrapper->summarize_get_and_select($query);
        $children = array();
        foreach ($results as $child) {
            $children[$child[COL_CHILD_ID]] = $child[COL_CHILD_NAME];
        }
        return $children;
    }

    function getChild($childId) {
        $query = $this->db->get_where(TBL_CHILDREN, array(COL_CHILD_ID => $childId));
        return $this->Dbwrapper->summarize_get_and_select($query, TRUE);
    }

    function getHandlers($childId) {
        $this->db->select(TBL_HANDLERS . '.* , ' . TBL_CHILD_HANDLER_RELATIONSHIP . '.' . COL_RELATIONSHIP)->from(TBL_HANDLERS)->join(TBL_CHILD_HANDLER_RELATIONSHIP, TBL_CHILD_HANDLER_RELATIONSHIP . '.' . COL_HANDLER_ID . ' = ' . TBL_HANDLERS . '.' . COL_HANDLER_ID);
        $query = $this->db->where(TBL_CHILD_HANDLER_RELATIONSHIP . '.' . COL_CHILD_ID, $childId)->get();
        return $this->Dbwrapper->summarize_get_and_select($query);
    }

    /**
     * get all children who share the same handlers as childId
     * @param type $childId
     * @param type $handler_ids
     */
    function getSiblings($handler_ids, $childId) {
        $this->db->select(TBL_CHILDREN . '.*')->from(TBL_CHILDREN)->join(TBL_CHILD_HANDLER_RELATIONSHIP, TBL_CHILD_HANDLER_RELATIONSHIP . '.' . COL_CHILD_ID . ' = ' . TBL_CHILDREN . '.' . COL_CHILD_ID);
        $this->db->where(TBL_CHILDREN . '.' . COL_CHILD_ID . ' <> ' . $childId);
        $this->db->where_in(TBL_CHILD_HANDLER_RELATIONSHIP . '.' . COL_HANDLER_ID, $handler_ids);
        $this->db->group_by(COL_CHILD_ID);
        $query = $this->db->get();
        return $this->Dbwrapper->summarize_get_and_select($query);
    }

    function getAll() {
        $query = $this->db->get(TBL_CHILDREN);
        return $this->Dbwrapper->summarize_get_and_select($query);
    }

    function getSingleChildColumnValue($child_id, $requested_column) {
        $query = $this->db->get_where(TBL_CHILDREN, array(COL_CHILD_ID => $child_id));
        return $this->Dbwrapper->summarize_get_and_select($query, TRUE, $requested_column);
    }

    function getSingleVarChildColumnAttribute($value, $column, $requested_column) {
        $query = $this->db->get_where(TBL_CHILDREN, array($column => $value));
        return $this->Dbwrapper->summarize_get_and_select($query, TRUE, $requested_column);
    }
    
    function deleteChild($child_id){
        return $this->db->delete(TBL_CHILDREN,array(COL_CHILD_ID=>$child_id));
    }

}