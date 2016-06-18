<?php
class Categories_model extends CI_Model
{
	// save cat
	public function save($data)
	{
		//set value by name
		$this->db->set('cat_name', $data['cat_name']);
		$this->db->set('cat_reg_no', $data['cat_reg_no']);
		$this->db->set('court_type', $data['court_type']);
		$this->db->set('case_type', $data['case_type']);
		$this->db->set('sorting', $data['sorting']);
		$this->db->set('created_user_id', $data['user_id']);
		$this->db->set('created_date', $data['dateTime']);
		$this->db->set('status', $data['status']);
		
		$status = $this->db->insert('categories');
		$status = $this->db->affected_rows();
		return $status;
	}
	// update cat
	public function update($data)
	{
		//set value by name
		$this->db->set('cat_name', $data['cat_name']);
		$this->db->set('cat_reg_no', $data['cat_reg_no']);
		$this->db->set('court_type', $data['court_type']);
		$this->db->set('case_type', $data['case_type']);
		$this->db->set('sorting', $data['sorting']);
		$this->db->set('modified_user_id', $data['user_id']);
		$this->db->set('modified_date', $data['dateTime']);
		$this->db->set('status', $data['status']);
		
		$this->db->where('id',$data['id']);
		$this->db->update('categories');
		$status = $this->db->affected_rows();
		return $status;
	}

	// delete category by id
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('categories');
		$status = $this->db->affected_rows();
		return $status;
	}
	// get all categories
	public function get_categories()
	{
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->order_by('court_type desc, case_type desc, sorting asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	// get all categories by case typess
	public function get_categories_by_case_type($caseType)
	{
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where('case_type', $caseType);
		$this->db->order_by('court_type desc, case_type desc, sorting asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	// get single category by id
	public function get_cat($id)
	{
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where('id',$id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	// * validate category name
	public function validate_category_name($id)
	{
		$this->db->select('cat_name, court_type, case_type');
		$this->db->from('categories');
		$this->db->where('id !=', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	// get categories list for cases
	public function get_categories_for_cases($data)
	{	
		$where = array( 'court_type' => $data['court'], 'case_type' => $data['case'], 'status' => 'Publish' );
		
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where($where);
		$this->db->order_by('sorting asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
}