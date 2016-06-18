<?php
defined('BASEPATH') or die('Restricted access');

class Stages_cause_list extends Members
{
	public function __construct()
	{
		parent::__construct();
		// set timezone
		date_default_timezone_set('Asia/Karachi');
		
		// stages model
		$this->load->model('courts_model');
		$this->load->model('stages_model');
		$this->load->model('stages_cause_list_model');
		
		// laod urdu editor js file & script
		$this->template->add_hjs('assets/js/urdu-webpad.js');
		$this->template->add_js_script('initUrduEditor()');
	}
	
	// stages list
	public function index()
	{
		if ($this->ion_auth->is_Admin())
		{
			$data['courts'] = $this->courts_model->get_publish_courts_list();
		}
		else
		{
			// get courts to assigned login user
			$loginUser = $this->ion_auth->user()->row()->id;
			$data['courts'] = $this->courts_model->get_court_names_by_login_user($loginUser);
		}
		
		//$data['stages'] = $this->stages_cause_list_model->get_stages($court_id);
		
		$this->template->set_title('Stages');
		$this->template->loadview('templates/default_admin','backend/stages/for_cause_list/index',$data);
	}
	public function all()
	{
		$court_id = strip_tags($this->input->post('court_id',TRUE));
		
		$this->form_validation->set_rules('court_id', 'court name', 'required');
		
		if ( $this->form_validation->run() == FALSE) 
		{
			if ($this->ion_auth->is_Admin())
			{
				$data['courts'] = $this->courts_model->get_publish_courts_list();
			}
			else
			{
				// get courts to assigned login user
				$loginUser = $this->ion_auth->user()->row()->id;
				$data['courts'] = $this->courts_model->get_court_names_by_login_user($loginUser);
			}
			
			$this->template->set_title('Stages');
			$this->template->loadview('templates/default_admin','backend/stages/for_cause_list/index',$data);
		}
		else 
		{
			$data['court_by_user'] = $this->courts_model->get_court_name_by_id( $court_id );
			$data['stages'] = $this->stages_cause_list_model->get_stages_by_court_id($court_id);
			
			// load css and js files for datatable
			$this->template->add_css('assets/plugins/datatables/jquery.dataTables.min.css');
			$this->template->add_js('assets/plugins/datatables/jquery.dataTables.min.js');
			$this->template->add_js('assets/plugins/datatables/dataTables.bootstrap.js');
			
			$this->template->set_title('Stages List');
			$this->template->loadview('templates/default_admin','backend/stages/for_cause_list/all',$data);
		}
		
	}
	// get form data
	public function formData()
	{
		// define array for submit data
		$this->Data = array(
				'id'			=> strip_tags($this->input->post('id',TRUE)),
				'stage_id'		=> strip_tags($this->input->post('stage_id',TRUE)),
				'court_id'		=> strip_tags($this->input->post('court_id',TRUE)),
				'court_type'	=> strip_tags($this->input->post('court_type', TRUE)),
				'sorting'		=> strip_tags($this->input->post('sorting',TRUE)),
				'status'		=> strip_tags($this->input->post('status',TRUE)),
				'user_id'		=> $this->ion_auth->user()->row()->id,
				'dateTime'		=> date('Y-m-d H:i:s'),
		);
		
		// define validation array
		$this->dataValidation = array(
				array(
						'field' => 'court_id',
						'label' => 'Court Name',
						'rules' => 'required',
				),
				array(
						'field' => 'status',
						'label' => 'status',
						'rules' => 'required',
				),				
		);
	}
	
	// add stages for sessions courts 
	public function add_sc()
	{
		// get assigned court name by user
		$loginUser = $this->ion_auth->user()->row()->id;
		$data['court_type'] = 'Sessions';
		if (!$this->ion_auth->is_Admin()){
			$data['court_by_user'] = $this->courts_model->get_court_name_by_user($loginUser, $data['court_type']);
		}
		else 
		{
			$data['courts'] = $this->courts_model->get_courts_by_type( $data['court_type'] );
		}
		
		$data['stages'] = $this->stages_model->get_stages_for_court( $data['court_type'] );
		
		$this->template->set_title('Add Stage');
		$this->template->loadview('templates/default_admin','backend/stages/for_cause_list/add', $data);
	}
	
	// add stages for civil courts
	public function add_cvc()
	{
		// get assigned court name by user
		$loginUser = $this->ion_auth->user()->row()->id;
		$data['court_type'] = 'Civil';
		if (!$this->ion_auth->is_Admin()){
			$data['court_by_user'] = $this->courts_model->get_court_name_by_user($loginUser, $data['court_type']);
		}
		else
		{
			$data['courts'] = $this->courts_model->get_courts_by_type( $data['court_type'] );
		}
	
		$data['stages'] = $this->stages_model->get_stages_for_court( $data['court_type'] );
	
		$this->template->set_title('Add Stage');
		$this->template->loadview('templates/default_admin','backend/stages/for_cause_list/add', $data);
	}
	
