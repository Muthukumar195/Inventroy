<script>
$(document).ready(function(){	
	
	$("#cancel").click(function(){	
	 window.location.href="<?php echo site_url('customer') ?>";
	});
});
</script>
        <!-- page content -->
        <div class="right_col" role="main">
			 <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View Customer Details</h2>
                    <ul class="nav navbar-right panel_toolbox">
					<button class="btn btn-primary" id="cancel" type="button">Back</button>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                     
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
					<?php foreach($view_customer->result() as $view){ ?>
                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h1>
							  <i class="fa fa-globe"></i> <?php echo  $view->Cus_firstname.' '.$view->Cus_lastname; ?>
							  <small class="pull-right">Date: <?php echo date('d/m/Y', strtotime($view->Cus_create_dt)); ?></small>
						  </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                         <strong>Code :</strong> <?php echo $view->Cus_code ?><br>
						 <strong>Company :</strong> <?php echo $view->Cus_company ?><br>
						 <strong>Plantype :</strong> <?php echo $view->Cus_plan_type ?><br>
						 <strong>Description :</strong> <?php echo $view->Cus_plan_desc ?><br>
					     <strong>Employee :</strong> <?php echo $view->Cus_employee_id ?><br>
						 <strong>Notes :</strong> <?php echo $view->Cus_notes ?><br>
							 
                         
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">                       
                          <address>	
								<strong>Address</strong>						  
							  <br><?php echo $view->Address_Street; ?>
							  <br><?php echo $view->Address_city.'-'.$view->Address_zipcode; ?>
							  <br><?php echo $view->Address_state; ?>
							  <br><?php echo $view->Address_country; ?>
						  </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          <strong>Contact</strong>						  
							  <br><?php echo $view->Address_email ?>
							  <br><?php echo $view->Address_phone1 ?>
							  <br><?php echo $view->Address_phone2 ?>
							  <br><?php echo $view->Address_phone3 ?>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->


                    </section>
					<?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
       
        </div>
        <!-- /page content -->
		