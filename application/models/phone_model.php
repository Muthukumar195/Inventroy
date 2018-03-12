<?php 
class Phone_model extends CI_model{
	
	//phone details list
	function phone_details($id){
		
		$this->db->select('*');
		$this->db->from('phone_details');
		$this->db->where("Phone_deleted", "0");
		$this->db->where("Phone_debtor_id", $id);
		$this->db->order_by("Phone_sort", 'asc');
		$query = $this->db->get();
		return $query->result();
	}
	//phone details list
	//add phone details
	function add_phone($data){
	
		$this->db->set('Phone_create_dt','NOW()', FALSE);
		foreach($data as $dt){
		$this->db->insert('phone_details', $dt);
		}
		return true;
	}
	//add phone details
	
	//get phone details
	function get_phone_details($id){

		$query = $this->db->get_where('phone_details', array("Phone_id"=>$id));	
		return $query->row();
	}
	//get phone details
	//edit phone details
	function update_phone($id,$data){
		
		$this->db->set('Phone_update_dt','NOW()', FALSE);
		$this->db->where('Phone_id', $id);
		$this->db->update('phone_details', $data);		
		return true;
	}
	//edit phone details
	
	//delete phone details
	function delete_phone($id){		
	
		$delete_data = array(		
		'Phone_deleted' => "1"		
		);
		$this->db->set('Phone_update_dt','NOW()', FALSE);
		$this->db->where('Phone_id', $id);
		$this->db->update('phone_details', $delete_data);	
	//echo $this->db->last_query(); exit;
		return true;
	}
	//delete phone details
	

	
}	