<?php
class Cases_list_model extends CI_Model
{
	// get cases by court wise
	public function get_cases_by_court_id ($data)
	{
		
		$this->db->select('a.*, b.court_name, c.desgn_name, d.cat_name, d.cat_reg_no, e.ps_name');
		$this->db->from('cases as a');
		$this->db->join('courts as b', 'a.court_id = b.court_id');
		$this->db->join('courts_desgn as c', 'b.desgn_id = c.id');
		$this->db->join('categories as d','a.cat_id = d.id');
		$this->db->join('police_stations as e', 'a.ps_id = e.id', 'left');
		
		if ($data['status'] == 'transfer')
		{
			$this->db->join('cases_transfer as t', 'a.case_id = t.case_id', 'left');
			
			if ($data['transfer'] == 'trf_from')
			{
				
				$this->db->where('t.court_id_to', $data['court_id']);
			}
			else 
			{
				$this->db->where('t.court_id_from', $data['court_id']);
			}
		}
		else 
		{
			$this->db->where('a.court_id', $data['court_id']);
		}
		if ($data['status'] == 'transfer')
		{
			$this->db->where('a.trf_status', $data['status']);
			
			if ($data['start'] != '1970-01-01')
			{
				$this->db->where('t.trf_date >=', $data['start']);
				$this->db->where('t.trf_date <=', $data['end']);
			}
			
		}
		else
		{
			$this->db->where('a.status', $data['status']);
			
			if ($data['status'] == 'proceeding')
			{
				if ($data['start'] != '1970-01-01')
				{
					$this->db->where('a.inst_date >=', $data['start']);
					$this->db->where('a.inst_date <=', $data['end']);
				}
			}
			elseif ( $data['status'] == 'decided' )
			{
				if ($data['start'] != '1970-01-01')
				{
					$this->db->where('a.decision_date >=', $data['start']);
					$this->db->where('a.decision_date <=', $data['end']);
				}
			}
		}
		
		$this->db->where('a.case_type', $data['case_type']);
		
		if ($data['status'] == 'proceeding'){
			$this->db->order_by('a.cat_id asc, a.ps_id asc, a.case_id asc');
		}
		elseif ($data['status'] == 'decided')
		{
			$this->db->order_by('a.cat_id asc, a.decision_date asc, a.ps_id asc, a.case_id asc');
		}
		else 
		{
			$this->db->order_by('b.sorting asc, a.cat_id asc, a.ps_id asc, a.case_id asc');
		}
		
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	//get next proceeding by case ids
	public function get_nprocs_by_case_id ($case_id)
	{
		$this->db->select('a.*, b.court_name, e.desgn_name, c.stage_name, d.nproc_name');
		$this->db->from('cases_history as a');
		$this->db->join('courts as b', 'a.court_id = b.court_id', 'left');
		$this->db->join('courts_desgn as e', 'e.id = b.desgn_id', 'left');
		$this->db->join('stages as c', 'a.stage_id = c.id', 'left');
		$this->db->join('next_proceeding as d', 'a.nproc_id = d.id', 'left');
		$date=$this->db->where('a.case_id',$case_id);
		$this->db->order_by('a.id asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
		
	//get_decision_files
	public function get_decision_files($case_id)
	{
		$this->db->select('*');
		$this->db->from('decision_files');
		$this->db->where('case_id', $case_id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	//get single decision_files
	public function get_decision_file($filename)
	{
		$this->db->select('*');
		$this->db->from('decision_files');
		$this->db->where('file_name', $filename);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	// delete decision file by file name
	public function del_uploaded_file($filename)
	{
		try {
			// delete picture
			$row = $this->db->get_where('decision_files', array('file_name' => $filename))->row();
				
			unlink($row->full_path);
				
			$this->db->where('file_name',$filename)->delete('decision_files');
			return true;
		}
		
		//catch exception
		catch(Exception $e) {
			echo $e->getMessage();
		}

	}
	// get court and case type by case_id
	public function get_court_and_case_type_by_id($id)
	{
		$this->db->select('court_type, case_type');
		$this->db->from('cases');
		$this->db->where('case_id', $id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	// get sc single cr case by id
	public function get_single_case_detail($id)
	{
		$type = $this->db->select('court_type, case_type')->where('case_id', $id)->get('cases')->row();
		
		$this->db->select('a.*, b.court_name, c.desgn_name, d.cat_name, d.cat_reg_no, e.ps_name');
		$this->db->from('cases as a');
		$this->db->join('courts as b', 'a.court_id = b.court_id', 'left');
		$this->db->join('courts_desgn as c', 'b.desgn_id = c.id', 'left');
		$this->db->join('categories as d','a.cat_id = d.id');
		$this->db->join('police_stations as e', 'a.ps_id = e.id', 'left');
		
		$this->db->where('a.case_id',$id);
		$this->db->order_by('b.sorting asc, a.cat_id asc, a.ps_id asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	// count total pendency 
	public function count_total_Pedency()
	{
		$this->db->where('status','proceeding');
		$this->db->from('cases');
		$result = $this->db->count_all_results();
		return $result;
	}
	
	// count total pendency by court id
	public function count_total_Pedency_by_court( $court_id )
	{
		$this->db->where('status','proceeding');
		$this->db->where('court_id', $court_id);
		$this->db->from('cases');
		$result = $this->db->count_all_results();
		return $result;
	}
	
	// count current month register cases
	public function count_current_month_cases( $currentMonth )
	{
		$this->db->where('status','proceeding');
		$this->db->like('inst_date', $currentMonth);
		$this->db->from('cases');
		$result = $this->db->count_all_results();
		return $result;
	}
	
	// count current month register cases by court id
	public function count_current_month_cases_by_court( $court_id, $currentMonth )
	{
		$this->db->where('status','proceeding');
		$this->db->where('court_id', $court_id);
		$this->db->like('inst_date', $currentMonth);
		$this->db->from('cases');
		$result = $this->db->count_all_results();
		return $result;
	}
	
	// count current month register cases
	public function count_current_month_decided_cases ( $currentMonth )
	{
		$this->db->where('status','decided');
		$this->db->like('decision_date', $currentMonth);
		$this->db->from('cases');
		$result = $this->db->count_all_results();
		return $result;
	}
	
	// count current month register cases by court id
	public function count_current_month_decided_cases_by_court( $court_id, $currentMonth )
	{		
		$this->db->where('status','decided');
		$this->db->where('court_id', $court_id);
		$this->db->like('decision_date', $currentMonth);
		$this->db->from('cases');
		$result = $this->db->count_all_results();
		return $result;
	}
	
}