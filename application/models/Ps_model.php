<?php
class Ps_model extends CI_Model {
	
	// * add police stations for criminals cases
	
	public function save($data)
	{
		//set value by name
		$this->db->set('ps_name', $data['ps_name']);
		$this->db->set('teh_id', $data['teh_id']);
		$this->db->set('city_id', $data['city_id']);
		$this->db->set('sorting', $data['sorting']);
		$this->db->set('created_user_id', $data['created_user_id']);
		$this->db->set('created_date', $data['created_date']);
		$this->db->set('status', $data['status']);
		
		$status = $this->db->insert('police_stations');
		$status = $this->db->affected_rows();
		return $status;
		
	}
	
	public function update($data)
	{
		//set value by name
		$this->db->set('ps_name', $data['ps_name']);
		$this->db->set('teh_id', $data['teh_id']);
		$this->db->set('city_id', $data['city_id']);
		$this->db->set('sorting', $data['sorting']);
		$this->db->set('modified_user_id', $data['modified_user_id']);
		$this->db->set('modified_date', $data['modified_date']);
		$this->db->set('status', $data['status']);
		
		$this->db->where('id',$data['id']);
		$status = $this->db->update('police_stations');
		$status = $this->db->affected_rows();
		return $status;
	}
	
	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('police_stations');
		$result = $this->db->affected_rows();
		return $result;
	}
	
	public function get_ps($id)
	{
		$this->db->select('a.*, b.city_name, c.teh_name');
		$this->db->from('police_stations as a');
		$this->db->join('cities as b', 'a.city_id=b.id','left');
		$this->db->join('tehsils as c', 'a.teh_id=c.id','left');
		$this->db->where('a.id', $id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	// get all police station list
	public function list_All()
	{
		$this->db->select('a.*, b.city_name, c.teh_name');
		$this->db->from('police_stations as a');
		$this->db->join('cities as b', 'a.city_id=b.id','left');
		$this->db->join('tehsils as c', 'a.teh_id=c.id','left');
		$this->db->order_by('a.teh_id ASC, a.city_id ASC, a.sorting ASC');
		$query = $this->db->get();
		$result = $query->result();
		return $result;	
	}
	
	// get ps list for cases
	public function list_publish_ps()
	{
		$this->db->select('a.*, b.city_name, c.teh_name');
		$this->db->from('police_stations as a');
		$this->db->join('cities as b', 'a.city_id=b.id','left');
		$this->db->join('tehsils as c', 'a.teh_id=c.id','left');
		$this->db->where('a.status', 'Publish');
		$this->db->order_by('a.teh_id ASC, a.city_id ASC, a.sorting ASC');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	// check validation on update
	public function edit_unique($id)
	{
		$this->db->select('ps_name, teh_id, city_id');
		$this->db->where('id !=', $id);
		$this->db->from('police_stations');
		$query = $this->db->get();
		$result = $query->result();
		//return $result;
		
		$ps =  array();
		foreach ($result as $r){
			$ps[$r->ps_name] = $r;
		}
		return $ps;
	}
}
