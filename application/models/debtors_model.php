<?php 
class Debtors_model extends CI_model{
	
	//debtors details list
	public function debtor_status(){		
		
		$query = $this->db->get_where('debtor_status', array('debt_deleted =' => '0'));
		return $query;
	}
	//debtors details list
	
	//debtors dropdown account type name list
	function account_types(){
		$query = $this->db->get_where('account_types', array('Ac_type_deleted =' => '0'));
		return $query;
	}
	//debtors dropdown account type name list
	
	//add debtors details
	function add_debtors($address_id){
		//debtors_owing calculation
			$price = $this->input->post('price');
			$int_fees = $this->input->post('int_fees');
			$owing = $price+$int_fees;
		$qry = $this->db->get_where('customer_details', array("Cus_id"=>$this->input->post('customer_id')));
		$res = $qry->result();
		$ref_id = $res[0]->Cus_employee_id;
		
		//add debtors details
		$add_debtors = array(
		'deptors_firstname' => $this->input->post('firstname'),
		'deptors_lastname' => $this->input->post('lastname'),
		'deptors_ac_type' => $this->input->post('ac_type'),
		'deptors_ref_no' => $this->input->post('ref_no'),
		'deptors_address' => $address_id,
		'deptors_debtors_owing' => $owing		
		);
		$this->db->set('deptors_create_dt', 'NOW()', FALSE);
		$this->db->insert('deptors_details', $add_debtors);
		$debtors_id = $this->db->insert_id();		
		//add customer x debtors
		$cxd = array(
		'debtor_id' => $debtors_id,
		'cust_id' => $this->input->post('customer_id'),
		'cxd_prince_amt' => $price,
		'cxd_int_fees' => $int_fees,
		'cxd_status' => $this->input->post('deb_status'),
		'cxd_last_active_id' => '1',
		'cxd_last_service_date' => date('Y-m-d', strtotime($this->input->post('last_service'))),
		'cxd_ServiceRepID' => $ref_id
		);
		$this->db->set('cxd_created_dt', 'NOW()', FALSE);
		$this->db->insert('customerxdebtor', $cxd);
		//add phone numder
		$add_phone = array(
		'Phone_debtor_id' => $debtors_id,
		'Phone_type' => $this->input->post('phone_type'),
		'Phone_number' => $this->input->post('phone_no')
		);
		$this->db->set('Phone_create_dt', 'NOW()', FALSE);
		$this->db->insert('phone_details', $add_phone);
		//add notes
		$add_notes = array(
		'Notes_debtors_id' => $debtors_id,
		'Notes_user_id' => $this->session->userdata('login_id'),
		'Notes_memo' => $this->input->post('ser_notes')
		);
		$this->db->set('Notes_create_dt', 'NOW()', FALSE);
		$this->db->insert('notes_details', $add_notes);
		return $debtors_id;
	}	
	//add debtors details
	//start file upload
	 function upload_file($file_extension,$debtors_id)
	{		
		$this->db->select_max('Notes_id', 'max_id');
		$query = $this->db->get('notes_details'); 
		$res2 = $query->result_array();
        $max_id = $res2[0]['max_id']+1;		
		//file name set
		$file_name='Debtors'.$max_id.$file_extension;
		
		$data=array(
		'Notes_debtors_id' => $debtors_id,
		'Notes_user_id' => $this->session->userdata('login_id'),
		'Notes_memo' => 'Attachment',
		'Notes_attachment'=>$file_name);
		$this->db->set('Notes_create_dt', 'NOW()', FALSE);
		$this->db->insert('notes_details',$data);
		//echo $this->db->last_query(); exit();
		return $file_name;
	}
	//end file upload
	
