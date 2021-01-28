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
			</div>
			 <?php if (!empty ($result)) {?>
			<form method="post" class="form-horizontal">
			  <div class="box-body">
			    <?php if (!empty (validation_errors())) { ?>
				 <div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Alert!</h4>
					<?php echo validation_errors(); ?>
				 </div>
				 <?php } ?>
			 <table class="table table-bordered table-striped">
                <thead>
					<tr>
					  <th><?php echo lang('enrol_no') ?></th>
					  <th><?php echo lang('roll_no') ?></th>
					  <th><?php echo lang('students') ?></th>
					  <th><?php echo lang('father').' '.lang('name') ?></th>
					 <th><?php echo lang('remark') ?></th>
					</tr>
                </thead>
                <tbody>
					<?php foreach ($result as $row) { ?>
					<tr>
					  <td><?php echo ucwords($row->enrol_no); ?></td>
					  <td><?php echo ucwords($row->roll_no); ?></td>
					  <td><?php echo ucwords ($row->fname.' '.$row->lname) ?></td>
					  <td><?php echo ucwords($row->f_name); ?></td>
					  <td>
					  	<?php $remark = $this->Other->get_remark($this->session->userdata('academic_session'),$row->id); ?>
						<input type="text" name="remark[<?php echo $row->id ?>]" value="<?php echo @$remark->remark ?>" />
					  </td>
					</tr>
					<?php } ?>
                </tbody>
              </table>
            </div>
			<!-- /.box-body -->
			<div class="box-footer" style="border-bottom: 1px solid #f4f4f4;">
				<a href="<?php echo site_url ('staff/myclass'); ?>" class="btn btn-default btn-flat"><?php echo lang('cancel') ?></a>
				<input type="submit" class="btn btn-warning btn-flat" name="submit" value="<?php echo lang('save') ?>" >
			</div>
			</form>
			<?php } ?>
		 </div>	
		</div>
      </div>
    </section>
  </div>
