<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
	
</style>
<link rel="stylesheet" href="<?php echo site_url(); ?>assets/admin/plugins/datatable_buttons/buttons.dataTables.min.css" />
<script src="<?php echo site_url(); ?>assets/admin/plugins/datatable_buttons/dataTables.buttons.min.js"></script>
<script src="<?php echo site_url(); ?>assets/admin/plugins/datatable_buttons/buttons.flash.min.js"></script>
<script src="<?php echo site_url(); ?>assets/admin/plugins/datatable_buttons/pdfmake.min.js"></script>
<script src="<?php echo site_url(); ?>assets/admin/plugins/datatable_buttons/vfs_fonts.js"></script>
<script src="<?php echo site_url(); ?>assets/admin/plugins/datatable_buttons/buttons.html5.min.js"></script>
<script src="<?php echo site_url(); ?>assets/admin/plugins/datatable_buttons/buttons.print.min.js"></script>


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
          <div class="box box-danger">
            <div class="box-header with-border">
             	<form method="post">
				   <div class="col-md-4">
				   		<div class="col-md-4">
					   		<label><?php echo lang('fast_bills') ?></label>
						</div>
						<div class="col-md-8">
							<select name="fbill_id" class="form-control" required >
								<option label="<?php echo lang('select_fast_bill') ?>"></option>
								<?php if (!empty($fbills)) { foreach ($fbills as $fbill) { 
										$sel = '';
										if (set_value('fbill_id') == $fbill->id){
											$sel = 'selected="selected"';
										}
								?>
								<option value="<?php echo $fbill->id ?>" <?php echo $sel; ?>><?php echo ucwords($fbill->name) ?></option>
								<?php }} ?>
							</select>
					  	</div>
				   </div>	
				   <div class="col-md-4">
				     	<div class="col-md-4">
					 		<label><?php echo lang('classes') ?></label>
						</div>
						<div class="col-md-8">
							<select name="section_id" class="form-control">
								<option><?php echo lang('all') ?></option>
								<?php if (!empty($classes)) { foreach ($classes as $class) { 
										$sections = $this->custom_lib->get_where('sections','class_id',$class->id)->result();
										if (!empty ($sections)) { foreach ($sections as $section) { 
											$sel1 = '';
											if (set_value('section_id') == $section->id){
												$sel1 = 'selected="selected"';
											}
								?>
										<option value="<?php echo $section->id ?>" <?php echo $sel1; ?>><?php echo ucwords($class->name.' '.$section->name) ?></option>
								<?php }}}} ?>
						   </select>
					   </div>
					</div>
				   <div class="col-md-3">
						<input type="submit" name="submit"  value="<?php echo lang('submit') ?>" class="btn btn-danger" />
				   </div>
			   </form>
            </div>
		   <div class="box-body">
		   	   
              <table id="example" class="table table-bordered table-striped">
               <thead>
					<tr>
						<th><?php  echo lang('sr.no') ?></th>
						<th><?php echo lang('enrol_no') ?></th>
						<th><?php echo lang('student').' '.lang('name') ?></th>
						<th><?php echo lang('father').' '.lang('name') ?></th>
					  	<th><?php echo lang('class') ?></th>
						<th><?php echo lang('recieved_payment') ?></th>
						
					</tr>
                </thead>
                <tbody>
					<?php if (!empty($students)) {  $i=1; foreach ($students as $student) {?>
					<tr>
					 	<td><?php echo  $i++; ?></td>
						<td><?php echo $student->enrol_no; ?></td>
						<td><?php echo ucwords($student->fname.' '.$student->mname.' '.$student->lname); ?></td>
						<td><?php echo $student->f_name; ?></td>
						<td><?php echo $student->class.' '.$student->section; ?></td>
						<td><?php echo !empty($student->payment_recieved) ? $student->payment_recieved : 0; ?></td>
					</tr>
					<?php }} ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
		</div>	
		   
        </div>
      </div>
    </section>
  </div>
   <?php if (!empty($students)) { ?>
 <script>
 	$(document).ready(function (){
		$('#example').DataTable( {
	  		"ordering": false,
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			]
	  	});
	});
 </script>
 <?php } ?> 