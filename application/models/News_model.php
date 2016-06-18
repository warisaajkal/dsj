<?php defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends CI_Model {
	
 public function __construct() {
	parent::__construct();
 }
 
	 // upload slider image
	 public function save($data)
	 {	
	 	if (array_key_exists('file_name', $data)) {
		 	// set value by name
		 	$this->db->set('file_name', $data['file_name']);
		 	$this->db->set('file_path', $data['file_path']);
		 	$this->db->set('full_path', $data['full_path']);
		 	$this->db->set('file_type', $data['file_type']);
		 	$this->db->set('file_ext', $data['file_ext']);
		 	$this->db->set('file_size', $data['file_size']);
	 	}
	 	// set value by name
	 	$this->db->set('title', $data['title']);
	 	$this->db->set('description', $data['description']);
	 	$this->db->set('status', $data['status']);
	 	$this->db->set('date', $date['date']);
	 
	 	// insert file data
	 	$this->db->insert('news');
	 	$result = $this->db->affected_rows();
	 	return $result;

	}
	
	public function update($id, $filedata)
	{
		try{
			$this->db->where('id',$id)->limit(1)->update('news', $filedata);
			return true;
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function get_all_news()
	{
		$this->db->select('*');
		$this->db->from('news');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function get_all_published_news()
	{
		$this->db->select('*');
		$this->db->from('news');
		$this->db->where('status', 'Publish');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function get_news_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('news');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	public function delete($id) {
	
		try {
			// delete picture
			$row = $this->db->get_where('news', array('id' => $id))->row();
			
			// delete old file
			unlink('assets/uploads/news/'.$row->file_name);
				
			$this->db->where('id',$id)->delete('news');
			return true;
		}
	
		//catch exception
		catch(Exception $e) {
			echo $e->getMessage();
		}
	}
	
	//get single decision_files
// 	public function download_file($filename)
// 	{
// 		$this->db->select('*');
// 		$this->db->from('news');
// 		$this->db->where('file_name', $filename);
// 		$query = $this->db->get();
// 		$result = $query->row();
// 		return $result;
// 	}
}