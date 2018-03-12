<script>
$(document).ready(function(){
	$("#btnsave").click(function(){	
	 var formData = new FormData($('#form')[0]);
	   $.ajax({
			url : "<?php echo site_url('customer/debtors_validation')?>",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
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
                    <h2>Add deptors</h2>
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
					<br />
					<span id="errmsg" style="color:red; display:none;"></span>
					<div id="alert" class="alert alert-success alert-dismissible fade in" role="alert" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong id="susmsg"></strong>
                  </div>
					<form  id="form" class="form-horizontal" method="post" enctype="multipart/form-data">	
					<!--div split-->
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
						<?php if($this->session->userdata('user_type')=="Customer"){ ?>
						 <input type="hidden" name="customer_id" value="<?php echo $this->session->userdata('cus_id'); ?>">
						<?php }else{ ?> 						
					   <input type="hidden" name="customer_id" value="<?php echo $this->input->post('cust_id'); ?>">
						<?php } ?>
					 
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
						  ?><span id="lastname_error" class="error_msg"></span>
                        </div>
                      </div>
					 
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Account Type <span class="required">*</span></label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <?php 
						  $ac_type[''] = 'Select Account Type';
						  foreach($account_types->result() as $ac){
							  $ac_type[$ac->Ac_type_id] = $ac->Ac_type_name;
						  }
						  echo form_dropdown('ac_type', $ac_type, '', 'class="form-control" id="ac_type"');?>
						  <span id="ac_type_error" class="error_msg"></span>
                        </div>
                      </div>
					   <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Ref No <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$data4 = array(
							'name' => 'ref_no',
							'id'   => 'ref_no',
							'class' => 'form-control',
							'placeholder' => 'Enter a Ref no',
							);
							echo form_input($data4);
						  ?>
						   <span id="ref_no_error" class="error_msg"></span>
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
							'onkeyup'     => 'checkInt(this)',
							'class' => 'form-control',
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
				</div>
				<!--div split-->
				<div class="col-md-6 col-sm-6 col-xs-12">
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span></label>
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
					   <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phone Type <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php 
							$phn_type = array(
							'' => 'Select Phone Type',
							'Work' => 'Work', 
							'Mobile' => 'Mobile',
							'Home' => 'Home',
							'Fax' => 'Fax',
							'Pager' => 'Pager',
							'Main' => 'Main',
							'Other' => 'Other',
							'SMS' => 'SMS',
							'Email' => 'Email',
							'Mobile' => 'Mobile',
							);
							echo form_dropdown('phone_type', $phn_type,'','class = "form-control" id="phone_type"');
						  ?>
						   <span id="phone_type_error" class="error_msg"></span>
                        </div>
                      </div>
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">phone Number <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$data6 = array(
							'name' => 'phone_no',
							'id'   => 'phone_no',
							'onkeyup'     => 'checkInt(this)',
							'class' => 'form-control',
							'placeholder' => 'Enter a Number',
							);
							echo form_input($data6);
						  ?>
						   <span id="phone_no_error" class="error_msg"></span>
                        </div>
                      </div>
					 
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Price <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$data6 = array(
							'name' => 'price',
							'id'   => 'price',
							'class' => 'form-control',
							'placeholder' => 'Enter a price',
							);
							echo form_input($data6);
						  ?>
						   <span id="price_error" class="error_msg"></span>
                        </div>
                      </div>
					   
					   <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Intrest fees <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$data6 = array(
							'name' => 'int_fees',
							'id'   => 'int_fees',
							'class' => 'form-control',
							'placeholder' => 'Enter a Intrest Fees',
							);
							echo form_input($data6);
						  ?>
						   <span id="int_fees_error" class="error_msg"></span>
                        </div>
                      </div>
					  
					   <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Last Services <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">                        
						   <input type="text" name="last_service" class="form-control has-feedback-left" id="single_cal2" aria-describedby="inputSuccess2Status2">
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                          <span id="inputSuccess2Status2" class="sr-only">(success)</span>
						   <span id="last_service_error" class="error_msg"></span>
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Attachment</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="file" name="deb_file">

                        </div>
                      </div>
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Notes</label>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                          <?php 
							$data6 = array(
							'name' => 'ser_notes',
							'id'   => 'ser_notes',
							'class' => 'form-control',
							'rows'        => '5',
							'cols'        => '10',	
							'placeholder' => 'Enter a Notes'							
							);
							echo form_textarea($data6);
						  ?>
						 
                        </div>
                      </div>
					   <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
						  $deb_status[''] = 'Select status';
						  foreach($debtor_status->result() as $deb){
							  $deb_status[$deb->debt_status_id] = $deb->debt_status_abrev;
						  }
						  echo form_dropdown('deb_status', $deb_status, '', 'class="form-control" id="deb_status"');?>
						   <span id="deb_status_error" class="error_msg"></span> 
                        </div>
                      </div>
					  </div>
					  <!--div split-->
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
<script language="javascript">
      populateCountries("country");
 </script>
