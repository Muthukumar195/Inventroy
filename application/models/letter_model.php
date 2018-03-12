<?php 
class Letter_model extends CI_model{
	
	//letter details list
	function letter_details(){	
		
		$this->db->select('*');
		$this->db->from('letter_template');
		$this->db->where('Letter_deleted', '0');
		$this->db->order_by('Letter_sort', 'ASC');
		$this->db->order_by('Letter_id', 'DESC');
		$query = $this->db->get();
		
		return $query->result();
	}
	//letter details list
	//add letter details
	function add_letter(){		
	
		$letter_data = array(
		'Letter_name' => $this->input->post('letter_name'),
		'Letter_category' => $this->input->post('letter_category'),
		'Letter_description' => $this->input->post('description'),
		'Letter_sort' => $this->input->post('letter_sort')
		);
		$this->db->set('Letter_create_dt','NOW()', FALSE);
		$this->db->insert('letter_template', $letter_data);
		return true;
	}
	//add letter details
	
	//get letter details
	function get_letter_details($id){
	
		$query = $this->db->get_where('letter_template', array('Letter_id'=>$id));	
		
		return $query;
	}
	//get letter details
	//edit letter details
	function edit_letter($id){
		
		$update_data = array(
		'Letter_name' => $this->input->post('letter_name'),
		'Letter_category' => $this->input->post('letter_category'),
		'Letter_description' => $this->input->post('description'),
		'Letter_sort' => $this->input->post('letter_sort')
		);
		$this->db->set('Letter_update_dt','NOW()', FALSE);
		$this->db->where('Letter_id', $id);
		$this->db->update('letter_template', $update_data);
		
		return true;
	}
	//edit letter details
	
	//delete letter details
	function delete_letter($id){		
	
		$delete_data = array(		
		'Letter_deleted' => "1"		
		);
		$this->db->set('Letter_update_dt','NOW()', FALSE);
		$this->db->where('Letter_id', $id);
		$this->db->update('letter_template', $delete_data);
		//echo $this->db->last_query(); exit;
		return true;
	}
	//delete letter details
	
	//View letter details
	function view_letter($id){
		
		$this->db->select('customer_details.*, address_details.*, status_details.*');
		$this->db->from('customer_details');
		$this->db->join('address_details', 'address_details.Address_id = customer_details.Cus_address', 'Left');
		$this->db->join('status_details', 'status_details.Status_id = customer_details.Cus_status', 'Left');
		$this->db->where('Cus_id', $id);
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		return $query;
	}
	//View letter details
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