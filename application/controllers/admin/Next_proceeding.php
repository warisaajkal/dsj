<?php
defined('BASEPATH') or die('Restricted access');

class Next_proceeding extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		// set timezone
		date_default_timezone_set('Asia/Karachi');
		
		// next proceeding model
		$this->load->model('next_proceeding_model');
		
		// laod urdu editor js file & script
		$this->template->add_hjs('assets/js/urdu-webpad.js');
		$this->template->add_js_script('initUrduEditor()');
	}
	
	// next proceeding list
	public function index()
	{
		// load css and js files for datatable		
		$this->template->add_css('assets/plugins/datatables/jquery.dataTables.min.css');

		$this->template->add_js('assets/plugins/datatables/jquery.dataTables.min.js');
		$this->template->add_js('assets/plugins/datatables/dataTables.bootstrap.js');
	
		$data['nprocs'] = $this->next_proceeding_model->get_next_proceedings();
		$this->template->set_title('Next Proceeding List');
		$this->template->loadview('templates/default_admin','backend/next_proceeding/index',$data);
	}
	// get form data
	public function formData()
	{
		// define array for submit data
		$this->Data = array(
				'id'			=> strip_tags($this->input->post('id',TRUE)),
				'nproc_name'	=> strip_tags($this->input->post('nproc_name',TRUE)),
				'court_type'	=> strip_tags($this->input->post('court_type',TRUE)),
				'case_type'		=> strip_tags($this->input->post('case_type',TRUE)),
				'sorting'		=> strip_tags($this->input->post('sorting',TRUE)),
				'status'		=> strip_tags($this->input->post('status',TRUE)),
				'user_id'		=> $this->ion_auth->user()->row()->id,
				'dateTime'		=> date('Y-m-d H:i:s'),
		);
		
		// define validation array
		$this->dataValidation = array(
				array(
						'field' => 'court_type',
						'label' => 'court type',
						'rules' => 'required',
				),
				array(
						'field' => 'case_type',
						'label' => 'case type',
						'rules' => 'required',
				),
				array(
						'field' => 'status',
						'label' => 'status',
						'rules' => 'required',
				),				
		);
	}
	
	// *add next proceeding 
	public function add()
	{
		$this->template->set_title('Add Next Proceeding');
		$this->template->loadview('templates/default_admin','backend/next_proceeding/add');
	}
	public function save()
	{
		$this->formData();
		$data = $this->Data;
		$validate = $this->dataValidation;
		
		// set validation
		$this->form_validation->set_rules($validate);
		$this->form_validation->set_rules('nproc_name', 'next proceeding name', 'required|callback_validate_nproc_name['.$data['id'].']');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['nproc'] = (object) $data;
	
			$this->template->set_title('Add Next Proceeding');
			$this->template->loadview('templates/default_admin','backend/next_proceeding/add', $data);
		}
		else
		{
			if($this->next_proceeding_model->save($data) > 0)
			{
				$this->session->set_flashdata('message','Next proceeding have saved Successfully!');
				$this->session->set_flashdata('message_type','success');
			}
			else
			{
				$this->session->set_flashdata('message','Next proceeding could not be saved!');
				$this->session->set_flashdata('message_type','danger');
			}
			redirect( base_url('admin/next_proceeding') );
		}
	}
	public function edit($id)
	{
		if (!$id){
			redirect(base_url('admin/next_proceeding'));
		}
		$data['nproc'] = $this->next_proceeding_model->get_next_proceeding($id);
		
		if (count($data['nproc']) < 0)
		{
			$this->session->set_flashdata('message','This next proceeding could not be found!');
			$this->session->set_flashdata('message_type','warning');
			redirect(base_url('admin/next_proceeding'));
		}
		
		$this->template->set_title('Edit Next Proceeding');
		$this->template->loadview('templates/default_admin','backend/next_proceeding/edit', $data);
	}
	public function update()
	{
		$this->formData();
		$data = $this->Data;
		$validate = $this->dataValidation;
		
		// set validation
		$this->form_validation->set_rules($validate);
		$this->form_validation->set_rules('nproc_name', 'next proceeding name', 'required|callback_validate_nproc_name['.$data['id'].']');
	
		if ($this->form_validation->run() == FALSE) {
	
			$data['nproc'] = $this->next_proceeding_model->get_next_proceeding($data['id']);
			$data['nproc'] = (object) $data;
			
			$this->template->set_title('Edit Next Proceeding');
			$this->template->loadview('templates/default_admin','backend/next_proceeding/edit', $data);
		}
		else
		{
			if($data['id']>0)
			{
				if($this->next_proceeding_model->update($data) > 0)
				{
					$this->session->set_flashdata('message','This next proceeding have updated Successfully!');
					$this->session->set_flashdata('message_type','success');
				}
				else
				{
					$this->session->set_flashdata('message','This next proceeding have could not updated!');
					$this->session->set_flashdata('message_type','danger');
				}
			}
			redirect(base_url('admin/next_proceeding'));
		}
	}
	public function delete($id)
	{
		if (!$id){
			redirect(base_url('admin/next_proceeding'));
		}
		if($this->next_proceeding_model->delete($id) > 0)
		{
			$this->session->set_flashdata('message','This next proceeding have deleted Successfully!');
			$this->session->set_flashdata('message_type','success');
		}
		else
		{
			$this->session->set_flashdata('message','This next proceeding could not be deleted!');
			$this->session->set_flashdata('message_type','danger');
		}
		redirect(base_url().'admin/next_proceeding');
	}

	// * check uniqeu next proceeding name
	public function validate_nproc_name($name, $id)
	{
		// form submit data
		$this->formData();
		$data = $this->Data;
			
		$this->form_validation->set_message('validate_nproc_name','This next proceeding is already exist!');
	
		$nprocs = $this->next_proceeding_model->validate_nproc_name($id);
		
		foreach ( $nprocs as $key => $value )
		{
			if (( ($value->nproc_name == $name) && ($value->court_type == $data['court_type']) && ($value->case_type == $data['case_type']) ))
			{
				return false;
			}
		}
	}
		
}