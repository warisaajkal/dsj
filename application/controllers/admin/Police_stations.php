<?php defined('BASEPATH') or die('Restricted access');

class Police_stations extends Admin_Controller {
	
	public function __construct() {
		
		parent:: __construct();
		
		//load model
		$this->load->model('ps_model');
		$this->load->model('tehsils_model');
		$this->load->model('cities_model');
		
		// add urdu editor js file and script
		$this->template->add_hjs('assets/js/urdu-webpad.js');
		$this->template->add_js_script('initUrduEditor()');
	}
	
	public function formValues(){
		//define array
		$this->data = array(
				'id'				=> strip_tags($this->input->post('id', TRUE)),
				'ps_name' 			=> strip_tags($this->input->post('ps_name',TRUE)),
				'teh_id' 			=> strip_tags($this->input->post('teh_id',TRUE)),
				'city_id' 			=> strip_tags($this->input->post('city_id',TRUE)),
				'sorting' 	  	  => strip_tags($this->input->post('sorting',TRUE)),
				'created_user_id' 	=> $this->ion_auth->user()->row()->id,
				'created_date' 		=> date('Y-m-d H:i:s'),
				'modified_user_id' 	=> $this->ion_auth->user()->row()->id,
				'modified_date' 	=> date('Y-m-d H:i:s'),
				'status' 			=> strip_tags($this->input->post('status',TRUE)),
		);
	}
	
	public function index()
	{	
		// load css and js files for datatable		
		$this->template->add_css('assets/plugins/datatables/jquery.dataTables.min.css');
		$this->template->add_css('assets/plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css');

		$this->template->add_js('assets/plugins/datatables/jquery.dataTables.min.js');
		$this->template->add_js('assets/plugins/datatables/dataTables.bootstrap.js');
		$this->template->add_js('assets/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js');

		$data['all_ps'] = $this->ps_model->list_All();
		
		$this->template->set_title('Police Stations List');
		$this->template->loadview('templates/default_admin', 'backend/ps/list',$data);
	}
	
	public function add()
	{
		// get tehsils and cities list
		$data['tehsils'] = $this->tehsils_model->list_tehsils();
		$data['cities'] = $this->cities_model->list_cities();
		
		$this->template->set_title('Add New Police Station');
		$this->template->loadview('templates/default_admin' , 'backend/ps/add', $data);
	}
	
	public function save()
	{
		//$id = strip_tags($this->input->post('id',TRUE));
		
		$this->formValues();
		$data = $this->data;
				
		$this->form_validation->set_rules('ps_name', 'police station', 'required|callback_edit_unique['.$data['id'].']');
		$this->form_validation->set_rules('status', 'status', 'required');
		$this->form_validation->set_rules('city_id', 'city', 'required');
	
		if ($this->form_validation->run() == FALSE) {
			
			// get tehsils and cities list
			$data['tehsils'] = $this->tehsils_model->list_tehsils();
			$data['cities'] = $this->cities_model->list_cities();
			$data['ps'] = (object) $data;
			$this->template->set_title('Add New Police Station');
			$this->template->loadview('templates/default_admin' , 'backend/ps/add', $data);
		}
		else
		{
			if($this->ps_model->save($data) > 0)
			{
				$this->session->set_flashdata('message','New Police Stations Name Saved Successfully');
				$this->session->set_flashdata('message_type','success');
			}
			else
			{
				$this->session->set_flashdata('message','New Police Stations Name Could not be saved');
				$this->session->set_flashdata('message_type','danger');
			}
			redirect(base_url().'admin/police_stations');
		}
	
	}
	
	// check police station name
	function edit_unique($value, $id)
	{
		$this->form_validation->set_message('edit_unique','The ps name is already exist!');
		
		$this->formValues();
		$data = $this->data;
	
		$ps_lists = $this->ps_model->edit_unique($id);
		
		if ( array_key_exists ( $value, $ps_lists ) ) {
			
			if ( ($ps_lists[$value]->teh_id == $data['teh_id']) && ($ps_lists[$value]->city_id == $data['city_id']) ) {
				return false;	
			} 
			elseif (  ($ps_lists[$value]->city_id == $data['city_id'] ) && ( $ps_lists[$value]->teh_id == '0' ) )
			{
				return false;
			}
			
		} else {
			return true;
		}

		/* if (array_key_exists ( $value, $ps_lists ) && ($ps_lists[$value]->teh_id == $data['teh_id']) && ($ps_lists[$value]->city_id == $data['city_id']) ){
			
			return false;
			
		} elseif ( array_key_exists($value, $ps_lists) && ($ps_lists[$value]->teh_id == '0') && ($ps_lists[$value]->city_id == $data['city_id']) ) {
			
			return false;
				
		} else {
			return true;
		} */
	}
	
	public function edit($id)
	{
		if (!$id){
			redirect(base_url().'admin/police_stations');
		}
	
		$data['ps'] = $this->ps_model->get_ps($id);
		if (count($data['ps'])==0)
		{
			$this->session->set_flashdata('message','police station name could not be found!');
			$this->session->set_flashdata('message_type','warning');
			redirect($this->session->userdata('url'));
		}
		
		// get tehsils and cities list
		$data['tehsils'] = $this->tehsils_model->list_tehsils();
		$data['cities'] = $this->cities_model->list_cities();
		
		$data['ps'] = $this->ps_model->get_ps($id);
		$this->template->set_title('Edit Police Station');
		$this->template->loadview('templates/default_admin','backend/ps/edit',$data);
	}
	public function update()
	{
		//$id = strip_tags($this->input->post('id',TRUE));
		$this->formValues();
		$data = $this->data;
					
		$this->form_validation->set_rules('ps_name', 'police station', 'required|callback_edit_unique['.$data['id'].']');
		//$this->form_validation->set_rules('teh_id', 'tehsil', 'required');
		$this->form_validation->set_rules('city_id', 'city', 'required');
		$this->form_validation->set_rules('status', 'status', 'required');
	
		if ($this->form_validation->run() == FALSE) {
			
			$data['tehsils'] = $this->tehsils_model->list_tehsils();
			$data['cities'] = $this->cities_model->list_cities();
			
			$data['ps'] = $this->ps_model->get_ps($data['id']);
			$data['ps'] = (object) $data;
			
			$this->template->set_title('Edit Police Station Name');
			$this->template->loadview('templates/default_admin','backend/ps/edit', $data);
		}
		else
		{
			if($data['id']>0)
			{
				if($this->ps_model->update($data, $data['id']) > 0)
				{
					$this->session->set_flashdata('message','The police station name updated successfully');
					$this->session->set_flashdata('message_type','success');
				}
				else
				{
					$this->session->set_flashdata('message','The police station name could not be updated!');
					$this->session->set_flashdata('message_type','danger');
				}
			}
			redirect(base_url().'admin/police_stations');
		}
	}
	
	public function delete($id)
	{
		if (!$id){
			redirect(base_url().'admin/police_stations/add');
		}
		if($result = $this->ps_model->delete($id))
		{
			$this->session->set_flashdata('message','The police station name deleted successfully!');
			$this->session->set_flashdata('message_type','success');
		}
		else
		{
			$this->session->set_flashdata('message','The police station name could not be deleted!');
			$this->session->set_flashdata('message_type','danger');
		}
		redirect(base_url().'admin/police_stations');
	}

}