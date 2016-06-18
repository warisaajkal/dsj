<?php
class Search_model extends CI_Model
{

	// search cases
	function get_search_cases($data)
	{	
// 		echo '<pre>';
// 		var_dump($data);
// 		die();
		
		$this->db->select('a.*,b.court_name, c.desgn_name, d.cat_name, d.cat_reg_no, p.ps_name');	
		$this->db->from('cases as a');
		$this->db->join('courts as b', 'a.court_id = b.court_id');
		$this->db->join('courts_desgn as c', 'b.desgn_id = c.id');
		$this->db->join('categories as d', 'a.cat_id = d.id');
		$this->db->join('police_stations as p', 'a.ps_id = p.id', 'left');
		
		$this->db->where('a.court_id', $data['court_id']);
		$this->db->where('a.case_type', $data['case_type']);
		$this->db->where('a.status', $data['status']);
		
		if ( !empty($data['cat_id']) ) {
			$this->db->where('a.cat_id', $data['cat_id']);
		}
		if ( !empty($data['case_id']) ) {
			$this->db->where('a.case_id', $data['case_id']);
		}
		
		if ( !empty($data['cnic_no']) ) {
			$this->db->like('a.acsd_cnic', $data['cnic_no']);
			$this->db->or_like('a.victim_cnic', $data['cnic_no']);
			$this->db->or_like('a.plt_cnic', $data['cnic_no']);
			$this->db->or_like('a.def_cnic', $data['cnic_no']);
		}
		
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
}