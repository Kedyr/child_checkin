<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 */

class Dbwrapper extends CI_Model {

    //todo amplify error reporting
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * function checks if a record exists in a given table
     * @param <string> $table_name
     * @param <array> $where_cond_arraythe an associative array containg the column name and row value to be used for the matching
     * @return bool true if record exists false for no
     */
    function minedb_check_if_record_exists($table_name, $where_cond_array) {
        $query = $this->db->get_where($table_name, $where_cond_array);
        $count = $query->result();
        if (count($count) > 0)
            return TRUE;
        else
            return FALSE;
    }

    /**
     * function updates a specific record
     * @param <array> $identifying_arr_value an associative array containg the identifying collumn and its value
     * @param <array> $arr_values the values to be edited stored in an associative array
     * @param <string> $table_name
     * @return <type> array with [status'[notice] based on sucess
     */
    function minedb_update($identifying_arr_value, $arr_values, $table_name) {
        $reply = $this->db->update($table_name, $arr_values, $identifying_arr_value);
        return $this->format_reply($reply);
    }

    /**
     * function saves attributes
     * @param <type> $array
     */
    function minedb_insert($arr_values, $table_name, $get_insert_id = FALSE) {
        $db_reply = $this->db->insert($table_name, $arr_values);
        if ($get_insert_id) {
            $insert_id = $this->db->insert_id();
            return $this->format_reply($db_reply, $insert_id);
        }
        else
            return $this->format_reply($db_reply);
    }

    /**
     * function saves attributes
     * @param <type> $array
     */
    function db_insert_batch($arr_values, $table_name) {
        $db_reply = $this->db->insert_batch($table_name, $arr_values);
        return $this->format_reply($db_reply);
    }

    function format_reply($db_response, $data = '') {
        if ($db_response) {
            return array(
                'status' => 1,
                'data' => $data
            );
        } else {
            return array(
                'notice' => 'Server Error',
                'status' => 0
            );
        }
    }

    /**
     * function slects records from the database based on a particular where clause
     * @param <type> $table_name
     * @param <type> $where_condition an associative array with column name(key) and expected value
     * @param <string> $columns_to_select the columns to be selected ie 'foo,baar' [comma limited]
     * @return array
     */
    function minedb_get_where($table_name, $where_condition, $columns_to_select = '') {
        $this->db->start_cache();
        if ($columns_to_select != '')
            $this->db->select($columns_to_select);
        $query = $this->db->get_where($table_name, $where_condition);
        $this->db->stop_cache();
        return $this->summarize_get_and_select($query);
    }

    /**
     *   * function select records from a database
     * @param <type> $table_name
     * @param <string> $columns_to_select the columns to be selected ie 'foo,baar' [comma limited]
     * @param <int> $limit
     * @param <int> $offset
     * @return <array>
     */
    function minedb_get($table_name, $columns_to_select = '', $limit = '', $offset = '') {
        $this->db->start_cache();
        if ($columns_to_select != '')
            $this->db->select($columns_to_select);
        if (isset($limit) && (isset($offset)))
            $query = $this->db->get($table_name, $limit, $offset);
        else
            $query = $this->db->get($table_name);
        $this->db->stop_cache();
        return $this->summarize_get_and_select($query);
    }

    /**
     * function slects a single record from the database based on a particular where clause
     * @param <type> $table_name
     * @param <type> $where_condition an associative array with column name(key) and expected value
     * @param <string> $columns_to_select the columns to be selected ie 'foo,baar' [comma limited]
     * @return array
     */
    function minedb_get_one($table_name, $where_condition, $columns_to_select = "") {
        $this->db->start_cache();
        if ($columns_to_select != '')
            $this->db->select($columns_to_select);
        $query = $this->db->get_where($table_name, $where_condition);
        $this->db->stop_cache();
        return $this->summarize_get_and_select($query, TRUE, $columns_to_select);
    }

    /**
     * function formats the results of a select
     * @param <type> $query
     * @return <type>
     */
    function format_select_reply($query) {
        $db_reply = array();
        if(!$query){
            return array(
                'status' => 0,
                'notice' => "There were no records with the specified search criteria"
            ); 
        }
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                array_push($db_reply, $row);
            }
            return array(
                'status' => 1,
                'data' => $db_reply,
                'rows' => $query->num_rows()
            );
        } else {
            return array(
                'status' => 0,
                'notice' => "There were no records with the specified search criteria"
            );
        }
    }

    /**
     * function returns column names belongiong to a particular table
     * @param <type> $table_name
     * @return <array>
     */
    function minedb_list_fields($table_name) {
        $fields = $this->db->list_fields($table_name);
        $cols = array();
        if ($fields) {
            foreach ($fields as $field) {
                array_push($cols, $field);
            }
            return array(
                'status' => 1,
                'data' => $cols
            );
        } else {
            return array(
                'status' => 1,
                'notice' => 'Server Error'
            );
        }
    }

    /**
     * function deletes a record
     * @param <array> $id_array associatve array containg the key and its value unique to a particular record
     * @param <type> $table_name
     * @return <array>
     */
    function minedb_delete($id_array, $table_name) {
        $query = $this->db->delete($table_name, $id_array);
        return $this->format_reply($query);
    }

    /**
     * function select data from the database using a 'raw' query submited query
     * @param <type> $query
     */
    function minedb_raw_get($query) {
        $query = $this->db->query($query);
        return $this->format_select_reply($query);
    }

    /**
     * function xcutessing a 'raw' query submited query
     * @param <type> $query
     */
    function minedb_raw($query) {
        $query = $this->db->query($query);
        return $query;
    }

    function minedb_num_rows($query_resource) {
        return $query_resource->num_rows();
    }

    /**
     * Function creates a table
     * @param <string> $table_name
     * @param <string> $primary_key_column
     * @param <array> $fields
     * @return <array>
     */
    function minedb_create_table($table_name, $primary_key_column, $fields) {
        $this->load->dbforge();
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key($primary_key_column, TRUE);
        $query = $this->dbforge->create_table($table_name);
        return $this->format_reply($query);
    }

    //returns an empty error on failure to get results
    function summarize_get_and_select($query, $one_record = FALSE, $select_column = "") {
        $db_reply = $this->format_select_reply($query);
        if ($db_reply['status'] == 1) {
            if ($one_record) {
                if ($select_column == "")
                    return $db_reply['data'][0];
                else
                    return $db_reply['data'][0][$select_column];
            }
            else
                return $db_reply['data'];
        }
        else {
            return array();
        }
    }
    
    function getSingleTableAttribute($tablename,$id_column,$id_column_value,$sought_value_column ) {
        $query = $this->db->get_where($tablename, array($id_column => $id_column_value));
        return $this->summarize_get_and_select($query, TRUE, $sought_value_column);
    }

}