<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<link  href="<?php echo site_url('assets/common/plugins/iCheck/flat/purple.css'); ?>"  rel="stylesheet" />
<link  href="<?php echo site_url('assets/common/bootstrap/css/bootstrap.vertical-tabs.css'); ?>"  rel="stylesheet" />
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
          		<div class="row">
	            	<div class="col-xs-3"> 
					 <ul class="nav nav-tabs tabs-left"><!-- 'tabs-right' for right tabs -->
						<?php if (!empty ($roles)) { foreach ($roles as $role) {  ?>
						<li class="<?php echo ($this->uri->segment(4) == $role->id) ? 'active' :'' ?>">
							<a href="<?php  echo site_url('admin/staff_role/index/'.$role->id.'?staff_cat=2') ?>"><?php echo ucwords ($role->name) ?></a>
						</li>
						<?php }}?>
					 </ul>
					</div>
					<div class="col-xs-9">
						<div class="tab-content">
						  <div class="tab-pane active">
						  		<h3 class="box-title">
									<form method="get">
										<select class="" name="staff_cat" onchange="form.submit()" style="padding: 5px 20px;">
											<?php if(!empty($staff_categories)) { foreach ($staff_categories as $staff_category) { 
													$check = '';
													if($a_staff_cat == $staff_category->id ){
														$check = 'selected="selected"';
													}
											 ?>
											<option value="<?php echo $staff_category->id ?>" <?php echo $check ?>><?php echo $staff_category->name ?></option>
											<?php }} ?>
										</select>
									</form>
								</h3>
								<form method="post">
									<div class="box-body">
										<table id="example1" class="table table-bordered table-striped">
											<thead>
												<tr>
												 <th><?php echo lang('action') ?></th>
												  <th><?php echo lang('staff').' '.lang('name') ?></th>
												</tr>
											</thead>
											<tbody>
												<?php if (!empty($staffs)) { 
															foreach ($staffs as $staff) { 
																$check = '';
																foreach ($staff_roles as $staff_role){
																	if ($staff->id == $staff_role->staff_id){
																		$check = 'checked="checked"';
																	}
																}
												?>
												<tr>
												  <td><input type="checkbox" name="satff_id[]" class="remove_staff" value="<?php echo $staff->id ?>" <?php echo $check; ?> /></td>
												  <td><?php echo ucwords ($staff->fname.' '.$staff->lname); ?></td>
												</tr>
												<?php }} ?>
											</tbody>
											<tfoot>
												<tr>
												  <th><?php echo lang('action') ?></th>
												  <th><?php echo lang('staff').' '.lang('name') ?></th>
												</tr>
											</tfoot>
										</table>
									</div>
								</form>
						  </div>
						</div>
					</div>
				</div>
			</div>	
		</div>
      </div>
    </section>
  </div>
<script>
$(document).ready(function(){
  $('input').iCheck({
    checkboxClass: 'icheckbox_flat-purple',
    radioClass: 'iradio_flat-purple'
  });
  $('.remove_staff').on('ifUnchecked',function (){
  	call_loader();
	$.ajax ({
		url:'<?php echo site_url('admin/staff_role/remove_staff_role'); ?>',
		type:'Post',
		data:{staff_id:$(this).val(),role_id:<?php echo $this->uri->segment(4); ?>},
		success : function (result){
			remove_loader();
			//alert (result);
		}	
	});
  });
  $('.remove_staff').on('ifChecked',function (){
  	call_loader();
	$.ajax ({
		url:'<?php echo site_url('admin/staff_role/add_staff_role'); ?>',
		type:'Post',
		data:{staff_id:$(this).val(),role_id:<?php echo $this->uri->segment(4); ?>},
		success : function (result){
			remove_loader();
			//alert (result);
		}	
	});
  });
});
</script>