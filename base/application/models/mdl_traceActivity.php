<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_traceActivity extends CI_Model{


  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function insert_trace($activity,$module,$id_user)
  {
    $data = array(
      'traceActivity'   => $activity,
      'traceDate'       => date('Y-m-d H:i:s'),
      'traceModule '    => $module,
      'traceCreatorID'  => $id_user
    );
    if($this->db->insert('traceActivity_tbl',$data)){
      return TRUE;
    }else {
      return FALSE;
    }
  }

}
