		<?php //if($this->session->userdata('user_type')=="Admin"){ ?>
        <!-- page content -->
	
        <div class="right_col" role="main">

          <!-- top tiles -->
             <div class="row tile_count">
            <div class="col-md-4 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Customer</span>
              <div class="count blue"><?php echo $customer_count; ?></div>             
            </div>
            <div class="col-md-4 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Debtors</span>
              <div class="count red"><?php echo $debtors_count; ?></div>           
            </div>
			
            <div class="col-md-4 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Employee</span>
              <div class="count green"><?php echo $employee_count; ?></div>
            </div>
           
         </div>
          <!-- /top tiles -->

		<?php //} ?>
            
            </div>
			
       
        <!-- /page content -->
