<script type="text/javascript" class="init">
var ddtable;	
$(document).ready(function() {
	ddtable=$('#d2table').DataTable( {
		"ajax": "<?php echo base_url() ?>index.php/employee/get_employee_list",
		//"stateSave"		: true,
		"order": [],
		"columns": [				
             { "data": null },
			 { "data": null }
		],
		"columnDefs": [	
			{
				"targets": [0], "data": null, 
				"render" : function (data, type, row) {
					var name = data['Emp_firstname']+'&nbsp;'+data['Emp_lastname'];
					return name;
				}
				
			},
			{
				"targets": [1], "data": null, 
				"defaultContent" :				
				'<button  class="btn btn-primary btn-xs View" title="View"><i class="fa fa-search"></i></button>',
				"orderable": false 
				
			}
		]
		
	} );
		
	$('#d2table tbody').on('click','tr .View',function(event){		
		rdata=ddtable.row( parentRow($(this)) ).data();
		fnsview(this,rdata["Emp_id"]);	
	});
	
	
	function fnsview(e,empId){	
	//Employee assign customer details get 	
		$.ajax({
				url : "<?php echo site_url('employee/employee_ass_customer')?>?employee_id=" + empId,
				type: "GET",
				dataType: "JSON",
				success: function(data)
				{ 
					// $.each(data.customers,function(key,value){
						// alert(value);
						//$('#cus_ass').text(value);
					//});
					
                         
                            
                              //<input type="checkbox" class="flat"> Schedule meeting with new client </p>
                          
					var cus = ''; var i=1;
					 $.each(data.customers, function(key, item) {						
					
					cus += '<li><p><i class="fa fa-user"></i>&nbsp' + item.Cus_firstname + '&nbsp' + item.Cus_lastname +'</p></li>';
					i++;
					});
					$('#cus_ass').html(cus);
					$('#emp_model').modal('show'); // show bootstrap modal
					$('.modal-title').text('Assign Customers'); // Set Title to Bootstrap modal title

				}
		});			
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
                    <h2>Employee Details</h2>					
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				  <form name="frmEmpList" id="frmEmpList" method="post" target="_self">
				  <input type="hidden" name="employee_id" id="employee_id">
				  </form>
				 <table id="d2table" class="table table-striped table-bordered">
					<thead>
						<tr>
                          <th>Name</th>
                          <th>View</th>                         		  
						</tr>
					</thead>
					<tfoot>
						<tr>
                          <th>Name</th>
                          <th>View</th> 			 
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
		<!-- /Employeee view model -->
		  <div class="modal fade bs-example-modal-sm" id="emp_model" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-md">
			  <div class="modal-content">

				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
				  </button>
				  <h4 class="modal-title" id="myModalLabel2"></h4>
				</div>
				<div class="modal-body">				
				<ul class="to_do" id="cus_ass"></ul>
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>

			  </div>
			</div>
		  </div>
 <!-- /Employeee view model -->
	