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
    
    
    function insert($childDetails){
        $this->db->insert(TBL_CHILDREN, $childDetails);
        return $this->db->insert_id();
    }
    
    function checkExists($name){
        return $this->DbWrapper->minedb_check_if_record_exists(TBL_CHILDREN,array(COL_CHILD_NAME=>$name));
    }
    
    function getAllForSearch(){
        $query = $this->db->select(COL_CHILD_NAME.' , '.COL_CHILD_ID)->from(TBL_CHILDREN)->get();
        $results = $this->DbWrapper->summarize_get_and_select($query);
        $children = array();
        foreach($results as $child){
            $children[$child[COL_CHILD_ID]] = $child[COL_CHILD_NAME];
        }
        return    $children;   
    }
    
    function getChild($childId){
        $query = $this->db->get_where(TBL_CHILDREN,array(COL_CHILD_ID=>$childId));
        return  $this->DbWrapper->summarize_get_and_select($query,TRUE);
    }
    
    function getHandlers($childId){
        $this->db->select(TBL_HANDLERS.'.* , '.TBL_CHILD_HANDLER_RELATIONSHIP.'.'.COL_RELATIONSHIP)->from(TBL_HANDLERS)->join(TBL_CHILD_HANDLER_RELATIONSHIP, TBL_CHILD_HANDLER_RELATIONSHIP.'.'.COL_HANDLER_ID.' = '.TBL_HANDLERS.'.'.COL_HANDLER_ID);
        $query = $this->db->where(TBL_CHILD_HANDLER_RELATIONSHIP.'.'.COL_CHILD_ID,$childId)->get();
        return $this->DbWrapper->summarize_get_and_select($query);
    }
    
    /**
     * get all children who share the same handlers as childId
     * @param type $childId
     * @param type $handler_ids
     */
    function getSiblings($handler_ids,$childId){
        $this->db->select(TBL_CHILDREN.'.*')->from(TBL_CHILDREN)->join(TBL_CHILD_HANDLER_RELATIONSHIP, TBL_CHILD_HANDLER_RELATIONSHIP.'.'.COL_CHILD_ID.' = '.TBL_CHILDREN.'.'.COL_CHILD_ID);
        $this->db->where(TBL_CHILDREN.'.'.COL_CHILD_ID.' <> '.$childId);
         $this->db->where_in(TBL_CHILD_HANDLER_RELATIONSHIP.'.'.COL_HANDLER_ID,$handler_ids);
         $query = $this->db->get();
        return $this->DbWrapper->summarize_get_and_select($query);
    }
    
}