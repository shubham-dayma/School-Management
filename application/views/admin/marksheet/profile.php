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
                                                <td><?php echo ucwords ($row->name); ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('exam_scheme'); ?></th>
                                                <td><?php echo $exam_scheme->name; ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('grade').' '.lang('scheme'); ?></th>
                                                <td><?php echo $grade_scheme->name; ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('passing_percentage'); ?></th>
                                                <td><?php echo $row->passing_percentage ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('result_date'); ?></th>
                                                <td><?php echo $row->result_date ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('url'); ?></th>
                                                <td><?php echo $row->url ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                         </div>
					</div>
                </section>
            </div>
