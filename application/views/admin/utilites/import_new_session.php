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
                                     <li> <a href="<?php echo site_url('admin/utilites'); ?>"><?php echo lang('pramote/demote') ?> </a></li>
                                	 <li><a href="<?php echo site_url('admin/utilites/db_backup'); ?>"><?php echo lang('db_backup'); ?> </a></li>	
									  <li class="active"> <a href="<?php echo site_url('admin/utilites/import_new_session'); ?>">
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
												<div class="col-md-5" align="right">
													<label><?php echo lang('current_session').' : ' ?></label>
													<label><?php echo $current_session->caption ?></label>
												</div>
												<div class="col-md-1">
													<label class=""><?php echo lang('to')?></label>
												</div>
												<div class="col-md-6">
													<label><?php echo lang('sessions').' : ' ?></label>
													<select name="pd_session_id" required>
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
											</div>	
										</div>
										<div class="row" align="center">
											<div class="col-md-12">
												<input type="submit" name="save"  class="btn bg-purple btn-flat" value="<?php echo lang('import_data') ?>" style="margin-right:10%" /> 
											</div>
										</div>
									</form>
								  </div>	
                                </div>
                            </div>
                         </div>
                    </div>
                </section>
            </div>
