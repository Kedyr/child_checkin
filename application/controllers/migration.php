<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 *
 * @author Kedyr <deniskedyr@gmail.com>
 */
require APPPATH . '/controllers/admin_secure.php';

class Migration extends Admin_secure {

    function migrateChildren() {
        $this->db->select('NAME , SEX , SCHOOL ,  CLASS , PLACEOFRESIDENCEC , DATEOlFBIRTH ,CELLNUMBER_,CELLLEADERSNAMEC');
        $this->db->from('movers_shakers__');
        $query = $this->db->get();

        $rsults = $this->Dbwrapper->summarize_get_and_select($query);
        $response = array();
        foreach ($rsults as $result) {
            $name = $result['NAME'];
            $childData[COL_CHILD_NAME] = $result['NAME'];
            $childData[COL_SEX] = $result['SEX'];
            $childData[COL_RESIDENCE] = $result['PLACEOFRESIDENCEC'];
            $childData[COL_CELL_NO] = $result['CELLNUMBER_'];
            $childData[COL_CELL_LEADER_NAME] = $result['CELLLEADERSNAMEC'];
            $childData[COL_CHURCH_MEMBERSHIP] = NULL;
            $childData[COL_SCHOOL] = $result['SCHOOL'];
            $childData[COL_SCHOOL_CLASS] = Null;
            $childData[COL_CHURCH_CLASS] = "Heroes";
            $childData[COL_DOB] = $result['DATEOlFBIRTH'];

            $this->load->model('children/Child');
            /*  if (!$this->Child->checkExists($name))
              $child_id = $this->Child->insert($childData);
              } */
        }
    }

    /* function mapChildrenIds() {
      $this->db->select("childId , " . COL_CHILD_NAME);
      $this->db->from(TBL_CHILDREN);
      $query = $this->db->get();
      $rsults = $this->Dbwrapper->summarize_get_and_select($query);
      foreach ($rsults as $result) {
      $this->db->update('movers_shakers', array('childId' => $result['childId']), array('NAME' => $result[COL_CHILD_NAME]));
      }
      } */

    function migrate() {
        $this->db->select('childId ,FATHERSNAME , CONTACT , PLACEOFRESIDENCE , PLACEOFWORK , EMAILADDRESS ,CELLNO , CELLLEADERSNAME1 , CELLLEADERSCONTACT , MOTHERSNAME , CONTACT1 , PLACEOFRESIDENCE2 , PLACEOFWORK1 , EMAILADDRESS1 ,CELLNO1 , CELLLEADERSNAME2 , CELLLEADERSCONTACT1');
        $this->db->from('amazingclass');
        $query = $this->db->get();

        $rsults = $this->Dbwrapper->summarize_get_and_select($query);
        $response = array();
        foreach ($rsults as $result) {
            $datam = array();
            $emailm = $result['EMAILADDRESS1'];
            $datam[COL_EMAIL] = $emailm;
            $namem = $result['MOTHERSNAME'];
            $datam[COL_HANDLER_NAME] = $namem;
            $datam[COL_RESIDENCE] = $result['PLACEOFRESIDENCE2'];
            $phonem = $result['CONTACT1'];
            $datam[COL_PHONENO] = $phonem;
            $datam[COL_OTHER_CHURCH] = NULL;
            $datam[COL_WORK_PLACE] = $result['PLACEOFWORK1'];
            $datam[COL_CELL_NO] = $result['CELLNO1'];
            $datam[COL_CELL_LEADER_NAME] = $result['CELLLEADERSNAME2'];
            $datam[COL_CELL_LEADER_CONTACT] = $result['CELLLEADERSCONTACT1'];
            $data[COL_SEX] = 'Female';
            $child_id = $result['childId'];

          //  $response = $this->insertHandler($datam, "Mother", $child_id, $phonem, $emailm, $namem);

            $email = $result['EMAILADDRESS'];
            $data[COL_EMAIL] = $email;
            $name = $result['FATHERSNAME'];
            $data[COL_HANDLER_NAME] = $name;
            $data[COL_RESIDENCE] = $result['PLACEOFRESIDENCE'];
            $phone = $result['CONTACT'];
            $data[COL_PHONENO] = $phone;
            $data[COL_OTHER_CHURCH] = NULL;
            $data[COL_WORK_PLACE] = $result['PLACEOFWORK'];
            $data[COL_CELL_NO] = $result['CELLNO'];
            $data[COL_CELL_LEADER_NAME] = $result['CELLLEADERSNAME1'];
            $data[COL_CELL_LEADER_CONTACT] = $result['CELLLEADERSCONTACT'];
            $data[COL_SEX] = 'Male';

            //$response = $this->insertHandler($data, "Father", $child_id, $phone, $email, $name);
        }
    }

    function insertHandler($data, $relationship, $child_id, $phone, $email, $name) {
        $this->load->model('handlers/Handler');
        $handler_id = 0;
        if (strlen($name) > 2) {
            if ($this->Handler->checkExists($name))
                $handler_id = $this->Handler->getSingleHandlerColumnAttribute($name, COL_HANDLER_NAME, COL_HANDLER_ID);
        }
        //   if ($this->Handler->checkExistsByPhone($phone))
        //      $handler_id = $this->Handler->getSingleHandlerColumnAttribute($phone, COL_PHONENO, COL_HANDLER_ID);
        /*  if (strlen($email) > 2) {
          if ($this->Handler->checkExistsByEmail($email))
          $handler_id = $this->Handler->getSingleHandlerColumnAttribute($email, COL_EMAIL, COL_HANDLER_ID);
          } */
        if (!$handler_id)
            $handler_id = $this->Handler->insert($data);

        if (!$this->Handler->relationShipExists($child_id, $handler_id))
            $this->Handler->insertHandlerChildRelationship($child_id, $handler_id, $relationship);
    }

}

