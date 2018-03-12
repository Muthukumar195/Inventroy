<script>
$(document).ready(function(){
	$("#btnsave").click(function(){	
	   $.ajax({
			url : "<?php echo site_url('user/validation')?>",
			type: "POST",
			data: $('#form').serialize(),
			dataType: "JSON",
			success: function(data)
			{
				if(data.status) //if success close modal and reload ajax table
				{   
				    notify(data.status);		
					$("#form")[0].reset();
					ajax.reload();
				}
				else
				{
					$(".error_msg").html('');
					$.each(data.error,function(key,value){
						$("#"+key+"_error").text(value);
					});
				}			

			}
			
		});
	});
	
	$(".cancel").click(function(){	
	 window.location.href="<?php echo site_url('user') ?>";
	});
	
});

</script>
        <!-- page content -->
        <div class="right_col" role="main">
         
            
                       <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add User</h2>
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
					  <form action="#" id="form" class="form-horizontal" method="post">					
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">                          
						  <?php 
							$data1 = array(
							'name' => 'firstname',
							'id'   => 'firstname',
							'class' => 'form-control',
							'placeholder' => 'Enter a Firstname',
							);
							echo form_input($data1);
						  ?>
						  <span id="firstname_error" class="error_msg"></span>
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
							'class' => 'form-control',
							'placeholder' => 'Enter a Lastname',
							);
							echo form_input($data2);
						  ?>
						  <span id="lastname_error" class="error_msg"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Username <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$data3 = array(
							'name' => 'username',
							'id'   => 'username',
							'class' => 'form-control',
							'placeholder' => 'Enter a username',
							);
							echo form_input($data3);
						  ?>
						  <span id="username_error" class="error_msg"></span>
                        </div>
                      </div>
					   <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Password <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$data4 = array(
							'name' => 'password',
							'id'   => 'password',
							'class' => 'form-control',
							'placeholder' => 'Enter a password',
							);
							echo form_password($data4);
						  ?>
						  <span id="password_error" class="error_msg"></span>
                        </div>
                      </div>
					   <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$data4 = array(
							'name' => 'con_password',
							'id'   => 'con_password',
							'class' => 'form-control',
							'placeholder' => 'Enter a confirm password',
							);
							echo form_password($data4);
						  ?>
						  <span id="con_password_error" class="error_msg"></span>
                        </div>
                      </div>
						<div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Type <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
						  $user_type[''] = 'Select type';
						  foreach($user_types->result() as $type){
							  $user_type[$type->User_type_id] = $type->User_type;
						  }
						  echo form_dropdown('user_type', $user_type, '', 'class="form-control" id="user_type"');?>
						  <span id="user_type_error" class="error_msg"></span>
                        </div>
                      </div>					  
					  <div class="form-group" style="display: none;" id="as_cus">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Associated customer</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
						  $customer_ass[''] = 'Select Customer';
						  foreach($customer_list->result() as $cus){
							  $customer_ass[$cus->Cus_id] = $cus->Cus_firstname.' '.$cus->Cus_lastname;
						  }
						  echo form_dropdown('customer_ass', $customer_ass, '', 'class="form-control"');?>
						  
                        </div>
                      </div>
					<div class="form-group" style="display: none;" id="as_emp">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Assign customer</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$customer_asn[''] = '';
							 foreach($customer_list->result() as $cus){
							  $customer_asn[$cus->Cus_id] = $cus->Cus_firstname.' '.$cus->Cus_lastname;
						  }
						  echo form_dropdown('customer_asn[]', $customer_asn, '', 'class="form-control" multiple');?>
                        </div>
                      </div>					  
					   <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
						  $status[''] = 'Select status';
						  foreach($status_details->result() as $sts){
							  $status[$sts->Status_id] = $sts->Status_adrev;
						  }
						  echo form_dropdown('status', $status, '', 'class="form-control"');?>
						  <span id="status_error" class="error_msg"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-primary cancel" type="button">Cancel</button>
						  <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="button" id="btnsave" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

        </div>
        <!-- /page content -->
		 <!-- jQuery -->
    

<script>
$(document).ready(function(){
	$("#user_type").change(function(){
		var type = $("#user_type").val();	
		if(type==1){
			$("#as_cus").hide();
			$("#as_emp").hide();
		}
		else if(type==2){
			$("#as_cus").show();
			$("#as_emp").hide();
		}
		else if(type==3){
			$("#as_emp").show();
			$("#as_cus").hide();
		}
		
	});
  
});
</script>