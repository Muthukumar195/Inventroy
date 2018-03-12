<?php 
class User_type_model extends CI_model{
	
	
	public function user_types(){		
		
		$query = $this->db->get_where('user_types', array('User_type_deleted =' => '0'));
		return $query;
	}
	
}	