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
			  	<?php echo lang('classes') ?>
			  </h3>
            </div>
		   <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
					<tr>
					  <th><?php echo lang('sr.no') ?></th>
					  <th><?php echo lang('classes') ?></th>
					  <th><?php echo lang('action') ?></th>
					</tr>
                </thead>
                <tbody>
					<?php $i = 0; foreach ($result as $row) { $i++; $sections = $this->custom_lib->get_where('sections','class_id',$row->id)->result();
						if (!empty($sections)) { foreach($sections as $section) {
					?>
					<tr>
					  <td><?php echo $i ?></td>
					  <td><?php echo $row->name.' '.$section->name ?></td>
					  <td style="display: flex">
					  	<a href="<?php echo site_url ('fees/fast_bills/apply_fbill/'.$this->uri->segment(4).'/'.$section->id); ?>" class="btn btn-danger btn-flat"><i class="fa fa-plus"></i>  
							<?php echo lang('apply').' '.lang('fast_bill'); ?></a>
					  </td>
					</tr>
					<?php } }} ?>
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
            <!-- /.box-body -->
		</div>	
		   
        </div>
      </div>
    </section>
  </div>
  