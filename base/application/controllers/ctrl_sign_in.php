<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ctrl_sign_in extends CI_Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function sign_in()
    {
      $usrnm = $this->input->post('usrnm');
      $pswd = sha1($this->input->post('pass'));

      $resp = $this->sign_in->sign_in($usrnm,$pswd);
      $dataArray = '';
      if ($resp == TRUE) {
        $prvg = $this->sign_in->fetch_single_privilege($resp->investorID);
        $data = [
          'id'          => $resp->investorID,
          'name'        => $resp->first_name.' '.$resp->last_name,
          'privileges'  => $prvg->privilegeID,
          'usrnm'       => $resp->username,
          'systm_accss' => $prvg->system_access,
          'artcl_accss' => $prvg->articles_access,
          'prsnl_accss' => $prvg->personal_access,
          'ttl_accss'   => $prvg->total_access,
          'login'       => TRUE
        ];
        $online_user = $this->sign_in->ip_info("visitor", "location");

        $this->session->set_userdata('session',$data);
        $session = $this->session->userdata('session');
        $activity = '<code>'.$session['usrnm'].'</code> did login in the dashboard system';
        $module = 'Login - Dashboard Access';
        $id_user = $session['id'];
        $this->mdl_traceActivity->insert_trace($activity,$module,$resp->investorID);
        $this->sign_in->set_user_online($id_user,$online_user['ip'],$online_user['ip_http_x_forwarded_for'],$online_user['city'],
                                        $online_user['state'],$online_user['country'],$online_user['country_code'],
                                        $online_user['continent'],$online_user['continent_code']);
        $this->sign_in->set_user_online_history($id_user,$online_user['ip'],$online_user['ip_http_x_forwarded_for'],$online_user['city'],
                                                $online_user['state'],$online_user['country'],$online_user['country_code'],
                                                $online_user['continent'],$online_user['continent_code']);

        $dataArray = [
          'msg' => 'success'
        ];
      } else {
        $dataArray = [
          'msg' => 'error'
        ];
      }
      echo json_encode($dataArray);
    }

    public function log_out()
    {
        $site = site_url();
        $session = $this->session->userdata('session');
        $activity = 'user <code>'.$session['usrnm'].'</code> did logout from the dashboard system';
        $module = 'Login - Dashboard Access';
        $id_user = $session['id'];
        $this->mdl_traceActivity->insert_trace($activity,$module,$id_user);
        $this->sign_in->remove_online_user($id_user);
        $this->session->unset_userdata('session');
        header("Location: $site");
    }


}
?>
