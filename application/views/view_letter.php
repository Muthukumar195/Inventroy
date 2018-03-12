<script>
$(document).ready(function(){
	$("#cancel").click(function(){	
	 window.location.href="<?php echo site_url('letter') ?>";
	});
});
function fnltrEdit(){
		
		document.frmLetterList.action="<?php echo base_url() ?>index.php/letter/edit_letter";		
		document.frmLetterList.submit();			
}
function LetterPdf(){		
		document.frmLetterList.action="<?php echo base_url() ?>index.php/letter/create_pdf";	
		document.frmLetterList.setAttribute("target", "_blank");
		document.frmLetterList.submit();	
		
}
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}

</script>

        <!-- page content -->
        <div class="right_col" role="main">
			 <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View Letter Template</h2>
                    <ul class="nav navbar-right panel_toolbox">
					<button class="btn btn-primary" id="cancel" type="button">Back</button>
					<button class="btn btn-info" id="Edit" type="button" onclick="fnltrEdit()">Edit</button>
					<button class="btn btn-default" onclick="printDiv('printableArea')" type="button"><i class="fa fa-print"></i> Print</button>
					<button class="btn btn-warning" id="Pdf" type="button" onclick="LetterPdf()">PDF</button>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" id="printableArea">
							  
					<?php foreach($view_letter->result() as $view){ ?>
					<form name="frmLetterList" id="frmLetterList" method="post" target="_self">
					 <input type="hidden" name="letter_id" id="letter_id" value="<?php echo $view->Letter_id; ?>"">
				  </form>
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
					   <span style="  background-image: url('<?php echo base_url(); ?>assets/images/ccc.jpg');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center; height:500px; "></span>
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
		