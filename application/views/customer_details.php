<script type="text/javascript" class="init">

var ddtable;	
$(document).ready(function() {
	ddtable=$('#d2table').DataTable( {
		"ajax": "<?php echo base_url() ?>/index.php/customer/get_table_list",
		//"stateSave"		: true,
		"order": [],
		"columns": [
			 { "data": null },
			 { "data": "Cus_code" },
			 { "data": "Cus_company" },
             { "data": "Cus_plan_type" },
			 { "data": "Cus_plan_desc" },
			 { "data": null },
             { "data": null },
			 { "data": null },
			 { "data": null },
			 { "data": null },
			 { "data": null }

		],
		"columnDefs": [			 
		   { 
				"targets": [0], "data": null, 
				"className"	: "text-center",						
				"render" : function (data, type, row) {
					var name = data['Cus_firstname']+'&nbsp;'+data['Cus_lastname'];
					return name;
					},
					
				
		    },
			{
				"targets": [5], "data": null, 
				"className"	: "text-center",
			    "render" : function (data, type, row) {					
					var debtors_list ='<button class="btn btn-warning btn-xs debtors_list" title="Debtor List"><i class="fa fa-search "></i></button><span class="badge bg-green">'+data['debtor_count']+'</span>';
					return debtors_list;
				}
				
			
			},
			{
				"targets": [6], "data": null, 
				"className"	: "text-center",
				"render" : function (data, type, row) {	
					if(data['Cus_status']==1){				
					return '<button type="button" class="btn btn-success btn-xs btnstatus" title="Status change">'+data['Status_adrev']+'</button>';
					}
					else{
					return '<button type="button" class="btn btn-danger btn-xs btnstatus" title="Status change">'+data['Status_adrev']+'</button>';
					}
					},
				
			
			},
			<?php if($this->session->userdata('user_type')=="Customer"||$this->session->userdata('user_type')=="Admin"){ ?>
			{ 
				
				"targets": [7], "data": null, 
				"defaultContent" : 
				'<button class="btn btn-warning btn-xs dbtadd" title="Add Debtors"><i class="fa fa-plus" ></i></button>',
			
			},
			{
				"targets": [8], "data": null, 
				"defaultContent" :				
				'<button class="btn btn-primary btn-xs View" title="View"><i class="fa fa-search" ></i></button>',
				
				
			},
			{
				"targets": [9], "data": null, 
				"defaultContent" :				
				'<button  class="btn btn-info btn-xs Edit" title="Edit"><i class="fa fa-pencil" ></i></button>',
				
			},
			{
				"targets": [10], "data": null, 
				"defaultContent" :				
				'<button  class="btn btn-danger btn-xs dbtdelete" title="Delete"><i class="fa fa-trash-o"></i></button>',
			
				
			},
			 <?php }?>
			{
				"className"	: "never",
				"targets"	: [ 
						<?php if($this->session->userdata('user_type')=="Employee"){ ?>
							7,8,9,10
						   <?php }?>						   
							],
				"defaultContent" :				
				'&nbsp;',
				"visible"	: false,
			
			},
			{ 
            "targets": [5,6,7,8,9,10], //first column / numbering column
			
            "orderable": false, //set not orderable
           }
			

		]
		
	} );
	
	$('#d2table tbody').on('click','tr .dbtadd',function(event){	
		rdata=ddtable.row( parentRow($(this)) ).data();		
		fnDebtorAdd(this,rdata["Cus_id"],rdata["Cus_employee_id"]);	
	});	
	$('#d2table tbody').on('click','tr .debtors_list',function(event){
	
		rdata=ddtable.row( parentRow($(this)) ).data();		
		fnDebtorList(this,rdata["Cus_id"],rdata["Cus_firstname"],rdata["Cus_lastname"]);	
	});
	$('#d2table tbody').on('click','tr .Edit',function(event){
		
		rdata=ddtable.row( parentRow($(this)) ).data();		
		fncusEdit(this,rdata["Cus_id"]);		
	});
	$('#d2table tbody').on('click','tr .dbtdelete',function(event){
		rdata=ddtable.row( parentRow($(this)) ).data();
		fnDelete(this,rdata["Cus_id"]);	
	
	});	
	$('#d2table tbody').on('click','tr .View',function(event){
		rdata=ddtable.row( parentRow($(this)) ).data();
		fnsview(this,rdata["Cus_id"]);	
	
	});
	$('#d2table tbody').on('click','tr .btnstatus',function(event){
		rdata=ddtable.row( parentRow($(this)) ).data();
		fnstatus(this,rdata["Cus_id"],rdata["Cus_status"]);	
	
	});
	function fnDebtorAdd(e,custId,refId){
			document.frmMasterList.cust_id.value = custId;
			document.frmMasterList.action="<?php echo base_url() ?>index.php/customer/add_debtors";		
			document.frmMasterList.submit();			
	}
	function fnDebtorList(e,custId,custFname,custLname){
			document.frmMasterList.cust_id.value = custId;
			document.frmMasterList.custfname.value = custFname;
			document.frmMasterList.custlname.value = custLname;
			document.frmMasterList.action="<?php echo base_url() ?>/index.php/customer/debtors_details";		
			document.frmMasterList.submit();			
	}
	function fncusEdit(e,custId){
		
			document.frmMasterList.cust_id.value = custId;
			document.frmMasterList.action="<?php echo base_url() ?>/index.php/customer/edit_customer";		
			document.frmMasterList.submit();			
	}
	function fnsview(e,custId){
			
			document.frmMasterList.cust_id.value = custId;
			document.frmMasterList.action="<?php echo base_url() ?>/index.php/customer/view_customer";		
			document.frmMasterList.submit();			
	}
	
	function fnDelete(e,CustId){		
	if (confirm("Are you sure to delete this Customer?") == true){
		$.ajax({
		url: '<?php echo base_url() ?>/index.php/customer/delete_customer',
		data: {"custId":CustId},
		cache: false,
		dataType:"json",
		type: 'POST',
		success: function(data){		
			if(data.status) //if success close modal and reload ajax table
				{			
					notify(data.status);
					reload_table();
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
	  }
	}
	function fnstatus(e,CustId,CustStatus){
	
		$.ajax({
		url: '<?php echo base_url() ?>/index.php/customer/status_customer',
		data: {"custId":CustId, "CustStatus":CustStatus,},
		cache: false,
		dataType:"json",
		type: 'POST',
		success: function(data){		
			if(data.status) //if success close modal and reload ajax table
				{
					notify(data.status);					
					reload_table();
				}
				
		}
		
		});	
	}

	
function reload_table()
{
    ddtable.ajax.reload(null,false); //reload datatable ajax 
}
	function parentRow(elem){
		var ftr=elem.closest('tr');
		var idx;
		var node;
		if(elem.closest('tr').hasClass('child'))
		{
			idx = ddtable.responsive.index( elem.closest('li') );
			node=ddtable.rows({  order: 'index'}).nodes()[idx.row]
			return $(node);
		
		}			
		return elem.closest('tr');
		}
	
});
</script>

        <!-- page content -->
        <div class="right_col" role="main">
			<!-- table -->
			<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Customer Details</h2>
				
                    <ul class="nav navbar-right panel_toolbox">
					<?php if($this->session->userdata('user_type')=="Admin"){  echo anchor('customer/add_customer','<i class="fa fa-plus" title="Add Customer"></i> Add Customer', 'class="btn btn-warning btn-xs"'); } ?>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				  <span id="errmsg" style="color:red; display:none;"></span>
					<div id="alert" class="alert alert-success alert-dismissible fade in" role="alert" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong id="susmsg"></strong>
                  </div>
				  <form name="frmMasterList" id="frmMasterList" method="post" target="_self">
				  <input type="hidden" name="cust_id" id="cust_id">
				  <input type="hidden" name="custfname" id="custfname">
				  <input type="hidden" name="custlname" id="custlname">
				  </form>
				 
				 <table id="d2table" class="table table-striped table-bordered">
					<thead>
						<tr>
                          <th>Name</th>
                          <th>Code</th>
                          <th>Company</th>
                          <th>Plan</th>
                          <th>Desc</th>
						  <th>Deb</th>
                          <th>Status</th>
						  <th>Deb</th>
						  <th>View</th>
						  <th>Edit</th>
						  <th>Delete</th>						 
						</tr>
					</thead>
					<tfoot>
						<tr>
                          <th>Name</th>
                          <th>Code</th>
                          <th>Company</th>
                          <th>Plan</th>
                          <th>Desc</th>
						  <th>Deb</th>
                          <th>Status</th>
						  <th>Deb</th>
						  <th>View</th>
						  <th>Edit</th>
						  <th>Delete</th>						 
						</tr>
					</tfoot>
				</table>
				 </div>
                </div>
              </div>
			</div>
			<!-- table -->
        </div>
        <!-- /page content -->
	