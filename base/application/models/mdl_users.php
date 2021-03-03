<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_users extends CI_Model{


  public function __construct() {
        parent::__construct();
        $this->load->database();
    }

/*
    * Function fetch all users registered in the system
    *
    *  @return  List of users registered in the system
    *
    *  @author: Carlos Gonzalez
    */

    public function fetch_users($start,$length)
    {
      $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->join('tbl_privileges', 'tbl_privileges.tbl_users_id = tbl_users.id');
        $this->db->join('tbl_rol', 'tbl_rol.rolID = tbl_users.tbl_rol_rolID');
        //$this->db->limit($length, $start);
        $this->db->order_by('id','ASC');
        return $this->db->get();
    }

    /*
        * Function fetch a single user registered in the system
        *
        *  @param:  $id --> User ID
        *  @return  a user registered in the system
        *
        *  @author: Carlos Gonzalez
        */

        public function fetch_a_single_user($id)
        {
          $this->db->select('*');
          $this->db->from('tbl_users');
          $this->db->join('tbl_privileges', 'tbl_privileges.tbl_users_id = tbl_users.id');
          $this->db->join('tbl_rol', 'tbl_rol.rolID = tbl_users.tbl_rol_rolID');
          $this->db->where('id', $id);
          $query = $this->db->get();
          return $query->result();
        }

    /*
        * Function fetch all privileges registered in the system
        *
        *  @return  List of users registered in the system
        *
        *  @author: Carlos Gonzalez
        */

        public function fetch_privilege($id_user)
        {
          $this->db->select('*');
            $this->db->from('tbl_privileges');
            $this->db->where('tbl_users_id',$id_user);
            return $this->db->get();
        }

    /*
      * Function to count all users in the system
      *
      *  @return  total of users in the system
      *
      *  @author: Carlos Gonzalez
      */
      public function getRecordCount() {
        $query = $this->db->select('count(*) as allcount')->get('tbl_users');
      	$result = $query->row();
        if (isset($result)) {
          return $result->allcount;
        }
      	return 0;
    }

    /*
* Function to insert a new user to the system
*  @paramet $full_name      - Full name of the user
*           $email          - Email
*           $username       - usuario
*           $passwd         - Password
*           $tbl_rol_rolID  - ID del rol del usuario
*           $webSite        - Si tiene privilegios de webSite
*           $articles       - Si tiene privilegios de articles
*           $stats          - Si tiene privilegios de stats
*  @return TRUE if the record was added correctly
*          FALSE if the record was not added
*
* @author: Carlos Gonzalez
*/
  public function insert_user()
  {
    $data = array(
                  'user_code'      => $this->user_code_creator($this->input->post('full_name')),
                  'full_name'      => $this->input->post('full_name'),
                  'email'          => $this->input->post('email'),
                  'username'       => $this->input->post('username'),
                  'passwd'         => sha1($this->input->post('passwd')),
                  'created'        => date('Y-m-d H:i:s'),
                  'tbl_rol_rolID'  => $this->input->post('rol'),
                  'status'         => '-1'
                  );
    $last_id_added = '';
    if ($this->db->insert('tbl_users',$data)) {
      $last_id_added = $this->last_id_added();

      $data_privileges = array(
                  'webSite'       => $this->input->post('fullAccess'),
                  'articles'      => $this->input->post('articlesAccess'),
                  'stats'         => $this->input->post('statsAccess'),
                  'tbl_users_id'  => $last_id_added[0]->id
      );
      if ($this->db->insert('tbl_privileges',$data_privileges)) {
        return TRUE;
      }
      else{
        return FALSE;
      }
    }else {
      return FALSE;
    }
  }

  /*
* Function to quick edit a user to the system
*  @paramet $full_name      - Full name of the user
*           $email          - Email
*           $username       - usuario
*           $tbl_rol_rolID  - ID del rol del usuario
*           $status         - User status (Active, No Active, Pending)
*  @return TRUE if the record was added correctly
*          FALSE if the record was not added
*
* @author: Carlos Gonzalez
*/
public function quick_user_edit($id)
{
  $data = array(
                'full_name'      => $this->input->post('edit_full_name'),
                'email'          => $this->input->post('edit_email'),
                'username'       => $this->input->post('edit_username'),
                'tbl_rol_rolID'  => $this->input->post('edit_rol'),
                'status'         => $this->input->post('edit_status')
                );
  $this->db->where('id',$id);
  $this->db->update('tbl_users',$data);

  if ($this->db->affected_rows() > 0) {
      return TRUE;
    }else {
    return FALSE;
  }
}

  public function last_id_added()
  {
    $sql = "SELECT * FROM tbl_users ORDER BY id DESC LIMIT 1;";
    $query = $this->db->query($sql);
    return $query->result();
  }

  public function user_code_creator($full_name)
  {
    $words = explode(" ", $full_name);
    $user_code = "";
    foreach ($words as $w) {
      $user_code .= ucfirst($w[0]);
    }
    return $user_code.=rand(0,1000000);
  }

  /* Function to delete a user
  *  @paramet $id             - User ID
  *           $privilegesID   - Privileges ID
  *  @return TRUE if the record was deleted correctly
  *          FALSE if the record was not deleted
  *
  * @author: Carlos Gonzalez
  */

  public function delete_user($id,$privilegesID)
      {
          $this->db->where('privilegesID',$privilegesID);
          $this->db->delete('tbl_privileges');

          $this->db->where('id',$id);
          $this->db->delete('tbl_users');
          if ($this->db->affected_rows() > 0) {
              return TRUE;
          }else{
              return FALSE;
          }
      }

}
