<?php 
class Status_model extends CI_model{
	
	
	public function status_details(){		
		
		$query = $this->db->get_where('status_details', array('Status_deleted =' => '0'));
		return $query;
	}
	
}	