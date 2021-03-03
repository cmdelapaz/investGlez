subscriber_email<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ctrl_investor extends CI_Controller {

	function __construct()
  {
    parent::__construct();
  }

  public function fetch_quick_list_investors()
	{
		$draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

		$investors_data = $this->mdl_investor->fetch_investor($start,$length);
		$total_investor = $this->mdl_investor->getRecordCount();

		$data = array();

		foreach ($investors_data->result() as $key) {
			$data[] = array(
				"id_data"=> $key->investorID,
                    $key->first_name,
                    $key->last_name,
                    $key->email,
                    $key->username,
										'<button class="btn btn-outline-info btn-xs details" data-toggle="tooltip" data-placement="top" title="Details" id="'.$key->investorID.'" privilege-id="'.$key->privilegeID.'"><i class="fa fa-info"></i></button>'.
										'<button class="btn btn-outline-info btn-xs edit" data-toggle="tooltip" data-placement="top" title="Edit" id="'.$key->investorID.'" privilege-id="'.$key->privilegeID.'"><i class="fa fa-edit"></i></button>'.
										'<button class="btn btn-outline-danger btn-xs delete" data-toggle="tooltip" data-placement="top" title="Delete" id="'.$key->investorID.'" privilege-id="'.$key->privilegeID.'" data-toggle="modal" data-target=".delete_modal"><i class="fa fa-trash"></i></button>'
               );
		}
		$output = array(
               "draw" 						=> $draw,
               "recordsTotal" 		=> $total_investor,
               "recordsFiltered" 	=> $total_investor,
               "data" 						=> $data
            );
    echo json_encode($output);
	}

  public function insert_investor()
  {
      $first_name = $this->input->post('first_name');
      $last_name  = $this->input->post('last_name');
      $dob        = $this->input->post('dob');
      $email      = $this->input->post('email');
      $username   = $this->input->post('username');
      $pswd       = $this->input->post('pswd');
      $r_pswd     = $this->input->post('r_pswd');
      $status     = $this->input->post('status');
      $system_access    = $this->input->post('systemAccess');
      $articles_access  = $this->input->post('articlesAccess');
      $personal_access  = $this->input->post('personalAccess');
      $total_access     = $this->input->post('totalAccess');
      $invtID = '';
      $array='';

      $this->form_validation->set_rules('first_name','First Name','required|alpha');
      $this->form_validation->set_rules('last_name','Last Name','required|alpha');
      $this->form_validation->set_rules('dob','Date of Birth (DOB)','required');
      $this->form_validation->set_rules('email','Email','required|valid_email|is_unique[investor_tbl.email]',array('is_unique'=>'This %s already exist.'));
      $this->form_validation->set_rules('username','Username','required|is_unique[investor_tbl.username]',array('is_unique'=>'This %s already exist.'));
      $this->form_validation->set_rules('pswd','Password','required|min_length[3]');
      $this->form_validation->set_rules('r_pswd','Confirm Password','required|min_length[3]|matches[pswd]');

      if ($this->form_validation->run() === TRUE) {
        if ($status == NULL) { // Compruebo si los datos los esta insertando el admin o el nuevo usuario
          //Si el usuario se esta registrando desde el inicio
          if ($this->mdl_investor->insert_investor($first_name,$last_name,$dob,$email,$username,$pswd,$r_pswd) === TRUE) {
            $activity = 'new user <code>'.$username.'</code> was created';
            $module = 'System - Sign up';
            $id_user = $this->mdl_investor->last_investor_id();

            if ($this->mdl_traceActivity->insert_trace($activity,$module,$id_user[0]->investorID) === TRUE) {
              redirect('welcome/success_registration'); // Trace activity inserted
            } else {
              $myVar = '<p class="text-danger">Sorry some Trace activity could not be inserted</p>';
              $this->session->set_flashdata('item', $myVar);
  	          redirect('welcome/failed_registration/'); // Trace activity not inserted
            }
          } else {
            $myVar = '<p class="text-danger">Sorry the new information was not inserted</p>';
            $this->session->set_flashdata('item', $myVar);
            redirect('welcome/failed_registration/'); // New Investor not inserted
          }
        } else {
          // Si el usuario esta siendo registrado por el admin
          if ($this->mdl_investor->insert_investor($first_name,$last_name,$dob,$email,$username,$pswd,$r_pswd,
          $status,$system_access,$articles_access,$personal_access,$total_access) === TRUE) {
            $activity = 'new user <code>'.$username.'</code> was created';
            $module = 'System - Sign up';
            $id_user = $this->mdl_investor->last_investor_id();

            if ($this->mdl_traceActivity->insert_trace($activity,$module,$id_user[0]->investorID) === TRUE) {
              $array = array(// Trace activity inserted
		            'msg' => '1');
            } else {
              $myVar = '<p class="text-danger">Sorry some Trace activity could not be inserted</p>';
              $this->session->set_flashdata('item', $myVar);
  	          redirect('welcome/failed_registration/'); // Trace activity not inserted
            }
          } else
            $array = array(
                'msg' => '0',
                'error' => true);// New Investor not inserted
          }
        }
        else {
          $array = array(
  	          'msg' => '-1',
  						'error' => validation_errors()); // Validation Error
        }echo json_encode($array);
      }

      /*
		  * Function to delete a investor with ajax
		  *
		  *  @return msg "success" if the record was saved right
		  *          msg "error" if the record was not saved right
		  *
		  * @author: Carlos Gonzalez
		  */
		function delete_investor()
    {
        //$session = $this->session->userdata('session');
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $privilegesID = $this->input->post('privilegesID');
            //$user = $this->mdl_users->getUserData($id_elim);
            if ($this->mdl_investor->delete_investor($id,$privilegesID) === TRUE) {
                //$activity = 'user <code>'.$user[0]->email.'</code> was deleted';
                //$module = 'General - User & Privileges';
                //$id_user = $session['id'];
                //$this->mdl_traceActivity->insert_trace($activity,$module,$id_user[0]->investorID);
								$array = array(
			            'msg' => '1',
									'error' => false); // user deleted
            }else{
							$array = array(
								'msg' => '-1',
								'error' => true); // error deleting the user
            }
        }else{
            show_404();
        }
				echo json_encode($array);
    }

    /*
		  * Function to quick edit a investor with ajax
		  *
		  *  @return msg "success" if the record was saved right
		  *          msg "error" if the record was not saved right
		  *
		  * @author: Carlos Gonzalez
		  */
		  public function quick_investor_edit()
		  {
		    if ($this->input->is_ajax_request())
		    {
					$this->form_validation->set_error_delimiters('<h6><i class="fa fa-close"></i> ', '</h6>');

          $this->form_validation->set_rules('edit_first_name','First Name','required|alpha');
          $this->form_validation->set_rules('edit_last_name','Last Name','required|alpha');
          $this->form_validation->set_rules('edit_email','Email','required|valid_email');
          $this->form_validation->set_rules('edit_username','Username','required');

		      if ($this->form_validation->run())
		      {
		        $first_name  = $this->input->post('edit_first_name');
            $last_name  = $this->input->post('edit_last_name');
		        $email   		= $this->input->post('edit_email');
		        $username  	= $this->input->post('edit_username');
						$status 		= $this->input->post('edit_status');
						$id 				= $this->input->post('id');

						if ($this->mdl_investor->quick_investor_edit($id,$first_name,$last_name,$email,$username,$status) === TRUE) {
			          $array = array(
			            'msg' => '1'); // Se inserto la informacion correctamente
			        }else{
			          $array = array(
			            'msg' => '0',
								  'error' => true); // No se inserto correctamente la informacion
			        }
						}
						else
			      {
			        $array = array(
			          'msg' => '-1',
								'error' => validation_errors()); // Error en el formulario
			      }
		      }
		    else{
		      show_404();
		    }
		    echo json_encode($array);
		  }

			/*
			  * Function to edit full a investor with ajax
			  *
			  *  @return msg "success" if the record was saved right
			  *          msg "error" if the record was not saved right
			  *
			  * @author: Carlos Gonzalez
			  */
			  public function full_investor_edit()
			  {
			    if ($this->input->is_ajax_request())
			    {
						$this->form_validation->set_error_delimiters('<h6><i class="fa fa-close"></i> ', '</h6>');

	          $this->form_validation->set_rules('edit_first_name','First Name','required|alpha');
	          $this->form_validation->set_rules('edit_last_name','Last Name','required|alpha');
						$this->form_validation->set_rules('edit_dob','Date of Birth (DOB)','required');
	          $this->form_validation->set_rules('edit_email','Email','required|valid_email');

			      if ($this->form_validation->run())
			      {
			        $first_name  		= $this->input->post('edit_first_name');
	            $last_name  		= $this->input->post('edit_last_name');
			        $email   				= $this->input->post('edit_email');
			        $dob  					= $this->input->post('edit_dob');
							$status 				= $this->input->post('edit_status');
							$ttl_accss 			= $this->input->post('ttl_accss');
							$artcl_accss 		= $this->input->post('artcl_accss');
							$systm_accss 		= $this->input->post('systm_accss');
							$prsnl_accss 		= $this->input->post('prsnl_accss');
							$id 						= $this->input->post('id');

							if ($this->mdl_investor->full_investor_edit($id,$first_name,$last_name,$dob,$email,$status,$ttl_accss,$artcl_accss,$systm_accss,$prsnl_accss) === TRUE) {
				          $array = array(
				            'msg' => '1'); // Se inserto la informacion correctamente
				        }else{
				          $array = array(
				            'msg' => '0',
									  'error' => true); // No se inserto correctamente la informacion
				        }
							}
							else
				      {
				        $array = array(
				          'msg' => '-1',
									'error' => validation_errors()); // Error en el formulario
				      }
			      }
			    else{
			      show_404();
			    }
			    echo json_encode($array);
			  }

				/*
					* Function to edit investor profile with ajax (password)
					*
					*  @return msg "success" if the record was saved right
					*          msg "error" if the record was not saved right
					*
					* @author: Carlos Gonzalez
					*/
					public function edit_investor_access_profile()
					{
						if ($this->input->is_ajax_request())
						{
							$this->form_validation->set_error_delimiters('<h6><i class="fa fa-close"></i> ', '</h6>');

							$this->form_validation->set_rules('current_passwd','Current Password','required');
							$this->form_validation->set_rules('new_passwd','New Password','required');
							$this->form_validation->set_rules('re_passwd','Confirm Password','required|matches[new_passwd]');

							if ($this->form_validation->run())
							{
								$current_passwd  	= $this->input->post('current_passwd');
								$new_passwd  			= $this->input->post('new_passwd');
								$re_passwd   			= $this->input->post('re_passwd');
								$id   						= $this->input->post('id');

								$investor = $this->mdl_investor->fetch_a_single_investor($id);

								foreach ($investor as $key) {
									if(strcmp(sha1($current_passwd),$key->pswd) == '0')
									{
										if ($this->mdl_investor->edit_investor_access_profile($id,sha1($new_passwd)) === TRUE) {
											$array = array(
												'msg' => '1'); // Se actualizo la informacion correctamente
										}else{
											$array = array(
												'msg' => '0',
												'error' => true); // No se actualizo correctamente la informacion
										}
									}else{
										$array = array(
											'msg' => '2',
											'error' => 'Current Password entered does not match with our records'); // NCurrent Pass no coincide con el de la db
									}
								}
							}
								else
								{
									$array = array(
										'msg' => '-1',
										'error' => validation_errors()); // Error en el formulario
								}
							}
						else{
							show_404();
						}
						echo json_encode($array);
					}

					/*
						* Function to edit compounding financing
						*
						*  @return msg "success" if the record was saved right
						*          msg "error" if the record was not saved right
						*
						* @author: Carlos Gonzalez
						*/
						public function edit_investor_compounding()
						{
							if ($this->input->is_ajax_request())
							{
								$this->form_validation->set_error_delimiters('<h6><i class="fa fa-close"></i> ', '</h6>');

								$this->form_validation->set_rules('compounding','Compounding','required');

								if ($this->form_validation->run())
								{
									$compounding 	= $this->input->post('compounding');
									$id   				= $this->input->post('id');

											if ($this->mdl_investor->edit_investor_compounding($id,$compounding) === TRUE) {
												$array = array(
													'msg' => '1'); // Se actualizo la informacion correctamente
											}else{
												$array = array(
													'msg' => '0',
													'error' => 'Error: Try it later!'); // No se actualizo correctamente la informacion
											}
								}
									else
									{
										$array = array(
											'msg' => '-1',
											'error' => validation_errors()); // Error en el formulario
									}
								}
							else{
								show_404();
							}
							echo json_encode($array);
						}

    /*
			  * Function to fetch a single investor with ajax to edit
			  *
			  * @author: Carlos Gonzalez
			  */
				public function fetch_single_investor_to_edit()
				{
					$id = $this->input->post('id_user');
					$investor_data = $this->mdl_investor->fetch_a_single_investor($id);

					$output = array();

					foreach ($investor_data as $key) {
						$output['first_name'] 	    = $key->first_name;
            $output['last_name'] 		    = $key->last_name;
			      $output['email'] 				    = $key->email;
						$output['username'] 		    = $key->username;
						$output['dob'] 	            = $key->dob;
						$output['status']				    = $key->status;
						$output['system_access'] 		= $key->system_access;
						$output['articles_access'] 	= $key->articles_access;
						$output['personal_access'] = $key->personal_access ;
            $output['total_access'] 		= $key->total_access;
						$output['created_date']	    = $key->created_date;
					}
			    echo json_encode($output);
				}

        /*
		  * Function to fetch a user with ajax
		  *
		  * @author: Carlos Gonzalez
		  */
			public function fetch_a_single_investor()
			{
				$id = $this->input->post('id');
				$investor_data = $this->mdl_investor->fetch_a_single_investor($id);

				$data 		= array();
				$status 	= '';
				$system 	= '';
				$article 	= '';
				$personal = '';
        $total    = '';


				foreach ($investor_data as $key) {
					if($key->status == 1){ // usuario activo
						$status = '<i class="fa fa-circle-o"></i> <strong>Status: </strong><span class="badge badge-success"> Active</span>';
					}else if ($key->status == 2) { //pendiente a confirmacion
						$status = '<i class="fa fa-circle-o"></i> <strong>Status: </strong><span class="badge badge-warning"> Pending</span>';
					}else if ($key->status == 0) { // usuario no activo
						$status = '<i class="fa fa-circle-o"></i> <strong>Status: </strong><span class="badge badge-danger"> Inactive</span>';
					}
					if ($key->system_access == '1') { //Privilegios de Systema
						$system = '<li><h5><i class="fa fa-check-square-o" style="color:green"></i></h5><span>System</span></li>';
					}else if($key->system_access == '0'){ //No Privilegios de Systema
						$system = '<li><h5><i class="fa fa-square-o" style="color:red"></i></h5><span>System</span></li>';
					}
					if ($key->articles_access == '1') { //Privilegios de Articulos
						$article = '<li><h5><i class="fa fa-check-square-o" style="color:green"></i></h5><span>Article</span></li>';
					}else if($key->articles_access == '0'){ // No Privilegios de Articulos
						$article = '<li><h5><i class="fa fa-square-o" style="color:red"></i></h5><span>Article</span></li>';
					}
					if ($key->personal_access == '1') { //Privilegios de Stats
						$personal = '<li><h5><i class="fa fa-check-square-o" style="color:green"></i></h5><span>Personal</span></li>';
					}else if($key->personal_access == '0'){ // No Privilegios de Stats
						$personal = '<li><h5><i class="fa fa-square-o" style="color:red"></i></h5><span>Personal</span></li>';
					}
          if ($key->total_access == '1') { //Privilegios de Stats
						$stats = '<li><h5><i class="fa fa-check-square-o" style="color:green"></i></h5><span>Personal</span></li>';
					}else if($key->total_access == '0'){ // No Privilegios de Stats
						$total = '<li><h5><i class="fa fa-square-o" style="color:red"></i></h5><span>Total</span></li>';
					}

					$output = array(
            'full_name' 	=> $key->first_name.' '.$key->last_name,
		        'email' 			=> '<i class="fa fa-envelope-o"></i> <strong>Email: </strong>'.$key->email,
		        'username' 		=> '<i class="fa fa-user"></i> <strong>Username: </strong>'.$key->username,
						'status' 			=> $status,
						'system' 			=> $system,
						'article' 		=> $article,
						'personal' 		=> $personal,
            'total'       => $total,
						'created_date'=> '<i class="fa fa-calendar"></i> <strong>Created: </strong>'.$key->created_date
          );
				}
        echo json_encode($output);
			}
		/*
		* Function to fetch a investor data with ajax
		*
		* @author: Carlos Gonzalez
		*/
			public function fetch_investor_data()
			{
				$id = $this->input->post('id_data');
				$output = array();
				$data_investor = $this->mdl_investor->fetch_a_single_investor($id);

				foreach ($data_investor as $key){

					if($key->status == 1){ // usuario activo
						$status = '<span class="badge badge-success"> Active</span>';
					}else if ($key->status == 2) { //pendiente a confirmacion
						$status = '<span class="badge badge-warning"> Pending</span>';
					}else if ($key->status == 0) { // usuario no activo
						$status = '<span class="badge badge-danger"> No Active</span>';
					}
					if ($key->total_access == '1') { // Accesso Total
						$total = '<i class="fa fa-check-square-o text-success"></i><span class="value text-default"> Total </span>';
					}else if($key->total_access == '0'){ // No Accesso total
						$total = '<i class="fa fa-square-o text-danger"></i><span class="value text-default"> Total </span>';
					}
					if ($key->system_access == '1') { //Privilegios de Systema
						$system = '<i class="fa fa-check-square-o text-success"></i><span class="value text-default"> System </span>';
					}else if($key->system_access == '0'){ //No Privilegios de Systema
						$system = '<i class="fa fa-square-o text-danger"></i><span class="value text-default"> System </span>';
					}
					if ($key->articles_access == '1') { //Privilegios de Articulos
						$article = '<i class="fa fa-check-square-o text-success"></i><span class="value text-default"> Articles </span>';
					}else if($key->articles_access == '0'){ // No Privilegios de Articulos
						$article = '<i class="fa fa-square-o text-danger"></i><span class="value text-default"> Articles </span>';
					}
					if ($key->personal_access == '1') { //Privilegios de cuenta personal
						$personal = '<i class="fa fa-check-square-o text-success"></i><span class="value text-default"> Personal </span>';
					}else if($key->personal_access == '0'){ // No Privilegios de cuenta personal
						$personal = '<i class="fa fa-square-o text-danger"></i><span class="value text-default"> Personal </span>';
					}

					$output = array(
            'first_last_name' 	=> $key->first_name.' '.$key->last_name,
		        'email' 						=> '<li><i class="fa fa-envelope user-profile-icon"></i> '.$key->email.'</li>',
		        'username_investor' => '<li><i class="fa fa-user user-profile-icon"></i> '.$key->username.'</li>',
						'created'						=> '<li><i class="fa fa-calendar user-profile-icon"></i> '.$key->created_date.'</li>',
						'years_old' 				=> '<li><i class="fa fa-calendar user-profile-icon"></i> '.$this->calculaedad($key->dob).' years old</li>',
						'status' 						=> '<li><i class="fa fa-circle-o-notch user-profile-icon"></i> '.$status.'</li>',
						'system' 						=> '<li>'.$system.'</li>',
						'article' 					=> '<li>'.$article.'</li>',
						'personal' 					=> '<li>'.$personal.'</li>',
            'total'      			 	=> '<li>'.$total.'</li>',
						'link'							=> '<li class="m-top-xs"><i class="fa fa-external-link user-profile-icon"></i> '.anchor(base_url(),base_url(),array('target'=>'_blank')).'</li>',
						'id_privilege' 			=> $key->privilegeID,
						'compounding'				=> $key->compounding
          );
				}
				echo json_encode($output);
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

			/*
			 * Function to create a deposit in hold
			 *
			 *  @return  TRUE or FALSE
			 *
			 *  @author: Carlos Gonzalez
			 */
			public function hold_contribution()
			{
				$id 					= $this->input->post('id');
				$dpst_amount 	= $this->input->post('dpst_amount');
				$data_hold = $this->mdl_investor->fetch_a_hold_contribution($id);

				$array = array();
				if ($this->input->is_ajax_request()){
					if($data_hold == NULL)
					{
						if ($this->mdl_investor->add_contribution_hold($id,$dpst_amount) === TRUE) {
							$array = array(
								'resp' => '1',
								'msg' => 'Hold created');
							}else
							{
								$array = array(
									'resp' => '0',
									'msg'  => 'The hold was not created');
								}
					}else{
						if ($this->mdl_investor->hold_edit($id,($data_hold[0]->hold+$dpst_amount)) === TRUE) {
							$array = array(
								'resp' => '1',
								'msg' => 'Hold updated');
						} else {
							$array = array(
								'resp' => '0',
								'msg'  => 'The hold was not updated');
							}
						}
				}else {
					show_404();
				}
				echo json_encode($array);
			}

			/*
			 * Function to create a deposit in hold
			 *
			 *  @return  TRUE or FALSE
			 *
			 *  @author: Carlos Gonzalez
			 */
			public function hold_withdraw()
			{
				$id = $this->input->post('id');
				// Total a extraer
				$dpst_amount 	= $this->input->post('withdraw_amount');
				//Total depositado
				 $open_amount 	= $this->amount_validation($this->mdl_investor->get_current_amount($id));
				 // Total extraido
				 $w = $this->amount_validation($this->mdl_investor->get_amount_withdraw($id));
				 //Total disponible
				 $available = $open_amount - $w;
				 $this->form_validation->set_error_delimiters('<h6><i class="fa fa-close"></i> ', '</h6>');
				 $this->form_validation->set_rules('withdraw_amount', 'Withdraw amount', 'required|numeric');
				 $data_hold = $this->mdl_investor->fetch_a_withdraw_hold_contribution($id);

				$array = array();
				if ($this->input->is_ajax_request()){
					if($data_hold == NULL)
		 				 {
							 if($dpst_amount > $available){
				 				$array = array(
				 				'resp' => '-1',
				 				'msg'  => 'Sorry you only have available BTC '.$available.' to withdraw'
				 				);
				 			}else{
								if ($this->mdl_investor->add_withdraw_hold($id,$dpst_amount) === TRUE) {
								 $array = array(
									 'resp' => '1',
									 'msg' => 'Hold created');
								 }else
								 {
									 $array = array(
										 'resp' => '0',
										 'msg'  => 'The hold was not created');
									 }
				 				}
		 				 }else{
							 $reminder = $available - $data_hold[0]->hold;
							 if ($dpst_amount > $reminder) {
								 $array = array(
 				 				'resp' => '-1',
 				 				'msg'  => 'Sorry you only have available BTC '.$reminder.' to withdraw'
 				 				);
								}else{
									if ($this->mdl_investor->withdraw_hold_edit($id,($data_hold[0]->hold+$dpst_amount)) === TRUE) {
	 		 						 $array = array(
	 		 							 'resp' => '1',
	 		 							 'msg' => 'Hold updated');
	 		 					 	} else {
	 		 						 	$array = array(
	 		 							 	'resp' => '0',
	 		 							 	'msg'  => 'The hold was not updated');
	 		 						 }
								}

		 					 }
				}else {
					show_404();
				}
				echo json_encode($array);
			}

			/*
       * Function to create a deposit in the system
       *
       *  @return  TRUE or FALSE
       *
       *  @author: Carlos Gonzalez
       */
      public function deposit_operation()
      {
				$id 					= $this->input->post('id');
				$oprtn_date 	= date('Y-m-d H:i:s');
				$oprtn_type 	= $this->input->post('oprtn_type');
				$open_amount 	= $this->mdl_investor->get_current_amount($id);
				$dpst_amount 	= $this->input->post('dpst_amount');
				$current_contribution = $open_amount + $dpst_amount;
				$company_contribution = $this->mdl_investor->get_current_company_amount();
				$withdraw = 0;//tengo q dessarrollar la tabla de withdraw

				$current_prcnt = $this->current_investorPrcnt($current_contribution,$company_contribution);
				$current_btc = $this->btc_profit_weekly_by_company($current_contribution,$current_prcnt);
				$array = array();
				if ($this->input->is_ajax_request()){
					if ($this->mdl_investor->deposit_operation($id,$oprtn_date,$oprtn_type,$open_amount,$dpst_amount) === TRUE) {

						if ($this->mdl_investor->investor_initial_contribution($id) != NULL) {
							$this->mdl_investor->hold_processed($id);
							$array = array(
								'resp' => '1',
								'msg' => 'Ok');
						}
						else{
							if ($this->mdl_investor->add_initial_contribution($id,$dpst_amount) === TRUE) {
								if ($this->mdl_investor->add_investor_data_info($id,$current_contribution,$current_prcnt,$current_btc) === TRUE) {
									$this->mdl_investor->hold_processed($id);
									$array = array(
										'resp' => '1',
										'msg' => 'Ok');
								} else {
									$array = array(
										'resp' => '2',
										'msg' => 'Ok');
								}
							}
							else {
								$array = array(
									'resp' => '0',
									'msg'  => 'The deposit was not made it');
								}
							}
						}else
						{
							$array = array(
								'resp' => '-1',
								'msg'  => 'The deposit was not made it');
							}
				}else {
					show_404();
				}


				echo json_encode($array);
      }

			/*
				* Function to fetch all the active financing of an investor
				*
				*
				* @author: Carlos Gonzalez
				*/
			public function fetch_investor_active_financing()
			{
				$draw = intval($this->input->get("draw"));
		    $start = intval($this->input->get("start"));
		    $length = intval($this->input->get("length"));
				$id = $this->input->post("id");

				$active_financing_data = $this->mdl_investor->fetch_investor_active_financing($id,$start,$length);
				$total_investor_active_financing = $this->mdl_investor->getRecordCountActiveFinancingInvestor($id);

				$data = array();
				$cont = 1;

				foreach ($active_financing_data->result() as $key) {

					$data[] = array(
												$cont,
		                    $key->operation_type ,
		                    $key->operation_date,
		                    '<i class="fa fa-btc"></i> '.$this->amount_validation($key->deposit_amount));
					$cont = $cont+1;
				}
				$output = array(
		               "draw" 						=> $draw,
		               "recordsTotal" 		=> $total_investor_active_financing,
		               "recordsFiltered" 	=> $total_investor_active_financing,
		               "data" 						=> $data
		            );
		    echo json_encode($output);
			}

			public function amount_validation($amount)
			{
				$dividido = explode(".",$amount);
				$int = $dividido[0];
				$aux_real = '';
				$real = '';

				if(!isset($dividido[1]))
				{
					return $int.'.00000000';
				}
				else
				{
					$real = '';
					$cont = 0;
					$aux_real = str_split($dividido[1]);


						for($i = 0; $i < count($aux_real); $i++)
					{

							$real = $real.$aux_real[$i];
							$cont++;

					}
					for($j = 0; $j < (8-$cont); $j++)
					{
						$real = $real.'0';
					}

				}
				$val = $int.'.'.$real;

				return $val;
			}

			/*
			* Function to load dashboard data for an investor
			*
			* @author: Carlos Gonzalez
			*/
				public function load_dashboard_investor_data()
				{
					$id = $this->input->post('id_data');
					$output = array();
					$data_investor = $this->mdl_investor->load_dashboard_investor_data($id);
					$total_amount_invest  = $this->amount_validation($this->mdl_investor->get_current_amount($id));
					$total_profit  = $this->amount_validation($this->mdl_investor->get_total_investor_profit($id));
					$withdraw = $this->amount_validation($this->mdl_investor->get_amount_withdraw($id));

					$current = '';
					$withdraw_hold = $this->mdl_investor->fetch_a_withdraw_hold_contribution($id);
					if ($withdraw_hold == NULL) {
						$current = $this->amount_validation($total_amount_invest - $withdraw);
					}else{
						$current = $this->amount_validation($total_amount_invest - $withdraw - $withdraw_hold[0]->hold);
					}

					$investor_profit_last_week = $this->mdl_investor->last_week_investor_profit($id);
					if ($investor_profit_last_week == NULL) {
						$investor_profit_last_week = new stdClass();
						$investor_profit_last_week->profit_prcnt = '0.0';
					}
					if ($data_investor == NULL) {
						$output = array(
	            'total_invested_by' 	=> '<h5><i class="fa fa-btc"></i> '.$total_amount_invest.'</h5>',
							'investor_name' 			=> 'Total Invested by investor',
							'last_week_percent'		=> '<h5>0.00 %</h5>',
							'last_week_profit_btc' => '<h5><i class="fa fa-btc"></i> 0.00000000</h5>',
							'total_profit_by' 	=> '<h5><i class="fa fa-btc"></i> '.$total_profit.'</h5>',
							'current_investment_amount' => '<h5><i class="fa fa-btc"></i> '.$current.'</h5>',
						  'withdraw_total' => '<h5><i class="fa fa-btc"></i> '.$withdraw.'</h5>',
						  'amount_available' => $current
						);
					} else {
						foreach ($data_investor as $key){
							$output = array(
		            'total_invested_by' 	=> '<h5><i class="fa fa-btc"></i> '.$total_amount_invest.'</h5>',
								'investor_name' 			=> 'Total Invested by '.$key->first_name.' '.$key->last_name,
								'last_week_percent'		=> '<h5>'.$investor_profit_last_week->profit_prcnt.' %'.'</h5>',
								'last_week_profit_btc' => '<h5><i class="fa fa-btc"></i> '.$this->amount_validation($investor_profit_last_week->profit_btc).'</h5>',
								'total_profit_by' 	=> '<h5><i class="fa fa-btc"></i> '.$total_profit.'</h5>',
								'current_investment_amount' => '<h5><i class="fa fa-btc"></i> '.$this->amount_validation($current).'</h5>',
								'withdraw_total' => '<h5><i class="fa fa-btc"></i> '.$withdraw.'</h5>',
								'amount_available' => $current
		          );
						}
					}
					echo json_encode($output);
				}

				/*
				* Function to load admin dashboard data
				*
				* @author: Carlos Gonzalez
				*/
					public function load_dashboard_admin_data()
					{
						$output = array();
						// Total invertido en la compania
						$total_amount_invest_by_company  = $this->amount_validation($this->mdl_investor->get_current_company_amount());
						// Extraciones totales por todos los inversores
						$company_withdraw = $this->amount_validation($this->mdl_investor->get_amount_withdraw_by_company());
						// Cantidad actual invirtiendose
						$current_amount_invest_by_company = $total_amount_invest_by_company - $company_withdraw;

						$total_company_profit = $this->mdl_investor->get_total_company_profit();
						$last_week_company_profit = $this->mdl_investor->last_week_company_profit();
						if ($last_week_company_profit == NULL) {
							$last_week_company_profit = new stdClass();
							$last_week_company_profit->profit_prcnt = '0.0';
							$last_week_company_profit->btc_profit = '0.0';
						}
						//$btc_profit_weekly_by_company = $this->btc_profit_weekly_by_company($total_amount_invest_by_company,$last_week_company_profit->profit_prcnt);

								$output = array(
									'current_invested_by_company' => '<h4><i class="fa fa-btc"></i> '.$this->amount_validation($current_amount_invest_by_company).'</h4>',
			            'total_invested_by_company' 		=> '<h4><i class="fa fa-btc"></i> '.$total_amount_invest_by_company.'</h4>',
									'last_week_profit'							=> '<h4>'.$last_week_company_profit->profit_prcnt.' %</h4>',
									'last_week_company_profit_btc'	=> '<h4><i class="fa fa-btc"></i> '.$this->amount_validation($last_week_company_profit->btc_profit).'</h4>',
									'total_company_profit' => '<h4><i class="fa fa-btc"></i> '.$this->amount_validation($total_company_profit).'</h4>',
									'total_company_withdraw' => '<h4><i class="fa fa-btc"></i> '.$company_withdraw.'</h4>'
			          );


						echo json_encode($output);
					}


	/*
	 * Function to load admin dashboard data
	 *
	 * @author: Carlos Gonzalez
	 */
	 public function add_general_profit()
	 {
		 $array_outpout = array();

		 if ($this->input->is_ajax_request()) {
		 	$week_data_range = $this->input->post('week_data_range');
			$profit_prcnt = $this->input->post('profit_prcnt');
			$profit_btc_form = $this->input->post('profit_btc');
			$btc_profit = '';
			// Total invertido a nivel de compania
			$total_invest = $this->mdl_investor->get_current_company_amount();
			// Total withdraw por los inversionistas
			$withdraw_total = $this->mdl_investor->get_amount_withdraw_by_company();
			// Current amount available in the company
			$current_total = $total_invest - $withdraw_total;
			// Total de ganancial de la semana a nivel de compania
			if ($profit_btc_form == 0) {
				$btc_profit = $this->btc_profit_weekly_by_company($current_total,$profit_prcnt);
				$this->form_validation->set_rules('profit_prcnt', 'Profit Percent', 'required|numeric');
			} else {
				$btc_profit = $profit_btc_form;
				$profit_prcnt = $this->prcnt_profit_weekly_by_company($current_total,$btc_profit);
				$this->form_validation->set_rules('profit_btc', 'Profit BTC', 'required|numeric');
			}
//0.11501763

			$this->form_validation->set_rules('week_data_range', 'Week range', 'required');
			//$btc_profit = $this->btc_profit_weekly_by_company($current_total,$profit_prcnt);

			$list_investors = $this->mdl_investor->fetch_all_investor();

			$this->form_validation->set_error_delimiters('<h6><i class="fa fa-close"></i> ', '</h6>');

			//$this->form_validation->set_rules('profit_prcnt', 'Profit Percent', 'required|numeric');
			//$this->form_validation->set_rules('week_data_range', 'Week range', 'required');

			if ($this->form_validation->run()) {
				if($this->mdl_investor->add_general_profit($week_data_range,$profit_prcnt,$current_total,$btc_profit) == TRUE)
				{
					$last_week_company_profit = $this->mdl_investor->last_week_company_profit();
					foreach ($list_investors as $key) {
						// Total invertido por el inversionista
						$total_investor = $this->mdl_investor->get_current_amount($key->investorID);
						// Total withdraw by an inversionista
						$withdraw_inv = $this->mdl_investor->get_amount_withdraw($key->investorID);
						// Current Total invested by and investor
						$current_total_investor = $total_investor - $withdraw_inv;
						// Total de ganancial (%) de la semana a nivel de inversionista
						$current_prcnt_investor = $this->current_investorPrcnt($current_total_investor,$current_total);
						// Total de ganancial de la semana a nivel de inversionista
						$profit_btc = $this->btc_profit_weekly_by_company($btc_profit,$current_prcnt_investor);

						$this->mdl_investor->add_weekly_investor_profit($last_week_company_profit->weeklyProfitID,$key->investorID,$profit_prcnt,$profit_btc);

						if ($key->compounding == 'on') {
							$this->deposit_compounding_operation($key->investorID,'Compounding',$profit_btc);
						} else if($key->compounding == 'off'){
							//$this->add_withdraw_data($key->investorID,$amount_w);
						}

					}
					$array_outpout = array(
						'status' => '1',
						'msg'    => 'ok'
					);
				}else{
					$array_outpout = array(
						'status' => '-1',
						'msg'    => 'The profit was not inserted'
					);
				}
			} else {
				$array_outpout = array(
					'status' => '0',
					'msg'    => validation_errors()
				);
			}
		 } else {
		 	show_404();
		 }
		 echo json_encode($array_outpout);
	 }

	 /*
		* Function to deposit compounding amount
		*
		* @param: $comp_amount --> Valor q se depositara a modo de compounding
		*
		*  @return  TRUE or FALSE
		*
		*  @author: Carlos Gonzalez
		*/
	 public function deposit_compounding_operation($id,$oprtn_type,$comp_amount)
	 {
		 $oprtn_date 	= date('Y-m-d H:i:s');
		 $open_amount 	= $this->mdl_investor->get_current_amount($id);
		 $withdraw_amount = $this->mdl_investor->get_amount_withdraw($id);
		 $current_contribution = ($open_amount - $withdraw_amount) + $comp_amount;

		 $company_contribution = $this->mdl_investor->get_current_company_amount();
		 $company_withdraw = $this->mdl_investor->get_amount_withdraw_by_company();
		 $company_current_contribution = $company_contribution - $company_withdraw;

		 $current_prcnt = $this->current_investorPrcnt($current_contribution,$company_current_contribution);
		 $current_btc = $this->btc_profit_weekly_by_company($current_contribution,$current_prcnt);

		 if ($this->mdl_investor->deposit_operation($id,$oprtn_date,$oprtn_type,$current_contribution,$comp_amount) === TRUE) {
				 	return TRUE;
		} else
			{
					 return FALSE;
			}
	 }

	 /*
	 * Function to withdraw
	 *
	 * @param:
	 *
	 *  @return  TRUE or FALSE
	 *
	 *  @author: Carlos Gonzalez
	 */

	 public function release_withdraw_operation()
	 {
		 $array = array();
		 $id = $this->input->post('id');
		 // Total a extraer
		 $amount_w = $this->mdl_investor->fetch_a_withdraw_hold_contribution($id);
		 //Total depositado
		 $open_amount 	= $this->amount_validation($this->mdl_investor->get_current_amount($id));
		 // Total extraido
		 $w = $this->amount_validation($amount_w[0]->hold);
		 //Total disponible
		 if ($this->input->is_ajax_request()) {
             if ($this->mdl_investor->add_withdraw_data($id,$w)) {
                 $this->mdl_investor->deposit_operation($id,date('Y-m-d'),'Withdraw',$open_amount,$w);
                 $this->mdl_investor->withdraw_hold_processed($id);
	 					$array = array(
	 						'status' => '1',
	 						'msg' 	 => 'ok'
	 					);
	 			 	} else {
	 					$array = array(
	 						'status' => '-1',
	 						'msg' 	 => 'Operation was not proccessed'
	 					);
	 			 	}

		 } else {
		 	show_404();
		 }
		 echo json_encode($array);
	 }

	 /*
		 * Function to get all company's profit
		 *
		 *
		 * @author: Carlos Gonzalez
		 */
	 public function all_profit_data_table()
	 {
		 $draw = intval($this->input->get("draw"));
		 $start = intval($this->input->get("start"));
		 $length = intval($this->input->get("length"));

		 $profit_company_data = $this->mdl_investor->all_profit_data_table($start,$length);
		 $total_profit_company_data = $this->mdl_investor->getRecordCountAllProfitCompany();

		 $data = array();
		 $cont = 1;

		 foreach ($profit_company_data->result() as $key) {
			 $data[] = array(
										 $cont,
										 $key->week_data_range,
										 $key->profit_prcnt.' %',
									 	 '<i class="fa fa-btc"></i> '.$this->amount_validation($key->btc_profit));
			 $cont = $cont+1;
		 }
		 $output = array(
								"draw" 						=> $draw,
								"recordsTotal" 		=> $total_profit_company_data,
								"recordsFiltered" => $total_profit_company_data,
								"data" 						=> $data
						 );
		 echo json_encode($output);
	 }

	 /*
		 * Function to get all investor profit
		 *
		 *
		 * @author: Carlos Gonzalez
		 */
	 public function all_profit_investor_data_table()
	 {
		 $draw = intval($this->input->get("draw"));
		 $start = intval($this->input->get("start"));
		 $length = intval($this->input->get("length"));

		 $id = $this->input->post();

		 $profit_investor_data = $this->mdl_investor->investor_profit_data_table($id,$start,$length);
		 $total_profit_investor_data = $this->mdl_investor->getRecordCountAllProfitInvestor($id);

		 $data = array();
		 $cont = 1;

		 foreach ($profit_investor_data->result() as $key) {
			 $data[] = array(
										 $cont,
										 $key->week_data_range,
										 $key->profit_prcnt.' %',
									 	 '<i class="fa fa-btc"></i> '.$this->amount_validation($key->profit_btc));
			 $cont = $cont+1;
		 }
		 $output = array(
								"draw" 						=> $draw,
								"recordsTotal" 		=> $total_profit_investor_data,
								"recordsFiltered" => $total_profit_investor_data,
								"data" 						=> $data
						 );
		 echo json_encode($output);
	 }

	 /*
		 * Function to get all hold contributions
		 *
		 *
		 * @author: Carlos Gonzalez
		 */
	 public function all_hold_contributions()
	 {
		 $draw = intval($this->input->get("draw"));
		 $start = intval($this->input->get("start"));
		 $length = intval($this->input->get("length"));

		 $profit_company_data = $this->mdl_investor->all_hold_contribution_table($start,$length);
		 $total_profit_company_data = $this->mdl_investor->getRecordCountAllHoldContributions();
		 /*echo "<pre>";
		 print_r($profit_company_data->result());die;
		 echo "</pre>";*/
		 $data = array();
		 $cont = 1;

		 foreach ($profit_company_data->result() as $key) {
			 $data[] = array(
										 $cont,
										 $key->first_name.' '.$key->last_name,
									 	 '<i class="fa fa-btc"></i> '.$this->amount_validation($key->hold),
									 	 '<button type="button" class="btn btn-primary btn-warning release_hold" id="'.$key->investorID.'"><i class="fa fa-refresh"></i> Release</button><input type="hidden" id="id" value="'.$key->investorID.'"><input type="hidden" id="deposit_amount" value="'.$key->hold.'">');
			 $cont = $cont+1;
		 }
		 $output = array(
								"draw" 						=> $draw,
								"recordsTotal" 		=> $total_profit_company_data,
								"recordsFiltered" => $total_profit_company_data,
								"data" 						=> $data
						 );
		 echo json_encode($output);
	 }

	 /*
		 * Function to get all withdraw hold contributions
		 *
		 *
		 * @author: Carlos Gonzalez
		 */
	 public function all_withdraw_hold_contributions()
	 {
		 $draw = intval($this->input->get("draw"));
		 $start = intval($this->input->get("start"));
		 $length = intval($this->input->get("length"));

		 $profit_company_data = $this->mdl_investor->all_hold_withdraw_table($start,$length);
		 $total_profit_company_data = $this->mdl_investor->getRecordCountAllWithdrawHoldContributions();
		 /*echo "<pre>";
		 print_r($profit_company_data->result());die;
		 echo "</pre>";*/
		 $data = array();
		 $cont = 1;

		 foreach ($profit_company_data->result() as $key) {
			 $data[] = array(
										 $cont,
										 $key->first_name.' '.$key->last_name,
									 	 '<i class="fa fa-btc"></i> '.$this->amount_validation($key->hold),
									 	 '<button type="button" class="btn btn-primary btn-warning release_withdraw_hold" id="'.$key->investorID.'"><i class="fa fa-refresh"></i> Release</button><input type="hidden" id="id" value="'.$key->investorID.'"><input type="hidden" id="deposit_amount" value="'.$key->hold.'">');
			 $cont = $cont+1;
		 }
		 $output = array(
								"draw" 						=> $draw,
								"recordsTotal" 		=> $total_profit_company_data,
								"recordsFiltered" => $total_profit_company_data,
								"data" 						=> $data
						 );
		 echo json_encode($output);
	 }

	 /*
		 * Function to get all hold contributions
		 *
		 *
		 * @author: Carlos Gonzalez
		 */
	 public function all_withdraw()
	 {
		 $draw = intval($this->input->get("draw"));
		 $start = intval($this->input->get("start"));
		 $length = intval($this->input->get("length"));

		 $withdraw_data = $this->mdl_investor->all_withdraw_table($start,$length);
		 $total_count_withdraw_data = $this->mdl_investor->getRecordCountAllWithdraw();
		 /*echo "<pre>";
		 print_r($profit_company_data->result());die;
		 echo "</pre>";*/
		 $data = array();
		 $cont = 1;

		 foreach ($withdraw_data->result() as $key) {
			 $data[] = array(
										 $cont,
										 $key->first_name.' '.$key->last_name,
									 	 '<i class="fa fa-btc"></i> '.$this->amount_validation($key->amount_w),
									 	 $key->date_oprtn);
			 $cont = $cont+1;
		 }
		 $output = array(
								"draw" 						=> $draw,
								"recordsTotal" 		=> $total_count_withdraw_data,
								"recordsFiltered" => $total_count_withdraw_data,
								"data" 						=> $data
						 );
		 echo json_encode($output);
	 }


 /*
	* Function to determine profit amount by company in a week
	*
	*		@param: $total_invest --> Total invertido en la compania
	* 					$profit_prcnt --> Profit porcent
	*
	* @author: Carlos Gonzalez
	*/
	public function btc_profit_weekly_by_company($total_invest,$profit_prcnt)
	{
		$btc = ($total_invest * $profit_prcnt)/100;
		return round($btc,8);
	}

	/*
 	* Function to determine profit amount by company in a week
	* a partir de btc
 	*
 	*		@param: $total_invest --> Total invertido en la compania
 	* 					$profit_btc --> Profit btc
 	*
 	* @author: Carlos Gonzalez
 	*/
 	public function prcnt_profit_weekly_by_company($total_invest,$profit_btc)
 	{
 		$prcnt = ($profit_btc * 100) / $total_invest;
 		return round($prcnt,4);
 	}

	/*
	 * Function to determine current investor contribution porcentaje
	 *
	 *		@param: $current_contribution
	 * 					  $company_contribution
	 *						$withdraw
	 *
	 * @author: Carlos Gonzalez
	 */
	public function current_investorPrcnt($current_contribution,$company_contribution)
	{
		if ($company_contribution == 0) {
			return 0;
		} else {
			return ($current_contribution * 100) / $company_contribution;
		}
	}

	/*
	 * Function to fetch and investor
	 *
	 * @author: Carlos Gonzalez
	 */
	public function fetch_investors_view()
	{
		$output = '';
  	$query = '';
		if($this->input->post('query'))
  	{
			$query = $this->input->post('query');
		}
		$data = $this->mdl_investor->fetch_investors_view_data($query);

		if($data->num_rows() > 0)
  	{
			foreach($data->result() as $row)
		   {
				 if($row->status == 1){ // usuario activo
					 $status = '<span class="badge badge-success"> Active</span>';
				 }else if ($row->status == 2) { //pendiente a confirmacion
					 $status = '<span class="badge badge-warning"> Pending</span>';
				 }else if ($row->status == 0) { // usuario no activo
					 $status = '<span class="badge badge-danger"> No Active</span>';
				 }
				 if($row->compounding == 'on'){ // autofinanciamiento activo
					 $compounding = '<span class="badge badge-success"> ON</span>';
				 }else if ($row->compounding == 'off') { //autofinanciamiento no activo
					 $compounding = '<span class="badge badge-danger"> OFF</span>';
				 }
					$output .= form_open("welcome/fetch_investor_profile").'<div class="col-md-3 widget widget_tally_box">
			      <div class="x_panel fixed_height_390">
			        <div class="x_content">
			            <ul class="list-inline widget_profile_box">
			              <li><input type="hidden" name="id_data" id="id_data" value="'.$row->investorID.'"></li>
			              <li>
			                <img src="'.base_url().'assets/dashboard/production/images/user.png" alt="..." class="img-circle profile_img">
			              </li>
			              <li>
			              </li>
			            </ul>
			          </div>
			          <h5 class="name">'.$row->first_name.' '.$row->last_name.'</h5><hr>
			          <div class="row">
									<div class="col-sm-12">
										<strong><i class="fa fa-user"></i> Username: </strong>'.$row->username.'
									</div>
									<div class="col-sm-12">
										<strong><i class="fa fa-envelope"></i> Email: </strong>'.$row->email.'
									</div>
									<div class="col-sm-12">
										<strong><i class="fa fa-calendar"></i> Years Old: </strong>'.$this->calculaedad($row->dob).'
									</div>
			          </div>
								<hr>
								<div class="row">
									<div class="col-sm-12">
										<strong><i class="fa fa-circle"></i> Status: </strong>'.$status.'
									</div>
									<div class="col-sm-12">
										<strong><i class="fa fa-cog"></i> Compounding: </strong>'.$compounding.'
									</div>
								</div>
								<hr>
			          <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-folder-open-o"></i> Open</button>
			        </div>

			      </div>
			    </div></form>';
		   }
		}else
	  {
	   $output .= '<div class="alert alert-default alert-dismissible " role="alert">
								 	<strong> <i class="fa fa-users-"></i> Holy guacamole!</strong> No data found.
								</div>';
	  }
		echo $output;
	}

	/*
	 * Function to fetch BTC price
	 *
	 * @author: Carlos Gonzalez
	 */
	public function getPrice($currency)
	{
		$btcUSD = $this->mdl_investor->getPrice('https://blockchain.info/ticker');
		$btcPrice = $btcUSD[$currency]["last"];
		$pair = array('currency' => $currency,'price'=>$btcPrice);

		echo json_encode($pair);
	}

	/*
   * Finction para obtener las ganancias semanales y mostrarlas en la grafica
   *
   * @author: Carlos Gonzalez
   */
	public function get_weekly_profit_chart_data()
	{
		$result = $this->mdl_investor->get_weekly_profit_chart_data();
		echo json_encode($result);
	}

	/*
   * Function para obtener las ganancias semanales y mostrarlas en la grafica
   *
   * @author: Carlos Gonzalez
   */
	public function get_investor_weekly_profit_chart_data()
	{
		$id = $this->input->post('id');
		$result = $this->mdl_investor->get_investor_weekly_profit_chart_data($id);
		echo json_encode($result);
	}

	/*
   * Function para obtener los ingresos mensuales y mostrarlas en la grafica
   *
   * @author: Carlos Gonzalez
   */
	public function get_monthly_income_chart_data()
	{
		$result = $this->mdl_investor->get_monthly_income_chart_data();
		echo json_encode($result);
	}

	/*
   * Function para obtener actividades mensuales de inversionistas
	 * mensuales
   *
   * @author: Carlos Gonzalez
   */
	public function get_investor_monthly_activity_chart_data()
	{
		$id = $this->input->post('id');
		$result = $this->mdl_investor->get_investor_monthly_activity_chart_data('$id');
		echo json_encode($result);
	}

	/*
		* Function to count the hold operations
		*
		*
		* @author: Carlos Gonzalez
		*/
	public function count_withdraw_deposit_hold()
	{
		$w_hold = $this->mdl_investor->getRecordCountAllWithdrawHoldContributions();
		$d_hold = $this->mdl_investor->getRecordCountAllHoldContributions();

		$data = array('w_hold'=>$w_hold,'d_hold'=>$d_hold);
		echo json_encode($data);
	}

	/*
	* Function to get online users
	*
	* @author: Carlos Gonzalez
	*/
		public function who_is_online()
		{
			$output = '';
			$investorName = '';

			$who_is_online = $this->sign_in->who_is_online();

			foreach ($who_is_online as $key) {
				$investorName = $this->mdl_investor->fetch_a_single_investor($key->investorID);

/*echo "<pre>";
print_r($investorName[0]->first_name);die;
echo "</pre>";*/

				$output .= '<li class="media event">
										<a class="pull-left border-green profile_thumb">
											<i class="fa fa-user green"></i>
										</a>
										<div class="media-body">
											<a class="title" href="#">'.$investorName[0]->first_name.' '.$investorName[0]->last_name.'</a>
											<p><strong><i class="fa fa-btc"></i> From: </strong> '.$key->ipdat_city.', '.$key->ipdat_country.' </p>
											<p> <small>Online 120 minutes</small></p>
										</div>
									</li>';
			}
			echo $output;
		}

}
