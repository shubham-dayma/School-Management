<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//echo '<pre>';
//print_r($row);
//print_r($exams);
//die;
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
                                    <h3 class="box-title"><?php echo lang('exam_scheme'); ?></h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped table-hover">
                                        <tbody>
											<tr>
                                                <th><?php echo lang('name'); ?></th>
                                                <td><?php echo $row->name; ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('desc'); ?></th>
                                                <td><?php echo $row->desc ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('applied_classes'); ?></th>
                                                <td>
													<?php if (!empty($classes)) { foreach ($classes as $class) { if (in_array($class->id,json_decode($row->classes))) {?>
													<?php echo $class->name ?>
													<?php } } }?>
												</td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('creat_date'); ?></th>
                                                <td><?php echo $row->creat_date ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                         </div>
						 <div class="col-md-6">
                             <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><?php echo lang('exams'); ?></h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped table-hover">
                                        <thead>
											<tr>
												<th><?php echo lang('exam').' '.lang('name') ?></th>
												<th><?php echo lang('exam').' '.lang('form') ?></th>
												<th><?php echo lang('exam').' '.lang('to') ?></th>
												<th><?php echo lang('exam').' '.lang('caption') ?></th>
											</tr>
										</thead>
										<tbody>
											<?php if (!empty ($exams)) { foreach ($exams as $exam){ ?>
                                        	<tr>
												<td><?php echo $exam->name ?></td>
												<td><?php echo $exam->from ?></td>
												<td><?php echo $exam->to ?></td>
												<td><?php echo $exam->caption ?></td>
											</tr>
											<?php } }?>
										</tbody>
                                    </table>
                                </div>
                            </div>
                         </div>
					</div>
                </section>
            </div>
