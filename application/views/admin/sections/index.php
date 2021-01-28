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
              <h3 class="box-title">
			  	<a href="<?php echo site_url('admin/sections/form');?>" class="btn bg-purple btn-flat">
					<i class="fa fa-plus"></i>
					 <?php echo lang('add').' '.lang('section'); ?>
				</a>
			  </h3>
            </div>
		   <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
					<tr>
					   <th style="display:none"><?php echo 'hidden field for proper arrangment' ?></th>
					  <th><?php echo lang('sr.no') ?></th>
					  <th><?php echo lang('classes') ?></th>
					  <th><?php echo lang('action') ?></th>
					</tr>
                </thead>
                <tbody>
					<?php $i = 0; foreach ($result as $row) { $i++;?>
					<tr>
					  <td style="display:none"><?php echo $i ?></td>
					  <td><?php echo $i ?></td>
					  <td>
					  	<?php echo $row->name ?>
						
					  </td>
					  <td>
					  
					  </td>
					</tr>
					<?php $sections = $this->custom_lib->get_where('sections','class_id',$row->id)->result(); if (!empty ($sections)) { foreach ($sections as $section) { ?>
					<tr>
					  <td style="display:none"><?php echo $i ?></td>
					  <td></td>
					  <td style="padding-left:25px;">
					  	<a href="<?php echo site_url ('admin/sections/profile/'.$section->id); ?>" style="color:#605ca8">
						<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
						<?php echo $section->name ?>
					   </a>
					  </td>
					  <td style="display: flex">
					  	<a href="<?php echo site_url ('admin/sections/form/'.$section->id); ?>" class="btn btn-info btn-flat">
							<i class="fa fa-pencil"></i>  <?php echo lang('edit'); ?>
						</a>
						<a href="<?php echo site_url ('admin/sections/apply_subjects/'.$section->id); ?>" class="btn btn-info btn-flat">
							<i class="fa fa-pencil"></i>  <?php echo lang('apply_subjects'); ?>
						</a>
					  </td> 	
					</tr> 	
					<?php } }} ?>	
                </tbody>
                <tfoot>
					<tr>
					   <th style="display:none"><?php echo 'hidden field for proper arrangment' ?></th>
					  <th><?php echo lang('sr.no') ?></th>
					  <th><?php echo lang('classes') ?></th>
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
  