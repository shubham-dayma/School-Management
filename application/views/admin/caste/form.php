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
							  <label for="name" class="col-sm-4 control-label"><?php echo lang('cast'); ?></label>
							  <div class="col-sm-8">
								<input type="text" name="name" class="form-control" id="name" value="<?php echo (!empty ($row->name)) ? $row->name : set_value('name');  ?>">
							  </div>
							</div>
							<div class="form-group">
							  <label for="desc" class="col-sm-4 control-label"><?php echo lang('desc'); ?></label>
							  <div class="col-sm-8">
								<textarea name="desc" rows="5" class="form-control" id="desc"><?php echo (!empty ($row->desc)) ? $row->desc : set_value('desc');?></textarea>
							  </div>
							</div>
						</div>
					  </div>
					<div class="box-footer">
						<a href="<?php echo site_url ('admin/caste'); ?>" class="btn btn-default btn-flat"><?php echo lang('cancel') ?></a>
						<input type="submit" class="btn bg-purple btn-flat" name="submit" value="<?php echo lang('save') ?>" >
					</div>
				</form>
		  </div>
		</div>
	   </div>
	<section> 
   </div>		  