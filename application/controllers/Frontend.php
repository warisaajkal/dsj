<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {
	
	public function __construct() {
		parent::__construct ();
		
		//load slider model
		$this->load->model('slider_model');
		// load courts model
		$this->load->model('courts_model');
		// load sessions cases categories model
		$this->load->model('categories_model');
		// load news model
		$this->load->model('news_model');
		
	}
	
	public function index()
	{
		// add css & js files
		$this->template->add_css('assets/plugins/owl.carousel/dist/assets/owl.carousel.min.css');
		$this->template->add_css('assets/plugins/owl.carousel/dist/assets/owl.theme.default.min.css');
		$this->template->add_js('assets/plugins/owl.carousel/dist/owl.carousel.min.js');
		
		// add css & js files for datepicker
		$this->template->add_css('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
		$this->template->add_js('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
		
		// load js file
		$this->template->add_js('assets/plugins/parsleyjs/dist/parsley.min.js');
		// load js file for news scroll
		$this->template->add_js('assets/js/jquery.newstape.js');
		
		$data['courts'] = $this->courts_model->get_publish_courts_list();
		
		$criminal = 'criminal';
		$civil = 'civil';
		
		$data ['criminal'] = $this->categories_model->get_categories_by_case_type($criminal);
		$data ['civil'] = $this->categories_model->get_categories_by_case_type($civil);
		
		// get upload images
		$data['images'] = $this->slider_model->get_images();
		
		// get published news
		$data['news'] = $this->news_model->get_all_published_news();
		
		$this->template->set_title('District &amp; Sessions Court Faisalabad');
		$this->template->loadview('templates/default','frontend/index', $data);
	}
	
	public function page_not_found(){
		$this->template->set_title('Page not found');
		$this->template->loadview('templates/default','errors/error_404');
	}
	
	// download link file
	public function download($filename) {
		//load the download helper
		$this->load->helper('download');
		 
		//    	$file = $this->news_model->download_file($filename);
		 
		//application/views/uploads/decision
		$data = file_get_contents('./assets/uploads/news/'.$filename);
		 
		//Read the file's contents
		$name = $file_name;
		 
		//use this function to force the session/browser to download the file uploaded by the user
		force_download($name, $data);
	}
}
