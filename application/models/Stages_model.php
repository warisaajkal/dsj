<?php
class Stages_model extends CI_Model
{
	// get courts list
	public function get_courts_list()
	{
		$this->db->select('a.court_id, b.court_name, c.desgn_name');
		$this->db->from('stages as a');
		$this->db->join('courts as b', 'a.court_id = b.court_id');
		$this->db->join('courts_desgn as c', 'c.id = b.desgn_id');
		$this->db->order_by('b.sorting asc');
		$this->db->group_by('a.court_id');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
		
	}
	// get all stages for admin
// 	public function get_stages_for_admin()
// 	{
// 		$this->db->select('a.*,b.court_name');
// 		$this->db->from('stages as a');
// 		$this->db->join('courts as b', 'a.court_id = b.court_id', 'left');
// 		$this->db->order_by('a.court_id asc, a.court_type desc, a.case_type desc, a.sorting asc');
// 		$query = $this->db->get();
// 		$result = $query->result();
// 		return $result;
// 	}
	
	// get all stages by court_id
	public function get_stages()
	{
		$this->db->select('*');
		$this->db->from('stages');
		//$this->db->where('court_id', $court_id);
		$this->db->order_by('court_type desc, case_type desc, sorting asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	// get single category by id
	public function get_stage($id)
	{
		$this->db->select('*');
		$this->db->from('stages');
		$this->db->where('id',$id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	// save cat
	public function save($data)
	{
		//set value by name
		$this->db->set('stage_name', $data['stage_name']);
// 		$this->db->set('court_id', $data['court_id']);
		$this->db->set('court_type', $data['court_type']);
		$this->db->set('case_type', $data['case_type']);
		$this->db->set('sorting', $data['sorting']);
		$this->db->set('created_user_id', $data['user_id']);
		$this->db->set('created_date', $data['dateTime']);
		$this->db->set('status', $data['status']);
		
		$status = $this->db->insert('stages');
		$status = $this->db->affected_rows();
		return $status;
	}
	// update
	public function update($data)
	{
		//set value by name
		$this->db->set('stage_name', $data['stage_name']);
// 		$this->db->set('court_id', $data['court_id']);
		$this->db->set('court_type', $data['court_type']);
		$this->db->set('case_type', $data['case_type']);
		$this->db->set('sorting', $data['sorting']);
		$this->db->set('modified_user_id', $data['user_id']);
		$this->db->set('modified_date', $data['dateTime']);
		$this->db->set('status', $data['status']);
		
		$this->db->where('id',$data['id']);
		$this->db->update('stages');
		$status = $this->db->affected_rows();
		return $status;
	}

	// delete by id
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('stages');
		$status = $this->db->affected_rows();
		return $status;
	}
	
	// * validate category name
	public function validate_stage_name($id)
	{
		$this->db->select('stage_name, court_type, case_type');
		$this->db->from('stages');
		$this->db->where('id !=', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	// get stages list for cases
	public function get_stages_for_cases($data)
	{
		$where = array( 'court_type' => $data['court'], 'case_type' => $data['case'], 'status' => 'Publish' );
	
		$this->db->select('*');
		$this->db->from('stages');
		$this->db->where($where);
		$this->db->order_by('sorting asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	// get stages list for cases
	public function get_stages_for_court( $courtType )
	{
		$where = array( 'court_type' => $courtType, 'status' => 'Publish' );
	
		$this->db->select('*');
		$this->db->from('stages');
		$this->db->where($where);
		$this->db->order_by('sorting asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
}