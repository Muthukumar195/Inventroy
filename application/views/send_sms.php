<script>
$(document).ready(function(){
	$("#btnsave").click(function(){	
	   $.ajax({
			url : "<?php echo site_url('twilio_control/send_sms')?>",
			type: "POST",
			data: $('#sms').serialize(),
			dataType: "JSON",
			success: function(data)
			{
				if(data.status) //if success close modal and reload ajax table
				{   
				    notify(data.status);		
					$("#sms")[0].reset();
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
	
});

</script>
        <!-- page content -->
        <div class="right_col" role="main">
         
            
                       <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Send SMS</h2>
                    <ul class="nav navbar-right panel_toolbox">			
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                     
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
			     <span id="sms_error_error" class="error_msg"></span>
                  </div>
					  <form action="#" id="sms" class="form-horizontal" method="post">					
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Phone Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">                          
						  <?php 
							$data1 = array(
							'name' => 'phone',
							'id'   => 'phone',
							'class' => 'form-control',
							'placeholder' => 'Enter a Phone Number',
							);
							echo form_input($data1);
						  ?>
						  <span id="phone_error" class="error_msg"></span>
                        </div>
                      </div>
                   
					   <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Send SMS <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$data4 = array(
							'name' => 'sms',
							'id'   => 'sms',
							'class' => 'form-control',
							'rows'        => '5',
							'cols'        => '10',	
							'placeholder' => 'Type your Sms',
							);
							echo form_textarea($data4);
						  ?>
						  <span id="sms_error" class="error_msg"></span>
                        </div>
                      </div>					
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">                         
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
