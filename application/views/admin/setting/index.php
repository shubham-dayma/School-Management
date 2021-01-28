<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
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
                                    <li class="active"> <a href="<?php echo site_url('admin/setting'); ?>"><?php echo lang('general').' '.lang('setting') ?> </a></li>
                                	<li> <a href="<?php echo site_url('admin/setting/academics'); ?>"><?php echo lang('academic').' '.lang('setting') ?> </a></li>
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
													<label class="col-sm-4 control-label"><?php echo  lang('owner')?></label>
													<div class="col-sm-8">
														<input type="text" class="form-control" disabled="disabled" value="<?php echo $this->encryption->decrypt($this->setting->owner); ?>" />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label" for="firm_name"><?php echo  lang('school_name')?></label>
													<div class="col-sm-8">
														<input type="text" class="form-control" name="firm_name" id="firm_name" value="<?php echo ($result->school_name); ?>" />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label" for="owner_name"><?php echo  lang('owner_name'); ?></label>
													<div class="col-sm-8">
														<input type="text" class="form-control" name="owner_name" id="owner_name" value="<?php echo ($result->owner_name); ?>" />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label" for="logo"><?php echo  lang('logo'); ?></label>
													<div class="col-sm-6">
														<input type="file" class="form-control" name="img" id="logo" />
														<?php echo $result->logo; ?>
													</div>
													<div class="col-sm-2">
														<?php if (!empty ($result->logo)){ ?>
															<img src="<?php echo site_url('upload/logo/'.$result->logo); ?>" style=" width:100%; height:30px;"/>
														<?php } ?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label" for="favicon"><?php echo  lang('favicon'); ?></label>
													<div class="col-sm-6">
														<input type="file" class="form-control" name="favicon" id="favicon"  />
														<?php echo $result->favicon; ?>
													</div>
													<div class="col-sm-2">
														<?php if (!empty ($result->favicon)){ ?>
															<img src="<?php echo site_url('upload/favicon/'.$result->favicon); ?>" style=" width:40%; height:30px;"/>
														<?php } ?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label" for="principal_sign"><?php echo lang('principal_sign'); ?></label>
													<div class="col-sm-6">
														<input type="file" class="form-control" name="principal_sign" id="principal_sign"  />
														<?php echo $result->principal_sign; ?>
													</div>
													<div class="col-sm-2">
														<?php if (!empty ($result->principal_sign)){ ?>
															<img src="<?php echo site_url('upload/principal_sign/'.$result->principal_sign); ?>" style=" width:40%; height:30px;"/>
														<?php } ?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label" for="phone"><?php echo  lang('phone'); ?></label>
													<div class="col-sm-8">
														<input type="text" class="form-control" name="phone" id="phone" value="<?php echo ($result->phone); ?>" />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label" for="email"><?php echo  lang('email'); ?></label>
													<div class="col-sm-8">
														<input type="text" class="form-control" name="email" id="email" value="<?php echo ($result->email); ?>" />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label" for="website"><?php echo  lang('website'); ?></label>
													<div class="col-sm-8">
														<input type="text" class="form-control" name="website" id="website" value="<?php echo ($result->website); ?>" />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label" for="address"><?php echo  lang('address'); ?></label>
													<div class="col-sm-8">
														<textarea class="form-control redactor" name="address" id="address" ><?php echo ($result->address);  ?></textarea>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label" for="d_language"><?php echo  lang('d_language'); ?></label>
													<div class="col-sm-8">
														<select class="form-control" name="d_language" id="d_language">
															<?php foreach ($languages as $language ) { 
																  $sel = '';
																  if ($language->name == $result->d_language){
																  	$sel = 'selected="selected"';
																  }	
															?>
															<option value="<?php echo $language->name; ?>" <?php echo $sel;?> ><?php echo ucwords ($language->name); ?></option>
															<?php } ?>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label" for="country"><?php echo  lang('country'); ?></label>
													<div class="col-sm-8">
														<select class="form-control" name="country" id="country">
															<?php foreach ($countries as $country ) { 
																  $sel = '';
																  if ($country->id == $result->country){
																  	$sel = 'selected="selected"';
																  }	
															?>
															<option value="<?php echo $country->id; ?>" <?php echo $sel;?> ><?php echo ucwords ($country->name); ?></option>
															<?php } ?>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label" for="state"><?php echo  lang('state'); ?></label>
													<div class="col-sm-8">
														<select class="form-control" name="state" id="state">
															<?php foreach ($states as $state ) { 
																  $sel = '';
																  if ($state->id == $result->state){
																  	$sel = 'selected="selected"';
																  }	
															?>
															<option value="<?php echo $state->id; ?>" <?php echo $sel;?> ><?php echo ucwords ($state->name); ?></option>
															<?php } ?>
														</select>
													</div>
												</div>	
												<div class="form-group" id="city_div">
													<label class="col-sm-4 control-label" for="city"><?php echo  lang('city'); ?></label>
													<div class="col-sm-8">
														<select class="form-control" name="city" id="city">
															<?php foreach ($cities as $city ) { 
																  $sel = '';
																  if ($city->id == $result->city){
																  	$sel = 'selected="selected"';
																  }	
															?>
															<option value="<?php echo $city->id; ?>" <?php echo $sel;?> ><?php echo ucwords ($city->name); ?></option>
															<?php } ?>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label" for="footer_text"><?php echo  lang('footer_text'); ?></label>
													<div class="col-sm-8">
														<textarea class="form-control redactor" name="footer_text" id="footer_text" ><?php echo ($result->footer_text);  ?></textarea>
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
</script>			
