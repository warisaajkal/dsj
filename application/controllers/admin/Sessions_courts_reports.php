<?php defined('BASEPATH') or die('Restricted access');

class Sessions_courts_reports extends User_Authentication {
	
	public function __construct()
	{
		parent::__construct();
		//$this->output->enable_profiler(TRUE);
		// load courts name model
		$this->load->model('sessions_courts_model');
		// load sessions cases categories model
		$this->load->model('sessions_cats_model');
		// load sessions cases stages model
		$this->load->model('stages_sessions_model');
		//load police stations model
		$this->load->model('police_stations_model');
	
		// load civil and criminail cases model for sessions courts
		$this->load->model('sess_civils_cases_model');
		$this->load->model('sess_criminals_cases_model');
		
		// laod css and js files
		$this->template->add_css('assets/bootstrap-datepicker/css/bootstrap-datepicker.css');
		$this->template->add_hjs('assets/bootstrap-datepicker/js/bootstrap-datepicker.js');
	}
	
	/* sessions cr. appeals or miscellaneous cases */
	public function index()
	{		
		// valid court by assigned user
		$user_id= $this->ion_auth->user()->row()->id;
		$data['courts_by_user'] = $this->sessions_courts_model->get_courts_by_user($user_id);
		
		// get courts list
		$data['courts'] = $this->sessions_courts_model->get_courts_for_cases();
		//get cats of criminals
		$data['criminals']= $this->sessions_cats_model->get_criminals_for_cases();
		// get cats of civils
		$data['civils'] = $this->sessions_cats_model->get_civils_for_cases();
		
		$this->template->set_title('Cases List | Sessions Courts');
		$this->template->loadview('templates/default_admin', 'backend/sc_reports/sc_report', $data);
	}
	
	// get cases by date from to till
	public function get_report()
	{
		$data	= array
		(
				'court_id'		=> strip_tags($this->input->post('court_id',TRUE)),
				'startDate'		=> @date('Y-m-d',@strtotime($this->input->post('startDate',TRUE))),
				'endDate'		=> @date('Y-m-d',@strtotime($this->input->post('endDate',TRUE))),
				'cat_type'		=> strip_tags($this->input->post('cat_type',TRUE)),
				'cat_cr_id'		=> strip_tags($this->input->post('cat_cr_id',TRUE)),
				'cat_civil_id' 	=> strip_tags($this->input->post('cat_civil_id',TRUE)),
				'status'		=> strip_tags($this->input->post('status',TRUE))
		);

		
		//?court_id=2&startDate=01-01-2016&endDate=30-01-2016&cat_type=3&cat_cra_id=&cat_cr_id=&cat_civil_id=&status=proceeding
		//$this->session->set_userdata('edit_return',base_url('admin/sessions_courts_reports/get_report?court_id='.$data['cour_id']&'startDate='.$data['startDate']));
		
		$this->form_validation->set_rules('court_id', 'Court Name', 'required');
		$this->form_validation->set_rules('startDate', 'Date', 'required');
		$this->form_validation->set_rules('endDate', 'Date', 'required');
		
		if ($this->form_validation->run() == FALSE){
			// valid court by assigned user
			$user_id= $this->ion_auth->user()->row()->id;
			$data['courts_by_user'] = $this->sessions_courts_model->get_courts_by_user($user_id);
			
			// get courts list
			$data['courts'] = $this->sessions_courts_model->get_courts_for_cases();
			//get cats of criminals
			$data['criminals']= $this->sessions_cats_model->get_criminals_for_cases();
			// get cats of civils
			$data['civils'] = $this->sessions_cats_model->get_civils_for_cases();
			
			$this->template->set_title('Get Reports | Sessions Courts');
			$this->template->loadview('templates/default_admin', 'backend/sc_reports/sc_report', $data);
		}
		else
		{
			$data['court_by_select'] = $this->sessions_courts_model->get_court_by_select($data['court_id']);
		
			// get criminals cases by selected dates
			if ($data['cat_type'] == 'criminals') {
				$data['criminals']  = $this->sess_criminals_cases_model->get_cases_by_report($data);
				foreach($data['criminals'] as $case)
				{
					$case->nextProceeding = $this->sess_criminals_cases_model->get_next_pro($case->case_id);
					$case->transfer_court = $this->sess_criminals_cases_model->get_transfer_court_name($case->trf_court_id);
				}
			}
			// get civils cases by selected dates and category
			if ($data['cat_type'] == 'civils') {
			$data['civils'] = $this->sess_civils_cases_model->get_cases_by_report($data);
				foreach($data['civils'] as $case)
				{
					$case->nextProceeding = $this->sess_civils_cases_model->get_next_pro($case->case_id);
					$case->transfer_court = $this->sess_civils_cases_model->get_transfer_court_name($case->trf_court_id);
				}
			}
		
			// load css and js for table
			$this->template->add_css('assets/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css');
			$this->template->add_css('assets/datatables-responsive/css/dataTables.responsive.css');
			$this->template->add_js('assets/datatables/media/js/jquery.dataTables.min.js');
			$this->template->add_js('assets/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js');
			$this->template->add_css('assets/css/custom-style.css');
			
			if ($data['status']=='proceeding'){
				$this->template->set_title('Pending Cases | Sessions Courts');
				$this->template->loadview('templates/default_admin','backend/sc_reports/pending_cases',$data);
			}
			if ($data['status']=='decided'){
				$this->template->set_title('Decided Cases | Sessions Courts');
				$this->template->loadview('templates/default_admin','backend/sc_reports/decided_cases',$data);
			}
		}
	}
	
	public function select_cat()
	{
		// valid court by assigned user
		$user_id= $this->ion_auth->user()->row()->id;
		$data['courts_by_user'] = $this->sessions_courts_model->get_courts_by_user($user_id);
		
		// get courts list
		$data['courts'] = $this->sessions_courts_model->get_courts_for_cases();
		//get cats of criminals
		$data['criminals']= $this->sessions_cats_model->get_criminals_for_cases();
		// get cats of civils
		$data['civils'] = $this->sessions_cats_model->get_civils_for_cases();
		
		$this->template->set_title('Cases List | Sessions Courts');
		$this->template->loadview('templates/default_admin', 'backend/sc_reports/sc_report', $data);
		
	}
	
	public function get_cases_by_cats()
	{
		
	}
	
}