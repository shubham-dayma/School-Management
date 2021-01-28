<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $page_title ?>
      </h1>
      <?php echo $breadcrumb; ?>	  
    </section>
	<section class="content">
      <div class="row">
        <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">
			  	<a href="<?php echo site_url('staff/myclass/section_subject');?>" class="btn btn-warning btn-flat">
					<i class="fa fa-plus"></i>
					 <?php echo lang('enter_marks')?>
				</a>
				<a href="<?php echo site_url('staff/myclass/add_attendacne');?>" class="btn btn-default btn-flat">
					<i class="fa fa-plus"></i>
					 <?php echo lang('add_attendance')?>
				</a>
				<a href="<?php echo site_url('staff/myclass/add_remark') ?>" class="btn btn-warning btn-flat">
					<?php echo lang('add_remarks') ?>
				</a>
			  </h3>
            </div>
		   <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
					<tr>
					  <th><?php echo lang('sr.no') ?></th>
					  <th><?php echo lang('enrol_no') ?></th>
					  <th><?php echo lang('roll_no') ?></th>
					  <th><?php echo lang('student').' '.lang('name') ?></th>
					  <th><?php echo lang('father').' '.lang('name') ?></th>
					  <th><?php echo lang('action') ?></th>
					</tr>
                </thead>
                <tbody>
					<?php $i = 0; foreach ($result as $row) { $i++;?>
					<tr>
					  <td><?php echo $i ?></td>
					  <td><?php echo $row->enrol_no ?></td>
					  <td><?php echo $row->roll_no ?></td>
					  <td><?php echo ucwords($row->fname.' '.$row->lname) ?></td>
					  <td><?php echo ucwords ($row->f_name) ?></td>	
					  <td>
					  	<a href="<?php echo site_url('staff/myclass/student_profile/'.$row->id) ?>" class="btn btn-warning btn-flat">
						<?php echo lang('view_details') ?>
						</a>
					  </td>	
					</tr>
					<?php } ?>
                </tbody>
                <tfoot>
					<tr>
					  <th><?php echo lang('sr.no') ?></th>
					  <th><?php echo lang('enrol_no') ?></th>
					  <th><?php echo lang('roll_no') ?></th>
					  <th><?php echo lang('student').' '.lang('name') ?></th>
					  <th><?php echo lang('father').' '.lang('name') ?></th>
					  <th><?php echo lang('action') ?></th>
					</tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
		</div>	
		   
        </div>
      </div>
    </section>
  </div>
  