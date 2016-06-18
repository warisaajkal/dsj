<?php
class Cause_list_model extends CI_Model
{
	// get stages by court id and next date of hearing
	public function get_stages($data)
	{
		$this->db->select('a.stage_id, a.court_id, a.ndoh, b.stage_name');
		$this->db->from('cases_history as a');
		$this->db->join('stages as b', 'a.stage_id = b.id');
		$this->db->join('stages_cause_list as c', 'b.id = c.stage_id', 'left');
		$this->db->where('a.ndoh', $data['ndoh']);
		$this->db->where('a.court_id', $data['court_id']);
		$this->db->where('c.court_id', $data['court_id']);
		$this->db->order_by('c.sorting', 'asc');
		$this->db->group_by('a.stage_id');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	// get cases *
	function get_cases_by_stage_id($data)
	{
		$this->db->select('a.*,b.*, c.cat_name, c.cat_reg_no, d.ps_name');	
		$this->db->from('cases as a');
		$this->db->join('cases_history as b', 'a.case_id = b.case_id');
		$this->db->join('categories as c', 'a.cat_id = c.id');
		$this->db->join('police_stations as d', 'a.ps_id = d.id', 'left');
// 		$this->db->join('cases_transfer as e', 'a.case_id = e.case_id', 'left');
		
		$this->db->where('a.court_id', $data->court_id);
		$this->db->where('a.status !=', 'transfer');
		$this->db->where('b.court_id', $data->court_id);
		$this->db->where('b.ndoh', $data->ndoh);		
		$this->db->where('b.stage_id', $data->stage_id);
		$this->db->order_by('a.cat_id asc, a.ps_id asc, a.case_id asc, a.case_title asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	// get holidays
	public function get_holidays()
	{
		$this->db->select('date');
		$this->db->from('holidays');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
}