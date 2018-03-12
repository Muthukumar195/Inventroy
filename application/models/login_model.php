<?php 
class Login_model extends CI_model{

	public function login(){
		
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$this->db->select('user_details.*, user_types.*,  userxcustomer.*, userxemployee.*');
		$this->db->from('user_details');
		$this->db->join('user_types', 'user_types.User_type_id = user_details.User_type_id', 'Left');
		$this->db->join('userxcustomer', 'userxcustomer.Userxc_id = user_details.User_id', 'Left');
		$this->db->join('userxemployee', 'userxemployee.Userx_id = user_details.User_id', 'Left');
		$this->db->where('User_username', $username);
		$this->db->where('User_password', $password);
		$query = $this->db->get();
		
		return $query;
	}
	public function user_details_details(){
		
		$query = $this->db->get('user_details');
		return $query;
	}
	function profile_details($id){
		$query = $this->db->get_where('user_details',array('User_id'=>$id));
		return $query;
		
	}
	function check_password($pass)
	{
	$query = $this->db->get_where('user_details',array('User_password'=>$pass));

        if ($query->num_rows() > 0) //if message exists
	   {
	   	return 1;
	   }
	   else
	   {
	   	 return 0;
	   }       	 
	}
	function edit_profile($id){
		
		$user_data = array(
		'User_firstname' => $this->input->post('firstname'),
		'User_lastname' => $this->input->post('lastname'),
		'User_username' => $this->input->post('username'),
		'User_password' => $this->input->post('new_password'),
		);
		$this->db->set('User_update_dt','NOW()', FALSE);
		$this->db->where('User_id',$id);
		$this->db->update('user_details', $user_data);
		return true;
	}
}	