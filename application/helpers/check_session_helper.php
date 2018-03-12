<?php

	function check_session() {
	  //get main CodeIgniter object
      $ci =& get_instance();
	  $logged_in = $ci->session->userdata('logged_in');
	  $login_id = $ci->session->userdata('login_id');
	  if(($logged_in!=TRUE)&&($login_id=="")) {
		 $ci->session->set_flashdata('failer_msg', 'Login Required');
	     return redirect(base_url());
	  } 
	
	} 
 


