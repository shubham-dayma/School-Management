<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?php echo site_url('assets/common/plugins/datepicker/datepicker3.css'); ?>" >
<script type="text/javascript" src="<?php echo site_url ('assets/common/plugins/datepicker/bootstrap-datepicker.js'); ?>" ></script>

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
			  	<a href="<?php echo site_url('admin/staff/form');?>" class="btn bg-purple btn-flat">
					<i class="fa fa-plus"></i>
					 <?php echo lang('add').' '.lang('staff') ?>
				</a>
			  </h3>
            </div>
		   <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
					<tr>
					  <th><?php echo lang('sr.no') ?></th>
					  <th><?php echo lang('staff').' '.lang('name') ?></th>
					  <th><?php echo lang('status') ?></th>
					  <th><?php echo lang('action') ?></th>
					</tr>
                </thead>
                <tbody>
					<?php $i = 0; $restrication = array ('Admin','Fees'); foreach ($result as $row) { if (!in_array($row->type , $restrication)) { $i++;?>
					<tr>
					  <td><?php echo $i ?></td>
					  <td>
					  	<a href="<?php echo site_url ('admin/staff/profile/'.$row->id); ?>" style="color:#605ca8">
						<?php echo ucwords ($row->fname.' '.$row->lname); ?>
						</a>
					  </td>
					  <td>
					  	<form method="post" action="<?php echo site_url('admin/staff/index/	'.$row->id); ?>">
						   	 <select class="sel_status" name="status" style="padding: 5px;">
						   	 	<option value="0" <?php echo ($row->working_status == 0) ? 'selected = "selected"' : '' ?>><?php echo lang('working'); ?></option>
						   	 	<option value="1" <?php echo ($row->working_status == 1) ? 'selected = "selected"' : '' ?>><?php echo lang('terminated'); ?></option>
						   	 </select>
						   	 
						   	 <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="myModal">
  								<div class="modal-dialog modal-sm" role="document">
  									<div class="modal-content">
  										<div id="working-modal">
								      		<div class="modal-header" >
								        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        		<h4 class="modal-title"><?php echo lang('doj'); ?></h4>
								      		</div>
								      		<div class="modal-body">
								        		<div class="input-group date">
												    <input type="text" class="form-control" value="<?php echo $row->doj; ?>" name="doj" id="doj">
												    <div class="input-group-addon">
												        <span class="glyphicon glyphicon-th"></span>
												    </div>
												</div>
								      		</div>
								      	</div>
	    								<div id="terminate-modal">
								      		<div class="modal-header">
								        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        		<h4 class="modal-title"><?php echo lang('dot'); ?></h4>
								      		</div>
								      		<div class="modal-body">
								        		<div class="input-group date">
												    <input type="text" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="dot" id="dot">
												    <div class="input-group-addon">
												        <span class="glyphicon glyphicon-th"></span>
												    </div>
												</div>
								      		</div>
								      	</div>
							      	 	<div class="modal-footer">
							       		 	<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('close') ?></button>
							       		 	<button type="submit" class="btn btn-primary"><?php echo lang('save') ?></button>
							      		</div>
							    	</div><!-- /.modal-content -->
							  	</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
					   	 </form>	
					  </td>
					  <td style="display: flex">
					  	<a href="<?php echo site_url ('admin/staff/form/'.$row->id); ?>" class="btn btn-info btn-flat"><i class="fa fa-pencil"></i>  <?php echo lang('edit'); ?></a>
						</a>
					  </td>
					</tr>
					<?php }} ?>
                </tbody>
                <tfoot>
					<tr>
					  <th><?php echo lang('sr.no') ?></th>
					  <th><?php echo lang('staff').' '.lang('name'); ?></th>
					  <th><?php echo lang('status') ?></th>
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
  
<script type="text/javascript">
  $(document).ready(function(){
  	$("select.sel_status").on("change", function () {        
	    $modal = $('#myModal');
	    $tmodal = $('#terminate-modal');
	    $wmodal = $('#working-modal');
	    if($(this).val() === '0'){
	    	//alert('');
	        $modal.modal('show');
	        $tmodal.addClass('hidden');
	        $wmodal.removeClass('hidden');

	    }
	    else if($(this).val() === '1')
	    {
	    	//alert('working');
	        $modal.modal('show');   
	        $tmodal.removeClass('hidden');
	        $wmodal.addClass('hidden');
	        
	    }
	    
	});
	$('#dot').datepicker({
		autoclose : true ,
		format: "yyyy/mm/dd",
	});
	$('#doj').datepicker({
		autoclose : true ,
		format: "yyyy/mm/dd",
	});
});
</script>