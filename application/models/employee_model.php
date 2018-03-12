<?php 
class Employee_model extends CI_model{	
	

	 function employee_list(){		
		$this->db->order_by('Emp_firstname', "ASC");
		$query = $this->db->get_where('employee_details', array('Emp_deleted'=>'0'));
		return $query;
	}
	function employee_ass_customer($id){
		
		$this->db->select('employeexcustomer.*, customer_details.Cus_id, customer_details.Cus_firstname, customer_details.Cus_lastname');
		$this->db->from('employeexcustomer');
		$this->db->join('customer_details', 'customer_details.Cus_id = employeexcustomer.exc_cus_id');
		$this->db->where('exc_emp_id', $id);
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		return $query->result();
	}
}	