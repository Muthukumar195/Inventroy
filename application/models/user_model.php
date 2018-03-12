<?php 
class User_model extends CI_model{
	
	function user_details(){
		$this->db->select('user_details.*, user_types.User_type_id, user_types.User_type, user_types.User_type_level, status_details.Status_id, status_details.Status_adrev');
		$this->db->from('user_details');
		$this->db->join('user_types', 'user_types.User_type_id = user_details.User_type_id', 'Left');
		$this->db->join('status_details', 'status_details.Status_id = user_details.User_status', 'Left');
		$this->db->where('User_deleted', '0');
		$this->db->order_by('User_id','DESC');
		$query = $this->db->get();
		return $query->result();
	}
	function add_user(){
			
		$user_type_id = $this->input->post('user_type');
		$query = $this->db->get_where('user_types', array('User_type_id' => $user_type_id));
		$res = $query->result();
		 $user_type = $res[0]->User_type; 			
		
		$user_data = array(
		'User_firstname' => $this->input->post('firstname'),
		'User_lastname' => $this->input->post('lastname'),
		'User_username' => $this->input->post('username'),
		'User_password' => $this->input->post('password'),
		'User_type_id' => $this->input->post('user_type'),
		'User_status' => $this->input->post('status')	
		);
		$this->db->set('User_create_dt','NOW()', FALSE);
		$this->db->insert('user_details', $user_data);
		$user_id = $this->db->insert_id();
		if($user_type=="Customer"){
			//userxcustomer
			$customer = array(
			'Userxc_id' => $user_id,
			'User_cus_id' => $this->input->post('customer_ass')
			);			
			$this->db->set('User_cus_cretae_dt','NOW()', FALSE);
			$this->db->insert('userxcustomer', $customer);			
		}
		elseif($user_type=="Employee"){
			//insert employee details
			$employee = array(
			'Emp_firstname' => $this->input->post('firstname'),
			'Emp_lastname' => $this->input->post('lastname')
			);
			$this->db->set('Emp_create_dt','NOW()', FALSE);
			$this->db->insert('employee_details', $employee);
			$emp_id = $this->db->insert_id();
			//user x employee
			$emp = array(
			'Userx_id' => $user_id,
			'User_emp_id' => $emp_id
			);			
			$this->db->set('User_cus_cretae_dt','NOW()', FALSE);
			$this->db->insert('userxemployee', $emp);
			//employee x customer
			$assign_cus = $this->input->post('customer_asn');
			foreach($assign_cus as $cus){			
				
				$cusxcus = array(
				'exc_emp_id' => $emp_id,
				'exc_cus_id' => $cus
				);
				$this->db->set('exc_create_dt','NOW()', FALSE);
				$this->db->insert('employeexcustomer', $cusxcus);
			}	
		}
	
		return true;
	}
	
	function get_user_details($id){
		
		$this->db->select('user_details.*, userxcustomer.Userxc_id,userxcustomer.User_x_cus_id,userxcustomer.User_cus_id, userxemployee.User_x_emp_id, userxemployee.Userx_id, userxemployee.User_emp_id');
		$this->db->from('user_details');
		$this->db->join('userxcustomer', 'userxcustomer.Userxc_id = user_details.User_id', 'Left');
		$this->db->join('userxemployee', 'userxemployee.Userx_id = user_details.User_id', 'Left');
		$this->db->where('User_id', $id);
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		return $query;
	}

	//employee x customer get
	function get_empxcus($id){
		
		$this->db->select('userxemployee.*, employeexcustomer.exc_emp_id, employeexcustomer.exc_cus_id');
		$this->db->from('userxemployee');
		$this->db->join('employeexcustomer', 'employeexcustomer.exc_emp_id = userxemployee.User_emp_id', 'Left');
		$this->db->where('Userx_id', $id);
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		return $query;
	}
	//employee x customer get
	//edit user details
	function edit_user($id){
		
		//post ids
		$userxcus = $this->input->post('userxcus_id');
		$emp_id = $this->input->post('emp_id');
		$userxemp = $this->input->post('userxemp_id');
		
		//get user type datas	
		$user_type_id = $this->input->post('user_type');
		$query = $this->db->get_where('user_types', array('User_type_id' => $user_type_id));
		$res = $query->result();
		 $user_type = $res[0]->User_type; 	
		 
		//update user data
		$user_data = array(
		'User_firstname' => $this->input->post('firstname'),
		'User_lastname' => $this->input->post('lastname'),		
		'User_status' => $this->input->post('status')	
		);
		$this->db->set('User_update_dt','NOW()', FALSE);
		$this->db->where('User_id', $id);
		$this->db->update('user_details', $user_data);
		
		if($user_type=="Customer"){
			//userxcustomer
			$customer = array(
			'Userxc_id' => $id,
			'User_cus_id' => $this->input->post('customer_ass')
			);			
			$this->db->set('User_cus_cretae_dt','NOW()', FALSE);
			$this->db->where('User_x_cus_id',$userxcus);
			$this->db->update('userxcustomer', $customer);			
		}
		elseif($user_type=="Employee"){
			//insert employee details
			$employee = array(
			'Emp_firstname' => $this->input->post('firstname'),
			'Emp_lastname' => $this->input->post('lastname')
			);
			$this->db->where('Emp_id', $emp_id);
			$this->db->update('employee_details', $employee);
			
			//user x employee
			$emp = array(
			'Userx_id' => $id,
			'User_emp_id' => $emp_id
			);			
			$this->db->where('User_x_emp_id', $userxemp);
			$this->db->update('userxemployee', $emp);
			
			//employee x customer details
			$this->db->where('exc_emp_id', $emp_id);
			$this->db->delete('employeexcustomer');
			
			//employee x customer
			$assign_cus = $this->input->post('customer_asn');
			foreach($assign_cus as $cus){			
				
				$cusxcus = array(
				'exc_emp_id' => $emp_id,
				'exc_cus_id' => $cus
				);
				$this->db->set('exc_create_dt','NOW()', FALSE);
				$this->db->insert('employeexcustomer', $cusxcus);			
			}	
		}
		//echo $this->db->last_query(); exit;
		return true;
	}
	//edit user details
	function delete_user($id){		
	
		$delete_data = array(		
		'User_deleted' => "1"		
		);
		$this->db->set('User_update_dt','NOW()', FALSE);
		$this->db->where('User_id', $id);
		$this->db->update('user_details', $delete_data);
		//echo $this->db->last_query(); exit;
		return true;
	}
	//status change user details
	function user_status($id,$status){		
		if($status==1){
			$status_up = array(		
			'User_status' => "2"		
			);
		}else{
			$status_up = array(		
			'User_status' => "1"		
			);
		}
		$this->db->set('User_update_dt','NOW()', FALSE);
		$this->db->where('User_id', $id);
		$this->db->update('user_details', $status_up);
		return true;
	}
	//status change user details
	
}	