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
                                                <th><?php echo lang('name'); ?></th>
                                                <td><?php echo $row->name; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('subject_code'); ?></th>
                                                <td><?php echo $row->subject_code; ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('add_in_marksheet'); ?></th>
                                                <td><?php echo ($row->add_in_marksheet) ? lang('yes') : lang('no') ; ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('desc'); ?></th>
                                                <td><?php echo $row->desc ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                         </div>
					</div>
                </section>
            </div>
