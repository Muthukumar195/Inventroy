<?php 
class Event_model extends CI_model{
	
	
	public function get_event_list($id){		
		
		$this->db->select('*');
		$this->db->from('event_details');	
		$this->db->where('Event_deleted ', '0');
		$this->db->where('Event_debtor_id', $id);
		$this->db->order_by('Event_id', 'DESC');
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		return $query->result();
	}
	public function add_event($data){
		
	   $this->db->set('Event_create_dt', 'NOW()', FALSE);
		$this->db->insert('event_details', $data);
		//echo $this->db->last_query(); exit;
		return true;
	}

	//start get employee ref id 
	function get_employee_name($id){
		
		$this->db->select('customerxdebtor.*, employee_details.*');
		$this->db->from('customerxdebtor');
		$this->db->join('employee_details','employee_details.Emp_id = customerxdebtor.cxd_ServiceRepID', 'Left');
		$this->db->where('debtor_id', $id);
		$query = $this->db->get();
		//echo $this->db->last_query(); exit();
		return $query->row();
		
	}
	//end get employee ref id 
	//delete event details
	function delete_event($id){		
	
		$delete_data = array(		
		'Event_deleted' => "1"		
		);
		$this->db->set('Event_update_dt','NOW()', FALSE);
		$this->db->where('Event_id', $id);
		$this->db->update('event_details', $delete_data);	
	//echo $this->db->last_query(); exit;
		return true;
	}
	//delete phone details
}	