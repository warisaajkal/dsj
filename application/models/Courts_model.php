<?php
class Courts_model extends CI_Model
{
	// * check unique court name on add/edit *court name
	public function check_unique_cName($id)
	{
		$this->db->select('court_name');
		$this->db->from('courts');
		$this->db->where('court_id !=',$id);
		//$this->db->where('status','Publish');
		$query = $this->db->get();
		$result = $query->result();
	
		$cNames =  array();
		foreach ($result as $r){
			$cNames[$r->court_name] = $r;
		}
		return $cNames;
	}
	// * check court rank
	public function unique_sorting($id)
	{
		$this->db->select('sorting');
		$this->db->from('courts');
		$this->db->where('court_id !=',$id);
		$this->db->where('status','Publish');
		$query = $this->db->get();
		$result = $query->result();
		
		$sortings =  array();
		foreach ($result as $r){
			$sortings[$r->sorting] = $r;
		}
		return $sortings;
	}
	// * check assigned court user
	public function check_asgnd_court_user($court_id, $court_type)
	{
		$this->db->select('asgnd_user_id');
		$this->db->from('courts');
		$this->db->where('court_id !=',$court_id);
		$this->db->where('status','Publish');
		$this->db->where('court_type',$court_type);
		$query = $this->db->get();
		$result = $query->result();
		
		$cUsers =  array();
		foreach ($result as $r){
			$cUsers[$r->asgnd_user_id] = $r;
		}
		return $cUsers;
	}
	
	public function save_court($data)
	{
		//set value by name
		$this->db->set('court_name', $data['court_name']);
		$this->db->set('desgn_id', $data['desgn_id']);
		$this->db->set('teh_id', $data['teh_id']);
		$this->db->set('city_id', $data['city_id']);
		$this->db->set('court_type', $data['court_type']);
		$this->db->set('sorting', $data['sorting']);
		$this->db->set('asgnd_user_id', $data['asgnd_user_id']);
		$this->db->set('created_user_id', $data['created_user_id']);
		$this->db->set('created_date', $data['created_date']);
		$this->db->set('status', $data['status']);
		
		$status = $this->db->insert('courts');
		$status = $this->db->affected_rows();
		return $status;
	}
	public function update_court($data)
	{
		//set value by name
		$this->db->set('court_name', $data['court_name']);
		$this->db->set('desgn_id', $data['desgn_id']);
		$this->db->set('teh_id', $data['teh_id']);
		$this->db->set('city_id', $data['city_id']);
		$this->db->set('court_type', $data['court_type']);
		$this->db->set('sorting', $data['sorting']);
		$this->db->set('asgnd_user_id', $data['asgnd_user_id']);
		$this->db->set('modified_user_id', $data['modified_user_id']);
		$this->db->set('modified_date', $data['modified_date']);
		$this->db->set('status', $data['status']);
		
		$this->db->where('court_id',$data['court_id']);
		$this->db->update('courts');
		$status = $this->db->affected_rows();
		return $status;
	}
	
