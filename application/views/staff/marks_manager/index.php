<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link  href="<?php echo site_url('assets/common/bootstrap/css/bootstrap.vertical-tabs.css'); ?>"  rel="stylesheet" />
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
          		<div class="row" style="padding:10px;">
            	<div class="col-xs-3"> 
				 <ul class="nav nav-tabs tabs-left"><!-- 'tabs-right' for right tabs -->
					<?php if (!empty ($roles)) { 
							foreach ($roles as $role) { 
					?>			
					<li class="<?php echo ($role->controller == $this->uri->segment(2)) ? 'active' : '' ?>">
						<a href="<?php echo site_url ('staff/'.$role->controller) ?>"><?php echo ucwords ($role->name) ?></a>
					</li>
					<?php }}?>
				 </ul>
				</div>
				<div class="col-xs-9" style="padding-left: 0px;padding-right: 30px;">
					<div class="tab-content">
					  <div class="tab-pane active">
					  		<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
									  <th><?php echo lang('sr.no') ?></th>
									  <th><?php echo lang('classes') ?></th>
									  <th><?php echo lang('action') ?></th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 0; foreach ($result as $row) { $i++;?>
									<tr>
									  <td><?php echo $i ?></td>
									  <td>
										<a href="<?php echo site_url ('staff/marks_manager/class_section/'.$row->id); ?>" style="color:#605ca8">
										<?php echo $row->name ?>
										</a>
									  </td>
									  <td style="display: flex">
										<a href="<?php echo site_url ('staff/marks_manager/marks_criteria/'.$row->id); ?>" class="btn btn-warning btn-flat"> 
										<?php echo lang('specify_marks_criteria_for_subjects') ?>
										</a>
									  </td>
									</tr>
									<?php } ?>
								</tbody>
								<tfoot>
									<tr>
									  <th><?php echo lang('sr.no') ?></th>
									  <th><?php echo lang('classes') ?></th>
									  <th><?php echo lang('action') ?></th>
									</tr>
								</tfoot>
							</table>  
					  </div>
					</div>
				</div>
			</div>
			</div>	
		</div>
      </div>
    </section>
  </div>
  