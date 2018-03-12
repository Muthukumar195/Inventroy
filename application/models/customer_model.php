<?php 
class Customer_model extends CI_model{
	
	//customer details list
	function customer_details($user_type,$emp_id,$cus_id){	
	
		if($user_type=="Employee"){
			//employeexcustomer get customer id
			$emp_qry = $this->db->get_where('employeexcustomer', array('exc_emp_id'=>$emp_id));
			$eg_id = '';
			$cnt =  $emp_qry->num_rows();
			//loop customer id 
			$count=0;
			foreach($emp_qry->result() as $emp){
			   $count;
				$eg_id .= $emp ->exc_cus_id; 
				if($count<$cnt-1){
					$eg_id .=',';
				}
				$count++;
			}			
		}
		$whr='';
		if($user_type=="Customer"){
			$whr = 'AND c.Cus_id ="'.$cus_id.'"';
		
		   }
		 //Employee where condition
		 elseif($user_type=="Employee"){			
			$whr = "AND Cus_id IN(".$eg_id.")";				
		 }		
		$query = $this->db->query('SELECT c.*, s.Status_id,s.Status_adrev, COUNT(cx.cust_id) AS debtor_count FROM customer_details c
LEFT JOIN status_details s ON s.Status_id = c.Cus_status
LEFT JOIN customerxdebtor cx ON c.Cus_id = cx.cust_id
WHERE c.Cus_deleted = "0"'.$whr.' GROUP BY c.Cus_id
ORDER BY c.Cus_id DESC');
		return $query->result();
	}
	//customer details list
	//add customer details
	function add_customer($address_id){		
	
		$cus_data = array(
		'Cus_firstname' => $this->input->post('firstname'),
		'Cus_lastname' => $this->input->post('lastname'),
		'Cus_code' => $this->input->post('code'),
		'Cus_company' => $this->input->post('company'),
		'Cus_address' => $address_id,
		'Cus_plan_type' => $this->input->post('plan_type'),
		'Cus_plan_desc' => $this->input->post('desc'),
		'Cus_notes' => $this->input->post('notes'),
		'Cus_status' => $this->input->post('status'),		
		);
		$this->db->set('Cus_create_dt','NOW()', FALSE);
		$this->db->insert('customer_details', $cus_data);
		return true;
	}
	//add customer details
	//edit customer details
	function edit_customer($id){	
		$emp_id = $this->input->post('employee');
		//edit customer
		$update_data = array(
		'Cus_firstname' => $this->input->post('firstname'),
		'Cus_lastname' => $this->input->post('lastname'),
		'Cus_code' => $this->input->post('code'),
		'Cus_company' => $this->input->post('company'),
		'Cus_plan_type' => $this->input->post('plan_type'),
		'Cus_plan_desc' => $this->input->post('desc'),
		'Cus_employee_id' => $emp_id,
		'Cus_notes' => $this->input->post('notes'),
		'Cus_status' => $this->input->post('status'),
		
		);
		$this->db->set('Cus_update_dt','NOW()', FALSE);
		$this->db->where('Cus_id', $id);
		$this->db->update('customer_details', $update_data);
	
		//empxcus update
		if($emp_id!=""){
		$query = $this->db->get_where('employeexcustomer', array("exc_emp_id"=>$emp_id,"exc_cus_id"=>$id));	
		$qry = $query->num_rows();
		//echo $qry; exit;
		if($qry>0){		
			$res = $query->result();
			$exc_id = $res[0]->exc_id; 
			$exc_data = array(	
			'exc_emp_id' => $emp_id
			);
			$this->db->where('exc_id', $exc_id);
			$this->db->update('employeexcustomer', $exc_data);
			}
		else{		
			$exc_data = array(	
			'exc_emp_id' => $emp_id,
			'exc_cus_id'=>$id
			);
			$this->db->set('exc_create_dt','NOW()', FALSE);
			$this->db->insert('employeexcustomer', $exc_data);
			}
		  }
	
		return true;
	}
	//edit customer details
	//get customer details
	function get_customer_details($id){
		
		$this->db->select('customer_details.*, address_details.*');
		$this->db->from('customer_details');
		$this->db->join('address_details', 'address_details.Address_id = customer_details.Cus_address', 'Left');
		$this->db->where('Cus_id', $id);
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		return $query;
	}
	//get customer details
	//delete customer details
	function delete_customer($id){		
	
		$delete_data = array(		
		'Cus_deleted' => "1"		
		);
		$this->db->set('Cus_update_dt','NOW()', FALSE);
		$this->db->where('Cus_id', $id);
		$this->db->update('customer_details', $delete_data);
		//echo $this->db->last_query(); exit;
		return true;
	}
	//delete customer details
	//status change customer details
	function status_customer($id,$status){		
		if($status==1){
			$status_up = array(		
			'Cus_status' => "2"		
			);
		}else{
			$status_up = array(		
			'Cus_status' => "1"		
			);
		}
		$this->db->set('Cus_update_dt','NOW()', FALSE);
		$this->db->where('Cus_id', $id);
		$this->db->update('customer_details', $status_up);
		return true;
	}
	//status change customer details
	//View customer details
	function view_customer($id){
		
		$this->db->select('customer_details.*, address_details.*, status_details.*');
		$this->db->from('customer_details');
		$this->db->join('address_details', 'address_details.Address_id = customer_details.Cus_address', 'Left');
		$this->db->join('status_details', 'status_details.Status_id = customer_details.Cus_status', 'Left');
		$this->db->where('Cus_id', $id);
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		return $query;
	}
	//View customer details
	//customer dropdown name list
	function customers(){
		$this->db->select('Cus_id, 	Cus_firstname, 	Cus_lastname');
		$this->db->from('customer_details');
		$this->db->where('Cus_deleted', "0");
		$this->db->where('Cus_status', "1");
		$this->db->order_by('Cus_firstname', "ASC");
		$query = $this->db->get();
		return $query;
	}
	//customer dropdown name lists
	
}	