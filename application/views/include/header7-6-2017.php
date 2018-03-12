<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Velan info</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url(); ?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url(); ?>vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url(); ?>vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url(); ?>vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>assets/css/custom.min.css" rel="stylesheet">
	 <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
	
<script src="http://localhost/training/vendors/jquery/dist/jquery.min.js"></script>
  </head>

  <body class="nav-md" onload="load_page();">
  
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Velan Info</span></a>
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
                  <li <?php if($pagename=="dashboard"){ ?> class="active" <?php } ?>><a><i class="fa fa-home"></i>Dashboard</a></li>
                  <li <?php if(($pagename=="customer")){ ?> class="active" <?php } ?>><a><i class="fa fa-group"></i> Customers <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" <?php if(($pagename=="customer")){ ?> style="display: block;" <?php } ?>>
                      <li <?php if(($pagename=="customer")){ ?>  class="current-page" <?php } ?>><?php echo anchor('customer','Customers Details'); ?></li>
                      <li><?php echo anchor('customer/add_customer','Add Customer'); ?></li>                     
                    </ul>
                  </li>  
				<li <?php if(($pagename=="user")){ ?> class="active" <?php } ?>><a><i class="fa fa-male"></i> Users <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" <?php if(($pagename=="user")){ ?> style="display: block;" <?php } ?>>
                      <li <?php if(($pagename=="user")){ ?> class="current-page" <?php } ?>><?php echo anchor('user','Users Details'); ?></li>
                      <li><?php echo anchor('user/add_user','Add User'); ?></li>                     
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
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><?php echo anchor('project_main/logout','Log out', '<i class="fa fa-sign-out pull-right"></i>'); ?></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
