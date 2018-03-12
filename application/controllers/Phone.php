<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Phone extends MY_Controller {
	  
	 public function __construct(){
		 
		 parent::__construct();		
		 $this->load->model('phone_model');	
		 $this->load->library('form_validation');	
		 $this->load->helper('check_session');	
		 check_session();		 
		}
	
	//get phone details		
	function get_phone_list(){		
	     
			$data['data'] = $this->phone_model->phone_details($this->input->get('deb_id'));
			//output to json format
			echo json_encode($data); 	
	  
	}
	//get phone details
		
	//start add phone validation
	function validation(){
		
		$this->form_validation->set_rules('phone_type', 'Phone Type','required');
		$this->form_validation->set_rules('phone_no', 'Phone Number','required');
		if($this->form_validation->run() == FALSE){				
			$error= array();
			$error[] = validation_errors();			
			echo json_encode(array("error"=>$error));
		}
		else{			
			if($this->input->post('phone_no')!=""){
				$data1 = array(
				'Phone_debtor_id' => $this->input->post('debtors_id'),
				'Phone_type' => $this->input->post('phone_type'),
				'Phone_number' => $this->input->post('phone_no'),
				'Phone_sort' => $this->input->post('phone_sort'),
				);
				$merger1 = array($data1);
				$data_merge = array_merge($merger1);
			}
			if($this->input->post('phone_no2')!=""){
				$data2 = array(
				'Phone_debtor_id' => $this->input->post('debtors_id'),
				'Phone_type' => $this->input->post('phone_type2'),
				'Phone_number' => $this->input->post('phone_no2'),
				'Phone_sort' => $this->input->post('phone_sort2'),
				);
				$merger2 = array($data2);
				$data_merge = array_merge($merger1,$merger2);
			}
			if($this->input->post('phone_no3')!=""){
				$data3 = array(
				'Phone_debtor_id' => $this->input->post('debtors_id'),
				'Phone_type' => $this->input->post('phone_type3'),
				'Phone_number' => $this->input->post('phone_no3'),
				'Phone_sort' => $this->input->post('phone_sort3'),
				);
				$merger3 = array($data3);
				$data_merge = array_merge($merger1,$merger2,$merger3);
			}
			//print_r($data_push); 
			if($this->phone_model->add_phone($data_merge)){					
				echo json_encode(array("status"=>"Phone Details Added Succesfully"));
			}
		}
		
	}
	//end phone validation	
	//Start Edit phone deatils	
	function edit_phone(){

		$data = $this->phone_model->get_phone_details($this->input->get('PhoneId'));
		//output to json format
		echo json_encode($data);			
		
	}
	//End edit phone details
	//start edit validation 
	function edit_validation(){
		
		$this->form_validation->set_rules('phone_type', 'Phone Type','required');
		$this->form_validation->set_rules('phone_no', 'Phone Number','required');
	
		if($this->form_validation->run() == FALSE){
			$error= array();
			$error[] = validation_errors();			
			echo json_encode(array("error"=>$error));	
		}
		else{
			$data = array(
			'Phone_type' => $this->input->post('phone_type'),
			'Phone_number' => $this->input->post('phone_no'),
			'Phone_sort' => $this->input->post('phone_sort'),
			);				
			if($query = $this->phone_model->update_phone($this->input->post('id'),$data)){				
				echo json_encode(array("status"=>"Phone details Edited Successfully!"));					
			}
		}
		
	}		
	//end edit validation
	
	//delete phone
	function delete_phone(){
	
		if($query = $this->phone_model->delete_phone($this->input->get('id'))){
			echo json_encode(array("status"=>"Phone details deleted Successfully!"));
		}
		
	}
	//delete phone
}
