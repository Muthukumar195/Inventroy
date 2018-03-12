<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	
	 public function __construct(){
		 
		 parent::__construct();
		 $this->load->model('user_model');
		 $this->load->model('user_type_model');
		 $this->load->model('customer_model');
		 $this->load->model('status_model');
		 $this->load->library('form_validation');
		 $this->load->helper('check_session');	
		 check_session();
		}
	
	public function index()
	{	
		$this->load_page_view('user_details');
	}
	//user details list
	function user_details_list(){
		
		if(! $this->session->userdata('username')){
			
			$this->check_isvalidated();
		}
		else{
			$data['data'] = $this->user_model->user_details();
			echo json_encode($data);	
			
		}
	}
	//user details list
	//start add user
	function add_user(){
		$data['user_types'] = $this->user_type_model->user_types();
		$data['status_details'] = $this->status_model->status_details();
		$data['customer_list'] = $this->customer_model->customers(); 
		$this->load_page_view('add_user', $data);
	}
	//end add user
	//start user validation
	function validation(){
						
		$this->form_validation->set_rules('firstname', 'Firstname','required');
		$this->form_validation->set_rules('lastname', 'Lastname','required');
		$this->form_validation->set_rules('username', 'Username','required|is_unique[user_details.User_username]');
		$this->form_validation->set_rules('password', 'password','required');
		$this->form_validation->set_rules('con_password', 'Confirm password','required|matches[password]');
		$this->form_validation->set_rules('user_type', 'User type','required');			
		$this->form_validation->set_rules('status', 'Status','required');
	
		if($this->form_validation->run() == FALSE){
			
		    $error= array();
			$error = $this->form_validation->error_array();			
			echo json_encode(array("error"=>$error));	
		}
		else{			
			
			if($query = $this->user_model->add_user()){
			
				echo json_encode(array("status"=>"User details Added Successfully!"));		
			}
		}
	
	}
	
	//end user validation	
	
	//start edit user
	function edit_user(){		
					
		$data['user_types'] = $this->user_type_model->user_types();
		$data['status_details'] = $this->status_model->status_details();
		$data['customer_list'] = $this->customer_model->customers(); 
		$data['get_user_details'] = $this->user_model->get_user_details($this->input->post('user_id'));
		$data['get_empxcus'] = $this->user_model->get_empxcus($this->input->post('user_id'));	
		if(!$this->input->post('user_id')){
			redirect("user/add_user");
		}else{
			$this->load_page_view('edit_user', $data);	
		}
			
	}
	//end edit user
	
	//start edit user validation
	function edit_validation(){		
		
		$this->form_validation->set_rules('firstname', 'Firstname','required');
		$this->form_validation->set_rules('lastname', 'Lastname','required');		
		$this->form_validation->set_rules('user_type', 'User type','required');			
		$this->form_validation->set_rules('status', 'Status','required');
	
		if($this->form_validation->run() == FALSE){
			
			$error= array();
			$error = $this->form_validation->error_array();			
			echo json_encode(array("error"=>$error));
		}
		else{			
			
			if($query = $this->user_model->edit_user($this->input->post('user_id'))){
					
				 echo json_encode(array("status"=>"User details edited Successfully!"));							
			}
		}
	
	}	
	//end edit  user validation		
	
	//delete 
	function delete_user(){
	
		if($query = $this->user_model->delete_user($this->input->post('userId'))){	
			
			echo json_encode(array("status"=>"User details deleted Successfully!"));
		}
	
	}
	//delete
	//delete 
	function user_status(){
	
		if($query = $this->user_model->user_status($this->input->post('userId'), $this->input->post('userStatus'))){	
			
			echo json_encode(array("status"=>"User details status Change Successfully!"));
		}
	
	}
	//delete
	
	
}
