<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {
   public function __construct()
   {
      parent::__construct();
      $this->load->model('gallery_model');
      $this->load->library('pagination');
      
      // add css & js files
      $this->template->add_css('assets/plugins/magnific-popup/dist/magnific-popup.css');
      $this->template->add_js('assets/plugins/isotope/dist/isotope.pkgd.min.js');
      $this->template->add_js('assets/plugins/magnific-popup/dist/jquery.magnific-popup.min.js');
   }
   public function index() {
	   	$this->template->set_title('Gallery');
	   	$this->template->loadview('templates/default','frontend/gallery/index');
   }

   public function photo_gallery() {
   	
   	$config = array();
	$config["base_url"] = base_url('gallery/photo_gallery');
	
	$total_row = $this->gallery_model->record_count();
	$config["total_rows"] = $total_row;
	$config["per_page"] = 12;
	$config["uri_segment"] = 3;
	$choice = $config["total_rows"] / $config["per_page"];
	$config["num_links"] = round($choice);
	
	$config['use_page_numbers'] = TRUE;
	$config['num_links'] = $total_row;
	$config['cur_tag_open'] = '&nbsp;<a class="current">';
	$config['cur_tag_close'] = '</a>';
	$config['next_link'] = 'Next';
	$config['prev_link'] = 'Previous';

	$this->pagination->initialize($config);
	
	if($this->uri->segment(3)){
		$page = ($this->uri->segment(3)) ;
	}
	else{
		$page = 0;
	}

	$data["images"] = $this->gallery_model->fetch_images($config["per_page"], $page);
	
	$str_links = $this->pagination->create_links();
	$data["links"] = explode('&nbsp;',$str_links );
   	
   	$this->template->set_title('Photo Gallery');
   	$this->template->loadview('templates/default','frontend/gallery/photo_gallery', $data);
   }

}