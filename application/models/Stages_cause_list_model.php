<?php
class Stages_cause_list_model extends CI_Model
{	
	// get all stages by court_id
	public function get_stages_by_court_id($court_id)
	{
		$this->db->select('a.*, b.stage_name');
		$this->db->from('stages_cause_list as a');
		$this->db->join('stages as b', 'b.id = a.stage_id');
		$this->db->where('a.court_id', $court_id);
		$this->db->order_by('a.sorting asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	// get single stage by id
	public function get_stage($id)
	{
		$this->db->select('*');
		$this->db->from('stages_cause_list');
		$this->db->where('id',$id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	// save
	public function save($data)
	{
		//set value by name
		$this->db->set('stage_id', $data['stage_id']);
		$this->db->set('court_id', $data['court_id']);
		$this->db->set('sorting', $data['sorting']);
		$this->db->set('created_user_id', $data['user_id']);
		$this->db->set('created_date', $data['dateTime']);
		$this->db->set('status', $data['status']);
		
		$status = $this->db->insert('stages_cause_list');
		$status = $this->db->affected_rows();
		return $status;
	}
	// update
	public function update($data)
	{
		//set value by name
		$this->db->set('stage_id', $data['stage_id']);
		$this->db->set('court_id', $data['court_id']);
		$this->db->set('sorting', $data['sorting']);
		$this->db->set('modified_user_id', $data['user_id']);
		$this->db->set('modified_date', $data['dateTime']);
		$this->db->set('status', $data['status']);
		
		$this->db->where('id',$data['id']);
		$this->db->update('stages_cause_list');
		$status = $this->db->affected_rows();
		return $status;
	}

	// delete by id
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('stages_cause_list');
		$status = $this->db->affected_rows();
		return $status;
	}
	
	// * validate category name
	public function validate_stage_name($id)
	{
		$this->db->select('stage_id, court_id');
		$this->db->from('stages_cause_list');
		$this->db->where('id !=', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
}