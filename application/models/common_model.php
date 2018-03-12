<?php 
class Common_model extends CI_model{
	
	
	public function activities_details(){		
		
		$query = $this->db->get_where('activities_details', array('Activities_deleted =' => '0'));
		return $query;
	}
	public function letter_details(){		
		$this->db->select('*');
		$this->db->from('letter_template');
		$this->db->where('Letter_deleted', '0');
		$this->db->where('Letter_category', 'Debtors');
		$this->db->order_by('Letter_sort', 'ASC');
		$this->db->order_by('Letter_id', 'DESC');
		$query = $this->db->get();
		return $query;
	}
	public function pay_method_details(){		
		
		$query = $this->db->get_where('paymethod_details', array('	Pay_method_deleted =' => '0'));
		return $query->result();
	}
	
	
}	