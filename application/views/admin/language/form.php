<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <div class="content-wrapper">
                <section class="content-header">
                    <h1><?php echo $pagetitle; ?></h1>
                    <?php echo $breadcrumb; ?>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><?php echo ($this->uri->segment(4) == '') ? lang('creat').' '.lang('cat') : lang('edit').' '.lang('cat'); ?></h3>
                                </div>
                                <div class="box-body">
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
												<label for="sample" class="col-sm-4 control-label"><?php echo  lang('download_sample');?></label>
												<div class="col-sm-8" style="margin-top:6px;">
												  <a href="<?php echo site_url('admin/language/sample_file/');?>" id="sample"><?php echo lang('download_sample_file'); ?></a>
												</div>
											</div>
											<div class="form-group">
												<label for="name" class="col-sm-4 control-label"><?php echo  lang('language').' '.lang('name'); ?></label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="name" id="name" value="<?php echo set_value('name'); ?>" />
													
												</div>
											</div>
											<div class="form-group">
												<label for="file" class="col-sm-4 control-label"><?php echo  lang('language').' '.lang('file'); ?></label>
												<div class="col-sm-8">
													<input type="file" class="form-control" name="file" id="file"  />
													<p style="color:#FF0000;"><?php echo @($error); ?></p>
												</div>
											</div>
											<div class="form-group">
												<label for="img" class="col-sm-4 control-label"><?php echo  lang('language').' '.lang('flag'); ?></label>
												<div class="col-sm-8" style="display: -webkit-inline-box;">
													<input type="file" class="form-control" name="img" id="img" />
												</div>
											</div>
											<div class="box-footer">
												<input type="submit" class="btn bg-purple btn-flat" name="submit" value="<?php echo lang('save') ?>" >
											</div>
										</div>
									  </div>	
                                    </form>
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th><?php echo lang('language').' '.lang('name');?></th>
													<th><?php echo lang('language').' '.lang('file') ;?></th>
													<th><?php echo lang('action');?></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($languages as $row){ ?> 
												<tr>
													<td><?php echo $row->name; ?></td>
													<td><?php echo $row->file; ?></td>
													<td>
														<?php if ($row->id != 3 ) {  ?>
															<a href="<?php echo site_url();?>admin/language/delete/<?php echo $row->id ?>" class="btn btn-danger btn-flat">
															<?php echo lang('delete'); ?></a>
														<?php } ?>
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
                                </div>
                            </div>
                         </div>
                    </div>
                </section>
            </div>
