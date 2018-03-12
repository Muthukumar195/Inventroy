<?php 
class Notes_model extends CI_model{
	
	
	public function get_notes_list($id){		
		
		$this->db->select('notes_details.*,user_details.User_id, user_details.User_firstname, user_details.User_lastname');
		$this->db->from('notes_details');
		$this->db->join('user_details', 'user_details.User_id = notes_details.Notes_user_id', 'Left');
		$this->db->where('Notes_deleted ', '0');
		$this->db->where('Notes_debtors_id', $id);
		$this->db->order_by('Notes_create_dt', 'DESC');
		$query = $this->db->get();
		//echo $this->db->last_query(); exit;
		return $query->result();
	}
	public function add_notes($data){
		
	   $this->db->set('Notes_create_dt', 'NOW()', FALSE);
		$this->db->insert('notes_details', $data);
		//echo $this->db->last_query(); exit;
		return true;
	}
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
	
}	