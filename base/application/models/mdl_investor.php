<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_investor extends CI_Model{


  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function fetch_investor($start,$length)
  {
    $this->db->select('*');
    $this->db->from('investor_tbl');
    $this->db->join('privilege_tbl', 'privilege_tbl.investor_tbl_investorID = investor_tbl.investorID');
    //$this->db->limit($length, $start);
    $this->db->order_by('investorID','DESC');
    return $this->db->get();
  }
  public function fetch_all_investor()
  {
    $this->db->select('*');
    $this->db->from('investor_tbl');
    $this->db->join('privilege_tbl', 'privilege_tbl.investor_tbl_investorID = investor_tbl.investorID');
    $query = $this->db->get();
    return $query->result();
  }

  public function insert_investor($first_name,$last_name,$dob,$email,$username,$pswd,$r_pswd,$status='0',$system_access='0',
  $articles_access='0',$personal_access='1',$total_access='0')
  {
    $data = array(
      'first_name'   => $first_name,
      'last_name'    => $last_name,
      'dob'          => $dob,
      'created_date' => date('Y-m-d H:i:s'),
      'status'       => $status,
      'email'        => $email,
      'username'     => $username,
      'pswd'         => sha1($pswd),
      'compounding'  => 'off'
    );
    $invtID = '';

    if ($this->fetch_username($username)) {
      return FALSE;
    }
    else {
      if($this->db->insert('investor_tbl',$data)){
        $invtID = $this->last_investor_id();
        $privDat = array(
          'investor_tbl_investorID' => $invtID[0]->investorID,
          'system_access'           => $system_access,
          'articles_access'         => $articles_access,
          'personal_access'         => $personal_access,
          'total_access'            => $total_access
        );
        if ($this->db->insert('privilege_tbl',$privDat)) {
          return TRUE;
        }else{return FALSE;}
    }else{return FALSE;}
    }
  }

  /* Function to delete a investor
  *  @paramet $id             - Investor ID
  *           $privilegesID   - Privileges ID
  *  @return TRUE if the record was deleted correctly
  *          FALSE if the record was not deleted
  *
  * @author: Carlos Gonzalez
  */

  public function delete_investor($id,$privilegeID)
      {
          $this->db->where('privilegeID',$privilegeID);
          $this->db->delete('privilege_tbl');

          if ($this->db->affected_rows() > 0) { // Si borro los datos de privilegio
            $this->db->where('investorID',$id);
            $this->db->delete('investor_tbl'); // Borro los datos de investor
            if ($this->db->affected_rows() > 0) { // si borro los datos de inversionista
              return TRUE; // retorno verdadero
            } else {
              return FALSE; // sino retorno falso
            }
          } else {
            return FALSE; // Si no borro los datos de privilegio retorno falso
          }
      }

      /*
    * Function to quick edit a investor to the system
    *  @paramet $first_name     - First name of the investor
    *           $last_name      - Last name of the investor
    *           $email          - Email
    *           $username       - usuario
    *           $status         - User status (Active, Inactive, Pending)
    *  @return TRUE if the record was added correctly
    *          FALSE if the record was not added
    *
    * @author: Carlos Gonzalez
    */
    public function quick_investor_edit($id,$first_name,$last_name,$email,$username,$status)
    {
      $data = array(
                    'first_name'     => $first_name,
                    'last_name'      => $last_name,
                    'email'          => $email,
                    'username'       => $username,
                    'status'         => $status
                    );
      $this->db->where('investorID',$id);
      $this->db->update('investor_tbl',$data);

      if ($this->db->affected_rows() > 0) {
          return TRUE;
        }else {
        return FALSE;
      }
    }

  /*
  * Function to edit aacces info to an investor (password)
  *  @paramet $id               - Investor ID
  *           $new_passwd       - New Password
  *  @return TRUE if the record was updated correctly
  *          FALSE if the record was not updated
  *
  * @author: Carlos Gonzalez
  */
  public function edit_investor_access_profile($id,$new_passwd)
  {
    $data = array(
                  'pswd' => $new_passwd,
                  );
    $this->db->where('investorID',$id);
    $this->db->update('investor_tbl',$data);

    if ($this->db->affected_rows() > 0) {
        return TRUE;
      }else {
      return FALSE;
    }
  }

  /*
  * Function to edit aacces compounding financing
  *  @paramet $id               - Investor ID
  *           $compounding      -
  *  @return TRUE if the record was updated correctly
  *          FALSE if the record was not updated
  *
  * @author: Carlos Gonzalez
  */
  public function edit_investor_compounding($id,$compounding)
  {
    $data = array(
                  'compounding' => $compounding,
                  );
    $this->db->where('investorID',$id);
    $this->db->update('investor_tbl',$data);

    if ($this->db->affected_rows() > 0) {
        return TRUE;
      }else {
      return FALSE;
    }
  }

    /*
  * Function to full edit a investor to the system
  *  @paramet $first_name     - First name of the investor
  *           $last_name      - Last name of the investor
  *           $email          - Email
  *           $username       - usuario
  *           $status         - User status (Active, Inactive, Pending)
  *  @return TRUE if the record was added correctly
  *          FALSE if the record was not added
  *
  * @author: Carlos Gonzalez
  */
  public function full_investor_edit($id,$first_name,$last_name,$dob,$email,$status,$ttl_accss,$artcl_accss,
                                     $systm_accss,$prsnl_accss)
  {
    $data = array(
      'first_name'     => $first_name,
      'last_name'      => $last_name,
      'email'          => $email,
      'dob'            => $dob,
      'status'         => $status
    );
    $data_privilege = array(
      'system_access'     => $systm_accss,
      'articles_access'   => $artcl_accss,
      'personal_access'  => $prsnl_accss,
      'total_access'     => $ttl_accss
    );

    $this->db->where('investorID',$id);
    $this->db->update('investor_tbl',$data);
    if ($this->db->affected_rows() >= 0) {
      $this->db->where('investor_tbl_investorID',$id);
      $this->db->update('privilege_tbl',$data_privilege);
      if ($this->db->affected_rows() >= 0) {
        return TRUE;
      } else {
        return FALSE;
      }
      }else {
      return FALSE;
    }
  }

  public function fetch_username($username)
  {
    $this->db->select('username');
    $this->db->from('investor_tbl');
    $this->db->where('username',$username);
    $sql = $this->db->get();
    if($sql->num_rows() > 0){
      return  true;
    }else{
      return false;
    }
  }

  public function last_investor_id()
  {
    $sql = "SELECT * FROM investor_tbl ORDER BY investorID DESC LIMIT 1;";
    $query = $this->db->query($sql);
    return $query->result();
  }

  /*
    * Function to count all investors in the system
    *
    *  @return  total of investors in the system
    *
    *  @author: Carlos Gonzalez
    */
    public function getRecordCount() {
      $query = $this->db->select('count(*) as allcount')->get('investor_tbl');
      $result = $query->row();
      if (isset($result)) {
        return $result->allcount;
      }
      return 0;
  }

  /*
      * Function fetch a single investor registered in the system
      *
      *  @param:  $id --> Investor ID
      *  @return  a investor registered in the system
      *
      *  @author: Carlos Gonzalez
      */

      public function fetch_a_single_investor($id)
      {
        $this->db->select('*');
        $this->db->from('investor_tbl');
        $this->db->join('privilege_tbl','privilege_tbl.investor_tbl_investorID = investor_tbl.investorID');
        $this->db->where('investor_tbl.investorID', $id);
        $query = $this->db->get();
        return $query->result();
      }

      /*
       * Function to create a deposit in the system
       *
       *  @param:  $id          --> Investor ID
       *           $oprtn_date  --> Date of deposit
       *           $oprtn_type  --> Type of deposit
       *           $open_amount --> Amount before the operation
       *           $dpst_amount --> Amount deposited
       *  @return  TRUE or FALSE
       *
       *  @author: Carlos Gonzalez
       */
      public function deposit_operation($id,$oprtn_date,$oprtn_type,$open_amount,$dpst_amount)
      {
        $operation_data = array(
          'investor_tbl_investorID' => $id,
          'operation_date'          => $oprtn_date,
          'month'                   => $this->convert_date_to_month($oprtn_date),
          'operation_type'          => $oprtn_type,
          'open_amount'             => $open_amount,
          'deposit_amount'          => $dpst_amount,
          'total_amount'            => ($open_amount + $dpst_amount)
        );
        if ($this->db->insert('operation_tbl',$operation_data)) {
          return TRUE;
        } else {
          return FAlSE;
        }
      }
      public function convert_date_to_month($date){
        $month = '';
        $array_aux = explode("-",$date);
  			$month_number = $array_aux[1];

  			switch ($month_number) {
  				case '01':
  					$month = 'JAN';
  					break;
  				case '02':
  					$month = 'FEB';
  					break;
  				case '03':
  					$month = 'MAR';
  					break;
  				case '04':
  					$month = 'APR';
  					break;
  				case '05':
  					$month = 'MAY';
  					break;
  				case '06':
  					$month = 'JUN';
  					break;
  				case '07':
  					$month = 'JUL';
  					break;
  				case '08':
  					$month = 'AUG';
  					break;
  				case '09':
  					$month = 'SEP';
  					break;
  				case '10':
  					$month = 'OCT';
  					break;
  				case '11':
  					$month = 'NOV';
  					break;
  				case '12':
  					$month = 'DEC';
  					break;
  			}
        return $month;
      }

      /*
       * Function to cfeate an initial contribution
       *
       *  @param:  $id          --> Investor ID
       *           $dpst_amount --> Amount deposited
       *  @return  TRUE or FALSE
       *
       *  @author: Carlos Gonzalez
       */
      public function add_initial_contribution($id,$dpst_amount)
      {
        $operation_data = array(
          'investor_tbl_investorID' => $id,
          'deposit_date'            => date('Y-m-d H:i:s'),
          'amount'                  => $dpst_amount,
        );
        if ($this->db->insert('initialContribution_tbl',$operation_data)) {
          return TRUE;
        } else {
          return FAlSE;
        }
      }

      public function get_current_amount($id)
			{
        $sum = '';
        $this->db->select_sum('deposit_amount');
        $this->db->from('operation_tbl');
        $this->db->where('investor_tbl_investorID', $id);
        $this->db->where_not_in('operation_type', 'Withdraw');
        $query = $this->db->get();
        $result = $query->result();
        if ($result[0]->deposit_amount == NULL) {
          $sum = '0.00000000';
        }
        else {
          $sum = $result[0]->deposit_amount;
        }
        return round($sum,8);
			}

      public function get_amount_withdraw($id)
			{
        $sum = '';
        $this->db->select_sum('deposit_amount');
        $this->db->from('operation_tbl');
        $this->db->where('investor_tbl_investorID', $id);
        $this->db->where('operation_type', 'Withdraw');
        $query = $this->db->get();
        $result = $query->result();
        if ($result[0]->deposit_amount == NULL) {
          $sum = '0.00000000';
        }
        else {
          $sum = $result[0]->deposit_amount;
        }
        return round($sum,8);
			}

      public function get_current_company_amount()
			{
        $sum = '';
        $this->db->select_sum('deposit_amount');
        $result = $this->db->get('operation_tbl')->row();
        if (empty($result->deposit_amount)) {
          $sum = '0.00000000';
        }
        else {
          $sum = $result->deposit_amount;
        }
        return round($sum,8);
			}

      public function get_amount_withdraw_by_company()
			{
        $sum = '';
        $this->db->select_sum('deposit_amount');
        $this->db->from('operation_tbl');
        $this->db->where('operation_type', 'Withdraw');
        $query = $this->db->get();
        $result = $query->result();
        if ($result[0]->deposit_amount == NULL) {
          $sum = '0.00000000';
        }
        else {
          $sum = $result[0]->deposit_amount;
        }
        return round($sum,8);
			}


      public function fetch_investor_active_financing($id,$start,$length)
      {
        $this->db->select('*');
        $this->db->from('operation_tbl');
        $this->db->where('investor_tbl_investorID',$id);
        //$this->db->limit($length, $start);
        $this->db->order_by('operationID','DESC');
        return $this->db->get();
      }
      /*
        * Function to count all investor active financing in the system
        *
        *  @return  total of iecord
        *
        *  @author: Carlos Gonzalez
        */
        public function getRecordCountActiveFinancingInvestor($id) {
          $query = $this->db->select('count(*) as allcount')->from('operation_tbl')->where('investor_tbl_investorID',$id);
          $getV = $this->db->get();
          $result = $getV->row();
          if (isset($result)) {
            return $result->allcount;
          }
          return 0;
      }

      /*
          * Function load the dashboard data for an investor
          *
          *  @param:  $id --> Investor ID
          *  @return  a investor data for dashboard
          *
          *  @author: Carlos Gonzalez
          */

          public function load_dashboard_investor_data($id)
          {
            $this->db->select('*');
            $this->db->from('operation_tbl');
            $this->db->join('investor_tbl','operation_tbl.investor_tbl_investorID = investor_tbl.investorID');
            $this->db->where('operation_tbl.investor_tbl_investorID', $id);
            $query = $this->db->get();
            return $query->result();
          }

          /*
              * Function load the admin dashboard data
              *
              *  @return  dashboard data for admin
              *
              *  @author: Carlos Gonzalez
              */

              public function load_dashboard_admin_data()
              {
                $this->db->select('*');
                $this->db->from('operation_tbl');
                $this->db->join('investor_tbl','operation_tbl.investor_tbl_investorID = investor_tbl.investorID');
                $query = $this->db->get();
                return $query->result();
              }

             /*
              * Function to get investor's initial contribution
              *
              *  @param:  $id --> Investor ID
              *  @return  a investor data for dashboard
              *
              *  @author: Carlos Gonzalez
              */
              public function investor_initial_contribution($id)
              {
                $this->db->select('*');
                $this->db->from('initialContribution_tbl');
                $this->db->join('investor_tbl','initialContribution_tbl.investor_tbl_investorID = investor_tbl.investorID');
                $this->db->where('initialContribution_tbl.investor_tbl_investorID', $id);
                $query = $this->db->get();
                return $query->result();
              }

  /*
  * Function to get investors' initial contribution
  *
  *
  *  @return  a investor data for dashboard
  *
  *  @author: Carlos Gonzalez
  */
  public function all_initial_contribution($id)
  {
    $this->db->select('*');
    $this->db->from('initialContribution_tbl');
    $this->db->join('investor_tbl','initialContribution_tbl.investor_tbl_investorID = investor_tbl.investorID');
    $query = $this->db->get();
    return $query->result();
  }

  /*
  * Function insert datain profit table
  *
  *  @param:  $week_data_range--> rango de semana del profit
  *           $profit_prcnt --> % de profit
  *  @return  TRUE if the data was inserted, otherwise FALSE
  *
  *  @author: Carlos Gonzalez
  */
  public function add_general_profit($week_data_range,$profit_prcnt,$current_total,$btc_profit)
  {
    $data_profit = array(
      'week_data_range' => $week_data_range,
      'profit_prcnt'    => $profit_prcnt,
      'current_total'   => $current_total,
      'btc_profit'      => $btc_profit
    );
    if ($this->db->insert('weeklyProfit_tbl',$data_profit)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  /*
  * Function insert data in investor profit table
  *
  *  @param:  $weeklyProfitID--> week
  *           $investorID --> investors
  *           $profit_prcnt --> profit %
  *           $profit_btc --> profit btc
  *  @return  TRUE if the data was inserted, otherwise FALSE
  *
  *  @author: Carlos Gonzalez
  */
  public function add_weekly_investor_profit($weeklyProfitID,$investorID,$profit_prcnt,$profit_btc)
  {
    $data_profit = array(
      'weeklyProfitID' => $weeklyProfitID,
      'investorID'    => $investorID,
      'profit_prcnt'   => $profit_prcnt,
      'profit_btc'      => $profit_btc
    );
    if ($this->db->insert('weeklyInvProfit_tbl',$data_profit)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  /*
  * Function to get all company profit
  *
  *
  *  @return  list of company profit
  *
  *  @author: Carlos Gonzalez
  */
  public function all_profit_data_table($start,$length)
  {
    $this->db->select('*');
    $this->db->from('weeklyProfit_tbl');
    $this->db->order_by('weeklyProfitID','DESC');
    return $this->db->get();
  }


  /*
  * Function to get all company profit
  *
  *
  *  @return  list of company profit
  *
  *  @author: Carlos Gonzalez
  */
  public function investor_profit_data_table($id,$start,$length)
  {
    $this->db->select('*');
    $this->db->from('weeklyInvProfit_tbl');
    $this->db->join('weeklyProfit_tbl','weeklyProfit_tbl.weeklyProfitID = weeklyInvProfit_tbl.weeklyProfitID');
    $this->db->where('weeklyInvProfit_tbl.investorID',$id['id']);
    $this->db->order_by('weeklyInvProfit_tbl.weeklyInvProfit','DESC');
    return $this->db->get();
  }

  /*
    * Function to count all profit data for profit table
    *
    *  @return  total of row in the table
    *
    *  @author: Carlos Gonzalez
    */
  public function getRecordCountAllProfitCompany() {
    $query = $this->db->select('count(*) as allcount')->from('weeklyProfit_tbl');
    $getV = $this->db->get();
    $result = $getV->row();
    if (isset($result)) {
      return $result->allcount;
    }
    return 0;
  }

  /*
    * Function to count all profit data for investor profit table
    *
    *  @return  total of row in the table
    *
    *  @author: Carlos Gonzalez
    */
  public function getRecordCountAllProfitInvestor($id) {
    $query = $this->db->select('count(*) as allcount')->from('weeklyInvProfit_tbl')->where('investorID',$id['id']);
    $getV = $this->db->get();
    $result = $getV->row();
    if (isset($result)) {
      return $result->allcount;
    }
    return 0;
  }

  /*
    * Function to get company last week profit
    *
    *  @return  last week data for company
    *
    *  @author: Carlos Gonzalez
    */
  public function last_week_company_profit() {
    $last = $this->db->order_by('weeklyProfitID','DESC')->limit(1)->get('weeklyProfit_tbl')->row();
    return $last;
  }
  /*
    * Function to get company last week investor profit
    *
    *  @return  last week data for investor
    *
    *  @author: Carlos Gonzalez
    */
  public function last_week_investor_profit($id) {
    $last = $this->db->where('investorID',$id)->order_by('weeklyInvProfit','DESC')->limit(1)->get('weeklyInvProfit_tbl')->row();
    return $last;
  }

  /*
   * Function to calculate de total profit of the company
   *
   * @author: Carlos Gonzalez
  */
  public function get_total_company_profit()
  {
    $sum = '';
    $this->db->select_sum('btc_profit');
    $this->db->from('weeklyProfit_tbl');
    $query = $this->db->get();
    $result = $query->result();
    if (empty($result[0]->btc_profit)) {
      $sum = '0.00000000';
    }
    else {
      $sum = round($result[0]->btc_profit,8);
    }

    return $sum;
  }

  /*
   * Function to calculate de total profit of an investor
   *
   * @author: Carlos Gonzalez
  */
  public function get_total_investor_profit($id)
  {
    $sum = '';
    $this->db->select_sum('profit_btc');
    $this->db->from('weeklyInvProfit_tbl');
    $this->db->where('investorID',$id);
    $query = $this->db->get();
    $result = $query->result();
    if (empty($result[0]->profit_btc)) {
      $sum = '0.00000000';
    }
    else {
      $sum = round($result[0]->profit_btc,8);
    }

    return $sum;
  }

  /*
  * Function insert investor data info
  *
  *  @param:  $current_contribution--> rango de semana del profit
  *           $current_prcnt --> % de profit
  *           $current_btc
  *           $id
  *  @return  TRUE if the data was inserted, otherwise FALSE
  *
  *  @author: Carlos Gonzalez
  */
  public function add_investor_data_info($id,$current_contribution,$current_prcnt,$current_btc)
  {
    $data_profit = array(
      'investor_tbl_investorID' => $id,
      'current_contribution'    => $current_contribution,
      'current_prcnt'           => $current_prcnt,
      'current_btc'             => $current_btc
    );
    if ($this->db->insert('investor_data_info_tbl',$data_profit)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  /*
   * Function to crear una orden en hold
   *
   *  @param:  $id          --> Investor ID
   *           $dpst_amount --> Amount deposited
   *  @return  TRUE or FALSE
   *
   *  @author: Carlos Gonzalez
   */
  public function add_contribution_hold($id,$dpst_amount)
  {
    $operation_data = array(
      'investor_tbl_investorID' => $id,
      'hold'                    => $dpst_amount
    );
    if ($this->db->insert('contributionHold_tbl',$operation_data)) {
      return TRUE;
    } else {
      return FAlSE;
    }
  }

  /*
   * Function to crear una orden de withdraw en hold
   *
   *  @param:  $id          --> Investor ID
   *           $dpst_amount --> Amount deposited
   *  @return  TRUE or FALSE
   *
   *  @author: Carlos Gonzalez
   */
  public function add_withdraw_hold($id,$w_amount)
  {
    $operation_data = array(
      'investorID' => $id,
      'hold'                    => $w_amount
    );
    if ($this->db->insert('withdraw_hold_tbl',$operation_data)) {
      return TRUE;
    } else {
      return FAlSE;
    }
  }
  /*
  * Function to fetch a hold contribution
  *
  *
  *  @return  list of company profit
  *
  *  @author: Carlos Gonzalez
  */
  public function fetch_a_hold_contribution($id)
  {
    $this->db->select('*');
    $this->db->from('contributionHold_tbl');
    $this->db->where('investor_tbl_investorID',$id);
    $query = $this->db->get();
    return $query->result();
  }
  /*
  * Function to fetch a withdraw hold contribution
  *
  *
  *  @return  list of company profit
  *
  *  @author: Carlos Gonzalez
  */
  public function fetch_a_withdraw_hold_contribution($id)
  {
    $this->db->select('*');
    $this->db->from('withdraw_hold_tbl');
    $this->db->where('investorID',$id);
    $query = $this->db->get();
    return $query->result();
  }

  /*
* Function edit a hold contribution
*  @paramet $id
*           $hold
*  @return TRUE if the record was updated correctly
*          FALSE if the record was not updated
*
* @author: Carlos Gonzalez
*/
public function hold_edit($id,$hold)
{
  $data = array('hold'=> $hold);
  $this->db->where('investor_tbl_investorID',$id);
  $this->db->update('contributionHold_tbl',$data);

  if ($this->db->affected_rows() > 0) {
      return TRUE;
    }else {
    return FALSE;
  }
}

/*
* Function edit a withdraw hold contribution
*  @paramet $id
*           $hold
*  @return TRUE if the record was updated correctly
*          FALSE if the record was not updated
*
* @author: Carlos Gonzalez
*/
public function withdraw_hold_edit($id,$hold)
{
$data = array('hold'=> $hold);
$this->db->where('investorID',$id);
$this->db->update('withdraw_hold_tbl',$data);

if ($this->db->affected_rows() > 0) {
    return TRUE;
  }else {
  return FALSE;
}
}

/*
* Function delete an hold operation
*  @paramet $id
*  @return TRUE if the record was deleted correctly
*          FALSE if the record was not deleted
*
* @author: Carlos Gonzalez
*/
public function hold_processed($id)
{
  $this->db->where('investor_tbl_investorID',$id);
  $this->db->delete('contributionHold_tbl');

  if ($this->db->affected_rows() > 0) { // Si borro los datos de privilegio
    return TRUE;
  } else {
    return FALSE; // Si no borro los datos de privilegio retorno falso
  }
}

/*
* Function delete a withdraw hold operation
*  @paramet $id
*  @return TRUE if the record was deleted correctly
*          FALSE if the record was not deleted
*
* @author: Carlos Gonzalez
*/
public function withdraw_hold_processed($id)
{
  $this->db->where('investorID',$id);
  $this->db->delete('withdraw_hold_tbl');

  if ($this->db->affected_rows() > 0) { // Si borro los datos de privilegio
    return TRUE;
  } else {
    return FALSE; // Si no borro los datos de privilegio retorno falso
  }
}

/*
* Function to get all withdraw hold information
*
*
*  @return  list of withdraw hold contributions
*
*  @author: Carlos Gonzalez
*/
public function all_hold_withdraw_table($start,$length)
{
  $this->db->select('*');
  $this->db->from('withdraw_hold_tbl');
  $this->db->join('investor_tbl','withdraw_hold_tbl.investorID = investor_tbl.investorID');
  $this->db->order_by('withdrawHoldID','ASC');
  return $this->db->get();
}
/*
* Function to get all hold information
*
*
*  @return  list of hold contributions
*
*  @author: Carlos Gonzalez
*/
public function all_hold_contribution_table($start,$length)
{
  $this->db->select('*');
  $this->db->from('contributionHold_tbl');
  $this->db->join('investor_tbl','contributionHold_tbl.investor_tbl_investorID = investor_tbl.investorID');
  $this->db->order_by('contributionHoldID','ASC');
  return $this->db->get();
}
/*
  * Function to count all hold contributions
  *
  *  @return  total of row in the table
  *
  *  @author: Carlos Gonzalez
  */
public function getRecordCountAllHoldContributions() {
  $query = $this->db->select('count(*) as allcount')->from('contributionHold_tbl');
  $getV = $this->db->get();
  $result = $getV->row();
  if (isset($result)) {
    return $result->allcount;
  }
  return 0;
}
/*
  * Function to count all withdraw hold contributions
  *
  *  @return  total of row in the table
  *
  *  @author: Carlos Gonzalez
  */
public function getRecordCountAllWithdrawHoldContributions() {
  $query = $this->db->select('count(*) as allcount')->from('withdraw_hold_tbl');
  $getV = $this->db->get();
  $result = $getV->row();
  if (isset($result)) {
    return $result->allcount;
  }
  return 0;
}

/*
* Function to get all withdraws
*
*
*  @return  list of withdraw
*
*  @author: Carlos Gonzalez
*/
public function all_withdraw_table($start,$length)
{
  $this->db->select('*');
  $this->db->from('withdraw_tbl');
  $this->db->join('investor_tbl','withdraw_tbl.investorID = investor_tbl.investorID');
  $this->db->order_by('withdrawID','ASC');
  return $this->db->get();
}

/*
  * Function to count all withdraw
  *
  *  @return  total of row in the table
  *
  *  @author: Carlos Gonzalez
  */
public function getRecordCountAllWithdraw() {
  $query = $this->db->select('count(*) as allcount')->from('withdraw_tbl');
  $getV = $this->db->get();
  $result = $getV->row();
  if (isset($result)) {
    return $result->allcount;
  }
  return 0;
}

/*
 * Function to agregar withdraw data
 *
 *  @param:  $id          --> Investor ID
 *           $dpst_amount --> Amount deposited
 *  @return  TRUE or FALSE
 *
 *  @author: Carlos Gonzalez
 */
public function add_withdraw_data($id,$amount_w)
{
  $operation_data = array(
    'investorID' => $id,
    'date_oprtn' => date('Y-m-d H:i:s'),
    'amount_w'   => $amount_w
  );
  if ($this->db->insert('withdraw_tbl',$operation_data)) {
    return TRUE;
  } else {
    return FAlSE;
  }
}

/*
 * Function buscar un investor en la vista
 *
 *  @param:  $id          --> Investor ID
 *           $w_amount --> Amount withdraw
 *  @return  TRUE or FALSE
 *
 *  @author: Carlos Gonzalez
 */
 public function fetch_investors_view_data($query)
 {
   $this->db->select("*");
  $this->db->from("investor_tbl");
  if($query != '')
  {
   $this->db->like('first_name', $query);
   $this->db->or_like('last_name', $query);
   $this->db->or_like('dob', $query);
   $this->db->or_like('created_date', $query);
   $this->db->or_like('status', $query);
   $this->db->or_like('email', $query);
   $this->db->or_like('username', $query);
  }
  $this->db->order_by('investorID', 'DESC');
  return $this->db->get();
 }

 /*
  * Function to fetch BTC price
  *
  * @author: Carlos Gonzalez
  */
 public function getPrice($url)
 {
   $decode = file_get_contents($url);
   return json_decode($decode, true);
 }

 /*
  * Function para obtener las ganancias semanales y mostrarlas en la grafica
  *
  * @author: Carlos Gonzalez
  */
 public function get_weekly_profit_chart_data()
 {
   $this->db->select("weeklyProfitID,week_data_range,profit_prcnt,btc_profit");
   $this->db->from("weeklyProfit_tbl");
   $this->db->order_by("weeklyProfitID",'DESC');
   $this->db->limit(8);
   $query = $this->db->get();
   return $query->result();
 }

 /*
  * Function para obtener las ganancias semanales de un inversionista
  * y mostrarlas en la grafica
  *
  * @author: Carlos Gonzalez
  */
 public function get_investor_weekly_profit_chart_data($id)
 {
   $this->db->select("weeklyProfit_tbl.weeklyProfitID,weeklyProfit_tbl.week_data_range,ROUND(weeklyInvProfit_tbl.profit_btc,8) as profit_btc");
   $this->db->from("weeklyInvProfit_tbl");
   $this->db->join('weeklyProfit_tbl','weeklyProfit_tbl.weeklyProfitID = weeklyInvProfit_tbl.weeklyProfitID ');
   $this->db->where("weeklyInvProfit_tbl.investorID",$id);
   $this->db->order_by("weeklyProfit_tbl.weeklyProfitID",'DESC');
   $this->db->limit(8);
   
   $query = $this->db->get();
   return $query->result();
 }

 /*
  * Function para obtener ingresos mensuales
  *
  * @author: Carlos Gonzalez
  */
 public function get_monthly_income_chart_data()
 {

   $this->db->select("month, ROUND(SUM(operation_tbl.deposit_amount),8) as deposit_amount");
   $this->db->from("operation_tbl");
   $this->db->where_not_in('operation_type', 'Withdraw');
   $this->db->group_by("month");
   $this->db->order_by("FIELD(month,'JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC')");
   $query = $this->db->get();
   return $query->result();
 }

 /*
  * Function para obtener actividades mensuales de un inversionista
  *
  * @author: Carlos Gonzalez
  */
 public function get_investor_monthly_activity_chart_data($id)
 {

   $this->db->select("month, ROUND(SUM(operation_tbl.deposit_amount),8) as deposit_amount, operation_type");
   $this->db->from("operation_tbl");
   $this->db->where('investor_tbl_investorID', $id);
   $this->db->group_by("month");
   $this->db->group_by("operation_type");
   $this->db->order_by("FIELD(month,'JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC')");
   $query = $this->db->get();
   return $query->result();
 }
}
?>
