<?php
class Next_proceeding_model extends CI_Model
{
	// get all next proceeding list
	public function get_next_proceedings()
	{
		$this->db->select('*');
		$this->db->from('next_proceeding');
		$this->db->order_by('court_type desc, case_type desc, sorting asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	// get single next proceeding by id
	public function get_next_proceeding($id)
	{
		$this->db->select('*');
		$this->db->from('next_proceeding');
		$this->db->where('id',$id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	// save new
	public function save($data)
	{
		//set value by name
		$this->db->set('nproc_name', $data['nproc_name']);
		$this->db->set('court_type', $data['court_type']);
		$this->db->set('case_type', $data['case_type']);
		$this->db->set('sorting', $data['sorting']);
		$this->db->set('created_user_id', $data['user_id']);
		$this->db->set('created_date', $data['dateTime']);
		$this->db->set('status', $data['status']);
		
		$status = $this->db->insert('next_proceeding');
		$status = $this->db->affected_rows();
		return $status;
	}
	// edit or update
	public function update($data)
	{
		//set value by name
		$this->db->set('nproc_name', $data['nproc_name']);
		$this->db->set('court_type', $data['court_type']);
		$this->db->set('case_type', $data['case_type']);
		$this->db->set('sorting', $data['sorting']);
		$this->db->set('modified_user_id', $data['user_id']);
		$this->db->set('modified_date', $data['dateTime']);
		$this->db->set('status', $data['status']);
		
		$this->db->where('id',$data['id']);
		$this->db->update('next_proceeding');
		$status = $this->db->affected_rows();
		return $status;
	}

	// delete by id
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('next_proceeding');
		$status = $this->db->affected_rows();
		return $status;
	}
	
	// * validate next proceeding name
	public function validate_nproc_name($id)
	{
		$this->db->select('nproc_name, court_type, case_type');
		$this->db->from('next_proceeding');
		$this->db->where('id !=', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	// get next proceeding list for cases
	public function get_next_proceedings_for_cases($data)
	{
		$where = array( 'court_type' => $data['court'], 'case_type' => $data['case'], 'status' => 'Publish' );
	
		$this->db->select('*');
		$this->db->from('next_proceeding');
		$this->db->where($where);
		$this->db->order_by('sorting asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
}