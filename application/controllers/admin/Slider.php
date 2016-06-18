<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends Admin_Controller {
   public function __construct()
   {
      parent::__construct();
      // set timezone
      date_default_timezone_set('Asia/Karachi');
      
      $this->load->model('slider_model');
   }
   
   public function index()
   {
	   	// add css & js files
	   	$this->template->add_css('assets/plugins/magnific-popup/dist/magnific-popup.css');
	   	$this->template->add_js('assets/plugins/isotope/dist/isotope.pkgd.min.js');
	   	$this->template->add_js('assets/plugins/magnific-popup/dist/jquery.magnific-popup.min.js');
   	
   		// get upload images
   		$data['images'] = $this->slider_model->get_images();
   		
   		$this->template->set_title('Slider Images');
   		$this->template->loadview('templates/default_admin','backend/slider/index', $data);
   }
   
   public function add() {
   
		$this->form_validation->set_rules('image_tag', 'Image taq', 'required');
   
	   	if ($this->form_validation->run() == FALSE)
	   	{
	   		$this->template->set_title('Add Slider Image');
	   		$this->template->loadview('templates/default_admin','backend/slider/add_image');
	   	}
	   	else
	   	{	
   			// set the filter image types
   			$config['upload_path'] 	 ='./assets/uploads/slider';
   		   	$config['allowed_types'] = 'gif|jpg|png';
   		   	$config['remove_spaces'] = TRUE;
   		   	$config['overwrite'] 	 = false;
   		   	$config['max_size'] 	 = '1000';
   		   	$config['max_width']	 = '1920';
   		   	$config['max_height']    = '938';
   		   	$config['min_width']  	 = '1024';
   		   	$config['min_height']  	 = '500';
   
   			$this->load->library('upload', $config);
   
	   		if ( ! $this->upload->do_upload('userfile'))
	   		{
	   			$error = ['error' => $this->upload->display_errors()];
	   
	   			$this->template->set_title('Add slider image');
	   			$this->template->loadview('templates/default_admin','backend/slider/add_image', $error);
	   		}
	   		else
	   		{
	   			$data['upload_data'] = $this->upload->data();
	   			$data ['caption'] 	 = strip_tags($this->input->post('caption', TRUE));
	   			$data ['image_tag']		 = strip_tags($this->input->post('image_tag', TRUE));
	   
	   			if($this->slider_model->save($data) > 0)
	   			{
	   				$this->session->set_flashdata('message','New image has been added');
	   				$this->session->set_flashdata('message_type','success');
	   			}
	   			else
	   			{
	   				$this->session->set_flashdata('message','Image has been not added');
	   				$this->session->set_flashdata('message_type','danger');
	   			}
	   
	   			redirect(base_url().'admin/slider');
	   		}
   		}
   }
   
   public function edit($id)
   {
   		$this->form_validation->set_rules('image_tag', 'Image tag', 'required');
   		
   		$data['image'] = $this->slider_model->find_image($id);
   
	   	if ($this->form_validation->run() == FALSE)
	   	{
	   		$this->template->set_title('Edit Image');
	   		$this->template->loadview('templates/default_admin','backend/slider/edit_image', $data);
	   	}
	   	else
	   	{
	   		if($_FILES['userfile']['size'] > 0)
	   		{
	   			// set the filter image types
	   			$config['upload_path']   = './assets/uploads/slider';
	   		   	$config['allowed_types'] = 'gif|jpg|png';
	   		   	$config['remove_spaces'] = TRUE;
	   		   	$config['overwrite'] 	 = false;
	   		   	$config['max_size'] 	 = '1000';
	   		   	$config['max_width']  	 = '1920';
	   		   	$config['max_height']  	 = '938';
	   		   	$config['min_width']  	 = '1024';
	   		   	$config['min_height']    = '500';
	   
	   			$this->load->library('upload', $config);
	   
	   			if ( ! $this->upload->do_upload())
	   			{
	   				$data['error'] = $this->upload->display_errors();
	   
	   				$this->template->set_title('Edit Image');
	   				$this->template->loadview('templates/default_admin','backend/slider/edit_image', $data);
	   			}
	   			else
	   			{	
	   				// delete old file
	   				unlink('assets/uploads/slider'.$image->file_name);
	   				
	   				$file = $this->upload->data();
	   				$filedata['file_name'] 	= $file['file_name'];
	   				$filedata['full_path'] 	= $file['full_path'];
	   				$filedata['file_path'] 	= $file['file_path'];
	   				$filedata['file_type'] 	= $file['file_type'];
	   				$filedata['file_ext'] 	= $file['file_ext'];
	   				$filedata['file_size']  = $file['file_size'];
	   				
	   				$filedata['caption']	= set_value('caption');
	   				$filedata['image_tag']	= set_value('image_tag');
	   				
	   				if($this->slider_model->update($id, $filedata) > 0)
	   				{
	   					$this->session->set_flashdata('message','New image has been updated.');
	   					$this->session->set_flashdata('message_type','success');
	   				}
	   				else
	   				{
	   					$this->session->set_flashdata('message','Image has been not update');
	   					$this->session->set_flashdata('message_type','danger');
	   				}
	   				 
	   				redirect(base_url('admin/slider'));
					
	   			}
	   		}
	   		else 
	   		{
	   			$filedata['caption']	= set_value('caption');
	   			$filedata['image_tag']	= set_value('image_tag');
	   			
	   			if($this->slider_model->update($id, $filedata) > 0)
	   			{
	   				$this->session->set_flashdata('message','New image has been updated.');
	   				$this->session->set_flashdata('message_type','success');
	   			}
	   			else
	   			{
	   				$this->session->set_flashdata('message','Image has been not update');
	   				$this->session->set_flashdata('message_type','danger');
	   			}
	   				
	   			redirect(base_url('admin/slider'));
	   			
	   		}
   		}
   }
   
   public function delete($id) {
   		$this->slider_model->delete($id);
   		$this->session->set_flashdata('message','Image has been deleted.');
   	 
   		redirect( base_url('admin/slider') );
   }
}