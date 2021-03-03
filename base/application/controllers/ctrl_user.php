<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_user extends CI_Controller {

	function __construct()
  {
    parent::__construct();
  }

	public function fetch_users()
	{
		$draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

		$users_data = $this->mdl_users->fetch_users($start,$length);
		$total_user = $this->mdl_users->getRecordCount();

		$data = array();

		foreach ($users_data->result() as $key) {
//$data['data_id'] = $key->id;
			$data[] = array(
				"id_data"						=> $key->id,
                    $key->full_name,
                    $key->description,
                    $key->email,
                    $key->username,
										'<button class="btn btn-outline-info btn-xs details" data-toggle="tooltip" data-placement="top" title="Details" id="'.$key->id.'" privilege-id="'.$key->privilegesID.'"><i class="fa fa-info"></i></button>'.
										'<button class="btn btn-outline-info btn-xs edit" data-toggle="tooltip" data-placement="top" title="Edit" id="'.$key->id.'" privilege-id="'.$key->privilegesID.'"><i class="fa fa-edit"></i></button>'.
										'<button class="btn btn-outline-danger btn-xs delete" data-toggle="tooltip" data-placement="top" title="Delete" id="'.$key->id.'" privilege-id="'.$key->privilegesID.'" data-toggle="modal" data-target=".delete_modal"><i class="fa fa-trash"></i></button>'
               );
		}
		$output = array(
               "draw" 						=> $draw,
               "recordsTotal" 		=> $total_user,
               "recordsFiltered" 	=> $total_user,
               "data" 						=> $data
            );
    echo json_encode($output);
	}

	public function fetch_rol()
	{
		if ($this->input->is_ajax_request()) {
			$empRecord = $this->mdl_rol->fetch_role();
			echo json_encode($empRecord);
		}else{
			show_404();
		}
	}

	/*
	  * Function to add a new user with ajax
	  *
	  *  @return msg "success" if the record was saved right
	  *          msg "error" if the record was not saved right
	  *
	  * @author: Carlos Gonzalez
	  */
	  public function add_user()
	  {
	    if ($this->input->is_ajax_request())
	    {
				$this->form_validation->set_error_delimiters('<h6><i class="fa fa-close"></i> ', '</h6>');

	      $this->form_validation->set_rules('full_name','Full Name','required');
				$this->form_validation->set_rules('email','Email','required|valid_email');
				$this->form_validation->set_rules('username','Username','required');
				$this->form_validation->set_rules('passwd','Password','required');
				$this->form_validation->set_rules('r_passwd', 'Password Confirmation','required|matches[passwd]');
				$this->form_validation->set_rules('rol','Rol','required|alpha_numeric');
				$this->form_validation->set_message('alpha_numeric',
            'The Rol field is required');

	      if ($this->form_validation->run())
	      {
	        $full_name  = $this->input->post('full_name');
	        $email   		= $this->input->post('email');
	        $username  	= $this->input->post('username');
					$passwd  		= $this->input->post('passwd');
					$passwd_r  	= $this->input->post('r_passwd');
					$rol 				= $this->input->post('rol');
					$webSite  	= $this->input->post('webSite');
					$articles  	= $this->input->post('articles');
					$stats  		= $this->input->post('stats');

					$test1 = sha1($passwd);
					$test2 = sha1($passwd_r);

					if (strcmp($passwd,$passwd_r) != 0) {
						$array = array(
	            'msg' => '-1',
							'error' => true); // Contrasenas no coinciden
					}
					else{
						if ($this->mdl_users->insert_user() === TRUE) {
		          $array = array(
		            'msg' => '1'); // Se inserto la informacion correctamente
		        }
		        else{
		          $array = array(
		            'msg' => '0',
							  'error' => true); // No se inserto correctamente la informacion
		        }
					}
	      }
	      else
	      {
	        $array = array(
	          'msg' => '2',
						'error' => validation_errors()); // Error en el formulario
	      }
	    }
	    else{
	      show_404();
	    }
	    echo json_encode($array);
	  }

		/*
		  * Function to quick edit a user with ajax
		  *
		  *  @return msg "success" if the record was saved right
		  *          msg "error" if the record was not saved right
		  *
		  * @author: Carlos Gonzalez
		  */
		  public function quick_user_edit()
		  {
		    if ($this->input->is_ajax_request())
		    {
					$this->form_validation->set_error_delimiters('<h6><i class="fa fa-close"></i> ', '</h6>');

		      $this->form_validation->set_rules('edit_full_name','Full Name','required');
					$this->form_validation->set_rules('edit_email','Email','required|valid_email');
					$this->form_validation->set_rules('edit_username','Username','required');
					$this->form_validation->set_rules('edit_rol','Rol','required');
					$this->form_validation->set_rules('edit_status','Status','required');

		      if ($this->form_validation->run())
		      {
		        $full_name  = $this->input->post('edit_full_name');
		        $email   		= $this->input->post('edit_email');
		        $username  	= $this->input->post('edit_username');
						$rol 				= $this->input->post('edit_rol');
						$webSite  	= $this->input->post('edit_status');
						$id 				= $this->input->post('id');

						if ($this->mdl_users->quick_user_edit($id) === TRUE) {
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
		  * Function to delete a user with ajax
		  *
		  *  @return msg "success" if the record was saved right
		  *          msg "error" if the record was not saved right
		  *
		  * @author: Carlos Gonzalez
		  */
		function delete_user()
    {
        //$session = $this->session->userdata('session');
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $privilegesID = $this->input->post('privilegesID');
            //$user = $this->mdl_users->getUserData($id_elim);
            if ($this->mdl_users->delete_user($id,$privilegesID) === TRUE) {
                /*$activity = 'user <code>'.$user[0]->email.'</code> was deleted';
                $module = 'General - User & Privileges';
                $id_user = $session['id'];
                $this->mdl_activityLog->insertActivityLog($id_user,$activity,$module);*/
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
		  * Function to fetch a user with ajax
		  *
		  * @author: Carlos Gonzalez
		  */
			public function fetch_a_single_user()
			{
				$id = $this->input->post('id');
				$user_data = $this->mdl_users->fetch_a_single_user($id);

				$data 		= array();
				$status 	= '';
				$system 	= '';
				$article 	= '';
				$stats 		= '';


				foreach ($user_data as $key) {
					if($key->status == 1){ // usuario activo
						$status = '<i class="fa fa-circle-o"></i> <strong>Status: </strong><span class="badge badge-success"> Active</span>';
					}else if ($key->status == 0) { //pendiente a confirmacion
						$status = '<i class="fa fa-circle-o"></i> <strong>Status: </strong><span class="badge badge-warning"> Pending</span>';
					}else if ($key->status == -1) { // usuario no activo
						$status = '<i class="fa fa-circle-o"></i> <strong>Status: </strong><span class="badge badge-danger"> No Active</span>';
					}
					if ($key->webSite == '1') { //Privilegios de Systema
						$system = '<li><h5><i class="fa fa-check-square-o" style="color:green"></i></h5><span>System</span></li>';
					}else if($key->webSite == '0'){ //No Privilegios de Systema
						$system = '<li><h5><i class="fa fa-square-o" style="color:red"></i></h5><span>System</span></li>';
					}
					if ($key->articles == '1') { //Privilegios de Articulos
						$article = '<li><h5><i class="fa fa-check-square-o" style="color:green"></i></h5><span>Article</span></li>';
					}else if($key->articles == '0'){ // No Privilegios de Articulos
						$article = '<li><h5><i class="fa fa-square-o" style="color:red"></i></h5><span>Article</span></li>';
					}
					if ($key->stats == '1') { //Privilegios de Stats
						$stats = '<li><h5><i class="fa fa-check-square-o" style="color:green"></i></h5><span>Stats</span></li>';
					}else if($key->stats == '0'){ // No Privilegios de Stats
						$stats = '<li><h5><i class="fa fa-square-o" style="color:red"></i></h5><span>Stats</span></li>';
					}

					$output = array(
		                    'full_name' 	=> $key->full_name,
		                    'email' 			=> '<i class="fa fa-envelope-o"></i> <strong>Email: </strong>'.$key->email,
		                    'username' 		=> '<i class="fa fa-user"></i> <strong>Username: </strong>'.$key->username,
												'description' => $key->description,
												'user_code' 	=> $key->user_code,
												'status' 			=> $status,
												'system' 			=> $system,
												'article' 		=> $article,
												'stats' 			=> $stats,
												'created_date'=> '<i class="fa fa-calendar"></i> <strong>Created: </strong>'.$key->created
											);
				}
		    echo json_encode($output);
			}
			/*
			  * Function to fetch a user with ajax to edit
			  *
			  * @author: Carlos Gonzalez
			  */
				public function fetch_single_user_to_edit()
				{
					$id = $this->input->post('id_user');
					$user_data = $this->mdl_users->fetch_a_single_user($id);

					$output 		= array();

					foreach ($user_data as $key) {
						$output['full_name'] 		= $key->full_name;
			      $output['email'] 				= $key->email;
						$output['username'] 		= $key->username;
						$output['description'] 	= $key->description;
						$output['user_code'] 		= $key->user_code;
						$output['status']				= $key->status;
						$output['system'] 			= $key->webSite;
						$output['article'] 			= $key->articles;
						$output['stats'] 				= $key->stats;
						$output['created_date']	= $key->created;
					}
			    echo json_encode($output);
				}

}
