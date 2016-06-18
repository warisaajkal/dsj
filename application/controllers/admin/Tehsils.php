<?php defined('BASEPATH') or die('Restricted access');

class Tehsils extends Admin_Controller {
	
	public function __construct() {
		
		parent:: __construct();
		
		// set timezone
		date_default_timezone_set('Asia/Karachi');
		
		//load model
		$this->load->model('tehsils_model');
		$this->load->model('cities_model');
		
		// add urdu editor js file and script
		$this->template->add_hjs('assets/js/urdu-webpad.js');
		$this->template->add_js_script('initUrduEditor()');
	}
	
	public function index()
	{
		// load css and js files for datatable		
		$this->template->add_css('assets/plugins/datatables/jquery.dataTables.min.css');
		$this->template->add_css('assets/plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css');

		$this->template->add_js('assets/plugins/datatables/jquery.dataTables.min.js');
		$this->template->add_js('assets/plugins/datatables/dataTables.bootstrap.js');
		$this->template->add_js('assets/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js');
		
		$data['tehsils'] = $this->tehsils_model->tehsils();
		$this->template->set_title('Tehsils List');
		$this->template->page_title('Tehsils List District Wise');
		$this->template->loadview('templates/default_admin', 'backend/tehsils/list',$data);
	}
	
	public function add()
	{	
		// list cities
		$data['cities'] = $this->cities_model->list_cities();
		
		$this->template->set_title('Add Tehsil Name');
		$this->template->loadview('templates/default_admin' , 'backend/tehsils/add', $data);
	}
	
	public function save()
	{
		$data = array(
				'id' => strip_tags($this->input->post('id', TRUE)),
				'teh_name' => strip_tags($this->input->post('teh_name', TRUE)),
				'city_id' => strip_tags($this->input->post('city_id', TRUE)),
				'sorting' 	  	  => strip_tags($this->input->post('sorting',TRUE)),
				'created_user_id' => $this->ion_auth->user()->row()->id,
				'created_date' => date('Y-m-d H:i:s'),
				'status' => strip_tags($this->input->post('status', TRUE)),
		);
	
		$this->form_validation->set_rules('teh_name', 'tehsil', 'required|is_unique[tehsils.teh_name]');
		$this->form_validation->set_rules('city_id', 'city', 'required');
	
		if ($this->form_validation->run() == FALSE) {
			
			$data['item'] = (object) $data;
			$data['cities'] = $this->cities_model->list_cities();
			$this->template->set_title('Add Tehsil Name');
			$this->template->loadview('templates/default_admin' , 'backend/tehsils/add', $data);
		}
		else
		{
			if($this->tehsils_model->save($data) > 0)
			{
				$this->session->set_flashdata('message','The Tehsil name saved successfully');
				$this->session->set_flashdata('message_type','success');
			}
			else
			{
				$this->session->set_flashdata('message','The Tehsil name could bot be saved!');
				$this->session->set_flashdata('message_type','danger');
			}
			redirect(base_url().'admin/tehsils');
		}
	
	}
	
	// * check validation on update
	function edit_unique($curnt_Value, $id)
	{
		$this->form_validation->set_message('edit_unique','The tehsil name is already exist!');
	
		$tehsils = $this->tehsils_model->edit_unique($id);
		
		foreach ($tehsils as $key => $Value)
		{
			$tehsils[$key] = $Value->teh_name;
		}

		foreach ($tehsils as $tehsil)
		{
			if ($curnt_Value == $tehsil )
			{
				return FALSE;
			}
		}
	}
	
	public function edit($id)
	{
		if (!$id){
			redirect('admin/tehsils', 'refresh');
		}
		else 
		{
			$data['item'] = $this->tehsils_model->get_tehsil($id);
			
			if (count($data['item'])== 0)
			{
				
				$this->session->set_flashdata('message','The tehsil name could not be found!!!');
				$this->session->set_flashdata('message_type','info');
				redirect('admin/tehsils', 'refresh');
				
			}
			else
			{
				
				$data['cities'] = $this->cities_model->list_cities();
				$data['item'] = $this->tehsils_model->get_tehsil($id);
				$this->template->set_title('Edit Tehsil Name');
				$this->template->loadview('templates/default_admin','backend/tehsils/edit', $data);
			
			}	
		}
	}
	public function update()
	{
		$data = array(
				'id' => strip_tags($this->input->post('id', TRUE)),
				'teh_name' => 			strip_tags($this->input->post('teh_name', TRUE)),
				'city_id' => 			strip_tags($this->input->post('city_id', TRUE)),
				'sorting' 	  	  => strip_tags($this->input->post('sorting',TRUE)),
				'modified_user_id' => 	$this->ion_auth->user()->row()->id,
				'modified_date' => 		date('Y-m-d H:i:s'),
				'status'	=> 			strip_tags($this->input->post('status', TRUE)),
		);
			
		$this->form_validation->set_rules('teh_name', 'tehsil name', 'required|callback_edit_unique['.$data['id'].']');
		$this->form_validation->set_rules('city_id', 'city', 'required');
	
		if ($this->form_validation->run() == FALSE) {
			$data['cities'] = $this->cities_model->list_cities();
			$data['item'] = $this->tehsils_model->get_tehsil($data['id']);
			$data['item'] = (object) $data;
			$this->template->set_title('Edit City Name');
			$this->template->loadview('templates/default_admin','backend/tehsils/edit',$data);
		}
		else
		{
			if($data['id'] > 0)
			{
				
				if($this->tehsils_model->update($data) > 0)
				{
					$this->session->set_flashdata('message','The tehsil name updated successfully');
					$this->session->set_flashdata('message_type','success');
				}
				else
				{
					$this->session->set_flashdata('message','The tehsil name updated could not be saved!');
					$this->session->set_flashdata('message_type','danger');
				}
			}
			redirect(base_url('admin/tehsils'));
		}
	}
	
	public function delete($id)
	{
		if (!$id){
			redirect(base_url('admin/tehsils/add'));
		}
		if($this->tehsils_model->delete($id) > 0)
		{
			$this->session->set_flashdata('message','The tehsil name deleted successfully!');
			$this->session->set_flashdata('message_type','success');
		}
		else
		{
			$this->session->set_flashdata('message','The tehsil name could not be deleted!');
			$this->session->set_flashdata('message_type','danger');
		}
		redirect(base_url('admin/tehsils'));
	}

}