<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['title'] = 'InveztGlez | Login';
		$this->load->view('login/sign_in.php',$data);
	}

	public function new_registration()
	{
		$data['title'] = 'InvestGlez | User Registration';
		$this->load->view('login/sign_up.php',$data);
	}

	public function success_registration()
	{
		$data['title'] = 'Success';
		$this->load->view('login/success_registration.php',$data);
	}
	public function failed_registration()
	{
		$data['title'] = 'Failed! ';
		$data['msg'] = $this->session->flashdata('item');
		$this->load->view('login/failed_registration.php',$data);
	}

	public function dashboard()
	{
		$session = $this->session->userdata('session');
		$data['username'] = $session['usrnm'];

		if ($session != NULL) {
			$data['title'] = 'InvestGlez | System Dashboard';
			$data['page_title'] = '<i class="fa fa-dashboard"></i> Dashboard';
			$data['full_name'] = $session['name'];
			$data['systm_accss'] = $session['systm_accss'];
			$data['artcl_accss'] = $session['artcl_accss'];
			$data['prsnl_accss'] = $session['prsnl_accss'];
			$data['ttl_accss'] = $session['ttl_accss'];
			$this->load->view('template/templateScriptHeader.php',$data);
			$this->load->view('template/menuProfileQuickInfo.php',$data);
			$this->load->view('template/sidebarMenu.php',$data);
			$this->load->view('template/menuFooterButtons.php',$data);
			$this->load->view('template/topNavigation.php',$data);
			$this->load->view('template/pageContent.php',$data);
			$this->load->view('template/footerContent.php',$data);
			$this->load->view('template/templateScriptFooter.php',$data);
		} else {
			redirect(base_url());
		}
	}

/***** MODULE INVESTOR *******/
public function invstr_module_add()
{
	$session = $this->session->userdata('session');
	$data['username'] = $session['usrnm'];

	if ($session != NULL) {
		$data['title'] = 'InvestGlez | Investor Module';
		$data['page_title'] = '<i class="fa fa-users"></i> Investor Module';
		$data['full_name'] = $session['name'];
		$data['systm_accss'] = $session['systm_accss'];
		$data['artcl_accss'] = $session['artcl_accss'];
		$data['prsnl_accss'] = $session['prsnl_accss'];
		$data['ttl_accss'] = $session['ttl_accss'];
		$this->load->view('template/templateScriptHeader.php',$data);
		$this->load->view('template/menuProfileQuickInfo.php',$data);
		$this->load->view('template/sidebarMenu.php',$data);
		$this->load->view('template/menuFooterButtons.php',$data);
		$this->load->view('template/topNavigation.php',$data);
		$this->load->view('module/investor_module/invstr_add_view.php',$data);
		$this->load->view('template/footerContent.php',$data);
		$this->load->view('template/templateScriptFooter.php',$data);
	} else {
		redirect(base_url());
	}
}

public function fetch_investor_profile()
{
	$session = $this->session->userdata('session');
	$data['username'] = $session['usrnm'];

	$id = $this->input->post('id_data');

	$data_investor = $this->mdl_investor->fetch_a_single_investor($id);

	foreach ($data_investor as $key) {

		$data['title'] 			= 'InvestGlez | Investor Profile';
		$data['first_last_name'] 		= $key->first_name.' '.$key->last_name;
		$data['id'] 								= $id;
		$data['id_privilege'] 			= $key->privilegeID;
	}
	if ($session != NULL) {
		$data['page_title'] = '<i class="fa fa-user"></i> Investor Profile';
		$data['full_name'] = $session['name'];
		$data['systm_accss'] = $session['systm_accss'];
		$data['artcl_accss'] = $session['artcl_accss'];
		$data['prsnl_accss'] = $session['prsnl_accss'];
		$data['ttl_accss'] = $session['ttl_accss'];
		$this->load->view('template/templateScriptHeader.php',$data);
		$this->load->view('template/menuProfileQuickInfo.php',$data);
		$this->load->view('template/sidebarMenu.php',$data);
		$this->load->view('template/menuFooterButtons.php',$data);
		$this->load->view('template/topNavigation.php',$data);
		$this->load->view('module/investor_module/fetch_investor_prof.php',$data);
		$this->load->view('template/footerContent.php',$data);
		$this->load->view('template/templateScriptFooter.php',$data);
	}else{
		redirect(base_url());
	}
}

