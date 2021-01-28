<?php //STAFF FORM
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?php echo site_url('assets/common/plugins/iCheck/line/blue.css'); ?>" >
<link rel="stylesheet" href="<?php echo site_url('assets/common/plugins/datepicker/datepicker3.css'); ?>" >
<link rel="stylesheet" href="<?php echo site_url('assets/common/plugins/select2/css/select2.min.css'); ?>" >
<script type="text/javascript" src="<?php echo site_url ('assets/common/plugins/datepicker/bootstrap-datepicker.js'); ?>" ></script>
<script type="text/javascript" src="<?php echo site_url ('assets/common/plugins/select2/js/select2.full.min.js'); ?>" ></script>
<script type="text/javascript" src="<?php echo site_url ('assets/common/plugins/iCheck/icheck.js'); ?>" ></script>
<style>
.icheckbox_line-blue, .iradio_line-blue {
background: #605ca8 !important;
webkit-border-radius: 0px !important;
border-radius: 0px !important;
}
.iradio_line-blue { margin-right:10px;} 
.custom-addon{position:absolute; right: 15px; border-radius: 0px; padding: 9px 15px;}
.right-border{border-right:1px solid #ccc !important; }
.custom-addon i{margin: -5px;}
.select2-container--default .select2-selection--multiple .select2-selection__choice{background-color: #605ca8;}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove{color: #fff;}
.select2-container--default .select2-selection--multiple{border-radius: 0px;}
.select2-container .select2-selection--single .select2-selection__rendered{margin-top: -7px;}
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
				  <form class="form-horizontal" enctype="multipart/form-data" method="post">
					  <div class="box-body">
					  	<div class="col-md-6">
							<div class="form-group"> 
							  <label for="fname" class="col-sm-4 control-label"><?php echo lang('first').' '.lang('name'); ?></label>
							  <div class="col-sm-8">
								<input type="text" name="fname" class="form-control" id="fname" value="<?php echo (!empty ($row->fname)) ? $row->fname : set_value('fname');  ?>">
							  </div>
							</div>
							<div class="form-group">
							  <label for="lname" class="col-sm-4 control-label"><?php echo lang('last').' '.lang('name'); ?></label>
							  <div class="col-sm-8">
								<input type="text" name="lname" class="form-control" id="lname" value="<?php echo (!empty ($row->lname)) ? $row->lname : set_value('lname');  ?>">
							  </div>
							</div>
							<div class="form-group">
							  <label for="gender" class="col-sm-4 control-label"><?php echo lang('gender'); ?></label>
							  <div class="col-sm-8" style="display: flex;">
							  	<input type="radio" name="gender" checked="checked" value="0"><label><?php echo lang('male'); ?></label>
								<input type="radio" name="gender" <?php echo (@$row->gender == 1) ? 'checked="checked"' : ''; ?> value="1" id="gender"><label><?php echo lang('female'); ?></label>
							  </div>
							</div>
							<div class="form-group">
							  <label for="phone" class="col-sm-4 control-label"><?php echo lang('phone'); ?></label>
							  <div class="col-sm-8">
								<input type="number" name="phone" class="form-control" id="phone" value="<?php echo (!empty ($row->phone)) ? $row->phone : set_value('phone');  ?>">
							  </div>
							</div>
							<div class="form-group">
							  <label for="email" class="col-sm-4 control-label"><?php echo lang('email'); ?></label>
							  <div class="col-sm-8">
								<input type="email" name="email" class="form-control" id="email" value="<?php echo (!empty ($row->email)) ? $row->email : set_value('email');  ?>" <?php echo (!empty($row)) ? 'readonly' : '' ?>>
							  </div>
							</div>
							<div class="form-group">
							  <label for="password" class="col-sm-4 control-label"><?php echo lang('password'); ?></label>
							  <div class="col-sm-8">
								<input type="password" name="password" class="form-control" id="password" 
								value="<?php echo set_value('password');  ?>">
							  </div>
							</div>
							<div class="form-group">
							  <label for="c_password" class="col-sm-4 control-label"><?php echo lang('confirm').' '.lang('password'); ?></label>
							  <div class="col-sm-8">
								<input type="password" name="c_password" class="form-control" id="c_password" value="">
							  </div>
							</div>
							<div class="form-group date">
								<label for="dob" class="col-sm-4 control-label"><?php echo lang('dob'); ?></label>
								<div class="col-sm-8">
									<div class="input-group-addon custom-addon right-border"><i class="fa fa-calendar"></i> </div>
    								<input type="text" class="form-control pull-right" name="dob" id="dob" value="<?php echo (!empty ($row->dob)) ? $row->dob : set_value('dob'); ?>" />
    							</div>
							</div>   
							<div class="form-group">
							  <label for="qulification" class="col-sm-4 control-label"><?php echo lang('qulification'); ?></label>
							  <div class="col-sm-8">
								<input type="text" name="qulification" class="form-control" id="qulification" value="<?php echo (!empty ($row->qulification)) ? $row->qulification : set_value('qulification');  ?>">
							  </div>
							</div> 
							<div class="form-group">
							  <label for="qulification" class="col-sm-4 control-label"><?php echo lang('extra_qulification'); ?></label>
							  <div class="col-sm-8">
								<input type="text" name="extra_qulification" class="form-control" id="extra_qulification" value="<?php echo (!empty ($row->extra_qulification)) ? $row->extra_qulification : set_value('extra_qulification');  ?>">
							  </div>
							</div> 
							<div class="form-group">
							  <label for="qulification" class="col-sm-4 control-label"><?php echo lang('work_experiance'); ?></label>
							  <div class="col-sm-8">
								<input type="text" name="work_experiance" class="form-control" id="work_experiance" value="<?php echo (!empty ($row->work_experiance)) ? $row->work_experiance : set_value('work_experiance');  ?>">
							  </div>
							</div> 
							<div class="form-group date">
								<label for="doj" class="col-sm-4 control-label"><?php echo lang('doj'); ?></label>
								<div class="col-sm-8">
									<div class="input-group-addon custom-addon right-border"><i class="fa fa-calendar"></i> </div>
    								<input type="text" class="form-control pull-right" name="doj" id="doj" value="<?php echo (!empty ($row->doj)) ? $row->doj : set_value('doj'); ?>" />
    								
    							</div>
							</div>                
							<div class="form-group">
							  <label for="address" class="col-sm-4 control-label"><?php echo lang('address'); ?></label>
							  <div class="col-sm-8">
								<textarea name="address" rows="5" class="form-control" id="address"> <?php echo (!empty ($row->address)) ? $row->address : set_value('address');?></textarea>
							  </div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="photo"><?php echo lang('photo'); ?></label>
								<div class="col-sm-6">
									<input type="file" class="form-control" name="img" id="photo"/>
									<?php  echo @$row->photo; ?>
								</div>
								<div class="col-sm-2">
									<?php if (!empty ($row->photo)){ ?>
										<img src="<?php echo site_url('upload/staff/staff_img/'.$row->photo); ?>" style=" width:100%; height:30px;"/>
									<?php } ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="id_proof"><?php echo lang('id_proof'); ?></label>
								<div class="col-sm-6">
									<input type="file" class="form-control" name="id_proof" id="id_proof" />
									<?php  echo @$row->id_proof; ?>
								</div>
								<div class="col-sm-2">
									<?php if (!empty ($row->id_proof)){ ?>
										<img src="<?php echo site_url('upload/staff/staff_id/'.$row->id_proof); ?>" style=" width:100%; height:30px;"/>
									<?php } ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="staff_category"><?php echo  lang('staff').' '.lang('category'); ?></label>
								<div class="col-sm-8">
									<select class="form-control " name="staff_category" id="staff_category">
										<?php foreach ($staff_categories as $staff_cat) { ?>
											   <option value=" <?php echo $staff_cat->id ?>" <?php echo (@$staff_cat->id == @$row->staff_category) ? 'selected="selected"' : ''; ?> > 
											   <?php echo ucwords($staff_cat->name) ?>
											   </option>
										<?php }
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" for="assigned_subject"><?php echo  lang('assigned').' '.lang('subject'); ?></label>
								<div class="col-sm-8">
									<select class="form-control select2" multiple name="assigned_subject[]" id="assigned_subject">
									<?php if(!empty($subjects)) { foreach ($subjects as $subject) { ?>
										<option value="<?php echo $subject->id ?>" <?php echo @(in_array($subject->id , json_decode(@$row->assigned_subject))) ? 'selected = "selected"' : '' ?>><?php echo ucwords($subject->name); ?></option>
									<?php }} ?>
										
										<?php /*
										if( empty($row->id) )
											{
												foreach ($subjects as $subject) { 

												  echo '<option value="'.$subject->id.'" >'.ucwords($subject->name).'</option>';
												}
											}	
											 if( !empty($row->id) )
											{
												$subj = (json_decode($row->assigned_subject, true));
												
												foreach ($subjects as $subject ) { ?>
													<option value="<?php echo $subject->id; ?>"
													<?php 
														foreach ($subj as $subj_id ) {  
															if ($subj_id == $subject->id) { echo "selected"; } 
														}
													?> 
													>
													<?php echo ucwords($subject->name);?>	
													</option>  
													<?php												 
												}
											}	 
											
										*/ ?>
									</select>
								</div>
							</div>
							<div class="form-group">
							  <label for="login_status" class="col-sm-4 control-label"><?php echo lang('login').' '.lang('status'); ?></label>
							  <div class="col-sm-8" style="display: flex;">
							  	<input type="radio" name="login_status" checked="checked" value="0"><label><?php echo lang('active'); ?></label>
								<input type="radio" name="login_status" <?php echo (@$row->login_status == 1) ? 'checked="checked"' : ''; ?> value="1" id="login_status"><label><?php echo lang('inactive'); ?></label>
							  </div>
							</div>
						</div>
					  </div>
					<div class="box-footer">
						<a href="<?php echo site_url ('admin/staff'); ?>" class="btn btn-default btn-flat"><?php echo lang('cancel') ?></a>
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
  $('input').each(function(){
    var self = $(this),
      label = self.next(),
      label_text = label.text();

    label.remove();
    self.iCheck({
      checkboxClass: 'icheckbox_line-red',
      radioClass: 'iradio_line-blue',
      insert: '<div class="icheck_line-icon"></div>' + label_text
    });
  });

    
	$('#doj').datepicker({
		autoclose : true ,
		format: "yyyy/mm/dd",
	});
	$('#dot').datepicker({
		autoclose : true ,
		format: "yyyy/mm/dd",
	});
	$('#dob').datepicker({
		autoclose : true ,
		format: "yyyy/mm/dd",
	});
	 $(".select2").select2();
});
</script>      