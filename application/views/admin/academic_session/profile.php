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
                        <div class="col-md-6">
                             <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><?php echo lang('view'); ?></h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped table-hover">
                                        <tbody>
											<tr>
                                                <th><?php echo lang('start_date'); ?></th>
                                                <td><?php echo $row->start_date; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('end_date'); ?></th>
                                                <td><?php echo $row->start_date; ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('caption'); ?></th>
                                                <td><?php echo $row->caption ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                         </div>
					</div>
                </section>
            </div>
