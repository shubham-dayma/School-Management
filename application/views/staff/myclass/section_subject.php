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
			  	<?php echo $class->name.' '.$section_detail->name ?>
			  </h3>
			  <h3 class="box-title pull-right">
					<a  class="btn btn-default btn-flat" data-toggle="modal" data-target="#tabsheets" >
						<?php echo lang('print_tabsheet') ?>
					</a>
			   </h3>
			  <h3 class="box-title pull-right">
			  	<a  class="btn btn-warning btn-flat" data-toggle="modal" data-target="#marksheets" >
					<?php echo lang('print_marksheet') ?>
				</a>
			  </h3>
            </div>
			<?php if (!empty ($co_scolastic_subjects)) { ?>
			<div class="box-header with-border">
				<h3 class="box-title">
					<?php echo lang('co_scolastic').' '.lang('subjects') ?>
				</h3>
		   </div>
		   <div class="box-body">
              <table class="table table-bordered table-striped">
                <thead>
					<tr>
					  <th><?php echo lang('sr.no') ?></th>
					  <th><?php echo lang('subjects') ?></th>
					  <th><?php echo lang('action') ?></th>
					</tr>
                </thead>
                <tbody>
					<?php $i =0; foreach($co_scolastic_subjects as $co_scolastic_subject) { 
						$c_subject = $this->custom_lib->get_where('co_scolastic_subjects','id',$co_scolastic_subject)->row();
						if (!empty ($c_subject)) {
						$i++;
					?>
					<tr>
					  <td><?php echo $i ?></td>
					  <td><?php echo ucwords($c_subject->name) ?></td>
					  <td>
					  	<a href="<?php echo site_url('staff/myclass/co_scolastic_marks/'.$c_subject->id) ?>" class="btn btn-warning btn-flat">
							<?php echo lang('add_marks') ?>
						</a>
					  </td>
					</tr>  
					<?php }} ?>
				</tbody>
			  </table>
			</div>	
			<?php } ?>
			<?php if (!empty($exams)) { foreach ($exams as $exam) { ?>
		   <div class="box-header with-border" style="border-top: 1px solid #f4f4f4;">
				<h3 class="box-title">
					<?php echo $exam->name ?>
				</h3>
		   </div>
		   <div class="box-body">
              <table class="table table-bordered table-striped">
                <thead>
					<tr>
					  <th><?php echo lang('sr.no') ?></th>
					  <th><?php echo lang('subjects') ?></th>
					  <th><?php echo lang('action') ?></th>
					</tr>
                </thead>
                <tbody>
					<?php $result = json_decode($section_detail->subjects); if (!empty ($result)) { $i = 0; foreach ($result as $row) { $i++;
						  $subject = $this->custom_lib->get_where('subjects','id',$row)->row();
					?>
					<tr>
					  <td><?php echo $i ?></td>
					  <td><?php echo $subject->subject_code.' '.$subject->name ?></td>
					  <td>
					  	<?php $criteria = $this->Marks_zone->get_subject_marks_criteria($this->session->userdata('academic_session'),$class->id,$subject->id,$exam->id); 
							if (!empty($criteria)){
						?>
					  	<a href="<?php echo site_url('staff/myclass/enter_marks/'.$subject->id.'/'.$exam->id) ?>" class="btn btn-warning btn-flat">
						<?php echo lang('add_marks') ?>
						</a>
						<?php }else { ?>
						<p style="color:#FF0000;"><?php echo lang('marks_criteria_not_define_for_this_subject') ?>	</p>
						<?php } ?>
					  </td>
					</tr>
					<?php }} ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
			<?php }} ?>
		</div>	
		   
        </div>
      </div>
    </section>
  </div>
  
  <div class="modal fade" id="marksheets" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h3 class="modal-title" style="position: absolute;"><?php echo lang('marksheets') ?></h3>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:5px;">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<div class="row">
				<?php if (!empty ($marksheets)) { foreach ($marksheets as $marksheet) {  ?>
				<div class="col-md-6">
					<a href="<?php echo site_url('staff/myclass/'.$marksheet->url.'/'.$marksheet->id); ?>" target="_blank">
						<?php echo ucwords($marksheet->name); ?>
					</a>
				</div>
				<?php }} ?>
			</div>
		  </div>
		</div>
	  </div>
  </div>
   <div class="modal fade" id="tabsheets" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h3 class="modal-title" style="position: absolute;"><?php echo lang('tabsheets') ?></h3>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:5px;">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<div class="row">
			  <div class="col-md-6">
				<a href="<?php echo site_url('staff/myclass/tabsheet_1/'); ?>" target="_blank">
					<?php echo lang('consolidate_tabsheet'); ?>
				</a>
			   </div>
			</div>
		  </div>
		</div>
	  </div>
  </div>