<?php
class Cases_model extends CI_Model
{
	// add sc criminal case
	public function save_case($data)
	{
		//$this->db->set('dir_case_id', $data['dir_case_id']);
		
		$this->db->set('court_type', $data['court_type']);
		$this->db->set('case_type', $data['case_type']);
				
		$this->db->set('user_id', $data['user_id']);
		$this->db->set('court_id', $data['court_id']);
		
		$this->db->set('cat_id',$data['cat_id']);
		$this->db->set('inst_date',$data['inst_date']);
		$this->db->set('old_case', $data['old_case']);
		
		$this->db->set('reg_no', $data['reg_no']);
		$this->db->set('reg_date',$data['reg_date']);
		
		$this->db->set('case_title', $data['case_title']);
		
		if (($data['case_type'] == 'criminal'))
		{
			$this->db->set('chl_no', $data['chl_no']);
			$this->db->set('chl_date', $data['chl_date']);
			$this->db->set('fir_no', $data['fir_no']);
			$this->db->set('fir_date', $data['fir_date']);
			$this->db->set('offence', $data['offence']);
			$this->db->set('ps_id', $data['ps_id']);
			
			$this->db->set('acsd_name', $data['acsd_name']);
			$this->db->set('acsd_cnic', $data['acsd_cnic']);
			$this->db->set('acsd_addr', $data['acsd_addr']);
			$this->db->set('onbail_utp', $data['onbail_utp']);
			
			$this->db->set('acsd_adv', $data['acsd_adv']);
			$this->db->set('acsd_adv_lic', $data['acsd_adv_lic']);
			
			$this->db->set('victim_name', $data['victim_name']);
			$this->db->set('victim_cnic', $data['victim_cnic']);
			$this->db->set('victim_addr', $data['victim_addr']);
		}
		else
		{
			$this->db->set('cat_nature',$data['cat_nature']);
			$this->db->set('def_name', $data['def_name']);
			$this->db->set('def_cnic', $data['def_cnic']);
			$this->db->set('def_addr', $data['def_addr']);
			$this->db->set('def_adv', $data['def_adv']);
			$this->db->set('def_adv_lic', $data['def_adv_lic']);
		}
		
		$this->db->set('plt_name', $data['plt_name']);
		$this->db->set('plt_cnic', $data['plt_cnic']);
		$this->db->set('plt_addr', $data['plt_addr']);
		
		$this->db->set('plt_adv', $data['plt_adv']);
		$this->db->set('plt_adv_lic', $data['plt_adv_lic']);
		
		$this->db->set('wtns_name', $data['wtns_name']);
		$this->db->set('wtns_cnic', $data['wtns_cnic']);
		$this->db->set('wtns_addr', $data['wtns_addr']);
		
		$this->db->set('status', $data['status']);
		$this->db->set('created_user_id', $data['created_user_id']);
		
		$this->db->set('created_date', $data['created_date']);
		
		// insert case data in first table
		$this->db->insert('cases');
		$status = $this->db->affected_rows();
		
		// insert case next hearing date in other table
		$id = $this->db->insert_id();
		
		//set value by name
		$this->db->set('case_id', $id);
		$this->db->set('court_id', $data['court_id']);
		$this->db->set('user_id', $data['user_id']);
		$this->db->set('stage_id', $data['stage_id']);
		$this->db->set('nproc_id', $data['nproc_id']);
		$this->db->set('order_sheet', $data['order_sheet']);
		$this->db->set('doh', $data['reg_date']);
		$this->db->set('ndoh', $data['ndoh']);
		$this->db->set('remarks', $data['remarks']);

		// insert case next proceeding table by case history * 
		$this->db->insert('cases_history');
		$status = $this->db->affected_rows();
		return $status;
	}
		