	// save
	public function save()
	{
		$this->formData();
		$data = $this->Data;
		$validate = $this->dataValidation;

// 		echo '<pre>';
// 		var_dump($data['court_type']);
// 		die();
		
		// set validation
		$this->form_validation->set_rules($validate);
		$this->form_validation->set_rules('stage_id', 'stage name', 'required|callback_validate_stage_name['.$data['id'].']');
		
		if ($this->form_validation->run() == FALSE)
		{
			// get assigned court name by user
			$loginUser = $this->ion_auth->user()->row()->id;
			
// 			$courtType = 'Sessions';
			if (!$this->ion_auth->is_Admin()){
				$data['court_by_user'] = $this->courts_model->get_court_name_by_user($loginUser, $data['court_type']);
			}
			else
			{
				$data['courts'] = $this->courts_model->get_courts_by_type( $data['court_type'] );
			}
			
			$data['stages'] = $this->stages_model->get_stages_for_court( $data['court_type'] );
			
			$data['item'] = (object) $data;
	
			$this->template->set_title('Add Stage');
			$this->template->loadview('templates/default_admin','backend/stages/for_cause_list/add', $data);
		}
		else
		{
			if($this->stages_cause_list_model->save($data) > 0)
			{
				$this->session->set_flashdata('message','Stage have saved Successfully!');
				$this->session->set_flashdata('message_type','success');
			}
			else
			{
				$this->session->set_flashdata('message','Stage could not be saved!');
				$this->session->set_flashdata('message_type','danger');
			}
			redirect( base_url('admin/stages_cause_list') );
		}
	}
	public function edit($id)
	{
		if (!$id){
			redirect(base_url('admin/stages_cause_list'));
		}
		
		$data['item'] = $this->stages_cause_list_model->get_stage($id);

		if (count($data['item']) < 0)
		{
			$this->session->set_flashdata('message','This stage could not be found!');
			$this->session->set_flashdata('message_type','warning');
			redirect(base_url('admin/stages_cause_list'));
		}
		
		// get assigned court name by user
		$loginUser = $this->ion_auth->user()->row()->id;
		$courtType = $this->courts_model->get_court_type( $data['item']->court_id );

		if (!$this->ion_auth->is_Admin())
		{
			$data['court_by_user'] = $this->courts_model->get_court_name_by_user($loginUser,$courtType->court_type);	
		}
		else
		{
			$data['courts'] = $this->courts_model->get_courts_by_type( $courtType->court_type );
		}
		
		$data['stages'] = $this->stages_model->get_stages_for_court( $courtType->court_type );
		
		$this->template->set_title('Edit Stage');
		$this->template->loadview('templates/default_admin','backend/stages/for_cause_list/edit', $data);
	}
	public function update()
	{
		$this->formData();
		$data = $this->Data;
		$validate = $this->dataValidation;
		
// 				echo '<pre>';
// 				var_dump($data);
// 				die();
		
		// set validation
		$this->form_validation->set_rules($validate);
		$this->form_validation->set_rules('stage_id', 'stage name', 'required|callback_validate_stage_name['.$data['id'].']');
	
		if ($this->form_validation->run() == FALSE) {
			
			// get assigned court name by user
			$loginUser = $this->ion_auth->user()->row()->id;
			$courtType = $this->courts_model->get_court_type( $data['court_id'] );
			
			if (!$this->ion_auth->is_Admin())
			{
				$data['court_by_user'] = $this->courts_model->get_court_name_by_user($loginUser, $courtType->court_type);
			}
			else
			{
				$data['courts'] = $this->courts_model->get_courts_by_type( $courtType->court_type );
			}
			
			$data['stages'] = $this->stages_model->get_stages_for_court( $courtType->court_type );
			
			$data['item'] = (object) $data;
			
			$this->template->set_title('Edit Stage');
			$this->template->loadview('templates/default_admin','backend/stages/for_cause_list/edit', $data);
		}
		else
		{
			if($data['id']>0)
			{
				if($this->stages_cause_list_model->update($data) > 0)
				{
					$this->session->set_flashdata('message','This stage have updated Successfully!');
					$this->session->set_flashdata('message_type','success');
				}
				else
				{
					$this->session->set_flashdata('message','This stage have could not updated!');
					$this->session->set_flashdata('message_type','danger');
				}
			}
			redirect(base_url('admin/stages_cause_list'));
		}
	}
	public function delete($id)
	{
		if (!$id){
			redirect(base_url('admin/stages_cause_list'));
		}
		if($this->stages_cause_list_model->delete($id) > 0)
		{
			$this->session->set_flashdata('message','This stage have deleted Successfully!');
			$this->session->set_flashdata('message_type','success');
		}
		else
		{
			$this->session->set_flashdata('message','This stage could not be deleted!');
			$this->session->set_flashdata('message_type','danger');
		}
		redirect(base_url().'admin/stages_cause_list');
	}

	// * check uniqeu stage name
	public function validate_stage_name($stage, $id)
	{
		// form submit data
		$this->formData();
		$data = $this->Data;
			
		$this->form_validation->set_message('validate_stage_name','This stage is already exist!');
	
		$stages = $this->stages_cause_list_model->validate_stage_name($id);
		
		foreach ( $stages as $key => $value )
		{
			if ( ($value->stage_id == $stage) && ($value->court_id == $data['court_id']) )
			{
// 				echo '<pre>';
// 				var_dump($value->court_id);
// 				die();
				return false;
			}
		}
	}
		
}