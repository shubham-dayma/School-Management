<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
	.dynamic { margin-top:5px;}
</style>
<link rel="stylesheet" href="<?php echo site_url(); ?>assets/common/plugins/iCheck/line/yellow.css" >
<link rel="stylesheet" href="<?php echo site_url(); ?>assets/admin/plugins/datatable_buttons/buttons.dataTables.min.css" />
<script type="text/javascript" src="<?php echo site_url(); ?>assets/common/plugins/iCheck/icheck.js" ></script>
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
          <div class="box box-warning">
            <div class="box-header with-border">
              <form method="post">
			  	<?php $cols = 2; ?>
			  	<div class="row">
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="T.name as title" name="rows[]"  <?php echo @in_array ('T.name as title',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('title') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.fname" name="rows[]" <?php echo @in_array ('S.fname',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('first').' '.lang('name') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.mname" name="rows[] " <?php echo @in_array ('S.mname',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('middle').' '.lang('name') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.lname" name="rows[]" <?php echo @in_array ('S.lname',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('last').' '.lang('name') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.gender" name="rows[]" <?php echo @in_array ('S.gender',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('gender') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.dob" name="rows[]" <?php echo @in_array ('S.dob',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('dob') ?></label>
					</div>
				</div>
				<div class="row">
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.c_address" name="rows[]" <?php echo @in_array ('S.c_address',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('c_address') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.p_address" name="rows[]" <?php echo @in_array ('S.p_address',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('p_address') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.s_mobile" name="rows[]" <?php echo @in_array ('S.s_mobile',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('student').' '.lang('phone') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.s_email" name="rows[]" <?php echo @in_array ('S.s_email',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('student').' '.lang('email') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.enrol_no" name="rows[]" <?php echo @in_array ('S.enrol_no',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('enrol_no') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.registration_no" name="rows[]" <?php echo @in_array ('S.registration_no',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('registration_no') ?></label>
					</div>
				</div>
				<div class="row">
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="AC.name as admit_class" name="rows[]" <?php echo @in_array ('AC.name as admit_class',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('admit_class') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="AS.name as admit_section" name="rows[]" <?php echo @in_array ('AS.name as admit_section',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('admit_section') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.admit_date" name="rows[]" <?php echo @in_array ('S.admit_date',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('admit_date') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="N.name as nationality" name="rows[]" <?php echo @in_array ('N.name as nationality',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('nationality') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="R.name as religion" name="rows[]" <?php echo @in_array ('R.name as religion',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('religion') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="C.name as cast" name="rows[]" <?php echo @in_array ('C.name as cast',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('cast') ?></label>
					</div>
				</div>
				<div class="row">
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="CAT.name as category" name="rows[]" <?php echo @in_array ('CAT.name as category',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('category') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.adhar_card_no" name="rows[]" <?php echo @in_array ('S.adhar_card_no',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('adhar_card_no') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.mother_tounge" name="rows[]" <?php echo @in_array ('S.mother_tounge',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('mother_tounge') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.f_name" name="rows[]" <?php echo @in_array ('S.f_name',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('father').' '.lang('name') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.f_email" name="rows[]" <?php echo @in_array ('S.f_email',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('father').' '.lang('email') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.f_mobile" name="rows[]" <?php echo @in_array ('S.f_mobile',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('father').' '.lang('phone') ?></label>
					</div>
				</div>
				<div class="row">	
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.f_edu_qulification" name="rows[]" <?php echo @in_array ('S.f_edu_qulification',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('father').' '.lang('edu_qulification') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.f_work_place" name="rows[]" <?php echo @in_array ('S.f_work_place',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('father').' '.lang('work_place') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.f_gov_servent" name="rows[]" <?php echo @in_array ('S.f_gov_servent',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('father').' '.lang('is_gov_servent') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.f_annual_income" name="rows[]" <?php echo @in_array ('S.f_annual_income',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('father').' '.lang('annual_income') ?></label>
					</div>	
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.m_name" name="rows[]" <?php echo @in_array ('S.m_name',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('mother').' '.lang('name') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.m_email" name="rows[]" <?php echo @in_array ('S.m_email',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('mother').' '.lang('email') ?></label>
					</div>
				</div>
				<div class="row">	
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.m_mobile" name="rows[]" <?php echo @in_array ('S.m_mobile',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('mother').' '.lang('phone') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.m_edu_qulification" name="rows[]" <?php echo @in_array ('S.m_edu_qulification',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('mother').' '.lang('edu_qulification') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.m_work_place" name="rows[]" <?php echo @in_array ('S.m_work_place',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('mother').' '.lang('work_place') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.m_gov_servent" name="rows[]" <?php echo @in_array ('S.m_gov_servent',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('mother').' '.lang('is_gov_servent') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.m_annual_income" name="rows[]" <?php echo @in_array ('S.m_annual_income',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('mother').' '.lang('annual_income') ?></label>
					</div>
						<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.g_name" name="rows[]" <?php echo @in_array ('S.g_name',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('gardian').' '.lang('name') ?></label>
					</div>
				</div>
				<div class="row">	
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.g_email" name="rows[]" <?php echo @in_array ('S.g_email',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('gardian').' '.lang('email') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.g_mobile" name="rows[]" <?php echo @in_array ('S.g_mobile',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('gardian').' '.lang('phone') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.g_edu_qulification" name="rows[]" <?php echo @in_array ('S.g_edu_qulification',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('gardian').' '.lang('edu_qulification') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.g_work_place" name="rows[]" <?php echo @in_array ('S.g_work_place',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('gardian').' '.lang('work_place') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.g_gov_servent" name="rows[]" <?php echo @in_array ('S.g_gov_servent',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('gardian').' '.lang('is_gov_servent') ?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.g_annual_income" name="rows[]" <?php echo @in_array ('S.g_annual_income',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('gardian').' '.lang('annual_income') ?></label>
					</div>
				</div>
				<div class="row">	
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="CONT.name as country" name="rows[]" <?php echo @in_array ('CONT.name as country',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('country')?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="STATE.name as state" name="rows[]" <?php echo @in_array ('STATE.name as state',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('state')?></label>
					</div>	
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="CITY.name as city" name="rows[]" <?php echo @in_array ('CITY.name as city',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('city')?></label>
					</div>	
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="S.pin_code" name="rows[]" <?php echo @in_array ('S.pin_code',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('pincode')?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="CC.name as current_class" name="rows[]" <?php echo @in_array ('CC.name as current_class',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('current').' '.lang('class')?></label>
					</div>
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="CS.name as current_section" name="rows[]" <?php echo @in_array ('CS.name as current_section',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('current').' '.lang('section')?></label>
					</div>
				</div>	
				<div class="row">
					<div class="dynamic col-md-<?php echo $cols ?>">
						<input type="checkbox" value="SSS.roll_no" name="rows[]" <?php echo @in_array ('SSS.roll_no',$columns) ? 'checked="checked"' : '' ?>/>
						<label><?php echo lang('roll_no')?></label>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12" style="padding: 20px;text-align: right;">
						<input type="submit" name="submit" class="btn btn-warning btn-flat" value="<?php echo lang('submit') ?>" />
					</div>
				</div>	
			  </form>
            </div>
		 
		   <div class="box-body">
              <table id="example" class="table table-bordered table-striped">
			   <thead>
				<tr>
					<?php $cols = array(); if (!empty ($columns)) { foreach ($columns as $column)  {
						switch ($column){
							 case 'T.name as title':
													$caption = lang('title');
													$cols[] = 'title';
													break;
							 case 'S.fname':
													$caption = lang('first').' '.lang('name');
													$cols[] = 'fname';
													break;
							case 'S.mname':
													$caption = lang('middle').' '.lang('name');
													$cols[] = 'mname';
													break;	
							case 'S.lname':
													$caption = lang('last').' '.lang('name');
													$cols[] = 'lname';	
													break;
							case 'S.gender':
													$caption = lang('gender');
													$cols[] = 'gender';	
													break;
							case 'S.dob':
													$caption = lang('dob');
													$cols[] = 'dob';
													break;
							case 'S.c_address':
													$caption = lang('c_address');
													$cols[] = 'c_address';
													break;
							case 'S.p_address':
													$caption = lang('p_address');
													$cols[] = 'p_address';
													break;	
							case 'S.s_mobile':
													$caption = lang('student').' '.lang('mobile');
													$cols[] = 's_mobile';
													break;
							case 'S.s_email':
													$caption = lang('student').' '.lang('email');
													$cols[] = 's_email';
													break;
							case 'S.enrol_no':
													$caption = lang('enrol_no');
													$cols[] = 'enrol_no';
													break;	
							case 'S.registration_no':
													$caption = lang('registration_no');
													$cols[] = 'registration_no';
													break;
							case 'AC.name as admit_class':
													$caption = lang('admit_class');
													$cols[] = 'admit_class';
													break;
							case 'AS.name as admit_section':
													$caption = lang('admit_section');
													$cols[] = 'admit_section';
													break;		
							case 'S.admit_date':
													$caption = lang('admit_date');
													$cols[] = 'admit_date';	
													break;
							case 'N.name as nationality':
													$caption = lang('nationality');
													$cols[] = 'nationality';
													break;
							case 'R.name as religion':
													$caption = lang('religion');
													$cols[] = 'religion';
													break;
							case 'C.name as cast':
													$caption = lang('cast');
													$cols[] = 'cast';
													break;
							case 'CAT.name as category':
													$caption = lang('category');
													$cols[] = 'category';
													break;						
							case 'S.adhar_card_no':
													$caption = lang('adhar_card_no');
													$cols[] = 'adhar_card_no';
													break;
							case 'S.mother_tounge':
													$caption = lang('mother_tounge');
													$cols[] = 'mother_tounge';	
													break;
							case 'S.f_name':
													$caption = lang('father').' '.lang('name');
													$cols[] = 'f_name';
													break;
							case 'S.f_email':
													$caption = lang('father').' '.lang('email');
													$cols[] = 'f_email';
													break;
							case 'S.f_mobile':
													$caption = lang('father').' '.lang('phone');
													$cols[] = 'f_mobile';
													break;
							case 'S.f_edu_qulification':
													$caption = lang('father').' '.lang('edu_qulification');
													$cols[] = 'f_edu_qulification';	
													break;
							case 'S.f_work_place':
													$caption = lang('father').' '.lang('work_place');
													$cols[] = 'f_work_place';
													break;
							case 'S.f_gov_servent':
													$caption = lang('father').' '.lang('is_gov_servent');
													$cols[] = 'f_gov_servent';
													break;
							case 'S.f_annual_income':
													$caption = lang('father').' '.lang('annual_income');
													$cols[] = 'f_annual_income';
													break;
							case 'S.m_name':
													$caption = lang('mother').' '.lang('name');
													$cols[] = 'm_name';	
													break;
							case 'S.m_email':
													$caption = lang('mother').' '.lang('email');
													$cols[] = 'm_email';
													break;
							case 'S.m_mobile':
													$caption = lang('mother').' '.lang('phone');
													$cols[] = 'm_mobile';
													break;
							case 'S.m_edu_qulification':
													$caption = lang('mother').' '.lang('edu_qulification');
													$cols[] = 'm_edu_qulification';
													break;	
							case 'S.m_work_place':
													$caption = lang('mother').' '.lang('work_place');
													$cols[] = 'm_work_place';
													break;
							case 'S.m_gov_servent':
													$caption = lang('mother').' '.lang('is_gov_servent');
													$cols[] = 'm_gov_servent';
													break;
							case 'S.m_annual_income':
													$caption = lang('mother').' '.lang('annual_income');
													$cols[] = 'm_annual_income';
													break;
							case 'S.g_name':
													$caption = lang('gardian').' '.lang('name');
													$cols[] = 'g_name';	
													break;
							case 'S.g_email':
													$caption = lang('gardian').' '.lang('email');
													$cols[] = 'g_email';
													break;
							case 'S.g_mobile':
													$caption = lang('gardian').' '.lang('phone');
													$cols[] = 'g_mobile';
													break;
							case 'S.g_edu_qulification':
													$caption = lang('gardian').' '.lang('edu_qulification');
													$cols[] = 'g_edu_qulification';	
													break;
							case 'S.g_work_place':
													$caption = lang('gardian').' '.lang('work_place');
													$cols[] = 'g_work_place';
													break;
							case 'S.g_gov_servent':
													$caption = lang('gardian').' '.lang('is_gov_servent');
													$cols[] = 'g_gov_servent';
													break;
							case 'S.g_annual_income':
													$caption = lang('gardian').' '.lang('annual_income');
													$cols[] = 'g_annual_income';	
													break;
							case 'CONT.name as country':
													$caption = lang('country');
													$cols[] = 'country';
													break;
							case 'STATE.name as state':
													$caption = lang('state');
													$cols[] = 'state';	
													break;
							case 'CITY.name as city':
													$caption = lang('city');
													$cols[] = 'city';
													break;
							case 'S.pin_code':
													$caption = lang('pincode');
													$cols[] = 'pin_code';
													break;
							case 'CC.name as current_class':
													$caption = lang('current').' '.lang('class');
													$cols[] = 'current_class';
													break;
							case 'CS.name as current_section':
													$caption = lang('current').' '.lang('section');
													$cols[] = 'current_section';
													break;	
							case 'SSS.roll_no': 
												$caption = lang('roll_no');	
												$cols[] = 'roll_no';
												break;																																																				
																																																																																																																																																																															
						}
					
					?>
					<td><?php echo $caption ?></td>
					<?php }} ?>
				</tr>
			   </thead>	
			   <tbody>
					
					<?php if (!empty ($students)) { foreach ($students as $student) { ?>
					<tr>
						<?php if (!empty ($cols)) { foreach ($cols as $col)  { 
							  switch ($col){
									case 'gender':
												  $gen = ($student->$col == 0) ? lang('male') :lang('female');
												   echo '<td>'.$gen.'</td>';
												   break;
									case 'f_gov_servent':
												  $f_gov = ($student->$col == 1) ? lang('yes') :lang('no');
												   echo '<td>'.$f_gov.'</td>';
												   break;
									case 'm_gov_servent':
												  $m_gov = ($student->$col == 1) ? lang('yes') :lang('no');
												   echo '<td>'.$m_gov.'</td>';	
												   break;
									case 'g_gov_servent':
												  $g_gov = ($student->$col == 1) ? lang('yes') :lang('no');
												   echo '<td>'.$g_gov.'</td>';
												   break;	
									default:	echo '<td>'.$student->$col.'</td>';	
												 break;	   			   		   			   	
								}
						?>
						<?php }} ?>
					</tr>	
					<?php }} ?>
			   </tbody>
			</table>
            </div>
            <!-- /.box-body -->
			</div>	
		 </div>
      </div>
    </section>
  </div>
<script>
  $(document).ready(function() {	
		$('input').each(function(){
		var self = $(this),
		  label = self.next(),
		  label_text = label.text();
	
		label.remove();
		self.iCheck({
		  checkboxClass: 'icheckbox_line-yellow',
		  radioClass: 'iradio_line-yellow',
		  insert: '<div class="icheck_line-icon"></div>' + label_text
		});
	  });
	  $('#example').DataTable( {
	  		"ordering": false,
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			]
	  });
  });	  
 // $('input').iCheck('check');
  	
  </script>
  