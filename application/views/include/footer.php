
        <!-- footer content -->
        <footer>
          <div class="pull-right">
           Velan Info Services
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
 
 
 <script>
//check int value
function checkInt(obj)
{
	if(obj.value*1 - obj.value*1!=0)
		{obj.value="";}
	
	if(obj.value.indexOf(" ",0)!=-1)
		{
		obj.value="";
		alert ("No Spaces Allowed");	
		obj.focus();
		obj.value="";
		}
}
//Notification
function notify(data){
	new PNotify({
		  title: 'Success',
		  text: data,
		  type: 'success',
		  styling: 'bootstrap3',
		  delay: 1000,
	  });
	 
}
</script>
  
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>vendors/fastclick/lib/fastclick.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo base_url(); ?>vendors/skycons/skycons.js"></script>
    <!-- DateJS -->
    <script src="<?php echo base_url(); ?>vendors/DateJS/build/date.js"></script>
	 <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url(); ?>vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="<?php echo base_url(); ?>assets/jquery.confirm.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>assets/js/custom.min.js"></script>

  </body>
</html>
