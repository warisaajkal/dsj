<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Contact_us extends CI_Controller {
	public function __construct() 

	{
		parent::__construct ();
	}
	
	// custom validation function to accept only alphabets and space input
	function alpha_space_only($str) {
		if (! preg_match ( "/^[a-zA-Z ]+$/", $str )) {
			$this->form_validation->set_message ( 'alpha_space_only', 'The %s field must contain only alphabets and space' );
			return FALSE;
		} else {
			return TRUE;
		}
	}
	function index() {
		
		// set validation rules
		$this->form_validation->set_rules ( 'name', 'Name', 'trim|required|callback_alpha_space_only' );
		$this->form_validation->set_rules ( 'email', 'Emaid ID', 'trim|required|valid_email' );
		$this->form_validation->set_rules ( 'subject', 'Subject', 'trim|required' );
		$this->form_validation->set_rules ( 'message', 'Message', 'trim|required' );
		// run validation on form input
		if ($this->form_validation->run () == FALSE) 
		{
			// validation fails
			$this->template->set_title ( 'Contact Us' );
			$this->template->loadview ( 'templates/default', 'frontend/contact_form' );
		} 
		else 
		{
			// get the form data
			$name = $this->input->post ( 'name' );
			$email = $this->input->post ( 'email' );
			$subject = $this->input->post ( 'subject' );
			$message = $this->input->post ( 'message' );
				
			// set to_email id to which you want to receive mails
// 			$to_email = 'waris@dsjfaisalabad.gov.pk';
			$to_email = 'admin@dsjfaisalabad.gov.pk';
			
// 			$this->load->library('email');
			
// 			$this->email->initialize(array(
// 			  'protocol' => 'smtp',
// 			  'smtp_host' => 'ssl://smtp.googlemail.com',
// 			  'smtp_port' => 465,
// 			  'smtp_user' => 'warisdsc@gmail.com',
// 			  'smtp_pass' => 'malik1629',
// 			  'smtp_port' => 587,
// 			  'crlf' => "\r\n",
// 			  'newline' => "\r\n"
// 			));

			$this->load->library('email');
			
			// send mail
			$this->email->from ( $to_email, $name );
			$this->email->to ( $to_email );
			$this->email->cc( $email );
			$this->email->subject ( $subject );
			$this->email->message ( $message );
			
			if ($this->email->send ()) 
			{
				// mail sent
				$this->session->set_flashdata ( 'msg', '<div class="alert alert-success text-center">Your mail has been sent successfully!</div>' );
				redirect ( base_url ( 'contact_us' ) );
			} 
			else 
			{
				// error
// 				echo $this->email->print_debugger();
				
				$this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center">There is error in sending mail! Please try again later</div>' );
				redirect ( base_url ( 'contact_us' ) );
			}
		}
	}
}

