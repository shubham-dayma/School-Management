<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <div class="content-wrapper">
                <section class="content-header">
                    <?php echo $page_title; ?>
                    <?php echo $breadcrumb; ?>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="box box-purple">
                                <div class="box-header with-border" align="center">
                                    <h3 class="box-title"><?php echo $error_msg;?></h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                            <div class="col-sm-offset-5 col-sm-10">
                                                
                                                <div class="btn-group">
													<a href="<?php echo $back_url ?>" class="btn bg-purple btn-flat"><?php echo lang('back'); ?></a>
                                                   	<?php if (isset ($redirect_url)) { ?>
													<a href="<?php echo $redirect_url ?>" class="btn btn-warning btn-flat"><?php echo $redirect_caption; ?></a>
													<?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                         </div>
                    </div>
                </section>
            </div>
