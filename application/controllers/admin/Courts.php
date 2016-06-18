<?php
defined('BASEPATH') or die('Restricted access');

class Courts extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		// define time zone asia/pakistan
		date_default_timezone_set('Asia/Karachi');
		
		// load model
		$this->load->model('courts_model');
		$this->load->model('tehsils_model');
		$this->load->model('cities_model');
		
		//load urdu editor script and file
		$this->template->add_hjs('assets/js/urdu-webpad.js');
		$this->template->add_js_script('initUrduEditor()');
	}
	
	public function index()
	{
		// load css and js files for datatable		
		$this->template->add_css('assets/plugins/datatables/jquery.dataTables.min.css');

		$this->template->add_js('assets/plugins/datatables/jquery.dataTables.min.js');
		$this->template->add_js('assets/plugins/datatables/dataTables.bootstrap.js');
		
		// get courts list
		$data['courts'] = $this->courts_model->get_courts();
		
		$this->template->set_title('Judges/Courts Name List');
		$this->template->loadview('templates/default_admin','backend/courts/courts_list', $data);
	}
	
	// * check unique court name
	public function check_unique_cName($value, $id)
	{
		$this->form_validation->set_message('check_unique_cName','This court name already exists!');
		
		$cNames = $this->courts_model->check_unique_cName($id);
		
		if (array_key_exists ( $value, $cNames )) {
			return false;
		} else {
			return true;
		}
		
	}
	// * check court user on update
	public function check_asgnd_court_user($value, $cUser)
	{
		list($court_id, $court_type) = explode('||', $cUser);
		
		$this->form_validation->set_message('check_asgnd_court_user','This user is assigned other court!');
		
		$cUsers = $this->courts_model->check_asgnd_court_user($court_id,$court_type);
		
		if (array_key_exists ( $value, $cUsers )) {
			return false;
		} else {
			return true;
		}
	}
	// * check court rank on update
	public function unique_sorting($value, $id)
	{
		$this->form_validation->set_message('unique_sorting','This rank is already assigned!');
		
		$sortings = $this->courts_model->unique_sorting($id);
		
		if (array_key_exists ( $value, $sortings )) {
			return false;
		} else {
			return true;
		}
	}
	
	public function add_court()
	{
		//echo $data = $this->ion_auth->logged_in();
		
		$data['desgns'] = $this->courts_model->list_desgns();
		$data['tehsils']= $this->tehsils_model->list_tehsils();
		$data['cities'] = $this->cities_model->list_cities();
		$data['users'] 	= $this->ion_auth->users()->result(); 
		$this->template->set_title('Add Sessions Court Name');
		$this->template->loadview('templates/default_admin','backend/courts/add_court', $data);
	}
	
	public function save_court()
	{
		$data = array(
			'court_id'		=> strip_tags($this->input->post('court_id',TRUE)),
			'court_name' 	=> strip_tags($this->input->post('court_name',TRUE)),
			'desgn_id' 		=> strip_tags($this->input->post('desgn_id',TRUE)),
			'teh_id' 		=> strip_tags($this->input->post('teh_id',TRUE)),
			'city_id' 		=> strip_tags($this->input->post('city_id',TRUE)),
			'court_type' 	=> strip_tags($this->input->post('court_type',TRUE)),
			'sorting' 		=> strip_tags($this->input->post('sorting',TRUE)),
			'asgnd_user_id' => strip_tags($this->input->post('asgnd_user_id',TRUE)),
			'created_user_id' => $this->ion_auth->user()->row()->id,
			'created_date'	=> date('Y-m-d H:i:s'),
			'status' 		=> strip_tags($this->input->post('status',TRUE)),
		);
		
		$cUser = $data['court_id'] . '||' . $data['court_type'];
		
		$this->form_validation->set_rules('court_name', 'court name', 'required|callback_check_unique_cName['.$data['court_id'].']');
		$this->form_validation->set_rules('desgn_id', 'designation', 'required');
		$this->form_validation->set_rules('teh_id', 'tehsil', 'required');
		$this->form_validation->set_rules('city_id', 'city', 'required');
		$this->form_validation->set_rules('court_type', 'type', 'required');
		$this->form_validation->set_rules('sorting', 'rank rank', 'required|numeric|callback_unique_sorting['.$data['court_id'].']');
		$this->form_validation->set_rules('asgnd_user_id', 'user', 'callback_check_asgnd_court_user['.$cUser.']');
		$this->form_validation->set_rules('status', 'type', 'required');
		
		
		if ($this->form_validation->run() == FALSE) {
			
			$data['desgns'] = $this->courts_model->list_desgns();
			$data['tehsils'] = $this->tehsils_model->list_tehsils();
			$data['cities'] = $this->cities_model->list_cities();
			$data['users'] 	= $this->ion_auth->users()->result();
			$data['court'] = (object) $data;
			$this->template->set_title('Add Court Name');
			$this->template->loadview('templates/default_admin','backend/courts/add_court', $data);
		}
		else
		{
			if($this->courts_model->save_court($data) > 0)
			{
				$this->session->set_flashdata('message','Judge/Court Name Saved Successfully');
				$this->session->set_flashdata('message_type','success');
			}
			else
			{
				$this->session->set_flashdata('message','Judge/Court name could not be saved');
				$this->session->set_flashdata('message_type','danger');
			}
		redirect(base_url('admin/courts'));
		}
	}
	
	public function edit_court($id)
	{
		if (!$id){
			redirect(base_url().'admin/manage_sessions_courts/add_court');
		}
	
		$data['court'] = $this->courts_model->get_court($id);
		
		if (count($data['court'])==0)
		{
			$this->session->set_flashdata('message','The court name could not be found');
			$this->session->set_flashdata('message_type','warning');
			redirect($this->session->userdata('url'));
		}
		$data['desgns'] = $this->courts_model->list_desgns();
		$data['tehsils'] = $this->tehsils_model->list_tehsils();
		$data['cities'] = $this->cities_model->list_cities();
		$data['users'] 	= $this->ion_auth->users()->result();
		
		$this->template->set_title('Edit Sessions Court Name');
		$this->template->loadview('templates/default_admin','backend/courts/edit_court',$data);
	}
	
	public function update_court()
	{
		$data = array(
				'court_id'			=> strip_tags($this->input->post('court_id',TRUE)),
				'court_name' 		=> strip_tags($this->input->post('court_name',TRUE)),
				'desgn_id' 			=> strip_tags($this->input->post('desgn_id',TRUE)),
				'teh_id' 		=> strip_tags($this->input->post('teh_id',TRUE)),
				'city_id' 		=> strip_tags($this->input->post('city_id',TRUE)),
				'court_type' 		=> strip_tags($this->input->post('court_type',TRUE)),
				'sorting' 			=> strip_tags($this->input->post('sorting',TRUE)),
				'asgnd_user_id' 	=> strip_tags($this->input->post('asgnd_user_id',TRUE)),
				'modified_user_id' 	=> $this->ion_auth->user()->row()->id,
				'modified_date'		=> date('Y-m-d H:i:s'),
				'status' 			=> strip_tags($this->input->post('status',TRUE)),
		);
		
		$cUser = $data['court_id'] . '||' . $data['court_type'];
	
		$this->form_validation->set_rules('court_name', 'court name', 'required|callback_check_unique_cName['.$data['court_id'].']');
		$this->form_validation->set_rules('desgn_id', 'designation', 'required');
		$this->form_validation->set_rules('teh_id', 'tehsil', 'required');
		$this->form_validation->set_rules('city_id', 'city', 'required');
		$this->form_validation->set_rules('court_type', 'type', 'required');
		$this->form_validation->set_rules('sorting', 'rank rank', 'required|numeric|callback_unique_sorting['.$data['court_id'].']');
		$this->form_validation->set_rules('asgnd_user_id', 'user', 'callback_check_asgnd_court_user['.$cUser.']');
		$this->form_validation->set_rules('status', 'type', 'required');
	
		if ($this->form_validation->run() == FALSE) {
			
			$data['desgns'] = $this->courts_model->list_desgns();
			$data['tehsils'] = $this->tehsils_model->list_tehsils();
			$data['cities'] = $this->cities_model->list_cities();
			$data['users'] 	= $this->ion_auth->users()->result();
			$data['court'] = $this->courts_model->get_court($data['court_id']);
			$data['court'] = (object) $data;
			$this->template->set_title('Edit Sessions Court Name');
			$this->template->loadview('templates/default_admin','backend/courts/edit_court', $data);
		}
	
		else
		{
			if($data['court_id']>0)
			{
				if( $result=$this->courts_model->update_court($data) > 0)
				{
					$this->session->set_flashdata('message','Judge/Court Name Updated Successfully!');
					$this->session->set_flashdata('message_type','success');
				}
				else
				{
					$this->session->set_flashdata('message','Judge/Court name could not be updated!');
					$this->session->set_flashdata('message_type','danger');
				}
			}
			redirect(base_url('admin/courts'));
		}
	}
	
	public function delete_court($id)
	{
		if (!$id){
			redirect(base_url().'admin/courts/add_court');
		}
		if($this->courts_model->delete_court($id) > 0)
		{
			$this->session->set_flashdata('message','Court Name deleted Successfully');
			$this->session->set_flashdata('message_type','success');
		}
		else
		{
			$this->session->set_flashdata('message','Court Name Could not be deleted');
			$this->session->set_flashdata('message_type','danger');
		}
		redirect(base_url('admin/courts'));
	}
	
	// * check unique designation of judge/court *
	public function unique_desgn($value, $id)
	{
		$this->form_validation->set_message('unique_desgn','This designation is already exist!');
		
		$desgns = $this->courts_model->unique_desgn($id);
		foreach ($desgns as $desgn) {
			if ($desgn->desgn_name == $value)
			{
				return false;
			}
		}
	}
	
	// * Judge/Court Designation *
	public function add_desgn()
	{
		$this->template->set_title('Add Designation of Judge');
		$this->template->loadview('templates/default_admin','backend/courts/add_desgn');
	}
	public function save_desgn()
	{
		$data = array(
				'id' => 				strip_tags($this->input->post('id', TRUE)),
				'desgn_name' => 		strip_tags($this->input->post('desgn_name', TRUE)),
				'created_user_id' => 	$this->ion_auth->user()->row()->id,
				'created_date' => 		date('Y-m-d H:i:s'),
				'status'	=> 			strip_tags($this->input->post('status', TRUE)),
			);
		
		$this->form_validation->set_rules('desgn_name', 'designation', 'required|callback_unique_desgn['.$data['id'].']');
			
		if ($this->form_validation->run() == FALSE) {
			
			$this->template->set_title('Add Designation of Judge');
			$this->template->loadview('templates/default_admin','backend/courts/add_desgn', $data);
	
		}
		else
		{
			if($this->courts_model->save_desgn($data) > 0)
			{
				$this->session->set_flashdata('message','The designation have saved successfully');
				$this->session->set_flashdata('message_type','success');
			}
			else
			{
				$this->session->set_flashdata('message','The designation could not be saved!');
				$this->session->set_flashdata('message_type','danger');
			}
			redirect(base_url().'admin/courts/desgn');
		}
	}
	
	public function edit_desgn($id)
	{
		if (!$id){
			redirect(base_url().'admin/courts/desgn');
		}
		$data['desgn'] = $this->courts_model->get_desgn($id);
		if (count($data['desgn'])== 0)
		{
			$this->session->set_flashdata('message','Court designation could not be found');
			$this->session->set_flashdata('message_type','warning');
			redirect($this->session->userdata('url'));
		}
		$this->template->set_title('Edit Designation of Judge/Court');
		$this->template->loadview('templates/default_admin','backend/courts/edit_desgn',$data);
	}
	
	public function update_desgn()
	{
		$data = array(
				'id' => strip_tags($this->input->post('id', TRUE)),
				'desgn_name' => 		strip_tags($this->input->post('desgn_name', TRUE)),
				'modified_user_id' => 	$this->ion_auth->user()->row()->id,
				'modified_date' => 		date('Y-m-d H:i:s'),
				'status'	=> 			strip_tags($this->input->post('status', TRUE)),
			);
	
		$this->form_validation->set_rules('desgn_name', 'designation', 'required|callback_unique_desgn['.$data['id'].']');
			
		if ($this->form_validation->run() == FALSE) {
			
			$data['desgn'] = $this->courts_model->get_desgn($data['id']);
			
			$this->template->set_title('Edit Designtion of Judge/Court');
			$this->template->loadview('templates/default_admin','backend/courts/edit_desgn', $data);
		}
		else
		{	
			if( $data['id'] > 0 )
			{
				if($this->courts_model->update_desgn($data) > 0)
				{
					$this->session->set_flashdata('message','The designation updated successfully!');
					$this->session->set_flashdata('message_type','success');
				}
				else
				{
					$this->session->set_flashdata('message','The designation could not be updated!');
					$this->session->set_flashdata('message_type','danger');
				}
			}
			redirect(base_url().'admin/courts/desgn');
		}
	}
	
	public function delete_desgn($id)
	{
		if (!$id){
			redirect(base_url().'admin/courts/add_desgn');
		}
		if($this->courts_model->delete_desgn($id) > 0)
		{
			$this->session->set_flashdata('message','The designation deleted Successfully!');
			$this->session->set_flashdata('message_type','success');
		}
		else
		{
			$this->session->set_flashdata('message','The designation could not be deleted!');
			$this->session->set_flashdata('message_type','danger');
		}
		redirect(base_url().'admin/courts/desgn');
	}
	public function desgn()
	{
		// load css and js files for datatable		
		$this->template->add_css('assets/plugins/datatables/jquery.dataTables.min.css');

		$this->template->add_js('assets/plugins/datatables/jquery.dataTables.min.js');
		$this->template->add_js('assets/plugins/datatables/dataTables.bootstrap.js');
	
		$data['desgns'] = $this->courts_model->desgns();
		$this->template->set_title('List of Designation Judges/Courts');
		$this->template->loadview('templates/default_admin','backend/courts/desgn_list',$data);
	}
}