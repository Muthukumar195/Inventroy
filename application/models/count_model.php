<?php 
class Count_model extends CI_model{

	function customer_count(){
		
		$query = $this->db->get_where('customer_details', array('Cus_deleted'=>'0'));
		$count = $query->num_rows();
		return $count;
		
	}
	function debtors_count(){
		
		$query = $this->db->get_where('deptors_details', array('deptors_deleted'=>'0'));
		$count = $query->num_rows();
		return $count;
		
	}
	
	function employee_count(){
		
		$query = $this->db->get_where('employee_details', array('Emp_deleted'=>'0'));
		$count = $query->num_rows();
		return $count;
		
	}
	
}	