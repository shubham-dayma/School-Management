<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($result);die;
?>
<link rel="stylesheet" href="<?php echo site_url() ?>assets/common/plugins/iCheck/flat/purple.css" >
<script type="text/javascript" src="<?php echo site_url() ?>assets/common/plugins/iCheck/icheck.js" ></script>

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
                                    <li> <a href="<?php echo site_url('admin/setting'); ?>"><?php echo lang('general').' '.lang('setting') ?> </a></li>
                                	<li class="active"> <a href="<?php echo site_url('admin/setting/academics'); ?>"><?php echo lang('academic').' '.lang('setting') ?> </a></li>
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
									<form class="form-horizontal" enctype="multipart/form-data" method="post">
										<div class="row">
                                        	<div class="col-md-6">
												<div class="form-group">
													<label class="col-sm-4 control-label" for="firm_name"><?php echo  lang('current_session')?></label>
													<div class="col-sm-8">
														<select class="form-control" name="current_session">
															<?php if (!empty($sessions)) { foreach ($sessions as $session) { ?>
															<option value="<?php echo $session->id ?>" <?php echo ($session->id == $result->current_session )? 'selected="selected"' : ''  ?> ><?php echo ucwords($session->caption) ?></option>
																<?php }} ?>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label" for="owner_name"><?php echo  lang('auto_roll_no'); ?></label>
													<div class="col-sm-8">
														<input type="checkbox"  name="auto_roll_no" id="auto_roll_no" <?php echo ($result->auto_roll_no) ? 'checked="checked"' : '' ?> value="1" />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label" for="owner_name"><?php echo  lang('auto_roll_criteria'); ?></label>
													<div class="col-sm-8">
														<select class="form-control" name="auto_roll_criteria">
															<option value="1" <?php echo ($result->auto_roll_criteria == 1) ? 'selected="selected"' : '' ?>><?php echo lang('first').' '.('name'); ?></option>
															<option value="2" <?php echo ($result->auto_roll_criteria == 2) ? 'selected="selected"' : '' ?>><?php echo lang('last').' '.('name'); ?></option>
															<option value="3" <?php echo ($result->auto_roll_criteria == 3) ? 'selected="selected"' : '' ?>><?php echo lang('date_of_admission'); ?></option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label" for="owner_name"><?php echo  lang('auto_enroll_no'); ?></label>
													<div class="col-sm-8">
														<input type="checkbox"  name="auto_enroll_no" id="auto_enroll_no" <?php echo ($result->auto_enroll_no == 1) ? 'checked="checked"' : '' ?> value="1" />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label" for="owner_name"><?php echo  lang('enrol_no_prefix'); ?></label>
													<div class="col-sm-8">
														<input type="text" class="form-control"  name="enrol_no_prefix" value="<?php echo $result->enrol_no_prefix ?>" />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-5 control-label" for="owner_name"><?php echo  lang('reg_no_same_as_enrol_no'); ?></label>
													<div class="col-sm-7">
														<input type="checkbox"  name="enrol_reg" value="1" <?php echo ($result->enrol_reg == 1) ? 'checked="checked"' : '' ?>/>
													</div>
												</div>
										 	</div>
										 </div>
										<div class="box-footer">
												<input type="submit" class="btn bg-purple btn-flat" name="submit" value="<?php echo lang('save') ?>" >
										</div>
                                    </form>
								  </div>	
                                </div>
                            </div>
                         </div>
                    </div>
                </section>
            </div>
<script type="text/javascript">
$('input').iCheck({
   	checkboxClass: 'icheckbox_flat-purple'
 });
</script>
