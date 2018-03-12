<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Velan info</title>
	<?php $url = $this->uri->segment(2); ?>
    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url(); ?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">	
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>assets/css/custom.min.css" rel="stylesheet">	
	 <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">	
	<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url() ?>assets/countries.js"></script>
	<?php if($url=="edit_letter"||$url=="add_letter"){ ?>
	<script src="<?php echo base_url() ?>assets/ckeditor/ckeditor.js"></script>
	<script src="<?php echo base_url() ?>assets/ckeditor/sample.js"></script>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/ckeditor/neo.css">
	<?php } ?>
	 <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url(); ?>vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
	 <!-- PNotify-->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/pnotify/pnotify.custom.min.js"></script>
	
    <link href="<?php echo base_url() ?>assets/pnotify/pnotify.custom.min.css" rel="stylesheet"> 
	 <!-- custom css-->
	 <link href="<?php echo base_url() ?>assets/velan_custom.css" rel="stylesheet">
	 <style>
	

	 </style>
  </head>
<?php  
 if($url=="edit_user"){
	 echo '<body class="nav-md" onload="load_page();">';
 }else{
	  echo '<body class="nav-md">';
 }
//session usertype and userlevel will 
$user_type = $this->session->userdata('user_type');
$user_level = $this->session->userdata('user_type_level');
$cus_id = $this->session->userdata('cus_id');
 ?>
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-paw"></i> <span>Velan Info</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo base_url(); ?>assets/images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php 
				echo $firstname = $this->session->userdata('firstname'); 
				echo $lastname = $this->session->userdata('lastname'); 
				?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
			 <?php 
			 //Page active action
			 $pagename = $this->uri->segment(1); ?>
              <div class="menu_section">
                <h3>General </h3>
				
                <ul class="nav side-menu">
			  
				<?php if(($user_type=="Admin")||($user_type=="Employee")){ ?>
                  <li <?php if($pagename=="dashboard"){ ?> class="active" <?php } ?>><?php echo anchor('project_main/dashboard','<i class="fa fa-home"></i>Dashboard'); ?></li>
                  <li <?php if(($pagename=="customer"||$pagename=="letter")){ ?> class="active" <?php } ?>><a><i class="fa fa-group"></i> Customers <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" <?php if(($pagename=="customer")||$pagename=="letter"){ ?> style="display: block;" <?php } ?>>
                      <li <?php if(($pagename=="customer")){ ?>  class="current-page" <?php } ?>><?php echo anchor('customer','Customers Details'); ?></li>
					  <li <?php if(($pagename=="letter")){ ?>  class="current-page" <?php } ?>><?php echo anchor('letter','Letter Details'); ?></li>
                                       
                    </ul>
                  </li>                 
				<?php } ?>
				<?php if(($user_type=="Customer")){ ?>
				 <li <?php if(($pagename=="customer")){ ?> class="active" <?php } ?>><a><i class="fa fa-group"></i> Debtors <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" <?php if(($pagename=="customer")){ ?> style="display: block;" <?php } ?>>
                      <li <?php if(($pagename=="customer")){ ?>  class="current-page" <?php } ?>><?php echo anchor('customer/debtors_details','Debtors Details'); ?></li>
                      <li><?php echo anchor('customer/add_debtors','Add Debtors'); ?></li>   
					 
                    </ul>
                  </li>
				<?php } ?>
				<?php if(($user_type=="Admin")){ ?>
				 <li <?php if(($pagename=="employee")){ ?> class="active" <?php } ?>><a><i class="fa fa-group"></i> Employee <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" <?php if(($pagename=="employee")){ ?> style="display: block;" <?php } ?>>
                      <li <?php if(($pagename=="employee")){ ?>  class="current-page" <?php } ?>><?php echo anchor('employee','Employee Details'); ?></li> 
                    </ul>
                  </li>
				<?php } ?>
				 <?php if(($user_type=="Admin")){ ?>
				<li <?php if(($pagename=="user")){ ?> class="active" <?php } ?>><a><i class="fa fa-male"></i> Users <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" <?php if(($pagename=="user")){ ?> style="display: block;" <?php } ?>>
                      <li <?php if(($pagename=="user")){ ?> class="current-page" <?php } ?>><?php echo anchor('user','Users Details'); ?></li>
                      <li><?php echo anchor('user/add_user','Add User'); ?></li>                     
                    </ul>
                  </li> 
			<?php } ?>
			
				<li><a><i class="fa fa-male"></i> SMS <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li ><?php echo anchor('twilio_control','Send SMS'); ?></li> 					
                    </ul>
                  </li> 
		
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url(); ?>assets/images/img.jpg" alt=""><?php echo $firstname.$lastname; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><?php echo anchor('project_main/edit_profile','Edit Profile'); ?></li>
					<?php if($user_type=="Customer"){ ?>
					<li><?php echo anchor('customer/edit_customer','Edit Customer'); ?></li>
					<?php } ?>
                    <li><?php echo anchor('project_main/logout','<i class="fa fa-sign-out pull-right"></i>Log out', ''); ?></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
