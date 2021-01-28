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
			  	<a href="<?php echo site_url('fees/heads/form');?>" class="btn btn-danger btn-flat">
					<i class="fa fa-plus"></i>
					 <?php echo lang('add').' '.lang('fee_head')?>
				</a>
			  </h3>
            </div>
		   <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
					<tr>
					  <th><?php echo lang('sr.no') ?></th>
					  <th><?php echo lang('fee_heads') ?></th>
					  <th><?php echo lang('action') ?></th>
					</tr>
                </thead>
                <tbody>
					<?php $i = 0; foreach ($result as $row) { $i++;?>
					<tr>
					  <td><?php echo $i ?></td>
					  <td><?php echo $row->name ?></td>
					  <td style="display: flex">
					  	<a href="<?php echo site_url ('fees/heads/form/'.$row->id); ?>" class="btn btn-danger btn-flat"><i class="fa fa-pencil"></i>  <?php echo lang('edit'); ?></a>
						<a href="<?php echo site_url ('fees/heads/delete/'.$row->id); ?>" class="btn btn-default btn-flat" 
							onclick="return confirm ('<?php echo $delete_msg ?>')"> <i class="fa fa-trash-o"></i>  <?php echo lang('delete'); ?>
						</a>
						
					  </td>
					</tr>
					<?php } ?>
                </tbody>
                <tfoot>
					<tr>
					  <th><?php echo lang('sr.no') ?></th>
					  <th><?php echo lang('fee_heads') ?></th>
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
  