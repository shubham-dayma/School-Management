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
			 <?php if (!empty ($marks_entered)) { ?>
			 <div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-ban"></i> Alert!</h4>
				<?php print_r ($marks_entered); ?>
			 </div>
			 <?php } ?>
			 <form class="form-horizontal" method="post">
					  <div class="box-body">
					  	<div class="col-md-4">
							<?php if (!empty ($result)) { foreach ($result as $row) { 
								$check = '';
								if (@in_array ($row->id,json_decode(@$class_subjects->subjects))){
									$check = 'checked="checked"';
								}
							?>
							<div class="form-group">
							 <input type="checkbox" name="subjects[]" class="subject"  value="<?php echo $row->id;  ?>" <?php echo $check  ?> >
							 <label><?php echo ucwords ($row->name) ?></label> 	
							</div>
							<?php } }?>
						</div>
					  </div>
					<div class="box-footer">
						<a href="<?php echo site_url ('admin/graded_subjects/list_classes'); ?>" class="btn btn-default btn-flat"><?php echo lang('cancel') ?></a>
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
  $('.subject').on('ifUnchecked',function (){
  	var this_sub = $('.subject');
	call_loader();
	$.ajax ({
			url:'<?php echo site_url('admin/graded_subjects/check_marks_entery'); ?>',
				type:'Post',
				data:{subject_id:$(this).val(),class_id:<?php echo $this->uri->segment(4); ?>},
				success : function (result){
					remove_loader();
					if (result == 0) {
						alert ('<?php echo lang('marks_are_entered_for_this_subject') ?>');
						$(this_sub).iCheck('check');
					}
				}	
	});
  });
 </script>  