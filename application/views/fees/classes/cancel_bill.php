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
					<label><?php echo lang('cancel_bill') ?></label>
				  </h3>
				</div>
			   <div class="box-body">
				  <table class="table table-bordered table-striped">
					<thead>
						<tr>
						  <th><input type="checkbox" class="flat_check check_all"  /></th>
						  <th><?php echo lang('groups') ?></th>
						  <th><?php echo lang('amount') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; foreach ($result as $row) { $i++; 
							 $payment_entery = $this->Fees_other->get_paid_student_groups($this->uri->segment(4),$row->group_id);
						?>
						<tr>
						  <?php if (empty($payment_entery)) { ?>	
						  	<td><input type="checkbox" name="group[<?php echo $row->group_id ?>]" class="flat_check check"  value="1" /></td>
						  <?php } else { ?>
						  	<td><?php echo lang('cannot_delete_groups_payment_found') ?></td>
						  <?php } ?>	
						  <td><?php echo ucwords($row->name) ?></td>
						  <td style="display: flex"> <?php echo $row->amount ?></td>
						</tr>
						<?php } ?>
					</tbody>
					<tfoot>
						<tr>
						  <th><input type="checkbox" class="flat_check check_all"   /></th>
						  <th><?php echo lang('groups') ?></th>
						  <th><?php echo lang('amount') ?></th>
						</tr>
					</tfoot>
				  </table>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<a href="<?php echo site_url ('fees/classes/apply_scheme/'.$section_id); ?>" class="btn btn-default btn-flat"><?php echo lang('cancel') ?></a>
					<input type="submit" class="btn btn-danger btn-flat" name="submit" value="<?php echo lang('remove') ?>" >
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