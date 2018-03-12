<?php 
class Address_model extends CI_model{
	
	
	public function add_address(){		
		
		$address_data = array(
		'Address_Street' => $this->input->post('street'),
		'Address_city' => $this->input->post('city'),
		'Address_state' => $this->input->post('state'),
		'Address_zipcode' => $this->input->post('zipcode'),
		'Address_country' => $this->input->post('country'),
		'Address_email' => $this->input->post('email'),		
		'Address_phone1' => $this->input->post('phone1'),
		'Address_phone2' => $this->input->post('phone2'),
		'Address_phone3' => $this->input->post('phone3')		
		);
		$this->db->set('Address_create_dt', 'NOW()', FALSE);
		$this->db->insert('address_details', $address_data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function add_deb_address(){	
		
		$address_data = array(
		'Address_Street' => $this->input->post('street'),
		'Address_city' => $this->input->post('city'),
		'Address_state' => $this->input->post('state'),
		'Address_zipcode' => $this->input->post('zipcode'),
		'Address_country' => $this->input->post('country'),
		'Address_email' => $this->input->post('email')		
		);
		$this->db->set('Address_create_dt', 'NOW()', FALSE);
		$this->db->insert('address_details', $address_data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function edit_address($id){		
		
		$update_data = array(
		'Address_Street' => $this->input->post('street'),
		'Address_city' => $this->input->post('city'),
		'Address_state' => $this->input->post('state'),
		'Address_zipcode' => $this->input->post('zipcode'),
		'Address_country' => $this->input->post('country'),
		'Address_email' => $this->input->post('email'),
		'Address_phone1' => $this->input->post('phone1'),
		'Address_phone2' => $this->input->post('phone2'),
		'Address_phone3' => $this->input->post('phone3')
		);
		$this->db->set('Address_update_dt', 'NOW()', FALSE);
		$this->db->where('Address_id', $id);
		$this->db->update('address_details', $update_data);
		return true;
	}
	public function edit_deb_address($id){		
		
		$update_data = array(
		'Address_Street' => $this->input->post('street'),
		'Address_city' => $this->input->post('city'),
		'Address_state' => $this->input->post('state'),
		'Address_zipcode' => $this->input->post('zipcode'),
		'Address_country' => $this->input->post('country'),
		'Address_email' => $this->input->post('email')
		);
		$this->db->set('Address_update_dt', 'NOW()', FALSE);
		$this->db->where('Address_id', $id);
		$this->db->update('address_details', $update_data);
		return true;
	}
	
}	