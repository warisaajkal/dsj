<?php defined('BASEPATH') or die('Restricted access');

class Cases extends Members {

	public function __construct()
	{
		parent::__construct();
		// set timezone
		date_default_timezone_set('Asia/Karachi');

		// load courts model
		$this->load->model('courts_model');
		
		// load categories of cases model
		$this->load->model('categories_model');

		// load next proceeding model
		$this->load->model('next_proceeding_model');

		// load stages model
		$this->load->model('stages_model');
		
		//load police stations model
		$this->load->model('ps_model');

		// load add cases model
		$this->load->model('cases_model');
		

		// laod urdu editor js file & script
		$this->template->add_hjs('assets/js/urdu-webpad.js');
		$this->template->add_js_script('initUrduEditor()');
		
		// add css & js files for datepicker
		$this->template->add_css('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
		$this->template->add_css('assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css');
		$this->template->add_js('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
		$this->template->add_js('assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js');
		
		// text editor js
		$this->template->add_js('assets/plugins/tinymce/tinymce.min.js');

	}
	public function index()
	{
		$this->template->set_title('Manage Cases');
		$this->template->loadview('templates/default_admin','backend/cases/index');
	}
	// session courts add cases button
	public function sc()
	{
		$this->template->set_title('Manage Sessions Courts Cases');
		$this->template->loadview('templates/default_admin','backend/cases/sc/index');
	
	}
	// session courts add cases button
	public function cvc()
	{
		$this->template->set_title('Manage Civil Courts Cases');
		$this->template->loadview('templates/default_admin','backend/cases/cvc/index');
	
	}

	public function formData()
	{
		// define array form submit data
		$this->CaseData = 
			array(
					'user_id'  		=> $this->ion_auth->user()->row()->id,
					'case_id'		=> strip_tags($this->input->post('case_id',TRUE)),
					'court_id'		=> strip_tags($this->input->post('court_id',TRUE)),
					'court_type'	=> strip_tags($this->input->post('court_type',TRUE)),
					'case_type' 	=> strip_tags($this->input->post('case_type',TRUE)),
					
					'cat_id'		=> strip_tags($this->input->post('cat_id',TRUE)),
					
					'cat_nature' 	=> strip_tags($this->input->post('cat_nature',TRUE)),
					'inst_date' 	=> strip_tags($this->input->post('inst_date',TRUE)),
					
					'dir_case_id'	=> strip_tags($this->input->post('dir_case_id',TRUE)),
					'old_case' 		=> strip_tags($this->input->post('old_case',TRUE)),
					
					'chl_no' 		=> strip_tags($this->input->post('chl_no',TRUE)),
					'chl_date' 		=> strip_tags($this->input->post('chl_date',TRUE)),
					'reg_no'		=> strip_tags($this->input->post('reg_no',TRUE)),
					'reg_date' 		=> strip_tags($this->input->post('reg_date',TRUE)),
					
					'fir_no' 		=> strip_tags($this->input->post('fir_no',TRUE)),
					'fir_date' 		=> strip_tags($this->input->post('fir_date',TRUE)),
					'offence' 		=> strip_tags($this->input->post('offence',TRUE)),
					'ps_id' 		=> strip_tags($this->input->post('ps_id',TRUE)),
					
					'case_title'	=> strip_tags($this->input->post('case_title',TRUE)),
						
					'acsd_name'  	=> strip_tags($this->input->post('acsd_name',TRUE)),
					'acsd_cnic'		=> strip_tags($this->input->post('acsd_cnic',TRUE)),
					'acsd_addr'		=> strip_tags($this->input->post('acsd_addr',TRUE)),
					'onbail_utp' 	=> strip_tags($this->input->post('onbail_utp',TRUE)),
					'acsd_adv' 		=> strip_tags($this->input->post('acsd_adv',TRUE)),
					'acsd_adv_lic' 	=> strip_tags($this->input->post('acsd_adv_lic',TRUE)),
					
					'plt_name' 		=> strip_tags($this->input->post('plt_name',TRUE)),
					'plt_cnic' 		=> strip_tags($this->input->post('plt_cnic',TRUE)),
					'plt_addr' 		=> strip_tags($this->input->post('plt_addr',TRUE)),
					'plt_adv'		=> strip_tags($this->input->post('plt_adv',TRUE)),
					'plt_adv_lic' 	=> strip_tags($this->input->post('plt_adv_lic',TRUE)),
					
					'def_name' 		=> strip_tags($this->input->post('def_name',TRUE)),
					'def_cnic' 		=> strip_tags($this->input->post('def_cnic',TRUE)),
					'def_addr' 		=> strip_tags($this->input->post('def_addr',TRUE)),
					'def_adv' 		=> strip_tags($this->input->post('def_adv',TRUE)),
					'def_adv_lic' 	=> strip_tags($this->input->post('def_adv_lic',TRUE)),
										
					'wtns_name' 	=> strip_tags($this->input->post('wtns_name',TRUE)),
					'wtns_cnic'		=> strip_tags($this->input->post('wtns_cnic',TRUE)),
					'wtns_addr' 	=> strip_tags($this->input->post('wtns_addr',TRUE)),
					
					'victim_name' 	=> strip_tags($this->input->post('victim_name',TRUE)),
					'victim_cnic'	=> strip_tags($this->input->post('victim_cnic',TRUE)),
					'victim_addr'	=> strip_tags($this->input->post('victim_addr',TRUE)),
					
					'status' 		=> strip_tags($this->input->post('status',TRUE)),
					
					'trf_court_id'	=> strip_tags($this->input->post('trf_court_id',TRUE)),
					
					'decision' 		=> $this->input->post('decision',TRUE),
					'cntsd_un' 		=> strip_tags($this->input->post('cntsd_un',TRUE)),
					
					'eng_title'		=> strip_tags($this->input->post('eng_title',TRUE)),
					
					'index_pages' 	=> strip_tags($this->input->post('index_pages',TRUE)),
					'general_no' 	=> strip_tags($this->input->post('general_no',TRUE)),
					
					
					'created_user_id' => $this->ion_auth->user()->row()->id,
					'modified_user_id'=> $this->ion_auth->user()->row()->id,
					'created_date' 	=> date('Y-m-d H:i:s'),
					'modified_date' => date('Y-m-d H:i:s'),
					
					'id' 		=> strip_tags($this->input->post('case_history_id',TRUE)),
					'stage_id' 	=> strip_tags($this->input->post('stage_id',TRUE)),
					'nproc_id' 	=> strip_tags($this->input->post('nproc_id',TRUE)),
					'order_sheet' => strip_tags($this->input->post('order_sheet',TRUE)),
					'doh'  		=> strip_tags($this->input->post('doh',TRUE)),
					'ndoh' 		=> strip_tags($this->input->post('ndoh',TRUE)),
					'remarks' 	=> strip_tags($this->input->post('remarks',TRUE)),					
			);
			
		$this->caseProceeding = array(
					'user_id'		=> $this->ion_auth->user()->row()->id,
					'id'			=> $this->input->post('id',TRUE),
					'court_id' 		=> $this->input->post('court_id',TRUE),
					'case_id' 		=> $this->input->post('case_id',TRUE),
					'order_sheet' 	=> strip_tags($this->input->post('order_sheet',TRUE)),
					'doh' 			=> $this->input->post('doh',TRUE),
					'ndoh' 			=> $this->input->post('ndoh',TRUE),
					'nproc_id' 		=> $this->input->post('nproc_id',TRUE),
					'stage_id' 		=> $this->input->post('stage_id',TRUE),
					'remarks' 		=> strip_tags($this->input->post('remarks',TRUE)),
			);
		

		// define form submit data validation* 
		$this->caseValidation = array(
				array(
						'field' => 'court_id',
						'label' => 'court name',
						'rules' => 'required'
					),
				array(
						'field' => 'court_type',
						'label' => 'court type',
						'rules' => 'required'
				),
				array(
						'field' => 'case_type',
						'label' => 'case type',
						'rules' => 'required'
				),
				array(
						'field' => 'cat_id',
						'label' => 'category',
						'rules' => 'required'
				),
				array(
						'field' => 'inst_date',
						'label' => 'inst. date',
						'rules' => 'required'
				),
				array(
						'field' => 'reg_date',
						'label' => 'case registration date',
						'rules' => 'required'
				),			
				array(
						'field' => 'case_title',
						'label' => 'case title',
						'rules' => 'required'
				),
				array(
						'field' => 'ndoh',
						'label' => 'next date of hearing',
						'rules' => 'required|callback_check_next_date_of_hearing'
				),
				array(
						'field' => 'nproc_id',
						'label' => 'next proceeding',
						'rules' => 'required'
				),
				array(
						'field' => 'stage_id',
						'label' => 'stage',
						'rules' => 'required'
				),
								
				array(
						'field' => 'status',
						'label' => 'case status',
						'rules' => 'required'
				),
				array(
						'field' => 'chl_no',
						'label' => 'challan no.',
						'rules' => 'numeric'
				),
				array(
						'field' => 'reg_no',
						'label' => 'register no.',
						'rules' => 'numeric'
				),
				array(
						'field' => 'fir_no',
						'label' => 'FIR no.',
						'rules' => 'numeric'
				),
				array(
						'field' => 'general_no',
						'label' => 'general no.',
						'rules' => 'numeric'
				),
				array(
						'field' => 'acsd_cnic',
						'label' => 'accused cnic.',
						'rules' => 'callback_acsd_cnic'
				),
				array(
						'field' => 'plt_cnic',
						'label' => 'plaintiff cnic.',
						'rules' => 'callback_plt_cnic'
				),
				array(
						'field' => 'def_cnic',
						'label' => 'defendant cnic.',
						'rules' => 'callback_def_cnic'
				),
				array(
						'field' => 'wtns_cnic',
						'label' => 'witness cnic.',
						'rules' => 'callback_wtns_cnic'
				),
				array(
						'field' => 'victim_cnic',
						'label' => 'victim cnic.',
						'rules' => 'callback_victim_cnic'
				),
				array(
						'field' => 'acsd_adv_lic',
						'label' => 'advocate licence',
						'rules' => 'callback_acsd_adv_lic'
				),
				array(
						'field' => 'plt_adv_lic',
						'label' => 'advocate licence',
						'rules' => 'callback_plt_adv_lic'
				),
				array(
						'field' => 'plt_adv_lic',
						'label' => 'advocate licence',
						'rules' => 'callback_plt_adv_lic'
				),
			);
	}
	// check next date on add new case and update new case
	public function check_next_date_of_hearing($ndoh, $case_id)
	{
		$msg = $ndoh.' is already exit!';
		$msg1 = 'please select after this '.$ndoh;
		
		$ndoh = @date('Y-m-d', @strtotime($ndoh));
		
		$nextDates = $this->cases_model->get_ndoh_by_case_id( $ndoh, $case_id );
		
		foreach ( $nextDates as $key => $value )
		{
			if ($value->ndoh == $ndoh )
			{
				$this->form_validation->set_message ( 'check_next_date_of_hearing', $msg );
				return false;
			}
			if ($value->ndoh >= $ndoh )
			{
				$this->form_validation->set_message ( 'check_next_date_of_hearing', $msg1 );
				return false;
			}
		}
	}
	// add ndoh on update case
	public function check_only_update_ndoh($ndoh, $case_id)
	{
		// get previous ndoh last 2
		$prv_ndoh = $this->db->select('ndoh')->where('case_id', $case_id)->order_by('id desc')->get('cases_history')->row();
		
		// set messages
		$today_msg = 'past date not allowed! please select after this '.@date('d-m-Y', @strtotime($prv_ndoh->ndoh));
		$msg = $ndoh.' is already exit!';
		$msg1 = 'please select after this '.@date('d-m-Y', @strtotime($prv_ndoh->ndoh));
	
		$ndoh = @date('Y-m-d', @strtotime($ndoh));
		
		$today = date('Y-m-d');
	
		$nextDates = $this->cases_model->get_ndoh_on_update_by_id( $ndoh, $case_id );
		
		foreach ( $nextDates as $key => $value )
		{
			if ( ($today > $ndoh) OR ($prv_ndoh->ndoh > $ndoh ))
			{
				$this->form_validation->set_message ( 'check_only_update_ndoh', $today_msg );
				return false;
			}
			if ($value->ndoh == $ndoh )
			{
				$this->form_validation->set_message ( 'check_only_update_ndoh', $msg );
				return false;
			}
			if ($value->ndoh >= $ndoh )
			{
				$this->form_validation->set_message ( 'check_only_update_ndoh', $msg1 );
				return false;
			}
		}
	}
	// edit ndoh by case history
	public function check_only_edit_ndoh($ndoh, $case_id)
	{
		// get previous ndoh
		$prv_ndoh = $this->db->select('ndoh')->where('case_id', $case_id)->order_by('id desc')->get('cases_history')->row();
		
		// get previous ndoh limit -1
		$prv2_ndoh = $this->db->select('ndoh')->where('case_id', $case_id)->limit(1,1)->order_by('id desc')->get('cases_history')->row();
		
		// set messages
		$today_msg = $ndoh. ' past date not allowed!';
		$msg = $ndoh.' is already exit!';
		$msg1 = 'please select after this '.@date('d-m-Y', @strtotime($prv2_ndoh->ndoh));
	
		$ndoh = @date('Y-m-d', @strtotime($ndoh));
	
		$today = date('Y-m-d');
	
		$nextDates = $this->cases_model->get_ndoh_on_update_by_id( $ndoh, $case_id );
	
		foreach ( $nextDates as $key => $value )
		{
			if ( $today > $ndoh )
			{
				$this->form_validation->set_message ( 'check_only_edit_ndoh', $today_msg );
				return false;
			}
			if ($value->ndoh == $ndoh )
			{
				$this->form_validation->set_message ( 'check_only_edit_ndoh', $msg );
				return false;
			}
			if ($value->ndoh >= $ndoh )
			{
				$this->form_validation->set_message ( 'check_only_edit_ndoh', $msg1 );
				return false;
			}
		}
	}

	// allowed numeric space comma 
	public function acsd_cnic($str)
	{	
		$this->form_validation->set_message ( 'acsd_cnic', 'only numeric value allow' );
		
		if ( !preg_match('/^[0-9, ]+$/', $str) AND !empty($str) )
		{
			return false;
		}
	}
	public function plt_cnic($str)
	{
		$this->form_validation->set_message ( 'plt_cnic', 'only numeric value allow' );
	
		if ( !preg_match('/^[0-9, ]+$/', $str) AND !empty($str) )
		{
			return false;
		}
	}
	public function def_cnic($str)
	{
		$this->form_validation->set_message ( 'def_cnic', 'only numeric value allow' );
	
		if ( !preg_match('/^[0-9, ]+$/', $str) AND !empty($str) )
		{
			return false;
		}
	}
	public function wtns_cnic($str)
	{
		$this->form_validation->set_message ( 'wtns_cnic', 'only numeric value allow' );
	
		if ( !preg_match('/^[0-9, ]+$/', $str) AND !empty($str) )
		{
			return false;
		}
	}
	public function victim_cnic($str)
	{
		$this->form_validation->set_message ( 'victim_cnic', 'only numeric value allow' );
	
		if ( !preg_match('/^[0-9, ]+$/', $str) AND !empty($str) )
		{
			return false;
		}
	}
	
	public function acsd_adv_lic($str)
	{
		$this->form_validation->set_message ( 'acsd_adv_lic', 'allow a-z, 0-9' );
	
		if ( !preg_match('/^[a-z,A-Z 0-9, \-]+$/', $str) AND !empty($str) )
		{
			return false;
		}
	}
	
	public function plt_adv_lic($str)
	{
		$this->form_validation->set_message ( 'plt_adv_lic', 'allow a-z, 0-9' );
	
		if ( !preg_match('/^[a-z,A-Z 0-9, \-]+$/', $str) AND !empty($str) )
		{
			return false;
		}
	}
	
	public function def_adv_lic($str)
	{
		$this->form_validation->set_message ( 'def_adv_lic', 'allow a-z, 0-9' );
	
		if ( !preg_match('/^[a-z,A-Z 0-9, \-]+$/', $str) AND !empty($str) )
		{
			return false;
		}
	}
	// upload only pdf file
	public function pdf_only()
	{
		//application/pdf
	
		$type = $_FILES['userfile']['type'];
	
		$this->form_validation->set_message('pdf_only', 'You must upload an pdf!');
	
		if ($type !=='application/pdf')
		{
			return false;
		}
	}
	
	// Add new cr. case for sessions courts
	public function add_sc_cr()
	{
		// get assigned court name by user
		$user_id= $this->ion_auth->user()->row()->id;
		$courtType = 'Sessions';
		$caseType  = 'criminal';
		// array of type
		$data['type'] = array ('court' => $courtType, 'case' => $caseType, 'status' => 'proceeding');
		
		$data['court_by_user'] = $this->courts_model->get_court_name_by_user($user_id,$courtType);

		// form dropdown list *
		$data['courts'] = $this->courts_model->get_publish_courts_list();
		$data['list_ps'] = $this->ps_model->list_publish_ps();
		
		$data['cats'] = $this->categories_model->get_categories_for_cases( $data['type'] );
		$data['nprocs'] = $this->next_proceeding_model->get_next_proceedings_for_cases( $data['type'] );
 		$data['stages'] = $this->stages_model->get_stages_for_cases( $data['type'] );

		$this->template->set_title('Add Criminal Case');
		$this->template->loadview('templates/default_admin','backend/cases/sc/add_cr', $data);
	}
	
	// Add new cr. case for civil courts
	public function add_cvc_cr()
	{
		// get assigned court name by user
		$user_id= $this->ion_auth->user()->row()->id;
		$courtType = 'Civil';
		$caseType  = 'criminal';
		// array of type
		$data['type'] = array ('court' => $courtType, 'case' => $caseType, 'status' => 'proceeding');
		
		$data['court_by_user'] = $this->courts_model->get_court_name_by_user($user_id,$courtType);
	
		// form dropdown list *
		$data['courts'] = $this->courts_model->get_publish_courts_list();
		$data['list_ps'] = $this->ps_model->list_publish_ps();
		$data['cats'] = $this->categories_model->get_categories_for_cases( $data['type'] );
		$data['nprocs'] = $this->next_proceeding_model->get_next_proceedings_for_cases( $data['type'] );
 		$data['stages'] = $this->stages_model->get_stages_for_cases( $data['type'] );
	
		$this->template->set_title('Add Criminal Case');
		$this->template->loadview('templates/default_admin','backend/cases/cvc/add_cr',$data);
	}
	// Add new civil case for sessions courts
	public function add_sc_cv()
	{
		// get assigned court name by user
		$user_id= $this->ion_auth->user()->row()->id;
		
		$courtType = 'Sessions';
		$caseType  = 'civil';
		// array of type
		$data['type'] = array ('court' => $courtType, 'case' => $caseType, 'status' => 'proceeding');
		
		
		$data['court_by_user'] = $this->courts_model->get_court_name_by_user($user_id,$courtType);
	
		// form dropdown list *
		$data['courts'] = $this->courts_model->get_publish_courts_list();
		$data['cats'] = $this->categories_model->get_categories_for_cases( $data['type'] );
		$data['nprocs'] = $this->next_proceeding_model->get_next_proceedings_for_cases( $data['type'] );
 		$data['stages'] = $this->stages_model->get_stages_for_cases( $data['type'] );
	
		$this->template->set_title('Add Civil Case');
		$this->template->loadview('templates/default_admin','backend/cases/sc/add_cv',$data);
	}
	// Add new civil case for civil courts
	public function add_cvc_cv()
	{
		// get assigned court name by user
		$user_id= $this->ion_auth->user()->row()->id;

		$courtType = 'Civil';
		$caseType  = 'civil';
		// array of type
		$data['type'] = array ('court' => $courtType, 'case' => $caseType, 'status' => 'proceeding');
		
		$data['court_by_user'] = $this->courts_model->get_court_name_by_user($user_id,$courtType);
	
		// form dropdown list *
		$data['courts'] = $this->courts_model->get_publish_courts_list();
		$data['cats'] = $this->categories_model->get_categories_for_cases( $data['type'] );
		$data['nprocs'] = $this->next_proceeding_model->get_next_proceedings_for_cases( $data['type'] );
 		$data['stages'] = $this->stages_model->get_stages_for_cases( $data['type'] );
	
		$this->template->set_title('Add Civil Case');
		$this->template->loadview('templates/default_admin','backend/cases/cvc/add_cv',$data);
	}
	
	public function save_case()
	{
		$this->formData();
		$data = $this->CaseData;
		$caseValidation = $this->caseValidation;
				
		// check inst. date field is null
		if ( $data['inst_date']== NULL ){
			$data['inst_date'] == NULL;
		}
		else
		{
			$data['inst_date']= @date('Y-m-d', @strtotime($data['inst_date']));
		}
		
		// check reg date field is null
		if ($data['reg_date']== NULL) {
			$data['reg_date'] == NULL;
		}
		else
		{
			$data['reg_date']= @date('Y-m-d', @strtotime($data['reg_date']));
		}
		
		// check challan date field is null
		if ($data['chl_date']== NULL) {
			$data['chl_date'] == NULL;
		}
		else
		{
			$data['chl_date']= @date('Y-m-d', @strtotime($data['chl_date']));
		}
		
		// check FIR date field is null
		if ($data['fir_date']== NULL) {
			$data['fir_date'] == NULL;
		}
		else
		{
			$data['fir_date']= @date('Y-m-d', @strtotime($data['fir_date']));
		}
		
		// check next date field is null
		if ($data['ndoh']== NULL) {
			$data['ndoh'] == NULL;
		}
		else
		{
			$data['ndoh']= @date('Y-m-d', @strtotime($data['ndoh']));
		}
		
		// set validation
		$this->form_validation->set_rules($caseValidation);
	
		// if sc cr. validation false 
		if ($this->form_validation->run() == FALSE)
		{
			
			// get assigned court name by user
			$data['court_by_user'] = $this->courts_model->get_court_name_by_user($data['user_id'], $data['court_type']);
			
			$data['courts'] = $this->courts_model->get_publish_courts_list();
			
			$data['case'] = (object) $data;
			
			// dropdown list ps, cats etc
			$data['list_ps'] = $this->ps_model->list_publish_ps();
			
			$data['type'] = array ('court' => $data['court_type'], 'case' => $data['case_type']);
			$data['cats'] = $this->categories_model->get_categories_for_cases( $data['type'] );
			$data['nprocs'] = $this->next_proceeding_model->get_next_proceedings_for_cases( $data['type'] );
			$data['stages'] = $this->stages_model->get_stages_for_cases( $data['type'] );
			
			if ($data['court_type'] == 'Sessions')
			{
				if (($data['case_type'] == 'criminal'))
				{
					$this->template->set_title('Add Criminal Case');
					$this->template->loadview('templates/default_admin','backend/cases/sc/add_cr',$data);
				}
				else 
				{	
					$this->template->set_title('Add Civil Case');
					$this->template->loadview('templates/default_admin','backend/cases/sc/add_cv',$data);
					
				}
			}
			else 
			{
				if (($data['case_type'] == 'criminal'))
				{	
					$this->template->set_title('Add Criminal Case');
					$this->template->loadview('templates/default_admin','backend/cases/cvc/add_cr',$data);
				}
				else 
				{	
					$this->template->set_title('Add Civil Case');
					$this->template->loadview('templates/default_admin','backend/cases/cvc/add_cv',$data);
					
				}
				
			}
		}
		else
		{
			// check assigned user and court		
			$valid = $this->courts_model->validate_court($data['user_id'],$data['court_id']);
			if (!$this->ion_auth->is_Admin())
			{
				if(count($valid) == 0)
				{
					redirect(base_url().'admin/User_authentic/wrong_data');
				}
			}
		
			if($this->cases_model->save_case($data) > 0)
			{
				// get insert case id
				$case = $this->db->select('case_id, case_title')->where('court_id', $data['court_id'])->order_by('case_id desc')->get('cases')->row();
					
				$msg = 'Case have saved successfully!<br><h3 class="text-center"> Computer Case ID:'.$case->case_id. '<br><span class="urdu ltr m-t-10">Case Title: '.$case->case_title.'</span></h3>';
				
				$this->session->set_flashdata('message',$msg);
				$this->session->set_flashdata('message_type','success');
			}
			else
			{
				$this->session->set_flashdata('message','This case could not saved!');
				$this->session->set_flashdata('message_type','danger');
			}
			
			redirect(base_url('admin/cases'));
			
		}
	}
	// edit case by case id
	public function edit_case_by_id()
	{
		$this->template->set_title ( 'Enter Case ID' );
		$this->template->loadview('templates/default_admin','backend/cases/edit_case_by_id');
	}
	// edit case by case id
	public function edit_case(){
	
		$case_id = $this->input->post('case_id');
		
		$this->form_validation->set_rules('case_id', 'case id', 'required');
		
		if ($this->form_validation->run() == false )
		{
			$this->template->set_title ( 'Enter Case ID' );
			$this->template->loadview('templates/default_admin','backend/cases/edit_case_by_id');
		}
	
		// get case by id
		$data ['case'] = $this->cases_model->get_case_by_id ( $case_id );
	
		if (count ( $data ['case'] ) == 0)
		{
			$this->session->set_flashdata ( 'message', 'This case id: '.$case_id.' could not be found!!' );
			$this->session->set_flashdata ( 'message_type', 'warning' );
	
			redirect ( base_url('admin/cases/edit_case_by_id') );
		}
	
		// get assigned court name by user
		$user_id = $this->ion_auth->user()->row()->id;
		$data['court_by_user'] = $this->courts_model->get_court_name_by_user( $user_id, $data['case']->court_type );
	
		if (!$this->ion_auth->is_Admin()) {
			if ( $data['case']->court_id !== $data['court_by_user']->court_id) {
				$this->session->set_flashdata ( 'message', 'This case id '.$case_id.' not found in your court!' );
				$this->session->set_flashdata ( 'message_type', 'warning' );
				redirect ( base_url('admin/cases/edit_case_by_id') );
			}
		}
	
		$data['type'] = array ( 'court' => $data['case']->court_type, 'case' => $data['case']->case_type );
			
		// form dropdown list *
		$data['courts'] = $this->courts_model->get_publish_courts_list();
		$data['list_ps'] = $this->ps_model->list_publish_ps();
		$data['cats'] = $this->categories_model->get_categories_for_cases( $data['type'] );
		$data['nprocs'] = $this->next_proceeding_model->get_next_proceedings_for_cases( $data['type'] );
		$data['stages'] = $this->stages_model->get_stages_for_cases( $data['type'] );
			
		// $data['case'] = (object) $data;
			
		if ($data['case']->case_type == 'criminal')
		{
			$this->template->set_title ( 'Edit Criminal Case' );
			$this->template->loadview('templates/default_admin','backend/cases/edit_cr',$data);
				
		}
		else
		{
			$this->template->set_title ( 'Edit Civil Case' );
			$this->template->loadview('templates/default_admin','backend/cases/edit_cv',$data);
		}
	
	}
	
	// eidt case by case_id
	public function edit($case_id){
		
		if (!$case_id) {
			$this->session->set_flashdata ( 'message', 'This case is '.$case_id.' could not be found!' );
			$this->session->set_flashdata ( 'message_type', 'warning' );
			redirect ( base_url('admin/cases/edit_case_by_id') );
		}
		
		// get case by id
		$data ['case'] = $this->cases_model->get_case_by_id ( $case_id );
		
		if (count ( $data ['case'] ) == 0)
		{
			$this->session->set_flashdata ( 'message', 'This case id '.$case_id.' could not be found!!' );
			$this->session->set_flashdata ( 'message_type', 'warning' );
		
			redirect ( base_url('admin/cases/edit_case_by_id') );
		}
		
		// get assigned court name by user
		$user_id = $this->ion_auth->user()->row()->id;
		$data['court_by_user'] = $this->courts_model->get_court_name_by_user( $user_id, $data['case']->court_type );
	
		if (!$this->ion_auth->is_Admin()) {
			if ( $data['case']->court_id !== $data['court_by_user']->court_id) {
				$this->session->set_flashdata ( 'message', 'This case id '.$case_id.' not found in your court!' );
				$this->session->set_flashdata ( 'message_type', 'warning' );
				redirect ( base_url('admin/cases/edit_case_by_id') );
			}
		}

			$data['type'] = array ( 'court' => $data['case']->court_type, 'case' => $data['case']->case_type );
			
			// form dropdown list *
			$data['courts'] = $this->courts_model->get_publish_courts_list();
			$data['list_ps'] = $this->ps_model->list_publish_ps();
			$data['cats'] = $this->categories_model->get_categories_for_cases( $data['type'] );
			$data['nprocs'] = $this->next_proceeding_model->get_next_proceedings_for_cases( $data['type'] );
			$data['stages'] = $this->stages_model->get_stages_for_cases( $data['type'] );
			
			// $data['case'] = (object) $data;
			
			if ($data['case']->case_type == 'criminal')
			{
				$this->template->set_title ( 'Edit Criminal Case' );
				$this->template->loadview('templates/default_admin','backend/cases/edit_cr',$data);
					
			}
			else
			{
				$this->template->set_title ( 'Edit Civil Case' );
				$this->template->loadview('templates/default_admin','backend/cases/edit_cv',$data);
			}
		
	}
	
	public function update_case()
	{
		$this->formData();
		$data = $this->CaseData;
		$caseValidation = $this->caseValidation;
	
		//set the path
		$config['upload_path'] = 'application/views/uploads/decision/';
	
		// set the filter image types
		$config['allowed_types'] = 'pdf';
		//$config['encrypt_name'] = TRUE;
		//$config['remove_spaces'] = TRUE;
	
		//$new_name = time().$_FILES["userfiles"]['name'];
		$new_name = $data['eng_title'];
		$config['file_name'] = $new_name;
	
		//load the upload library
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->upload->set_allowed_types('pdf');
		$data['userfile'] = '';
	
		// check inst. date field is null
		if ($data['inst_date']== NULL) {
			$data['inst_date'] == NULL;
		}
		else
		{
			$data['inst_date']= @date('Y-m-d', @strtotime($data['inst_date']));
		}
	
		// check reg date field is null
		if ($data['reg_date']== NULL) {
			$data['reg_date'] == NULL;
		}
		else
		{
			$data['reg_date']= @date('Y-m-d', @strtotime($data['reg_date']));
		}
	
		// check challan date field is null
		if ($data['chl_date']== NULL) {
			$data['chl_date'] == NULL;
		}
		else
		{
			$data['chl_date']= @date('Y-m-d', @strtotime($data['chl_date']));
		}
	
		// check FIR date field is null
		if ($data['fir_date']== NULL) {
			$data['fir_date'] == NULL;
		}
		else
		{
			$data['fir_date']= @date('Y-m-d', @strtotime($data['fir_date']));
		}
	
		// check next date field is null
		if ($data['ndoh']== NULL) {
			$data['ndoh'] == NULL;
		}
		else
		{
			$data['ndoh']= @date('Y-m-d', @strtotime($data['ndoh']));
		}
		
		if ($data['status']=='proceeding')
		{
			$this->form_validation->set_rules($caseValidation);
			$this->form_validation->set_rules('ndoh', 'next date', 'required|callback_check_next_date_of_hearing['.$data['case_id'].']');
		}
	
		if ($data['status']=='transfer')
		{
			$this->form_validation->set_rules('trf_court_id', 'transfer court name', 'required');
			$this->form_validation->set_rules('ndoh', 'next date', 'required');
		}
	
		if ($data['status']=='decided')
		{
			$this->form_validation->set_rules('ndoh', 'next date', 'required');
			$this->form_validation->set_rules('decision', 'decision', 'required');
			$this->form_validation->set_rules('cntsd_un', 'contested/un-contsd', 'required');
			if (!empty($_FILES['userfile']['name'])) {
				$this->form_validation->set_rules('userfile', 'file', 'callback_pdf_only');
				$this->form_validation->set_rules('eng_title', 'file name', 'required');
			}
		}
	
		if ($this->form_validation->run() == FALSE)
		{
			// get case by id
			$data ['case'] = $this->cases_model->get_case_by_id ( $data['case_id'] );
				
			// get assigned court name by user
			$user_id = $this->ion_auth->user()->row()->id;
			$data['court_by_user'] = $this->courts_model->get_court_name_by_user( $user_id, $data ['case']->court_type );
			
			// form dropdown list *
			$data['courts'] = $this->courts_model->get_publish_courts_list();
			$data['list_ps'] = $this->ps_model->list_publish_ps();
			
			$data['type'] = array ('court' => $data['court_type'], 'case' => $data['case_type']);
			$data['cats'] = $this->categories_model->get_categories_for_cases( $data['type'] );
			$data['nprocs'] = $this->next_proceeding_model->get_next_proceedings_for_cases( $data['type'] );
			$data['stages'] = $this->stages_model->get_stages_for_cases( $data['type'] );
			
			$data['case'] = (object) $data;
			
			if (($data['case_type'] == 'criminal'))
			{		
				$this->template->set_title('Add Criminal Case');
				$this->template->loadview('templates/default_admin','backend/cases/edit_cr',$data);
			}
			else
			{	
				$this->template->set_title('Add Civil Case');
				$this->template->loadview('templates/default_admin','backend/cases/edit_cv',$data);
					
			}
		}
		else
		{
			// check assigned user and court
			$valid = $this->courts_model->validate_court( $data['user_id'], $data['court_id'] );
			if (!$this->ion_auth->is_Admin() AND (count($valid) == 0))
			{
				$this->session->set_flashdata('message','This case id: '.$data['case_id'].' not authrized for this court!');
				$this->session->set_flashdata('message_type','danger');
				redirect ( base_url('admin/cases/edit_case_by_id') );
			}
			else 
			{
				if ($data['case_id'] > 0 )
				{
					if ($data['status'] == 'decided') {
				
						//if upload successful
						if ($this->upload->do_upload('userfile')) {
							$data['upload_data'] = $this->upload->data();
							$this->cases_model->upload_dec_file($data);
						}
					}
				
					$old_courtType = $data['court_type'];
				
					if ($data['status'] == 'transfer')
					{
						$courtType = $this->courts_model->get_court_type( $data['trf_court_id'] );
						$data['court_type'] = $courtType->court_type;
					}
				
					if( $this->cases_model->update_case($data) > 0 )
					{
						$this->session->set_flashdata('message','This case id '.$data['case_id'].' have updated successfully!');
						$this->session->set_flashdata('message_type','success');
					}
					else
					{
						$this->session->set_flashdata('message','This case id '.$data['case_id'].' could not be updated!');
						$this->session->set_flashdata('message_type','danger');
					}
				
				}
				
			}
				redirect(base_url('admin/cases/edit_case_by_id'));
			
		}
	}
	
	public function pashi_case_id()
	{
		$this->template->set_title ( 'Enter Case ID' );
		$this->template->loadview('templates/default_admin','backend/cases/pashi_case_id');
	}
	
	// add next hearing date of case
	public function edit_pashi()
	{
		$case_id = $this->input->post('case_id');
		
		$this->form_validation->set_rules('case_id', 'Case ID', 'required');
		
		if( $this->form_validation->run() == FALSE )
		{
			$this->template->set_title ( 'Enter Case ID' );
			$this->template->loadview('templates/default_admin','backend/cases/pashi_case_id');
		}
		else 
		{
			
			$data ['case'] = $this->cases_model->get_case_for_next_proceeding ( $case_id );
			
			if (empty($data ['case'])) {
				$this->session->set_flashdata ( 'message', 'This case is '.$case_id.' could not be found!' );
				$this->session->set_flashdata ( 'message_type', 'warning' );
				redirect ( base_url('admin/cases/edit_case_by_id') );
			}

			if ($data['case']->status !== 'proceeding')
			{
				$this->session->set_flashdata ( 'message', 'This case id: '.$case_id.' have been decided, not allowed for next proceeding!' );
				$this->session->set_flashdata ( 'message_type', 'warning' );
				redirect ( base_url('admin/cases/pashi_case_id') );
			}
			
			$type = $this->db->select('court_type, case_type')->from('cases')->where('case_id',$data['case']->case_id)->get()->row();
			$data['type'] = array ('court' => $type->court_type, 'case' => $type->case_type);
			
			// get assigned court name by user
			$user_id = $this->ion_auth->user()->row()->id;
			$data['court_by_user'] = $this->courts_model->get_court_name_by_user( $user_id, $type->court_type );
				
			if (!$this->ion_auth->is_Admin()) {
				if ( $data['case']->court_id !== $data['court_by_user']->court_id) {
					$this->session->set_flashdata ( 'message', 'This case id '.$case_id.' not found in your court!' );
					$this->session->set_flashdata ( 'message_type', 'warning' );
					redirect ( base_url('admin/cases/edit_case_by_id') );
				}
			}
			
			
			// dropdown list
			$data['nprocs'] = $this->next_proceeding_model->get_next_proceedings_for_cases( $data['type'] );
			$data['stages'] = $this->stages_model->get_stages_for_cases( $data['type'] );
			
			$this->template->set_title ( 'Add Next Date of Hearing' );
			$this->template->loadview('templates/default_admin','backend/cases/add_ndoh', $data);
			
		}
		
	}
	
	// add next hearing date of case
	public function add_ndoh( $case_id = NULL )
	{
// 		$case_id = $this->input->post('case_id');
		if (!$case_id) {
			$this->session->set_flashdata ( 'message', 'This case could not be found!' );
			$this->session->set_flashdata ( 'message_type', 'warning' );
			redirect ( base_url('admin/cases') );
		}

		$data ['case'] = $this->cases_model->get_case_for_next_proceeding ( $case_id );
		
		if ($data['case']->status !== 'proceeding')
		{
			$this->session->set_flashdata ( 'message', 'This case have been decided, not allowed for next proceeding!' );
			$this->session->set_flashdata ( 'message_type', 'warning' );
			redirect ( base_url('admin/cases') );
		}
	
		$type = $this->db->select('court_type, case_type')->from('cases')->where('case_id',$data['case']->case_id)->get()->row();
		$data['type'] = array ('court' => $type->court_type, 'case' => $type->case_type);
		// dropdown list
		$data['nprocs'] = $this->next_proceeding_model->get_next_proceedings_for_cases( $data['type'] );
		$data['stages'] = $this->stages_model->get_stages_for_cases( $data['type'] );
	
		// $data['case'] = (object) $data;
	
		$this->template->set_title ( 'Add Next Date of Hearing' );
		$this->template->loadview('templates/default_admin','backend/cases/add_ndoh', $data);
	}
	
	// update next hearing date of case
	public function save_ndoh()
	{
		$this->formData();
		$data = $this->caseProceeding;
		
// 		$data['ndoh'] = @date('Y-m-d', @strtotime($data['ndoh']));

		$this->form_validation->set_rules('ndoh', 'next date', 'required|callback_check_only_update_ndoh['.$data['case_id'].']');
		$this->form_validation->set_rules('nproc_id', 'next proceeding', 'required');
		$this->form_validation->set_rules('stage_id', 'stage', 'required');
	
		if ($this->form_validation->run() == FALSE)
		{
			$data ['case'] = $this->cases_model->get_case_for_next_proceeding ( $data['case_id'] );
			
			$type = $this->db->select('court_type, case_type')->from('cases')->where('case_id',$data['case']->case_id)->get()->row();
			$data['type'] = array ('court' => $type->court_type, 'case' => $type->case_type);
			// dropdown list
			$data['nprocs'] = $this->next_proceeding_model->get_next_proceedings_for_cases( $data['type'] );
			$data['stages'] = $this->stages_model->get_stages_for_cases( $data['type'] );
	
			$this->template->set_title ( 'Add Next Date of Hearing' );
			$this->template->loadview('templates/default_admin','backend/cases/add_ndoh',$data);
	
		}
		else
		{
			$valid = $this->courts_model->validate_court($data['user_id'],$data['court_id']);
	
			if (!$this->ion_auth->is_Admin() AND (count($valid) == 0))
			{
				$this->session->set_flashdata('message','Your are not authrized user for this court!');
				$this->session->set_flashdata('message_type','danger');
				redirect ( base_url('admin/cases') );
			}
			else
			{
				// change date formate yyyy-mm-dd
				$data['ndoh'] = @date('Y-m-d', @strtotime($data['ndoh']));
				
				if( $this->cases_model->save_ndoh($data) > 0 )
				{
					$this->session->set_flashdata('message','This case id: '.$data['case_id'].' have saved successfully!');
					$this->session->set_flashdata('message_type','success');
				}
				else
				{
					$this->session->set_flashdata('message','This case next proceeding could not be updated!');
					$this->session->set_flashdata('message_type','danger');
				}
	
			}
			redirect ( base_url('admin/cases/pashi_case_id') );
		}
	}
	
	// edit next hearing date of case
	public function edit_ndoh($id)
	{
		if (!$id) {
			$this->session->set_flashdata ( 'message', 'This hearing date could not be found!' );
			$this->session->set_flashdata ( 'message_type', 'warning' );
			redirect ( base_url('admin/cases') );
		}
	
		$data ['ndoh'] = $this->cases_model->get_ndoh_by_id ( $id );
		// get last ndoh
		$last_ndoh = $this->db->select('ndoh')->where('case_id', $data['ndoh']->case_id)->order_by('id desc')->get('cases_history')->row();
		
		if ( ($data['ndoh']->ndoh < $last_ndoh->ndoh) || ($data['ndoh']->ndoh < date('Y-m-d')) ) 
		{
			$this->session->set_flashdata ( 'message', 'You can not allowed to change past date of hearing!' );
			$this->session->set_flashdata ( 'message_type', 'warning' );
			redirect ( base_url('admin/cases') );
		}
		
		if (count ( $data ['ndoh'] ) == 0)
		{
			$this->session->set_flashdata ( 'message', 'This hearing date could not be found!!' );
			$this->session->set_flashdata ( 'message_type', 'warning' );
	
			redirect ( base_url('admin/cases') );
		}
		
		$type = $this->db->select('court_type, case_type')->from('cases')->where('case_id',$data['ndoh']->case_id)->get()->row();	
		$data['type'] = array ('court' => $type->court_type, 'case' => $type->case_type);
		
		// get assigned court name by user
		$user_id = $this->ion_auth->user()->row()->id;
		$data['court_by_user'] = $this->courts_model->get_court_name_by_user( $user_id, $type->court_type );
		
		if (!$this->ion_auth->is_Admin())
		{
			if ( $data['ndoh']->court_id !== $data['court_by_user']->court_id) {
				$this->session->set_flashdata ( 'message', 'This case not found in your court!' );
				$this->session->set_flashdata ( 'message_type', 'warning' );
				redirect ( base_url('admin/cases') );
			}
		}
			// dropdown list
			$data['nprocs'] = $this->next_proceeding_model->get_next_proceedings_for_cases( $data['type'] );
			$data['stages'] = $this->stages_model->get_stages_for_cases( $data['type'] );
			
			// $data['case'] = (object) $data;
			
			$this->template->set_title ( 'Edit Next Date of Hearing' );
			$this->template->loadview('templates/default_admin','backend/cases/edit_ndoh',$data);
			
	}
	
	// update next hearing date of case
	public function update_ndoh()
	{
		$data = array(
				'user_id'		=> $this->ion_auth->user()->row()->id,
				'id' 			=> strip_tags($this->input->post('id',TRUE)),
				'court_id' 		=> strip_tags($this->input->post('court_id',TRUE)),
				'case_id' 		=> strip_tags($this->input->post('case_id',TRUE)),
				'order_sheet' 	=> strip_tags($this->input->post('order_sheet',TRUE)),
				'doh' 			=> strip_tags($this->input->post('doh',TRUE)),
				'ndoh' 			=> strip_tags($this->input->post('ndoh',TRUE)),
				'nproc_id' 		=> strip_tags($this->input->post('nproc_id',TRUE)),
				'stage_id' 		=> strip_tags($this->input->post('stage_id',TRUE)),
				'remarks' 		=> strip_tags($this->input->post('remarks',TRUE)),
		);
	
		$data['ndoh'] = @date('Y-m-d', @strtotime($data['ndoh']));
	
		//$this->form_validation->set_rules('ndoh', 'hearing date', 'required');
		$this->form_validation->set_rules('ndoh', 'next date', 'required|callback_check_only_edit_ndoh['.$data['case_id'].']');
		$this->form_validation->set_rules('nproc_id', 'next proceeding', 'required');
		$this->form_validation->set_rules('stage_id', 'stage', 'required');
	
		if ($this->form_validation->run() == FALSE)
		{
			$data ['ndoh'] = $this->cases_model->get_ndoh_by_id ( $data['id'] );
				
			$type = $this->db->select('court_type, case_type')->from('cases')->where('case_id',$data['ndoh']->case_id)->get()->row();	
			$data['type'] = array ('court' => $type->court_type, 'case' => $type->case_type);
			// dropdown list
			$data['nprocs'] = $this->next_proceeding_model->get_next_proceedings_for_cases( $data['type'] );
			$data['stages'] = $this->stages_model->get_stages_for_cases( $data['type'] );
				
// 			$data['ndoh'] = (object) $data;
				
			$this->template->set_title ( 'Edit Next Date of Hearing' );
			$this->template->loadview('templates/default_admin','backend/cases/edit_ndoh',$data);
				
		}
		else
		{
			$valid = $this->courts_model->validate_court($data['user_id'],$data['court_id']);
				
			if (!$this->ion_auth->is_Admin() AND (count($valid) == 0))
			{
				$this->session->set_flashdata('message','Your are not authrized user for this court!');
				$this->session->set_flashdata('message_type','danger');
				redirect ( base_url('admin/cases') );
			}
			else
			{
				if( $this->cases_model->update_ndoh($data) > 0 )
				{
					$this->session->set_flashdata('message','This next date of hearing have updated successfully!');
					$this->session->set_flashdata('message_type','success');
				}
				else
				{
					$this->session->set_flashdata('message','This next date of hearing could not be updated!');
					$this->session->set_flashdata('message_type','danger');
				}
	
			}
			redirect ( base_url('admin/cases') );
		}
	}
	
	// delete next proceeding
	public function delete_ndoh($id)
	{
		if (!$id) {
			$this->session->set_flashdata ( 'message', 'This next proceeding could not be found!' );
			$this->session->set_flashdata ( 'message_type', 'warning' );
			redirect(base_url('admin/cases_list'));
		}
		else
		{
			if ($this->ion_auth->is_admin()) {
				if ($this->cases_model->delete_ndoh($id) > 0)
				{
					$this->session->set_flashdata ( 'message', 'This hearing date have deleted successfully!' );
					$this->session->set_flashdata ( 'message_type', 'success' );
				}
				else
				{
					$this->session->set_flashdata ( 'message', 'This hearing date could not be deleted!' );
					$this->session->set_flashdata ( 'message_type', 'danger' );
				}
			}
			else
			{
				$this->session->set_flashdata ( 'message', 'You are not authrized to delete this case!' );
				$this->session->set_flashdata ( 'message_type', 'danger' );
			}
		}
		
		redirect(base_url('admin/cases'));
		
	}
	
	// delete case by case id
	public function delete($id)
	{
		if (!$id) {
			$this->session->set_flashdata ( 'message', 'This case could not be found!' );
			$this->session->set_flashdata ( 'message_type', 'warning' );
			redirect(base_url('admin/cases_list'));
		}
		else
		{
			if ($this->ion_auth->is_admin()) {
				if ($this->cases_model->delete_case($id) > 0)
				{
					$this->session->set_flashdata ( 'message', 'This case have deleted successfully!' );
					$this->session->set_flashdata ( 'message_type', 'success' );
				}
				else
				{
					$this->session->set_flashdata ( 'message', 'This case could not be deleted!' );
					$this->session->set_flashdata ( 'message_type', 'danger' );
				}
			}
			else
			{
				$this->session->set_flashdata ( 'message', 'You are not authrized to delete this case!' );
				$this->session->set_flashdata ( 'message_type', 'danger' );
			}
		}
	
		redirect(base_url('admin/cases'));
	}
	
}
?>