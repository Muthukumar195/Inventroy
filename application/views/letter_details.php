<script type="text/javascript" class="init">
var ddtable;	
$(document).ready(function() {
	ddtable=$('#d2table').DataTable( {
		"ajax": "<?php echo base_url() ?>index.php/letter/get_letter_list",
		//"stateSave"		: true,
		"order": [],
		"columns": [
			 { "data": "Letter_name" },
			 { "data": "Letter_category" },
			 { "data": "Letter_sort" },
             { "data": null },
			 { "data": null },
			 { "data": null },
			 { "data": null },
			 { "data": null }

		],
		"columnDefs": [	
			
			{
				"targets": [3], "data": null, 
				"defaultContent" :				
				'<button  class="btn btn-primary btn-xs View" title="View"><i class="fa fa-search"></i></button>',
				"orderable": false 
				
			},
			{
				"targets": [4], "data": null, 
				"defaultContent" :				
				'<button  class="btn btn-info btn-xs Edit" title="Edit"><i class="fa fa-pencil" ></i></button>',
				"orderable": false 
				
			},
			{
				"targets": [5], "data": null, 
				"defaultContent" :				
				'<button  class="btn btn-danger btn-xs Delete" title="Delete"><i class="fa fa-trash-o"></i></button>',
				"orderable": false 
				
			},
			{
				"targets": [6], "data": null, 
				"defaultContent" :				
				'<button class="btn btn-default btn-xs Print" type="button" target="_blank"><i class="fa fa-print"></i></button>',
				"orderable": false 
				
			},
			{
				"targets": [7], "data": null, 
				"defaultContent" :				
				'<button class="btn btn-default btn-xs pdf" type="button" target="_blank"><i class="fa fa-file-pdf-o"></i></button>',
				"orderable": false 
				
			}
		]
		
	} );
	
	$('#d2table tbody').on('click','tr .Edit',function(event){		
		rdata=ddtable.row( parentRow($(this)) ).data();		
		fncusEdit(this,rdata["Letter_id"]);		
	});
	$('#d2table tbody').on('click','tr .Delete',function(event){
		rdata=ddtable.row( parentRow($(this)) ).data();
		fnDelete(this,rdata["Letter_id"]);	
	
	});	
	$('#d2table tbody').on('click','tr .View',function(event){
		
		rdata=ddtable.row( parentRow($(this)) ).data();
		fnsview(this,rdata["Letter_id"]);	
	});	
	$('#d2table tbody').on('click','tr .Print',function(event){
		
		rdata=ddtable.row( parentRow($(this)) ).data();
		fnsprint(this,rdata["Letter_id"]);	
	
	});	
	$('#d2table tbody').on('click','tr .pdf',function(event){
		
		rdata=ddtable.row( parentRow($(this)) ).data();
		Pdf(this,rdata["Letter_id"]);	
	
	});	
	
	function fncusEdit(e,letterId){
		
			document.frmLetterList.letter_id.value = letterId;
			document.frmLetterList.action="<?php echo base_url() ?>index.php/letter/edit_letter";		
			document.frmLetterList.submit();			
	}
	function fnsview(e,letterId){
			
			document.frmLetterList.letter_id.value = letterId;
			document.frmLetterList.action="<?php echo base_url() ?>index.php/letter/view_letter";		
			document.frmLetterList.submit();			
	}
	function fnsprint(e,letterId){			
			document.frmLetterList.letter_id.value = letterId;
			document.frmLetterList.action="<?php echo base_url() ?>index.php/letter/print_letter";	
			document.frmLetterList.setAttribute("target", "_blank");			
			document.frmLetterList.submit();			
	}
	function Pdf(e,letterId){			
			document.frmLetterList.letter_id.value = letterId;
			document.frmLetterList.action="<?php echo base_url() ?>index.php/letter/create_pdf";	
			document.frmLetterList.setAttribute("target", "_blank");			
			document.frmLetterList.submit();			
	}
	
	function fnDelete(e,letterId){
	if (confirm("Are you sure to delete this Letter?") == true){
		$.ajax({
		url: '<?php echo base_url() ?>index.php/letter/delete_letter',
		data: {"letterId":letterId},
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
	
function reload_table()
{
   ddtable.ajax.reload( null, false ); //reload datatable ajax 
}
	function parentRow(elem){
		var ftr=elem.closest('tr');
		var idx;
		var node;
		if(elem.closest('tr').hasClass('child'))
		{
			idx = ddtable.responsive.index( elem.closest('li') );
			node=ddtable.rows({ order: 'index'}).nodes()[idx.row]
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
                    <h2>Letter Details</h2>
					
                    <ul class="nav navbar-right panel_toolbox">
					<?php if($this->session->userdata('user_type')=="Admin"){  echo anchor('letter/add_letter','<i class="fa fa-plus" title="Add Customer"></i> Add Letter', 'class="btn btn-warning btn-xs"'); } ?>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">			
				  <form name="frmLetterList" id="frmLetterList" method="post" target="_self">
				  <input type="hidden" name="letter_id" id="letter_id">
				  </form>
				 <table id="d2table" class="table table-striped table-bordered">
					<thead>
						<tr>
                          <th>Name</th>
                          <th>Category</th>
                          <th>Sort</th>
						  <th>View</th>
						  <th>Edit</th>
						  <th>Delete</th>
						  <th>Print</th>
						  <th>PDF</th>							  
						</tr>
					</thead>
					<tfoot>
						<tr>
                          <th>Name</th>
                          <th>Category</th>
                          <th>Sort</th>
						  <th>View</th>
						  <th>Edit</th>
						  <th>Delete</th>	
						  <th>Print</th>
						  <th>PDF</th>						  
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
	