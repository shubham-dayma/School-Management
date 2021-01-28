<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?php echo site_url('assets/common/plugins/iCheck/line/purple.css'); ?>" >
<script type="text/javascript" src="<?php echo site_url ('assets/common/plugins/iCheck/icheck.js'); ?>" ></script>

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
						</div>
						<div class="col-md-6">
							
							<?php if (!empty($classes)) { foreach ($classes as $class) { 
								$check = '';
								if (@in_array($class->id,@json_decode($row->classes))){
									$check = 'checked="checked"';
								}
							?>
							<div class="form-group">
								 <input type="checkbox" name="classes[]" value="<?php echo $class->id;  ?>" <?php echo $check  ?> >
								 <label><?php echo ucwords ($class->name) ?></label> 	
							</div>
							<?php } }?>
						</div>
					  </div>
					<div class="box-footer">
						<a href="<?php echo site_url ('admin/grade_scheme'); ?>" class="btn btn-default btn-flat"><?php echo lang('cancel') ?></a>
						<input type="submit" class="btn bg-purple btn-flat" name="submit" value="<?php echo lang('save') ?>" >
					</div>
				</form>
		  </div>
		</div>
	   </div>
	<section> 
   </div>		  
   <script type="text/javascript">
	 $('input').each(function(){
		var self = $(this),
		  label = self.next(),
		  label_text = label.text();
	
		label.remove();
		self.iCheck({
		  checkboxClass: 'icheckbox_line-purple',
		  radioClass: 'iradio_line-purple',
		  insert: '<div class="icheck_line-icon"></div>' + label_text
		});
	  });
  </script>