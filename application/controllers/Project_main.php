<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_main extends MY_Controller {

	
	 public function __construct(){
		 
		 parent::__construct();
		 $this->load->model('login_model');
		 $this->load->model('count_model');	
		}
	public function index()
	{
		$this->load->view('login');
	}
	
	//Start Login validation 
	function login(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password', 'password', 'required');
		if($this->form_validation->run() == FALSE){
			
			$this->load->view('login');
		}
		else{
			$query = $this->login_model->login();		
			if($query->num_rows() == 1){
				$result = $query->result();
		
				if($result[0]->User_deleted=="1"){
					$this->session->set_flashdata('failer_msg','Account suspended!');
					$this->load->view('login');
				}
				else{
					foreach($result as $row){			
						$session_data = array(
						'login_id' => $row->User_id,
						'firstname' => $row->User_firstname,
						'lastname' => $row->User_lastname,
						'username' => $row->User_username,
						'password' => $row->User_password,
						'user_type' => $row->User_type,
						'user_level' => $row->User_type_level,
						'emp_id' => $row->User_emp_id,
						'cus_id' => $row->User_cus_id,
						'logged_in' => TRUE
						);
						$this->session->set_userdata($session_data);
					}			
					redirect('project_main/dashboard');
				}
			}
		
			else{ //invalid username/password
			
				$this->session->set_flashdata('failer_msg','Invaid Username and Password');
				$this->load->view('login');
			}
		}	
	}
	//End Login validation
	//Start Dashboard
	function dashboard(){
		
		if(! $this->session->userdata('username')){

			$this->check_isvalidated();
		}
		else{
			//count table details
			$data['customer_count']= $this->count_model->customer_count();
			$data['debtors_count']= $this->count_model->debtors_count();			
			$data['employee_count']= $this->count_model->employee_count();
			$this->load_page_view('dashboard', $data);
		}
	}

	//end Dashboard
	//edit profile
	function edit_profile(){
		if(! $this->session->userdata('username')){

			$this->check_isvalidated();
		}
		else{
		
			$data['profile_details']= $this->login_model->profile_details($this->session->userdata('login_id'));		
			$this->load_page_view('edit_profile', $data);
		}
	}
	//edit profile 
	//start user validation
	function edit_profile_validation(){
	
		if(! $this->session->userdata('username')){
			
			$this->check_isvalidated();
		}
		else{	
						
			$this->form_validation->set_rules('firstname', 'Firstname','required');
			$this->form_validation->set_rules('lastname', 'Lastname','required');
			$this->form_validation->set_rules('old_password', 'Old password','required|callback_check_password');
			$this->form_validation->set_rules('new_password', 'New password','required');
			$this->form_validation->set_rules('con_password', 'Confirm password','required|matches[new_password]');
		
			if($this->form_validation->run() == FALSE){
				$error= array();
				$error[] = validation_errors();			
				echo json_encode(array("error"=>$error));
				
			}
			else{			
				
				if($query = $this->login_model->edit_profile($this->input->post('user_id'))){
				
					echo json_encode(array("status"=>"User Profile details Updated Successfully!"));		
				}
			}
		}
	}
	
	//end user validation
	//Start logout 
	function logout(){
		
		$this->session->sess_destroy();
		$this->session->set_flashdata('success_msg','Logout Successfully!');
		$this->load->view('login');
	
	}
	//End Logout
	//Start Check old pass matches
	function check_password($key){
		
		$is_exist = $this->login_model->check_password($key);
		if($is_exist==0){
			$this->form_validation->set_message('check_password', 'Old Password not match'); 
			
			return false;
		}else{
			return true;
		}
		
	}
	//End Check old pass matches
	//login required
	function check_isvalidated(){
		
		$this->session->set_flashdata('failer_msg', 'Login Required');
		$this->load->view('login');
	}
	//login required
	
	

}
