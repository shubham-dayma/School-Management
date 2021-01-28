<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?php echo site_url(); ?>assets/admin/plugins/datatable_buttons/buttons.dataTables.min.css" />
<link rel="stylesheet" href="<?php echo site_url() ?>assets/common/plugins/datepicker/datepicker3.css" >
<script type="text/javascript" src="<?php echo site_url() ?>assets/common/plugins/datepicker/bootstrap-datepicker.js" ></script>
<script src="<?php echo site_url(); ?>assets/admin/plugins/datatable_buttons/dataTables.buttons.min.js"></script>
<script src="<?php echo site_url(); ?>assets/admin/plugins/datatable_buttons/buttons.flash.min.js"></script>
<script src="<?php echo site_url(); ?>assets/admin/plugins/datatable_buttons/pdfmake.min.js"></script>
<script src="<?php echo site_url(); ?>assets/admin/plugins/datatable_buttons/vfs_fonts.js"></script>
<script src="<?php echo site_url(); ?>assets/admin/plugins/datatable_buttons/buttons.html5.min.js"></script>
<script src="<?php echo site_url(); ?>assets/admin/plugins/datatable_buttons/buttons.print.min.js"></script>

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
					<input type="text" name="start_date" class="form-control datepicker" placeholder = '<?php echo lang('start_date') ?>'  
					value="<?php echo !empty(set_value('start_date')) ? set_value('start_date') : date("Y-m-d", strtotime("-1 month",strtotime( date('Y-m-d')))); ?>" />
				</div>
				<div class="col-md-3">
					<input type="text" name="end_date" class="form-control datepicker" placeholder = '<?php echo lang('end_date') ?>'  
					value="<?php echo !empty(set_value('end_date')) ? set_value('end_date') : date('Y-m-d');  ?>" />
				</div>
				<div class="col-md-3">
					<input type="submit" class="btn btn-danger btn-flat" name="submit" value="<?php echo lang('search') ?>" />
				</div>
			  </form>
            </div>
		   <div class="box-body">
              				<?php if (!empty ($recipts)) { ?>
							<table id="example" class="table table-bordered table-striped">
								<thead>
									<tr>
									  <th><?php echo lang('sr.no') ?></th>
									  <th><?php echo lang('recipt').' '.lang('date') ?></th>
									  <th><?php echo lang('recipt_no') ?></th>
									  <th><?php echo lang('student').' '.lang('name') ?></th>
									  <th><?php echo lang('father').' '.lang('name') ?></th>
									  <th><?php echo lang('class') ?></th>
									  <th><?php echo lang('amount') ?></th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 0; foreach ($recipts as $recipt) { $i++;?>
									<tr>
									  <td><?php echo $i ?></td>
									   <td><?php echo $recipt->recipt_date ?></td>
									  <td><?php echo $recipt->recipt_no ?></td>
									  <td><?php echo ucwords ($recipt->fname.' '.$recipt->mname.' '.$recipt->lname) ?></td>
									  <td><?php echo $recipt->f_name; ?></td>
									  <td><?php echo $recipt->class.' '.$recipt->section; ?></td>
									  <td><?php echo $recipt->total_pay; ?></td>
									  
									</tr>
									<?php } ?>
								</tbody>
							</table>
							<?php } ?>
            </div>
            <!-- /.box-body -->
		</div>	
		   
        </div>
      </div>
    </section>
  </div>
  
 <script>
 	<?php if (!empty($recipts)) { ?>
		$(document).ready(function (){
			$('#example').DataTable( {
				"ordering": false,
				dom: 'Bfrtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				]
			});
		});
	 <?php } ?> 
	$('.datepicker').datepicker({
		autoclose : true ,
		format: "yyyy-mm-dd",
	});
</script>
