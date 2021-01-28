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
					   		<label><?php echo lang('bill_scheme') ?></label>
						</div>
						<div class="col-md-8">
							<select name="scheme_id" class="form-control" required >
								<option label="<?php echo lang('select_bill_scheme') ?>"></option>
								<?php if (!empty($schemes)) { foreach ($schemes as $scheme) { 
										$sel = '';
										if (set_value('scheme_id') == $scheme->id){
											$sel = 'selected="selected"';
										}
								?>
								<option value="<?php echo $scheme->id ?>" <?php echo $sel; ?>><?php echo ucwords($scheme->name) ?></option>
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
                <?php if (!empty($bill_groups)) { ?>
				<thead>
					<tr>
						<th><?php echo lang('students') ?></th>
					  <?php foreach ($bill_groups as $bill_group) { ?>
					  	<th><?php echo ucwords($bill_group->name) ?> - Rs.<?php echo $bill_group->amount ?></th>
					  <?php } ?>
					  	<th><?php echo lang('net_paid') ?></th>
						<th><?php echo lang('net_discount') ?></th>
						<th><?php echo lang('wallet_balance') ?></th>
						<th><?php echo lang('total_recieved') ?></th>
						
					</tr>
                </thead>
                <tbody>
					<?php  if (!empty($bill_students))  {foreach ($bill_students as $bill_student) { $total_paid = 0;?>
					<tr>
					  <td><?php echo ucwords($bill_student->fname.' '.$bill_student->mname.' '.$bill_student->lname) ?></td>
					  <?php foreach ($bill_groups as $bill_group) { 
					  		$record = $this->fees_other->report_get_student_group_paid($bill_student->stu_id,$bill_group->id);
					  		$group_paid  = $record->cansol_amount - $record->discount; 
					  		$total_paid = $total_paid + $group_paid;
					  ?>
					  	<td><?php echo $group_paid ?></td>
					 
					  <?php } ?>
					  <?php $cansol_statement = $this->fees_other->cansol_student_differnece($this->session->userdata('academic_session'),$bill_student->stu_id); 
					  		$wallet_bal = $cansol_statement->net_excess_recieved - $cansol_statement->net_excess_return;
					  ?>
					  	<td><?php echo $total_paid ?></td>
						<td><?php echo !empty($cansol_statement->net_discount) ? $cansol_statement->net_discount : '0' ?></td>
						<td><?php echo $wallet_bal ?></td>
						<td><?php echo $total_paid + $cansol_statement->net_discount + $wallet_bal?></td>
					</tr>
					<?php } }?>
                </tbody>
                <?php } ?>
              </table>
            </div>
            <!-- /.box-body -->
		</div>	
		   
        </div>
      </div>
    </section>
  </div>
   <?php if (!empty($bill_groups)) { ?>
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