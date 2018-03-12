<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment extends MY_Controller {
	  
	 public function __construct(){
		 
		 parent::__construct();		
		 $this->load->model('payment_model');
	     $this->load->model('common_model');		 
		 $this->load->library('form_validation');	
		 $this->load->helper('check_session');	
		 check_session();
		}
	
	//get payment method details		
	function get_payment_method(){		
	     
			$data = $this->common_model->pay_method_details($this->input->get('debtors_id'));
			$owing = $this->payment_model->owing_amount($this->input->get('debtors_id'));
			$method ='';
			foreach($data as $val){
				$method .= '<option value="'.$val->Pay_method_id.'">'.$val->Pay_methods.'</option>';
			}
		echo $method.'^'.$owing[0]->deptors_debtors_owing;
	}
	//get  payment method details	

	//owing details		
	function owing_amount(){		
	     
			$data = $this->payment_model->owing_amount($this->input->get('deb_id'));
			//output to json format
			//echo json_encode($data); 	
			echo $data[0]->deptors_debtors_owing;	  
	}
	//payments details
	
	//get payment details		
	function get_payment_list(){		
	     
			$data['data'] = $this->payment_model->get_payment_list($this->input->get('deb_id'));
			//output to json format
			echo json_encode($data); 	
	  
	}
	//get payment details
		
	//start add payment validation
	function validation(){	
			
		$this->form_validation->set_rules('pay_amount', 'Amount', 'required');
		if($this->form_validation->run()==FALSE){
			
			$error= array();
			$error = $this->form_validation->error_array();		
			echo json_encode(array("error"=>$error));
		}					
		else{
			$deb_id = $this->input->post('debtors_id');	
			$pay_amt  = $this->input->post('pay_amount');
			$owing  = $this->input->post('owing_amt'); 
			$up_owing = intval($owing)-intval($pay_amt); 
				$data = array(
				'Payment_debtor_id' => $deb_id,
				'Payment_date' => date('Y-m-d', strtotime($this->input->post('pay_date'))),
				'Payment_desc' => $this->input->post('pay_desc'),
				'Payment_amount' => $pay_amt,
				'Payment_method' => $this->input->post('pay_method')
				);
				$data2 = array(
				'deptors_debtors_owing' => $up_owing
				);					
				if($this->payment_model->add_payment($data,$data2,$deb_id)){
				 echo json_encode(array("status"=>"Payment Details Added Succesfully"));
				}
		   }
		
	}
	//end payment validation	
	 
	
}
