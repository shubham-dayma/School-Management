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
			  	<?php echo $class_detail->name ?>
			  </h3>
			</div>
			<?php if (!empty($exams)) { foreach ($exams as $exam) { ?>
			<form method="post">
			<div class="box-header with-border">
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
					  <th><?php echo lang('max').' '.lang('marks') ?></th>
					  <th><?php echo lang('min').' '.lang('marks') ?></th>
					</tr>
                </thead>
                <tbody>
					<input type="hidden" name="exam" value="<?php echo $exam->id ?>" />
					<?php $result = json_decode($class_detail->subjects); if (!empty ($result)) { $i = 0; foreach ($result as $row) { $i++;?>
					<tr>
					  <td><?php echo $i ?></td>
					  <td>
					  	<?php $subject = $this->custom_lib->get_where('subjects','id',$row)->row(); 
							 $criteria = $this->Marks_zone->get_subject_marks_criteria($this->session->userdata('academic_session'),$class_detail->id ,$subject->id,$exam->id );
						?>
					  	<?php echo $subject->subject_code.' '.$subject->name ?>
						<input type="hidden" name="subject_id[]" value="<?php echo $subject->id ?>" />
					 </td>
					  <td>
					  	<input type="number" name="max[]" value="<?php echo @$criteria->max_marks ?>" placeholder = "<?php echo lang('max').' '.lang('marks') ?>" />
					  </td>
					   <td>
					  	<input type="number" name="min[]" value="<?php echo @$criteria->min_marks ?>" placeholder = "<?php echo lang('min').' '.lang('marks') ?>"/>
					  </td>
					</tr>
					<?php }} ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
			<div class="box-footer" style="border-bottom: 1px solid #f4f4f4;">
				<a href="<?php echo site_url ('staff/marks_manager'); ?>" class="btn btn-default btn-flat"><?php echo lang('cancel') ?></a>
				<input type="submit" class="btn btn-warning btn-flat" name="submit" value="<?php echo lang('save') ?>" >
			</div>
			</form>
			<?php }} ?>
		  
		 </div>	
		</div>
      </div>
    </section>
  </div>
  