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
          <div class="box box-purple">
            <div class="box-header with-border">
              <form method="post" class="form-horizontal">
			  	<div class="col-md-3">
					<input type="text" name="enrol_no" class="form-control" placeholder = '<?php echo lang('enrol_no') ?>'  value="<?php echo set_value('enrol_no'); ?>" />
				</div>
				<div class="col-md-3">
					<input type="text" name="name" class="form-control" placeholder = '<?php echo lang('student').' '.lang('first').' '.lang('name') ?>' 
					value="<?php echo set_value('name'); ?>"/>
				</div>
				<div class="col-md-3">
					<select class="form-control" name="class_section" >
						<option value="all"><?php echo lang('all')?></option>
						<?php if (!empty ($classes)) { 
								foreach ($classes as $class) { 
									$sections = $this->custom_lib->get_where('sections','class_id',$class->id)->result();
									if (!empty ($sections)){
										foreach ($sections as $section){ 
											$sel = '';
											if ($section->id == set_value('class_section')){
												$sel = 'selected="selected"';
											}
										?>
											<option value="<?php echo $section->id ?>" <?php echo $sel; ?>><?php echo $class->name.' '.$section->name ?></option>
						<?php }}}} ?>
					</select>
				</div>
				<div class="col-md-3">
					<input type="submit" class="btn bg-purple btn-flat" name="submit" value="<?php echo lang('search') ?>" />
				</div>
			  </form>
            </div>
		   <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
									  <th><?php echo lang('sr.no') ?></th>
									  <th><?php echo lang('enrol_no') ?></th>
									  <th><?php echo lang('class') ?></th>
									  <th><?php echo lang('student').' '.lang('name') ?></th>
									  <th><?php echo lang('father').' '.lang('name') ?></th>
									  <th><?php echo lang('action') ?></th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 0; foreach ($students as $student) { $i++;?>
									<tr>
									  <td><?php echo $i ?></td>
									  <td><?php echo $student->enrol_no ?></td>
									  <?php 
									  	$section = $this->custom_lib->get_where('sections','id',$student->section_id)->row(); 
										$class =  $this->custom_lib->get_where('classes','id',@$section->class_id)->row(); 
									   ?>
									  <td><?php echo $class->name.' '.$section->name ?></td>
									  <td><?php echo ucwords ($student->fname.' '.$student->lname) ?></td>
									  <td><?php echo $student->f_name; ?></td>
									  <td style="display: flex">
										<a href="<?php echo site_url ('admin/certificates/tc/'.$student->id); ?>" title="<?php echo lang('tc') ?>" class="btn btn-info btn-flat" >
											<i class="fa fa-pencil"></i> 
											<?php echo lang('tc') ?>
										</a>
									  	<a href="<?php echo site_url ('admin/certificates/cc/'.$student->id); ?>" title="<?php echo lang('cc') ?>" class="btn btn-warning btn-flat">
											<i class="fa fa-pencil"></i> 
											<?php echo lang('cc') ?>
										</a>
									  </td>
									</tr>
									<?php } ?>
								</tbody>
								<tfoot>
									<tr>
									  <th><?php echo lang('sr.no') ?></th>
									  <th><?php echo lang('enrol_no') ?></th>
									  <th><?php echo lang('class') ?></th>
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
  