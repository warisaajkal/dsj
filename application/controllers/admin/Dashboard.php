<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Members {
	public function __construct()
	{
		parent::__construct();
		
		//load courts model
		$this->load->model('courts_model');
		// load cases list model
		$this->load->model('cases_list_model');
		
		// add css/js files
// 		$this->template->add_js('assets/plugins/peity/jquery.peity.min.js');
		
// 		$this->template->add_js('assets/plugins/waypoints/lib/jquery.waypoints.js');
// 		$this->template->add_js('assets/plugins/counterup/jquery.counterup.min.js');
		
// 		$this->template->add_js('assets/plugins/morris/morris.min.js');
// 		$this->template->add_js('assets/plugins/raphael/raphael-min.js');
		
// 		$this->template->add_js('assets/plugins/jquery-knob/jquery.knob.js');
		
// 		$this->template->add_js('assets/pages/jquery.dashboard.js');
	}
	public function index()
	{
		
		// load js files
		
		if(!$this->ion_auth->logged_in())
		{
			redirect(base_url().'admin/auth/login', 'refresh');
		}
		elseif($this->ion_auth->logged_in())
		{
			$data['totalPendency'] = $this->cases_list_model->count_total_Pedency();
			
			// current month and year
			$currentMonth = date('Y-m');
		
			$data['currentMonthCases'] = $this->cases_list_model->count_current_month_cases($currentMonth);
			
			$data['currentMonthDecidedCases'] = $this->cases_list_model->count_current_month_decided_cases($currentMonth);
			
			$data['courts'] = $this->courts_model->get_publish_courts_list();
			
			foreach ( $data['courts'] as $court )
			{
				// court total pedency court wise
				$court->totalPendency = $this->cases_list_model->count_total_Pedency_by_court( $court->court_id );
				$court->currentMonthCases = $this->cases_list_model->count_current_month_cases_by_court( $court->court_id, $currentMonth );
				$court->currentMonthDecidedCases = $this->cases_list_model->count_current_month_decided_cases_by_court( $court->court_id, $currentMonth );
			}
			
			$this->template->page_title('Dashboard');
			$this->template->loadview('templates/default_admin','backend/index', $data);
		}
	}
}
