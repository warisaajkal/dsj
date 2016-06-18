<?php defined('BASEPATH') or die('Restricted access');

class Search extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		// set timezone
		date_default_timezone_set('Asia/Karachi');
		
		// load courts model
		$this->load->model('courts_model');
		// load sessions cases categories model
		$this->load->model('categories_model');
		// load cases & cases list model 
		$this->load->model('cases_model');
		$this->load->model('cases_list_model');
		$this->load->model('ps_model');
		$this->load->model('search_model');
		
		// add css & js files for datepicker
		$this->template->add_css('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
		$this->template->add_js('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
	}
	
	public function index()
	{
		$data['courts'] = $this->courts_model->get_publish_courts_list();
		
		$criminal = 'criminal';
		$civil = 'civil';
		
		$data ['criminal'] = $this->categories_model->get_categories_by_case_type($criminal);
		$data ['civil'] = $this->categories_model->get_categories_by_case_type($civil);
		
		// load js file
		$this->template->add_js('assets/plugins/parsleyjs/dist/parsley.min.js');
		
		$this->template->set_title('Search Case');
		$this->template->loadview('templates/default', 'frontend/search/cases', $data);
		
	}
	// search case
	public function cases()
	{
		$data['courts'] = $this->courts_model->get_publish_courts_list();
		
		$criminal = 'criminal';
		$civil = 'civil';
		
		$data ['criminal'] = $this->categories_model->get_categories_by_case_type($criminal);
		$data ['civil'] = $this->categories_model->get_categories_by_case_type($civil);
		
		// load js file
		$this->template->add_js('assets/plugins/parsleyjs/dist/parsley.min.js');
		
		$this->template->set_title('Search Case');
		$this->template->loadview('templates/default', 'frontend/search/cases', $data);
	}
	// find searched cases
	public function find_cases()
	{
		// load css and js files for datatable
		$this->template->add_css('assets/plugins/footable/css/footable.core.css');
		$this->template->add_css('assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css');
		
		$this->template->add_js('assets/plugins/footable/js/footable.all.min.js');
		$this->template->add_js('assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js');
		$this->template->add_js('assets/pages/jquery.footable.js');
		
		$data ['court_id'] = strip_tags($this->input->post('court_id',TRUE));
		$data ['case_type'] = strip_tags($this->input->post('case_type',TRUE));
		if ($data['case_type'] == 'criminal' ) {
			$data ['cat_id'] = strip_tags($this->input->post('cr_cat_id',TRUE));
		}
		else 
		{
			$data ['cat_id'] = strip_tags($this->input->post('cv_cat_id',TRUE));
		}
		$data ['case_id'] = strip_tags($this->input->post('case_id',TRUE));
		$data ['cnic_no'] = strip_tags($this->input->post('cnic_no'));
		$data ['status'] = strip_tags($this->input->post('status'));
		
		$this->form_validation->set_rules('court_id', 'Court Name', 'required');
		$this->form_validation->set_rules('case_type', 'case type', 'required');
		$this->form_validation->set_rules('status', 'case status', 'required');
		
		if ( $this->form_validation->run() == FALSE ){
			
			$data['courts'] = $this->courts_model->get_publish_courts_list();
		
			$criminal = 'criminal';
			$civil = 'civil';
			
			$data ['criminal'] = $this->categories_model->get_categories_by_case_type($criminal);
			$data ['civil'] = $this->categories_model->get_categories_by_case_type($civil);
			
			$data['item'] = ( object ) $data;
			
			$this->template->set_title('Search Case');
			$this->template->loadview('templates/default', 'frontend/search/cases', $data);	
		}
		else 
		{
			
			$data['cases'] = $this->search_model->get_search_cases( $data );
			
			foreach ( $data ['cases'] as $case )
			{
				// get cases history
				$case->nprocs = $this->cases_list_model->get_nprocs_by_case_id ( $case->case_id );
				// get decision pdf files
				$case->decFiles	  = $this->cases_list_model->get_decision_files( $case->case_id );
			}
			
			// get court name by court id
			$data['court_by_user'] = $this->courts_model->get_court_name_by_id( $data['court_id'] );
			
			if ($data['case_type'] == 'criminal')
			{
				if ($data['status'] == 'proceeding')
				{
					$this->template->set_title('Criminal Case');
					$this->template->loadview('templates/default', 'frontend/search/criminal', $data);
				}
				else 
				{
					$this->template->set_title('Criminal Case');
					$this->template->loadview('templates/default', 'frontend/search/decided_criminal', $data);
				}
				
			}
			else 
			{
				if ($data['status'] == 'proceeding')
				{
					$this->template->set_title('Civil Case');
					$this->template->loadview('templates/default', 'frontend/search/civil', $data);
				}
				else 
				{
					$this->template->set_title('Civil Case');
					$this->template->loadview('templates/default', 'frontend/search/decided_civil', $data);
				}
				
			}
			
		}
		
	}
	
	// print single case detail by case id
	public function case_detail($id)
	{
		if (!$id) {
			$this->session->set_flashdata ( 'message', 'This case could not be found!' );
			$this->session->set_flashdata ( 'message_type', 'danger' );
			redirect(base_url());
		}
		else
		{
			// get court and case type by id
			$type = $this->cases_list_model->get_court_and_case_type_by_id($id);
				
			$data['cases'] = $this->cases_list_model->get_single_case_detail($id);
	
			foreach ( $data ['cases'] as $case )
			{
				// get cases history
				$case->nprocs = $this->cases_list_model->get_nprocs_by_case_id ( $case->case_id );
			}
		}
	
		$this->template->set_title ( 'Case Detail' );
	
		if ($type->case_type=='criminal')
		{
			$this->template->loadview('templates/default','backend/cases/cr_case_print',$data);
		}
		else
		{
			$this->template->loadview('templates/default','backend/cases/cv_case_print',$data);
		}
	}
	
	// get download case fiel
	public function download($filename) {
		//load the download helper
		$this->load->helper('download');
	
		$file = $this->cases_list_model->get_decision_file($filename);
	
		//application/views/uploads/decision
		$data = file_get_contents($file->full_path);
	
		//Read the file's contents
		$name = $file->file_name;
	
		//use this function to force the session/browser to download the file uploaded by the user
		force_download($name, $data);
	}	
}
