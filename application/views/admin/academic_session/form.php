<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?php echo site_url('assets/common/plugins/datepicker/datepicker3.css'); ?>" >
<script type="text/javascript" src="<?php echo site_url ('assets/common/plugins/datepicker/bootstrap-datepicker.js'); ?>" ></script>
<style type="text/css">
.custom-addon{position:absolute; right: 15px; border-radius: 0px; padding: 9px 15px;}
.right-border{border-right:1px solid #ccc !important; }
.custom-addon i{margin: -5px;}
</style>
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
          <div class="box box-purple">
			<div class="box-header with-border">
				<h3 class="box-title">
					 <?php echo $page_sub_title ?>
				 </h3>
			 </div>
			 <?php if (!empty (validation_errors())) { ?>
			 <div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-ban"></i> Alert!</h4>
				<?php echo validation_errors(); ?>
			 </div>
			 <?php } ?>
				  <form class="form-horizontal" method="post">
					  <div class="box-body">
					  	<div class="col-md-6">
							<div class="form-group date">
								<label for="start_date" class="col-sm-4 control-label"><?php echo lang('start_date'); ?></label>
								<div class="col-sm-8">
									<div class="input-group-addon custom-addon right-border"><i class="fa fa-calendar"></i> </div>
    								<input type="text" class="form-control pull-right" name="start_date"" id="start_date" value="<?php echo (!empty ($row->start_date)) ? $row->start_date : set_value('start_date'); ?>" />	
    							</div>
    						</div>
							<div class="form-group date">
								<label for="end_date" class="col-sm-4 control-label"><?php echo lang('end_date'); ?></label>
								<div class="col-sm-8">
									<div class="input-group-addon custom-addon right-border"><i class="fa fa-calendar"></i> </div>
    								<input type="text" class="form-control pull-right" name="end_date" id="end_date" value="<?php echo (!empty ($row->end_date)) ? $row->end_date : set_value('end_date'); ?>" />	
    							</div>
    						</div>
    						<div class="form-group"> 
							  <label for="caption" class="col-sm-4 control-label"><?php echo lang('caption'); ?></label>
							  <div class="col-sm-8">
								<input type="text" name="caption" class="form-control" id="caption" value="<?php echo (!empty ($row->caption)) ? $row->caption : set_value('caption');  ?>">
							  </div>
							</div>
						</div>
					  </div>
					<div class="box-footer">
						<a href="<?php echo site_url ('admin/academic_session'); ?>" class="btn btn-default btn-flat"><?php echo lang('cancel') ?></a>
						<input type="submit" class="btn bg-purple btn-flat" name="submit" value="<?php echo lang('save') ?>" >
					</div>
				</form>
		  </div>
		</div>
	   </div>
	<section> 
   </div>		  
   <script>
$(document).ready(function(){

	$('#start_date').datepicker({
		autoclose : true ,
		format: "yyyy/mm/dd",
	});
	$('#end_date').datepicker({
		autoclose : true ,
		format: "yyyy/mm/dd",
	});
});
</script>      