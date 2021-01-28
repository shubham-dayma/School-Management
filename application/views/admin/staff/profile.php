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
                             <div class="box box-purple">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><?php echo lang('view'); ?></h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped table-hover">
                                        <tbody>
											<tr>
                                                <th style="width: 30%;"><?php echo lang('staff_fname'); ?></th>
                                                <td><?php echo $row->fname; ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width: 30%;"><?php echo lang('second').' '.lang('name'); ?></th>
                                                <td><?php echo $row->lname; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('gender'); ?></th>
                                                <td><?php echo ($row->gender == 0) ? lang('male') : lang('female'); ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('phone'); ?></th>
                                                <td><?php echo $row->phone ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('email'); ?></th>
                                                <td><?php echo $row->email ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('dob'); ?></th>
                                                <td><?php echo $row->dob ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('doj'); ?></th>
                                                <td><?php echo $row->doj ?></td>
                                            </tr>
											 <tr>
                                                <th><?php echo lang('qulification'); ?></th>
                                                <td><?php echo $row->qulification ?></td>
                                            </tr>
											 <tr>
                                                <th><?php echo lang('extra_qulification'); ?></th>
                                                <td><?php echo $row->extra_qulification ?></td>
                                            </tr>
											 <tr>
                                                <th><?php echo lang('work_experiance'); ?></th>
                                                <td><?php echo $row->work_experiance.' years' ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('address'); ?></th>
                                                <td><?php echo $row->address ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('profile').' '.lang('picture'); ?></th>
                                                <td>
													<?php if (!empty ($row->photo)){ ?>
													<img src="<?php echo site_url ('upload/staff/staff_img/'.$row->photo) ?>" style="width:35%; height:92px" />
													<?php }
													else {
														echo ' - ';
													}
													 ?>
												</td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('id_proof'); ?></th>
                                                <td>
                                                    <?php if (!empty ($row->id_proof)){ ?>
                                                    <img src="<?php echo site_url ('upload/staff/staff_id/'.$row->id_proof) ?>" style="width:35%; height:92px" />
                                                    <?php }
                                                    else {
                                                        echo ' - ';
                                                    }
                                                     ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('staff').' '.lang('category'); ?></th>
                                                <td><?php echo $category->name ?></td>
                                            </tr>

                                           

                                            <tr>
                                                <th><?php echo lang('assigned').' '.lang('subject'); ?></th>
                                                <td> <?php if(!empty($subjects)) { foreach ($subjects as $subject) { ?>
                                                    <?php echo @(in_array($subject->id , json_decode(@$row->assigned_subject))) ? ucwords($subject->name).' ' : ''; } } ?>
                                                </td>
                                            </tr>

											<tr>
                                                <th><?php echo lang('login').' '.lang('status'); ?></th>
                                                <td><?php echo ($row->login_status == 0) ? lang('active') : lang('inactive'); ?></td>
                                            </tr>
                                            <tr>
                                               <th><?php echo lang('working').' '.lang('status'); ?></th>
                                                <td><?php echo ($row->working_status == 0) ? lang('working') : lang('terminated'); ?></td>
                                            </tr>
                                                <?php if($row->working_status == 1) { ?>

                                             <tr>
                                                <th><?php echo lang('dot'); ?></th>
                                                <td><?php echo $row->dot ?></td>
                                            </tr>

                                                <?php } ?>
											<tr>
                                                <th><?php echo lang('creat_date'); ?></th>
                                                <td><?php echo $row->creat_date ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('last_login'); ?></th>
                                                <td><?php echo $row->last_login ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                         </div>
					</div>
                </section>
            </div>
