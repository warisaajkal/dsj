<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_authentic extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->session->set_userdata('url',uri_string());
	}
	
	// for admin authentication msg
	public function index()
	{
		$this->template->set_title('User not authorized');
		$this->template->loadview('templates/default_admin', 'backend/msg/user_authentication');
	}
	
	// user put wrong data msg
	public function wrong_data()
	{
		$this->template->set_title('User not authorized');
		$this->template->loadview('templates/default_admin', 'backend/msg/wrong_data');
	}
	
	// user not access
	public function user_access()
	{
		$this->template->set_title('User not authorized');
		$this->template->loadview('templates/default_admin', 'backend/msg/user_access');
	}
	
}