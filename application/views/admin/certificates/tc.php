<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//echo '<pre>';print_r($row);die;
//echo '<pre>';print_r($this->setting);die;
?>
<link rel="stylesheet" href="<?php echo site_url('assets/admin/dist/css/certificates.css')?>" type="text/css" />
<link rel="stylesheet" href="<?php echo site_url('assets/common/plugins/datepicker/datepicker3.css'); ?>" >
<script type="text/javascript" src="<?php echo site_url ('assets/common/plugins/datepicker/bootstrap-datepicker.js'); ?>" ></script>
<style type="text/css">
.custom-addon{position:absolute; right: 15px; border-radius: 0px; padding: 9px 15px;}
.right-border{border-right:1px solid #ccc !important; }
.custom-addon i{margin: -5px;}
</style>

            <div class="content-wrapper">
                <section class="content-header">
                    <h1><?php echo $page_title; ?></h1>
                    <?php echo $breadcrumb; ?>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">
										 <?php echo $page_sub_title ?>
									 </h3>
								</div>
								 <?php if (!empty (validation_errors())) { ?>
								 <div class="alert alert-danger alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-ban"></i> Alert!</h4>
									<?php echo validation_errors(); ?>
								 </div>
								 <?php } ?>
                                <div class="box-body">
								   <?php if (!empty ($issued)) { ?>
                                   		<p class="bg-danger" style="padding: 10px;"><?php echo lang('tc_already_issued').$issued->issue_date; ?></p>
								   <?php } ?>
								   <div class="row">
									  	<form method="post" class="form-horizontal">
											<div class="col-md-4">
													<div class="form-group date"> 
													  <label for="name" class="col-sm-4 control-label"><?php echo lang('leaving_date'); ?></label>
													  <div class="col-sm-8">
													  	<div class="input-group-addon custom-addon right-border"><i class="fa fa-calendar"></i> </div>
														<input type="text" name="leaving_date" id="dol" class="form-control" value="<?php echo @$row->leaving_date ?>"  />
													  </div>
													</div>
												</div>
												<div class="col-md-6">	
													<div class="form-group"> 
													  <label for="name" class="col-sm-4 control-label"><?php echo lang('leaving_reason'); ?></label>
													  <div class="col-sm-8">
														<input type="text" name="reason_of_leaving" class="form-control" value="<?php echo @$row->reason_of_leaving ?>"  />
													  </div>
													</div>
												</div>
												<div class="col-md-2">	
														<input type="submit" name="submit" value="<?php echo lang('generate_tc')?>" class="btn bg-purple btn-flat"  />
												</div>
										</form>
									</div>
  									<?php if (!empty ($row)) {?>
									<?php $logo_url =  site_url('/upload/logo/'.$this->setting->logo) ?>
									<div class="row" id="printcontent" 
									background="<?php echo $logo_url ?>)">
	
										<div class="col-md-12">
											<p class="serialno" style="position: absolute;right: 5%;">Serial No. 
											<span> <!--data--> 2 </span>

											<p class="schoolname" align="center" style="font-size: 22px;"> 
											<!--data-->
											Sabari Vidya Vihar School 
											</p>

											<div align="center">
												<h1 style="font-size: 40px" class="color-red">Transfer Certificate</h1>
											</div>
											<p class="sname"> CERTIFIED That 
												<span style="margin-left: 10px"> <!--DATA --> CHIRAG JOSHI </span>
												<span style="position: absolute;right: 5%;">Son / Daughter of</span> 
											</p>
											<p class="mname"> Mother's Name
												<span style="margin-left: 10px"> <!--DATA --> CHIRAG JOSHI 
												</span>
											</p>

											<p class="fname"> Father's Name
												<span style="margin-left: 10px"> <!--DATA --> CHIRAG JOSHI 
												</span>
											</p>

											<p class="resident"> Resident Of
												<span style="margin-left: 10px"> <!--DATA --> CHIRAG JOSHI 
												</span>
												<span style="position: absolute;right: 20%;">District</span>
												<span style="position: absolute;right: 8%;"> 
												<!--DATA --> CHIRAG JOSHI </span>
											</p>

											<p class="dob"> Date Of Birth
												<span style="margin-left: 10px"> <!--DATA --> 28 - 01 - 1995 
												</span>
											</p>
											<p class="doj"> Joined School in Class
												<span style="margin-left: 10px"> <!--DATA --> 12
												</span>
												<span style="position: absolute;right: 60%;">Admission Date</span>
												<span style="position: absolute;right: 50%;"> <!--DATA --> 28 - 01 - 1995 </span>
												<span style="position: absolute;right: 35%;">Admission No</span>
												<span style="position: absolute;right: 28%;"> <!--DATA --> 2801995 </span>
											</p>

											<p class="dol"> Left School in Class
												<span style="margin-left: 10px"> <!--DATA --> 12
												</span>
												<span style="position: absolute;right: 60%;">Leaving Date</span>
												<span style="position: absolute;right: 50%;"> <!--DATA --> 28 - 01 - 1995 </span>
												<span style="position: absolute;right: 35%;">in order to</span>
												<span style="position: absolute;right: 20%;"> <!--DATA --> Shifting to New City </span>
											</p>
											<br>
											<p class="remark1"> His/Her conduct as far as known as to the undersigned was 
												<span style="margin-left: 10px"> <!--DATA --> 12
												</span>
											</p>

											<p class="remark2"> He/She has paid all school dues 
												<span style="margin-left: 10px"> <!--DATA --> 12
												</span>
											</p>

											<br>
											<p class="doi"> Date of issue of certificate 
												<span style="margin-left: 10px"> <!--DATA --> 28 - 01 - 1995
												</span>
											</p>
											<br>
											<div>
											<span style="position: absolute; right: 5%; bottom: 15%"><!--DATA -->Signature</span>
											<span style="position: absolute; right: 5%; bottom: 15%"><!--DATA -->Seal</span>
											<span style="position: absolute; right: 5%; bottom: 10%">Headmaster / Headmistress</span>
											</div>

										</div>

									</div>
									<div class="box-footer">
											<button class="btn bg-danger btn-flat" id="printbutton"><?php echo lang('print') ?></button>
									</div>
									<?php } ?>
								</div>
                            </div>
                         </div>
					</div>
                </section>
            </div>
<script type="text/javascript">
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
        $('#dol').datepicker({
		autoclose : true ,
		format: "yyyy/mm/dd",
	});
 </script>