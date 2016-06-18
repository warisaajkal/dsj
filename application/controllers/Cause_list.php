<?php defined('BASEPATH') or die('Restricted access');

class Cause_list extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		// set timezone
		date_default_timezone_set('Asia/Karachi');
		
		// load courts model
		$this->load->model('courts_model');
		// load sessions cases categories model
// 		$this->load->model('categories_model');
		// load cases & cases list model 
// 		$this->load->model('cases_model');
// 		$this->load->model('cases_list_model');
		$this->load->model('cause_list_model');
// 		$this->load->model('ps_model');
// 		$this->load->model('search_model');
		
		//load config file
		$this->config->load('week_days');
	}
	
	// cause list
	public function index()
	{
		// add css & js files for datepicker
		$this->template->add_css('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
		$this->template->add_js('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
		
		// load js file
		$this->template->add_js('assets/plugins/parsleyjs/dist/parsley.min.js');
		
		// get publish courts
		$data['courts'] = $this->courts_model->get_publish_courts_list();
			
		$this->template->set_title('Cause List');
		$this->template->loadview('templates/default', 'frontend/cause_list/index', $data);
	}
	public function cause_list()
	{
		$week_days = $this->config->item('week_days');
	
		$data['court_id'] = strip_tags($this->input->post('court_id',TRUE));
		$today			  = @date('Y-m-d', @strtotime($this->input->post('ndoh', TRUE)));
	
		if ($today == '1970-01-01') {
	
			if (date('N') == 7)
			{
				$today = date('Y-m-d', strtotime('+1 day'));
			}	
			else
			{
				$today = date('Y-m-d');
	
				$time =  date('H');
				if ($time >= 16	){
					$today = date('Y-m-d', strtotime($today. ' + 1 days'));
				}
			}
	
			$holidays = $this->cause_list_model->get_holidays();
	
			foreach ($holidays as $holiday)
			{
				if ($holiday->date == $today) {
						
					$today = date('Y-m-d', strtotime($today. ' + 1 days'));
						
					if (date('N',strtotime($today)) == 7 )
					{
						$today = date('Y-m-d', strtotime($today. ' + 1 days'));
					}
				}
			}
		}
	
		$this->form_validation->set_rules('court_id', 'Court Name', 'required');
	
		if ($this->form_validation->run()== FALSE )
		{
			// get publish courts
			$data['courts'] = $this->courts_model->get_publish_courts_list();
				
			$this->template->set_title('Cause List');
			$this->template->loadview('templates/default', 'frontend/cause_list/index', $data);
		}
		else
		{
			$data['ndoh'] = $today;
			
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
			$this->template->loadview('templates/default', 'frontend/cause_list/cause_list', $data);
			
		}
	}	
}
