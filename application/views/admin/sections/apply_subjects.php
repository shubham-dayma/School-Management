 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?php echo site_url('assets/common/plugins/iCheck/line/blue.css'); ?>" >
<script type="text/javascript" src="<?php echo site_url ('assets/common/plugins/iCheck/icheck.js'); ?>" ></script>
<style type="text/css">
	.icheckbox_line-blue, .iradio_line-blue {
margin: 5px 0px;
background: #605ca8 !important;
webkit-border-radius: 0px !important;
border-radius: 0px !important;
}
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
			 	<form class="form-horizontal" method="post">
					  <div class="box-body">
					  	<div class="col-md-6">
							<?php if (!empty($subjects)) { foreach ($subjects as $subject) { if (@in_array ($subject->id,json_decode($class_subjects))) {?>
								<div>
									<input type="checkbox" name="subjects[]" <?php echo (@in_array ($subject->id,json_decode($row->subjects))) ? 'checked="checked"' : '' ?> value="<?php echo $subject->id ?>" />
									<label><?php echo $subject->subject_code.' - '.$subject->name ?></label>
								</div>
							<?php }}} ?>
						</div>
					</div>
					<div class="box-footer">
						<a href="<?php echo site_url ('admin/sections'); ?>" class="btn btn-default btn-flat"><?php echo lang('cancel') ?></a>
						<input type="submit" class="btn bg-purple btn-flat" name="submit" value="<?php echo lang('save') ?>" >
					</div>
				</form>
		  </div>
		</div>
	   </div>
	<section> 
   </div>		
   <script type="text/javascript">$('input').each(function(){
	    var self = $(this),
	      label = self.next(),
	      label_text = label.text();

	    label.remove();
	    self.iCheck({
	      checkboxClass: 'icheckbox_line-blue',
	      radioClass: 'iradio_line-blue',
	      insert: '<div class="icheck_line-icon"></div>' + label_text
	    });
  	});</script>  
 