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
                                    <h3 class="box-title"><?php echo lang('student').' '.lang('info'); ?></h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped table-hover">
                                        <tbody>
											<tr>
                                                <th><?php echo lang('current').' '.lang('class'); ?></th>
                                                <td><?php echo $current_class->name.' '.$row->section_name; ?></td>
                                            </tr>
											<?php if (!empty ($row->s_img)) { ?>
											<tr>
												<th><?php echo lang('student').' '.lang('img'); ?></th>
												<td>
													<img src="<?php echo site_url('upload/students/student/'.$row->s_img) ?>" style="width:100%" />
												</td>
											</tr>
											<?php } ?>
											<tr>
                                                <th><?php echo lang('first').' '.lang('name'); ?></th>
                                                <td><?php echo $row->fname; ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('middle').' '.lang('name'); ?></th>
                                                <td><?php echo $row->mname ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('last').' '.lang('name'); ?></th>
                                                <td><?php echo $row->lname; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo lang('gender'); ?></th>
                                                <td><?php echo ($row->gender == 0) ? lang('male') : lang('female') ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('dob'); ?></th>
                                                <td><?php echo $row->dob ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('country'); ?></th>
                                                <td><?php echo $country->name; ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('state'); ?></th>
                                                <td><?php echo $state->name; ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('city'); ?></th>
                                                <td><?php echo $city->name; ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('c_address'); ?></th>
                                                <td><?php echo $row->c_address ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('p_address'); ?></th>
                                                <td><?php echo $row->p_address ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('phone'); ?></th>
                                                <td><?php echo $row->s_mobile ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('email'); ?></th>
                                                <td><?php echo $row->s_email ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('enrol_no'); ?></th>
                                                <td><?php echo $row->enrol_no ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('roll_no'); ?></th>
                                                <td><?php echo $row->roll_no ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('registration_no'); ?></th>
                                                <td><?php echo $row->registration_no ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('admit_class'); ?></th>
                                                <td><?php echo $admit_class->name ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('admit_section'); ?></th>
                                                <td><?php echo $admit_section->name ?></td>
                                           </tr>
										   <tr>
                                                <th><?php echo lang('nationality'); ?></th>
                                                <td><?php echo $nationality->name ?></td>
                                           </tr>
										   <tr>
                                                <th><?php echo lang('religion'); ?></th>
                                                <td><?php echo $religion->name ?></td>
                                           </tr>
										   <tr>
                                                <th><?php echo lang('cast'); ?></th>
                                                <td><?php echo $cast->name ?></td>
                                           </tr>
										   <tr>
                                                <th><?php echo lang('category'); ?></th>
                                                <td><?php echo $category->name ?></td>
                                           </tr>
										   <tr>
                                                <th><?php echo lang('adhar_card_no'); ?></th>
                                                <td><?php echo $row->adhar_card_no ?></td>
                                            </tr>
											<tr>
                                                <th><?php echo lang('mother_tounge'); ?></th>
                                                <td><?php echo $row->mother_tounge ?></td>
                                            </tr>
											<?php if (!empty (json_decode($row->siblings))) { ?>
											<tr>
                                                <th><?php echo lang('siblings'); ?></th>
                                                <td><?php foreach (json_decode ($row->siblings) as $sibling ) { 
													 $sib_student = $this->session_student_section->get_student_short_data($this->session->userdata('academic_session'),$sibling);
													 echo ucwords ($sib_student->fname.' '.$sib_student->lname).' ,';
													 }?>
												</td>
                                            </tr>
											<?php } ?>
										</tbody>
                                    </table>
                                </div>
                            </div>
                         </div>
						 <div class="col-md-6">
						 	<div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><?php echo lang('gardian').' '.lang('info'); ?></h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped table-hover">
                                        <tbody>
						 					<?php if (!empty ($row->f_img)) { ?>
											<tr>
												<th><?php echo lang('father').' '.lang('img'); ?></th>
												<td>
													<img src="<?php echo site_url('upload/students/father/'.$row->f_img) ?>" style="width:100%" />
												</td>
											</tr>
											<?php } ?>
											<tr>
                                                <th><?php echo lang('father').' '.lang('name'); ?></th>
                                                <td><?php echo $row->f_name ?></td>
                                           </tr>
										   <tr>
                                                <th><?php echo lang('father').' '.lang('email'); ?></th>
                                                <td><?php echo $row->f_email ?></td>
                                           </tr>
										   <tr>
                                                <th><?php echo lang('father').' '.lang('phone'); ?></th>
                                                <td><?php echo $row->f_mobile ?></td>
                                           </tr>
										   <tr>
                                                <th><?php echo lang('father').' '.lang('edu_qulification'); ?></th>
                                                <td><?php echo $row->f_edu_qulification ?></td>
                                           </tr>
										   <tr>
                                                <th><?php echo lang('father').' '.lang('work_place'); ?></th>
                                                <td><?php echo $row->f_work_place ?></td>
                                           </tr>
										   <tr>
                                                <th><?php echo lang('is_gov_servent'); ?></th>
                                                <td><?php echo ($row->f_gov_servent == 1) ? lang('yes') :lang('no') ?></td>
                                           </tr>
										   <tr>
                                                <th><?php echo lang('father').' '.lang('annual_income'); ?></th>
                                                <td><?php echo $row->f_annual_income ?></td>
                                           </tr>
										   <?php if (!empty ($row->m_img)) { ?>
											<tr>
												<th><?php echo lang('mother').' '.lang('img'); ?></th>
												<td>
													<img src="<?php echo site_url('upload/students/mother/'.$row->m_img) ?>" style="width:100%" />
												</td>
											</tr>
											<?php } ?>
										   <tr>
                                                <th><?php echo lang('mother').' '.lang('name'); ?></th>
                                                <td><?php echo $row->m_name ?></td>
                                           </tr>
										   <tr>
                                                <th><?php echo lang('mother').' '.lang('email'); ?></th>
                                                <td><?php echo $row->m_email ?></td>
                                           </tr>
										   <tr>
                                                <th><?php echo lang('mother').' '.lang('phone'); ?></th>
                                                <td><?php echo $row->m_mobile ?></td>
                                           </tr>
										   <tr>
                                                <th><?php echo lang('mother').' '.lang('edu_qulification'); ?></th>
                                                <td><?php echo $row->m_edu_qulification ?></td>
                                           </tr>
										   <tr>
                                                <th><?php echo lang('mother').' '.lang('work_place'); ?></th>
                                                <td><?php echo $row->m_work_place ?></td>
                                           </tr>
										   <tr>
                                                <th><?php echo lang('is_gov_servent'); ?></th>
                                                <td><?php echo ($row->m_gov_servent == 1) ? lang('yes') :lang('no') ?></td>
                                           </tr>
										   <tr>
                                                <th><?php echo lang('mother').' '.lang('annual_income'); ?></th>
                                                <td><?php echo $row->m_annual_income ?></td>
                                           </tr>
										   <?php if (!empty ($row->g_img)) { ?>
											<tr>
												<th><?php echo lang('gardian').' '.lang('img'); ?></th>
												<td>
													<img src="<?php echo site_url('upload/students/gardian/'.$row->g_img) ?>" style="width:100%" />
												</td>
											</tr>
											<?php } ?>
										    <tr>
                                                <th><?php echo lang('gardian').' '.lang('name'); ?></th>
                                                <td><?php echo $row->g_name ?></td>
                                           </tr>
										   <tr>
                                                <th><?php echo lang('gardian').' '.lang('email'); ?></th>
                                                <td><?php echo $row->g_email ?></td>
                                           </tr>
										   <tr>
                                                <th><?php echo lang('gardian').' '.lang('phone'); ?></th>
                                                <td><?php echo $row->g_mobile ?></td>
                                           </tr>
										   <tr>
                                                <th><?php echo lang('gardian').' '.lang('edu_qulification'); ?></th>
                                                <td><?php echo $row->g_edu_qulification ?></td>
                                           </tr>
										   <tr>
                                                <th><?php echo lang('gardian').' '.lang('work_place'); ?></th>
                                                <td><?php echo $row->g_work_place ?></td>
                                           </tr>
										   <tr>
                                                <th><?php echo lang('is_gov_servent'); ?></th>
                                                <td><?php echo ($row->g_gov_servent == 1) ? lang('yes') :lang('no') ?></td>
                                           </tr>
										   <tr>
                                                <th><?php echo lang('gardian').' '.lang('annual_income'); ?></th>
                                                <td><?php echo $row->g_annual_income ?></td>
                                           </tr>
										</tbody>
									</table>
								</div>
							</div>			  
						 </div>
					</div>
                </section>
            </div>
