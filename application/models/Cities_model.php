<?php
class Cities_model extends CI_Model {
	// add city name
	public function save($data)
	{
		//set value by name
		$this->db->set('city_name', $data['city_name']);
		$this->db->set('sorting', $data['sorting']);
		$this->db->set('created_user_id', $data['created_user_id']);
		$this->db->set('created_date', $data['created_date']);
		$this->db->set('status', $data['status']);
		
		$status = $this->db->insert('cities');
		$status = $this->db->affected_rows();
		return $status;
	}
	// update city name
	public function update($data)
	{
		//set value by name
		$this->db->set('city_name', $data['city_name']);
		$this->db->set('sorting', $data['sorting']);
		$this->db->set('modified_user_id', $data['modified_user_id']);
		$this->db->set('modified_date', $data['modified_date']);
		$this->db->set('status', $data['status']);
		
		$this->db->where('id',$data['id']);
		$status = $this->db->update('cities');
		$status = $this->db->affected_rows();
		return $status;
	}
	// delete city name
	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('cities');
		$result = $this->db->affected_rows();
		return $result;
	}
	// get city name by id
	public function get_city($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('cities');
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	// get all added cities
	public function cities()
	{
		$this->db->select('*');
		$this->db->from('cities');
		$this->db->order_by('sorting','asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;	
	}
	// get only published list
	public function list_cities()
	{
		$this->db->select('*');
		$this->db->from('cities');
		$this->db->where('status','Publish');
		$this->db->order_by('sorting','asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	// check validation on update
	public function edit_unique($id)
	{
		$this->db->select('*');
		$this->db->where('id !=', $id);
		$this->db->from('cities');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
}
