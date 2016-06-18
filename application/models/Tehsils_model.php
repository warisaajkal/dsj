<?php
class Tehsils_model extends CI_Model {
	
	// add tehsil name	
	public function save($data)
	{
		//set value by name
		$this->db->set('teh_name', $data['teh_name']);
		$this->db->set('city_id', $data['city_id']);
		$this->db->set('sorting', $data['sorting']);
		$this->db->set('created_user_id', $data['created_user_id']);
		$this->db->set('created_date', $data['created_date']);
		$this->db->set('status', $data['status']);
		
		$status = $this->db->insert('tehsils');
		$status = $this->db->affected_rows();
		return $status;
	}
	
	public function update($data)
	{	
		//set value by name
		$this->db->set('teh_name', $data['teh_name']);
		$this->db->set('city_id', $data['city_id']);
		$this->db->set('sorting', $data['sorting']);
		$this->db->set('modified_user_id', $data['modified_user_id']);
		$this->db->set('modified_date', $data['modified_date']);
		$this->db->set('status', $data['status']);
		
		$this->db->where('id',$data['id']);
		$status = $this->db->update('tehsils');
		$status = $this->db->affected_rows();
		return $status;
	}
	
	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tehsils');
		$result = $this->db->affected_rows();
		return $result;
	}
	
	public function get_tehsil($id)
	{
		$this->db->select('a.*, b.city_name');
		$this->db->from('tehsils as a');
		$this->db->join('cities as b','a.city_id=b.id', 'left');
		$this->db->where('a.id', $id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	
	// get all tehsils
	public function tehsils()
	{
		$this->db->select('a.*, b.city_name');
		$this->db->from('tehsils as a');
		$this->db->join('cities as b','a.city_id=b.id','left');
		$this->db->order_by('a.id ASC, a.city_id ASC, a.sorting ASC');
		$query = $this->db->get();
		$result = $query->result();
		return $result;	
	}
	// get all tehsils
	public function list_tehsils()
	{
		$this->db->select('a.*, b.city_name');
		$this->db->from('tehsils as a');
		$this->db->join('cities as b','a.city_id=b.id','left');
		$this->db->where('a.status','Publish');
		$this->db->where('b.status','Publish');
		$this->db->order_by('a.id ASC, a.city_id ASC, a.sorting ASC');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	// check validation on update
	public function edit_unique($id)
	{
		$this->db->select('*');
		$this->db->where('id !=', $id);
		$this->db->from('tehsils');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
}
