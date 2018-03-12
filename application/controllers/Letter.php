<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Letter extends MY_Controller {
	  
	 public function __construct(){
		 
		 parent::__construct();		
		 $this->load->model('letter_model');	
		 $this->load->library('form_validation');
		 $this->load->library("Pdf");
		 $this->load->helper('check_session');	
		 check_session();
		}
	public function index()
	{
		$this->load_page_view('letter_details');	

	}
	//get letter details
	function get_letter_list(){	
	     
		$data['data'] = $this->letter_model->letter_details();
		//output to json format
		echo json_encode($data); 
	  
	}
	//get letter details
	
	//start add letter details
	function add_letter(){
		
		$this->load_page_view('add_letter');	
	}
	//end add letter details
	
	//start add letter validation
	function validation(){
	
					
		$this->form_validation->set_rules('letter_name', 'Name','required|is_unique[letter_template.Letter_name]');
		$this->form_validation->set_rules('letter_category', 'Category','required');
		$this->form_validation->set_rules('letter_sort', 'Sort','required');
		$this->form_validation->set_rules('description', 'Description','required');
		if($this->form_validation->run() == FALSE){				
			$error= array();
			$error = $this->form_validation->error_array();			
			echo json_encode(array("error"=>$error));
		}
		else{				
			
			if($this->letter_model->add_letter()){					
				echo json_encode(array("status"=>"Letter Details Added Succesfully"));
			}
		}
	
	}
	//end letter validation	
	//Start Edit letter deatils	
	function edit_letter(){
						
		$data['get_letter_details'] = $this->letter_model->get_letter_details($this->input->post('letter_id'));		
		
		if(!$this->input->post('letter_id')){
			$this->load_page_view('letter_details');
		}
		else{
			
			$this->load_page_view('edit_letter', $data);
		}
		
	}
	//End edit letter details
	//start edit validation 
	function edit_validation(){
				
		$this->form_validation->set_rules('letter_name', 'Name','required');
		$this->form_validation->set_rules('letter_category', 'Category','required');
		$this->form_validation->set_rules('letter_sort', 'Sort','required');
		$this->form_validation->set_rules('description', 'Description','required');
	
		if($this->form_validation->run() == FALSE){
			$error= array();
			$error = $this->form_validation->error_array();	
			echo json_encode(array("error"=>$error));	
		}
		else{
	
			if($query = $this->letter_model->edit_letter($this->input->post('letter_id'))){				
				echo json_encode(array("status"=>"Letter details Edited Successfully!"));					
			}
		}
	
	}		
	//end edit validation
	//view letter
	function view_letter(){
			
		$data['view_letter'] = $this->letter_model->get_letter_details($this->input->post('letter_id'));	
		if(!$this->input->post('letter_id')){
			$this->load_page_view('letter_details');
		}
		else{			
			$this->load_page_view('view_letter', $data);
			
		}
		
		
	}
	//view letter
	// Print letter
	function print_letter(){
	
		$data['print_letter'] = $this->letter_model->get_letter_details($this->input->post('letter_id'));
		$this->load->view('print_letter', $data);
		
	}
	// Print letter
	//delete customer
	function delete_letter(){
	
		if($query = $this->letter_model->delete_letter($this->input->post('letterId'))){
			echo json_encode(array("status"=>"Letter details deleted Successfully!"));
		}
	
	}
	//delete letter
	
	
	public function create_pdf() {
	  
	//get Letter details
	$letter_data = $this->letter_model->get_letter_details($this->input->post('letter_id'));
	$data = $letter_data->result();	    
  
    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);   
	
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Velan Info Serices');
    $pdf->SetTitle($data[0]->Letter_name);
    $pdf->SetSubject($data[0]->Letter_name);
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide'); 	
	//$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);	
   
	// set default header data
	 $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);	  
	
	// set header and footer fonts
	   $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	   $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	  
    // set default monospaced font
      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  
    // set margins
	   $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	   $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	   $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);    
 
    // set auto page breaks
     $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 
     //$pdf->Image(base_url().'assest/images/ccc.jpg');
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 
  
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
    // ---------------------------------------------------------  
	
    // Add a page
	$pdf->AddPage();
	$html = $data[0]->Letter_description; 
    //output the HTML content
    $pdf->writeHTML($html, true, 0, true, 0);

    // Close and output PDF document
    // This method has several options, check the source code documentation for more information.
    $pdf->Output('Velan_letter.pdf', 'I');   
    // END OF PDF FILE
    //============================================================+
    
    }
	
	function fpdf_genrate(){		
		//get Letter details
	$letter_data = $this->letter_model->get_letter_details($this->input->post('letter_id'));
	$data = $letter_data->result();	
		$this->load->library('fpdf_gen');		
		//$this->fpdf->SetFont('Arial','B',16);
		//$this->fpdf->Cell(40,10,'Hello World!');
		$pdf->SetFont('Arial');
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetXY(58, 45);
		$pdf->Write(0,$data[0]->Letter_description);
		$pdf->Image(base_url().'assets/images/ccc.jpg',30,120,25);
		echo $this->fpdf->Output('hello_world.pdf','D');
		
	}
}
