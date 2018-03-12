<script>
$(document).ready(function(){
	$("#btnsave").click(function(){	
	   $.ajax({
			url : "<?php echo site_url('project_main/edit_profile_validation')?>",
			type: "POST",
			data: $('#form').serialize(),
			dataType: "JSON",
			success: function(data)
			{
				if(data.status) //if success close modal and reload ajax table
				{
					notify(data.status);
				}
				else
				{	
					
					 $('#errmsg').show();			
					$("#errmsg").html(data.error);
					setTimeout(function() {
					 $('#errmsg').hide();
					}, 2000 );
				
				}			

			}
			
		});
	});
	
	$(".cancel").click(function(){	
	 window.location.href="<?php echo site_url('project_main/dashboard') ?>";
	});
});
</script>
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Profile</h2>
                    <ul class="nav navbar-right panel_toolbox">
					<button class="btn btn-primary cancel" type="button">Back</button>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                     
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
					<br />
					
					<span id="errmsg" style="color:red; display:none;"></span>
					<div id="alert" class="alert alert-success alert-dismissible fade in" role="alert" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong id="susmsg"></strong>
                  </div>						
					<form  id="form" class="form-horizontal" method="post">
					<?php foreach($profile_details->result() as $user){ ?>					
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">                          
						  <?php 
							$data1 = array(
							'name' => 'firstname',
							'id'   => 'firstname',
							'value' => $user->User_firstname,
							'class' => 'form-control',
							'placeholder' => 'Enter a Firstname',
							);
							echo form_input($data1);
						  ?>
						  <input type="hidden" name="user_id" value="<?php echo $user->User_id; ?>">
						  
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$data2 = array(
							'name' => 'lastname',
							'id'   => 'lastname',
							'value' => $user->User_lastname,
							'class' => 'form-control',
							'placeholder' => 'Enter a Lastname',
							);
							echo form_input($data2);
						  ?>
                        </div>
                      </div>
					 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Username <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$data3 = array(
							'name' => 'username',
							'id'   => 'username',
							'value' => $user->User_username,
							'class' => 'form-control',
							'placeholder' => 'Enter a Username',
							);
							echo form_input($data3);
						  ?>
                        </div>
                      </div>					  
						 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Old password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$data4 = array(
							'name' => 'old_password',
							'id'   => 'old_password',
							'class' => 'form-control',
							'placeholder' => 'Enter a Old password',
							);
							echo form_password($data4);
						  ?>
                        </div>
                      </div>	
					   <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">New password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$data5 = array(
							'name' => 'new_password',
							'id'   => 'new_password',
							'class' => 'form-control',
							'placeholder' => 'Enter a New password',
							);
							echo form_password($data5);
						  ?>
                        </div>
                      </div>
						<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Confirm password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$data6 = array(
							'name' => 'con_password',
							'id'   => 'con_password',							
							'class' => 'form-control',
							'placeholder' => 'Enter a Confirm password',
							);
							echo form_password($data6);
						  ?>
                        </div>
                      </div>					  
						
                     <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                         <button class="btn btn-primary cancel" type="button">Cancel</button>
						  <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="button" id="btnsave" class="btn btn-success">Submit</button>
                        </div>
                      </div>
					<?php } ?>
                    </form>
                  </div>
                </div>
              </div>
            </div>

        </div>
        <!-- /page content -->

