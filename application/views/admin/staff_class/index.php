<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
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
            <!--<div class="box-header with-border">
              <h3 class="box-title">
			  	<a href="<?php echo site_url('admin/category/form');?>" class="btn bg-purple btn-flat">
					<i class="fa fa-plus"></i>
					 <?php echo lang('add').' '.lang('category')?>
				</a>
			  </h3>
            </div>-->
		   <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
					<tr>
					  <th style="display:none"></th>
					  <th><?php echo lang('class') ?></th>
					  <th><?php echo lang('staff') ?></th>
					</tr>
                </thead>
                <tbody>
					<?php  $i =0 ; if (!empty($classes)){ foreach ($classes as $class){ $sections = $this->custom_lib->get_where('sections','class_id',$class->id)->result();
								if (!empty ($sections)) { foreach ($sections as $section){ $i++;  $icon = 0; 
					?>
					<tr>
					  <td style="display:none"><?php echo $i; ?></td>
					  <td>
					   		<?php echo $class->name.' '.$section->name ?>
					  </td>
					  <td>
					  	<select name="staff_id" class="staff_id">
							<option value="zero"><?php echo lang('select_staff') ?></option>
							<?php if (!empty($staffs)){ foreach ($staffs as $staff){ 
									$assigned_class = $this->Staffs->get_staff_class($staff->id,$this->session->userdata('academic_session'));
									$sel = '';
									if (!empty ($assigned_class)){
										if ($section->id == $assigned_class->section_id){
											$sel = 'selected="selected"';
											$icon  = 1;
										}
									}
									 
							?>
							<option value="<?php echo $staff->id.','.$section->id ?>" <?php echo $sel ?> ><?php echo ucwords($staff->fname.' '.$staff->lname) ?></option>
							<?php }} ?>
						</select>
						<?php if ($icon == 1){ ?>
						<i class="fa fa-trash-o remove_staff" style="margin-left: 5px;" data-value = '<?php echo $section->id;  ?>'  ></i>
					  	<?php } $icon = 0;  ?>
					  </td>
					</tr>
					<?php }} }}?>
                </tbody>
                <tfoot>
					<tr>
						<th style="display:none"></th>
					  <th><?php echo lang('class') ?></th>	
					  <th><?php echo lang('staff') ?></th>
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
	$('.staff_id').on('change',function (){
		if ($(this).val() != 'zero') {
			call_loader();
			$.ajax ({
				url:'<?php echo site_url('admin/staff_class/assign_class'); ?>',
				type:'Post',
				data:{staff_section:$(this).val()},
				success : function (result){
					if(result == 0){
						alert ('Staff is already assigned to some section');
						$(this).val('zero');
					}
					location.reload();
				}	
			});
		}	
	});
	$('.remove_staff').on('click',function (){
		if ($(this).attr('data-value') != '') {
			call_loader();
			$.ajax ({
				url:'<?php echo site_url('admin/staff_class/remove_assigned_section'); ?>',
				type:'Post',
				data:{section_id:$(this).attr('data-value')},
				success : function (result){
					//alert (result);
					location.reload();

				}	
		});
	   }	
	});
</script>