	public function update_case($data)
	{
		
		// get previous hearing date
		$prv_doh2 = $this->db->select('ndoh')->where('case_id', $data['case_id'])->limit(1,1)->order_by('id desc')->get('cases_history')->row();
		$prv_doh = $this->db->select('ndoh')->where('case_id', $data['case_id'])->order_by('id desc')->get('cases_history')->row();
		
		//set value by name
		$this->db->set('court_type', $data['court_type']);
		$this->db->set('case_type', $data['case_type']);
		
		$this->db->set('user_id', $data['user_id']);
		
		$this->db->set('cat_id',$data['cat_id']);
		
		$this->db->set('inst_date', $data['inst_date']);
		$this->db->set('old_case', $data['old_case']);
		
		$this->db->set('reg_no', $data['reg_no']);
		$this->db->set('reg_date', $data['reg_date']);
		
		$this->db->set('case_title', $data['case_title']);
		
		if (($data['case_type'] == 'criminal'))
		{
			$this->db->set('chl_no', $data['chl_no']);
			$this->db->set('chl_date', $data['chl_date']);
			$this->db->set('fir_no', $data['fir_no']);
			$this->db->set('fir_date', $data['fir_date']);
			$this->db->set('offence', $data['offence']);
			$this->db->set('ps_id', $data['ps_id']);
				
			$this->db->set('acsd_name', $data['acsd_name']);
			$this->db->set('acsd_cnic', $data['acsd_cnic']);
			$this->db->set('acsd_addr', $data['acsd_addr']);
			$this->db->set('onbail_utp', $data['onbail_utp']);
				
			$this->db->set('acsd_adv', $data['acsd_adv']);
			$this->db->set('acsd_adv_lic', $data['acsd_adv_lic']);
				
			$this->db->set('victim_name', $data['victim_name']);
			$this->db->set('victim_cnic', $data['victim_cnic']);
			$this->db->set('victim_addr', $data['victim_addr']);
		}
		else
		{
			$this->db->set('cat_nature', $data['cat_nature']);
			
			$this->db->set('def_name', $data['def_name']);
			$this->db->set('def_cnic', $data['def_cnic']);
			$this->db->set('def_addr', $data['def_addr']);
			$this->db->set('def_adv', $data['def_adv']);
			$this->db->set('def_adv_lic', $data['def_adv_lic']);
		}
		
		$this->db->set('plt_name', $data['plt_name']);
		$this->db->set('plt_cnic', $data['plt_cnic']);
		$this->db->set('plt_addr', $data['plt_addr']);
		
		$this->db->set('plt_adv', $data['plt_adv']);
		$this->db->set('plt_adv_lic', $data['plt_adv_lic']);
		
		// decided case values
		$this->db->set('decision', $data['decision']);
		$this->db->set('cntsd_un', $data['cntsd_un']);
		$this->db->set('general_no', $data['general_no']);
		$this->db->set('index_pages', $data['index_pages']);
		
		$this->db->set('modified_user_id', $data['modified_user_id']);
		$this->db->set('modified_date', $data['modified_date']);
		
// 		$this->db->set('court_id', $data['court_id']);
		$this->db->set('status', $data['status']);
		
		// apply if
		if ($data['status']=='transfer')
		{
			$this->db->set('court_id', $data['trf_court_id']);
			$this->db->set('trf_status', $data['status']);
			
// 			$this->db->set('court_id_trf_from', $data['court_id']);
// 			$this->db->set('court_id_trf_to', $data['trf_court_id']);
// 			$this->db->set('trf_date', $prv_doh->ndoh);
			
		}
		else 
		{
			$this->db->set('court_id', $data['court_id']);
		}
		// if decided case
		if ($data['status']=='decided')
		{
			$this->db->set('decision_date', $data['ndoh']);
		}
		
		// update case data by case_id
		$this->db->where('case_id', $data['case_id']);
		$this->db->update('cases');
		$status1 = $this->db->affected_rows();
		
		// start 2nd table insert case history
		$this->db->set('user_id', $data['user_id']);
		$this->db->set('case_id', $data['case_id']);
		$this->db->set('stage_id', $data['stage_id']);
		$this->db->set('ndoh', $data['ndoh']);
		
		if ($data['status']=='transfer')
		{
			//set value by name
			$this->db->set('court_id', $data['court_id']);
			$this->db->set('nproc_id', $data['nproc_id']);
			$this->db->set('order_sheet', $data['order_sheet']);
			$this->db->set('doh	', $prv_doh->ndoh);
			$this->db->set('remarks', $data['remarks']);
			
			// insert data to 2nd table
			$this->db->insert('cases_history');
			
			if ($data['status']=='transfer')
			{
				//set value by name
				$this->db->set('user_id', $data['user_id']);
				$this->db->set('case_id', $data['case_id']);
				$this->db->set('ndoh', $data['ndoh']);
				$this->db->set('court_id', $data['trf_court_id']);
				
				// insert data to 2nd table
				$this->db->insert('cases_history');
				
				//set value by name
// 				$this->db->set('court_id', $data['court_id']);
				$this->db->set('court_id_from', $data['court_id']);
				$this->db->set('court_id_to', $data['trf_court_id']);
				$this->db->set('case_id', $data['case_id']);
				$this->db->set('user_id', $data['user_id']);
				$this->db->set('trf_date', $prv_doh->ndoh);
				
// 			$this->db->set('court_id_trf_from', $data['court_id']);
// 			$this->db->set('court_id_trf_to', $data['trf_court_id']);
// 			$this->db->set('trf_date', $prv_doh->ndoh);
				
				// insert data of transfer cases
				$this->db->insert('cases_transfer');
				
				
			}
		}
		else
		{
			// set value by name			
			$this->db->set('court_id', $data['court_id']);
			$this->db->set('nproc_id', $data['nproc_id']);
			$this->db->set('order_sheet', $data['order_sheet']);
			//$this->db->set('doh	', $prv_doh->ndoh);
			$this->db->set('remarks', $data['remarks']);
			
			if ( (empty($data['doh'])) OR ($data['doh'] == $prv_doh->ndoh) OR ($data['ndoh']==$prv_doh->ndoh) ){
				
				if (!empty($data['doh']))
				{
					$this->db->set('doh	', $data['doh']);
				}
				else
				{
					$this->db->set('doh	', $prv_doh2->ndoh);
				}				
				
				// update case hisotry
				$this->db->where('id', $data['id']);
				$this->db->update('cases_history');
			}
			else
			{
				// set value by name
				$this->db->set('doh	', $prv_doh->ndoh);
				
				// insert record
				$this->db->insert('cases_history');
			}
		}
		$status = $this->db->affected_rows();
		
		if ($status > 0){
			return $status;
		}
		else {
			return $status1;
		}
	}
	
