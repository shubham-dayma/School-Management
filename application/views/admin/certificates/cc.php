<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//echo '<pre>';print_r($row);die;
//echo '<pre>';print_r($this->setting);die;
?>
<link rel="stylesheet" href="<?php echo site_url('assets/admin/dist/css/certificates.css')?>" type="text/css" />
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
                                    <h3 class="box-title"><?php echo lang('cc'); ?></h3>
                                </div>
                                <div class="box-body">
								   <?php if (!empty ($issued)) { ?>
                                   		<p class="bg-danger" style="padding: 10px;"><?php echo lang('cc_already_issued').$issued->issue_date; ?></p>
								   <?php } ?>	
                                   <div class="row" id="printcontent">
								   		<div class="col-md-12">
											<div align="center">
												<h1 class="color-red">Charehter Certificate</h1>
											</div>
										</div>
									</div>
									<form method="post" class="form-horizontal">	
										<div class="box-footer">
											<button class="btn bg-danger btn-flat" id="printbutton"><?php echo lang('print') ?></button>
											<?php if (empty($issued)) { ?>
											<input type="submit" name="submit" value="<?php echo lang('issue_cc')?>" class="btn bg-purple btn-flat"  />
											<?php } ?>
										</div>
									</form>
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
 </script>