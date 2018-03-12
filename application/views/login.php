<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Velan Info Service</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url(); ?>vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>assets/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
   
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
				<strong style="color: red;"><?php echo validation_errors(); ?></strong>
				<strong style="color: green;"><?php if($success_msg = $this->session->flashdata('success_msg')){ echo $success_msg; } ?></strong>
				<strong style="color:red;"><?php if($failer_msg = $this->session->flashdata('failer_msg')){ echo $failer_msg; } ?></strong>				
             <?php echo form_open('project_main/login', array('name'=> 'login')); ?>
              <h1>Login Form</h1>
              <div>               
				<?php
				$log_user = array(
				'name' => 'username',
				'id' => 'username',
				'class' => 'form-control',
				'placeholder' => 'Enter username'
				);
				echo form_input($log_user);
				?>
              </div>
              <div>
                <?php
				$log_pass = array(
				'name' => 'password',
				'id' => 'password',
				'class' => 'form-control',
				'placeholder' => 'Enter Password'
				);
				echo form_password($log_pass);
				?>
              </div>
              <div>
                <button type="submit" class="btn btn-default">Log in</button>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
               
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Velaninfo</h1>                
                </div>
              </div>
            </form>
          </section>
        </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
