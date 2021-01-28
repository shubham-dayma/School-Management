<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?php echo site_url('assets/common/plugins/select2/css/select2.min.css'); ?>" >
<link rel="stylesheet" href="<?php echo site_url('assets/common/plugins/iCheck/line/blue.css'); ?>" >
<link rel="stylesheet" href="<?php echo site_url('assets/common/plugins/iCheck/flat/purple.css'); ?>" >
<link rel="stylesheet" href="<?php echo site_url('assets/common/plugins/datepicker/datepicker3.css'); ?>" >
<script type="text/javascript" src="<?php echo site_url ('assets/common/plugins/datepicker/bootstrap-datepicker.js'); ?>" ></script>
<script type="text/javascript" src="<?php echo site_url ('assets/common/plugins/iCheck/icheck.js'); ?>" ></script>
<script type="text/javascript" src="<?php echo site_url ('assets/common/plugins/select2/js/select2.full.min.js'); ?>" ></script>
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

.select2-container--default .select2-selection--single { border-radius: 0px;padding-bottom: 26px;border: 1px solid #d2d6de;}

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
				  <form class="form-horizontal" method="post" enctype="multipart/form-data">
					<div class="box-body">
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#student_info"><?php echo lang('student').' '.lang('info') ?></a></li>
							<li><a data-toggle="tab" href="#parent_info"><?php echo lang('gardian').' '.lang('info'); ?></a></li>
						</ul>
						 <div class="tab-content">
							<div id="student_info" class="tab-pane fade in active">
							  	<div class="row" style="padding: 15px;">
									<div class="col-md-6">
										<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('class_section'); ?></label>
										  <div class="col-sm-8">
											<select class="form-control" name="class_section" >
												<?php if (!empty ($classes)) { 
														foreach ($classes as $class) { 
															$sections = $this->custom_lib->get_where('sections','class_id',$class->id)->result();
															$sel = '';
															if (!empty ($sections)){
																foreach ($sections as $section){
																	$sel = '';
																	if($section->id == $active_section) {
																		$sel = 'selected="selected"';
																	}
												?>
												<option value="<?php echo $class->id.','.$section->id ?>" <?php echo $sel ?>><?php echo $class->name.' '.$section->name ?></option>
												<?php }}}} ?>
											</select>
										  </div>
										</div>
										<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('gender'); ?></label>
										  <div class="col-sm-8" style="display: flex;">
												<input type="radio" name="gender" class="gender_title" value="0" checked="checked" required>
										 	<label><?php echo lang('male'); ?></label>
											<input type="radio" name="gender" class="gender_title"  value="1" <?php echo (@$row->gender == 1) ? 'checked="checked"' :'' ?> required>
										 	<label><?php echo lang('female'); ?></label>
										  </div>
										</div>
										<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('title'); ?></label>
										  <div class="col-sm-8">
											<select class="form-control" name="title" id="title">
												<?php if (!empty($titles)) { foreach ($titles as $title){
														$sel = '';
														if($title->id == $row->title){
															$sel = 'selected="selected"';
														}
												 ?>
												<option value="<?php echo $title->id ?>" <?php echo $sel ; ?>><?php echo ucwords($title->name); ?></option>
												<?php }} ?>
											</select>
										  </div>
										</div>
										<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('first').' '.lang('name'); ?></label>
										  <div class="col-sm-8">
											<input type="text" name="fname" class="form-control" value="<?php echo (!empty ($row->fname)) ? $row->fname : set_value('fname') ?>">
										  </div>
										</div>
										<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('middle').' '.lang('name'); ?></label>
										  <div class="col-sm-8">
											<input type="text" name="mname" class="form-control" value="<?php echo (!empty ($row->mname)) ? $row->mname : set_value('mname') ?>">
										  </div>
										</div>
										<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('last').' '.lang('name'); ?></label>
										  <div class="col-sm-8">
											<input type="text" name="lname" class="form-control" value="<?php echo (!empty ($row->lname)) ? $row->lname : set_value('lname') ?>">
										  </div>
										</div>
										<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('email'); ?></label>
										  <div class="col-sm-8">
											<input type="email" name="s_email" class="form-control" 
											value="<?php echo (!empty ($row->s_email)) ? $row->s_email : set_value('s_email') ?>" <?php echo (!empty($row)) ? 'readonly' : '' ?>  />
										  </div>
										</div>
										<div class="form-group"> 
											<label for="name" class="col-sm-4 control-label"><?php echo lang('phone'); ?></label>
											 <div class="col-sm-8">
												<input type="number" name="s_mobile" class="form-control" value="<?php echo (!empty ($row->s_mobile)) ? $row->s_mobile : set_value('s_mobile') ?>">
											 </div>
										</div>
										<div class="form-group date"> 
											<label for="name" class="col-sm-4 control-label"><?php echo lang('dob'); ?></label>
											 <div class="col-sm-8">
											 	<div class="input-group-addon custom-addon right-border"><i class="fa fa-calendar"></i> </div>
												<input type="text" name="dob" class="form-control" id="dob" value="<?php echo (!empty ($row->dob)) ? $row->dob : set_value('dob') ?>">
											 </div>
										</div>
										<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('student').' '.lang('img'); ?></label>
										  <div class="col-sm-8">
											<input type="file" name="s_img" class="form-control">
											<?php echo @$row->s_img ?>
										   </div>
										</div>
										<div class="form-group"> 
											<label for="name" class="col-sm-4 control-label"><?php echo lang('enrol_no'); ?></label>
											 <div class="col-sm-8">
												<?php if (empty ($row) && $this->as->auto_enroll_no == 1) { ?>
													<input type="text" name="enrol_no" class="form-control" 
													 value="<?php echo $this->session_student_section->get_enrol_no(); ?>" readonly>
												<?php }?>
												<?php if (empty ($row) && $this->as->auto_enroll_no == 0) { ?>
													<input type="text" name="enrol_no" class="form-control" value="<?php echo set_value('enrol_no') ?>">
												<?php } ?>
												<?php if (!empty ($row)) {?>
													<input type="text" name="enrol_no" class="form-control" value="<?php echo $row->enrol_no  ?>" readonly>
												<?php } ?>
											</div>
										</div>
										<?php if($this->as->auto_roll_no == 0){ ?>
										<div class="form-group"> 
											<label for="name" class="col-sm-4 control-label"><?php echo lang('roll_no'); ?></label>
											 <div class="col-sm-8">
												<input type="text" name="roll_no" class="form-control" value="<?php echo (!empty ($row->roll_no)) ? $row->roll_no : set_value('roll_no') ?>">
											</div>
										</div>
										<?php } ?>
										<?php if($this->as->enrol_reg == 0) { ?>
										<div class="form-group"> 
											<label for="name" class="col-sm-4 control-label"><?php echo lang('registration_no'); ?></label>
											 <div class="col-sm-8">
												<input type="text" name="registration_no" class="form-control" value="<?php echo (!empty ($row->registration_no)) ? $row->registration_no : set_value('registration_no') ?>">
											</div>
										</div>
										<?php } ?>
										<div class="form-group date"> 
											<label for="name" class="col-sm-4 control-label"><?php echo lang('admit_date'); ?></label>
											 <div class="col-sm-8">
											 	<div class="input-group-addon custom-addon right-border"><i class="fa fa-calendar"></i> </div>
												<input type="text" name="admit_date" id="admit_date" class="form-control" value="<?php echo (!empty ($row->admit_date)) ? $row->admit_date : set_value('admit_date') ?>">
											</div>
										</div>
										<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('nationality'); ?></label>
										  <div class="col-sm-8">
											<select class="form-control" name="nationality" >
												<?php if (!empty ($nationalities)) { foreach ($nationalities as $nationalitie) { 
														$sel ='';
														if ($nationalitie->id == $row->nationality){
															$sel = 'selected="selected"';
														}
												?>
												<option value="<?php echo $nationalitie->id ?>" <?php echo $sel ?>><?php echo ucwords ($nationalitie->name); ?></option>
												<?php } }?>
											</select>
										  </div>
										</div>
										<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('religion'); ?></label>
										  <div class="col-sm-8">
											<select class="form-control" name="religion" >
												<?php if (!empty ($religions)) { foreach ($religions as $religion) { 
														$sel ='';
														if ($religion->id == $row->religion){
															$sel = 'selected="selected"';
														}
												?>
												<option value="<?php echo $religion->id ?>" <?php echo $sel ?>><?php echo ucwords ($religion->name); ?></option>
												<?php }} ?>
											</select>
										  </div>
										</div>
										<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('cast'); ?></label>
										  <div class="col-sm-8">
											<select class="form-control" name="cast" >
												<?php if (!empty ($castes)) { foreach ($castes as $caste) { 
														$sel ='';
														if ($caste->id == $row->cast){
															$sel = 'selected="selected"';
														}
												?>
												<option value="<?php echo $caste->id ?>" <?php echo $sel ?>><?php echo ucwords ($caste->name); ?></option>
												<?php }} ?>
											</select>
										  </div>
										</div>
										<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('category'); ?></label>
										  <div class="col-sm-8">
											<select class="form-control" name="category" >
												<?php if (!empty ($categories)) { foreach ($categories as $categorie) { 
														$sel ='';
														if ($categorie->id == $row->category){
															$sel = 'selected="selected"';
														}
												?>
												<option value="<?php echo $categorie->id ?>" <?php echo $sel ?>><?php echo ucwords ($categorie->name); ?></option>
												<?php }} ?>
											</select>
										  </div>
										</div>
										<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('country'); ?></label>
										  <div class="col-sm-8">
										  	
											<select class="form-control" name="country" id="country">
												<?php if(!empty ($countries)) { foreach ($countries as $country) { 
														$sel ='';
														if (!empty ($row)){
															if ($country->id == $row->country){
																$sel = 'selected="selected"';
															}
														}
														else{
															if($this->setting->country == $country->id){
																$sel = 'selected="selected"';
															}
														}
												?>
												<option value="<?php echo $country->id ?>" <?php echo $sel; ?>><?php echo $country->name ?></option>
												<?php }} ?>
											</select>
										  </div>
										</div>
										<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('state'); ?></label>
										  <div class="col-sm-8">
											<select class="form-control" name="state" id="state" >
												<?php foreach ($states as $state ) { 
														 $sel ='';
														 if (!empty ($row)){
															 if ($state->id == $row->state){
																	$sel = 'selected="selected"';
															  }	
														  }else{
														  	if($this->setting->state == $state->id){
																$sel = 'selected="selected"';
															}
														  }
												?>
												<option value="<?php echo $state->id; ?>" <?php echo $sel;?> ><?php echo ucwords ($state->name); ?></option>
												<?php } ?>
											</select>
										  </div>
										</div>
										<div class="form-group" id="city_div"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('city'); ?></label>
										  <div class="col-sm-8">
											<select class="form-control" name="city" id="city">
												<?php foreach ($cities as $city ) { 
														$sel ='';
														if (!empty ($row)){
															if ($city->id == $row->city){
																$sel = 'selected="selected"';
															}
														} else {
															if($this->setting->city == $city->id){
																$sel = 'selected="selected"';
															}
														}	
												?>
												<option value="<?php echo $city->id; ?>" <?php echo $sel;?> ><?php echo ucwords ($city->name); ?></option>
												<?php } ?>
											</select>
										  </div>
										</div>
										<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('pincode'); ?></label>
										  <div class="col-sm-8">
											<input type="text" class="form-control" name="pincode" value="<?php echo (!empty ($row->pin_code))? $row->pin_code: set_value('pincode'); ?>" />
										  </div>
										</div>
										<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('adhar_card_no'); ?></label>
										  <div class="col-sm-8">
											<input type="text" class="form-control" name="adhar_card_no" value="<?php echo (!empty ($row->adhar_card_no))? $row->adhar_card_no: set_value('adhar_card_no'); ?>" />
										  </div>
										</div>
										<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('add_sibling'); ?></label>
										  <div class="col-sm-8" id="parent_sib_div">
										  	<?php if (!empty (json_decode (@$row->siblings))) { $i=0; foreach (json_decode ($row->siblings) as $sibling ) { $i++; 
													$sib_student = $this->session_student_section->get_student_short_data($this->session->userdata('academic_session'),$sibling);
													$sec_studs = $this->session_student_section->get_student_section_session_index($this->session->userdata('academic_session'),$sib_student->section_id);
													//echo '<pre>';print_r($sib_student);die;
											?>
											<div>
												<div class="col-sm-4" style="padding-left: 0px;margin-bottom: 3px;">
													<select class="form-control sibling_class" name="sibling_class" >
														<option><?php echo lang('select_class') ?></option>
														<?php if (!empty ($classes)) { 
																foreach ($classes as $class) { 
																	$sections = $this->custom_lib->get_where('sections','class_id',$class->id)->result();
																	if (!empty ($sections)){
																		foreach ($sections as $section){
																			$sel = '';
																			if (@$sib_student->section_id == $section->id ){
																				$sel = 'selected="selected"';
																			}
														?>
														<option value="<?php echo $section->id ?>" <?php echo $sel; ?> ><?php echo $class->name.' '.$section->name ?></option>
														<?php }}}} ?>
													</select>
												</div>
												<div class="col-sm-8 sibling_div" style="margin-bottom: 4px;display: flex;">
													<select class="form-control sibling" name="siblings[]" style="width:100%;" >
														<?php if (!empty ($sec_studs )) { foreach ($sec_studs as $sec_stud ) { 
															$sel = '';
															if ($sec_stud->id == $sib_student->id){
																$sel = 'selected="selected"';
															}
														?>
														<option value="<?php echo $sec_stud->id  ?>" <?php echo $sel; ?>><?php echo ucwords ($sec_stud->fname.' '.$sec_stud->lname)  ?></option>
														<?php }} ?>
													</select>
													<?php if ($i == 1) {?>
														<i class="fa fa-plus more_sib" style="margin: 10px 0px 0px 5px;"></i>
													<?php }else { ?>
														<i class="fa fa-trash remove_sib" style="margin: 10px 0px 0px 5px;"></i>
													<?php } ?>
												</div>
										    </div>
											<?php }} else { ?>
											<div>
												<div class="col-sm-4" style="padding-left: 0px;margin-bottom: 3px;">
													<select class="form-control sibling_class" name="sibling_class" >
														<option><?php echo lang('select_class') ?></option>
														<?php if (!empty ($classes)) { 
																foreach ($classes as $class) { 
																	$sections = $this->custom_lib->get_where('sections','class_id',$class->id)->result();
																	if (!empty ($sections)){
																		foreach ($sections as $section){
																			
														?>
														<option value="<?php echo $section->id ?>" ><?php echo $class->name.' '.$section->name ?></option>
														<?php }}}} ?>
													</select>
												</div>
												<div class="col-sm-8 sibling_div" style="display:none;display: flex; margin-bottom: 3px;">
													<select class="form-control sibling" name="siblings[]" style="width:100%;" >
													</select>
													<i class="fa fa-plus more_sib" style="margin: 10px 0px 0px 5px;"></i>
												</div>
										    </div>
											<?php } ?>
										  </div>
										</div>
										<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('mother_tounge'); ?></label>
										  <div class="col-sm-8">
											<input type="text" class="form-control" name="mother_tounge" value="<?php echo (!empty ($row->mother_tounge))? $row->mother_tounge: set_value('mother_tounge'); ?>" />
										  </div>
										</div>
										<div class="form-group"> 
											<label for="name" class="col-sm-4 control-label"><?php echo lang('c_address'); ?></label>
											 <div class="col-sm-8">
												<textarea class="form-control" rows="5" name="c_address" id="c_address"><?php echo (!empty ($row->c_address))? $row->c_address: set_value('c_address') ?></textarea>
											 </div>
										</div>
										<div class="form-group"> 
											<label for="name" class="col-sm-4 control-label"><?php echo lang('p_address'); ?></label>
											 <div class="col-sm-8">
												<input type="checkbox" id="same_c_address" value="1" />
												<label><?php echo lang('same_as_correspondence_address'); ?></label>
												<textarea class="form-control" rows="5" name="p_address" id="p_address"><?php echo (!empty ($row->p_address))? $row->p_address: set_value('p_address') ?></textarea>
											</div>
										</div>
									</div>
								 </div>	
							</div>
							<div id="parent_info" class="tab-pane fade">
								<div class="row" style="padding: 15px;">  
								  <div class="col-md-6">
									<!--Father Info-->
									<div class="form-group"> 
									  <label for="name" class="col-sm-4 control-label"><?php echo lang('father').' '.lang('name'); ?></label>
									  <div class="col-sm-8">
										<input type="text" name="f_name" id="f_name" class="form-control" value="<?php echo  (!empty ($row->f_name))? $row->f_name: set_value('f_name') ?>">
									   </div>
									</div>
									<div class="form-group"> 
									  <label for="name" class="col-sm-4 control-label"><?php echo lang('father').' '.lang('email'); ?></label>
									  <div class="col-sm-8">
										<input type="email" name="f_email" id="f_email" class="form-control" value="<?php echo (!empty ($row->f_email))? $row->f_email: set_value('f_email') ?>">
									   </div>
									</div>
									<div class="form-group"> 
									  <label for="name" class="col-sm-4 control-label"><?php echo lang('father').' '.lang('phone'); ?></label>
									  <div class="col-sm-8">
										<input type="number" name="f_mobile" id="f_mobile" class="form-control" value="<?php echo (!empty ($row->f_mobile))? $row->f_mobile: set_value('f_mobile') ?>">
									   </div>
									</div>
									<div class="form-group"> 
									  <label for="name" class="col-sm-4 control-label"><?php echo lang('father').' '.lang('edu_qulification'); ?></label>
									  <div class="col-sm-8">

										<select name="f_edu_qulification" id="f_edu_qulification" class="form-control">
											<option value="<?php echo lang('none'); ?>" 
											<?php if(@$row->f_edu_qulification == lang('none'))
											{echo 'Selected="selected"'; } ?> >
												<?php echo lang('none'); ?>
											</option>
											<option value="<?php echo lang('10th'); ?>" 
											<?php if(@$row->f_edu_qulification == lang('10th'))
											{echo 'Selected="selected"'; } ?> >
												<?php echo lang('10th'); ?>
											</option>
											<option value="<?php echo lang('12th'); ?>" 
											<?php if(@$row->f_edu_qulification == lang('12th'))
											{echo 'Selected="selected"'; } ?> >
												<?php echo lang('12th'); ?>
											</option>
											<option value="<?php echo lang('graduated'); ?>" 
											<?php if(@$row->f_edu_qulification == lang('graduated'))
											{echo 'Selected="selected"'; } ?> >
												<?php echo lang('graduated'); ?>
											</option>
											<option value="<?php echo lang('post_graduated'); ?>" 
											<?php if(@$row->f_edu_qulification == lang('post_graduated'))
											{echo 'Selected="selected"'; } ?> >
												<?php echo lang('post_graduated'); ?>
											</option>
										</select>

									   </div>
									</div>
									<div class="form-group"> 
									  <label for="name" class="col-sm-4 control-label"><?php echo lang('father').' '.lang('work_place'); ?></label>
									  <div class="col-sm-8">
									  	<input type="text" name="f_work_place" id="f_work_place" class="form-control" value="<?php echo (!empty ($row->f_work_place))? $row->f_work_place: set_value('f_work_place') ?>">
									   </div>
									</div>
									<div class="form-group"> 
									  <label for="name" class="col-sm-4 control-label"><?php echo lang('is_gov_servent'); ?></label>
									  <div class="col-sm-8">
										<input type="checkbox" class="flat_check" name="f_gov_servent" id="f_gov_servent" value="1" <?php echo (set_value('f_gov_servent')== 1) ? 'checked="checked" data-yes="yes"' :'' ?>
										<?php echo (!empty ($row->f_gov_servent)) ? 'checked="checked" data-yes="yes"' : ''?> >
									   </div>
									</div>
									<div class="form-group"> 
									  <label for="name" class="col-sm-4 control-label"><?php echo lang('father').' '.lang('annual_income'); ?></label>
									  <div class="col-sm-8">
										
										<select name="f_annual_income" id="f_annual_income" class="form-control">
											<option value="<?php echo lang('below_1_lac'); ?>" 
											<?php if(@$row->f_annual_income == lang('below_1_lac'))
											{echo 'Selected="selected"'; } ?> >
												<?php echo lang('below_1_lac'); ?>
											</option>
											<option value="<?php echo lang('1_lac_to_3_lacs'); ?>" 
											<?php if(@$row->f_annual_income == lang('1_lac_to_3_lacs'))
											{echo 'Selected="selected"'; } ?> >
												<?php echo lang('1_lac_to_3_lacs'); ?>
											</option>
											<option value="<?php echo lang('3_lac_to_5_lacs'); ?>" 
											<?php if(@$row->f_annual_income == lang('3_lac_to_5_lacs'))
											{echo 'Selected="selected"'; } ?> >
												<?php echo lang('3_lac_to_5_lacs'); ?>
											</option>
											<option value="<?php echo lang('5_lac_to_10_lacs'); ?>" 
											<?php if(@$row->f_annual_income == lang('5_lac_to_10_lacs'))
											{echo 'Selected="selected"'; } ?> >
												<?php echo lang('5_lac_to_10_lacs'); ?>
											</option>
											<option value="<?php echo lang('more_than_10_lacs'); ?>" 
											<?php if(@$row->f_annual_income == lang('more_than_10_lacs'))
											{echo 'Selected="selected"'; } ?> >
												<?php echo lang('more_than_10_lacs'); ?>
											</option>
										</select>
									   </div>
									</div>
									<div class="form-group"> 
									  <label for="name" class="col-sm-4 control-label"><?php echo lang('father').' '.lang('img'); ?></label>
									  <div class="col-sm-8">
										<input type="file" name="f_img" id="f_img" class="form-control">
										<?php echo @$row->f_img  ?>
									  </div>
									</div>
									<hr>
									<!--Mother Info-->
									<div class="form-group"> 
									  <label for="name" class="col-sm-4 control-label"><?php echo lang('mother').' '.lang('name'); ?></label>
									  <div class="col-sm-8">
										<input type="text" name="m_name" id="m_name" class="form-control" value="<?php echo (!empty ($row->m_name))? $row->m_name : set_value('m_name') ?>">
									   </div>
									</div>
									<div class="form-group"> 
									  <label for="name" class="col-sm-4 control-label"><?php echo lang('mother').' '.lang('email'); ?></label>
									  <div class="col-sm-8">
										<input type="email" name="m_email" id="m_email" class="form-control" value="<?php echo (!empty ($row->m_email))? $row->m_email : set_value('m_email') ?>">
									   </div>
									</div>
									<div class="form-group"> 
									  <label for="name" class="col-sm-4 control-label"><?php echo lang('mother').' '.lang('phone'); ?></label>
									  <div class="col-sm-8">
										<input type="number" name="m_mobile" id="m_mobile" class="form-control" value="<?php echo (!empty ($row->m_mobile))? $row->m_mobile : set_value('m_mobile') ?>">
									   </div>
									</div>
									<div class="form-group"> 
									  <label for="name" class="col-sm-4 control-label"><?php echo lang('mother').' '.lang('edu_qulification'); ?></label>
									  <div class="col-sm-8">
										<select name="m_edu_qulification" id="m_edu_qulification" class="form-control">
											<option value="<?php echo lang('none'); ?>" 
											<?php if(@$row->m_edu_qulification == lang('none'))
											{echo 'Selected="selected"'; } ?> >
												<?php echo lang('none'); ?>
											</option>
											<option value="<?php echo lang('10th'); ?>" 
											<?php if(@$row->m_edu_qulification == lang('10th'))
											{echo 'Selected="selected"'; } ?> >
												<?php echo lang('10th'); ?>
											</option>
											<option value="<?php echo lang('12th'); ?>" 
											<?php if(@$row->m_edu_qulification == lang('12th'))
											{echo 'Selected="selected"'; } ?> >
												<?php echo lang('12th'); ?>
											</option>
											<option value="<?php echo lang('graduated'); ?>" 
											<?php if(@$row->m_edu_qulification == lang('graduated'))
											{echo 'Selected="selected"'; } ?> >
												<?php echo lang('graduated'); ?>
											</option>
											<option value="<?php echo lang('post_graduated'); ?>" 
											<?php if(@$row->m_edu_qulification == lang('post_graduated'))
											{echo 'Selected="selected"'; } ?> >
												<?php echo lang('post_graduated'); ?>
											</option>
										</select>
									   </div>
									</div>
									<div class="form-group"> 
									  <label for="name" class="col-sm-4 control-label"><?php echo lang('mother').' '.lang('work_place'); ?></label>
									  <div class="col-sm-8">
									  	<input type="text" id="m_work_place" name="m_work_place" id="m_work_place" class="form-control" value="<?php echo (!empty (@$row->m_work_place))? $row->m_work_place : set_value('m_work_place') ?>">
									   </div>
									</div>
									<div class="form-group"> 
									  <label for="name" class="col-sm-4 control-label"><?php echo lang('is_gov_servent'); ?></label>
									  <div class="col-sm-8">
										<input class="flat_check" type="checkbox" id="m_gov_servent" name="m_gov_servent" value="1" <?php echo (set_value('m_gov_servent')== 1) ? 'checked="checked"' :'' ?> 
										<?php echo (@$row->m_gov_servent == 1 ) ? 'checked="checked"' : '' ?> >
									   </div>
									</div>
									<div class="form-group"> 
									  <label for="name" class="col-sm-4 control-label"><?php echo lang('mother').' '.lang('annual_income'); ?></label>
									  <div class="col-sm-8">
										<select name="m_annual_income" id="m_annual_income" class="form-control">
											<option value="<?php echo lang('below_1_lac'); ?>" 
											<?php if(@$row->m_annual_income == lang('below_1_lac'))
											{echo 'Selected="selected"'; } ?> >
												<?php echo lang('below_1_lac'); ?>
											</option>
											<option value="<?php echo lang('1_lac_to_3_lacs'); ?>" 
											<?php if(@$row->m_annual_income == lang('1_lac_to_3_lacs'))
											{echo 'Selected="selected"'; } ?> >
												<?php echo lang('1_lac_to_3_lacs'); ?>
											</option>
											<option value="<?php echo lang('3_lac_to_5_lacs'); ?>" 
											<?php if(@$row->m_annual_income == lang('3_lac_to_5_lacs'))
											{echo 'Selected="selected"'; } ?> >
												<?php echo lang('3_lac_to_5_lacs'); ?>
											</option>
											<option value="<?php echo lang('5_lac_to_10_lacs'); ?>" 
											<?php if(@$row->m_annual_income == lang('5_lac_to_10_lacs'))
											{echo 'Selected="selected"'; } ?> >
												<?php echo lang('5_lac_to_10_lacs'); ?>
											</option>
											<option value="<?php echo lang('more_than_10_lacs'); ?>" 
											<?php if(@$row->m_annual_income == lang('more_than_10_lacs'))
											{echo 'Selected="selected"'; } ?> >
												<?php echo lang('more_than_10_lacs'); ?>
											</option>
										</select>
									   </div>
									</div>
									<div class="form-group"> 
									  <label for="name" class="col-sm-4 control-label"><?php echo lang('mother').' '.lang('img'); ?></label>
									  <div class="col-sm-8">
										<input type="file" name="m_img" id="m_img" class="form-control">
									   	<?php echo @$row->m_img ?>
									   </div>
									</div>
									<hr>
									<!--Gardian Info-->
									<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('gardian'); ?></label>
										  
											<div class="col-sm-8" style="display: flex;">
												<input type="radio" name="g_select" class="guardian_sel" id="g_select_father" value="0" checked="checked" required>
											 	<label><?php echo lang('father'); ?></label>
												<input type="radio" name="g_select" class="guardian_sel" id="g_select_mother" value="1" <?php echo (@$row->g_select == 1) ? 'checked="checked"' :'' ?> required>
											 	<label><?php echo lang('mother'); ?></label>
											 	<input type="radio" name="g_select" class="guardian_sel" id="g_select_other" value="2" <?php echo (@$row->g_select == 2) ? 'checked="checked"' :'' ?> required>
											 	<label><?php echo lang('other'); ?></label>
										   </div>
									</div>
									<div id="g_section" style="display: none">
										<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('gardian').' '.lang('name'); ?></label>
										  <div class="col-sm-8">
											<input type="text" name="g_name" id="g_name" class="form-control" value="<?php echo (!empty ($row->g_name)) ? $row->g_name :set_value('g_name') ?>">
										   </div>
										</div>
										<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('gardian').' '.lang('email'); ?></label>
										  <div class="col-sm-8">
											<input type="email" name="g_email" id="g_email" class="form-control" value="<?php echo (!empty ($row->g_email)) ? $row->g_email : set_value('g_email') ?>">
										   </div>
										</div>
										<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('gardian').' '.lang('phone'); ?></label>
										  <div class="col-sm-8">
											<input type="number" name="g_mobile" id="g_mobile" class="form-control" value="<?php echo (!empty ($row->g_mobile)) ? $row->g_mobile : set_value('g_mobile') ?>">
										   </div>
										</div>
										<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('gardian').' '.lang('edu_qulification'); ?></label>
										  <div class="col-sm-8">
											<select name="g_edu_qulification" id="g_edu_qulification" class="form-control">
												<option value="<?php echo lang('none'); ?>" 
												<?php if(@$row->g_edu_qulification == lang('none'))
												{echo 'Selected="selected"'; } ?> >
													<?php echo lang('none'); ?>
												</option>
												<option value="<?php echo lang('10th'); ?>" 
												<?php if(@$row->g_edu_qulification == lang('10th'))
												{echo 'Selected="selected"'; } ?> >
													<?php echo lang('10th'); ?>
												</option>
												<option value="<?php echo lang('12th'); ?>" 
												<?php if(@$row->g_edu_qulification == lang('12th'))
												{echo 'Selected="selected"'; } ?> >
													<?php echo lang('12th'); ?>
												</option>
												<option value="<?php echo lang('graduated'); ?>" 
												<?php if(@$row->g_edu_qulification == lang('graduated'))
												{echo 'Selected="selected"'; } ?> >
													<?php echo lang('graduated'); ?>
												</option>
												<option value="<?php echo lang('post_graduated'); ?>" 
												<?php if(@$row->g_edu_qulification == lang('post_graduated'))
												{echo 'Selected="selected"'; } ?> >
													<?php echo lang('post_graduated'); ?>
												</option>
											</select>
										   </div>
										</div>
										<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('gardian').' '.lang('work_place'); ?></label>
										  <div class="col-sm-8">
										  	<input type="text" name="g_work_place" id="g_work_place" class="form-control" value="<?php echo (!empty ($row->g_work_place)) ? $row->g_work_place :set_value('g_work_place') ?>">
										   </div>
										</div>
										<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('is_gov_servent'); ?></label>
										  <div class="col-sm-8">
											<input class="flat_check" type="checkbox" id="g_gov_servent" name="g_gov_servent" id="g_gov_servent" value="1" <?php echo (set_value('g_gov_servent')== 1) ? 'checked="checked"' :'' ?> 
											<?php echo (@$row->g_gov_servent == 1 ) ? 'checked="checked"' : '' ?> >
										   </div>
										</div>
										<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('gardian').' '.lang('annual_income'); ?></label>
										  <div class="col-sm-8">
											<select name="g_annual_income" id="g_annual_income" class="form-control">
												<option value="<?php echo lang('below_1_lac'); ?>" 
												<?php if(@$row->g_annual_income == lang('below_1_lac'))
												{echo 'Selected="selected"'; } ?> >
													<?php echo lang('below_1_lac'); ?>
												</option>
												<option value="<?php echo lang('1_lac_to_3_lacs'); ?>" 
												<?php if(@$row->g_annual_income == lang('1_lac_to_3_lacs'))
												{echo 'Selected="selected"'; } ?> >
													<?php echo lang('1_lac_to_3_lacs'); ?>
												</option>
												<option value="<?php echo lang('3_lac_to_5_lacs'); ?>" 
												<?php if(@$row->g_annual_income == lang('3_lac_to_5_lacs'))
												{echo 'Selected="selected"'; } ?> >
													<?php echo lang('3_lac_to_5_lacs'); ?>
												</option>
												<option value="<?php echo lang('5_lac_to_10_lacs'); ?>" 
												<?php if(@$row->g_annual_income == lang('5_lac_to_10_lacs'))
												{echo 'Selected="selected"'; } ?> >
													<?php echo lang('5_lac_to_10_lacs'); ?>
												</option>
												<option value="<?php echo lang('more_than_10_lacs'); ?>" 
												<?php if(@$row->g_annual_income == lang('more_than_10_lacs'))
												{echo 'Selected="selected"'; } ?> >
													<?php echo lang('more_than_10_lacs'); ?>
												</option>
											</select>
										   </div>
										</div>
										<div class="form-group"> 
										  <label for="name" class="col-sm-4 control-label"><?php echo lang('gardian').' '.lang('img'); ?></label>
										  <div class="col-sm-8">
											<input type="file" name="g_img" id="g_img" class="form-control">
											<?php @$row->g_img ?>
										   </div>
										</div>
									</div>
								  </div>
								</div> 
							</div>
  						</div>	
					</div>
					<div class="box-footer">
						<a href="<?php echo site_url ('admin/student/sections'); ?>" class="btn btn-default btn-flat"><?php echo lang('cancel') ?></a>
						<input type="submit" class="btn bg-purple btn-flat" name="submit" value="<?php echo lang('save') ?>" >
					</div>
				</form>
		  </div>
		</div>
	   </div>
	<section> 
   </div>		  
 <script type="text/javascript">
 	var g_select_no = '<?php echo @$row->g_select; ?>';
 	if(g_select_no == 2)
 	{
 		$('#g_section').css("display", "block");
 	}

	 $('#country').on('change',function (){
		call_loader();
		$.ajax ({
				url:'<?php echo site_url('admin/setting/ajax_country'); ?>',
					type:'Post',
					data:{country_id:$(this).val()},
					success : function (result){
						$('#state').html(result);
						$('#city_div').hide();
						remove_loader();
					}	
		});
	});
	 $('#state').on('change',function (){
		call_loader();
		$.ajax ({
				url:'<?php echo site_url('admin/setting/ajax_state'); ?>',
					type:'Post',
					data:{state_id:$(this).val()},
					success : function (result){
						$('#city').html(result);
						$('#city_div').show();
						remove_loader();
					}	
		});
	});
	$('#same_c_address').on('ifChecked',function (){
		if ($(this).prop('checked') == true){
			$('#p_address').val($('#c_address').val());
			$('#c_address').blur(function (){
				$('#p_address').val($('#c_address').val());
			});
		}
	});
	$('#same_c_address').on('ifUnchecked',function (){
		$('#p_address').val('');
		
	});

	$('#g_select_father').on('ifChecked', function(event){
  		$('#g_section').css("display", "none");
	});
	$('#g_select_mother').on('ifChecked', function(event){
		$('#g_section').css("display", "none");
  		
	});
	$('#g_select_other').on('ifChecked', function(event){
  		$('#g_section').css("display", "block");
  		$('#g_name').val('');
  		$('#g_email').val('');
  		$('#g_mobile').val('');
  		$('#g_work_place').val('');
	});

	$('.gender_title').on('ifChecked',function (){
		call_loader();
		$.ajax ({
			url:'<?php echo site_url('admin/student/ajax_title'); ?>',
			type:'Post',
			data:{gender_title:$(this).val()},
			success : function (result){
				//alert (result);
				$('#title').html(result);
				remove_loader();
			}	
		});
	});
	$('#dob').datepicker({
		autoclose : true ,
		format: "yyyy/mm/dd",
	});
	$('#admit_date').datepicker({
		autoclose : true ,
		format: "yyyy/mm/dd",
	});

	$('input').each(function(){
	    var self = $(this),
	      label = self.next(),
	      label_text = label.text();

	    label.remove();
	    self.iCheck({
	      checkboxClass: 'icheckbox_line-blue',
	      radioClass: 'iradio_line-blue',
	      insert: '<div class="icheck_line-icon"></div>' + label_text
	    });
  	});
	$('input.flat_check').iCheck({
    	checkboxClass: 'icheckbox_flat-purple'
  	});
	
	$(".sibling").select2();
	$('.sibling_class').on('change',function (){
		if($(this).val() != ''){
			var loc = $(this).parent('div').parent('div').find('.sibling');
			//alert ($(loc).text);
			call_loader();
			$.ajax ({
				url:'<?php echo site_url('admin/student/ajax_get_section_student'); ?>',
				type:'Post',
				data:{section_id:$(this).val()},
				success : function (result){
					//alert (result);
					$(loc).html(result);
					$('.sibling_div').show();
					remove_loader();
				}	
			});
		}
	});
	$('.remove_sib').on('click',function (){
	 	$(this).parent('div').parent('div').remove();
	});
	$('.more_sib').on('click',function (){
		var div = '<div><div class="col-sm-4" style="padding-left: 0px;margin-top: 3px;">'+
						'<select class="form-control sibling_class" name="sibling_class" >'+
							'<option><?php echo lang('select_class') ?></option>'+
							<?php if (!empty ($classes)) { 
									foreach ($classes as $class) { 
										$sections = $this->custom_lib->get_where('sections','class_id',$class->id)->result();
										if (!empty ($sections)){
											foreach ($sections as $section){
							?>
									'<option value="<?php echo $section->id ?>" ><?php echo $class->name.' '.$section->name ?></option>'+
					   		<?php }}}} ?>
					'</select>'+
				'</div>'+
				'<div class="col-sm-8 sibling_div" style="display:none;display: flex;margin-top: 3px;">'+
					'<select class="form-control sibling" name="siblings[]" style="width:100%;" >'+
					'</select>'+
					'<i class="fa fa-trash remove_sib" style="margin: 10px 0px 0px 5px;"></i>'+
				'</div></div>';
		$('#parent_sib_div').append(div);
		$(".sibling").select2();
		$('.remove_sib').on('click',function (){
		 	$(this).parent('div').parent('div').remove();
		});
		$('.sibling_class').on('change',function (){
			if($(this).val() != ''){
				var loc = $(this).parent('div').parent('div').find('.sibling');
				//alert ($(loc).text);
				call_loader();
				$.ajax ({
					url:'<?php echo site_url('admin/student/ajax_get_section_student'); ?>',
					type:'Post',
					data:{section_id:$(this).val()},
					success : function (result){
						//alert (result);
						$(loc).html(result);
						$('.sibling_div').show();
						remove_loader();
					}	
				});
			}
		});
	});
</script>			
	