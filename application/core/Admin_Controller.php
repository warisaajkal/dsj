<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		// enable profiler
		$this->output->enable_profiler(TRUE);

		$this->session->set_userdata('url',uri_string());
				
		if(!$this->ion_auth->logged_in())
		{
			redirect(base_url().'admin/auth/login');
		}
		
		if(($this->ion_auth->logged_in()) && (!$this->ion_auth->is_Admin()))
		{
			$this->session->set_flashdata('message','You are not authorized user!');
			$this->session->set_flashdata('message_type','danger');
			redirect(base_url('admin'));
		}
	}
}

class Members extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		
		// enable profiler
		$this->output->enable_profiler(TRUE);
		
		// load court model
		$this->load->model('courts_model');
		
		$this->session->set_userdata('url',uri_string());
		// get login user id
		$user_id = $this->ion_auth->user()->row()->id;
		$active_controller = $this->router->fetch_class();
		$active_method 	   = $this->router->fetch_method();
		
// 		$userGroup = $this->ion_auth->get_users_groups($user_id)->row()->name;
		$userGroups = $this->ion_auth->get_users_groups($user_id)->result();
		
		$courts_by_user = $this->courts_model->check_authentic_user_by_court($user_id);
		
		if(!$this->ion_auth->logged_in())
		{
			redirect(base_url('admin/auth/login'));
		}
		else
		{
			if (!$this->ion_auth->is_Admin())
			{
				
				foreach ( $userGroups as $group )
				{
					if ($group->name !== 'members') {
						$this->session->set_flashdata('message','You are not authorized user!<br>Please contact administrator for access this page!<br>Cell # 0300 720 1629');
						$this->session->set_flashdata('message_type','warning');
						redirect(base_url('admin'));
					}
				}
					
					if ( ($active_controller == 'cases') || ($active_controller=='cases_list') || ($active_controller == 'cause_list') || ($active_controller == 'stages_cause_list') )
					{
						if ( empty($courts_by_user) )
						{
							$this->session->set_flashdata('message','You are not authorized user!<br>Please contact administrator for access this page!<br>Cell # 0300 720 1629');
							$this->session->set_flashdata('message_type','warning');
							
							redirect( base_url('admin') );
						}
						else  
						{
							if ( ($active_method == 'add_sc_cr') || ($active_method == 'add_sc_cv') || ($active_method == 'sc_criminal') || ($active_method == 'sc_civil') )
							{
							
								if ( !array_key_exists('Sessions', $courts_by_user ))
								{
									$this->session->set_flashdata('message','1. You are not authorized user!<br>Please contact administrator for access this page!<br>Cell # 0300 720 1629');
									$this->session->set_flashdata('message_type','warning');
										
									redirect( base_url('admin') );
								}
									
							}
							
							if ( ($active_method == 'add_cvc_cr') || ($active_method == 'add_cvc_cv') || ($active_method == 'cvc_criminal') || ($active_method == 'cvc_civil') )
							{
								if ( !array_key_exists('Civil', $courts_by_user ))
								{
									$this->session->set_flashdata('message','2. You are not authorized user!<br>Please contact administrator for access this page!<br>Cell # 0300 720 1629');
									$this->session->set_flashdata('message_type','warning');
										
									redirect( base_url('admin') );
								}
									
							}
							
						}
					}
					
// 				}
				
			}
			
		}		
	}
}


