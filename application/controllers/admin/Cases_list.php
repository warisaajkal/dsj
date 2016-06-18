<?php defined('BASEPATH') or die('Restricted access');

class Cases_list extends Members {

	public function __construct()
	{
		parent::__construct();
		// set timezone
		date_default_timezone_set('Asia/Karachi');

		// load courts model
		$this->load->model('courts_model');
		
		// load categories of cases model
		$this->load->model('categories_model');
		
		//load police stations model
		$this->load->model('ps_model');

		// load next proceeding model
		$this->load->model('next_proceeding_model');

		// load stages model
		$this->load->model('stages_model');

		// load add cases model
		$this->load->model('cases_list_model');
		
		// load css and js files for datatable
		$this->template->add_css('assets/plugins/footable/css/footable.core.css');
		$this->template->add_css('assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css');
		
		$this->template->add_css('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
// 		$this->template->add_css('assets/plugins/bootstrap-daterangepicker/daterangepicker.css');
		
		$this->template->add_js('assets/plugins/footable/js/footable.all.min.js');
		$this->template->add_js('assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js');
		$this->template->add_js('assets/pages/jquery.footable.js');
		
		$this->template->add_js('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
// 		$this->template->add_js('assets/plugins/bootstrap-daterangepicker/daterangepicker.js');
		
	}

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
		
		$this->template->set_title('Cases List');
		$this->template->loadview('templates/default_admin','backend/cases/cases_list',$data);
	}
	
	public function get_cases()
	{
		$data = array(
			'court_id'	=> $this->input->post('court_id',TRUE),
			'case_type'	=> $this->input->post('case_type', TRUE),
			'start'		=> $this->input->post('start', TRUE),
			'end'		=> $this->input->post('end', TRUE),
			'status'	=> $this->input->post('status',TRUE),
			'transfer'  => $this->input->post('transfer',TRUE),
		);
		
		$this->form_validation->set_rules('court_id', 'court name', 'required');
		$this->form_validation->set_rules('case_type', 'case type', 'required');
		$this->form_validation->set_rules('status', 'case status', 'required');
		
		if ($this->form_validation->run() == FALSE )
		{
			if ($this->ion_auth->is_Admin())
			{
				$data['courts'] = $this->courts_model->get_publish_courts_list();
			}
			else
			{
				// get courts to assigned login user
				$loginUser = $this->ion_auth->user()->row()->id;
				$data['courts'] = $this->courts_model->get_court_names_by_login_user( $loginUser );
			}	
			
			$this->template->set_title('Cases List');
			$this->template->loadview('templates/default_admin','backend/cases/cases_list',$data);
		}
		else 
		{
			$data['start'] = @date('Y-m-d', @strtotime( $data['start'] ));
			$data['end'] = @date('Y-m-d', @strtotime( $data['end'] ));
			
			$data['court_name'] = $this->courts_model->get_court_name_by_id( $data['court_id'] );
			
			$data ['cases'] = $this->cases_list_model->get_cases_by_court_id ( $data );
			
			foreach ( $data ['cases'] as $case )
			{
				// get cases history
				$case->nprocs = $this->cases_list_model->get_nprocs_by_case_id ( $case->case_id );
						
				// get decision pdf files
				$case->decFiles	  = $this->cases_list_model->get_decision_files( $case->case_id );
			}

			if ( $data['status'] == 'proceeding' )
			{
				if ( $data['case_type'] == 'criminal' )
				{
					$this->template->set_title ( 'Pendency of Criminal Cases' );
					$this->template->loadview('templates/default_admin','backend/cases/criminal',$data);
				}
				else 
				{
					$this->template->set_title ( 'Pendency of Civil Cases' );
					$this->template->loadview('templates/default_admin','backend/cases/civil',$data);
				}

			}
			elseif ( $data['status'] == 'decided' )
			{
				if ( $data['case_type'] == 'criminal' )
				{
					$this->template->set_title ( 'Decided Criminal Cases' );
					$this->template->loadview('templates/default_admin','backend/cases/decided_criminal',$data);
				}
				else
				{
					$this->template->set_title ( 'Decided Civil Cases' );
					$this->template->loadview('templates/default_admin','backend/cases/decided_civil',$data);
				}
			}
			else 
			{
				if ( $data['case_type'] == 'criminal' )
				{
					$this->template->set_title ( 'Transfer Criminal Cases' );
					$this->template->loadview('templates/default_admin','backend/cases/trf_criminal',$data);
				}
				else
				{
					$this->template->set_title ( 'Transfer Civil Cases' );
					$this->template->loadview('templates/default_admin','backend/cases/trf_civil',$data);
				}
				
			}
			
		}
		
	}
	
	public function trf_cases()
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
	
		$this->template->set_title('Cases List');
		$this->template->loadview('templates/default_admin','backend/cases/index_trf',$data);
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
	
	public function del_uploaded_file($filename) {
		
		if (!$filename) {
			
			$this->session->set_flashdata('message','This file could not be found!');
			$this->session->set_flashdata('message_type','warning');
			
			redirect( base_url('admin/cases_list') );
		}
		else 
		{
			if ($this->cases_list_model->del_uploaded_file($filename) > 0 )
			{
				$this->session->set_flashdata('message','This file have been deleted!');
				$this->session->set_flashdata('message_type','success');
			}
		}
		 
		redirect( base_url('admin/cases_list') );
	}
	
	// print single case detail by case id 
	public function case_detail($id)
	{
		if (!$id) {
			$this->session->set_flashdata ( 'message', 'This case could not be found!' );
			$this->session->set_flashdata ( 'message_type', 'danger' );
			redirect(base_url('admin/cases_list/sc_cr_cases'));
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
			$this->template->loadview('templates/default_admin','backend/cases/cr_case_print',$data);	
		}
		else 
		{
			$this->template->loadview('templates/default_admin','backend/cases/cv_case_print',$data);
		}
	}
	
}