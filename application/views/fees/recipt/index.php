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
              <form method="post" class="form-horizontal">
			  	<div class="col-md-3">
					<input type="text" name="recipt_no" class="form-control" placeholder = '<?php echo lang('recipt_no') ?>'  value="<?php echo set_value('recipt_no'); ?>" />
				</div>
				<div class="col-md-3">
					<input type="text" name="enrol_no" class="form-control" placeholder = '<?php echo lang('enrol_no') ?>'  value="<?php echo set_value('enrol_no'); ?>" />
				</div>
				<div class="col-md-3">
					<input type="text" name="name" class="form-control" placeholder = '<?php echo lang('student').' '.lang('first').' '.lang('name') ?>' 
					value="<?php echo set_value('name'); ?>"/>
				</div>
				<div class="col-md-3">
					<input type="submit" class="btn btn-danger btn-flat" name="submit" value="<?php echo lang('search') ?>" />
				</div>
			  </form>
            </div>
		   <div class="box-body">
              				<?php if (!empty ($students)) { ?>
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
									  <th><?php echo lang('sr.no') ?></th>
									  <th><?php echo lang('recipt_no') ?></th>
									  <th><?php echo lang('enrol_no') ?></th>
									  <th><?php echo lang('student').' '.lang('name') ?></th>
									  <th><?php echo lang('father').' '.lang('name') ?></th>
									  <th><?php echo lang('recipt').' '.lang('date') ?></th>
									  <th><?php echo lang('action') ?></th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 0; foreach ($students as $student) { $i++;?>
									<tr>
									  <td><?php echo $i ?></td>
									  <td><?php echo $student->recipt_no ?></td>
									  <td><?php echo $student->enrol_no ?></td>
									  <td><?php echo ucwords ($student->fname.' '.$student->mname.' '.$student->lname) ?></td>
									  <td><?php echo $student->f_name; ?></td>
									   <td><?php echo $student->recipt_date ?></td>
									  <td style="display: flex">
										<a href="<?php echo site_url ('fees/recipt/print/'.$student->recipt_no); ?>" class="btn btn-default btn-flat" >
											<i class="fa fa-pencil"></i> 
											<?php echo lang('select').' '.lang('student') ?>
										</a>
									  </td>
									</tr>
									<?php } ?>
								</tbody>
								<tfoot>
									<tr>
									  <th><?php echo lang('sr.no') ?></th>
									  <th><?php echo lang('recipt_no') ?></th>
									  <th><?php echo lang('enrol_no') ?></th>
									  <th><?php echo lang('student').' '.lang('name') ?></th>
									  <th><?php echo lang('father').' '.lang('name') ?></th>
									  <th><?php echo lang('recipt').' '.lang('date') ?></th>
									  <th><?php echo lang('action') ?></th>
									</tr>
								</tfoot>
							</table>
							<?php } ?>
            </div>
            <!-- /.box-body -->
		</div>	
		   
        </div>
      </div>
    </section>
  </div>
  