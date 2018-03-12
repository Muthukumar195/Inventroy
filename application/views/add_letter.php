<script>
$(document).ready(function(){
	$("#btnsave").click(function(){	
	   $.ajax({
			url : "<?php echo site_url('letter/validation')?>",
			type: "POST",
			data: $('#form').serialize(),
			dataType: "JSON",
			success: function(data)
			{
				if(data.status) //if success close modal and reload ajax table
				{	
					notify(data.status);			
					$("#form")[0].reset();
					CKEDITOR.instances.editor1.setData("")
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
	 window.location.href="<?php echo site_url('letter') ?>";
	});
	
});

</script>
        <!-- page content -->
        <div class="right_col" role="main">
             <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Letter Template</h2>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">                          
						  <?php 
							$data1 = array(
							'name' => 'letter_name',
							'id'   => 'letter_name',
							'class' => 'form-control',
							'placeholder' => 'Enter a name',
							);
							echo form_input($data1);
						  ?>
						   <span id="letter_name_error" class="error_msg"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Category <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$letter_cat = array(''=>'Select Category','Customer' => 'Customer', 'Debtors' => 'Debtors');
							echo form_dropdown('letter_category', $letter_cat,'','class = "form-control"');
						  ?>
						   <span id="letter_category_error" class="error_msg"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Sort</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							$letter_sort = array();
							$letter_sort[] = 'Select sort';
							for($i=1;$i<=50;$i++){
							 $letter_sort[] = $i;
							}						 
							echo form_dropdown('letter_sort', $letter_sort,'','class = "form-control"');
						  ?>

                        </div>
                      </div>
					  
					 <!-- test area -->
						<div class="form-group">
						    <div class="col-md-12">												
							  <textarea name="description" id="editor1" rows="10" cols="80"></textarea>
							  
							</div>
						</div>
						<!-- test area -->
						
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-primary cancel" type="button">Cancel</button>
						  <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="button" id="btnsave" class="btn btn-success" onclick="save_work();">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

        </div>
        <!-- /page content -->
 <script>
	// Replace the <textarea id="editor1"> with a CKEditor
	// instance, using default configuration.
	CKEDITOR.replace( 'editor1' );
	//getSnapshot() retrieves the "raw" HTML, without tabs, linebreaks etc
	var html=CKEDITOR.instances.editor1.getSnapshot();	

	function save_work(){
	var html=CKEDITOR.instances.editor1.getSnapshot();
		//alert(html);
		$("#editor1").val(html);
	}
</script>
	
	
 
   