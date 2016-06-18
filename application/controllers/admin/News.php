<?php defined('BASEPATH') OR exit('No direct script access allowed');

class News extends Admin_Controller {
   public function __construct()
   {
      parent::__construct();
      // set timezone
      date_default_timezone_set('Asia/Karachi');
      
      $this->load->model('news_model');
   }
   
   public function index()
   {
	   	// add css & js files
	   	$this->template->add_css('assets/plugins/datatables/jquery.dataTables.min.css');
	   	$this->template->add_js('assets/plugins/datatables/jquery.dataTables.min.js');
	   	$this->template->add_js('assets/plugins/datatables/dataTables.bootstrap.js');
   	
   		// get upload images
   		$data['news'] = $this->news_model->get_all_news();
   		
   		$this->template->set_title('All News');
   		$this->template->loadview('templates/default_admin','backend/news/index', $data);
   }
   
//    public function formData()
//    {
//    	$this->inputsData = array(
//    			'title' 		=> strip_tags($this->input->post('title', TRUE)),
//    			'description' 	=> strip_tags($this->input->post('description', TRUE)),
//    			'status'		=> strip_tags($this->input->post('status', TRUE)),
//    		);
//    }
   
  
   
   public function add ()
   {
	   	$this->template->set_title('Add News');
	   	$this->template->loadview('templates/default_admin','backend/news/add');
   }
   
   public function save()
   {   	
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('status', 'status', 'required');
   
	   	if ($this->form_validation->run() == FALSE)
	   	{
	   		$this->template->set_title('Add News');
	   		$this->template->loadview('templates/default_admin','backend/news/add');
	   	}
	   	else
	   	{
	   		if($_FILES['userfile']['size'] > 0)
	   		{
	   			// set the filter
	   			$config['upload_path'] 	 ='./assets/uploads/news';
	   			$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx|xlx|xlsx|zip';
	   			$config['remove_spaces'] = TRUE;
	   			$config['overwrite'] 	 = FALSE;
	   			$config['max_size'] 	 = '10240';
	   				
	   			$this->load->library('upload', $config);
	   			
	   			if ( ! $this->upload->do_upload('userfile'))
	   			{
	   				$data['error'] = $this->upload->display_errors();
	   					
	   				$this->template->set_title('Add News');
	   				$this->template->loadview('templates/default_admin','backend/news/add', $data);
	   			}
	   			else
	   			{
	   				$data = $this->upload->data();
	   				$data ['title'] 	 = strip_tags($this->input->post('title', TRUE));
	   				$data ['description']= strip_tags($this->input->post('description', TRUE));
	   				$data ['status'] = strip_tags($this->input->post('status', TRUE));
	   				$data ['date'] = date('Y-m-d H:i:s');
	   				 
	   				if($this->news_model->save($data) > 0)
	   				{
	   					$this->session->set_flashdata('message','New News has been saved!');
	   					$this->session->set_flashdata('message_type','success');
	   				}
	   				else
	   				{
	   					$this->session->set_flashdata('message','News has been not saved!');
	   					$this->session->set_flashdata('message_type','danger');
	   				}
	   				redirect(base_url('admin/news'));
	   			
	   			}
   			
   			}
   			else 
   			{
   				$data ['title'] 	 = strip_tags($this->input->post('title', TRUE));
   				$data ['description']= strip_tags($this->input->post('description', TRUE));
   				$data ['status'] = strip_tags($this->input->post('status', TRUE));
   					
   				if($this->news_model->save($data) > 0)
   				{
   					$this->session->set_flashdata('message','New News has been saved!');
   					$this->session->set_flashdata('message_type','success');
   				}
   				else
   				{
   					$this->session->set_flashdata('message','News has been not saved!');
   					$this->session->set_flashdata('message_type','danger');
   				}
   				
   				redirect(base_url('admin/news'));
   			}
   		}
   }
   
   public function edit($id)
   {
   		$this->form_validation->set_rules('title', 'title', 'required');
   		
   		$data['news'] = $this->news_model->get_news_by_id($id);
   
	   	if ($this->form_validation->run() == FALSE)
	   	{
	   		$this->template->set_title('Edit News');
	   		$this->template->loadview('templates/default_admin','backend/news/edit', $data);
	   	}
	   	else
	   	{
	   		if($_FILES['userfile']['size'] > 0)
	   		{
	   			// set the filter file
	   			$config['upload_path']   = './assets/uploads/news';
	   		   	$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx|xlx|xlsx|zip';
	   		   	$config['remove_spaces'] = TRUE;
	   		   	$config['overwrite'] 	 = false;
	   		   	$config['max_size'] 	 = '1024 * 8';
	   
	   			$this->load->library('upload', $config);
	   			$this->upload->initialize($config);
	   			
	   			if ( ! $this->upload->do_upload('userfile')) 
	   			{
	   				$data['error'] = $this->upload->display_errors();
	   				$this->template->set_title('Edit News');
	   				$this->template->loadview('templates/default_admin','backend/news/edit', $data);
	   			}
	   			else
	   			{
	   				// delete old file
	   				unlink('assets/uploads/news/'.$data['news']->file_name);
	   				
	   				$file = $this->upload->data();
	   				$filedata['file_name'] 	= $file['file_name'];
	   				$filedata['full_path'] 	= $file['full_path'];
	   				$filedata['file_path'] 	= $file['file_path'];
	   				$filedata['file_type'] 	= $file['file_type'];
	   				$filedata['file_ext'] 	= $file['file_ext'];
	   				$filedata['file_size']  = $file['file_size'];
	   				
	   				$filedata['title'] = set_value('title');
	   				$filedata['description'] = set_value('description');
	   				$filedata['status'] = set_value('status');
	   				
	   				if($this->news_model->update($id, $filedata) > 0)
	   				{
	   					$this->session->set_flashdata('message','New news is updated.');
	   					$this->session->set_flashdata('message_type','success');
	   				}
	   				else
	   				{
	   					$this->session->set_flashdata('message','news is not update!');
	   					$this->session->set_flashdata('message_type','danger');
	   				}
	   				
	   				redirect(base_url('admin/news'));	
	   			}
	   		}
	   		else 
	   		{
	   			
	   			$filedata['title'] = set_value('title');
	   			$filedata['description'] = set_value('description');
	   			$filedata['status'] = set_value('status');
	   			
	   			if($this->news_model->update($id, $filedata) > 0)
	   			{
	   				$this->session->set_flashdata('message','New news is updated.');
	   				$this->session->set_flashdata('message_type','success');
	   			}
	   			else
	   			{
	   				$this->session->set_flashdata('message','news is not update!');
	   				$this->session->set_flashdata('message_type','danger');
	   			}
	   			
	   			redirect(base_url('admin/news'));
	   			
	   			
	   		}
   
   			
   		}
	   	
   }
   
   public function delete($id) {
   		$this->news_model->delete($id);
   		$this->session->set_flashdata('message','This news have deleted.');
   	 
   		redirect( base_url('admin/news') );
   }
   
   // upload only pdf file
   function pdf_only()
   {
   	//application/pdf
   
   	$type = $_FILES['userfile']['type'];
   
   	$this->form_validation->set_message('pdf_only', 'Only allowed pdf file!');
   
   
   	if ($type !=='application/pdf')
   	{
   		return false;
   	}
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