function hold_contribution_list()
{
	$session = $this->session->userdata('session');
	$data['username'] = $session['usrnm'];

	if ($session != NULL) {
		$data['title'] 			= 'InvestGlez | Hold Contributions';
		$data['page_title'] = '<i class="fa fa-refresh"></i> Hold Contributions';
		$data['full_name'] = $session['name'];
		$data['systm_accss'] = $session['systm_accss'];
		$data['artcl_accss'] = $session['artcl_accss'];
		$data['prsnl_accss'] = $session['prsnl_accss'];
		$data['ttl_accss'] = $session['ttl_accss'];
		$this->load->view('template/templateScriptHeader.php',$data);
		$this->load->view('template/menuProfileQuickInfo.php',$data);
		$this->load->view('template/sidebarMenu.php',$data);
		$this->load->view('template/menuFooterButtons.php',$data);
		$this->load->view('template/topNavigation.php',$data);
		$this->load->view('module/investor_module/list_hold_contributions.php',$data);
		$this->load->view('template/footerContent.php',$data);
		$this->load->view('template/templateScriptFooter.php',$data);
	}else{
		redirect(base_url());
	}
}
function hold_withdraw_list()
{
	$session = $this->session->userdata('session');
	$data['username'] = $session['usrnm'];

	if ($session != NULL) {
		$data['title'] 			= 'InvestGlez | Withdraws Hold';
		$data['page_title'] = '<i class="fa fa-exchange"></i> Withdraws requested';
		$data['full_name'] = $session['name'];
		$data['systm_accss'] = $session['systm_accss'];
		$data['artcl_accss'] = $session['artcl_accss'];
		$data['prsnl_accss'] = $session['prsnl_accss'];
		$data['ttl_accss'] = $session['ttl_accss'];
		$this->load->view('template/templateScriptHeader.php',$data);
		$this->load->view('template/menuProfileQuickInfo.php',$data);
		$this->load->view('template/sidebarMenu.php',$data);
		$this->load->view('template/menuFooterButtons.php',$data);
		$this->load->view('template/topNavigation.php',$data);
		$this->load->view('module/investor_module/list_hold_withdraw.php',$data);
		$this->load->view('template/footerContent.php',$data);
		$this->load->view('template/templateScriptFooter.php',$data);
	}else{
		redirect(base_url());
	}
}

function withdraw_list()
{
	$session = $this->session->userdata('session');
	$data['username'] = $session['usrnm'];

	if ($session != NULL) {
		$data['title'] 			= 'InvestGlez | Withdraws List';
		$data['page_title'] = '<i class="fa fa-download"></i> Withdraws';
		$data['full_name'] = $session['name'];
		$data['systm_accss'] = $session['systm_accss'];
		$data['artcl_accss'] = $session['artcl_accss'];
		$data['prsnl_accss'] = $session['prsnl_accss'];
		$data['ttl_accss'] = $session['ttl_accss'];
		$this->load->view('template/templateScriptHeader.php',$data);
		$this->load->view('template/menuProfileQuickInfo.php',$data);
		$this->load->view('template/sidebarMenu.php',$data);
		$this->load->view('template/menuFooterButtons.php',$data);
		$this->load->view('template/topNavigation.php',$data);
		$this->load->view('module/investor_module/withdraw_list.php',$data);
		$this->load->view('template/footerContent.php',$data);
		$this->load->view('template/templateScriptFooter.php',$data);
	}else{
		redirect(base_url());
	}
}

function investors_list()
{
	$session = $this->session->userdata('session');
	$data['username'] = $session['usrnm'];

	if ($session != NULL) {
		$data['title'] 			= 'InvestGlez | Investor List';
		$data['page_title'] = '<i class="fa fa-users"></i> Investors';
		$data['full_name'] = $session['name'];
		$data['systm_accss'] = $session['systm_accss'];
		$data['artcl_accss'] = $session['artcl_accss'];
		$data['prsnl_accss'] = $session['prsnl_accss'];
		$data['ttl_accss'] = $session['ttl_accss'];
		$this->load->view('template/templateScriptHeader.php',$data);
		$this->load->view('template/menuProfileQuickInfo.php',$data);
		$this->load->view('template/sidebarMenu.php',$data);
		$this->load->view('template/menuFooterButtons.php',$data);
		$this->load->view('template/topNavigation.php',$data);
		$this->load->view('module/investor_module/investors_list.php',$data);
		$this->load->view('template/footerContent.php',$data);
		$this->load->view('template/templateScriptFooter.php',$data);
	}else{
		redirect(base_url());
	}
}

