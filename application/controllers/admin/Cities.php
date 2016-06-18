<?php defined('BASEPATH') or die('Restricted access');

class Cities extends Admin_Controller {
	
	public function __construct() {
		
		parent:: __construct();
		// set timezone
		date_default_timezone_set('Asia/Karachi');
		
		//load model
		$this->load->model('cities_model');
		
		// add urdu editor js file and script
		$this->template->add_hjs('assets/js/urdu-webpad.js');
		$this->template->add_js_script('initUrduEditor()');
	}
	
	public function index()
	{
		// load css and js files for datatable		
		$this->template->add_css('assets/plugins/datatables/jquery.dataTables.min.css');

		$this->template->add_js('assets/plugins/datatables/jquery.dataTables.min.js');
		$this->template->add_js('assets/plugins/datatables/dataTables.bootstrap.js');
		
		$data['cities'] = $this->cities_model->cities();
		$this->template->set_title('Cities Name');
		$this->template->loadview('templates/default_admin', 'backend/cities/list',$data);
	}
	
	public function add()
	{
		$this->template->set_title('Add City Name');
		$this->template->loadview('templates/default_admin' , 'backend/cities/add');
	}
	
	public function save()
	{
		$data = array(
				'id' => strip_tags($this->input->post('id', TRUE)),
				'city_name' => strip_tags($this->input->post('city_name', TRUE)),
				'sorting' 	  	  => strip_tags($this->input->post('sorting',TRUE)),
				'created_user_id' => $this->ion_auth->user()->row()->id,
				'created_date' => date('Y-m-d H:i:s'),
				'status' => strip_tags($this->input->post('status', TRUE)),
		);
	
		$this->form_validation->set_rules('city_name', 'City', 'required|is_unique[cities.city_name]');
	
		if ($this->form_validation->run() == FALSE) {
			$this->template->set_title('Add City Name');
			$this->template->loadview('templates/default_admin' , 'backend/cities/add', $data);
		}
		else
		{
			if($this->cities_model->save($data) > 0)
			{
				$this->session->set_flashdata('message','City Name Saved Successfully');
				$this->session->set_flashdata('message_type','success');
			}
			else
			{
				$this->session->set_flashdata('message','City Name Could Not Be Saved!');
				$this->session->set_flashdata('message_type','danger');
			}
			redirect(base_url().'admin/cities');
		}
	
	}
	
	// * check validation on update
	function edit_unique($curnt_Value, $id)
	{
		$this->form_validation->set_message('edit_unique','The city name is already exist!');
	
		$cities = $this->cities_model->edit_unique($id);
		
		foreach ($cities as $key => $Value)
		{
			$cities[$key] = $Value->city_name;
		}

		foreach ($cities as $city)
		{
			if ($curnt_Value == $city )
			{
				return FALSE;
			}
		}
	}
	
	public function edit($id)
	{
		if (!$id){
			redirect(base_url().'admin/cities');
		}
	
		$data['item'] = $this->cities_model->get_city($id);
		if (count($data['item'])==0)
		{
			$this->session->set_flashdata('message','The city name could not be found!');
			$this->session->set_flashdata('message_type','warning');
			redirect($this->session->userdata('url'));
		}
		$data['item'] = $this->cities_model->get_city($id);
		$this->template->set_title('Edit City Name');
		$this->template->loadview('templates/default_admin','backend/cities/edit',$data);
	}
	public function update()
	{
		$data = array(
				'id' => strip_tags($this->input->post('id', TRUE)),
				'city_name' => 			strip_tags($this->input->post('city_name', TRUE)),
				'sorting' 	  	  => strip_tags($this->input->post('sorting',TRUE)),
				'modified_user_id' => 	$this->ion_auth->user()->row()->id,
				'modified_date' => 		date('Y-m-d H:i:s'),
				'status'	=> 			strip_tags($this->input->post('status', TRUE)),
		);
	
		$this->form_validation->set_rules('city_name', 'city name', 'required|callback_edit_unique['.$data['id'].']');
	
		if ($this->form_validation->run() == FALSE) {
			
			$data['item'] = $this->cities_model->get_city($data['id']);
			$this->template->set_title('Edit City Name');
			$this->template->loadview('templates/default_admin','backend/cities/edit',$data);
		}
		else
		{
			if($data['id']>0)
			{
				if($this->cities_model->update($data) > 0)
				{
					$this->session->set_flashdata('message','The city name updated successfully');
					$this->session->set_flashdata('message_type','success');
				}
				else
				{
					$this->session->set_flashdata('message','The city name updated could not be saved!');
					$this->session->set_flashdata('message_type','danger');
				}
			}
			redirect(base_url('admin/cities'));
		}
	}
	
	public function delete($id)
	{
		if (!$id){
			redirect(base_url('admin/cities/add'));
		}
		if($this->cities_model->delete($id) > 0)
		{
			$this->session->set_flashdata('message','The city name deleted successfully!');
			$this->session->set_flashdata('message_type','success');
		}
		else
		{
			$this->session->set_flashdata('message','The city name could not be deleted!');
			$this->session->set_flashdata('message_type','danger');
		}
		redirect(base_url('admin/cities'));
	}

}