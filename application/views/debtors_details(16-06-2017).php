<script type="text/javascript" class="init">
var cus_id = "<?php echo $this->input->post('cust_id'); ?>"
var ddtable;	
$(document).ready(function() {
	ddtable=$('#d2table').DataTable( {
		"ajax": "<?php echo base_url() ?>index.php/customer/debtors_details_list?cus_id="+cus_id,		
		//"stateSave"		: true,
		"columns": [
			 { "data": null },
			 { "data": "Ac_type_name" },
			 { "data": "deptors_ref_no" },
             { "data": "deptors_debtors_owing" },
			 { "data": "debt_status_abrev" },
             { "data": null },
			 { "data": null },
			 { "data": null }
		],
		"columnDefs": [			 
		   { 
				"targets": [0], "data": null, 
				"className"	: "text-center",						
				"render" : function (data, type, row) {
					var name = data['deptors_firstname']+'&nbsp;'+data['deptors_lastname'];
					return name;
					},
		    },			
			
		
			{
				"targets": [5], "data": null, 
				"defaultContent" :				
				'<button  class="btn btn-primary btn-xs view"><i class="fa fa-search" title="View"></i></button>',
				"orderable": false 
				
			},
			{
				"targets": [6], "data": null, 
				"defaultContent" :				
				'<button  class="btn btn-info btn-xs Edit"><i class="fa fa-pencil" title="Edit"></i></button>',
				"orderable": false 
				
			},
			{
				"targets": [7], "data": null, 
				"defaultContent" :				
				'<button  class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o" title="Delete"></i></button>',
				"orderable": false 
				
			},
			{
				"className"	: "never",
				"targets"	: [ 
						<?php if($this->session->userdata('user_type')=="Employee"){ ?>
							7
						   <?php }?>
							],
				"visible"	: false,
				"orderable": false 
			},
		
			

		]
		
	} );
	$('#d2table tbody').on('click','tr .Edit',function(event){		
		rdata=ddtable.row( parentRow($(this)) ).data();		
		fncusEdit(this,rdata["deptors_id"]);		
	});
	
	$('#d2table tbody').on('click','tr .delete',function(event){
		rdata=ddtable.row( parentRow($(this)) ).data();
		fnDelete(this,rdata["deptors_id"]);	
	
	});
	$('#d2table tbody').on('click','tr .view',function(event){
		rdata=ddtable.row( parentRow($(this)) ).data();
		fnsview(this,rdata["deptors_id"]);	
	
	});
	function fncusEdit(e,depId){		
		document.frmMasterList.id.value = depId;
		document.frmMasterList.cus_id.value = cus_id;
		document.frmMasterList.action="<?php echo base_url() ?>index.php/customer/edit_debtors";		
		document.frmMasterList.submit();			
	}
	function fnsview(e,depId){
			
			document.frmMasterList.id.value = depId;
			document.frmMasterList.cus_id.value = cus_id;
			document.frmMasterList.action="<?php echo base_url() ?>index.php/customer/view_debtors";		
			document.frmMasterList.submit();			
	}
	//delete
	function fnDelete(e,depId){
	if (confirm("Are you sure to delete this Debtors?") == true){
		$.ajax({
		url: '<?php echo base_url() ?>/index.php/customer/delete_debtors',
		data: {"depId":depId},
		cache: false,
		dataType:"json",
		type: 'POST',
		success: function(data){		
			if(data.status) //if success close modal and reload ajax table
				{			
					$("#susmsg").html(data.status);
					 $('#alert').show();
					setTimeout(function() {
					 $('#alert').hide();
					}, 2000 );			
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
	function reload_table()
   {
    ddtable.ajax.reload(null,false); //reload datatable ajax 
   }
   $("#cancel").click(function(){
	document.frmMasterList.action="<?php echo base_url() ?>index.php/customer";		
	document.frmMasterList.submit();
	});
	
} );
</script>
        <!-- page content -->
        <div class="right_col" role="main">
			<!-- table -->
			            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2 style="color:#169F85;"> <?php echo $this->input->post('custfname').' '.$this->input->post('custlname') ?></h2>
                    <ul class="nav navbar-right panel_toolbox">
					<button class="btn btn-primary" id="cancel" type="button">Back</button>
                    
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
					  <input type="hidden" name="id" id="id">
					   <input type="hidden" name="cus_id" id="cus_id">
					  </form>
                    <table id="d2table" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Names</th>
                          <th>Account Type</th>
                          <th>Refernce no</th>
                          <th>Amount</th>                          
                          <th>Status</th>
						  <th>View</th>
						  <th>Edit</th>
						  <th>Delete</th>						 
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
			</div>
			<!-- table -->
        </div>
        <!-- /page content -->
