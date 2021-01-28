<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?php echo site_url('assets/common/plugins/iCheck/flat/purple.css'); ?>" >
<script type="text/javascript" src="<?php echo site_url ('assets/common/plugins/iCheck/icheck.js'); ?>" ></script>

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
		  <form method="post">	
			  <div class="box box-danger">
				<div class="box-header with-border">
				  <h3 class="box-title">
					<label><?php echo lang('select_bill_scheme') ?></label>
					<select name="bill_scheme" required>
						<option value=""><?php echo lang('select_bill_scheme') ?></option>
						<?php if (!empty($bill_schemes)) { foreach ($bill_schemes as $bill_scheme) { ?>
							<option value="<?php echo $bill_scheme->scheme_id ?>" ><?php  echo ucwords ($bill_scheme->name) ?></option>
						<?php }} ?>
					</select>
				  </h3>
				</div>
			   <div class="box-body">
				  <table class="table table-bordered table-striped">
					<thead>
						<tr>
						  <th><input type="checkbox" class="flat_check check_all"  /></th>
						  <th><?php echo lang('students') ?></th>
						  <th><?php echo lang('action') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; foreach ($result as $row) { $i++; ?>
						<tr>
						  <td>
						  	<?php $s_bills = $this->Fees_other->get_student_groups($row->id,$this->session->userdata('academic_session'));
								if (empty ($s_bills)) {
							?>
								<input type="checkbox" name="student[<?php echo $row->id ?>]" class="flat_check check"  value="1" />
						  	<?php }else { ?>
								<p style="color:#FF0000;"><?php echo lang('bill_scheme_already_applied') ?></p>
							<?php } ?>
						  </td>
						  <td><?php echo $row->fname.' '.$row->lname ?></td>
						  <td style="display: flex">
						  	<?php if (!empty($s_bills)) { ?>
								<a href="<?php echo site_url ('fees/classes/cancel_bill/'.$row->id); ?>" class="btn btn-danger btn-flat"> 
									<?php echo lang('cancel_bill'); ?>
								</a>
						  	<?php } ?>
						  </td>
						</tr>
						<?php } ?>
					</tbody>
					<tfoot>
						<tr>
						  <th><input type="checkbox" class="flat_check check_all"   /></th>
						  <th><?php echo lang('students') ?></th>
						  <th><?php echo lang('action') ?></th>
						</tr>
					</tfoot>
				  </table>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<a href="<?php echo site_url ('fees/classes'); ?>" class="btn btn-default btn-flat"><?php echo lang('cancel') ?></a>
					<input type="submit" class="btn btn-danger btn-flat" name="submit" value="<?php echo lang('save') ?>" >
				</div>
			</div>	
		</form>
		</div>
      </div>
    </section>
  </div>
  <script type="text/javascript">
	$('input.flat_check').iCheck({
    	checkboxClass: 'icheckbox_flat-purple'
  	});
	$('.check_all').on('ifChecked',function (){
		$('.check').iCheck('check');
		$('.check_all').iCheck('check');
	});
	$('.check_all').on('ifUnchecked',function (){
		$('.check').iCheck('uncheck');
		$('.check_all').iCheck('uncheck');
	});
   </script>