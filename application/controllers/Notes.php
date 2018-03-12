<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Notes extends MY_Controller {
	  
	 public function __construct(){
		 
		 parent::__construct();		
		 $this->load->model('notes_model');	
		 $this->load->library('form_validation');
		 $this->load->helper('check_session');	
		 check_session();
		}
	
	//get notes details		
	function get_notes_list(){		
	     
			$data['data'] = $this->notes_model->get_notes_list($this->input->get('deb_id'));
			//output to json format
			echo json_encode($data); 	
	  
	}
	//get notes details
		
	//start add notes validation
	function validation(){
			
		if(($this->input->post('notes_memo')=="")&&($_FILES['deb_file']['name']=="")){
			$error= array();
			$error[] = 'Notes Memo or Attachment file';			
			echo json_encode(array("error"=>$error));
		}			
		else{
			$deb_id = $this->input->post('debtors_id');
			if($this->input->post('notes_memo')!=""){
				$data = array(
				'Notes_debtors_id' => $deb_id,
				'Notes_memo' => $this->input->post('notes_memo'),
				'Notes_user_id' => $this->session->userdata('login_id')
				);
				$this->notes_model->add_notes($data);
			}	
			if($_FILES['deb_file']['name']!=""){
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
				$final_file_name = $this->notes_model->upload_file($file_ext,$deb_id); 			  
				rename($file, $file_path . $final_file_name); 
				}
			}
			echo json_encode(array("status"=>"Notes Details Added Succesfully"));		 
		}
	}
	//end phone validation
}
