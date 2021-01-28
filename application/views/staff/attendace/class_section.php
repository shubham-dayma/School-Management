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
			<div class="box-body">
              <table class="table table-bordered table-striped">
                <thead>
					<tr>
					  <th><?php echo lang('sr.no') ?></th>
					  <th><?php echo lang('sections') ?></th>
					  <th><?php echo lang('action') ?></th> 
					</tr>
                </thead>
                <tbody>
					<?php  if (!empty ($result)) { $i = 0; foreach ($result as $row) { $i++;?>
					<tr>
					  <td><?php echo $i ?></td>
					  <td><?php echo $row->name ?></td>
					   <td>
					  	<a href="<?php echo site_url('staff/attendace/add/'.$row->id) ?>" class="btn btn-warning btn-flat"> 
					  	<?php echo lang('add_attendance') ?>
						</a>
					  </td>
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
  