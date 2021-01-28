<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo lang('tabsheets') ?>t</title>
</head>
<link rel="stylesheet" href="<?php echo site_url('assets/admin/dist/css/certificates.css')?>" type="text/css" />
<script src="<?php echo site_url ('assets/common/plugins/jQuery/'); ?>jquery-2.2.3.min.js"></script>

<style>
@media print
{    
	#printbutton{display:none;}
}
</style>
<body>
	<button id="printbutton"><?php echo lang('print'); ?></button>
	<table cellspacing="0" border="1px" class="">
		<thead>
			<tr>
				<td><?php echo lang('students')  ?></td>
				<?php if (!empty ($exams)) { foreach ($exams as $exam) { ?>
					<td align="center"><?php echo $exam->name ?>
						<?php if (!empty ($subject_ids))  {?>
						<table border="1px" cellspacing="0" class="">
							<tr>
								<?php foreach ($subject_ids as $subject_id) { ?>
								<?php $subject =  $this->Marks_zone->get_subject_marks_criteria($this->session->userdata('academic_session'),$section_detail->class_id,$subject_id,$exam->id); ?>
								<td><?php echo $subject->name ?></td>
								<?php } ?>
							</tr>
						</table>
						<?php } ?>
					</td>	
				<?php }} ?>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty ($students))  { foreach ($students as $student) {?>
			<tr>
				<td><?php echo ucwords($student->fname.' '.$student->lname) ?></td>
				<?php if (!empty ($exams)) { foreach ($exams as $exam) { ?>
				<td> 
					<?php if (!empty ($subject_ids))  {?>
						<table border="1px" cellpadding="20" >
							<tr>
								<?php foreach ($subject_ids as $subject_id) { ?>
									<?php $optain_marks =  $this->Marks_zone->get_marks_entery($exam->id,$subject_id,$section_detail->id,$student->id); ?>
									<td>
										<?php if (!empty ($optain_marks)) { ?>
											<?php echo ($optain_marks->attendence == 0 ) ? $optain_marks->marks : 'Ab';  ?></td>
										<?php } ?>
									</td>
								<?php } ?>
							</tr>
						</table>
						<?php } ?>
				</td>
				<?php }} ?>		
			</tr>
			<?php }} ?>
		</tbody>					
	</table>
</body>
</html>
<script type="text/javascript">
        $("#printbutton").on("click", function () {
            window.print();
		});
</script>