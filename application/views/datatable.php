
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>DataTables example - Ajax data source (objects)</title>
	
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
	<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
	
	<script type="text/javascript" class="init">
	
$(document).ready(function() {
	$('#example').DataTable( {
		"ajax": "<?php echo base_url() ?>/index.php/customer/get_table_list",
		"columns": [
			 { "data": "Cus_firstname" },
            { "data": "Cus_lastname" }
		]
	} );
} );

	</script>
</head>
<body>

	<table id="example" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Firstname</th>
				<th>Lastname</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>Firstname</th>
				<th>Lastname</th>
			</tr>
		</tfoot>
	</table>
				
</body>
</html>