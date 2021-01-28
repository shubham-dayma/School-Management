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
			  	<?php echo $subject_detail->subject_code.' '.ucwords($subject_detail->name) ?>
			  </h3>
            </div>
			<form method="post">
			<div class="box-body">
              <table class="table table-bordered table-striped">
                <thead>
					<tr>
					  <th><?php echo lang('enrol_no') ?></th>
					  <th><?php echo lang('roll_no') ?></th>
					  <th><?php echo lang('students') ?></th>
					  <th><?php echo lang('father').' '.lang('name') ?></th>
					  <th><?php echo lang('marks').' ('.lang('max').' : '.$marks_crieia->max_marks.', '.lang('min').' : '.$marks_crieia->min_marks.') '; ?></th>
					  <th><?php echo lang('attendance') ?></th>
					</tr>
                </thead>
                <tbody>
					<?php foreach ($result as $row) { $entered_marks = $this->Marks_zone->get_marks_entery($this->uri->segment(5),$subject_detail->id,$section_detail->id,$row->id); ?>
					<tr>
					  <td><?php echo ucwords($row->enrol_no); ?></td>
					  <td><?php echo ucwords($row->roll_no); ?></td>
					  <td><?php echo ucwords ($row->fname.' '.$row->lname) ?></td>
					  <td><?php echo ucwords($row->f_name); ?></td>
					  <td>
					  	<input type="hidden" name="student_id[]" value="<?php echo $row->id ?>" />
						<input type="number" name="marks[]" class="marks_enter" value="<?php echo @$entered_marks->marks ?>" />
					  	<p class="message" style="color:#FF0000;"></p>
					  </td>
					  <td>
					  	<select name="attendance[]" class="attendace">
							<option value="0" <?php echo (@$entered_marks->attendence == 0) ? 'selected="selected"' : '' ?>><?php echo lang('present') ?></option>
							<option value="1" <?php echo (@$entered_marks->attendence == 1) ? 'selected="selected"' : '' ?>><?php echo lang('absent') ?></option>
							<option value="2" <?php echo (@$entered_marks->attendence == 2) ? 'selected="selected"' : '' ?>><?php echo lang('on_leave') ?></option>
						</select>
					  </td>
					</tr>
					<?php } ?>
                </tbody>
              </table>
            </div>
			<!-- /.box-body -->
			<div class="box-footer" style="border-bottom: 1px solid #f4f4f4;">
				<a href="<?php echo site_url ('staff/myclass/section_subject'); ?>" class="btn btn-default btn-flat"><?php echo lang('cancel') ?></a>
				<input type="submit" class="btn btn-warning btn-flat" name="submit" value="<?php echo lang('save') ?>" >
			</div>
			</form>
		 </div>	
		</div>
      </div>
    </section>
  </div>
 <script type="text/javascript">
 	$(document).ready(function (){
		$('.marks_enter').blur(function (){
			if ($(this).parent('td').parent('tr').find('.attendace').val() == 0) {
				if ($(this).val() > <?php echo $marks_crieia->max_marks ?> ){
					$(this).val('');
					$(this).focus();
					$(this).parent('td').find('.message').html('Entered value must be greater than <?php echo $marks_crieia->min_marks ?> or smaller than <?php echo $marks_crieia->max_marks ?>');
				}
				else{
					$(this).parent('td').find('.message').hide();
				}
			}	
		});
		$('.attendace').on('change',function (){
			if ($(this).val() != 0 ){
				$(this).parent('td').parent('tr').find('.message').hide();
			}
			else{
				$(this).parent('td').parent('tr').find('.message').show();
			}
		});
	});
 </script> 