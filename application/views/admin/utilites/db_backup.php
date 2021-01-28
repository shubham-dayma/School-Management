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
									<li> <a href="<?php echo site_url('admin/utilites'); ?>"><?php echo lang('pramote/demote') ?> </a></li>
                                    <li class="active"><a href="<?php echo site_url('admin/utilites/db_backup'); ?>"><?php echo lang('db_backup'); ?> </a></li>
									<li> <a href="<?php echo site_url('admin/utilites/import_new_session'); ?>">
									   	<?php echo lang('import_data_new_session') ?> </a>
									 </li>
									<li> <a href="<?php echo site_url('admin/utilites/change_password'); ?>"><?php echo lang('change_password') ?> </a></li>
								</ul>
                                <div class="tab-content">
									<div class="tab-pane active">
									  <form class="form-horizontal" method="post">
                                        <div class="row">
                                        	<div class="col-md-10" align="center">
												<div class="form-group">
													<input type="submit" class="btn bg-purple btn-flat" name="submit" value="<?php echo lang('backup_database'); ?>" />
												</div>
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