	//debtors details
	function debtors_details($cus_id){
		
		$this->db->select('customerxdebtor.*, deptors_details.*, debtor_status.debt_status_id, debtor_status.debt_status_abrev, account_types.Ac_type_id, account_types.Ac_type_name');
		$this->db->from('customerxdebtor');
		$this->db->join('deptors_details', 'deptors_details.deptors_id = customerxdebtor.debtor_id', 'Left');
		$this->db->join('debtor_status', 'debtor_status.debt_status_id = customerxdebtor.cxd_status', 'Left');
		$this->db->join('account_types', 'account_types.Ac_type_id = deptors_details.deptors_ac_type', 'Left');
		$this->db->where('cust_id', $cus_id);
		$this->db->where('deptors_deleted', '0');
		$this->db->order_by('deptors_id', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}	
	//debtors details
	//get debtors details
	//get debtors details
	function get_debtors_details($id){
		
		$this->db->select('customerxdebtor.*, deptors_details.*, address_details.*');
		$this->db->from('customerxdebtor');
		$this->db->join('deptors_details', 'deptors_details.deptors_id = customerxdebtor.debtor_id');
		$this->db->join('address_details', 'address_details.Address_id = deptors_details.deptors_address');
		$this->db->where('debtor_id', $id);
		$query = $this->db->get();
		return $query;
	}
	//edit debtors details
	function edit_debtors($id, $cus_id){
		//debtors_owing calculation
			$price = $this->input->post('price');
			$int_fees = $this->input->post('int_fees');
			$owing = $price+$int_fees;
		//selete services rep id
		$qry = $this->db->get_where('customer_details', array("Cus_id"=>$cus_id));
		$res = $qry->result();
		$ref_id = $res[0]->Cus_employee_id;
		//update debtors details
		$update_debtors = array(
		'deptors_firstname' => $this->input->post('firstname'),
		'deptors_lastname' => $this->input->post('lastname'),
		'deptors_ac_type' => $this->input->post('ac_type'),
		'deptors_ref_no' => $this->input->post('ref_no'),
		'deptors_debtors_owing' => $owing
		);
		$this->db->set('deptors_update_dt', 'NOW()', FALSE);
		$this->db->where('deptors_id', $id);		
		$this->db->update('deptors_details', $update_debtors);
		
		//update customer x debtors
		$cxd = array(
		'debtor_id' => $id,		
		'cxd_prince_amt' => $price,
		'cxd_int_fees' => $int_fees,
		'cxd_status' => $this->input->post('deb_status'),
		'cxd_last_service_date' => date('Y-m-d', strtotime($this->input->post('last_service'))),
		'cxd_ServiceRepID' => $ref_id
		);
		$this->db->set('cxd_updated_dt', 'NOW()', FALSE);
		$this->db->where('debtor_id', $id);
		$this->db->update('customerxdebtor', $cxd);
		//echo $this->db->last_query(); exit;		
		return true;
	}
	//edit debtors details
	
	//start edit file upload
	 function edit_upload_file($file_extension,$max_id)
	{
		//file name set
		$file_name='Debtors'.$max_id.$file_extension;	
		
		$data=array('deptors_attachment'=>$file_name);
		$this->db->where('deptors_id',$max_id);
		$this->db->update('deptors_details',$data);
		//echo $this->db->last_query(); exit();
		return $file_name;
	}
	//end edit file upload
	//start delete debtors details
	function delete_debtors($id){		
	
		$delete_data = array(		
		'deptors_deleted' => "1"		
		);
		$this->db->set('deptors_update_dt','NOW()', FALSE);
		$this->db->where('deptors_id', $id);
		$this->db->update('deptors_details', $delete_data);
		//echo $this->db->last_query(); exit;
		return true;
	}
	//end delete debtors details
	//View customer details
	function view_debtors($id){
		
		$this->db->select('customerxdebtor.*, address_details.*, deptors_details.*, debtor_status.debt_status_id, debtor_status.debt_status_abrev, account_types.Ac_type_id, account_types.Ac_type_name, customer_details.Cus_id,customer_details.Cus_firstname,customer_details.Cus_lastname');
		$this->db->from('customerxdebtor');		
		$this->db->join('deptors_details', 'deptors_details.deptors_id = customerxdebtor.debtor_id', 'Left');
		$this->db->join('address_details', 'address_details.Address_id = deptors_details.deptors_address', 'Left');
		$this->db->join('debtor_status', 'debtor_status.debt_status_id = customerxdebtor.cxd_status', 'Left');
		$this->db->join('account_types', 'account_types.Ac_type_id = deptors_details.deptors_ac_type', 'Left');
		$this->db->join('customer_details', 'customer_details.Cus_id = customerxdebtor.cust_id', 'Left');
		$this->db->where('deptors_id', $id);	
		$query = $this->db->get();
		return $query;
	}
	//View customer details
	
	//debtors status update
	function debtors_status_update($id,$data){
		
		$this->db->set('cxd_updated_dt', 'NOW()', FALSE);
		$this->db->where('cxd_id', $id);
		$this->db->update('customerxdebtor', $data);
		//echo $this->db->last_query(); exit;		
		return true;
	}
	//debtors status update
	
}	