	// get sc single cr case by id
	public function get_case_by_id( $case_id )
	{
		$this->db->select('a.*, b.*');
		$this->db->from('cases as a');
		$this->db->join('cases_history as b', 'a.case_id = b.case_id', 'left');
		
		$this->db->where('a.case_id',$case_id);
		$this->db->order_by('b.id desc');
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	// upload decision file
	public function upload_dec_file($data)
	{
		// set value by name
		$this->db->set('case_id', $data['case_id']);
		$this->db->set('file_name', $data['upload_data']['file_name']);
		$this->db->set('raw_name', $data['upload_data']['raw_name']);
		$this->db->set('orig_name', $data['upload_data']['orig_name']);
		$this->db->set('client_name', $data['upload_data']['client_name']);
		
		$this->db->set('file_path', $data['upload_data']['file_path']);
		$this->db->set('full_path', $data['upload_data']['full_path']);
		
		$this->db->set('file_type', $data['upload_data']['file_type']);
		$this->db->set('file_ext', $data['upload_data']['file_ext']);
		$this->db->set('file_size', $data['upload_data']['file_size']);
		
		$this->db->set('dec_date', $data['ndoh']);
	
		// insert file data
		$this->db->insert('decision_files');
	}
	
	// get case for add next date and next proceeding
	public function get_case_for_next_proceeding($case_id)
	{
		$this->db->select('a.case_id, a.case_title, a.inst_date, a.reg_date, a.reg_no, a.status, b.court_name, c.desgn_name, d.cat_name, d.cat_reg_no, e.ps_name, f.*');
		$this->db->from('cases as a');
		$this->db->join('courts as b', 'a.court_id = b.court_id', 'left');
		$this->db->join('courts_desgn as c', 'b.desgn_id = c.id', 'left');
		$this->db->join('categories as d','a.cat_id = d.id');
		$this->db->join('police_stations as e', 'a.ps_id = e.id', 'left');
		$this->db->join('cases_history as f', 'a.case_id = f.case_id');
		$this->db->where('a.case_id', $case_id);
		$this->db->order_by('f.id','desc');
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	// add next date and next proceeding by case id
	public function save_ndoh($data)
	{
		// privious hearing date
		$priviousDate = $this->db->select('ndoh')->where('case_id', $data['case_id'])->order_by('id desc')->get('cases_history')->row();
		
// 		echo '<pre>';
// 		var_dump($data);
// 		die();
		
		// set value by name
		$this->db->set('court_id', $data['court_id']);
		$this->db->set('user_id', $data['user_id']);
		$this->db->set('case_id', $data['case_id']);
		$this->db->set('order_sheet', $data['order_sheet']);
		$this->db->set('ndoh', $data['ndoh']);
		$this->db->set('nproc_id', $data['nproc_id']);
		$this->db->set('stage_id', $data['stage_id']);
		$this->db->set('remarks', $data['remarks']);
		$this->db->set('doh', $priviousDate->ndoh);
		
		if ( $priviousDate->ndoh !== $data['ndoh'])
		{
			// insert case history
			$this->db->insert('cases_history');	
		}
		else 
		{
			$this->db->set('doh', $data['doh']);
			
			// update
			$this->db->where('id', $data['id']);
			$this->db->update('cases_history');
		}
		$status = $this->db->affected_rows();
		return $status;
	}
	
	// get next dates for validation
	public function get_ndoh_by_case_id($ndoh, $case_id)
	{
		$this->db->select('ndoh');
		$this->db->from('cases_history');
		$this->db->where('case_id', $case_id);
		$this->db->where('ndoh !=', $ndoh);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	// get next dates for validation only next date update
	public function get_ndoh_on_update_by_id($ndoh, $case_id)
	{
		// count case history record by case id
		$count = $this->db->like('case_id', $case_id)->from('cases_history')->count_all_results(); 
		
		$this->db->select('ndoh');
		$this->db->from('cases_history');
		$this->db->where('case_id', $case_id);
		//$this->db->where('ndoh !=', $ndoh);
		$this->db->limit($count, 1);
		$this->db->order_by('id desc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	// get case next date of hearing by id
	public function get_ndoh_by_id($id)
	{
		$this->db->select('a.*, b.case_title, c.court_name, d.desgn_name');
		$this->db->from('cases_history as a');
		$this->db->join('cases as b', 'a.case_id = b.case_id', 'left');
		$this->db->join('courts as c', 'a.court_id = c.court_id', 'left');
		$this->db->join('courts_desgn as d', 'c.desgn_id = d.id', 'left');
		$this->db->where('a.id',$id);
		//$this->db->order_by('a.id desc');
		$query = $this->db->get();
		$result = $query->row();
		return $result;
		
	}
	// update next date of hearing by id
	public function update_ndoh($data)
	{
		// get previous ndoh last 2
		$prv_ndoh2 = $this->db->select('ndoh')->where('case_id', $data['case_id'])->limit(1,1)->order_by('id desc')->get('cases_history')->row();
		// get case registration date
		$reg_date = $this->db->select('reg_date')->where('case_id', $data['case_id'])->get('cases')->row();
		
		// set value by name
		$this->db->set('order_sheet', $data['order_sheet']);
		$this->db->set('ndoh', $data['ndoh']);
		$this->db->set('nproc_id', $data['nproc_id']);
		$this->db->set('stage_id', $data['stage_id']);
		$this->db->set('remarks', $data['remarks']);
		
		if (empty($data['doh'])) {
		
			if (!empty($prv_ndoh2->ndoh)) {
				
				$this->db->set('doh', $prv_ndoh2->ndoh);
				
			}
			else
			{	
				$this->db->set('doh', $reg_date->reg_date);	
			}
		}
		else
		{
			$this->db->set('doh', $data['doh']);
		}
		
		// update case hisotry
		$this->db->where('id', $data['id']);
		$this->db->update('cases_history');
		$status = $this->db->affected_rows();
		return $status;
	}
	
	// get next date by case id
	public function get_next_date($id)
	{
		$this->db->select('ndoh');
		$this->db->from('cases_history');
		$this->db->where('case_id', $id);
		$this->db->limit(1,1);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	// delete case by id
	public function delete_ndoh($id)
	{
		$tables = array('cases_history');
		$this->db->where('id',$id);
		$this->db->delete($tables);
		$result = $this->db->affected_rows();
		return $result;
	}
	
	// delete case by id
	public function delete_case($id)
	{
		$tables = array('cases', 'cases_history');
		$this->db->where('case_id',$id);
		$this->db->delete($tables);
		$result = $this->db->affected_rows();
		return $result;
	}
}