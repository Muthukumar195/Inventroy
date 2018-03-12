<script type="text/javascript" class="init">
var ddtable;	
$(document).ready(function() {
	ddtable=$('#d2table').DataTable( {
		"ajax": "<?php echo base_url() ?>index.php/user/user_details_list",
		//"stateSave"		: true,
		"order": [],
		"columns": [
			 { "data": null },
			 { "data": "User_type" },
			 { "data": "User_type_level" },         
			 { "data": null },
			 { "data": null },
			 { "data": null } 

		],
		"columnDefs": [			 
		   { 
				"targets": [0], "data": null, 
				"className"	: "text-center",						
				"render" : function (data, type, row) {
					var name = data['User_firstname']+'&nbsp;'+data['User_lastname'];
					return name;
					},
				"orderable": false 
		    },			
			{
				"targets": [3], "data": null, 
				"className"	: "text-center",
				"render" : function (data, type, row) {	
					if(data['User_status']==1){				
					return '<button type="button" class="btn btn-success btn-xs btnstatus" title="Status">'+data['Status_adrev']+'</button>';
					}
					else{
					return '<button type="button" class="btn btn-danger btn-xs btnstatus" title="Status">'+data['Status_adrev']+'</button>';
					}
					},
				"orderable": false 
			},		
			{
				"targets": [4], "data": null, 
				"defaultContent" :				
				'<button  class="btn btn-info btn-xs Edit"  title="Edit"><i class="fa fa-pencil"></i></button>',
				"orderable": false 
				
			},
			{
				"targets": [5], "data": null, 
				"defaultContent" :				
				'<button  class="btn btn-danger btn-xs dbtdelete" title="Delete"><i class="fa fa-trash-o"></i></button>',
				"orderable": false 
				
			},
		]
		
	} );
	

	$('#d2table tbody').on('click','tr .Edit',function(event){		
		rdata=ddtable.row( parentRow($(this)) ).data();		
		fncusEdit(this,rdata["User_id"]);		
	});
	
	$('#d2table tbody').on('click','tr .dbtdelete',function(event){
		rdata=ddtable.row( parentRow($(this)) ).data();
		fnDelete(this,rdata["User_id"]);	
	
	});	
	$('#d2table tbody').on('click','tr .btnstatus',function(event){		
		rdata=ddtable.row( parentRow($(this)) ).data();
		fnstatus(this,rdata["User_id"],rdata["User_status"]);	
	
	});
	
	function fncusEdit(e,userId){		
			document.frmMasterList.user_id.value = userId;
			document.frmMasterList.action="<?php echo base_url() ?>/index.php/user/edit_user";		
			document.frmMasterList.submit();			
	}
	function fnDelete(e,userId){
	if (confirm("Are you sure to delete this User?") == true){
		$.ajax({
		url: '<?php echo base_url() ?>index.php/user/delete_user',
		data: {"userId":userId},
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
	function fnstatus(e,userId,userStatus){
	
		$.ajax({
		url: '<?php echo base_url() ?>index.php/user/user_status',
		data: {"userId":userId, "userStatus":userStatus,},
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
} );
</script>
        <!-- page content -->
        <div class="right_col" role="main">
			<!-- table -->
			            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>User Details <button class="btn btn-primary" id="complexConfirm">Click me</button></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                     
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
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
				  <input type="hidden" name="user_id" id="user_id">
				  </form>
                    <table id="d2table" class="table table-striped table-bordered">
                      <thead>
                        <tr>						
                          <th>Fullname</th>
                          <th>User Type</th>
						  <th>User Level</th>
						 
                          <th>Status</th>
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
		<script>
		$(document).ready(function() {
		$("#complexConfirm").confirm({
                title:"Delete confirmation",
                text: "This is very dangerous, you shouldn't do it! Are you really really sure?",
                confirm: function(button) {
                    button.fadeOut(2000).fadeIn(2000);
                    alert("You just confirmed.");
                },
                cancel: function(button) {
                    button.fadeOut(2000).fadeIn(2000);
                    alert("You aborted the operation.");
                },
                confirmButton: "Yes I am",
                cancelButton: "No"
            });
		 });
		</script>
		