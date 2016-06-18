<?php
defined('BASEPATH') or die('Restricted access');

class Categories extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		// set timezone
		date_default_timezone_set('Asia/Karachi');
		
		// Categories model
		$this->load->model('categories_model');
	}
	
	// categories list
	public function index()
	{
		// load css and js files for datatable		
		$this->template->add_css('assets/plugins/datatables/jquery.dataTables.min.css');

		$this->template->add_js('assets/plugins/datatables/jquery.dataTables.min.js');
		$this->template->add_js('assets/plugins/datatables/dataTables.bootstrap.js');
	
		$data['cats'] = $this->categories_model->get_categories();
		$this->template->set_title('Categories');
		$this->template->loadview('templates/default_admin','backend/cats/index',$data);
	}
	// get form data
	public function formData()
	{
		// define array for submit data
		$this->Data = array(
				'id'			  => strip_tags($this->input->post('id',TRUE)),
				'cat_name' 		  => strip_tags($this->input->post('cat_name',TRUE)),
				'cat_reg_no' 	  => strip_tags($this->input->post('cat_reg_no',TRUE)),
				'court_type' 	  => strip_tags($this->input->post('court_type',TRUE)),
				'case_type' 	  => strip_tags($this->input->post('case_type',TRUE)),
				'sorting' 	  	  => strip_tags($this->input->post('sorting',TRUE)),
				'status' 		  => strip_tags($this->input->post('status',TRUE)),
				'user_id' 		  => $this->ion_auth->user()->row()->id,
				'dateTime'	      => date('Y-m-d H:i:s'),
		);
		
		// define validation array
		$this->dataValidation = array(
// 				array(
// 						'field' => 'cat_name',
// 						'label' => 'category name',
// 						'rules' => 'required',
// 				),
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
	
	// *add category of criminals sc*
	public function add()
	{
		$this->template->set_title('Add Category');
		$this->template->loadview('templates/default_admin','backend/cats/add');
	}
	public function save()
	{
		$this->formData();
		$data = $this->Data;
		$validate = $this->dataValidation;
		
		// set validation
		$this->form_validation->set_rules($validate);
		$this->form_validation->set_rules('cat_name', 'category', 'required|callback_validate_category_name['.$data['id'].']');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['cat'] = (object) $data;
	
			$this->template->set_title('Add Category');
			$this->template->loadview('templates/default_admin','backend/cats/add', $data);
		}
		else
		{
			if($this->categories_model->save($data) > 0)
			{
				$this->session->set_flashdata('message','Category have saved Successfully!');
				$this->session->set_flashdata('message_type','success');
			}
			else
			{
				$this->session->set_flashdata('message','Category could not be saved!');
				$this->session->set_flashdata('message_type','danger');
			}
			redirect( base_url('admin/categories') );
		}
	}
	public function edit($id)
	{
		if (!$id){
			redirect(base_url('admin/categories'));
		}
		$data['cat'] = $this->categories_model->get_cat($id);
		
		if (count($data['cat']) < 0)
		{
			$this->session->set_flashdata('message','This category could not be found!');
			$this->session->set_flashdata('message_type','warning');
			redirect(base_url('admin/categories'));
		}
		
		$this->template->set_title('Edit Category');
		$this->template->loadview('templates/default_admin','backend/cats/edit', $data);
	}
	public function update()
	{
		$this->formData();
		$data = $this->Data;
		$validate = $this->dataValidation;
		
		// set validation
		$this->form_validation->set_rules($validate);
		$this->form_validation->set_rules('cat_name', 'category', 'required|callback_validate_category_name['.$data['id'].']');
	
		if ($this->form_validation->run() == FALSE) {
	
			$data['cat'] = $this->categories_model->get_cat($data['id']);
			$data['cat'] = (object) $data;
			
			$this->template->set_title('Edit Category');
			$this->template->loadview('templates/default_admin','backend/cats/edit', $data);
		}
		else
		{
			if($data['id']>0)
			{
				if($this->categories_model->update($data) > 0)
				{
					$this->session->set_flashdata('message','This category have updated Successfully!');
					$this->session->set_flashdata('message_type','success');
				}
				else
				{
					$this->session->set_flashdata('message','This category have could not updated!');
					$this->session->set_flashdata('message_type','danger');
				}
			}
			redirect(base_url('admin/categories'));
		}
	}
	public function delete($id)
	{
		if (!$id){
			redirect(base_url('admin/categories'));
		}
		if($this->categories_model->delete($id) > 0)
		{
			$this->session->set_flashdata('message','This category have deleted Successfully!');
			$this->session->set_flashdata('message_type','success');
		}
		else
		{
			$this->session->set_flashdata('message','This category could not be deleted!');
			$this->session->set_flashdata('message_type','danger');
		}
		redirect(base_url().'admin/categories');
	}

	// * check uniqeu category name
	public function validate_category_name($name, $id)
	{
		// form submit data
		$this->formData();
		$data = $this->Data;
			
		$this->form_validation->set_message('validate_category_name','This category is already exist!');
	
		$cats = $this->categories_model->validate_category_name($id);
		
		foreach ( $cats as $key => $value )
		{
			if (( ($value->cat_name == $name) && ($value->court_type == $data['court_type']) && ($value->case_type == $data['case_type']) ))
			{
				return false;
			}
		}
		
// 		
	
// 		if (array_key_exists ( $name, $cats )) {
// 			return false;
// 		}
	}
		
}