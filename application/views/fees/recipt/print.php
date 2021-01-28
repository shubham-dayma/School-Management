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
					 <?php echo $page_sub_title ?>
				 </h3>
			 </div>
			 <?php if (!empty($base_details)) { ?>
				 <div class="row" id="printcontent" style="padding:10px;" >
					<div class="col-md-12" style="width: 60%;">
						<p class="schoolname" align="center" style="font-size: 26px; margin-bottom: 5px;" > 
							<?php echo $this->setting->school_name;?>
						</p>
						<div align="center"> 
							<?php echo $this->setting->address.' '.lang('phone').' : '.$this->setting->phone;?>
						</div>
						<table>
							<tbody>
								<tr>
									<td style="width:70%">
										<p><?php echo lang('recipt_no') ?> 
											<span> <?php  echo $base_details->recipt_no ?> </span> 
										</p>
									</td>
									<td align="right">
										<p><?php echo lang('date').' : '.$base_details->recipt_date?></p>
									</td>
								</tr>
							</tbody>
						</table>
						<div>
							
							
						</div>
						
							
						
						
						<div><p><?php echo lang('father').' '.lang('name').' : '.ucwords($base_details->f_name.' '.$base_details->lname) ?></p></div>
						<div>
							<?php if(!empty($head_details)|| !empty($fast_bills)) { ?>
							<table cellpadding="5" cellspacing="1" border="1px" width="100%" style="text-align: center !important ;">
								<thead>
									<tr>
										<th style="text-align: center !important ;"><?php echo lang('sr.no') ?></th>
										<th style="text-align: center !important ;"><?php echo lang('student').' '.lang('name') ?></th>
										<th style="text-align: center !important ;"><?php echo lang('class') ?></th>
										<th style="text-align: center !important ;"><?php echo lang('fee_heads') ?></th>
										<th style="text-align: center !important ;"><?php echo lang('mounth') ?></th>
										<th style="text-align: center !important ;"><?php echo lang('amount') ?></th>
									</tr>
								</thead>
								<tbody>
									<?php $i =0;  if (!empty($fast_bills)) {foreach ($fast_bills as $fast_bill) { if ($fast_bill->paid_amount != '0.00') { $i++; ?>
									<tr>
										<td><?php echo $i ?></td>
										<td><?php echo ucwords($fast_bill->fname.' '.$fast_bill->lname.' '.$fast_bill->mname) ?></td>
										<td><?php echo $fast_bill->class_name ?></td>
										<?php if(strpos($fast_bill->fbill_name,'Day Boarding') !== FALSE){
											echo '<td>Day Boarding</td>';
											$fbill_name_chunks = explode(" ",$fast_bill->fbill_name);
											?> <td><?php echo $fbill_name_chunks[2]; ?></td> <?php
										} else { ?>
										<td><?php echo $fast_bill->fbill_name ?></td>
										<td>-</td>
										<?php } ?>
										
											
										
										<td><?php echo $fast_bill->paid_amount ?></td>
									</tr>
									<?php }}} ?>
									<?php if(!empty($head_details)) { foreach ($head_details as $head_detail) { if ($head_detail->amount != '0.00') { $i++; ?>
									<tr>
										<td><?php echo $i ?></td>
										<td><?php echo ucwords($head_detail->fname.' '.$head_detail->lname.' '.$head_detail->mname) ?></td>
										<td><?php echo $head_detail->class_name ?></td>
										<td><?php echo $head_detail->head_name ?></td>
										<td><?php echo $head_detail->group_name ?></td>
										<td><?php echo $head_detail->amount ?></td>
									</tr>
									<?php }}} ?>
								</tbody>
							</table>
							<?php } ?>
						</div>
						<table>
							<tbody>
								<tr>
									<td style="width:71%">
										<label><strong><?php echo lang('in_words') ?></strong></label>
										<span><?php echo ucwords(no_to_words($base_details->total_pay).' '.lang('rupees')) ?></span>
									</td>
									<td>
										<label> <strong> <?php echo lang('total_paid') ?> </strong></label>
										<span><?php echo $base_details->total_pay ?></span>
									</td>
								</tr>	
							</tbody>
						</table>	

						<?php if (!empty ($difference_details->excess_recieved) && $difference_details->excess_recieved != '0.00') { ?>

						<div>
							<label><strong><?php echo lang('excess_recieved') ?></strong></label>
							<span><?php echo $difference_details->excess_recieved ?></span>
						</div>
						<?php } ?>
						<?php if (!empty ($difference_details->excess_return) && $difference_details->excess_return != '0.00') { ?>
						<div>
							<label><strong><?php echo lang('excess_return') ?></strong></label>
							<span><?php echo $difference_details->excess_return ?></span>
						</div>
						<?php } ?>
						<?php if (!empty ($difference_details->discount) && $difference_details->discount != '0.00') { ?>
						<div>
							<label><strong><?php echo lang('discount_applied') ?></strong></label>
							<span><?php echo $difference_details->discount ?></span>
						</div>
						<?php } ?>
						
					<div style="margin-top: 70px;"><p><strong>Signature & Seal</strong></p></div>
					</div>
				 </div>
				 <div class="box-footer">
					<a href="<?php echo site_url ('fees/recipt'); ?>" class="btn btn-warning btn-flat"><?php echo lang('back') ?></a>
					<?php $cancel_url = ($base_details->recipt_status == 0) ? site_url ('fees/recipt/cancel/'.$base_details->recipt_no) :  '#';
						  $caption = ($base_details->recipt_status == 0) ? lang('cancel').' '.lang('recipt') : lang('canceled');
					?>
					<a href="<?php echo $cancel_url; ?>" class="btn btn-default btn-flat"><?php echo $caption ?></a>
					<a href="#" class="btn btn-danger btn-flat" id="printbutton"><?php echo lang('print') ?></a>
				</div>	
			<?php } else { ?>
				<p align="center">Invalid Recipt No</p>
			<?php } ?>						
		   </div>
		</div>
	   </div>
	<section> 
   </div>		 
   <script>
   	$("#printbutton").on("click", function () {
         $.ajax({
    		url:'<?php echo site_url('assets/admin/dist/css/certificates.css')?>'
		})
		.done(function(result){
			var divContents = $("#printcontent").html();
			var print_css = result;
			var printWindow = window.open('','','height=600,width=1600');
			printWindow.document.write('<html>');
			printWindow.document.write('<style>'+print_css+'@media print{');
			printWindow.document.write(print_css);
			printWindow.document.write('}</style>');
			printWindow.document.write('<body>');
			printWindow.document.write(divContents);
			printWindow.document.write('</body></html>');
			printWindow.document.close();
			printWindow.print();
		});
      });
   </script> 