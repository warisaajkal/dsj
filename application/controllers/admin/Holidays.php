<?php defined('BASEPATH') or die('Restricted access');

class Holidays extends Admin_Controller {
	
	public function __construct() {
		
		parent:: __construct();
		// set timezone
		date_default_timezone_set('Asia/Karachi');
		
		//load model
		$this->load->model('holidays_model');
	
		// add css & js files for datepicker
		$this->template->add_css('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
		$this->template->add_js('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
	}
	
	public function index()
	{
		// load css and js files for datatable		
		$this->template->add_css('assets/plugins/datatables/jquery.dataTables.min.css');

		$this->template->add_js('assets/plugins/datatables/jquery.dataTables.min.js');
		$this->template->add_js('assets/plugins/datatables/dataTables.bootstrap.js');
		
		$data['events'] = $this->holidays_model->get_all_events();
		$this->template->set_title('List of Holidays');
		$this->template->loadview('templates/default_admin', 'backend/holidays/list',$data);
	}
	
	// get form data
	public function formData()
	{
		// define array for submit data
		$this->Data = array(
				'id' 		=> strip_tags($this->input->post('id', TRUE)),
				'date' 		=> strip_tags($this->input->post('date', TRUE)),
				'event' 	=> strip_tags($this->input->post('event', TRUE)),
				'sorting'	=> strip_tags($this->input->post('sorting',TRUE)),
				'status' 	=> strip_tags($this->input->post('status', TRUE)),
				'user_id' 	=> $this->ion_auth->user()->row()->id,
				'dateTime'	=> date('Y-m-d H:i:s'),
		);
		
		// define validation array
		$this->dataValidation = array(
				array(
						'field' => 'event',
						'label' => 'event',
						'rules' => 'required',
				),
				array(
						'field' => 'status',
						'label' => 'status',
						'rules' => 'required',
				),
		);
	}
	
	public function add()
	{
		$this->template->set_title('Add Event');
		$this->template->loadview('templates/default_admin' , 'backend/holidays/add');
	}
	
	public function save()
	{
		$this->formData();
		$data = $this->Data;
		$validate = $this->dataValidation;
	
		// set validation
		$this->form_validation->set_rules($validate);
		$this->form_validation->set_rules('date', 'date', 'required|callback_validate_date['.$data['id'].']');
	
		if ($this->form_validation->run() == FALSE)
		{
			$data['item'] = (object) $data;
	
			$this->template->set_title('Add Event');
			$this->template->loadview('templates/default_admin','backend/holidays/add', $data);
		}
		else
		{
			if($this->holidays_model->save($data) > 0)
			{
				$this->session->set_flashdata('message','Event have saved Successfully!');
				$this->session->set_flashdata('message_type','success');
			}
			else
			{
				$this->session->set_flashdata('message','Event could not be saved!');
				$this->session->set_flashdata('message_type','danger');
			}
			redirect( base_url('admin/holidays') );
		}
	}
	
	public function edit($id)
	{
		if (!$id){
			redirect(base_url('admin/holidays'));
		}
		$data['item'] = $this->holidays_model->get_event($id);
	
		if (count($data['item']) < 0)
		{
			$this->session->set_flashdata('message','This event could not be found!');
			$this->session->set_flashdata('message_type','warning');
			redirect(base_url('admin/holidays'));
		}
	
		$this->template->set_title('Edit Event');
		$this->template->loadview('templates/default_admin','backend/holidays/edit', $data);
	}
	
	public function update()
	{
		$this->formData();
		$data = $this->Data;
		$validate = $this->dataValidation;
	
		// set validation
		$this->form_validation->set_rules($validate);
		$this->form_validation->set_rules('date', 'date', 'required|callback_validate_date['.$data['id'].']');
	
		if ($this->form_validation->run() == FALSE)
		{
			$data['item'] = $this->holidays_model->get_event($data['id']);
			$data['item'] = (object) $data;
				
			$this->template->set_title('Edit Event');
			$this->template->loadview('templates/default_admin','backend/holidays/edit', $data);
		}
		else
		{
			if($data['id']>0)
			{
				if($this->holidays_model->update($data) > 0)
				{
					$this->session->set_flashdata('message','This event have updated Successfully!');
					$this->session->set_flashdata('message_type','success');
				}
				else
				{
					$this->session->set_flashdata('message','This event have could not updated!');
					$this->session->set_flashdata('message_type','danger');
				}
			}
			redirect(base_url('admin/holidays'));
		}
	}
	
	
	
	public function delete($id)
	{
		if (!$id){
			redirect(base_url('admin/holidays'));
		}
		if($this->holidays_model->delete($id) > 0)
		{
			$this->session->set_flashdata('message','This event deleted successfully!');
			$this->session->set_flashdata('message_type','success');
		}
		else
		{
			$this->session->set_flashdata('message','This event could not be deleted!');
			$this->session->set_flashdata('message_type','danger');
		}
		redirect(base_url('admin/holidays'));
	}
	
	// check date event validation
	public function validate_date($date, $id)
	{
		$date = @date('Y-m-d', @strtotime($date));
		
		
		
		$this->form_validation->set_message('validate_date','This event date already exists!');
	
		$dates = $this->holidays_model->validate_date($id);
		
		if (array_key_exists ( $date, $dates ))
		{
			return false;
		}
	}

}