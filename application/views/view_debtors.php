<script>
var deb_id = "<?php echo $this->input->post('id'); ?>"
var phoneTable;
var notesTable;
var save_method; //for save method string
$(document).ready(function(){	
	$("#btnstatus").click(function(){		 
	   $.ajax({
			url : "<?php echo site_url('customer/debtors_status_update')?>",
			type: "POST",
			data: $('#status').serialize(),
			dataType: "JSON",
			success: function(data)
			{
				if(data.status) //if success close modal and reload ajax table
				{
					$("#status")[0].reset();
					notify(data.status);					
					location.reload();
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
	//phone number list
		phoneTable=$('#phonetable').DataTable( {
		"ajax": "<?php echo base_url() ?>index.php/phone/get_phone_list?deb_id="+deb_id,		
		//"stateSave"		: true,
		"order": [],
		"dom": '<"top">rt<"bottom"ip><"clear">',
		"columns": [
			 { "data": "Phone_type" },
			 { "data": "Phone_number" },
			 { "data": null },
             { "data": null }
		],
		"columnDefs": [	
	
			{
				"targets": [2], "data": null, 
				"defaultContent" :				
				'<button  class="btn btn-info btn-xs Edit"><i class="fa fa-pencil" title="Edit"></i></button>',
				"orderable": false 
				
			},
			{
				"targets": [3], "data": null, 
				"defaultContent" :				
				'<button  class="btn btn-danger btn-xs Delete"><i class="fa fa-trash-o" title="Delete"></i></button>',
				"orderable": false 
				
			}

		]
		
	} );
	$('#phonetable tbody').on('click','tr .Edit',function(event){		
		rdata=phoneTable.row( parentRow($(this)) ).data();		
		fncusEdit(this,rdata["Phone_id"]);
	
	});
	$('#phonetable tbody').on('click','tr .Delete',function(event){		
		rdata=phoneTable.row( parentRow($(this)) ).data();		
		fncusDelete(this,rdata["Phone_id"]);
	
	});
	//Edit phone details
	function fncusEdit(e,Id){		
		 save_method = 'update';
			$('#phone')[0].reset(); // reset form on modals
			//Ajax Load data from ajax
			$.ajax({
				url : "<?php echo site_url('phone/edit_phone')?>?PhoneId=" + Id,
				type: "GET",
				dataType: "JSON",
				success: function(data)
				{					
					$('[name="id"]').val(data.Phone_id);
					$('[name="debtors_id"]').val(data.Phone_debtor_id);
					$('[name="phone_type"]').val(data.Phone_type);
					$('[name="phone_no"]').val(data.Phone_number);
					$('[name="phone_sort"]').val(data.Phone_sort);					
					$('#phone_model').modal('show'); // show bootstrap modal when complete loaded
					$('.modal-title').text('Edit Phone Number'); // Set title to Bootstrap modal title

				}
			});
		}
//add phone
$("#add_phone").click(function(){
 //var home = "Home";
    save_method = 'add';
	$('#add_phone_details')[0].reset(); // reset form on modals 
	$('[name="debtors_id"]').val(deb_id); 	
    $('#add_phone_model').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Phone'); // Set Title to Bootstrap modal title
});
//save add 
	$("#btnaddphone").click(function(){			
		var url;
				
			url = "<?php echo site_url('phone/validation')?>";	
	   $.ajax({
			url : url,
			type: "POST",
			data: $('#add_phone_details').serialize(),
			dataType: "JSON",
			success: function(data)
			{
				if(data.status) //if success close modal and reload ajax table
				{	
					$('#add_phone_model').modal('hide');				
					notify(data.status);			
					$("#add_phone_details")[0].reset();				
					phoneTable.ajax.reload(null,false);
				}
				else
				{				
					 $('#errmsg1').show();			
					$("#errmsg1").html(data.error);
					setTimeout(function() {
					 $('#errmsg1').hide();
					}, 2000 );
				
				}			

			}
			
		});
	});
	//save edit phone data
	$("#btnphone").click(function(){			
		var url;
				
			url = "<?php echo site_url('phone/edit_validation')?>";	
	   $.ajax({
			url : url,
			type: "POST",
			data: $('#phone').serialize(),
			dataType: "JSON",
			success: function(data)
			{
				if(data.status) //if success close modal and reload ajax table
				{	
					$('#phone_model').modal('hide');				
					notify(data.status);			
					$("#phone")[0].reset();
					phoneTable.ajax.reload(null,false);
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
function fncusDelete(e,Id)
{ 
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('phone/delete_phone')?>?id="+Id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            { 
					notify(data.status);	
					phoneTable.ajax.reload(null,false);
            }          
        });

    }
}

	//start notes details 
	notesTable=$('#notestable').DataTable( {
		"ajax": "<?php echo site_url('notes/get_notes_list')?>?deb_id="+deb_id,		
		//"stateSave"		: true,		
		 "dom": '<"top">rt<"bottom"ip><"clear">',
		"order": [],
		"columns": [
			 { "data": null },
			 { "data": null },
			 { "data": null }
		],
		"columnDefs": [		  
			{
				"targets": [0], "data": null, 
				"className"	: "text-center",
				"render" : function (data, type, row) {
					  var date = new Date(data['Notes_create_dt']);
					return date.getMonth() + 1 + '/' + date.getDate() + '/' + date.getFullYear() + '-' + date.getHours() + ':'+ date.getMinutes();	
				}
			},
			{
				"targets": [1], "data": null, 
				"className"	: "text-center",
				"render" : function (data, type, row) {
				if(data['Notes_memo']=="Attachment"){
					return '<a href="<?php echo base_url('uploads/debtors/')?>'+data['Notes_debtors_id']+'/'+data['Notes_attachment']+'" download>Attachment <i class="fa fa-download" ></i></a>';
					}else{
					return data['Notes_memo'];
					}					
				}
				
			},
			{
				"targets": [2], "data": null, 
				"className"	: "text-center",
				"render" : function (data, type, row) {					
				return data['User_firstname']+data['User_lastname'];
			}
			}
		]
		
	} );
	//add notes
	$("#add_notes").click(function(){
		save_method = 'add';
		$('#notes')[0].reset(); // reset form on modals 
		$('[name="debtors_id"]').val(deb_id);    
		$('#notes_model').modal('show'); // show bootstrap modal
		$('.modal-title').text('Add Notes'); // Set Title to Bootstrap modal title
	});
	//addvalidion 
	$("#btnnotes").click(function(){			
		var url;
		if(save_method == 'add') {
			url = "<?php echo site_url('notes/validation')?>";
		}
		 var formData = new FormData($('#notes')[0]);
	   $.ajax({
			url : url,
			type: "POST",		
			data: formData,
			contentType: false,
			processData: false,
			dataType: "JSON",
			success: function(data)
			{ 
				if(data.status) //if success close modal and reload ajax table
				{	
					$('#notes_model').modal('hide');				
					notify(data.status);			
					$("#notes")[0].reset();
					notesTable.ajax.reload(null,false);
				}
				else
				{				
					 $('#errmsg2').show();			
					$("#errmsg2").html(data.error);
					setTimeout(function() {
					 $('#errmsg2').hide();
					}, 2000 );
				
				}			

			}
			
		});
	});
	//end notes details
	//start event details 
	EventTable=$('#eventtable').DataTable( {
		"ajax": "<?php echo site_url('event/get_event_list')?>?deb_id="+deb_id,		
		//"stateSave"		: true,
		"order": [],
		"dom": '<"top">rt<"bottom"ip><"clear">',
		"columns": [
			 { "data": null },
			 { "data": null },
			 { "data": "Event_title" },
			 { "data": "Event_description" },
			{ "data": null }
		],
		"columnDefs": [
			{
				"targets": [0], "data": null, 
				"className"	: "text-center",
				"render" : function (data, type, row) {
					
					  var date = new Date(data['Event_create_dt']);
				
							return date.getMonth() + 1 + '/' + date.getDate() + '/' + date.getFullYear();					
								
				},
				"orderable": false 
			},
			{
				"targets": [1], "data": null, 
				"className"	: "text-center",
				"render" : function (data, type, row) {
					
					  var date = new Date(data['Event_create_dt']);
				
							return date.getHours() + ':'+ date.getMinutes();					
								
				}				
			},
			{
				"targets": [4], "data": null, 
				"defaultContent" :				
				'<button  class="btn btn-danger btn-xs Delete"><i class="fa fa-trash-o" title="Delete"></i></button>',
				"orderable": false 
				
			}
			
		]
		
	} );
	//add event
	$("#add_event").click(function(){
		save_method = 'add';
		var e = document.getElementById("Active_list");
		var Active = e.options[e.selectedIndex].text;		
		$('#event')[0].reset(); // reset form on modals 
		$.ajax({
				url : "<?php echo site_url('event/get_employee_name')?>?debtors_id=" + deb_id,
				type: "GET",
				dataType: "JSON",
				success: function(data)
				{ 
				    $('[name="debtors_id"]').val(deb_id);
					$('[name="event_title"]').val(Active);
					$('[name="call_user"]').val(data.cxd_ServiceRepID);
					$("#ser_ref").append('<option value="'+data.cxd_ServiceRepID+'" selected>'+data.Emp_firstname+'</option>');
					$('#event_model').modal('show'); // show bootstrap modal
					$('.modal-title').text('Add Event'); // Set Title to Bootstrap modal title

				}
			});
	});
		//addvalidion 
	$("#btnevent").click(function(){	

		var url;
		if(save_method == 'add') {
			url = "<?php echo site_url('event/validation')?>";
		}
	   $.ajax({
			url : url,
			type: "POST",		
			data: $('#event').serialize(),		
			dataType: "JSON",
			success: function(data)
			{ 
				if(data.status) //if success close modal and reload ajax table
				{	
					$('#event_model').modal('hide');				
					notify(data.status);			
					$("#event")[0].reset();
					EventTable.ajax.reload(null,false);
				}
				else
				{				
					 
					$(".error_msg").html('');					
					 $.each(data.error,function(key,value){
						 $("#"+key+"_error").text(value);
					 })
				
				}			

			}
			
		 	
		});
	});
	//delete
	$('#eventtable tbody').on('click','tr .Delete',function(event){		
		rdata=EventTable.row( parentRow($(this)) ).data();		
		fneventDelete(this,rdata["Event_id"]);
	
	});
	function fneventDelete(e,Id)
	{ 
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('event/delete_event')?>?id="+Id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            { 
					notify(data.status);
					EventTable.ajax.reload(null,false);
            }          
        });

    }
	}
	//End event details 
	//start payment details 
	PaymentTable=$('#paymenttable').DataTable( {
		"ajax": "<?php echo site_url('payment/get_payment_list')?>?deb_id="+deb_id,		
		//"stateSave"		: true,		
		 "dom": '<"top">rt<"bottom"ip><"clear">',
		"order": [],
		"columns": [
			 { "data": null },
			 { "data": "Pay_methods" },
			 { "data": "Payment_amount" },
			 { "data": "Payment_desc" }
		],
		"columnDefs": [		  
			{
				"targets": [0], "data": null, 
				"className"	: "text-center",
				"render" : function (data, type, row) {
					
					  var date = new Date(data['Payment_create_dt']);
				
							return date.getMonth() + 1 + '/' + date.getDate() + '/' + date.getFullYear();					
								
				}
			}
		]
	
			
	} );

	//$(".updatedValue").parent().css({"background-color":"#10E438"});
	//$('#paymenttable table > tbody:last').find('tr:first').addClass( 'highlight' ); 
	//add payment
	$("#add_payment").click(function(){
		save_method = 'add';
		$('#payment')[0].reset(); // reset form on modals 
		$('[name="debtors_id"]').val(deb_id); 
		var d_name = $('[name="deptor_name"]').val();		
		$("#deb_name").append('<option value="'+d_name+'" selected>'+d_name+'</option>');
		$.ajax({
			url : "<?php echo site_url('payment/get_payment_method')?>?debtors_id=" + deb_id,
			type: "GET",
			success: function(data)
			{
				var res = data.split('^');
				jQuery("#pay_method").html(res[0]);
				$('[name="owing_amt"]').val(res[1]); 
			
			}
		});		
		$('#payment_model').modal('show'); // show bootstrap modal
		$('.modal-title').text('Add Payment'); // Set Title to Bootstrap modal title
		
	});
	//addvalidion 
	$("#btnpayment").click(function(){			
		var url;
		if(save_method == 'add') {
			url = "<?php echo site_url('payment/validation')?>";
		}	
	   $.ajax({
			url : url,
			type: "POST",		
			data: $('#payment').serialize(),		
			dataType: "JSON",
			success: function(data)
			{ 
				if(data.status) //if success close modal and reload ajax table
				{	
					$('#payment_model').modal('hide');				
					 notify(data.status);			
					$("#payment")[0].reset();					
					$("#owing").load("<?php echo site_url('payment/owing_amount')?>?deb_id="+deb_id);					
					PaymentTable.ajax.reload(null,false);
					
				}
				else
				{				
					$(".error_msg").html('');					
					 $.each(data.error,function(key,value){
						 $("#"+key+"_error").text(value);
					 })
				
				}			

			}
			
		});
	});
	//end payment details
	//parametter get id 
	function parentRow(elem){
	var ftr=elem.closest('tr');
	var idx;
	var node;
	if(elem.closest('tr').hasClass('child'))
	{
		idx = d2t.responsive.index( elem.closest('li') );
		node=phoneTable.rows({  order: 'index'}).nodes()[idx.row]
		return $(node);
	
	}			
	return elem.closest('tr');
	}
	
	$("#cancel").click(function(){
	document.frmMasterList.action="<?php echo base_url() ?>index.php/customer/debtors_details";		
	document.frmMasterList.submit();
	});
});
//debtor Edit 
function fndebEdit(){		
	document.frmMasterList.id.value = deb_id;
	document.frmMasterList.action="<?php echo base_url() ?>index.php/customer/edit_debtors";		
	document.frmMasterList.submit();			
}
//letter print
function letter_print(){

	var leter_id = $("#ltr_id option:selected").val();	
	document.frmMasterList.id.value = deb_id;
	document.frmMasterList.letter_id.value = leter_id;
	document.frmMasterList.action="<?php echo base_url() ?>index.php/customer/letter_print";	
    document.frmMasterList.setAttribute("target", "_blank");	
	document.frmMasterList.submit();	
}

</script>
<style>
td.highlight {
    background-color: red !important;
}
</style>
        <!-- page content -->
	
        <div class="right_col" role="main">
			 <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Collection Central</h2>
                    <ul class="nav navbar-right panel_toolbox">
					<button class="btn btn-primary btn-xs" id="cancel" type="button">Back</button>
					
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				  <form name="frmMasterList" id="frmMasterList" method="post" target="_self">
				  <input type="hidden" name="id" id="id">
				  <input type="hidden" name="cust_id" id="cust_id" value="<?php echo $this->input->post('cus_id'); ?>">
				  <input type="hidden" name="letter_id" id="letter_id">
				  </form>
					<?php foreach($view_debtors->result() as $view){ ?>
                    <section class="content invoice">
					 <!-- alert -->
					<div class="row">
						<div class="col-md-4"></div>
                        <div class="col-md-4">
							 <div id="alert" class="alert alert-success alert-dismissible fade in" role="alert" style="display:none;">
									<strong id="susmsg"></strong>
								  </div>
							</div>
						<div class="col-md-4"></div>
					 </div>
					 <!-- alert -->
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
						<?php
						//payment details
						$orginal = $view->cxd_prince_amt;
						$fees = $view->cxd_int_fees;
						$owing = $view->deptors_debtors_owing;
						?>
						<input type="hidden" name="deptor_name" id="deptor_name" value="<?php echo $view->deptors_firstname.' '.$view->deptors_lastname; ?>">
						
						 <strong class="green"><?php echo  $view->deptors_firstname.' '.$view->deptors_lastname; ?></strong>
                          <small class="pull-right">Last services Date: <?php echo date('d/m/Y', strtotime($view->cxd_last_service_date)); ?></small>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
					   <div class="row">
					    <div class="col-sm-6">
						 <div class="row">
							<div class="col-sm-6 invoice-col">

							  A/c Type : <strong class="red"><?php echo $view->Ac_type_name ?></strong><br>
							Account # : <strong class="red"><?php echo $view->deptors_ref_no ?></strong><br>
							 Client Name : <strong class="red"><?php echo $view->Cus_firstname.' '.$view->Cus_lastname ?></strong><br>
							 Client ref # : <strong class="red"><?php echo $view->cxd_ServiceRepID ?></strong><br>
							</div>
							<!-- /.col -->
							<div class="col-sm-6 invoice-col text-right">                       
							  <address>		  
								 <?php echo $view->Address_Street; ?>
								  <br><?php echo $view->Address_city.'-'.$view->Address_zipcode; ?>
								  <br><?php echo $view->Address_state; ?>
								  <br><?php echo $view->Address_country; ?>
								  <br><?php echo $view->Address_email ?>
							  </address>
							</div>
							<!-- /.phone -->
							       <div class="x_panel">
									  <div class="x_title">
										<h2>Phone <small>Number List</small></h2>
										<ul class="nav navbar-right panel_toolbox">
										  <button class="btn btn-warning  btn-xs" id="add_phone" type="button"><i class="fa fa-plus" title="Add Phone"></i> Add</button>
										  
										</ul>
										<div class="clearfix"></div>
									  </div>
									  <div class="x_content">
									
										<table id="phonetable" class="table table-hover">
										  <thead>
											<tr>
											  <th>Type</th>
											  <th>Number</th>											
											  <th>Edit</th>
											  <th>Delete</th>
											</tr>
										  </thead>
										</table>

									  </div>
									</div>
						<!-- /.phone -->
						<!-- /.event -->
						   <div class="x_panel">
							  <div class="x_title">
								<h2>Calender Event List</h2>								
								<div class="clearfix"></div>
							  </div>
							  <div class="x_content">
								<table id="eventtable" class="table table-hover">
								  <thead>
									<tr>
									  <th>Date</th>
									  <th>Time</th>											
									  <th>Event Title</th>
									  <th>Description</th>
									  <th>Delete</th>
									</tr>
								  </thead>
								</table>

							  </div>
							</div>
						<!-- /.event -->
							<!-- /.col -->
						  </div>
					  
                      <!-- /.row -->
						</div>
					 
						<div class="col-sm-6">
						<div class="row">
						 <div class="col-sm-8 invoice-col">                       
                         <div class="x_content">
							 <div class="">
							 <form  id="status" class="form-horizontal" method="post">
							 <input type="hidden" name="cxd_id" id="cxd_id" value="<?php echo $view->cxd_id; ?>">
								<ul class="to_do">
								  <li>
									<p><i class="fa fa-bar-chart-o green"></i> Activites</p>
									<?php 									 
									  foreach($activities_details->result() as $ac_list){
										  $active_list[$ac_list->Activities_id] = $ac_list->Activities_abrev;
									  }
									  echo form_dropdown('active_list', $active_list, $view->cxd_last_active_id, 'class="form-control" id="Active_list"');
									  ?>									 
								  </li>
								  <li>
									<p><i class="fa fa-file-text-o green"></i> Letter</p>
									<?php 									 
									  foreach($letter_details->result() as $ltr){
										  $letter_list[$ltr->Letter_id] = $ltr->Letter_name;
									  }
									  echo form_dropdown('letter_list', $letter_list, $view->cxd_letter_send, 'class="form-control" id="ltr_id"');
									  ?>									 
								  </li>
								   <li>
									<p><i class="fa fa-smile-o green"></i> A/C Status</p>
									 <?php 
									  $deb_status[''] = 'Select status';
									  foreach($debtor_status->result() as $deb){
										  $deb_status[$deb->debt_status_id] = $deb->debt_status_abrev;
									  }
									  echo form_dropdown('deb_status', $deb_status, $view->cxd_status, 'class="form-control"');?>									 
								  </li>
								 <button type="button" id="btnstatus" class="btn btn-success btn-xs">Save</button>
								</ul>
								</form>
							  </div>
							</div>
                        </div>
                        <!-- /.col -->
							<div class="col-sm-4 invoice-col">
							 <div class="x_content">
								  <div class="dashboard-widget-content">
									<ul class="quick-list">
									  <li><i class="fa fa-calendar-o"></i><a href="#" id="add_event">Schedule Call</a>
									  </li>
									  <li><i class="fa fa-money"></i><a href="#" id="add_payment">Payment</a>
									  </li>
									  <li><i class="fa fa-print"></i><a href="#" onclick="letter_print();">Letter Print</a>
									  </li>
									  <li><i class="fa fa-bar-chart"></i><a href="#" onclick="fndebEdit();">Update Debtor</a> </li>									 
									  </li>
									</ul>
								  </div>
								</div>						  
								
							</div>
							 <div class="x_panel">
							
								  <div class="x_title" id="payments_dtls">
								  <strong>Payment Details:-  </strong>&nbsp;&nbsp;
									<strong>Orginal: <i class="fa fa-rupee"></i>&nbsp;<?php echo $orginal; ?></strong>&nbsp;&nbsp;
									<strong>Fees: <i class="fa fa-rupee"></i>&nbsp;<?php echo $fees; ?></strong>&nbsp;&nbsp;
									<strong>Owing: <i class="fa fa-rupee"></i>&nbsp;<span id="owing" style="color: red;"><?php echo $owing; ?></span></strong>
									<ul class="nav navbar-right panel_toolbox">
									 
									</ul>
									<div class="clearfix"></div>
								  </div>							 
									<table id="paymenttable" class="table table-hover">
									  <thead>
										<tr>
										  <th>Date</th>
										  <th>Method</th>											
										  <th>Amount</th>
										  <th>Desc</th>										  
										</tr>
									  </thead>
									</table>								
								</div>
							   <div class="x_panel">
								  <div class="x_title">
									<h2>Notes Details</h2>
									<ul class="nav navbar-right panel_toolbox">
									  <button class="btn btn-warning  btn-xs" id="add_notes" type="button"><i class="fa fa-plus" title="Add Phone"></i> Add</button>
									  
									</ul>
									<div class="clearfix"></div>
								  </div>
								  <div class="x_content">
									<table id="notestable" class="table table-hover">
									  <thead>
										<tr>
										  <th>Date Time</th>
										  <th>Notes</th>											
										  <th>User</th>										
										</tr>
									  </thead>
									</table>

								  </div>
								</div>
                        
						  </div>
						  <!-- /.col -->
						</div>
					  </div>
					</div>
					  <!-- /.row -->
				   </div>

                    </section>
					<?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
       
        </div>
        <!-- /page content -->
		
			 <!-- /add phone model -->
		  <div class="modal fade bs-example-modal-sm" id="add_phone_model" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
			  <div class="modal-content">

				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
				  </button>
				  <h4 class="modal-title" id="myModalLabel2"></h4>
				</div>
				<div class="modal-body">
				<span id="errmsg1" style="color:red; display:none;"></span>
				<form id="add_phone_details" method="post" > 
				<!-- /row1 -->				
				<div class="row">
				   <div class="form-group">				   
                       <label for="middle-name" class="control-label col-md-1 col-sm-1 col-xs-12" style="padding-top:10px;">Type</label>
						 <div class="col-md-3 col-sm-3 col-xs-12">
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
							echo form_dropdown('phone_type', $phn_type, 'Mobile','class = "form-control"');
						  ?>
                       <input type="hidden" name="id">
					   <input type="hidden" name="debtors_id" id="debtors_id" value="">
					     </div>
                      </div>
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-1 col-sm-1 col-xs-12" style="padding-top:5px;">Number</label>
                          <div class="col-md-3 col-sm-3 col-xs-12">
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
                       </div>
                      </div>
					   <div class="form-group">
                        <label for="middle-name" class="control-label col-md-1 col-sm-1 col-xs-12" style="padding-top:5px;">Sort</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <?php 
							$phone_sort = array();
							$phone_sort[] = 'Select sort';
							for($i=1;$i<=50;$i++){
							 $phone_sort[] = $i;
							}						 
							echo form_dropdown('phone_sort', $phone_sort,'','class ="form-control"');
						  ?>
						  </div>
                      </div>
					</div>
					  <!-- /row2 -->				
				<div class="row">
				   <div class="form-group">				   
                       <label for="middle-name" class="control-label col-md-1 col-sm-1 col-xs-12" style="padding-top:5px;">Type</label>
						 <div class="col-md-3 col-sm-3 col-xs-12">
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
							echo form_dropdown('phone_type2', $phn_type,'Work','class = "form-control"');
						  ?>
                       <input type="hidden" name="id">
					   <input type="hidden" name="debtors_id" id="debtors_id" value="">
					     </div>
                      </div>
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-1 col-sm-1 col-xs-12" style="padding-top:5px;">Number</label>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                          <?php 
							$data6 = array(
							'name' => 'phone_no2',
							'id'   => 'phone_no2',
							'onkeyup'     => 'checkInt(this)',
							'class' => 'form-control',
							'placeholder' => 'Enter a Number',
							);
							echo form_input($data6);
						  ?>
                       </div>
                      </div>
					   <div class="form-group">
                        <label for="middle-name" class="control-label col-md-1 col-sm-1 col-xs-12" style="padding-top:5px;">Sort</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <?php 
							$phone_sort = array();
							$phone_sort[] = 'Select sort';
							for($i=1;$i<=50;$i++){
							 $phone_sort[] = $i;
							}						 
							echo form_dropdown('phone_sort2', $phone_sort,'','class ="form-control"');
						  ?>
						  </div>
                      </div>
					</div>
					<!-- /row3 -->				
				<div class="row">
				   <div class="form-group">				   
                       <label for="middle-name" class="control-label col-md-1 col-sm-1 col-xs-12" style="padding-top:5px;">Type</label>
						 <div class="col-md-3 col-sm-3 col-xs-12">
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
							echo form_dropdown('phone_type3', $phn_type,'Home','class = "form-control"');
						  ?>
                       <input type="hidden" name="id">
					   <input type="hidden" name="debtors_id" id="debtors_id" value="">
					     </div>
                      </div>
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-1 col-sm-1 col-xs-12" style="padding-top:5px;">Number</label>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                          <?php 
							$data6 = array(
							'name' => 'phone_no3',
							'id'   => 'phone_no3',
							'onkeyup'     => 'checkInt(this)',
							'class' => 'form-control',
							'placeholder' => 'Enter a Number',
							);
							echo form_input($data6);
						  ?>
                       </div>
                      </div>
					   <div class="form-group">
                        <label for="middle-name" class="control-label col-md-1 col-sm-1 col-xs-12" style="padding-top:5px;">Sort</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <?php 
							$phone_sort = array();
							$phone_sort[] = 'Select sort';
							for($i=1;$i<=50;$i++){
							 $phone_sort[] = $i;
							}						 
							echo form_dropdown('phone_sort3', $phone_sort,'','class ="form-control"');
						  ?>
						  </div>
                      </div>
					</div>
				</form>
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  <button type="button" id="btnaddphone" class="btn btn-primary" >Save</button>
				</div>

			  </div>
			</div>
		  </div>
  <!-- /add phone model -->
			 <!-- /phone model -->
		  <div class="modal fade bs-example-modal-sm" id="phone_model" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-sm">
			  <div class="modal-content">

				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
				  </button>
				  <h4 class="modal-title" id="myModalLabel2"></h4>
				</div>
				<div class="modal-body">
				<span id="errmsg" style="color:red; display:none;"></span>
				<form id="phone" method="post" > 				
				  <div class="form-group">
                        <label for="middle-name" class="control-label">Phone Type</label>
					
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
							echo form_dropdown('phone_type', $phn_type,'','class = "form-control"');
						  ?>
                       <input type="hidden" name="id">
					   <input type="hidden" name="debtors_id" id="debtors_id" value="">
					 
                      </div>
					  <div class="form-group">
                        <label for="middle-name" class="control-label">phone Number</label>
                       
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
                       
                      </div>
					   <div class="form-group">
                        <label for="middle-name" class="control-label">Sort</label>
                    
                          <?php 
							$phone_sort = array();
							$phone_sort[] = 'Select sort';
							for($i=1;$i<=50;$i++){
							 $phone_sort[] = $i;
							}						 
							echo form_dropdown('phone_sort', $phone_sort,'','class ="form-control"');
						  ?>
                      </div>
					  </form>
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  <button type="button" id="btnphone" class="btn btn-primary" >Save</button>
				</div>

			  </div>
			</div>
		  </div>
  <!-- /phone model -->

  <!-- /Notes model -->
		  <div class="modal fade bs-example-modal-sm" id="notes_model" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-sm">
			  <div class="modal-content">

				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
				  </button>
				  <h4 class="modal-title" id="myModalLabel2"></h4>
				</div>
				<div class="modal-body">
				<span id="errmsg2" style="color:red; display:none;"></span>
				<form id="notes" method="post" > 
				  <div class="form-group">
                        <label for="middle-name" class="control-label">Notes Memo</label>
                        <?php 
							$data6 = array(
							'name' => 'notes_memo',
							'id'   => 'notes_memo',
							'class' => 'form-control',
							'rows'        => '5',
							'cols'        => '10',	
							'placeholder' => 'Enter a Notes'							
							);
							echo form_textarea($data6);
						  ?>                       
					   <input type="hidden" name="debtors_id" value="">
                      </div>
					  <div class="form-group">
                        <label for="middle-name" class="control-label">Attachment</label>
                       <input type="file" name="deb_file">
                      </div>
					  </form>
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  <button type="button" id="btnnotes" class="btn btn-primary" >Save</button>
				</div>

			  </div>
			</div>
		  </div>
  <!-- /Notes model -->
  <!-- /Calendeer event model -->
		  <div class="modal fade bs-example-modal-sm" id="event_model" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-md">
			  <div class="modal-content">

				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
				  </button>
				  <h4 class="modal-title" id="myModalLabel2"></h4>
				</div>
				<div class="modal-body">				
				<form id="event" method="post" > 
				
				  <div class="form-group">
                        <label for="middle-name" class="control-label">Event Title</label>
                        <?php 
							$data6 = array(
							'name' => 'event_title',
							'id'   => 'event_title',
							'class' => 'form-control',
							'placeholder' => 'Enter a Title'							
							);
							echo form_input($data6);
						  ?>                       
					   <input type="hidden" name="debtors_id" value="">
					    <input type="hidden" name="call_user" value="">
					
                      </div>
					   <div class="form-group">
                        <label for="middle-name" class="control-label">Description</label>
                        <?php 
							$data6 = array(
							'name' => 'event_desc',
							'id'   => 'event_desc',
							'class' => 'form-control',
							'rows'        => '5',
							'cols'        => '10',	
							'placeholder' => 'Enter a Description'							
							);
							echo form_textarea($data6);
						  ?> 
						  <span id="event_desc_error" class="error_msg"></span>
                      </div>
					  
					    <div class="form-group">
                        <label for="middle-name" class="control-label">Employee</label>                       
						  <select name="ser_ref" id="ser_ref" class="form-control" disabled></select>
                      </div>
					  
					  </form>
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  <button type="button" id="btnevent" class="btn btn-primary" >Save</button>
				</div>

			  </div>
			</div>
		  </div>
 <!-- /Calendeer event model -->
 <!-- /payment model -->
		  <div class="modal fade bs-example-modal-sm" id="payment_model" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-md">
			  <div class="modal-content">

				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
				  </button>
				  <h4 class="modal-title" id="myModalLabel2"></h4>
				</div>
				<div class="modal-body">				
				<form id="payment" method="post" > 
				   <div class="form-group">
					<label for="middle-name" class="control-label">Debtor</label>                       
					  <select name="deb_name" id="deb_name" class="form-control" disabled></select>
					   <input type="hidden" name="debtors_id" value="">
					   <input type="hidden" name="owing_amt">
				  </div>
				  <div class="form-group">
                        <label for="middle-name" class="control-label">Date</label>
                        <div class="xdisplay_inputx form-group has-feedback">                        
						   <input type="text" name="pay_date" value="<?php echo date("m/d/Y"); ?>" class="form-control has-feedback-left" id="single_cal2" aria-describedby="inputSuccess2Status2">
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
							<span id="inputSuccess2Status2" class="sr-only">(success)</span>
                        </div>                     
					  
                      </div>					  
					   <div class="form-group">
                        <label for="middle-name" class="control-label">Amount</label>
                        <?php 
							$data5 = array(
							'name' => 'pay_amount',
							'id'   => 'pay_amount',
							'class' => 'form-control',
							'placeholder' => 'Enter a Amount'							
							);
							echo form_input($data5);
						  ?>   
						<span id="pay_amount_error" class="error_msg"></span>						  
					  
                      </div>
					    <div class="form-group">
                        <label for="middle-name" class="control-label">Pay Method</label>
						<select name="pay_method" id="pay_method" class="form-control"></select>
                      </div>
					   <div class="form-group">
                        <label for="middle-name" class="control-label">Description</label>
                        <?php 
							$data6 = array(
							'name' => 'pay_desc',
							'id'   => 'pay_desc',
							'class' => 'form-control',
							'rows'        => '5',
							'cols'        => '10',	
							'placeholder' => 'Enter a Description'							
							);
							echo form_textarea($data6);
						  ?> 
                      </div>
					  
					  </form>
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  <button type="button" id="btnpayment" class="btn btn-primary" >Save</button>
				</div>

			  </div>
			</div>
		  </div>
 <!-- /payment model -->