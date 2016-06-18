<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Slider_model extends CI_Model {
	
 public function __construct() {
	parent::__construct();
 }
 
	 // upload slider image
	 public function save($data)
	 {	
	 	// set value by name
	 	$this->db->set('file_name', $data['upload_data']['file_name']);
	 
	 	$this->db->set('file_path', $data['upload_data']['file_path']);
	 	$this->db->set('full_path', $data['upload_data']['full_path']);
	 
	 	$this->db->set('file_type', $data['upload_data']['file_type']);
	 	$this->db->set('file_ext', $data['upload_data']['file_ext']);
	 	$this->db->set('file_size', $data['upload_data']['file_size']);
	 	$this->db->set('caption', $data['caption']);
	 	$this->db->set('image_tag', $data['image_tag']);
	 
	 	// insert file data
	 	$this->db->insert('slider');
	 	$result = $this->db->affected_rows();
	 	return $result;

	}
	
	public function update($id, $data)
	{
		try{
			$this->db->where('id',$id)->limit(1)->update('slider', $data);
			return true;
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function get_images()
	{
		$this->db->select('*');
		$this->db->from('slider');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function find_image($id)
	{
		$this->db->select('*');
		$this->db->from('slider');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	public function delete($id) {
	
		try {
			// delete picture
			$row = $this->db->get_where('slider', array('id' => $id))->row();
			
			// delete old file
			unlink('assets/uploads/slider'.$row->file_name);
				
			$this->db->where('id',$id)->delete('slider');
			return true;
		}
	
		//catch exception
		catch(Exception $e) {
			echo $e->getMessage();
		}
	}
}