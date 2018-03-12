
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Letter Print </title>
	   <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	 <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>assets/css/custom.min.css" rel="stylesheet">
	</head>
  <body onload="print_letter();">
<script>
function print_letter(){
	window.print();
}
</script>
<!-- page print -->
	 <!-- page content -->
        <div class="right_col" role="main">
			 <div class="row">
              <div class="col-md-12">
                <div class="x_panel">                  
                  <div class="x_content">		  	
					<?php foreach($view_debtors->result() as $view){ ?>
					<div class="row" style="width:100%" >
						<div class="col-sm-10" style="width:80%">
						<strong class="green"><?php echo  $view->deptors_firstname.' '.$view->deptors_lastname; ?></strong><br>
						  A/c Type : <strong class="red"><?php echo $view->Ac_type_name ?></strong><br>
						Account # : <strong class="red"><?php echo $view->deptors_ref_no ?></strong><br>
						 Client Name : <strong class="red"><?php echo $view->Cus_firstname.' '.$view->Cus_lastname ?></strong><br>
						
						</div>
						<!-- /.col -->
						<div class="col-sm-2 text-right" style="width:20%">                       
						  <address>		  
							 <?php echo $view->Address_Street; ?>
							  <br><?php echo $view->Address_city.'-'.$view->Address_zipcode; ?>
							  <br><?php echo $view->Address_state; ?>
							  <br><?php echo $view->Address_country; ?>
							  <br><?php echo $view->Address_email ?>
						  </address>
						</div>
					</div>
					<?php }foreach($print_letter->result() as $view){ ?>
                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h1>
							<?php echo  $view->Letter_name; ?>							
						  </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-12 invoice-col">
                         <strong>Category :</strong> <?php echo $view->Letter_category; ?><br>
                        </div>
                        <!-- /.col -->
                       <div class="col-sm-12 invoice-col">
					   <br>
						 <?php echo $view->Letter_description; ?><br>
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
 <!-- page print -->
</body>
</html>
		