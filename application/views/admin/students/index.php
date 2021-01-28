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
          	<div class="box box-purple" style="padding:5px;">
          		<div class="row">
            	<div class="col-xs-3"> 
				 <ul class="nav nav-tabs tabs-left"><!-- 'tabs-right' for right tabs -->
					<?php if (!empty ($classes)) { 
							foreach ($classes as $class) { 
								$sections = $this->custom_lib->get_where('sections','class_id',$class->id)->result();
								if (!empty ($sections)){ 
									foreach ($sections as $section) {
						?>
					<li class="<?php echo ($section->id == $active_tab) ? 'active' :'' ?>">
						<a href="<?php echo site_url ('admin/student/sections/'.$section->id) ?>"><?php echo $class->name.' '.$section->name ?></a>
					</li>
					<?php }}}}?>
				 </ul>
				</div>
				<div class="col-xs-9" style="padding-left: 0px;padding-right: 30px;">
					<div class="tab-content">
					  <div class="tab-pane active">
					  		<h3 class="box-title">
								<a href="<?php echo site_url('admin/student/form?cs='.$active_tab);?>" class="btn bg-purple btn-flat">
									<i class="fa fa-plus"></i>
									 <?php echo lang('add').' '.lang('student') ?>
								</a>
								<?php if($this->as->auto_roll_no == 1){ ?>
								<a href="<?php echo site_url('admin/student/genrate_roll/'.$active_tab);?>" class="btn bg-purple btn-flat">
									 <?php echo lang('regenrate_roll_no') ?>
								</a>
								<?php } ?>
							  </h3>
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
									  <th><?php echo lang('sr.no') ?></th>
									  <th><?php echo lang('enrol_no') ?></th>
									  <th><?php echo lang('student').' '.lang('name') ?></th>
									  <th><?php echo lang('father').' '.lang('name') ?></th>
									  <th><?php echo lang('roll_no') ?></th>
									  <th><?php echo lang('action') ?></th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 0; foreach ($students as $student) { $i++; if ($student->academic_status == 1) {?>
									<tr>
									  <td><?php echo $i ?></td>
									  <td><?php echo $student->enrol_no ?></td>
									  <td>
										<a href="<?php echo site_url ('admin/student/profile/'.$student->id); ?>" style="color:#605ca8">
										<?php echo ucwords ($student->fname.' '.$student->lname) ?>
										</a>
									  </td>
									  <td><?php echo $student->f_name; ?></td>
									   <td><?php echo $student->roll_no; ?></td>
									  <td style="display: flex">
										<a href="<?php echo site_url ('admin/student/form/'.$student->id); ?>" class="btn btn-info btn-flat">
											<i class="fa fa-pencil"></i> 
											<?php echo lang('edit') ?>
										</a>
									  </td>
									</tr>
									<?php }} ?>
								</tbody>
								<tfoot>
									<tr>
									  <th><?php echo lang('sr.no') ?></th>
									  <th><?php echo lang('enrol_no') ?></th>
									  <th><?php echo lang('student').' '.lang('name') ?></th>
									  <th><?php echo lang('father').' '.lang('name') ?></th>
									  <th><?php echo lang('roll_no') ?></th>
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
  