	public function delete_court($id)
	{
		$this->db->where('court_id',$id);
		$this->db->delete('courts');
		$status = $this->db->affected_rows();
		return $status;
	}
	// get courts name for admin
	public function get_courts()
	{
		$this->db->select('a.* , b.desgn_name, c.teh_name, d.city_name');
		$this->db->from('courts as a');
		$this->db->join('courts_desgn as b','a.desgn_id=b.id','left');
		$this->db->join('tehsils as c','a.teh_id=c.id','left');
		$this->db->join('cities as d','a.city_id=d.id','left');
		$this->db->order_by('a.sorting','asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	// get publish courts list for add/edit cases
	public function get_publish_courts_list()
	{
		$this->db->select('a.* , b.desgn_name, c.teh_name, d.city_name');
		$this->db->from('courts as a');
		$this->db->join('courts_desgn as b','a.desgn_id=b.id','left');
		$this->db->join('tehsils as c','a.teh_id=c.id','left');
		$this->db->join('cities as d','a.city_id=d.id','left');
		$this->db->where('a.status','Publish');
		$this->db->order_by('a.sorting','asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	// get courts list by *court type 
	public function get_courts_by_type( $courtType )
	{
		$where = array('a.court_type' => $courtType, 'a.status' => 'Publish');
		
		$this->db->select('a.* , b.desgn_name');
		$this->db->from('courts as a');
		$this->db->join('courts_desgn as b','a.desgn_id=b.id','left');
// 		$this->db->where('a.court_type', $courtType);
// 		$this->db->where('a.status', 'Publish');
		$this->db->where($where);
		$this->db->order_by('a.sorting','asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	// get court name by user id and court type
	public function get_court_name_by_user($user_id,$courtType)
	{
		$where = array('a.asgnd_user_id' => $user_id, 'a.court_type' => $courtType, 'a.status' => 'Publish');
// 		$where = array('asgnd_user_id=' => $u_id, 'status =' => 'Publish', 'court_type =' => 'Sessions');
		$this->db->select('a.*, b.desgn_name');
		$this->db->from('courts as a');
		$this->db->join('courts_desgn as b', 'a.desgn_id=b.id');
// 		$this->db->where('a.asgned_user_id', $user_id);
// 		$this->db->where('a.court_type', $court_type);
// 		$this->db->where('a.status', 'Publish');
		$this->db->where($where);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	// get court names sessions/civil both by assigned user id
	public function get_court_names_by_login_user($user_id)
	{
		$where = array('a.asgnd_user_id' => $user_id, 'a.status' => 'Publish');
		$this->db->select('a.*, b.desgn_name');
		$this->db->from('courts as a');
		$this->db->join('courts_desgn as b', 'a.desgn_id=b.id');
		$this->db->where($where);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	// get court name by court id
	public function get_court_name_by_id($court_id)
	{
		$this->db->select('a.*, b.desgn_name');
		$this->db->from('courts as a');
		$this->db->join('courts_desgn as b', 'a.desgn_id=b.id');
		$this->db->where('court_id', $court_id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	// get courts by case
	public function get_courts_by_case($court_id)
	{
		$this->db->where('court_id', $court_id);
		$this->db->from('courts as a');
		$this->db->join('courts_desgn as b', 'a.court_type=b.id');
		$query = $this->db->get();
		return $query->row();
	}
	
	// get court type by court id
	public function get_court_type ($court_id)
	{	
		$this->db->select('court_type');
		$this->db->from('courts');
		$this->db->where('court_id', $court_id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	// check valid user on eidt cases
	public function validate_court($user_id,$court_id)
	{
		$this->db->where('asgnd_user_id='.$user_id.' and court_id='.$court_id);
		$query = $this->db->get('courts');
		$result = $query->result();
		return $result;
	}
	
	// * check unique designation judge/court
	public function unique_desgn($id)
	{
		$this->db->select('desgn_name');
		$this->db->from('courts_desgn');
		$this->db->where('id !=',$id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	// designation save
	public function save_desgn($data)
	{
		//set value by name
		$this->db->set('desgn_name', $data['desgn_name']);
		$this->db->set('created_user_id', $data['created_user_id']);
		$this->db->set('created_date', $data['created_date']);
		$this->db->set('status', $data['status']);
	
		$status = $this->db->insert('courts_desgn');
		$status = $this->db->affected_rows();
		return $status;
	}
	// designation update
	public function update_desgn($data)
	{
		//set value by name
		$this->db->set('desgn_name', $data['desgn_name']);
		$this->db->set('modified_user_id', $data['modified_user_id']);
		$this->db->set('modified_date', $data['modified_date']);
		$this->db->set('status', $data['status']);
	
		$this->db->where('id',$data['id']);
		$status = $this->db->update('courts_desgn');
		$status = $this->db->affected_rows();
		return $status;
	}
	// get designation by id
	public function get_desgn($id)
	{
		$this->db->select('*');
		$this->db->from('courts_desgn');
		$this->db->where('id',$id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	// designation delete by id
	public function delete_desgn($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('courts_desgn');
		$status = $this->db->affected_rows();
		return $status;
	}
	// * get all designations list
	public function desgns()
	{
		$this->db->select('*');
		$this->db->from('courts_desgn');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	// get designation list for add/edit cases
	public function list_desgns()
	{
		$this->db->select('*');
		$this->db->from('courts_desgn');
		$this->db->where('status','Publish');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	// check court if not assigned to user
	public function check_authentic_user_by_court($user_id)
	{
// 		$this->db->select('court_type');
		$this->db->where('asgnd_user_id', $user_id);
		$this->db->where('status', 'Publish');
		$query = $this->db->get('courts');
		$result = $query->result();
		
		$courts_by_user = array();
		foreach ($result as $r)
		{
			$courts_by_user[$r->court_type] = $r;
		}
		return $courts_by_user;
	}
	
	// pending **********************************************
	
	public function get_courts_for_cases()
	{
		$this->db->select('a.* , b.ct_name');
		$this->db->from('courts as a');
		$this->db->where('court_publish', 'yes');
		$this->db->join('courts_desgn as b','a.court_type=b.ct_id');
		$this->db->order_by('court_rank','asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	public function get_court($id)
	{
		$this->db->select('*');
		$this->db->from('courts');
		$this->db->where('court_id',$id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	// get selected courts name by admin 
	public function get_selected_court_name($court_id)
	{
		$where = array('court_id =' => $court_id, 'court_publish =' => 'yes');
		$this->db->select('a.*, b.ct_name');
		$this->db->from('courts as a');
		$this->db->join('courts_desgn as b', 'a.court_type=b.ct_id');
		$this->db->where($where);
		$query = $this->db->get();
		return $query->row();
	}
	
	// get court name by select for report
	public function get_court_by_select($court_id)
	{
		$this->db->where('court_id',$court_id);
		$this->db->from('courts as a');
		$this->db->join('courts_desgn as b', 'a.court_type=b.ct_id');
		$query = $this->db->get();
		return $query->row();
	}

	
	public function check_court_name($court_name)
	{
		$this->db->where('court_name',$court_name);
		$query = $this->db->get('courts');
		return $query->result();
	}
		
}
