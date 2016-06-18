<?php
defined('BASEPATH') or die('Restricted access');

class Stages extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		// set timezone
		date_default_timezone_set('Asia/Karachi');
		
		// stages model
	//	$this->load->model('courts_model');
		$this->load->model('stages_model');
		
		// laod urdu editor js file & script
		$this->template->add_hjs('assets/js/urdu-webpad.js');
		$this->template->add_js_script('initUrduEditor()');
	}
	
	// stages list
	public function index()
	{
		// load css and js files for datatable		
		$this->template->add_css('assets/plugins/datatables/jquery.dataTables.min.css');

		$this->template->add_js('assets/plugins/datatables/jquery.dataTables.min.js');
		$this->template->add_js('assets/plugins/datatables/dataTables.bootstrap.js');
		
		$data['stages'] = $this->stages_model->get_stages();
		
		$this->template->set_title('Stages');
		$this->template->loadview('templates/default_admin','backend/stages/index',$data);
	}
	
	// get form data
	public function formData()
	{
		// define array for submit data
		$this->Data = array(
				'id'			=> strip_tags($this->input->post('id',TRUE)),
				'stage_name'	=> strip_tags($this->input->post('stage_name',TRUE)),
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
	
	// *add stage 
	public function add()
	{	
		$this->template->set_title('Add Stage');
		$this->template->loadview('templates/default_admin','backend/stages/add');
	}
	public function save()
	{
		$this->formData();
		$data = $this->Data;
		$validate = $this->dataValidation;
		
		// set validation
		$this->form_validation->set_rules($validate);
		$this->form_validation->set_rules('stage_name', 'stage name', 'required|callback_validate_stage_name['.$data['id'].']');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['stage'] = (object) $data;
	
			$this->template->set_title('Add Stage');
			$this->template->loadview('templates/default_admin','backend/stages/add', $data);
		}
		else
		{
			if($this->stages_model->save($data) > 0)
			{
				$this->session->set_flashdata('message','Stage have saved Successfully!');
				$this->session->set_flashdata('message_type','success');
			}
			else
			{
				$this->session->set_flashdata('message','Stage could not be saved!');
				$this->session->set_flashdata('message_type','danger');
			}
			redirect( base_url('admin/stages') );
		}
	}
	public function edit($id)
	{
		if (!$id){
			redirect(base_url('admin/stages'));
		}
		$data['stage'] = $this->stages_model->get_stage($id);
		
		if (count($data['stage']) < 0)
		{
			$this->session->set_flashdata('message','This stage could not be found!');
			$this->session->set_flashdata('message_type','warning');
			redirect(base_url('admin/stages'));
		}
		
		$this->template->set_title('Edit Stage');
		$this->template->loadview('templates/default_admin','backend/stages/edit', $data);
	}
	public function update()
	{
		$this->formData();
		$data = $this->Data;
		$validate = $this->dataValidation;
		
		// set validation
		$this->form_validation->set_rules($validate);
		$this->form_validation->set_rules('stage_name', 'stage name', 'required|callback_validate_stage_name['.$data['id'].']');
	
		if ($this->form_validation->run() == FALSE)
		{
			$data['stage'] = $this->stages_model->get_stage($data['id']);
			$data['stage'] = (object) $data;
			
			$this->template->set_title('Edit Stage');
			$this->template->loadview('templates/default_admin','backend/stages/edit', $data);
		}
		else
		{
			if($data['id']>0)
			{
				if($this->stages_model->update($data) > 0)
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
			redirect(base_url('admin/stages'));
		}
	}
	public function delete($id)
	{
		if (!$id){
			redirect(base_url('admin/stages'));
		}
		if($this->stages_model->delete($id) > 0)
		{
			$this->session->set_flashdata('message','This stage have deleted Successfully!');
			$this->session->set_flashdata('message_type','success');
		}
		else
		{
			$this->session->set_flashdata('message','This stage could not be deleted!');
			$this->session->set_flashdata('message_type','danger');
		}
		redirect(base_url().'admin/stages');
	}

	// * check uniqeu stage name
	public function validate_stage_name($name, $id)
	{
		// form submit data
		$this->formData();
		$data = $this->Data;
		
// 		echo '<pre>';
// 		var_dump($data);
// 		die();
			
		$this->form_validation->set_message('validate_stage_name','This stage is already exist!');
	
		$stages = $this->stages_model->validate_stage_name($id);
		
		foreach ( $stages as $key => $value )
		{
			if (( ($value->stage_name == $name) && ($value->court_type == $data['court_type']) && ($value->case_type == $data['case_type']) ))
			{
				return false;
			}
		}
	}
		
}