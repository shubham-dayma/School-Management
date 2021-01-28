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
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">
			  	<a href="<?php echo site_url('fees/fast_bills/form');?>" class="btn btn-danger btn-flat">
					<i class="fa fa-plus"></i>
					 <?php echo lang('add').' '.lang('fast_bill')?>
				</a>
			  </h3>
            </div>
		   <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
					<tr>
					  <th><?php echo lang('sr.no') ?></th>
					  <th><?php echo lang('fast_bills') ?></th>
					  <th><?php echo lang('amount') ?></th>
					  <th><?php echo lang('action') ?></th>
					</tr>
                </thead>
                <tbody>
					<?php $i = 0; foreach ($result as $row) { $i++;?>
					<tr>
					  <td><?php echo $i ?></td>
					  <td><?php echo ucwords($row->name) ?></td>
					  <td><?php echo $row->amount ?></td>
					  <td style="display: flex">
					  	<a href="<?php echo site_url ('fees/fast_bills/form/'.$row->id); ?>" class="btn btn-danger btn-flat"><i class="fa fa-pencil"></i>  <?php echo lang('edit'); ?></a>
						<a href="<?php echo site_url ('fees/fast_bills/delete/'.$row->id); ?>" class="btn btn-default btn-flat" 
							onclick="return confirm ('<?php echo $delete_msg ?>')"> <i class="fa fa-trash-o"></i>  <?php echo lang('delete'); ?>
						</a>
						<a href="<?php echo site_url ('fees/fast_bills/classes/'.$row->id); ?>" class="btn btn-warning btn-flat"> 
							<i class="fa fa-plus"></i>  <?php echo lang('apply').' '.lang('student'); ?>
						</a>
					  </td>
					</tr>
					<?php } ?>
                </tbody>
                <tfoot>
					<tr>
					  <th><?php echo lang('sr.no') ?></th>
					  <th><?php echo lang('fast_bills') ?></th>
					  <th><?php echo lang('amount') ?></th>
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
  