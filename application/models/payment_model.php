<?php 
class Payment_model extends CI_model{
	
	
	public function get_payment_list($id){		
		
		$this->db->select('payment_details.*,paymethod_details.*');
		$this->db->from('payment_details');
		$this->db->join('paymethod_details', 'paymethod_details.Pay_method_id = payment_details.Payment_method', 'Left');
		$this->db->where('Payment_debtor_id', $id);
		$this->db->order_by('Payment_create_dt', 'DESC');
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		return $query->result();
	}	
	public function owing_amount($id){		
		
		$this->db->select('deptors_id, deptors_debtors_owing');
		$this->db->from('deptors_details');
		$this->db->where('deptors_id', $id);
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		return $query->result();
	}
	public function add_payment($data,$data2,$id){
		//insert payment details
	   $this->db->set('Payment_create_dt', 'NOW()', FALSE);
	   $this->db->insert('payment_details', $data);
	   //update deptor details
	    $this->db->where('deptors_id', $id);
		 $this->db->set('deptors_update_dt', 'NOW()', FALSE);
		 $this->db->update('deptors_details', $data2);		
		return true;
	}
	
	
}	