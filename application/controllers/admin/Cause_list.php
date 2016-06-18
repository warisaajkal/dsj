<?php defined('BASEPATH') or die('Restricted access');

class Cause_list extends Members {
	
	public function __construct()
	{
		parent::__construct();
		// set timezone
		date_default_timezone_set('Asia/Karachi');
		
		// load courts name model
		$this->load->model('courts_model');
		
		// load cause list model
		$this->load->model('cause_list_model');
		
		//load config file
		$this->config->load('week_days');
		
		// add css & js files for datepicker
		$this->template->add_css('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
		$this->template->add_js('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
	}
	
	public function index()
	{
		// dropdown list courts name
		if (!$this->ion_auth->is_Admin())
		{
			$loginUser = $this->ion_auth->user()->row()->id;
			$data['courts'] = $this->courts_model->get_court_names_by_login_user($loginUser);
		}
		else 
		{
			$data['courts'] = $this->courts_model->get_publish_courts_list();
		}
		
		$this->template->set_title('Cause List');
		$this->template->loadview('templates/default_admin', 'backend/cause_list/index', $data);
	}
	// Sessions Courts
	public function view()
	{
		$week_days = $this->config->item('week_days');
		
		$data = array(
			'court_id'  => strip_tags($this->input->post('court_id',TRUE)),
			'ndoh' 		=> @date('Y-m-d', @strtotime($this->input->post('ndoh',TRUE)))
		);	

		$this->form_validation->set_rules('court_id', 'Court Name', 'required');
		$this->form_validation->set_rules('ndoh', 'Date of Hearing', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			
			// dropdown list courts name
			if (!$this->ion_auth->is_Admin())
			{
				$loginUser = $this->ion_auth->user()->row()->id;
				$data['courts'] = $this->courts_model->get_court_names_by_login_user($loginUser);
			}
			else 
			{
				$data['courts'] = $this->courts_model->get_publish_courts_list();
			}
			
			$this->template->set_title('Cause List');
			$this->template->loadview('templates/default_admin', 'backend/cause_list/index', $data);
		}
		else 
		{
			// get stages by selected
			$data['stages'] = $this->cause_list_model->get_stages($data);
			
			foreach ($data['stages'] as $stage)
			{
				$stage->cases = $this->cause_list_model->get_cases_by_stage_id($stage);
			}
			
			// get court name with designation
			$data['court_by_user'] = $this->courts_model->get_court_name_by_id($data['court_id']); 
			
			$data['doh'] = $data['ndoh'];
			
			$day =date('D',strtotime($data['doh']));
			$data['day']=$week_days[$day];
			
			$this->template->set_title('Online Cause List');
			$this->template->loadview('templates/default_admin', 'backend/cause_list/cause_list', $data);
		}
	}
}
?>