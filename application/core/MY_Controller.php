<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    //protected $data = Array(); //protected variables goes here its declaration

    function __construct() {

        parent::__construct();     
    }
  
   //Start load page view
	public function load_page_view($view_page, $data=array()){
		//header
		$this->load->view('include/header.php');
		//page
		$this->load->view($view_page, $data);
		//footer
		$this->load->view('include/footer');
	}
	//end Load page view
}
