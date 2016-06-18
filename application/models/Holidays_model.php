<?php
class Holidays_model extends CI_Model {
	// add city name
	public function save($data)
	{
		//set value by name
		$this->db->set('event', $data['event']);
		$this->db->set('date', @date('Y-m-d', @strtotime($data['date'])) );
		$this->db->set('sorting', $data['sorting']);
		$this->db->set('created_user_id', $data['user_id']);
		$this->db->set('created_date', $data['dateTime']);
		$this->db->set('status', $data['status']);
		
		$status = $this->db->insert('holidays');
		$status = $this->db->affected_rows();
		return $status;
	}
	// update city name
	public function update($data)
	{
		//set value by name
		$this->db->set('event', $data['event']);
		$this->db->set('date', @date('Y-m-d', @strtotime($data['date'])) );
		$this->db->set('sorting', $data['sorting']);
		$this->db->set('modified_user_id', $data['user_id']);
		$this->db->set('modified_date', $data['dateTime']);
		$this->db->set('status', $data['status']);
		
		$this->db->where('id',$data['id']);
		$status = $this->db->update('holidays');
		$status = $this->db->affected_rows();
		return $status;
	}
	// delete city name
	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('holidays');
		$result = $this->db->affected_rows();
		return $result;
	}
	// get city name by id
	public function get_event($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('holidays');
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	// get all holidays
	public function get_all_events()
	{
		$this->db->select('*');
		$this->db->from('holidays');
		$this->db->order_by('sorting','asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;	
	}
	// get only published list
	public function get_publish_events()
	{
		$this->db->select('*');
		$this->db->from('holidays');
		$this->db->where('status','Publish');
		$this->db->order_by('sorting','asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	// * check unique court name on add/edit *court name
	public function validate_date($id)
	{
		$this->db->select('date');
		$this->db->from('holidays');
		$this->db->where('id !=', $id);
		$query = $this->db->get();
		$result = $query->result();
	
		$dates =  array();
		foreach ($result as $r){
			$dates[$r->date] = $r;
		}
		return $dates;
	}
}
