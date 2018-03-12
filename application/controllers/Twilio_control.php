<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Twilio_control extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		
		$this->load_page_view('send_sms');
	}
	function send_sms(){
		//load library twilio
		$this->load->library('twilio');		
		$this->form_validation->set_rules('phone', 'Phone','required');
		$this->form_validation->set_rules('sms', 'SMS','required');
		
		if($this->form_validation->run() == FALSE){			
			$error= array();
			$error = $this->form_validation->error_array();		
			echo json_encode(array("error"=>$error));
		}
		else{
			//sms configration
			//$from = '+12014686595';
			//$to = '+918675752575';
			$set_num = '+91'.$this->input->post('phone');
			$from = '+12014686595';
			$to = $set_num;
			$message = $this->input->post('sms');

			$response = $this->twilio->sms($from, $to, $message);
			

			if($response->IsError){
				//echo 'Error: ' . $response->ErrorMessage;
				$error= array();
			    $error['sms_error'] = $response->ErrorMessage;		
				echo json_encode(array("error"=>$error));
			
			}
			else{
				
				echo json_encode(array("status"=>"Sent message to ". $to.""));
			
			}
		}
	}
	
	
}

/* End of file twilio_demo.php */