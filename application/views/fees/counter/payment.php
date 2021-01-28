<link rel="stylesheet" href="<?php echo site_url('assets/common/plugins/iCheck/flat/red.css'); ?>" >
<script type="text/javascript" src="<?php echo site_url ('assets/common/plugins/iCheck/icheck.js'); ?>" ></script>
<link rel="stylesheet" href="<?php echo site_url() ?>assets/common/plugins/datepicker/datepicker3.css" >
<script type="text/javascript" src="<?php echo site_url() ?>assets/common/plugins/datepicker/bootstrap-datepicker.js" ></script>

<div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $page_title ?>
      </h1>
      <?php echo $breadcrumb; ?>	  
    </section>
	<form method="post">
		<section class="content  main_student">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php if (!empty ($stu_siblings)) {  ?>
						<div class="box box-danger">
							<div class="box-header with-border">
								<h3 class="box-title"><?php echo lang('siblings')  ?></h3>
							</div>
							<div class="box-body">
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
										  <th><?php echo lang('enrol_no') ?></th>
										  <th><?php echo lang('student').' '.lang('name') ?></th>
										  <th><?php echo lang('father').' '.lang('name')  ?></th>
										  <th><?php echo lang('class') ?></th>
										  <th><?php echo lang('action') ?></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($stu_siblings as $stu_sibling) { ?>
											<tr>
												<td><?php echo $stu_sibling->enrol_no ?></td>
												<td><?php echo ucwords($stu_sibling->fname).' '.$stu_sibling->mname.' '.$stu_sibling->lname ?></td>
												<td><?php echo ucwords($stu_sibling->f_name) ?></td>
												<td><?php echo $stu_sibling->class_name.' '.$stu_sibling->section_name ?></td>
												<td><button type="button" class="btn btn-danger btn-flat" onclick="sibling_add_to_pay(<?php echo $stu_sibling->id ?>)"><?php echo lang('add_to_pay') ?></button></td>
											</tr>
										<?php } ?>
									</tbody>				  
								</table>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="box box-danger">
						<div class="box-header with-border">
							<div class="col-md-3">
								<?php 
									if (!empty ($student->s_img)) {
										$img = $student->s_img;
									}
									else {
										$img = ($student->gender == 0) ? 'm_002.png' : 'f_005.png';
									}
								?>
								<img src="<?php echo site_url('upload/users/'.$img) ?>" class="img-responsive" style="width:120px; height:120px;">
							</div>
							<div class="col-md-6">
								<input type="hidden" name = "student_id[]" value = "<?php echo $student->id ?>">
								<div class="row">
									<label class="col-md-5"><?php echo lang('enrol_no') ?> : </label>
									<label class="col-md-6"><?php echo ucwords($student->enrol_no) ?></label>
								</div>
								<div class="row">
									<label class="col-md-5"><?php echo lang('name') ?> : </label>
									<label class="col-md-6"><?php echo ucwords($student->fname).' '.$student->mname.' '.$student->lname ?></label>
								</div>
								<div class="row">
									<label class="col-md-5"><?php echo lang('father').' '.lang('name') ?> : </label>
									<label class="col-md-6"><?php echo ucwords($student->f_name) ?></label>
								</div>
								<div class="row">
									<label class="col-md-5"><?php echo lang('class') ?> : </label>
									<label class="col-md-6"><?php echo ucwords($student->class_name).' '.$student->section_name ?></label>
								</div>
							</div>
						</div>
						<div class="box-body stu_<?php echo $student->id ?>">
							<div>
									<button type="button" class="btn btn-danger btn-flat pull-right" onclick="payment_window(<?php echo $student->id ?>)" style="margin-bottom:8px;" ><?php echo lang('pay') ?></button>
								</div>
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th></th>
											<th><?php echo lang('effective_date') ?></th>
											<th><?php echo lang('groups') ?></th>
											<th><?php echo lang('amount') ?></th>
										</tr>
									</thead>
									<tbody>
										<?php if (!empty($fbills)) { foreach ($fbills as $fbill) { 
											  	$fast_due_amount = $fbill->fbill_amount - $fbill->paid_fast_bill;
												$fast_due_amount = ($fast_due_amount == 0) ? 'Nill' : $fast_due_amount;
											  	$fast_checkbox = ($fast_due_amount != 'Nill') ? '<input type="checkbox" name = "fast['.$student->id.'][]" class="check flat_check fast" value="'.$fbill->fbill_id.'"">' :	''; 	
										?>
											<tr>
												<td><?php echo $fast_checkbox ?></td>
												<td></td>
												<td><?php echo $fbill->fbill_name ?></td>
												<td><?php echo $fast_due_amount  ?></td>
											</tr>
										<?php }} ?>
										<?php if (!empty ($groups))  { foreach ($groups as $group) { 
											  $due_amount = $group->amount - $group->amount_recieved ;
											  $due_amount = ($due_amount == 0) ? 'Nill' : $due_amount;
											  $checkbox = ($due_amount != 'Nill') ? '<input type="checkbox" name = "groups['.$student->id.'][]" class="check flat_check groups" value="'.$group->id.'">' :	''; 	
										?>
										<tr>
											<td><?php echo $checkbox ?></td>
											<td><?php echo $group->effective_date ?></td>
											<td><?php echo $group->name ?></td>
											<td><?php echo $due_amount  ?></td>
										</tr>
										<?php }} ?>
									</tbody>
								</table>
								
						</div>			
					</div>
				</div>	
				<div class="col-md-6 col-sm-6 col-xs-12 heads_<?php echo $student->id ?>">
					
				</div>			
			</div>
		</section>
		<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12 pull-right">
					<div class="box box-danger">
						<div class="box-body">
							<div class="row">
								<label class="col-md-4"><?php echo lang('date') ?></label>
								<div class="col-md-4" style="margin-top:5px" >	
									<input type="text" name="date"  value="<?php echo date('Y-m-d') ?>"  class="form-control datepicker" > 
								</div>
							</div>	
							<div class="row">
								<label class="col-md-4"><?php echo lang('total_due')?></label>
								<div class="col-md-4" style="margin-top:5px" >	
									<input type="text" disabled="disabled" name="total_due" class="form-control" id="total_due" value="" > 
								</div>
							</div>
							<div class="row">
								<label class="col-md-4"><?php echo lang('total_paid')?></label>
								<div class="col-md-4" style="margin-top:5px" >	
									<input type="text" disabled="disabled" name="total_paid" class="form-control" id="total_paid"  value="" > 
								</div>
							</div>	
							<div class="row">
								<label class="col-md-4"><?php echo lang('total_difference')?></label>
								<div class="col-md-4" style="margin-top:5px" >	
									<input type="text" disabled="disabled" name="total_difference" class="form-control" id="difference"  value="" > 
								</div>
							</div>
							<div class="row">
								<label class="col-md-4"><?php echo lang('desc') ?></label>
								<div class="col-md-4" style="margin-top:5px" >	
									<textarea name="desc" rows="3" class="form-control"></textarea>
								</div>
							</div>	
							<div class="row">
								<div  class="col-md-12">
									<input type="submit" name="submit" value="<?php echo lang('charge') ?>" class="btn btn-danger btn-flat pull-right" />
								</div>
							</div>
						</div>
					</div>
				</div>	
		</div>
	</form>	
</div>	
<script type="text/javascript">
	$('input.flat_check').iCheck({
    	checkboxClass: 'icheckbox_flat-red',
		 radioClass: 'iradio_flat-red'
  	});
	$('.datepicker').datepicker({
		autoclose : true ,
		format: "yyyy-mm-dd",
	});
	/*$('.check_all').on('ifChecked',function (){
		$('.check').iCheck('check');
	});
	$('.check_all').on('ifUnchecked',function (){
		$('.check').iCheck('uncheck');
	});*/
	$('.check').on('ifChecked',function (){
		var result = '0';
	   	$('.check').each(function(){
			 if($(this).prop("checked") == true) {
				result = parseInt(result + 1);
			 }
			 if (result > 10){
					alert('Procced at your own risk,You have select more than 10 records which may DAMAGE RECIPT ALIGNMENT');
			}  
	   });
	});
	function sibling_add_to_pay(sib_id) {
		var avalability = $('.main_student').find('.stu_'+sib_id);
			if (avalability.length == 0) {
			$.ajax ({
				url:'<?php echo site_url('fees/counter/ajax_sibling_window') ?>',
				type:'Post',
				data:{sib_id:sib_id},
				success : function (result){
					$('.main_student').append(result);
					$('.pay').click(function (){
						payment_window($(this).val());
					});
					$('input.flat_check').iCheck({
						checkboxClass: 'icheckbox_flat-red',
						 radioClass: 'iradio_flat-red'
					});
					/*$('.check_all').on('ifChecked',function (){
						var main_div = $(this).parent('div').parent('th').parent('tr').parent('thead').parent('table').find('.check');
						$(main_div).iCheck('check');
					});
					$('.check_all').on('ifUnchecked',function (){
						var main_div = $(this).parent('div').parent('th').parent('tr').parent('thead').parent('table').find('.check');
						$(main_div).iCheck('uncheck');
					});*/
					$('.check').on('ifChecked',function (){
						var result = '0';
						$('.check').each(function(){
							 if($(this).prop("checked") == true) {
								result = parseInt(result + 1);
							 }
							 if (result > 10){
									alert('Procced at your own risk,You have select more than 10 records which may DAMAGE RECIPT ALIGNMENT');
							}  
					   });
					});
					$('.remove_sib').click(function (){
						var remove_div = $(this).parent('div').parent('div').parent('div');
						$(remove_div).remove();
						final_payment();
					});
				}
			});	
		}
	}
	
	function payment_window(stu_id) {
		var groups = [];
		var fasts = [];
		$( ".stu_"+stu_id ).find('.groups').each(function( index ) {
		  if($(this).prop("checked") == true) {
		  	groups.push($(this).val());
		  }
		});
		$( ".stu_"+stu_id ).find('.fast').each(function( index ) {
		  if($(this).prop("checked") == true) {
		  	fasts.push($(this).val());
		  }
		});
		if (groups.length != 0 || fasts.length != 0) {
			$.ajax ({
				url:'<?php echo site_url('fees/counter/ajax_payment_window') ?>',
				type:'Post',
				data:{groups:groups,fasts:fasts,stu_id:stu_id},
				success : function (result){
					if (result.length != 0) {
						$('.heads_'+stu_id).html(result);
						$('.datepicker').datepicker({
							autoclose : true ,
							format: "yyyy-mm-dd",
						});
						$('.heads_'+stu_id).find('.wallet_amount').blur(function (){
							$('.heads_'+stu_id).find('.head_amount').blur();	
						});
						$('.heads_'+stu_id).find('.head_amount').on('keyup keypress',function (){
							var total_amount = 0;
							var total_amount_with_wallet = 0;
							$.each( $('.heads_'+stu_id).find('.head_amount'), function( i, val ) {
								if (Number($(this).attr('data-value')) < $(this).val()){
									alert ('Amount must be smaller than '+$(this).attr('data-value'));
									$(this).val($(this).attr('data-value'));
									$(this).focus();
								}
								total_amount += Number($(this).val());
								total_amount_with_wallet = total_amount + Number($('.heads_'+stu_id).find('.wallet_amount').val());
							});
							$('.heads_'+stu_id).find('.total_paid').val(total_amount_with_wallet);
							var difference = Number(total_amount - $('.heads_'+stu_id).find('.total_due').val());
							if (difference.length != 0 && difference < 0) {
								var difference_html =   '<div class="row">'+
															'<label class="col-md-4"><?php echo lang('difference') ?></label>'+
															'<div class="col-md-4" style="margin-top:5px" >'+
																'<input type="text" readonly name="difference['+stu_id+']" class="form-control difference"  value="'+difference+'" >'+
															'</div>'+
														'</div>'+
														'<div class="row" style="margin-top: 8px;">'+
															'<label class="col-md-4"><?php echo lang('difference').' '.lang('type')?></label>'+
															'<input type="radio" value="pay_later" name="diff_type['+stu_id+']" class="flat_check diff_type" checked = "checked">'+
															'<label><?php echo lang('pay_later')?></label>'+
															'<input type="radio" value="discount" name="diff_type['+stu_id+']" class="flat_check diff_type" >'+
															'<label><?php echo lang('discount');?></label>'+
															'<input type="radio" value="adjust_excess" name="diff_type['+stu_id+']" class="flat_check diff_type">'+
															'<label><?php echo lang('adjust')?></label>'+
														'</div>'+
														'<div class="row adjust_excess_div" style = "display:none">'+
															'<label class="col-md-4"><?php echo lang('adjust_excess')?></label>'+
															'<div class="col-md-4" style="margin-top:5px" >	'+
																'<input type="number" step = "0.02" name="adjust_excess['+stu_id+']"  class="form-control adjust_excess" value="" >'+ 
															'</div>'+
														'</div>';
									$('.heads_'+stu_id).find('.difference_div').html(difference_html);
									$('.heads_'+stu_id).find('.wallet').hide();
									$('.heads_'+stu_id).find('.wallet').find('input').val('');
									$('.diff_type').on('ifChecked', function(event){
									  var adjust_excess_div = $(this).parent('div').parent('div').parent('.difference_div').find('.adjust_excess_div');
									  if ($(this).val() == 'adjust_excess') {
										$(adjust_excess_div).show();
									  }
									  else{
										$(adjust_excess_div).hide();
									  }
									});
									$('.heads_'+stu_id).find('.adjust_excess').blur(function (){
										var input_val = Number ($(this).val());
										var wallet_bal = Number ($('.heads_'+stu_id).find('.wallet_bal').val());
										if ( wallet_bal >= input_val) {
											if (Math.abs(difference) < input_val){
												alert ('Value Must be smaller than '+Math.abs(difference));
												$(this).val('');
											}else{
											
											}
										}else{
											alert ('Wallet Balace is lower than Input value');
											$(this).val('');
										}
										
									});
									$('input.flat_check').iCheck({
										checkboxClass: 'icheckbox_flat-red',
										 radioClass: 'iradio_flat-red'
									});
									$('.check_all').on('ifChecked',function (){
										$('.check').iCheck('check');
									});
									$('.check_all').on('ifUnchecked',function (){
										$('.check').iCheck('uncheck');
									});
							}
							else {
								$('.heads_'+stu_id).find('.difference_div').html('');
								$('.heads_'+stu_id).find('.wallet').show();
							}
						});
						final_payment();
						$('.head_amount').on('keyup keypress blur change',function (){
							final_payment();	
						});	
					}
					else {
						$('.heads_'+stu_id).html('');
					}	
				}	
			});
		} else {
			$('.heads_'+stu_id).html('');
			final_payment();
		}
	}	
	function final_payment(){
		var total_paid = 0;
		var total_due = 0;
		var difference = 0;
		var total_wallet = 0;
		$.each( $('.head_amount'), function( i, val ) {
			total_paid += Number($(this).val());
		});
		$.each( $('.wallet_amount'), function( i, val ) {
			total_wallet += Number($(this).val());
		});
		$.each( $('.total_due'), function( i, val ) {
			total_due += Number($(this).val());
		});
		difference = total_paid - total_due;	
		$('#total_paid').val(total_paid + total_wallet);
		$('#total_due').val(total_due);
		$('#difference').val(difference);
	}
	
</script>