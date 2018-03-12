
<script>
$(document).ready(function(){	
	$("#btnsave").click(function(){	
	   $.ajax({
			url : "<?php echo site_url('customer/validation')?>",
			type: "POST",
			data: $('#form').serialize(),
			dataType: "JSON",
			success: function(data)
			{
				if(data.status) //if success close modal and reload ajax table
				{	notify(data.status);			
					$("#form")[0].reset();
					ajax.reload();
				}
				else
				{
					$(".error_msg").html('');					
					 $.each(data.error,function(key,value){
						 $("#"+key+"_error").text(value);
					 })
					// setTimeout(function() {
					 // $('#errmsg').hide();
					// }, 2000 );
				}			

			}
			
		});
	});
	
	$(".cancel").click(function(){	
	 window.location.href="<?php echo site_url('customer') ?>";
	});
	
});

</script>
        <!-- page content -->
        <div class="right_col" role="main">
         
            
             <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Customer</h2>
                    <ul class="nav navbar-right panel_toolbox">		
						<button class="btn btn-primary cancel"  type="button">Back</button>					
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                     
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
					<br/>
					<span id="errmsg" style="color:red; display:none;"></span>
					<div id="alert" class="alert alert-success alert-dismissible fade in" role="alert" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong id="susmsg"></strong>
                  </div>						
					  <form action="#" id="form" class="form-horizontal" method="post">
					  <div class="col-md-6 col-sm-6 col-xs-12">
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
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Customer Code <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$data3 = array(
							'name' => 'code',
							'id'   => 'code',
							'class' => 'form-control',
							'placeholder' => 'Enter a code',
							);
							echo form_input($data3);
						  ?>
						   <span id="code_error" class="error_msg"></span>
                        </div>
                      </div>
					   <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Company <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$data4 = array(
							'name' => 'company',
							'id'   => 'company',
							'class' => 'form-control',
							'placeholder' => 'Enter a company',
							);
							echo form_input($data4);
						  ?>
						   <span id="company_error" class="error_msg"></span>
                        </div>
                      </div>
					   <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Street <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$data5 = array(
							'name' => 'street',
							'id'   => 'street',
							'class' => 'form-control',
							'placeholder' => 'Enter a street',
							);
							echo form_input($data5);
						  ?>
						   <span id="street_error" class="error_msg"></span>
                        </div>
                      </div>
					   <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">City <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$data6 = array(
							'name' => 'city',
							'id'   => 'city',
							'class' => 'form-control',
							'placeholder' => 'Enter a city',
							);
							echo form_input($data6);
						  ?>
						   <span id="city_error" class="error_msg"></span>
                        </div>
                      </div>
					
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Zipcode <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$data6 = array(
							'name' => 'zipcode',
							'id'   => 'zipcode',
							'class' => 'form-control',
							'onkeyup'     => 'checkInt(this)',
							'placeholder' => 'Enter a zipcode',
							);
							echo form_input($data6);
						  ?>
						   <span id="zipcode_error" class="error_msg"></span>
                        </div>
                      </div>
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">State <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<?php 
							$data6 = array(
							'name' => 'state',
							'id'   => 'state',
							'class' => 'form-control',
							'placeholder' => 'Enter a state',
							);
							echo form_input($data6);
						  ?>
						   <span id="state_error" class="error_msg"></span>
                        </div>
                      </div>
					 <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Country <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        
						  <?php 
						  echo form_dropdown('country','','','id="country" class="form-control"') ?>
						  <span id="country_error" class="error_msg"></span>
                        </div>
                      </div>
					 
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span> </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$data6 = array(
							'name' => 'email',
							'id'   => 'email',
							'class' => 'form-control',
							'placeholder' => 'Enter a email',
							);
							echo form_input($data6);
						  ?>
						   <span id="email_error" class="error_msg"></span>
                        </div>
                      </div>
					   </div>
					  <div class="col-md-6 col-sm-6 col-xs-12">
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">phone1 <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$data6 = array(
							'name' => 'phone1',
							'id'   => 'phone1',							
							'onkeyup'     => 'checkInt(this)',
							'class' => 'form-control',
							'placeholder' => 'Enter a phone1',
							);
							echo form_input($data6);
						  ?>
						   <span id="phone1_error" class="error_msg"></span>
                        </div>
                      </div>
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">phone2</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$data6 = array(
							'name' => 'phone2',
							'id'   => 'phone2',
							'onkeyup'     => 'checkInt(this)',
							'class' => 'form-control',
							'placeholder' => 'Enter a phone2',
							);
							echo form_input($data6);
						  ?>
						
                        </div>
                      </div>
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phone3</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$data6 = array(
							'name' => 'phone3',
							'id'   => 'phone3',
							'onkeyup'     => 'checkInt(this)',
							'class' => 'form-control',
							'placeholder' => 'Enter a phone3',
							);
							echo form_input($data6);
						  ?>
						
                        </div>
                      </div>
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Plan Type <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$data6 = array(
							'name' => 'plan_type',
							'id'   => 'plan_type',
							'class' => 'form-control',
							'placeholder' => 'Enter a plan type',
							);
							echo form_input($data6);
						  ?>
						   <span id="plan_type_error" class="error_msg"></span>
                        </div>
                      </div>
					   
					   <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Plan Description </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$data6 = array(
							'name' => 'desc',
							'id'   => 'desc',
							'class' => 'form-control',
							'placeholder' => 'Enter a description',
							'rows'        => '5',
							'cols'        => '10',
							);
							echo form_textarea($data6);
						  ?>
						
                        </div>
                      </div>
					   <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Notes</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$data6 = array(
							'name' => 'notes',
							'id'   => 'notes',
							'class' => 'form-control',
							'placeholder' => 'Enter a notes',
							'rows'        => '5',
							'cols'        => '10',
							);
							echo form_textarea($data6);
						  ?>
						 
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
						  echo form_dropdown('status', $status, '', 'class="form-control" id="status"');?>
						   <span id="status_error" class="error_msg"></span>
                        </div>
                      </div>
                      </div>
                   
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-primary cancel" type="button">Cancel</button>
						  <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="button"  id="btnsave" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

        </div>
        <!-- /page content -->
<script language="javascript">

      populateCountries("country");
 </script>
 <?php //require_once('validation/customer.php'); ?>