function search_investor()
{
	$session = $this->session->userdata('session');
	$data['username'] = $session['usrnm'];

	if ($session != NULL) {
		$data['title'] 			= 'InvestGlez | Search Investor';
		$data['page_title'] = '<i class="fa fa-search"></i> Search Investor';
		$data['full_name'] = $session['name'];
		$data['systm_accss'] = $session['systm_accss'];
		$data['artcl_accss'] = $session['artcl_accss'];
		$data['prsnl_accss'] = $session['prsnl_accss'];
		$data['ttl_accss'] = $session['ttl_accss'];
		$this->load->view('template/templateScriptHeader.php',$data);
		$this->load->view('template/menuProfileQuickInfo.php',$data);
		$this->load->view('template/sidebarMenu.php',$data);
		$this->load->view('template/menuFooterButtons.php',$data);
		$this->load->view('template/topNavigation.php',$data);
		$this->load->view('module/investor_module/search_investor.php',$data);
		$this->load->view('template/footerContent.php',$data);
		$this->load->view('template/templateScriptFooter.php',$data);
	}else{
		redirect(base_url());
	}
}


function calculaedad($fechanacimiento){
	list($fecha,$hora) = explode(" ",$fechanacimiento);
  list($ano,$mes,$dia) = explode("-",$fecha);
  $ano_diferencia  = date("Y") - $ano;
  $mes_diferencia = date("m") - $mes;
  $dia_diferencia   = date("d") - $dia;
  if ($dia_diferencia < 0 || $mes_diferencia < 0)
    $ano_diferencia--;
  return $ano_diferencia;
}

	function delete_user_profile()
	{
		$session = $this->session->userdata('session');
		$data['username'] = $session['usrnm'];


		$id = $this->input->post('id');
		$privilegesID = $this->input->post('id_privilege');
		$first_last_name = $this->input->post('first_last_name');

		if ($this->mdl_investor->delete_investor($id,$privilegesID) === TRUE) {
			$activity = '<code>'.$data['username'].'</code> eliminated investor <code>'.$first_last_name.'</code> records';
			$module = 'InvestGlez - Investor Module';
			redirect(base_url('index.php/welcome/invstr_module_add'));
		}else
		{
			echo "error";
			//redirect(base_url('index.php/welcome/invstr_module_add'));
		}
	}

	/***** MODULE Profit *******/
	function module_profit()
	{
		$session = $this->session->userdata('session');
		$data['username'] = $session['usrnm'];

		if ($session != NULL) {
			$data['title'] 			= 'InvestGlez | Profit';
			$data['page_title'] = '<i class="fa fa-calculator"></i> Profit';
			$data['full_name'] = $session['name'];
			$data['systm_accss'] = $session['systm_accss'];
			$data['artcl_accss'] = $session['artcl_accss'];
			$data['prsnl_accss'] = $session['prsnl_accss'];
			$data['ttl_accss'] = $session['ttl_accss'];
			$this->load->view('template/templateScriptHeader.php',$data);
			$this->load->view('template/menuProfileQuickInfo.php',$data);
			$this->load->view('template/sidebarMenu.php',$data);
			$this->load->view('template/menuFooterButtons.php',$data);
			$this->load->view('template/topNavigation.php',$data);
			$this->load->view('module/profit_module/profit.php',$data);
			$this->load->view('template/footerContent.php',$data);
			$this->load->view('template/templateScriptFooter.php',$data);
		}else{
			redirect(base_url());
		}
	}

	/***** MODULE PERFIL *******/
	function perfil_dashboard()
	{
		$session = $this->session->userdata('session');
		$data['username'] = $session['usrnm'];

		if ($session != NULL) {
			$data['title'] 			= 'InvestGlez | '.$session['name'];
			$data['page_title'] = '<i class="fa fa-desktop"></i> Welcome back '.$session['name'].'<hr>';
			$data['full_name'] = $session['name'];
			$data['systm_accss'] = $session['systm_accss'];
			$data['artcl_accss'] = $session['artcl_accss'];
			$data['prsnl_accss'] = $session['prsnl_accss'];
			$data['ttl_accss'] = $session['ttl_accss'];
			$data['id'] = $session['id'];
			$data['privileges'] = $session['privileges'];
			$this->load->view('template/templateScriptHeader.php',$data);
			$this->load->view('template/menuProfileQuickInfo.php',$data);
			$this->load->view('template/sidebarMenu.php',$data);
			$this->load->view('template/menuFooterButtons.php',$data);
			$this->load->view('template/topNavigation.php',$data);
			$this->load->view('module/perfil_module/perfil_dashboard.php',$data);
			$this->load->view('template/footerContent.php',$data);
			$this->load->view('template/templateScriptFooter.php',$data);
		}else{
			redirect(base_url());
		}
	}

	function my_finance()
	{
		$session = $this->session->userdata('session');
		$data['username'] = $session['usrnm'];

		if ($session != NULL) {
			$data['title'] 			= 'InvestGlez | '.$session['name'];
			$data['page_title'] = 'My Finances';
			$data['full_name'] = $session['name'];
			$data['systm_accss'] = $session['systm_accss'];
			$data['artcl_accss'] = $session['artcl_accss'];
			$data['prsnl_accss'] = $session['prsnl_accss'];
			$data['ttl_accss'] = $session['ttl_accss'];
			$data['id'] = $session['id'];
			$data['privileges'] = $session['privileges'];
			$this->load->view('template/templateScriptHeader.php',$data);
			$this->load->view('template/menuProfileQuickInfo.php',$data);
			$this->load->view('template/sidebarMenu.php',$data);
			$this->load->view('template/menuFooterButtons.php',$data);
			$this->load->view('template/topNavigation.php',$data);
			$this->load->view('module/perfil_module/my_finance.php',$data);
			$this->load->view('template/footerContent.php',$data);
			$this->load->view('template/templateScriptFooter.php',$data);
		}else{
			redirect(base_url());
		}
	}

	function calculator_tool()
	{
		$session = $this->session->userdata('session');
		$data['username'] = $session['usrnm'];

		if ($session != NULL) {
			$data['title'] 			= 'InvestGlez | '.$session['name'];
			$data['page_title'] = 'Calculator';
			$data['full_name'] = $session['name'];
			$data['systm_accss'] = $session['systm_accss'];
			$data['artcl_accss'] = $session['artcl_accss'];
			$data['prsnl_accss'] = $session['prsnl_accss'];
			$data['ttl_accss'] = $session['ttl_accss'];
			$data['id'] = $session['id'];
			$data['privileges'] = $session['privileges'];
			$this->load->view('template/templateScriptHeader.php',$data);
			$this->load->view('template/menuProfileQuickInfo.php',$data);
			$this->load->view('template/sidebarMenu.php',$data);
			$this->load->view('template/menuFooterButtons.php',$data);
			$this->load->view('template/topNavigation.php',$data);
			$this->load->view('module/perfil_module/calculator_tool.php',$data);
			$this->load->view('template/footerContent.php',$data);
			$this->load->view('template/templateScriptFooter.php',$data);
		}else{
			redirect(base_url());
		}
	}

	function perfil()
	{
		$session = $this->session->userdata('session');
		$data['username'] = $session['usrnm'];

		if ($session != NULL) {
			$data['title'] 			= 'InvestGlez | '.$session['name'];
			$data['page_title'] = 'Perfil Information';
			$data['full_name'] = $session['name'];
			$data['systm_accss'] = $session['systm_accss'];
			$data['artcl_accss'] = $session['artcl_accss'];
			$data['prsnl_accss'] = $session['prsnl_accss'];
			$data['ttl_accss'] = $session['ttl_accss'];
			$data['id'] = $session['id'];
			$data['privileges'] = $session['privileges'];
			$this->load->view('template/templateScriptHeader.php',$data);
			$this->load->view('template/menuProfileQuickInfo.php',$data);
			$this->load->view('template/sidebarMenu.php',$data);
			$this->load->view('template/menuFooterButtons.php',$data);
			$this->load->view('template/topNavigation.php',$data);
			$this->load->view('module/perfil_module/perfil.php',$data);
			$this->load->view('template/footerContent.php',$data);
			$this->load->view('template/templateScriptFooter.php',$data);
		}else{
			redirect(base_url());
		}
	}

}
