<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Employee extends MY_Controller {
	  
	 public function __construct(){
		 
		 parent::__construct();		
		 $this->load->model('employee_model');	
		 $this->load->library('form_validation');	
		 $this->load->helper('check_session');	
		 check_session();
		}
		
	function index(){
		
		$this->load_page_view('employee_details');
	}
	
	//get employee details		
	function get_employee_list(){
		
		$query = $this->employee_model->employee_list();
		$data['data'] = $query->result();
		//output to json format
		echo json_encode($data); 	
	  
	}
	//get employee details		
	function employee_ass_customer(){		
		
		$data = $this->employee_model->employee_ass_customer($this->input->get('employee_id'));
		//output to json format
		echo json_encode(array("customers"=>$data)); 
	}
	//delete event
	function delete_event(){		
			
		if($query = $this->event_model->delete_event($this->input->get('id'))){
			echo json_encode(array("status"=>"Event details deleted Successfully!"));
		}		
	}
	//delete event
	
}
