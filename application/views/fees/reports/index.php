<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $page_title ?>
      </h1>
      <?php echo $breadcrumb; ?>	  
    </section>
	<section class="content">
      <div class="row">
        <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="box box-danger">
           <div class="box-body">
              <div class="col-md-3">
			  	<a href="<?php echo site_url('fees/reports/group_wise_student_fees_report') ?>" class="btn btn-default">
					<?php echo lang('group_wise_student_fees_report') ?>
				</a>
			  </div>
			  <div class="col-md-3">
			  	<a href="<?php echo site_url('fees/reports/fast_bill_applied_student_report') ?>" class="btn btn-default">
					<?php echo lang('fast_bill_applied_student_report') ?>
				</a>
			  </div>
              <div class="col-md-3">
			  	<a href="<?php echo site_url('fees/reports/date_wise_recipt_report') ?>" class="btn btn-default">
					<?php echo lang('date_wise_recipt_report') ?>
				</a>
			  </div>
            </div>
            <!-- /.box-body -->
			</div>	
		</div>
      </div>
    </section>
  </div>
  