<?php defined('BASEPATH') or die('Restricted access');

class Sc_case_history extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
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
	}
	
	/* sessions cr. appeals or miscellaneous cases */
	public function index()
	{	
		// get courts list
		$data['courts'] = $this->sessions_courts_model->get_courts_for_cases();
		//get cats of criminals
		$data['criminals']= $this->sessions_cats_model->get_criminals_for_cases();
		// get cats of civils
		$data['civils'] = $this->sessions_cats_model->get_civils_for_cases();
		
		$this->template->set_title('Get Reports | Sessions Courts');
		$this->template->loadview('templates/default', 'frontend/case_history/sc/sc_case', $data);
	}
	
	// get cases by date from to till
	public function get_cases()
	{
		$data	= array
			(
				'court_id'		=> strip_tags($this->input->post('court_id',TRUE)),
				'cat_type'		=> strip_tags($this->input->post('cat_type',TRUE)),
				'cat_cr_id'		=> strip_tags($this->input->post('cat_cr_id',TRUE)),
				'cat_civil_id' 	=> strip_tags($this->input->post('cat_civil_id',TRUE)),
				'reg_no'		=> strip_tags($this->input->post('reg_no', TRUE)), 
				'status'		=> strip_tags($this->input->post('status',TRUE))
			);
		
		// set validation
		$this->form_validation->set_rules('court_id', 'court name', 'required');
				
		if ($this->form_validation->run() == FALSE ) {
			// get courts list
			$data['courts'] = $this->sessions_courts_model->get_courts_for_cases();
			//get cats of criminals
			$data['criminals']= $this->sessions_cats_model->get_criminals_for_cases();
			// get cats of civils
			$data['civils'] = $this->sessions_cats_model->get_civils_for_cases();
			
			$this->template->set_title('Search Case | Sessions Courts');
			$this->template->loadview('templates/default', 'frontend/case_history/sc/sc_case', $data);
		}
		else
		
		{
			$data['court_by_select'] = $this->sessions_courts_model->get_court_by_select($data['court_id']);
		
			// get criminals cases
			if ($data['cat_type'] == 'criminals') {
				$data['criminals']  = $this->sess_criminals_cases_model->get_cases_by_reg_no($data);
				foreach($data['criminals'] as $case)
				{
					$case->nextProceeding = $this->sess_criminals_cases_model->get_next_pro($case->case_id);
					$case->transfer_court = $this->sess_criminals_cases_model->get_transfer_court_name($case->trf_court_id);
				}
			}

			// get civils cases
			if ($data['cat_type'] == 'civils') {
			$data['civils'] = $this->sess_civils_cases_model->get_cases_by_reg_no($data);
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
				$this->template->loadview('templates/default','frontend/case_history/sc/pending_cases',$data);
			}
			if ($data['status']=='decided'){
				$this->template->set_title('Decided Cases | Sessions Courts');
				$this->template->loadview('templates/default','frontend/case_history/sc/decided_cases',$data);
			}
		}
	}
	
}