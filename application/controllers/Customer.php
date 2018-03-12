<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer extends MY_Controller {
	  
	 public function __construct(){
		 
		 parent::__construct();
		 $this->load->model('customer_model');
		 $this->load->model('status_model');
		 $this->load->model('address_model');
		 $this->load->model('employee_model');
		 $this->load->model('debtors_model');
		 $this->load->model('common_model');		 		 
		 $this->load->library('form_validation');
		 $this->load->helper('check_session');	
		 check_session();
		}
	public function index()
	{
	  $this->load_page_view('customer_details');	
	}
	//get customer details
	function get_table_list(){
		
	        $user_type = $this->session->userdata('user_type'); 
			$emp_id = $this->session->userdata('emp_id');
			$cus_id = $this->session->userdata('cus_id');	
			$data['data'] = $this->customer_model->customer_details($user_type,$emp_id,$cus_id);
			//output to json format
			echo json_encode($data); 	
	  
	}
	//get customer details
	
	//start add customer
	function add_customer(){
		
		$data['status_details'] = $this->status_model->status_details();	
		$data['employee_list'] = $this->employee_model->employee_list();		
		$this->load_page_view('add_customer', $data);
	
	}
	//end add customer
	
	//start add customer validation
	function validation(){
			
		$this->form_validation->set_rules('firstname', 'Firstname','required');
		$this->form_validation->set_rules('lastname', 'Lastname','required');
		$this->form_validation->set_rules('code', 'Code','required');
		$this->form_validation->set_rules('company', 'Company','required');
		$this->form_validation->set_rules('street', 'stree','required');
		$this->form_validation->set_rules('city', 'City','required');
		$this->form_validation->set_rules('state', 'State','required');
		$this->form_validation->set_rules('zipcode', 'Zipcode','required');
		$this->form_validation->set_rules('country', 'Country','required');
		$this->form_validation->set_rules('email', 'Email','required|is_unique[address_details.Address_email]');
		$this->form_validation->set_rules('phone1', 'Phone','required');
		$this->form_validation->set_rules('plan_type', 'Plan type','required');
		$this->form_validation->set_rules('status', 'Status','required');		
		if($this->form_validation->run() == FALSE){			
			$error= array();
			$error = $this->form_validation->error_array();		
			echo json_encode(array("error"=>$error));
		}
		else{
			
			$result = $this->address_model->add_address();		
			if($this->customer_model->add_customer($result)){				
				echo json_encode(array("status"=>"Customer Details Added Succesfully"));
			}
		}
		
	}
	//end customer validation	
	//Start Edit customer deatils	
	function edit_customer(){
	
		if($this->input->post('cust_id')==""){
			$id = $this->session->userdata('cus_id');
		}
		else{
			$id = $this->input->post('cust_id');
		}
					
		$data['get_customer_details'] = $this->customer_model->get_customer_details($id);
		$data['status_details'] = $this->status_model->status_details();
		$data['employee_list'] = $this->employee_model->employee_list();
		if($id==""){
			$this->load_page_view('customer_details');
		}else{
		$this->load_page_view('edit_customer', $data);
		}
	
	}
	//End edit customer details
	//start edit validation 
	function edit_validation(){
		
		$this->form_validation->set_rules('firstname', 'Firstname','required');
		$this->form_validation->set_rules('lastname', 'Lastname','required');
		$this->form_validation->set_rules('code', 'Code','required');
		$this->form_validation->set_rules('company', 'Company','required');
		$this->form_validation->set_rules('street', 'stree','required');
		$this->form_validation->set_rules('city', 'City','required');
		$this->form_validation->set_rules('state', 'State','required');
		$this->form_validation->set_rules('zipcode', 'Zipcode','required');
		$this->form_validation->set_rules('country', 'Country','required');
		$this->form_validation->set_rules('email', 'Email','required');
		$this->form_validation->set_rules('phone1', 'Phone','required');
		$this->form_validation->set_rules('plan_type', 'Plan type','required');
		//$this->form_validation->set_rules('employee', 'Employee','required');
		$this->form_validation->set_rules('status', 'Status','required');
	
		if($this->form_validation->run() == FALSE){
			$error= array();
			$error = $this->form_validation->error_array();			
			echo json_encode(array("error"=>$error));	
		}
		else{
		
			$result = $this->address_model->edit_address($this->input->post('address_id'));		
			if($query = $this->customer_model->edit_customer($this->input->post('cus_id'))){				
				echo json_encode(array("status"=>"Customer details Edited Successfully!"));					
			}
		}
		
	}		
	//end edit validation
	//view customer
	function view_customer(){
			
			$data['view_customer'] = $this->customer_model->view_customer($this->input->post('cust_id'));
			if(!$this->input->post('cust_id')){
				$this->load_page_view('customer_details');
			}else{
			$this->load_page_view('view_customer', $data);
			}
		
	}
	//view customer
	//delete customer
	function delete_customer(){		
			
			if($query = $this->customer_model->delete_customer($this->input->post('custId'))){
				echo json_encode(array("status"=>"Customer details deleted Successfully!"));
			}	
	}
	//delete customer
	//status change customer
	function status_customer(){		
			
		if($query = $this->customer_model->status_customer($this->input->post('custId'),$this->input->post('CustStatus'))){
			echo json_encode(array("status"=>"Customer Status Change Successfully!"));	
		}			
	
	}
	//status change customer
	
   //Start deptors Details list
	function debtors_details(){
		
			$this->load_page_view('debtors_details');
		
	}
	//Start deptors Details list
	//Start ajax deptors Details list
	function debtors_details_list(){
		
			$post_id = $this->input->get('cus_id'); 
			if($post_id!=''){
			$id = $this->input->get('cus_id'); 
			}
			else{
				
			$id = $this->session->userdata('cus_id'); 
			}
			$data['data'] = $this->debtors_model->debtors_details($id);			
			echo json_encode($data); 
		
	}
	//Start ajax deptors Details list	
	//add Deptors
	function add_debtors(){
	
		$data['account_types'] = $this->debtors_model->account_types();	
		$data['debtor_status'] = $this->debtors_model->debtor_status();	
		$this->load_page_view('add_debtors', $data);		
	
	}
	//add deptors
	//start debtors validation
	function debtors_validation(){		
		
		$this->form_validation->set_rules('firstname', 'Firstname','required');
		$this->form_validation->set_rules('lastname', 'Lastname','required');
		$this->form_validation->set_rules('ac_type', 'Account Type','required');
		$this->form_validation->set_rules('ref_no', 'Ref no','required');
		$this->form_validation->set_rules('street', 'stree','required');
		$this->form_validation->set_rules('city', 'City','required');
		$this->form_validation->set_rules('state', 'State','required');
		$this->form_validation->set_rules('zipcode', 'Zipcode','required');
		$this->form_validation->set_rules('country', 'Country','required');
		$this->form_validation->set_rules('email', 'Email','required|is_unique[address_details.Address_email]');
		$this->form_validation->set_rules('phone_type', 'Phone Type','required');
		$this->form_validation->set_rules('phone_no', 'Phone Number','required');
		$this->form_validation->set_rules('price', 'Price','required');
		$this->form_validation->set_rules('int_fees', 'Intrest Fees','required');
		$this->form_validation->set_rules('last_service', 'last services','required');
		$this->form_validation->set_rules('deb_status', 'Status','required');
	
		if($this->form_validation->run() == FALSE){				
			$error= array();
			$error = $this->form_validation->error_array();
			echo json_encode(array("error"=>$error));
		}
		else{
									
			$result = $this->address_model->add_deb_address();
			if($deb_id = $this->debtors_model->add_debtors($result))
			{
				//fileupload config
				$this->load->helper('inflector');
				if (!is_dir('uploads/debtors/'.$deb_id)) {
					mkdir('./uploads/debtors/' . $deb_id, TRUE);

				}
				$upload_dir = "./uploads/debtors/".$deb_id;
				$config = array(			
				'upload_path' => $upload_dir,
				'allowed_types' => "gif|jpg|png|jpeg|pdf|docx",
				'overwrite' => FALSE,
				'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
				'create_thumb' => TRUE,
				'thumb_marker' => '_thumb'				
				);
			   $this->load->library('upload', $config);
				if($this->upload->do_upload('deb_file'))
				{ 
				$res = $this->upload->data();
				$file_path     = $res['file_path'];
				$file         = $res['full_path'];
				$file_ext     = $res['file_ext'];
				$final_file_name = $this->debtors_model->upload_file($file_ext,$deb_id); 			  
				rename($file, $file_path . $final_file_name); 
				}
				echo json_encode(array("status"=>"Deptors Details Added Succesfully"));

			}			
			
		}
		
	}
	//End deptors Validation

	
	//start edit Deptors
	function edit_debtors(){
		
		$data['account_types'] = $this->debtors_model->account_types();	
		$data['debtor_status'] = $this->debtors_model->debtor_status();			
		$data['get_debtors_details'] = $this->debtors_model->get_debtors_details($this->input->post('id'),$this->input->post('cust_id'));
	
		if($this->input->post('id')!=""){
		$this->load_page_view('edit_debtors', $data);	
		}
		else{
			redirect("customer/add_debtors");
		}
		
	}
	//end edit deptors
	
	//start EDIT debtors validation
	function edit_debtors_validation(){		
		
		$user_type = $this->session->userdata('user_type');
		if($user_type=="Customer"||$user_type=="Admin"){			
		$this->form_validation->set_rules('firstname', 'Firstname','required');
		$this->form_validation->set_rules('lastname', 'Lastname','required');
		$this->form_validation->set_rules('ac_type', 'Account Type','required');
		$this->form_validation->set_rules('ref_no', 'Ref no','required');
		$this->form_validation->set_rules('street', 'stree','required');
		$this->form_validation->set_rules('city', 'City','required');
		$this->form_validation->set_rules('state', 'State','required');
		$this->form_validation->set_rules('zipcode', 'Zipcode','required');
		$this->form_validation->set_rules('country', 'Country','required');
		$this->form_validation->set_rules('price', 'Price','required');
		$this->form_validation->set_rules('int_fees', 'Intrest Fees','required');
		$this->form_validation->set_rules('int_fees', 'Intrest Fees','required');
		$this->form_validation->set_rules('last_service', 'last services','required');
		}
		$this->form_validation->set_rules('deb_status', 'Status','required');
	
		if($this->form_validation->run() == FALSE){			
			$error= array();
			$error = $this->form_validation->error_array();					
			echo json_encode(array("error"=>$error));	
		}
		else{			 				
			$result = $this->address_model->edit_deb_address($this->input->post('address_id'));		
			if($query = $this->debtors_model->edit_debtors($this->input->post('debtor_id'),$this->input->post('cust_id')))
			{ 
			
				 echo json_encode(array("status"=>"Deptors details edited Successfully!"));					

			}			
			
		}
		
	}
	//End edit deptors Validation
	//delete debtors
	function delete_debtors(){
			
		if($query = $this->debtors_model->delete_debtors($this->input->post('depId'))){
			
			$this->session->set_flashdata('success_msg', 'Deptors details deleted Successfully!');
			echo json_encode(array("status"=>"Debtors details deleted Successfully!"));
		}			
	
	}
	//delete debtors
	//view debtors
	function view_debtors(){		
	
		$data['activities_details'] = $this->common_model->activities_details();
		$data['letter_details'] = $this->common_model->letter_details();
		$data['debtor_status'] = $this->debtors_model->debtor_status();	
		$data['view_debtors'] = $this->debtors_model->view_debtors($this->input->post('id'));
		$this->load_page_view('view_debtors', $data);
	
	}
	//view debtors
	//debtors status update
	function debtors_status_update(){
	
		//update customer x debtors status			
		$cxd = array(
		'cxd_last_active_id' => $this->input->post('active_list'),		
		'cxd_letter_send' => $this->input->post('letter_list'),
		'cxd_status' => $this->input->post('deb_status')
		
		);			
		if($query = $this->debtors_model->debtors_status_update($this->input->post('cxd_id'),$cxd)){
			
			echo json_encode(array("status"=>"Status Change Successfully!"));
		}
		
	}
	//debtors status update
	//print letter template debtors
	function letter_print(){
		$this->load->model('letter_model');
		$data['view_debtors'] = $this->debtors_model->view_debtors($this->input->post('id'));
		$data['print_letter'] = $this->letter_model->get_letter_details($this->input->post('letter_id'));
		$this->load->view('debtor_print_letter', $data);
	}
	//print letter template debtors
	
	
}
