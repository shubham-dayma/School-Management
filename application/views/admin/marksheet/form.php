<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?php echo site_url('assets/common/plugins/datepicker/datepicker3.css'); ?>" >
<script type="text/javascript" src="<?php echo site_url ('assets/common/plugins/datepicker/bootstrap-datepicker.js'); ?>" ></script>
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
							<div class="form-group">
							  <label for="name" class="col-sm-4 control-label"><?php echo lang('name'); ?></label>
							  <div class="col-sm-8">
								<input type="text" name="name" class="form-control" id="name" value="<?php echo (!empty ($row->name)) ? $row->name : set_value('name');  ?>">
							  </div>
							</div>
							<div class="form-group">
							  <label for="exam_scheme_id" class="col-sm-4 control-label"><?php echo lang('exam_scheme'); ?></label>
							  <div class="col-sm-8">
								<select class="form-control" id="exam_scheme_id" name="exam_scheme_id">
									<?php if (!empty ($schemes)) { foreach ($schemes as $scheme) {
											$sel = '';
											if ($scheme->id == $row->exam_scheme_id){
												$sel = 'selected="selected"';
											}
									 ?>
									<option value="<?php echo $scheme->id ?>" <?php echo $sel; ?>><?php echo ucwords($scheme->name) ?></option>
									<?php }} ?>
								</select>
							  </div>
							</div>
							<div class="form-group">
							  <label for="grade_scheme_id" class="col-sm-4 control-label"><?php echo lang('grade').' '.lang('scheme'); ?></label>
							  <div class="col-sm-8">
								<select class="form-control" id="grade_scheme_id" name="grade_scheme_id">
									<?php if (!empty ($grade_schemes)) { foreach ($grade_schemes as $grade_scheme) {
											$sel = '';
											if ($grade_scheme->id == $row->grade_scheme_id){
												$sel = 'selected="selected"';
											}
									 ?>
									<option value="<?php echo $grade_scheme->id ?>" <?php echo $sel; ?>><?php echo ucwords($grade_scheme->name) ?></option>
									<?php }} ?>
								</select>
							  </div>
							</div>
							<div class="form-group">
							  <label for="passing_percentage" class="col-sm-4 control-label"><?php echo lang('passing_percentage'); ?></label>
							  <div class="col-sm-8">
								<input type="text" name="passing_percentage" class="form-control" id="passing_percentage" value="<?php echo (!empty ($row->passing_percentage)) ? $row->passing_percentage : set_value('passing_percentage');  ?>">
							  </div>
							</div>
							<div class="form-group">
							  <label for="result_date" class="col-sm-4 control-label"><?php echo lang('result_date'); ?></label>
							  <div class="col-sm-8">
								<input type="text" name="result_date" class="form-control datepicker" id="result_date" value="<?php echo (@$row->result_date != '0000-00-00') ? @$row->result_date : set_value('result_date');  ?>">
							  </div>
							</div>
							<div class="form-group">
							  <label for="url" class="col-sm-4 control-label"><?php echo lang('url'); ?></label>
							  <div class="col-sm-8">
								<input type="text" name="url" class="form-control" id="url" value="<?php echo (!empty ($row->url)) ? $row->url : set_value('url');  ?>">
							  </div>
							</div>
						</div>
					  </div>
					<div class="box-footer">
						<a href="<?php echo site_url ('admin/marksheet'); ?>" class="btn btn-default btn-flat"><?php echo lang('cancel') ?></a>
						<input type="submit" class="btn bg-purple btn-flat" name="submit" value="<?php echo lang('save') ?>" >
					</div>
				</form>
		  </div>
		</div>
	   </div>
	<section> 
   </div>		  
   <script>
   	$('.datepicker').datepicker({
		autoclose : true ,
		format: "yyyy-mm-dd",
	});
   </script>