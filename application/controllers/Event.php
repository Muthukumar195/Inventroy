<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Event extends MY_Controller {
	  
	 public function __construct(){
		 
		 parent::__construct();		
		 $this->load->model('event_model');	
		 $this->load->library('form_validation');	
		 $this->load->helper('check_session');	
		 check_session();
		}
	
	//get event details		
	function get_event_list(){
		
		$data['data'] = $this->event_model->get_event_list($this->input->get('deb_id'));
		//output to json format
		echo json_encode($data); 	
	  
	}
	//get event details		
	//start add event validation
	function validation(){
	
		$this->form_validation->set_rules('event_title', 'Title', 'required');
		$this->form_validation->set_rules('event_desc', 'Description', 'required');
		if($this->form_validation->run()==FAlSE){
			$error= array();
			$error = $this->form_validation->error_array();		
			echo json_encode(array("error"=>$error));
		}
					
		else{
			$deb_id = $this->input->post('debtors_id');
				$data = array(
				'Event_debtor_id' => $deb_id,
				'Event_title' => $this->input->post('event_title'),
				'Event_description' => $this->input->post('event_desc'),
				'Event_call_user' => $this->input->post('call_user')					
				);
				if($this->event_model->add_event($data)){						
				echo json_encode(array("status"=>"Event Details Added Succesfully"));
				}
		}
		
	}
	//end event validation	
	//start get employee ref id 
	function get_employee_name(){
			
		$data = $this->event_model->get_employee_name($this->input->get('debtors_id'));
		echo json_encode($data);
	
	}
	//end get employee ref id 
	//delete event
	function delete_event(){		
			
		if($query = $this->event_model->delete_event($this->input->get('id'))){
			echo json_encode(array("status"=>"Event details deleted Successfully!"));
		}		
	}
	//delete event
	
}
