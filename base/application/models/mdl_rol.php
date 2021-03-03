<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_rol extends CI_Model{


  public function __construct() {
        parent::__construct();
        $this->load->database();
    }

/*
    * Function fetch all roles registered in the system
    *
    *  @return  List of roles registered in the system
    *
    *  @author: Carlos Gonzalez
    */

    public function fetch_role()
    {
      $this->db->select('*');
      $this->db->from('tbl_rol');
      $sql = $this->db->get();
        return $sql->result_array();  
    }

    /*
      * Function to count all roles in the system
      *
      *  @return  total of roles in the system
      *
      *  @author: Carlos Gonzalez
      */
      public function getRecordCount() {
        $query = $this->db->select('count(*) as allcount')->get('tbl_rol');
      	$result = $query->row();
        if (isset($result)) {
          return $result->allcount;
        }
      	return 0;
    }
}
