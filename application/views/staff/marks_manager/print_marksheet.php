<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo lang('print_marksheet') ?></title>
<link rel="stylesheet" href="<?php echo site_url('assets/admin/dist/css/certificates.css')?>" type="text/css" />
<script src="<?php echo site_url ('assets/common/plugins/jQuery/'); ?>jquery-2.2.3.min.js"></script>
<style>
@media print
{    
    #student_search { 
      display: none !important; 
    }
	@page {
    size: auto;   
    margin: 0;  
	}
}
</style>
</head>
<body>
	<div id="student_search">
		<div>
			<form method="post">
				<label><?php echo lang('enrol_no') ?></label>
				<input type="text" name="enrol_no" value="<?php echo set_value('enrol_no'); ?>" />
				<label><?php echo lang('student').' '.lang('first').' '.lang('name') ?></label>
				<input type="text" name="fname" value="<?php echo set_value('fname'); ?>"/>
				<label><?php echo lang('promote_to_class') ?></label>
				<select name="promoted_session" id="promoted_session" >
					<option value=""><?php echo lang('select_class') ?></option>
					<?php if (!empty ($sessions)) { foreach ($sessions as $session) { 
							if ($session->id != $this->session->userdata('academic_session')){
					?>
					<option value="<?php echo $session->id ?>"> <?php echo $session->caption ?></option>
					<?php } else { $current_session = $session; }}} ?>
				</select>
				<select name="promoted_class" id="promoted_class" >
				</select>
				<input type="submit" name="submit"  value="<?php echo lang('search') ?>"/>
				<?php if (!empty ($students)) {  ?> <button id="printbutton"><?php echo lang('print'); ?></button> <?php } ?>
			</form>
		</div>
	</div>
	<div id="marksheet">
		<?php if (!empty ($students)) { foreach ($students as $student) { // print_r($student); die; ?>
			<p align="center"> Progress Report (<?php echo $current_session->caption ?>) </p>
			<div>
				<div class="header">
					<table align="center">

						<tr>
							<td>
								Student's Name - <?php echo ucwords ($student->fname.' '.$student->lname) ?>
								
							</td>
							<td rowspan="3">
							<?php if (!empty ($student->s_img)) { ?> 
								<img style="width:100px" src="<?php echo site_url('upload/students/student/'.$student->s_img) ?>"> 
							<?php } ?>	
							</td>
							<td> 
								Class - <?php echo $class->name.' '.$section_detail->name ?>
							</td> 
						</tr>
						<tr>
							<td>
								Father's Name - <?php echo ucwords ($student->f_name) ?>
							</td>
							<td> 
								Date of Birth - <?php echo $student->dob ?>
							</td>
						<tr>
							<td>
								Mother's Name - <?php echo ucwords ($student->m_name) ?>
							</td>
							<td> 
								S.R.N - <?php echo $student->enrol_no; ?>
							</td> 	
						</tr>
					</table>
					
					<?php $anual_marksheet = $this->Marks_zone->get_student_markseet($this->session->userdata('academic_session'),$section_detail->id, $student->id); ?>
					<p style="color:#000000;"><?php //echo ' Serial No : '.$anual_marksheet->serial_no ?></p>
				</div>
				<table cellpadding="5" cellspacing="1" border="1px" class="marksheet-data">
					<thead>
						<tr>
							<th><?php echo lang('subjects')  ?></th>
							<th><?php echo 'Max Marks'  ?></th>
							<th><?php echo 'Min Marks'  ?></th>
							<th><?php echo 'Marks Obtain'  ?></th>
							<th colspan="3"><?php echo 'Remark'  ?></th>
						</tr>
					</thead>
					<tbody>
						
							<?php if (!empty ($subjects)) { foreach ($subjects as $subject){									
							?>
							<tr>
								<td><?php echo $subject->subject_code.' '.$subject->name ?></td>
								<td><?php echo $subject->max_marks ?></td>
								<td><?php echo $subject->min_marks ?></td>
								<?php $entered_marks = $this->Marks_zone->get_marks_entery_anual($subject->id,$section_detail->id,$student->id); ?>
								<td><?php echo @$entered_marks ->optain_marks; ?>
									<?php if (!empty($grades)) { foreach ($grades as $grade) { 
											if ( $grade->marks_from <= @$entered_marks ->optain_marks && @$entered_marks ->optain_marks <= $grade->marks_to){
												echo $grade->name;
											}
										}}			
									?>
								</td>
							 </tr>
							<?php } } ?>

							<tr>
								<td>Max Marks</td>
								<td><?php echo $anual_marksheet->max_marks ;?></td>
								<td>Max Obtain</td>
								<td><?php echo $anual_marksheet->obtain_marks ?></td>
								<?php $remark = $this->Other->get_remark($this->session->userdata('academic_session'),$student->id); ?>
								<td colspan="3" rowspan="3" class="remark"> <?php echo (!empty ($remark)) ? $remark->remark : ''?></td>
							</tr>
							<!-- FOOTER -->
							<tr>
								<th>Result</th>
								<th>Percenatge</th>
								<th>Class Rank</th>
								<th>Section Rank</th>
								<?php $attendacnce = $this->attendance->get_attendance($this->session->userdata('academic_session'),$student->id); ?>
								<?php if (!empty ($attendacnce)) { ?>
								<th>Attendace</th>
								<th>Promoted to class</th>	
								<th>Result Date</th>							
								<?php } ?>	
							</tr>
							<tr>
								<td><?php echo ($marksheet -> passing_percentage <= $anual_marksheet->percentage) ? 'PASS'  :  'FAIL' ?></td>
								<td><?php echo $anual_marksheet->percentage ?></td>
								<td><?php echo $anual_marksheet->class_rank ?></td>
								<td><?php echo ($marksheet -> passing_percentage <= $anual_marksheet->percentage) ? $anual_marksheet->section_rank   :  '' ?></td>
								<?php if (!empty ($attendacnce)) { ?>
								<td> <?php echo $attendacnce->attendance.' /'.$attendacnce->working_days  ?></td>
								<?php } ?>
								<td><?php echo ($marksheet -> passing_percentage <= $anual_marksheet->percentage) ? @$promoted_class : '' ?></td>
								<td><?php echo $marksheet->result_date; ?></td>
							</tr>

						</tbody>
				</table>
				<table class="sign-table">
					<tr>	
						<td>	</td>
						<?php $settings = $this->setting->principal_sign; ?>
						<td>
							<?php if(!empty($settings))
							{
								?>
									<img src="<?php echo site_url('upload/principal_sign/'.$settings); ?>" >
								<?php
							} 
							?> 
						</td>
					</tr>
					<tr>
						<td> Class teacher Sign </td>
						<td> Principal Signature </td>
					</tr>
				</table>
			</div>
		<?php }}?>
	</div>
</body>
</html>
<script type="text/javascript">
        $("#printbutton").on("click", function () {
            window.print();
		});
		$('#promoted_session').on('change',function (){
			if ($(this).val() != '') {	
				//call_loader();
				$.ajax ({
					url:'<?php echo site_url('staff/marks_manager/ajax_session_class') ?>',
					type:'Post',
					data:{session_id:$(this).val()},
					success : function (result){
						$('#promoted_class').html(result);	
					}	
			    });
		    }	 
		});
</script>
