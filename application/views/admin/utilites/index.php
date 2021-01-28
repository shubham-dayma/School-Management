<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<link rel="stylesheet" href="<?php echo site_url('assets/common/plugins/iCheck/flat/purple.css'); ?>" >
<script type="text/javascript" src="<?php echo site_url ('assets/common/plugins/iCheck/icheck.js'); ?>" ></script>
   <div class="content-wrapper">
                <section class="content-header">
                    <h1><?php echo $page_title; ?></h1>
                    <?php echo $breadcrumb; ?>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                     <li class="active"> <a href="<?php echo site_url('admin/utilites'); ?>"><?php echo lang('pramote/demote') ?> </a></li>
                                	 <li><a href="<?php echo site_url('admin/utilites/db_backup'); ?>"><?php echo lang('db_backup'); ?> </a></li>	
									 <li> <a href="<?php echo site_url('admin/utilites/import_new_session'); ?>">
									   	<?php echo lang('import_data_new_session') ?> </a>
									 </li>
									 <li> <a href="<?php echo site_url('admin/utilites/change_password'); ?>"><?php echo lang('change_password') ?> </a></li>
								</ul>
                                <div class="tab-content">
									<div class="tab-pane active">
									 <?php if (!empty (validation_errors())) { ?>
										 <div class="alert alert-danger alert-dismissible">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
											<h4><i class="icon fa fa-ban"></i> <?php echo lang('alert'); ?></h4>
											<?php echo validation_errors(); ?>
										 </div>
									 <?php } ?>
									<form method="post">
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-3">
												<label><?php echo lang('current_session').' : ' ?></label>
												<label><?php echo $current_session->caption ?></label>
											</div>
											<div class="col-md-2">
												<label><?php echo lang('class').' : ' ?></label>
												<!--<select name="section_id" onchange="form.submit()">-->
													<select name="section_id">
													<option value=""><?php echo lang('select_class') ?></option>
													<?php if (!empty ($current_session_classes)) { foreach ($current_session_classes as $current_session_class)  {
															$sections = $this->custom_lib->get_where('sections','class_id',$current_session_class->id)->result();
															if (!empty ($sections)) { foreach ($sections as $section) {
																$sel = '';
																if (set_value('section_id') == $section->id){
																	$sel = 'selected="selected"';
																}
													 ?>
													<option value="<?php echo $section->id ?>" <?php echo $sel; ?>><?php echo  $current_session_class->name.' '.$section->name ?></option>
													<?php }} }}?>
												</select>
											</div>	
											<div class="col-md-1">
												<label class=""><?php echo lang('to')?></label>
											</div>
											<div class="col-md-3">
												<label><?php echo lang('sessions').' : ' ?></label>
												<select name="pd_session_id" id="pd_session_id" required>
													<option value=""><?php echo lang('select_session') ?></option>
													<?php if (!empty($sessions)) { foreach ($sessions as $session) { 
															$sel = '';
															if (set_value('pd_session_id') == $session->id){
																$sel = 'selected="selected"';
															}
															if ($current_session->id != $session->id) {
													?>
													<option value="<?php echo $session->id ?>" <?php echo $sel; ?> ><?php echo $session->caption ?></option>
													<?php }}} ?>
												</select>
											</div>
											<div class="col-md-2">
												<label><?php echo lang('class').' : ' ?></label>
												<select name="pd_section_id" id="pd_section_id" required>
													<option value=""><?php echo lang('select_session') ?></option>
													<?php if (!empty ($new_session_classes)) { foreach ($new_session_classes as $new_session_class) { 
															$sections = $this->custom_lib->get_where('sections','class_id',$new_session_class->id)->result();
															if (!empty ($sections)) { foreach ($sections as $section) {
																$sel = '';
																if (set_value('pd_section_id') == $section->id){
																	$sel = 'selected="selected"';
																}
													 ?>
													<option value="<?php echo $section->id ?>" <?php echo $sel; ?>><?php echo  $new_session_class->name.' '.$section->name ?>
													</option>
													<?php }} }}?>
												</select>
											</div>
											<div class="col-md-1">
												<input type="submit" name="search"  class="btn bg-purple btn-flat" value="<?php echo lang('search') ?>" /> 
											</div>			
										</div>
									 </div>
									<?php if (!empty ($students)){ ?>
									<div class="row">
									   <div class="col-md-12">
										   <div class="box-body">
											<table class="table table-bordered table-striped">
												<thead>
													<tr>
													  <th><input type="checkbox" id="check_all" /></th>
													  <th><?php echo lang('enrol_no') ?></th>
													   <th><?php echo lang('roll_no') ?></th>
													  <th><?php echo lang('student').' '.lang('name') ?></th>
													  <th><?php echo lang('father').' '.lang('name') ?></th>
													</tr>
												</thead>
												<tbody>
													<?php $i = 0; foreach ($students as $student) { $i++; ?>
													<tr>
													  <td><input type="checkbox" name="student_id[]" class="check" value="<?php echo $student->id ?>" /></td>
													  <td><?php echo $student->enrol_no ?></td>
													  <td><?php echo $student->roll_no ?></td>
													  <td><?php echo ucwords ($student->fname.' '.$student->lname) ?></td>
													  <td><?php echo $student->f_name; ?></td>
													</tr>
													<?php } ?>
												</tbody>
											 </table>
											</div>
											<div class="box-footer">
												<input type="submit" class="btn bg-purple btn-flat" name="save" value="<?php echo lang('save') ?>" >
											</div>
										</div>
									</div>
									<?php } ?>
									</form>
								  </div>	
                                </div>
                            </div>
                         </div>
                    </div>
                </section>
            </div>
<script type="text/javascript">
$(document).ready(function (){
	$('#pd_session_id').on('change',function (){
		if($(this).val() != ''){
			call_loader();
			$.ajax ({
				url:'<?php echo site_url('admin/utilites/session_sections_ajax'); ?>',
				type:'Post',
				data:{pd_session_id:$(this).val()},
				success : function (result){
					
					if (result != ''){
						$('#pd_section_id').append(result);
					}
					remove_loader();
				}	
		    });
		}
	});	
	$('#check_all').on('ifChecked',function (){
		$('.check').iCheck('check');
	});
	$('#check_all').on('ifUnchecked',function (){
		$('.check').iCheck('uncheck');
	});
	$('input').iCheck({
    	checkboxClass: 'icheckbox_flat-purple'
  	});
});	
</script>
